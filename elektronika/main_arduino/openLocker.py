import RPi.GPIO as GPIO
import time
import queue
import threading

lockerQueue = queue.Queue()
lcdQueue = queue.Queue()

sLockerPin = 17 
mLockerPin = 27 
bLockerPin = 22 

def openLocker():
    while True:
        receivedPin = lockerQueue.get() 
        
        if receivedPin == 1:
            print("-> Otwieram mala szafke")
            
            with lcdQueue.mutex:
                lcdQueue.queue.clear()
            lcdQueue.put(1)
            
            time.sleep(0.005)
            GPIO.output(sLockerPin, GPIO.HIGH)
            time.sleep(1)   # Czas otwarcia wydłużony do 1 sekundy
            GPIO.output(sLockerPin, GPIO.LOW)

        elif receivedPin == 2:
            print("-> Otwieram srednia szafke")
            
            with lcdQueue.mutex:
                lcdQueue.queue.clear()
            lcdQueue.put(2)
            
            time.sleep(0.005)
            GPIO.output(mLockerPin, GPIO.HIGH)
            time.sleep(1) 
            GPIO.output(mLockerPin, GPIO.LOW)

        elif receivedPin == 3:
            print("-> Otwieram duza szafke")
            
            with lcdQueue.mutex:
                lcdQueue.queue.clear()
            lcdQueue.put(3)
            
            time.sleep(0.005)
            GPIO.output(bLockerPin, GPIO.HIGH)
            time.sleep(1)   # Czas otwarcia wydłużony do 1 sekundy
            GPIO.output(bLockerPin, GPIO.LOW)
        
        lockerQueue.task_done()
