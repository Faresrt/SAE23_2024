<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style1.css">
    <title>Accueil</title>
</head>

<body>

<?php
// Fonction pour se connecter à la base de données et récupérer les dernières valeurs des capteurs
function fetchLastSensorValues() {
    // Informations de connexion à la base de données
    $host = "localhost";
    $dbname = "sae23";
    $username = "root";
    $password = "22207448";

    // Connexion à la base de données
    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        echo "<p>Erreur : " . mysqli_connect_error() . "</p>";
        return false;
    }

    // Requête pour récupérer les dernières valeurs des capteurs de température pour les salles spécifiées
    $query = "
        SELECT s.nom AS nom_salle, c.nom_capteur, m.valeur, m.date_mesure, m.horaire
        FROM mesure m
        JOIN capteur c ON m.nom_capteur = c.nom_capteur
        JOIN salle s ON c.id_salle = s.id_salle
        WHERE s.nom IN ('E102', 'E103', 'B111', 'B112')
        AND c.type_capteur = 'temperature'
        ORDER BY m.date_mesure DESC, m.horaire DESC
    ";

    // Tableau pour stocker les dernières valeurs par capteur
    $last_values = array();

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Parcourir les résultats et récupérer uniquement la dernière valeur par capteur
        while ($row = mysqli_fetch_assoc($result)) {
            $capteur = $row['nom_capteur'];

            // Si le capteur n'est pas encore dans le tableau, ajouter sa valeur
            if (!isset($last_values[$capteur])) {
                $last_values[$capteur] = $row;
            }
        }

        // Fermer la requête
        mysqli_free_result($result);
    } else {
        echo "<p>Erreur : " . mysqli_error($conn) . "</p>";
    }

    // Fermer la connexion
    mysqli_close($conn);

    return $last_values;
}

// Récupérer les dernières valeurs des capteurs
$last_values = fetchLastSensorValues();

// Afficher les résultats dans le HTML
?>
<nav>
    <section class="heading">
        <h4>SAE23</h4>
    </section>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="gestion.php">Gestion</a></li>
        <li><a href="administration.php">Admin</a></li>
        <li><a class="active" href="consultation.php">Consultation</a></li>
        <li><a href="gestion_projet.php">Projet</a></li>
    </ul>
</nav>

<center>
    <section class="container">
        <?php
        if ($last_values) {
            echo "<table>";
            echo "<tr><th>Salle</th><th>Capteur</th><th>Valeur</th><th>Date</th><th>Horaire</th></tr>";
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
