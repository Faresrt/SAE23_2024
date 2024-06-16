<?php
session_start();

// Check if the user is logged in as an administrator
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
        // Redirect to the login page if not logged in
    header("Location: administration.php");
    exit();
}

// Logout handling
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        // Unset all session variables
    session_unset();

        // Destroy the session
    session_destroy();

        // Redirect to the home page after logout
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style1.css">
    <title>Administrateur</title>
</head>
<body>
    <nav>
        <section class="heading">
            <h4>SAE23</h4>
        </section>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a class="active" href="intadmin.php">Administrateur</a></li>
            <li><a href="ajouter_batiment.php">Ajouter</a></li>
            <li><a href="liste_batiments.php">Supprimer</a></li>
            <li><a href="modifier_mot_de_passe.php">Modifier</a></li>
            <li><a href="intadmin.php?action=logout">Déconnexion</a></li>
        </ul>
    </nav>

    <section id="first" class="centered-text">
        <h2>Bienvenue dans l'espace administrateur</h2>
        <table class="ptitable">
            <tr>
                <th>Privilèges</th>
            </tr>
            <tr>
                <td>Consulter la liste des bâtiments enregistrés dans la base de données</td>             
            </tr>
            <tr>
                <td>Ajouter des bâtiments dans la base de données</td>
            </tr>
            <tr>
                <td>Modifier et/ou supprimer des utilisateurs</td>
            </tr>
        </table>
    </section>
</body>
</html>
