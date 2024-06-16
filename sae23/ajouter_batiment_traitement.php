<?php

// Check if the form data has been submitted
if (isset($_POST['buildingName']) && isset($_POST['buildingLogin']) && isset($_POST['buildingPassword'])) {
    // Retrieve form data
    $buildingName = $_POST['buildingName'];
    $buildingLogin = $_POST['buildingLogin'];
    $buildingPassword = $_POST['buildingPassword'];

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

    // SQL query to insert the new building data
    $query = "INSERT INTO batiment (nom, login, mot_de_passe) VALUES ('$buildingName', '$buildingLogin', '$buildingPassword')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "The building has been successfully added.";
    } else {
        echo "Error adding the building: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Message if the form fields are not filled out
    echo "Please fill out all form fields.";
}
?>
