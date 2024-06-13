<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="styles/stylet.css" />
    <title>Accueil</title>
</head>

<body>
   

    <?php
    // Verify administrator authentication
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password_db = "22207448";
        $dbname = "sae23";

        $conn = new mysqli($servername, $username, $password_db, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Échec de la connexion à la base de données: " . $conn->connect_error);
        }

        // Verify admin login credentials
        $query = "SELECT * FROM administration WHERE login = '$login' AND mot_de_passe = '$password'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            // Redirection to another page
            header("Location: intadmin.php");
            exit();
        } else {
            echo "<p class='error'>Identifiants de connexion invalides.</p>";
        }

        $conn->close();
    }

    // Login form
    echo '
    <div class="login-form">
    <h2>Connexion</h2>
    <form method="post" action="">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>

        <button>Log In</button>
    </form>
    </div>
    ';
    ?>
</body>

</html>

