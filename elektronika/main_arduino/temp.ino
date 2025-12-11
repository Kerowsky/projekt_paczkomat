void tempRead(void *pvParameters){
  for(;;){
    int odczyt = analogRead(tempPin);
    float napiecie = odczyt * (5.0/1023.0);

    float temperatura = napiecie * 100.0 - 10.0;

    Serial.println(temperatura);
    vTaskDelay(pdMS_TO_TICKS(1000));
  }
}