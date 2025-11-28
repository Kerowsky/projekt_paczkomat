#include <Arduino.h>


// s - small, m - medium, b - big
const uint8_t sLockerPin = 3;
const uint8_t mLockerPin = 4;
const uint8_t bLockerPin = 5;
const uint8_t errorIndicatorPin = LED_BUILTIN; // na razie led builtin

//Kolejka do komunikacji main -> lockerControler
QueueHandle_t lockerQueue = nullptr;