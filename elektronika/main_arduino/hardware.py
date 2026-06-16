import RPi.GPIO as GPIO # to trzeba na RPi pobrać
from RPLCD.gpio import CharLCD
import time
import threading

# piny do mostfetów
# BCM 17 to fizyczny pin 11 na płytce Raspberry Pi
PIN_SMALL = 22
# BCM 27 to fizyczny pin 13 na płytce Raspberry Pi
PIN_MEDIUM = 27
# BCM 22 to fizyczny pin 15 na płytce Raspberry Pi
PIN_LARGE = 17

# Zmienne globalne do synchronizacji tekstu na ekranie
lcd = None
komunikat_specjalny = None
czas_wygasniecia_komunikatu = 0

def init_hardware():
    #Inicjalizuje piny GPIO oraz uruchamia wątek ekranu LCD.
    global lcd
    GPIO.setwarnings(False)
    GPIO.setmode(GPIO.BCM)

    # Konfiguracja wyjść dla szafek
    for pin in [PIN_SMALL, PIN_MEDIUM, PIN_LARGE]:
        GPIO.setup(pin, GPIO.OUT)
        GPIO.output(pin, GPIO.LOW)

    # Uruchomienie wątku LCD w tle
    watek_lcd = threading.Thread(target=obsluga_lcd, daemon=True)
    watek_lcd.start()


def obsluga_lcd():
    #Pętla zarządzająca wyświetlaczem LCD, działająca w osobnym wątku.
    global lcd, komunikat_specjalny, czas_wygasniecia_komunikatu

    # Inicjalizacja ekranu zgodnie ze sprawdzoną konfiguracją GPIO BCM
    lcd = CharLCD(numbering_mode=GPIO.BCM,
                  pin_rs=26, pin_rw=None, pin_e=19,
                  pins_data=[13, 6, 5, 11], cols=16, rows=2)
    lcd.clear()

    while True:
        # Sprawdzenie czy jest aktywny komunikat o otwarciu skrytki
        if komunikat_specjalny and time.time() < czas_wygasniecia_komunikatu:
            lcd.cursor_pos = (0, 0)
            lcd.write_string("Opening:        ")
            lcd.cursor_pos = (1, 0)
            # ljust(16) automatycznie dopełnia tekst spacjami, czyszcząc stare znaki
            lcd.write_string(komunikat_specjalny.ljust(16))
        else:
            # Stan spoczynku - wyświetlanie domyślnego powitania
            komunikat_specjalny = None
            lcd.cursor_pos = (0, 0)
            lcd.write_string("    NEXTBOX     ")
            lcd.cursor_pos = (1, 0)
            lcd.write_string("Have a nice day!")

        time.sleep(0.5)

def otworz_zamek(pin, nazwa):
    global komunikat_specjalny, czas_wygasniecia_komunikatu

    # Ustawienie komunikatu dla ekranu LCD na 6 sekund
    komunikat_specjalny = nazwa
    czas_wygasniecia_komunikatu = time.time() + 6

    print(f"-> Otwieram: {nazwa} (GPIO BCM: {pin})")

    # Wysterowanie mołstFET
    GPIO.output(pin, GPIO.HIGH)
    time.sleep(0.1)
    GPIO.output(pin, GPIO.LOW)

def cleanup():
    if lcd is not None:
        try:
            lcd.clear()
        except:
            pass
    GPIO.cleanup()