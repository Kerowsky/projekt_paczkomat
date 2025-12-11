#include <Arduino_FreeRTOS.h>
#include "pass.h"
#include <WiFiS3.h>
#include <ArduinoMDNS.h>

char ssid[] = ssidWifi;
char pass[] = passWifi;

int port = serverPort;
WiFiServer server(port);

MDNS mdns(udp);
const char* deviceName = "arduino";


const TaskHandle_t blinkTaskHandle  = nullptr;
const TaskHandle_t tempReadHandle = nullptr;
void setup() {
  Serial.begin(115200);
  xTaskCreate(taskBlink, "BlinkTest",256,nullptr,1,&blinkTaskHandle);
  xTaskCreate(tempRead, "TempRead", 256, nullptr,2,&tempReadHandle);
  vTaskStartScheduler();
}

void loop() {
  //Wgrany freeRTOS i to musi być puste
}
