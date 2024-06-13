<?php
// Connexion à la base de données
$host = 'localhost';
$db = 'sae23';
$user = 'root'; // Remplacez par votre nom d'utilisateur de base de données
$pass = '22207448'; // Remplacez par votre mot de passe de base de données

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour obtenir les données de température pour B111 et B112
    $stmt = $pdo->prepare("
        SELECT date_mesure, horaire, valeur, nom_capteur 
        FROM mesure 
        WHERE nom_capteur IN ('AM107-3', 'AM107-17') 
        ORDER BY date_mesure DESC, horaire DESC
        LIMIT 10
    ");
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Préparation des données pour la réponse JSON
    $response = [
        'temperatureB111' => [],
        'temperatureB112' => []
    ];

    foreach ($data as $row) {
        $dateTime = $row['date_mesure'] . ' ' . $row['horaire'];
        if ($row['nom_capteur'] == 'AM107-3') {
            $response['temperatureB111'][] = ['date_heure' => $dateTime, 'valeur' => $row['valeur']];
        } else if ($row['nom_capteur'] == 'AM107-17') {
            $response['temperatureB112'][] = ['date_heure' => $dateTime, 'valeur' => $row['valeur']];
        }
    }

    // Calcul des statistiques
    foreach (['temperatureB111', 'temperatureB112'] as $key) {
        $values = array_column($response[$key], 'valeur');
        $response[$key . 'Average'] = count($values) ? array_sum($values) / count($values) : null;
        $response[$key . 'Min'] = count($values) ? min($values) : null;
        $response[$key . 'Max'] = count($values) ? max($values) : null;
    }

    // Retour de la réponse JSON
    header('Content-Type: application/json');
    echo json_encode($response);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
