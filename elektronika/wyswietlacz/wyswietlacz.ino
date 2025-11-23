#include <LiquidCrystal.h> 
#include "WiFiS3.h"

char ssid[] = "Galaxy S22 3E5E";
char pass[] = "kacper123";

WiFiServer server(25565);
LiquidCrystal lcd(5, 6, 7, 8, 9, 10); 

void klientEwa(){
  lcd.begin(16, 2); 
  lcd.setCursor(0, 0); 
  lcd.print("Nexbox"); 
  lcd.setCursor(0, 1); 
  lcd.print("Opening box"); 
}

void setup() {
  Serial.begin(115200);
  lcd.begin(16, 2); 
  lcd.setCursor(0, 0); 
  lcd.print("Waiting..."); 
  lcd.setCursor(0, 1); 
  lcd.print("Use website."); 

  Serial.println("Uruchomiono wyswietlacz");
  Serial.print("Uruchamianie polaczenia");
  WiFi.begin(ssid, pass);
  while(WiFi.status() != WL_CONNECTED){
    delay(500);
    Serial.print(".");
  }
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());

  server.begin();
}

void loop() {
    WiFiClient client = server.available();
  if (!client) return;

  while (!client.available()) {
    delay(1);
  }

  String req = client.readStringUntil('\r');
  Serial.println(req);

  // Analiza URL
  if (req.startsWith("GET /on")) {
    klientEwa();
  } 
  
  client.println("HTTP/1.1 200 OK");
  client.println("Content-Type: text/plain");
  client.println("Connection: close");
  client.println();
  client.println("OK");

  client.stop();
}
