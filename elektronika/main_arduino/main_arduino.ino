#include "Arduino_FreeRTOS.h"
#include "DHT.h"

///Pinout

#define DHTPIN 11
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);

void taskBlink(void *param){
  pinMode(13, OUTPUT);
  while(1){
    digitalWrite(13,HIGH);
    vTaskDelay(1000 / portTICK_PERIOD_MS );
    digitalWrite(13, LOW);
    vTaskDelay(1000 / portTICK_PERIOD_MS);
  }
}
void DHT_ReadData(void *param){
  while(1){
    float humidity = dht.readHumidity();
    float temperature = dht.readTemperature();
    if (isnan(humidity) || isnan(temperature)) {
      Serial.println("Błąd odczytu z DHT!");
    return;
    }
    Serial.print("Wilgotnosc: ");
    Serial.print(humidity);
    Serial.print(" %\t");

    Serial.print("Temperatura: ");
    Serial.print(humidity);
    Serial.print(" *C\t");
    vTaskDelay(2000 / portTICK_PERIOD_MS );
  }

}

void setup() {
  Serial.begin(9600);
  xTaskCreate(taskBlink, "LED", 128, NULL, 1, NULL);
  xTaskCreate(DHT_ReadData, "OdczytDHT", 128, NULL, 1, NULL);

}

void loop() {

}
