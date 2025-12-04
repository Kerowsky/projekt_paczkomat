#include <Arduino_FreeRTOS.h>
#include "pass.h"
#include <WiFiS3.h>
#include <ArduinoMDNS.h>

char ssid[] = ssidWifi;
char pass[] = passWifi;

int port = serverPort;
WiFiServer server(port);



TaskHandle_t blinkTaskHandle  = nullptr;
void setup() {
  xTaskCreate(taskBlink, "BlinkTest",256,nullptr,1,&blinkTaskHandle);
  vTaskStartScheduler();
}

void loop() {
  //Wgrany freeRTOS i to musi być puste
}
