<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/styleMP.css">
    <title>Supprimer Bâtiment</title>
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
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password_db = "22207448";
        $dbname = "sae23";

        $conn = new mysqli($servername, $username, $password_db, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Échec de la connexion à la base de données: " . $conn->connect_error);
        }

        // Suppression de bâtiment si un ID est fourni
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buildingID'])) {
            $buildingID = $_POST['buildingID'];
            $query = "DELETE FROM batiment WHERE id_batiment = $buildingID";

            if ($conn->query($query) === TRUE) {
                echo "<p class='success'>Le bâtiment a été supprimé avec succès.</p>";
            } else {
                echo "<p class='error'>Erreur lors de la suppression du bâtiment: " . $conn->error . "</p>";
            }
        }

        // Requête pour récupérer les bâtiments
        $query = "SELECT * FROM batiment";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nom</th><th>Login</th><th>Mot de passe</th><th>Supprimer</th></tr>";
            while ($row = $result->fetch_assoc()) {
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

        $conn->close();
        ?>
    </section>
</body>
</html>
