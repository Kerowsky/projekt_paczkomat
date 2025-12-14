void openLocker(void *pvParameters) {
  (void) pvParameters;
  int8_t receivedPin; 

  for (;;) {
    if (xQueueReceive(lockerQueue, &receivedPin, portMAX_DELAY) == pdPASS) {
      
      Serial.print("Otrzymano zadanie otwarcia pin: ");
      Serial.println(receivedPin);

      switch (receivedPin) {
        case 1:
          Serial.println("-> Otwieram mala szafke (Pin 3)");
          digitalWrite(sLockerPin, HIGH);
          vTaskDelay(100 / portTICK_PERIOD_MS); 
          digitalWrite(sLockerPin, LOW);
          break;

        case 2:
          Serial.println("-> Otwieram srednia szafke (Pin 4)");
          digitalWrite(mLockerPin, HIGH);
          vTaskDelay(100 / portTICK_PERIOD_MS);
          digitalWrite(mLockerPin, LOW);
          break;
          
        case 3:
          Serial.println("-> Otwieram duza szafke (Pin 5)");
          digitalWrite(bLockerPin, HIGH);
          vTaskDelay(100 / portTICK_PERIOD_MS);
          digitalWrite(bLockerPin, LOW);
          break;
      }
    }
  }
}