from flask import Flask, render_template, Response, request, send_from_directory
from camera import VideoCamera
import picamera
import os
import RPi.GPIO as GPIO
from markupsafe import Markup as markup
import time

password = markup('"3Enc3AH42Cxb"')
etat_capt = 0
photo = markup("/static/carre_rouge.jpg")
display = markup('"display: none;"')
pi_camera = VideoCamera(flip=False) # flip pi camera if upside down.


app = Flask(__name__)

@app.route('/')
def index():
    var = render_template('index.html',  photo=photo, display=display, password=password)
    print(var)
    return var

def gen(camera):
    #get camera frame
    while True:
        frame = camera.get_frame()
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n\r\n')

@app.route('/video_feed')
def video_feed():
    return Response(gen(pi_camera),
                    mimetype='multipart/x-mixed-replace; boundary=frame')

# Take a photo when pressing camera button
@app.route('/picture')
def take_picture():
    pi_camera.take_picture()
    return "None"

@app.route('/allumer') 
def allumer():
    global photo 
    photo = markup("/static/carre_vert.jpg")
    set_etat(1)
    return "None"

@app.route('/eteint') 
def eteint():

    global photo 
    photo = markup("/static/carre_rouge.jpg")
    set_etat(0)
    return "None"

@app.route('/mouvement')
def mvmt_cap():
    print("l'état est:" + str(etat_capt))
    counter = 0
    
    if etat_capt == 0:
        return "None"
    
    if etat_capt == 1:
        GPIO.setmode(GPIO.BCM)
        GPIO.setwarnings(False)
        capteur = 23
        GPIO.setup(capteur, GPIO.IN)
        print("Demarrage du capteur")
        time.sleep(2)
        print("Capteur pret a detecte un mouvement")
    
    while etat_capt == 1:
        if GPIO.input(capteur):
            counter = counter + 1
            print("Mouvement detecte")
            if counter == 3:
                take_picture()
                counter = 0
        time.sleep(0.1)
    return "None"

@app.route('/on_stream') 
def on_stream():
    global display
    display = markup('"display: block;"')  
    return "None"

@app.route('/off_stream') 
def off_stream():
    global display
    display = markup('"display: none;"')  
    return "None"


    
def set_etat(etat):
    global etat_capt
    etat_capt = etat
    return "None"
    
if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=False)
