#include <Arduino_FreeRTOS.h>

TaskHandle_t blinkTaskHandle  = nullptr;
void setup() {
  xTaskCreate(taskBlink, "BlinkTest",256,nullptr,1,&blinkTaskHandle);
  vTaskStartScheduler();
}

void loop() {

}
