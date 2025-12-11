#include <Arduino_FreeRTOS.h>
#include "pass.h"
#include <WiFiS3.h>
#include <ArduinoMDNS.h>
#include <PID_v1.h>

char ssid[] = ssidWifi;
char pass[] = passWifi;

int port = serverPort;
WiFiServer server(port);



TaskHandle_t blinkTaskHandle  = nullptr;
TaskHandle_t tempReadHandle = nullptr;
void setup() {
  xTaskCreate(taskBlink, "BlinkTest",256,nullptr,1,&blinkTaskHandle);
  xTaskCreate(tempRead, "TempRead", 256, nullptr,2,&tempReadHandle);
  Serial.begin(9600);
  vTaskStartScheduler();
}

void loop() {
  //Wgrany freeRTOS i to musi być puste
}
