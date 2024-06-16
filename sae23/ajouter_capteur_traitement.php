<?php

// Check if the form data has been submitted
if (isset($_POST['SensorName']) && isset($_POST['SensorType']) && isset($_POST['SensorRoom'])) {
    // Retrieve form data
    $SensorName = $_POST['SensorName'];
    $SensorType = $_POST['SensorType'];
    $SensorRoom = $_POST['SensorRoom'];

    // Database connection information
    $servername = "localhost";
    $username = "root";
    $password_db = "22207448";
    $dbname = "sae23";

    // Connect to the database
    $conn = mysqli_connect($servername, $username, $password_db, $dbname);

    // Check the connection
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Determine the sensor unit based on the type
    if ($SensorType == 'Temperature') {
        $SensorUnite = 'celsius';
    } elseif ($SensorType == 'CO2' || $SensorType == 'Humidite') {
        $SensorUnite = '%';
    } elseif ($SensorType == 'Luminosite') {
        $SensorUnite = 'lx';
    } else {
        $SensorUnite = ''; // Set a default value or handle other cases
    }

    // SQL query to get the room ID
    $query_RoomID = "SELECT id_salle FROM salle WHERE nom = '$SensorRoom'";
    $result_RoomID = mysqli_query($conn, $query_RoomID);

    // Check for query execution errors
    if (!$result_RoomID) {
        die("Error retrieving room ID: " . mysqli_error($conn));
    }

    // Check if any results were returned
    if (mysqli_num_rows($result_RoomID) > 0) {
        // Fetch the first row of results
        $row = mysqli_fetch_assoc($result_RoomID);
        $RoomID = $row['id_salle'];

        // SQL query to insert the new sensor data
        $query = "INSERT INTO capteur (nom_capteur, type_capteur, unite, id_salle) VALUES ('$SensorName', '$SensorType', '$SensorUnite', '$RoomID')";

        // Execute the insert query
        if (mysqli_query($conn, $query)) {
            echo "The sensor has been successfully added.";
        } else {
            echo "Error adding the sensor: " . mysqli_error($conn);
        }
    } else {
        // No room found with the specified name
        echo "No room found with the specified name: $SensorRoom";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Message if form fields are not filled out
    echo "Please fill out all form fields.";
}
?>
