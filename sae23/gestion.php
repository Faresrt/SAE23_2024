<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/stylet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Gestion</title>
</head>
<body>
    <?php
    // Démarrer la session
    session_start();

    // Vérifier si le formulaire de connexion a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = "localhost";
        $dbname = "sae23";
        $login = $_POST["login"];
        $mdp = $_POST["mdp"];

        try {
            // Connexion à la base de données
            $conn = new PDO("mysql:host=$host;dbname=$dbname", "root", "22207448");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête pour vérifier les informations de connexion
            $query = "SELECT * FROM batiment WHERE login = :login AND mot_de_passe = :mdp";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":login", $login);
            $stmt->bindParam(":mdp", $mdp);
            $stmt->execute();

            // Vérifier si l'utilisateur existe
            if ($stmt->rowCount() > 0) {
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
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    ?>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h3>Login Here</h3>

        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required><br><br>

        <button>Log In</button>
    </form>
</body>
</html>
