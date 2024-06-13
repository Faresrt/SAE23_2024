<?php
// Récupérer l'ID du bâtiment à supprimer
if (isset($_POST['buildingID'])) {
    $buildingID = $_POST['buildingID'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password_db = "22207448";
    $dbname = "sae23";

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données: " . $conn->connect_error);
    }

    // Supprimer le bâtiment de la base de données
    $query = "DELETE FROM Batiment WHERE ID_bat = $buildingID";

    if ($conn->query($query) === TRUE) {
        echo "Le bâtiment a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du bâtiment: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Veuillez fournir l'ID du bâtiment à supprimer.";
}
?>

