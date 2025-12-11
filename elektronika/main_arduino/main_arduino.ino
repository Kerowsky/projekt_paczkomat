#include <Arduino_FreeRTOS.h>
#include "pass.h"
#include <WiFiS3.h>
#include <ArduinoMDNS.h>

char ssid[] = ssidWifi;
char pass[] = passWifi;

int port = serverPort;
WiFiServer server(port);

WiFiUDP udp;
MDNS mdns(udp);
const char* deviceName = "arduino";

TaskHandle_t serverHTTPHandle;
TaskHandle_t blinkTaskHandle;
TaskHandle_t tempReadHandle;
void taskServer(void *pvParameters);

void setup() {
  pinMode(LED_BUILTIN, OUTPUT);
  Serial.begin(115200);
  //Sekcja komunikacji z wifi
  Serial.print("Lacze z ");
  Serial.print(ssid);
  WiFi.begin(ssid,pass);
int attempts = 0;
  while (WiFi.status() != WL_CONNECTED || WiFi.localIP() == IPAddress(0,0,0,0)) {
    delay(500);
    Serial.print(".");
    attempts++;
    
    // Jeśli nie połączy przez 20 sekund (40 * 500ms), zresetuj WiFi.begin
    if (attempts > 40) {
       Serial.println("\nZbyt długo! Ponawiam WiFi.begin...");
       WiFi.begin(ssid, pass);
       attempts = 0;
    }
  }

  Serial.println("\nPołączono IP: " + WiFi.localIP().toString());
  server.begin();
  //Start mDNS:
  if(mdns.begin(WiFi.localIP(), deviceName)){
    Serial.println("Uruchomiono mDNS jako: " + String(deviceName) + ".local");
    mdns.addServiceRecord("_http", 25565, MDNSServiceTCP);
  }
  else{
    Serial.println("Błąd mDNS");
  }
  // xTaskCreate(taskBlink, "BlinkTest",256,nullptr,2,&blinkTaskHandle);
  // xTaskCreate(tempRead, "TempRead", 256, nullptr,2,&tempReadHandle);
  xTaskCreate(taskServer, "serverHTTP", 1024, nullptr, 1, &serverHTTPHandle);
  Serial.println("Uruchamianie freeRTOS");
  vTaskStartScheduler();
}

void loop() {
  //Wgrany freeRTOS i to musi być puste
}


void taskServer(void *pvParameters) {
  // Opcjonalnie: upewnij się, że serwer wystartował (chyba że robisz to w setup)
  // server.begin(); 

  for (;;) {
    WiFiClient client = server.available();
    mdns.run();
    if (client) {
      Serial.println("Polaczono klienta");
      String currentLine = "";
      String request = "";
      
      // Zabezpieczenie przed zawieszeniem (timeout)
      unsigned long startTime = millis();
      
      while (client.connected()) {
        // Jeśli minęło za dużo czasu bez danych, przerwij (np. 2 sekundy)
        if (millis() - startTime > 2000) break; 

        if (client.available()) {
          char c = client.read();
          request += c;
          
          if (c == '\n') {
            if (currentLine.length() == 0) {
              // --- WYSYŁANIE ODPOWIEDZI ---
              client.println("HTTP/1.1 200 OK");
              client.println("Content-type:text/plain");
              client.println("Access-Control-Allow-Origin: *");
              client.println("Connection: close");
              client.println();
              
              if (request.indexOf("GET /H") >= 0) {
                digitalWrite(LED_BUILTIN, HIGH);
                client.println("LED ON");
                Serial.println("-> LED Wlaczona");
              } else if (request.indexOf("GET /L") >= 0) {
                digitalWrite(LED_BUILTIN, LOW);
                client.println("LED OFF");
                Serial.println("-> LED Wylaczona");
              }
              break; 
            } else {
              currentLine = "";
            }
          } else if (c != '\r') {
            currentLine += c;
          }
        }
        // Ważne w RTOS: Jeśli w pętli while czekamy na dane, dajmy odetchnąć procesorowi
        else {
             vTaskDelay(1); 
        }
      }
      
      // BARDZO WAŻNE: Jawne zamknięcie połączenia
      client.stop();
      Serial.println("Klient rozlaczony");
      
    } // koniec if(client)

    // Zmienione z 500 na 10ms. 
    // Serwer jest responsywny, ale RTOS ma czas na inne zadania.
    vTaskDelay(10 / portTICK_PERIOD_MS);
  }
}