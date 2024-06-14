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

    // Connexion à la base de données en mode procédural
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

    // Vérifier la connexion
    if (!$conn) {
        die("Échec de la connexion à la base de données: " . mysqli_connect_error());
    }

    // Préparer la requête pour mettre à jour le mot de passe
    $query = "UPDATE batiment SET mot_de_passe = ? WHERE login = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Binder les paramètres
        mysqli_stmt_bind_param($stmt, "ss", $newPassword, $username);

        // Exécuter la requête
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['messageUser'] = "Le mot de passe de $username a été modifié avec succès.";
        } else {
            $_SESSION['errorUser'] = "Erreur lors de la modification du mot de passe de $username: " . mysqli_stmt_error($stmt);
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['errorUser'] = "Erreur de préparation de la requête: " . mysqli_error($conn);
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);

    // Redirection vers la page de modification
    header("Location: modifier_mot_de_passe.php");
    exit();
}
?>
