<?php
// Check if the form data has been submitted.
if (isset($_POST['buildingName']) && isset($_POST['buildingLogin']) && isset($_POST['buildingPassword'])) {
    // Récupérer les données du formulaire
    $buildingName = $_POST['buildingName'];
    $buildingLogin = $_POST['buildingLogin'];
    $buildingPassword = $_POST['buildingPassword'];

    // Database connection information.
    $servername = "localhost";
    $username = "root";
    $password_db = "22207448";
    $dbname = "sae23";

    // Database connection.
    $conn = mysqli_connect($servername, $username, $password_db, $dbname);

    // Check the connection
    if (!$conn) {
        die("Échec de la connexion à la base de données: " . mysqli_connect_error());
    }


    // Prepare the SQL insert query.
    $query = "INSERT INTO batiment (nom, login, mot_de_passe) VALUES ('$buildingName', '$buildingLogin', '$buildingPassword')";

    // Execute the query and check for success.
    if (mysqli_query($conn, $query)) {
        echo "Le bâtiment a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du bâtiment: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
} else {
    echo "Veuillez remplir tous les champs du formulaire.";
}
?>
