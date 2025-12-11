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


TaskHandle_t blinkTaskHandle  = nullptr;
TaskHandle_t tempReadHandle = nullptr;
void setup() {
  Serial.begin(115200);
  //Sekcja komunikacji z wifi
  Serial.print("Lacze z ");
  Serial.print(ssid);
  WiFi.begin(ssid,pass);
  Serial.println("\nPołączono IP: " + WiFi.localIP().toString());

  //Start mDNS:
  if(mdns.begin(WiFi.localIP(), deviceName)){
    Serial.println("Uruchomiono mDNS jako: " + String(deviceName) + " .local");
    mdns.addServiceRecord("_http", 80, MDNSServiceTCP);
  }
  else{
    Serial.println("Błąd mDNS");
  }
  xTaskCreate(taskBlink, "BlinkTest",256,nullptr,1,&blinkTaskHandle);
  xTaskCreate(tempRead, "TempRead", 256, nullptr,2,&tempReadHandle);
  vTaskStartScheduler();
}

void loop() {
  //Wgrany freeRTOS i to musi być puste
}
