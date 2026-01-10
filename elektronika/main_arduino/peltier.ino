const float setpoint = 15.0;
const float histereza = 0.5;
float receivedTemp; 

void peltierControl (void *pvParameters){
  if (xQueueReceive(peltierQueue, &receivedTemp, portMAX_DELAY) == pdPASS) {
    if(receivedTemp < (setpoint - histereza)){
      digitalWrite(peltierPin, LOW);
      //Wylacz peltiera
    }
    if(receivedTemp > (setpoint + histereza)){
      digitalWrite(peltierPin, HIGH);
      //Wlacz peltiera
    }

  }
  vTaskDelay(100/portTICK_PERIOD_MS);
}