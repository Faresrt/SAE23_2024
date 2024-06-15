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

    try {
        // Connection to Database
        $conn = mysqli_connect($host, $username, $password, $dbname);

        
        //Check the connection
        if (!$conn) {
            die("Échec de la connexion à la base de données: " . mysqli_connect_error());
         } 

        // Query to check the connection information

        $query = "SELECT * FROM batiment WHERE login = '$login' AND mot_de_passe = '$mdp'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Check the manager's name to redirect to the correct page

            if ($login == "UserRT" && $mdp == "passRT") {
                header("Location: gestionE102-103.php");
                exit();
            } elseif ($login == "UserINFO" && $mdp == "passINFO") {
                header("Location: gestionB111-112.php");
                exit();
            } else {
                //Store the new user's name in the session

                $_SESSION['newUser'] = $login;
                header("Location: nvuser.php");
                exit();
            }
        } else {
            echo "Login ou mot de passe incorrect.";
        }

        mysqli_close($conn);
        // ORIENTE OBJET A ENLEVER
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }

// Processing the login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    // Query to verify credentials
    $query = "SELECT * FROM batiment WHERE login = '$login' AND mot_de_passe = '$mdp'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Checking the manager's name for redirection
        if ($login == "UserRT" && $mdp == "passRT") {
            header("Location: gestionE102-103.php");
            exit();
        } elseif ($login == "UserINFO" && $mdp == "passINFO") {
            header("Location: gestionB111-112.php");
            exit();
        } else {
            // Storing the new username in the session
            $_SESSION['newUser'] = $login;
            header("Location: nvuser.php");
            exit();
        }
    } else {
        echo "Login ou mot de passe incorrect.";
    }
}

// Close connection
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
