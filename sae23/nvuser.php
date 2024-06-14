<?php
session_start();

if (!isset($_SESSION['newUser'])) {
    header("Location: gestion.php");
    exit();
}
$newUser = $_SESSION['newUser'];
unset($_SESSION['newUser']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/stylet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Bienvenue</title>
    <style>
        /* Ajoutez ces styles pour le débogage */
        body {
            background-color: #f0f0f0; /* Changez la couleur d'arrière-plan pour voir si c'est le CSS qui pose problème */
            color: #333; /* Assurez-vous que le texte est visible */
            font-family: 'Poppins', sans-serif;
        }
        .centered-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
    </style>
</head>
<body>
    <section class="centered-text">
        <h1>BIENVENUE <?php echo htmlspecialchars($newUser); ?>!</h1>
    </section>
</body>
</html>
