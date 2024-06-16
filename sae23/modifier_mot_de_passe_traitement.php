<?php
session_start(); // Session start

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $newPassword = $_POST["newPassword"];

    // Database connection info
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "22207448";
    $dbname = "sae23";

    // Database connection
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

    // Checking the connection
    if (!$conn) {
        die("Échec de la connexion à la base de données: " . mysqli_connect_error());
    }

    // Preparing the query to update the password
    $query = "UPDATE batiment SET mot_de_passe = ? WHERE login = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        
        mysqli_stmt_bind_param($stmt, "ss", $newPassword, $username);

        // Executing the query
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['messageUser'] = "Le mot de passe de $username a été modifié avec succès.";
        } else {
            $_SESSION['errorUser'] = "Erreur lors de la modification du mot de passe de $username: " . mysqli_stmt_error($stmt);
        }

        // Closing the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['errorUser'] = "Erreur de préparation de la requête: " . mysqli_error($conn);
    }

    // Closing the database connection
    mysqli_close($conn);

    // Redirecting to the modification page
    header("Location: modifier_mot_de_passe.php");
    exit();
}
?>
