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
            <li><a class="active" href="gestionB111-112.php">GestionB111/112</a></li>
            <li><a href="administration.php">Admin</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="table-container">
            <h2>Tableau de Température E102</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Heure</th>
                        <th>Température</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableE102"></tbody>
            </table>
            <div>
                <p>Moyenne : <span id="temperatureAverageE102"></span></p>
                <p>Min : <span id="temperatureMinE102"></span></p>
                <p>Max : <span id="temperatureMaxE102"></span></p>
            </div>
        </div>
        <div class="table-container">
            <h2>Tableau de Température E103</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Heure</th>
                        <th>Température</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableE103"></tbody>
            </table>
            <div>
                <p>Moyenne : <span id="temperatureAverageE103"></span></p>
                <p>Min : <span id="temperatureMinE103"></span></p>
                <p>Max : <span id="temperatureMaxE103"></span></p>
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
        fetch('programmeGraphiqueE.php')
            .then(response => response.json())
            .then(data => {
                const temperatureDataE102 = data.temperatureE102.map(item => item.valeur);
                const temperatureDataE103 = data.temperatureE103.map(item => item.valeur);
                const xValuesE102 = data.temperatureE102.map(item => item.date_heure);
                const xValuesE103 = data.temperatureE103.map(item => item.date_heure);

                // Tableau des températures E102
                const temperatureTableE102 = document.getElementById("temperatureTableE102");
                for (let i = data.temperatureE102.length - 1; i >= 0 && i >= data.temperatureE102.length - 10; i--) {
                    const row = document.createElement("tr");
                    const dateTimeCell = document.createElement("td");
                    dateTimeCell.textContent = data.temperatureE102[i].date_heure;
                    const temperatureCell = document.createElement("td");
                    temperatureCell.textContent = data.temperatureE102[i].valeur;
                    row.appendChild(dateTimeCell);
                    row.appendChild(temperatureCell);
                    temperatureTableE102.appendChild(row);
                }

                // Tableau des températures E103
                const temperatureTableE103 = document.getElementById("temperatureTableE103");
                for (let i = data.temperatureE103.length - 1; i >= 0 && i >= data.temperatureE103.length - 10; i--) {
                    const row = document.createElement("tr");
                    const dateTimeCell = document.createElement("td");
                    dateTimeCell.textContent = data.temperatureE103[i].date_heure;
                    const temperatureCell = document.createElement("td");
                    temperatureCell.textContent = data.temperatureE103[i].valeur;
                    row.appendChild(dateTimeCell);
                    row.appendChild(temperatureCell);
                    temperatureTableE103.appendChild(row);
                }

                // Affichage des statistiques de température
                document.getElementById("temperatureAverageE102").textContent = data.temperatureE102Average;
                document.getElementById("temperatureMinE102").textContent = data.temperatureE102Min;
                document.getElementById("temperatureMaxE102").textContent = data.temperatureE102Max;

                document.getElementById("temperatureAverageE103").textContent = data.temperatureE103Average;
                document.getElementById("temperatureMinE103").textContent = data.temperatureE103Min;
                document.getElementById("temperatureMaxE103").textContent = data.temperatureE103Max;

                // Graphique de température
                new Chart("temperatureChart", {
                    type: "line",
                    data: {
                        labels: Array.from(new Set([...xValuesE102, ...xValuesE103])),
                        datasets: [
                            {
                                label: "Température E102",
                                data: temperatureDataE102,
                                backgroundColor: "rgba(0,0,255,0.2)",
                                borderColor: "rgba(0,0,255,1.0)",
                                borderWidth: 1
                            },
                            {
                                label: "Température E103",
                                data: temperatureDataE103,
                                backgroundColor: "rgba(255,0,0,0.2)",
                                borderColor: "rgba(255,0,0,1.0)",
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: "Date/Heure"
                                }
                            },
                            y: {
                                display: true,
                                title: {
                                    display: true,
                                    text: "Température"
                                }
                            }
                        },
                        layout: {
                            padding: {
                                left: 10,
                                right: 10,
                                top: 10,
                                bottom: 10
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>
</html>
