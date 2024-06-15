<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="styles/style2.css" />
    <title>Accueil</title>
    <style>
        .chart-container {
            position: relative;
            height: 600px;
            width: 1000px;
            margin: auto;
        }
        .table-container {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <nav>
        <section class="heading">
            <h4>SAE23</h4>
        </section>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="gestion.php">Gestion</a></li>
            <li><a class="active" href="gestionE102-103.php">GestionE102/103</a></li>
            <li><a href="administration.php">Admin</a></li>
        </ul>
    </nav>
    <div class="container">
        <?php
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "22207448";
        $dbname = "sae23";

        // Création de la connexion
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if (!$conn) {
            die("Échec de la connexion à la base de données: " . mysqli_connect_error());
        }

        // Récupération des données de mesure pour un capteur donné
        function fetchSensorData($conn, $nom_capteur) {
            $sql = "SELECT date_mesure, horaire, valeur FROM mesure WHERE nom_capteur = '$nom_capteur' ORDER BY date_mesure DESC, horaire DESC LIMIT 10";
            $result = mysqli_query($conn, $sql);

            $data = array();
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        // Récupération des données pour B111 (AM107-3)
        $dataB111 = fetchSensorData($conn, 'AM107-3');

        // Récupération des données pour B112 (AM107-17)
        $dataB112 = fetchSensorData($conn, 'AM107-17');

        // Fermeture de la connexion à la base de données
        mysqli_close($conn);
        ?>

        <div class="table-container">
            <h2>Tableau de Température B111 : capteur AM107-3</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Heure</th>
                        <th>Température</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableB111">
                    <?php
                    foreach ($dataB111 as $item) {
                        echo "<tr>";
                        echo "<td>{$item['date_mesure']} {$item['horaire']}</td>";
                        echo "<td>{$item['valeur']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <p>Moyenne : <span id="temperatureAverageB111">
                    <?php
                    if (!empty($dataB111)) {
                        $valuesB111 = array_column($dataB111, 'valeur');
                        echo number_format(array_sum($valuesB111) / count($valuesB111), 2);
                    } else {
                        echo "N/A";
                    }
                    ?>
                </span></p>
                <p>Min : <span id="temperatureMinB111"><?php echo !empty($dataB111) ? min($valuesB111) : "N/A"; ?></span></p>
                <p>Max : <span id="temperatureMaxB111"><?php echo !empty($dataB111) ? max($valuesB111) : "N/A"; ?></span></p>
            </div>
        </div>

        <div class="table-container">
            <h2>Tableau de Température B112 : capteur AM107-17</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Heure</th>
                        <th>Température</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableB112">
                    <?php
                    foreach ($dataB112 as $item) {
                        echo "<tr>";
                        echo "<td>{$item['date_mesure']} {$item['horaire']}</td>";
                        echo "<td>{$item['valeur']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <p>Moyenne : <span id="temperatureAverageB112">
                    <?php
                    if (!empty($dataB112)) {
                        $valuesB112 = array_column($dataB112, 'valeur');
                        echo number_format(array_sum($valuesB112) / count($valuesB112), 2);
                    } else {
                        echo "N/A";
                    }
                    ?>
                </span></p>
                <p>Min : <span id="temperatureMinB112"><?php echo !empty($dataB112) ? min($valuesB112) : "N/A"; ?></span></p>
                <p>Max : <span id="temperatureMaxB112"><?php echo !empty($dataB112) ? max($valuesB112) : "N/A"; ?></span></p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="chart-container">
            <h2>Graphique de Température</h2>
            <canvas id="temperatureChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Données PHP converties en JavaScript
        const dataB111 = <?php echo json_encode($dataB111); ?>;
        const dataB112 = <?php echo json_encode($dataB112); ?>;

        // Extraction des valeurs et dates pour le graphique
        const temperatureDataB111 = dataB111.map(item => parseFloat(item.valeur));
        const temperatureDataB112 = dataB112.map(item => parseFloat(item.valeur));
        const labelsB111 = dataB111.map(item => `${item.date_mesure} ${item.horaire}`);
        const labelsB112 = dataB112.map(item => `${item.date_mesure} ${item.horaire}`);

        // Création du graphique
        const ctx = document.getElementById('temperatureChart').getContext('2d');
        const temperatureChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [...labelsB111, ...labelsB112],
                datasets: [{
                    label: 'Température B111 (AM107-3)',
                    data: temperatureDataB111,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Température B112 (AM107-17)',
                    data: temperatureDataB112,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
