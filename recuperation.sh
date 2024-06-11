#!/bin/bash

# Configuration MQTT
BROKER="mqtt.iut-blagnac.fr"
TOPIC1="AM107/by-room/E101/data"
TOPIC2="AM107/by-room/B101/data"
TOPIC3="AM107/by-room/E102/data"
TOPIC4="AM107/by-room/B111/data"

# Configuration MySQL (via PHPMyAdmin)
DB_HOST="localhost"       # Adresse du serveur MySQL
DB_USER="root"    # Nom d'utilisateur de la base de données
DB_PASSWORD="22207448"
TABLE_NAME="sae23" # Nom de la table

# Fonction pour insérer les données dans MySQL
insertion_bd() {
    query="$1"
	echo "$query" | sudo /opt/lampp/bin/mysql -u "$DB_USER" -p"$DB_PASSWORD" "$TABLE_NAME"
}

#Fonction pour extraire les données de temperature et nom du capteur
extraire() {

# Extraction de la température avec jq
    temperature=$(echo $1 | jq -r '.[0].temperature')
    echo "temperature : $temperature"

# Extraire le device name avec jq
    device_name=$(echo $1 | jq -r '.[1].deviceName')
    echo "nom de capteur : $device_name"
	
	current_date=$(date +"%Y-%m-%d")
	current_time=$(date +"%H:%M")
	
	query="INSERT INTO mesure (date_mesure, horaire, valeur, nom) VALUES ('$current_date', '$current_time', $temperature, '$device_name');"
	insertion_bd "$query"
}

recuperation_complete() {
recuperation_E208
recuperation_B101
recuperation_E207
recuperation_B111
}

recuperation_E208() {
# S'abonner au topic MQTT et traiter les messages reçus de la salle E101
mosquitto_sub -h $BROKER -t $TOPIC1 | while read -r message
do
    echo "Message reçu : $message"
    extraire "$message"
done
}

recuperation_B101() {
# S'abonner au topic MQTT et traiter les messages reçus de la salle B101
mosquitto_sub -h $BROKER -t $TOPIC2 | while read -r message
do
    echo "Message reçu : $message"
    extraire "$message"
done
}

recuperation_E207() {
# S'abonner au topic MQTT et traiter les messages reçus de la salle E102
mosquitto_sub -h $BROKER -t $TOPIC3 | while read -r message
do
    echo "Message reçu : $message"
    extraire "$message"
done
}

recuperation_B111() {
# S'abonner au topic MQTT et traiter les messages reçus de la salle B111
mosquitto_sub -h $BROKER -t $TOPIC4 | while read -r message
do
    echo "Message reçu : $message"
    extraire "$message"
done
}

recuperation_complete
