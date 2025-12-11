void tempRead(void *pvParameters){
  const uint8_t simulate = simulateTempRead;
  for(;;){
    int odczyt;
    float napiecie;
    float temperatura;
    switch(simulate){
      case 0:
          odczyt = analogRead(tempPin);
          napiecie = odczyt * (5.0/1023.0);

          temperatura = napiecie * 100.0 - 10.0;
          vTaskDelay(pdMS_TO_TICKS(500));
          Serial.println(temperatura);
          break;
        case 1: //Tryb symulowanego nadawania (do testu kolejek i strony internetowej)
            temperatura = 20.0 + (random(0, 50) / 10.0);
            xQueueOverwrite(tempQueue, &temperatura);
            vTaskDelay(pdMS_TO_TICKS(500));
        break;
    }
  }
}