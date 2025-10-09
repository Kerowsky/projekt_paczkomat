#include "Arduino_FreeRTOS.h"
#include "DHT.h"

///Pinout
#define LEDINDICATOR_PIN 13
#define DHTPIN 11
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);

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
void DHT_ReadData(void *param){
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
void Open_Small_Locker(void *parma){
  pinMode(SMALL_Locker_PIN, OUTPUT);
  while(1){
    digitalWrite(SMALL_Locker_PIN,HIGH); //otwarcie zamka
    vTaskDelay(30000 / portTICK_PERIOD_MS); //30 sekund na zamknięcie szafki
    digitalWrite(SMALL_Locker_PIN,LOW); //zamykanie zamkna
  }
}
oid Open_Medium_Locker(void *parma){
  pinMode(MEDIUM_Locker_PIN, OUTPUT);
  while(1){
    digitalWrite(MEDIUM_Locker_PIN,HIGH); //otwarcie zamka
    vTaskDelay(30000 / portTICK_PERIOD_MS); //30 sekund na zamknięcie szafki
    digitalWrite(MEDIUM_Locker_PIN,LOW); //zamykanie zamkna
  }
}
void Open_Big_Locker(void *parma){
  pinMode(BIG_Locker_PIN, OUTPUT);
  while(1){
    digitalWrite(BIG_Locker_PIN,HIGH); //otwarcie zamka
    vTaskDelay(30000 / portTICK_PERIOD_MS); //30 sekund na zamknięcie szafki
    digitalWrite(BIG_Locker_PIN,LOW); //zamykanie zamkna
  }
}

void setup() {
  dht.begin();
  Serial.begin(9600);
  xTaskCreate(errorBlink, "errorTest", 128, NULL, 3, NULL);
  xTaskCreate(taskBlink, "LED", 128, NULL, 1, NULL);
  xTaskCreate(DHT_ReadData, "OdczytDHT", 512, NULL, 2, NULL);
  digitalWrite(SMALL_Locker_PIN,LOW); //stan początkowy zamka
  xTaskCreate(Open_Small_Locker, "Otwarcie_małej_szafki", 256, NULL, 1, NULL);
  digitalWrite(MEDIUM_Locker_PIN,LOW); //stan początkowy zamka
  xTaskCreate(Open_Medium_Locker, "Otwarcie_sredniej_szafki", 256, NULL, 1, NULL);
  digitalWrite(BIG_Locker_PIN,LOW); //stan początkowy zamka
  xTaskCreate(Open_Big_Locker, "Otwarcie_Duzej_szafki", 256, NULL, 1, NULL):
  vTaskStartScheduler();
}

void loop() {

}
