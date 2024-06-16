<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="styles/styleMP.css" />
    <title>Supprimer Bâtiment et Capteur</title>
   
</head>
<body>
    <nav>
        <section class="heading">
            <h4>SAE23</h4>
        </section>
        <ul class="nav-links">
            <li><a href="intadmin.php">Administrateur</a></li>
            <li><a href="ajouter_batiment.php">Ajouter</a></li>
            <li><a class="active" href="supprimer_batiment.php">Supprimer</a></li>
            <li><a href="modifier_mot_de_passe.php">Modifier</a></li>
        </ul>
    </nav>
    <section id="first" class="centered-text">
        <h1>Liste des bâtiments</h1>

        <?php
		// Connection parameters for the database
        $servername = "localhost";
        $username = "root";
        $password_db = "22207448";
        $dbname = "sae23";

        // Connect to the database
        $conn = mysqli_connect($servername, $username, $password_db, $dbname);

        // Check connection
        if (!$conn) {
            die("Échec de la connexion à la base de données: " . mysqli_connect_error());
        }

        // Delete building if ID is provided via POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buildingID'])) {
            $buildingID = $_POST['buildingID'];
            $query = "DELETE FROM batiment WHERE id_batiment = $buildingID";

            if (mysqli_query($conn, $query)) {
                echo "<p class='success'>Le bâtiment a été supprimé avec succès.</p>";
            } else {
                echo "<p class='error'>Erreur lors de la suppression du bâtiment: " . mysqli_error($conn) . "</p>";
            }
        }

        // Requête pour récupérer les bâtiments
        $query = "SELECT * FROM batiment";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nom</th><th>Login</th><th>Mot de passe</th><th>Supprimer</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id_batiment'] . "</td>";
                echo "<td>" . $row['nom'] . "</td>";
                echo "<td>" . $row['login'] . "</td>";
                echo "<td>" . $row['mot_de_passe'] . "</td>";
                echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='buildingID' value='" . $row['id_batiment'] . "'>
                        <input type='submit' value='Supprimer'>
                    </form>
                </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucun bâtiment trouvé.</p>";
        }
        ?>

        <h1>Liste des Capteurs</h1>

        <?php
        // Sensor deletion if an ID is provided
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['SensorID'])) {
            $SensorID = $_POST['SensorID'];
            $query = "DELETE FROM capteur WHERE id_capteur = $SensorID";

            if (mysqli_query($conn, $query)) {
                echo "<p class='success'>Le capteur a été supprimé avec succès.</p>";
            } else {
                echo "<p class='error'>Erreur lors de la suppression du capteur: " . mysqli_error($conn) . "</p>";
            }
        }

        // Query to fetch sensors
        $query = "SELECT * FROM capteur";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nom du capteur</th><th>Type</th><th>Unité</th><th>ID Salle</th><th>Supprimer</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id_capteur'] . "</td>";
                echo "<td>" . $row['nom_capteur'] . "</td>";
                echo "<td>" . $row['type_capteur'] . "</td>";
                echo "<td>" . $row['unite'] . "</td>";
                echo "<td>" . $row['id_salle'] . "</td>";
                echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='SensorID' value='" . $row['id_capteur'] . "'>
                        <input type='submit' value='Supprimer'>
                    </form>
                </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucun capteur trouvé.</p>";
        }

        // Closing the database connection
        mysqli_close($conn);
        ?>
    </section>
</body>
</html>
