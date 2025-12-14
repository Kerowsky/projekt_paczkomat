void showTime(void *pvParameters) {
  while(1){
    int sekundy = millis() / 1000;

    lcd.setCursor(0,1);
    lcd.print("Czas: ");
    lcd.print(sekundy);
    lcd.print(" s   "); 
                        
    
    vTaskDelay(100 / portTICK_PERIOD_MS);
  }
}