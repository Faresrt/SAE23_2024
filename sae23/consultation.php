<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style1.css">
    <title>Home</title>
</head>

<body>

<?php
// Function to connect to the database and retrieve the latest sensor values
function fetchLastSensorValues() {
    // Database connection information
    $host = "localhost";
    $dbname = "sae23";
    $username = "root";
    $password = "22207448";

    // Connect to the database
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check the connection
    if (!$conn) {
        echo "<p>Error: " . mysqli_connect_error() . "</p>";
        return false;
    }

    // SQL query to get the latest temperature sensor values for specific rooms
    $query = "
        SELECT s.nom AS nom_salle, c.nom_capteur, m.valeur, m.date_mesure, m.horaire
        FROM mesure m
        JOIN capteur c ON m.nom_capteur = c.nom_capteur
        JOIN salle s ON c.id_salle = s.id_salle
        WHERE s.nom IN ('E102', 'E103', 'B111', 'B112')
        AND c.type_capteur = 'temperature'
        ORDER BY m.date_mesure DESC, m.horaire DESC
    ";

    // Array to store the latest values per sensor
    $last_values = array();

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check for query execution errors
    if ($result) {
        // Loop through the results and retrieve only the latest value per sensor
        while ($row = mysqli_fetch_assoc($result)) {
            $capteur = $row['nom_capteur'];

            // If sensor is not already in the array, add its value
            if (!isset($last_values[$capteur])) {
                $last_values[$capteur] = $row;
            }
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }

    // Close the database connection
    mysqli_close($conn);

    return $last_values;
}

// Retrieve the latest sensor values
$last_values = fetchLastSensorValues();

// Display the results in the HTML
?>
<nav>
    <section class="heading">
        <h4>SAE23</h4>
    </section>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="gestion.php">Management</a></li>
        <li><a href="administration.php">Admin</a></li>
        <li><a class="active" href="consultation.php">Consultation</a></li>
        <li><a href="gestion_projet.php">Project</a></li>
    </ul>
</nav>

<center>
    <section class="container">
        <?php
        // Check if the latest values are available and display them in a table
        if ($last_values) {
            echo "<table>";
            echo "<tr><th>Room</th><th>Sensor</th><th>Value</th><th>Date</th><th>Time</th></tr>";
            foreach ($last_values as $value) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($value['nom_salle']) . "</td>";
                echo "<td>" . htmlspecialchars($value['nom_capteur']) . "</td>";
                echo "<td>" . htmlspecialchars($value['valeur']) . " °C</td>";
                echo "<td>" . htmlspecialchars($value['date_mesure']) . "</td>";
                echo "<td>" . htmlspecialchars($value['horaire']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </section>
</center>

</body>

</html>
