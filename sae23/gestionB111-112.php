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
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "22207448";
        $dbname = "sae23";

        // Establishing the connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Checking the connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Function to fetch sensor data for a given sensor name
        function fetchSensorData($conn, $sensorName) {
            $sql = "SELECT date_mesure, horaire, valeur FROM mesure WHERE nom_capteur = '$sensorName' ORDER BY date_mesure DESC, horaire DESC LIMIT 10";
            $result = mysqli_query($conn, $sql);

            $data = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        // Fetching data for sensor AM107-3 in room B111
        $dataB111 = fetchSensorData($conn, 'AM107-3');

        // Fetching data for sensor AM107-17 in room B112
        $dataB112 = fetchSensorData($conn, 'AM107-17');

        // Closing the database connection
        mysqli_close($conn);
        ?>

        <div class="table-container">
            <h2>Temperature Table for B111: Sensor AM107-3</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Time</th>
                        <th>Temperature</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableB111">
                    <?php
                    // Displaying data for B111
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
                <p>Average: <span id="temperatureAverageB111">
                    <?php
                    // Calculating average temperature for B111
                    $valuesB111 = array_column($dataB111, 'valeur');
                    echo number_format(array_sum($valuesB111) / count($valuesB111), 2);
                    ?>
                </span></p>
                <p>Min: <span id="temperatureMinB111"><?php echo min($valuesB111); ?></span></p>
                <p>Max: <span id="temperatureMaxB111"><?php echo max($valuesB111); ?></span></p>
            </div>
        </div>

        <div class="table-container">
            <h2>Temperature Table for B112: Sensor AM107-17</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Time</th>
                        <th>Temperature</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableB112">
                    <?php
                    // Displaying data for B112
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
                <p>Average: <span id="temperatureAverageB112">
                    <?php
                    // Calculating average temperature for B112
                    $valuesB112 = array_column($dataB112, 'valeur');
                    echo number_format(array_sum($valuesB112) / count($valuesB112), 2);
                    ?>
                </span></p>
                <p>Min: <span id="temperatureMinB112"><?php echo min($valuesB112); ?></span></p>
                <p>Max: <span id="temperatureMaxB112"><?php echo max($valuesB112); ?></span></p>
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
        const dataB111 = <?php echo json_encode($dataB111); ?>;
        const dataB112 = <?php echo json_encode($dataB112); ?>;

        // Extracting values and dates for the chart
        const temperatureDataB111 = dataB111.map(item => item.valeur);
        const temperatureDataB112 = dataB112.map(item => item.valeur);
        const labelsB111 = dataB111.map(item => `${item.date_mesure} ${item.horaire}`);
        const labelsB112 = dataB112.map(item => `${item.date_mesure} ${item.horaire}`);

        // Creating the chart
        const ctx = document.getElementById('temperatureChart').getContext('2d');
        const temperatureChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [...labelsB111, ...labelsB112],
                datasets: [{
                    label: 'Temperature B111 (AM107-3)',
                    data: temperatureDataB111,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Temperature B112 (AM107-17)',
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
