import RPi.GPIO as GPIO
from RPLCD.gpio import CharLCD
import time
import threading
from flask import Flask

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)

# Piny sterujące
PIN_SMALL = 17
PIN_MEDIUM = 27
PIN_LARGE = 22

# Inicjalizacja pinów
for pin in [PIN_SMALL, PIN_MEDIUM, PIN_LARGE]:
    GPIO.setup(pin, GPIO.OUT)
    GPIO.output(pin, GPIO.LOW)

app = Flask(__name__)
lcd = None

# Zmienne do komunikacji między serwerem a ekranem
komunikat_specjalny = None
czas_wygasniecia_komunikatu = 0

def pobierz_temp_cpu():
    try:
        with open("/sys/class/thermal/thermal_zone0/temp", "r") as f:
            temp = int(f.read()) / 1000.0
        return temp
    except Exception:
        return 0.0

# wątek ekranu
def obsluga_lcd():
    global lcd, komunikat_specjalny, czas_wygasniecia_komunikatu
    
    lcd = CharLCD(numbering_mode=GPIO.BCM, 
                  pin_rs=26, pin_rw=None, pin_e=19, 
                  pins_data=[13, 6, 5, 11], cols=16, rows=2)
    lcd.clear()

    while True:
        if komunikat_specjalny and time.time() < czas_wygasniecia_komunikatu:
            lcd.cursor_pos = (0, 0)
            lcd.write_string("Otwarto:".ljust(16))
            lcd.cursor_pos = (1, 0)
            lcd.write_string(komunikat_specjalny.ljust(16)) 
        else:
            komunikat_specjalny = None
            lcd.cursor_pos = (0, 0)
            lcd.write_string("System gotowy".ljust(16))
            lcd.cursor_pos = (1, 0)
            lcd.write_string(f"Temp: {pobierz_temp_cpu():.1f}C".ljust(16))
            
        time.sleep(1)

# zamki
def otworz_zamek(pin, nazwa):
    global komunikat_specjalny, czas_wygasniecia_komunikatu
    
    # Przekazanie informacji do wątku ekranu (na 4 sekundy)
    komunikat_specjalny = nazwa
    czas_wygasniecia_komunikatu = time.time() + 4

    print(f"-> Otwieram: {nazwa}")
    
    # Impuls na mołstfet
    GPIO.output(pin, GPIO.HIGH)
    time.sleep(1) 
    GPIO.output(pin, GPIO.LOW)


# http
@app.route('/openLockerSmall', methods=['GET'])
def open_small():
    otworz_zamek(PIN_SMALL, "Mala szafka")
    return "OK", 200, {'Access-Control-Allow-Origin': '*'}

@app.route('/openLockerMedium', methods=['GET'])
def open_medium():
    otworz_zamek(PIN_MEDIUM, "Srednia szafka")
    return "OK", 200, {'Access-Control-Allow-Origin': '*'}

@app.route('/openLockerLarge', methods=['GET'])
def open_large():
    otworz_zamek(PIN_LARGE, "Duza szafka")
    return "OK", 200, {'Access-Control-Allow-Origin': '*'}

# uruchomienie
if __name__ == '__main__':
    try:
        watek_lcd = threading.Thread(target=obsluga_lcd, daemon=True)
        watek_lcd.start()
        
        # Uruchomienie na porcie ze starego projektu
        print("Serwer wystartowal na porcie 25565.")
        app.run(host='0.0.0.0', port=25565)
        
    finally:
        if lcd is not None:
            lcd.clear()
        GPIO.cleanup()
