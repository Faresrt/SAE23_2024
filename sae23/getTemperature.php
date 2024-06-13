<?php
$host = 'localhost';
$db = 'sae23';
$user = 'root';
$pass = '22207448';

$buildingMap = [
    'INFO' => ['UserINFO'],
    'RT' => ['UserRT']
];

$building = $_GET['building'];
$users = $buildingMap[$building] ?? [];

if (empty($users)) {
    echo json_encode(['error' => 'Invalid building']);
    exit;
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userPlaceholders = implode(',', array_fill(0, count($users), '?'));
    $stmt = $pdo->prepare("
        SELECT valeur
        FROM mesure
        WHERE nom_capteur IN (SELECT nom_capteur FROM capteur WHERE id_salle IN (SELECT id_salle FROM salle WHERE id_batiment IN (SELECT id_batiment FROM batiment WHERE login IN ($userPlaceholders))))
        ORDER BY date_mesure DESC, horaire DESC
        LIMIT 1
    ");
    $stmt->execute($users);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(['temperature' => $result['valeur']]);
    } else {
        echo json_encode(['temperature' => 'No data']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
}
?>
