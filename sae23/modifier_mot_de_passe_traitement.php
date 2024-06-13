<?php
session_start(); // Démarrer la session en début de script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $newPassword = $_POST["newPassword"];

    // Connexion à la base de données
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "22207448";
    $dbname = "sae23";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données: " . $conn->connect_error);
    }

    // Mettre à jour le mot de passe dans la base de données
    $query = "UPDATE batiment SET mot_de_passe = ? WHERE login = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ss", $newPassword, $username);

        if ($stmt->execute()) {
            $_SESSION['messageUser'] = "Le mot de passe de $username a été modifié avec succès.";
        } else {
            $_SESSION['errorUser'] = "Erreur lors de la modification du mot de passe de $username: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['errorUser'] = "Erreur de préparation de la requête: " . $conn->error;
    }

    $conn->close();

    // Redirection vers la page de modification
    header("Location: modifier_mot_de_passe.php");
    exit();
}
?>
