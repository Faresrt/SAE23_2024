<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/stylet.css">
    <title>Accueil</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password_db = "22207448";
$dbname = "sae23";

// Connexion à la base de données en mode procédural
$conn = mysqli_connect($servername, $username, $password_db, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Échec de la connexion à la base de données: " . mysqli_connect_error());
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Échappement des caractères spéciaux pour éviter les injections SQL
        $login = mysqli_real_escape_string($conn, $login);
        $password = mysqli_real_escape_string($conn, $password);

        // Requête pour vérifier les identifiants
        $query = "SELECT * FROM administration WHERE login = '$login' AND mot_de_passe = '$password'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Redirection vers une autre page après connexion réussie
            header("Location: intadmin.php");
            exit();
        } else {
            echo "<p class='error'>Identifiants de connexion invalides.</p>";
        }
    }
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>

<div class="login-form">
    <h2>Connexion</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Log In</button>
    </form>
</div>

</body>
</html>
