#include "Arduino_FreeRTOS.h"
#include "Adafruit_MCP23017.h"
// #include "LiquidCrystal.h"
#include "DHT.h"

///Pinout
#define LEDINDICATOR_PIN 13
#define DHTPIN 11
#define DHTTYPE DHT11
#define SMALL_Locker_PIN 3
#define MEDIUM_Locker_PIN 4
#define BIG_Locker_PIN 5

/*      Obsługa bibliotek i elementów     */
DHT dht(DHTPIN, DHTTYPE);
Adafruit_MCP23017 mcp;
// LiquidCrystal lcd(2, 3, 4, 5, 6, 7);

void errorBlink(void *param){
  pinMode(LEDINDICATOR_PIN, OUTPUT);
  while(1){
    digitalWrite(LEDINDICATOR_PIN,HIGH);
    vTaskDelay(100 / portTICK_PERIOD_MS );
    digitalWrite(LEDINDICATOR_PIN, LOW);
    vTaskDelay(100 / portTICK_PERIOD_MS);
  }
}

void taskBlink(void *param){
  pinMode(LEDINDICATOR_PIN, OUTPUT);
  while(1){
    digitalWrite(LEDINDICATOR_PIN,HIGH);
    vTaskDelay(1000 / portTICK_PERIOD_MS );
    digitalWrite(LEDINDICATOR_PIN, LOW);
    vTaskDelay(1000 / portTICK_PERIOD_MS);
  }
}
void DHT_readData(void *param){
  while(1){
    float humidity = dht.readHumidity();
    float temperature = dht.readTemperature();
    if (isnan(humidity) || isnan(temperature)) {
      Serial.println("Błąd odczytu z DHT!");
    }
    Serial.print("Wilgotnosc: ");
    Serial.print(humidity);
    Serial.print(" %\n");

    Serial.print("Temperatura: ");
    Serial.print(temperature);
    Serial.print(" *C\n");
    vTaskDelay(2000 / portTICK_PERIOD_MS );
  }

}
void openSmallLocker(void *parma){
  pinMode(SMALL_Locker_PIN, OUTPUT);
  while(1){
    digitalWrite(SMALL_Locker_PIN,HIGH); //otwarcie zamka
    vTaskDelay(30000 / portTICK_PERIOD_MS); //30 sekund na zamknięcie szafki
    digitalWrite(SMALL_Locker_PIN,LOW); //zamykanie zamkna
  }
}
void openMediumLocker(void *parma){
  pinMode(MEDIUM_Locker_PIN, OUTPUT);
  while(1){
    digitalWrite(MEDIUM_Locker_PIN,HIGH); //otwarcie zamka
    vTaskDelay(30000 / portTICK_PERIOD_MS); //30 sekund na zamknięcie szafki
    digitalWrite(MEDIUM_Locker_PIN,LOW); //zamykanie zamkna
  }
}
void openBigLocker(void *parma){
  pinMode(BIG_Locker_PIN, OUTPUT);
  while(1){
    digitalWrite(BIG_Locker_PIN,HIGH); //otwarcie zamka
    vTaskDelay(30000 / portTICK_PERIOD_MS); //30 sekund na zamknięcie szafki
    digitalWrite(BIG_Locker_PIN,LOW); //zamykanie zamkna
  }
}

void setup() {
  dht.begin();
  mcp.begin();
  Serial.begin(9600);
  /*      Zerowanie stanów zamków           */
  digitalWrite(SMALL_Locker_PIN,LOW); //stan początkowy zamka
  digitalWrite(MEDIUM_Locker_PIN,LOW); //stan początkowy zamka
  digitalWrite(BIG_Locker_PIN,LOW); //stan początkowy zamka

  xTaskCreate(errorBlink, "errorTest", 128, NULL, 3, NULL);
  xTaskCreate(taskBlink, "LED", 128, NULL, 1, NULL);
  xTaskCreate(DHT_readData, "OdczytDHT", 512, NULL, 2, NULL);
  xTaskCreate(openSmallLocker, "Otwarcie_malej_szafki", 256, NULL, 1, NULL);
  xTaskCreate(openMediumLocker, "Otwarcie_sredniej_szafki", 256, NULL, 1, NULL);
  xTaskCreate(openBigLocker, "Otwarcie_Duzej_szafki", 256, NULL, 1, NULL);
  vTaskStartScheduler();
}

void loop() {

}
