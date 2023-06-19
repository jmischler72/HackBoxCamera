# HackBoxCamera

## Dépendances
- Apache2
- Php
- PhpMyAdmin
- Python3 / Pip
- Mariadb

## Dépendances de Python
- Flask
- OpenCV
-> `pip3 install opencv-python`
-> Si vous avez une erreur du type : ImportError: libGL.so.1: cannot open shared object file: No such file or directory
  -> `sudo apt update && sudo apt install ffmpeg libsm6 libxext6  -y`
- imutils -> `pip3 install imutils`
- picamera -> normalement c'est déjà présent sur Raspberry Pi mais il existe un paquet Pip si vous avez une erreur

## Répertoires
- Placer les dossiers de Website dans /var/www/html
- Placer monitor_topic.service et FlaskProjet.service dans /etc/systemd/system
- Placer monitor_topic_4.sh dans /opt
