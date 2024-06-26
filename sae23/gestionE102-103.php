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
            <li><a href="administration.php">Admin</a></li>
        </ul>
    </nav>
    <div class="container">
        <?php
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "22207448";
        $dbname = "sae23";

        // Connect to database
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Function to fetch sensor data for a given sensor name
        function fetchSensorData($conn, $nom_capteur) {
            $sql = "SELECT date_mesure, horaire, valeur FROM mesure WHERE nom_capteur = '$nom_capteur' ORDER BY date_mesure DESC, horaire DESC LIMIT 10";
            $result = mysqli_query($conn, $sql);

            $data = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        // Fetch data for sensor AM107-32 (E102)
        $dataE102 = fetchSensorData($conn, 'AM107-32');

        // Fetch data for sensor AM107-33 (E103)
        $dataE103 = fetchSensorData($conn, 'AM107-33');

        // Close database connection
        mysqli_close($conn);
        ?>

        <div class="table-container">
            <h2>Temperature Table E102: Sensor AM107-32</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Time</th>
                        <th>Temperature</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableE102">
                    <?php
                    foreach ($dataE102 as $item) {
                        echo "<tr>";
                        echo "<td>{$item['date_mesure']} {$item['horaire']}</td>";
                        echo "<td>{$item['valeur']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <p>Average: <span id="temperatureAverageE102">
                    <?php
                    $valuesE102 = array_column($dataE102, 'valeur');
                    echo number_format(array_sum($valuesE102) / count($valuesE102), 2);
                    ?>
                </span></p>
                <p>Min: <span id="temperatureMinE102"><?php echo min($valuesE102); ?></span></p>
                <p>Max: <span id="temperatureMaxE102"><?php echo max($valuesE102); ?></span></p>
            </div>
        </div>

        <div class="table-container">
            <h2>Temperature Table E103: Sensor AM107-33</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Time</th>
                        <th>Temperature</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableE103">
                    <?php
                    foreach ($dataE103 as $item) {
                        echo "<tr>";
                        echo "<td>{$item['date_mesure']} {$item['horaire']}</td>";
                        echo "<td>{$item['valeur']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <p>Average: <span id="temperatureAverageE103">
                    <?php
                    $valuesE103 = array_column($dataE103, 'valeur');
                    echo number_format(array_sum($valuesE103) / count($valuesE103), 2);
                    ?>
                </span></p>
                <p>Min: <span id="temperatureMinE103"><?php echo min($valuesE103); ?></span></p>
                <p>Max: <span id="temperatureMaxE103"><?php echo max($valuesE103); ?></span></p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="chart-container">
            <h2>Temperature Chart</h2>
            <canvas id="temperatureChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // PHP data converted to JavaScript
        const dataE102 = <?php echo json_encode($dataE102); ?>;
        const dataE103 = <?php echo json_encode($dataE103); ?>;

        // Extract values and labels for chart
        const temperatureDataE102 = dataE102.map(item => item.valeur);
        const temperatureDataE103 = dataE103.map(item => item.valeur);
        const labelsE102 = dataE102.map(item => `${item.date_mesure} ${item.horaire}`);
        const labelsE103 = dataE103.map(item => `${item.date_mesure} ${item.horaire}`);

        // Create the chart
        const ctx = document.getElementById('temperatureChart').getContext('2d');
        const temperatureChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [...labelsE102, ...labelsE103],
                datasets: [{
                    label: 'Temperature E102 (AM107-32)',
                    data: temperatureDataE102,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Temperature E103 (AM107-33)',
                    data: temperatureDataE103,
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
