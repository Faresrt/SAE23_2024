<?php
session_start(); // Start the session at the beginning of the script


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $newPassword = $_POST["newPassword"];

    // Database connection

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "22207448";
    $dbname = "sae23";

    // Database connection
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

    // Check the connection
    
    if (!$conn) {
        die("Échec de la connexion à la base de données: " . mysqli_connect_error());
    }

    // Prepare the query to update the password

    $query = "UPDATE batiment SET mot_de_passe = ? WHERE login = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind the parameters

        mysqli_stmt_bind_param($stmt, "ss", $newPassword, $username);

        // Execute the query

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['messageUser'] = "Le mot de passe de $username a été modifié avec succès.";
        } else {
            $_SESSION['errorUser'] = "Erreur lors de la modification du mot de passe de $username: " . mysqli_stmt_error($stmt);
        }

        // Close the prepared statement

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['errorUser'] = "Erreur de préparation de la requête: " . mysqli_error($conn);
    }

    // Close the database connection

    mysqli_close($conn);

    // Redirect to the modification page

    header("Location: modifier_mot_de_passe.php");
    exit();
}
?>
