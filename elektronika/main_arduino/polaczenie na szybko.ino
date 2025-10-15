#include <WiFiS3.h>

const char* ssid = "Galaxy S22 3E5E";
const char* password = "xd";

WiFiServer server(25565);
const int ledPin = 13; // lub inny pin, gdzie masz LED

void setup() {
  Serial.begin(115200);
  pinMode(ledPin, OUTPUT);
  WiFi.begin(ssid, password);

  Serial.print("Łączenie z WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nPołączono!");
  Serial.print("Adres IP: ");
  Serial.println(WiFi.localIP());

  server.begin();
  Serial.println("Serwer uruchomiony na porcie 25565");
}

void loop() {
  WiFiClient client = server.available();
  if (!client) return;

  // Oczekiwanie na dane
  while (client.connected() && !client.available()) delay(1);

  String request = client.readStringUntil('\r');
  Serial.println(request);

  // 🔍 Sprawdzenie zapytania
  if (request.indexOf("/open") != -1) {
    digitalWrite(ledPin, HIGH);
    Serial.println("➡️ Otwieram box 1 (LED ON)");
  } else if (request.indexOf("/close") != -1) {
    digitalWrite(ledPin, LOW);
    Serial.println("⬅️ Zamykam box 1 (LED OFF)");
  }

  // 🔁 Odpowiedź HTTP
  client.println("HTTP/1.1 200 OK");
  client.println("Content-Type: text/html");
  client.println("Connection: close");
  client.println();
  client.println("<h1>OK</h1>");
  client.stop();
}
