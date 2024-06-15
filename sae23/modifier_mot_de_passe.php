<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/styleMP.css">
    <title>Modifier le mot de passe</title>
</head>
<body>
    <nav>
        <section class="heading">
            <h4>SAE23</h4>
        </section>
        <ul class="nav-links">
            <li><a href="intadmin.php">Administrateur</a></li>
            <li><a href="ajouter_batiment.php">Ajouter</a></li>
            <li><a href="liste_batiments.php">Supprimer</a></li>
            <li><a class="active" href="modifier_mot_de_passe.php">Modifier</a></li>
        </ul>
    </nav>
    <section id="first" class="centered-text">
        <h1>Modifier le mot de passe</h1>

        <?php
        session_start();
        if (isset($_SESSION['messageUser'])) {
            echo "<p class='success'>" . $_SESSION['messageUser'] . "</p>";
            unset($_SESSION['messageUser']);
        } elseif (isset($_SESSION['errorUser'])) {
            echo "<p class='error'>" . $_SESSION['errorUser'] . "</p>";
            unset($_SESSION['errorUser']);
        }
        
        // Database connection
        $servername = "localhost";
        $dbUsername = "root";
        $dbPassword = "22207448";
        $dbname = "sae23";

        $conn = mysqli_connect($servername, $username, $password_db, $dbname);
        
        // Check the connection
        if (!$conn) {
            die("Échec de la connexion à la base de données: " . mysqli_connect_error());
        } 
        

        // Retrieve the list of users (here, the logins of the buildings) ORIENTE OBJET
        $query = "SELECT login FROM batiment";
        $result = $conn->query($query);
        // ORIENTE OBJET
        if ($result->num_rows > 0) {
            echo '<form method="post" action="modifier_mot_de_passe_traitement.php">';
            echo '<label for="username">Choisir l\'utilisateur :</label>';
            echo '<select id="username" name="username" required>';
            //ORIENTE OBJET
            while($row = $result->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars($row["login"]) . '">' . htmlspecialchars($row["login"]) . '</option>';
            }
            echo '</select>';

            echo '<label for="newPassword">Nouveau mot de passe :</label>';
            echo '<input type="password" id="newPassword" name="newPassword" required>';

            echo '<input type="submit" value="Modifier le mot de passe">';
            echo '</form>';
        } else {
            echo "<p>Aucun utilisateur trouvé.</p>";
        }

        // Close connection
    mysqli_close($conn);
        ?>
    </section>
</body>
</html>
