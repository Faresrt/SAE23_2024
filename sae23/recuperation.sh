#!/bin/bash

# MQTT Configuration
BROKER="mqtt.iut-blagnac.fr"
TOPIC1="AM107/by-room/E102/data"
TOPIC2="AM107/by-room/B111/data"
TOPIC3="AM107/by-room/E103/data"
TOPIC4="AM107/by-room/B112/data"

# Connection Variables
DB_HOST="localhost"
DB_USER="root"
DB_PASS="22207448"
DB_NAME="sae23"

# Function to insert data into MySQL
insertion_bd() {
    query="$1"
	echo ""
    echo "Executing query: $query"  # Imprime la requête avant l'exécution
	echo ""
	echo "------------------------------------------"
	echo ""
    echo "$query" | sudo /opt/lampp/bin/mysql -u "$DB_USER" -p"$DB_PASS" "$DB_NAME"

}

# Extracting temperature with jq
extraire() {
    # Extraction de la température avec jq
    temperature=$(echo "$1" | jq -r '.[0].temperature')
	echo "------------------------------------------"
	echo ""
    echo "temperature : $temperature"

    #Extract the device name with jq
    device_name=$(echo "$1" | jq -r '.[1].deviceName')
    echo "device name : $device_name"
	
    current_date=$(date +'%Y-%m-%d')
    current_time=$(date +'%H:%M:%S')
	
    # Build the insert query and call the function to perform the insertion
    query="INSERT INTO mesure (date_mesure, horaire, valeur, nom_capteur) VALUES ('$current_date', '$current_time', $temperature, '$device_name');"
    insertion_bd "$query"
}

# MQTT subscription function and processing of received messages
mqtt_subscribe() {
    # Subscribe to the first MQTT broker
    mosquitto_sub -h $BROKER -t $TOPIC1 | while read -r message; do
        extraire "$message"
    done &

    # Subscribe to the second MQTT broker
    mosquitto_sub -h $BROKER -t $TOPIC2 | while read -r message; do
        extraire "$message"
    done &

    # Subscribe to the third MQTT broker
    mosquitto_sub -h $BROKER -t $TOPIC3 | while read -r message; do
        extraire "$message"
    done &

    # Subscribe to the last MQTT broker
    mosquitto_sub -h $BROKER -t $TOPIC4 | while read -r message; do
        extraire "$message"
    done &
}

# Call the MQTT subscription function
mqtt_subscribe

wait

