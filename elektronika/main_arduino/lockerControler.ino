// void openLocker(void *pvParameters){
//   (void) pvParameters;
//   int8_t lockerPin;
//   //Trzeba zrobić kolejke który bedzie odbierał pin do otworzenia
//   for(;;){
//     if(xQueueReceive(lockerQueue, &lockerPin, 0)){ // odebrano coś z kolejki, jak odbierze to usuwa.

//     }
//   }
// }

void taskBlink(void *pvParameters){
  for(;;){
    digitalWrite(LED_BUILTIN, HIGH);
    vTaskDelay(500);
    digitalWrite(LED_BUILTIN, LOW);
    vTaskDelay(500);
  }
}