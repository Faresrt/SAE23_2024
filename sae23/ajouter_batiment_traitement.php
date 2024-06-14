<?php

if (isset($_POST['buildingName']) && isset($_POST['buildingLogin']) && isset($_POST['buildingPassword'])) {
    // Récup les données du formulaire
    $buildingName = $_POST['buildingName'];
    $buildingLogin = $_POST['buildingLogin'];
    $buildingPassword = $_POST['buildingPassword'];

    // Informations de connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password_db = "22207448";
    $dbname = "sae23";

    
    $conn = mysqli_connect($servername, $username, $password_db, $dbname);

    // verif de connexion
    if (!$conn) {
        die("Échec de la connexion à la base de données: " . mysqli_connect_error());
    }


    //requête SQL d'insertion
    $query = "INSERT INTO batiment (nom, login, mot_de_passe) VALUES ('$buildingName', '$buildingLogin', '$buildingPassword')";

    // lancement de la requête
    if (mysqli_query($conn, $query)) {
        echo "Le bâtiment a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du bâtiment: " . mysqli_error($conn);
    }

    // Fermeture la connexion
    mysqli_close($conn);
} else {
    echo "Veuillez remplir tous les champs du formulaire.";
}
?>
