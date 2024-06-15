<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/stylet.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Gestion</title>
</head>

<body>

<?php
session_start();

$host = "localhost";
$dbname = "sae23";
$username = "root";
$password = "22207448";

// Connexion à la base de données en mode procédural
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Échec de la connexion à la base de données: " . mysqli_connect_error());
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

   
    // Requête pour vérifier les identifiants
    $query = "SELECT * FROM batiment WHERE login = '$login' AND mot_de_passe = '$mdp'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Vérification du nom du gestionnaire pour redirection
        if ($login == "UserRT" && $mdp == "passRT") {
            header("Location: gestionE102-103.php");
            exit();
        } elseif ($login == "UserINFO" && $mdp == "passINFO") {
            header("Location: gestionB111-112.php");
            exit();
        } else {
            // Stocker le nouveau nom d'utilisateur dans la session
            $_SESSION['newUser'] = $login;
            header("Location: nvuser.php");
            exit();
        }
    } else {
        echo "Login ou mot de passe incorrect.";
    }
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>

<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h3>Login Here</h3>

    <label for="login">Login :</label>
    <input type="text" id="login" name="login" required><br><br>

    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required><br><br>

    <button type="submit">Log In</button>
</form>

</body>

</html>
