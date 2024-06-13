<?php
// Vérifier si les données du formulaire ont été soumises
if (isset($_POST['buildingName']) && isset($_POST['buildingLogin']) && isset($_POST['buildingPassword'])) {
    // Récupérer les données du formulaire
    $buildingName = $_POST['buildingName'];
    $buildingLogin = $_POST['buildingLogin'];
    $buildingPassword = $_POST['buildingPassword'];

    // Informations de connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password_db = "22207448";
    $dbname = "sae23";

    // Connexion à la base de données MySQLi
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données: " . $conn->connect_error);
    }

    // Insérer le nouveau bâtiment dans la base de données
    $query = "INSERT INTO batiment (nom, login, mot_de_passe) VALUES ('$buildingName', '$buildingLogin', '$buildingPassword')";

    if ($conn->query($query) === TRUE) {
        echo "Le bâtiment a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du bâtiment: " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
} else {
    echo "Veuillez remplir tous les champs du formulaire.";
}
?>

