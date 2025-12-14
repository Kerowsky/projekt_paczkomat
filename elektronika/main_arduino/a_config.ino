#include <Arduino.h>


// s - small, m - medium, b - big

const uint8_t errorIndicatorPin = LED_BUILTIN; // na razie led builtin
const uint8_t tempPin = A0;

//Kolejka do komunikacji main -> lockerControler
QueueHandle_t lockerQueue = nullptr;