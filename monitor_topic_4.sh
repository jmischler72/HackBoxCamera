#!/bin/bash

# Configuration
NODE_RED_IP="192.168.1.4"
NODE_RED_TOPIC="global_security_level"
MQTT_ADMIN="admin"
MQTT_PASSWD="password"

previous_value=$(mosquitto_pub -h $NODE_RED_IP -t $NODE_RED_TOPIC -u $MQTT_ADMIN -P $MQTT_PASSWD -m "init")


# Boucle principale
while true; do
  # Récupérer la valeur actuelle du topic depuis Node-RED
  current_value=$(mosquitto_sub -h $NODE_RED_IP -t $NODE_RED_TOPIC -C 1 -u $MQTT_ADMIN -P $MQTT_PASSWD)

  # Vérifier si la valeur a changé
  if [[ "$current_value" != "$previous_value" ]]; then
    echo "La valeur du topic a changé : $current_value"

    # Enregistrer la nouvelle valeur comme précédente
    previous_value="$current_value"

    # Définir la variable d'environnement pour le niveau de sécurité
    export SECURITY_LEVEL="$current_value"

    # Exécuter le script de modification de configuration Apache
    /opt/restart_apache.sh
  fi

  # Attendre pendant 1 seconde avant de vérifier à nouveau
  sleep 1
done
