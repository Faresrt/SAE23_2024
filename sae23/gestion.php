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

// Fonction pour se connecter à la base de données et vérifier les informations de connexion
function checkLogin($login, $mdp) {
    $host = "localhost";
    $dbname = "sae23";
    $username = "root";
    $password = "22207448";

    try {
        // Connexion à la base de données
        $conn = mysqli_connect($host, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Échapper les valeurs pour éviter les injections SQL
        $login = mysqli_real_escape_string($conn, $login);
        $mdp = mysqli_real_escape_string($conn, $mdp);

        // Requête pour vérifier les informations de connexion
        $query = "SELECT * FROM batiment WHERE login = '$login' AND mot_de_passe = '$mdp'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Vérifier le nom du gestionnaire pour rediriger vers la bonne page
            if ($login == "UserRT" && $mdp == "passRT") {
                header("Location: gestionE102-103.php");
                exit();
            } elseif ($login == "UserINFO" && $mdp == "passINFO") {
                header("Location: gestionB111-112.php");
                exit();
            } else {
                // Stocker le nom du nouvel utilisateur dans la session
                $_SESSION['newUser'] = $login;
                header("Location: nvuser.php");
                exit();
            }
        } else {
            echo "Login ou mot de passe incorrect.";
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];
    
    // Appeler la fonction pour vérifier les informations de connexion
    checkLogin($login, $mdp);
}
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
