from flask import Flask
import hardware as hw

app = Flask(__name__)

@app.route('/openLockerSmall', methods=['GET'])
def open_small():
    hw.otworz_zamek(hw.PIN_SMALL, "Small box")
    return "OK", 200, {'Access-Control-Allow-Origin': '*'}

@app.route('/openLockerMedium', methods=['GET'])
def open_medium():
    hw.otworz_zamek(hw.PIN_MEDIUM, "Medium box")
    return "OK", 200, {'Access-Control-Allow-Origin': '*'}

@app.route('/openLockerLarge', methods=['GET'])
def open_large():
    hw.otworz_zamek(hw.PIN_LARGE, "Large box")
    return "OK", 200, {'Access-Control-Allow-Origin': '*'}

if __name__ == '__main__':
    try:
        # 1. Inicjalizacja podłączeń i start wątku LCD
        hw.init_hardware()

        print("Serwer HTTP wystartował na porcie 25565. Oczekiwanie na żądania...")
        # 2. Uruchomienie serwera sieciowego na porcie z kodu Arduino
        app.run(host='0.0.0.0', port=25565)

    finally:
        # 3. Wywoła się automatycznie przy zatrzymaniu programu w Thonny
        print("\nZamykanie serwera. Czyszczenie GPIO...")
        hw.cleanup()