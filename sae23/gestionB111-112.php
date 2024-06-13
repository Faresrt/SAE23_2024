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
            <li><a class="active" href="gestionE102-103.php">GestionE102/103</a></li>
            <li><a href="administration.php">Admin</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="table-container">
            <h2>Tableau de Température B111</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Heure</th>
                        <th>Température</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableB111"></tbody>
            </table>
            <div>
                <p>Moyenne : <span id="temperatureAverageB111"></span></p>
                <p>Min : <span id="temperatureMinB111"></span></p>
                <p>Max : <span id="temperatureMaxB111"></span></p>
            </div>
        </div>
        <div class="table-container">
            <h2>Tableau de Température B112</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date/Heure</th>
                        <th>Température</th>
                    </tr>
                </thead>
                <tbody id="temperatureTableB112"></tbody>
            </table>
            <div>
                <p>Moyenne : <span id="temperatureAverageB112"></span></p>
                <p>Min : <span id="temperatureMinB112"></span></p>
                <p>Max : <span id="temperatureMaxB112"></span></p>
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
        fetch('programmeGraphiqueB.php')
            .then(response => response.json())
            .then(data => {
                const temperatureDataB111 = data.temperatureB111.map(item => item.valeur);
                const temperatureDataB112 = data.temperatureB112.map(item => item.valeur);
                const xValuesB111 = data.temperatureB111.map(item => item.date_heure);
                const xValuesB112 = data.temperatureB112.map(item => item.date_heure);

                // Tableau des températures B111
                const temperatureTableB111 = document.getElementById("temperatureTableB111");
                for (let i = data.temperatureB111.length - 1; i >= 0 && i >= data.temperatureB111.length - 10; i--) {
                    const row = document.createElement("tr");
                    const dateTimeCell = document.createElement("td");
                    dateTimeCell.textContent = data.temperatureB111[i].date_heure;
                    const temperatureCell = document.createElement("td");
                    temperatureCell.textContent = data.temperatureB111[i].valeur;
                    row.appendChild(dateTimeCell);
                    row.appendChild(temperatureCell);
                    temperatureTableB111.appendChild(row);
                }

                // Tableau des températures B112
                const temperatureTableB112 = document.getElementById("temperatureTableB112");
                for (let i = data.temperatureB112.length - 1; i >= 0 && i >= data.temperatureB112.length - 10; i--) {
                    const row = document.createElement("tr");
                    const dateTimeCell = document.createElement("td");
                    dateTimeCell.textContent = data.temperatureB112[i].date_heure;
                    const temperatureCell = document.createElement("td");
                    temperatureCell.textContent = data.temperatureB112[i].valeur;
                    row.appendChild(dateTimeCell);
                    row.appendChild(temperatureCell);
                    temperatureTableB112.appendChild(row);
                }

                // Affichage des statistiques de température
                document.getElementById("temperatureAverageB111").textContent = data.temperatureB111Average;
                document.getElementById("temperatureMinB111").textContent = data.temperatureB111Min;
                document.getElementById("temperatureMaxB111").textContent = data.temperatureB111Max;

                document.getElementById("temperatureAverageB112").textContent = data.temperatureB112Average;
                document.getElementById("temperatureMinB112").textContent = data.temperatureB112Min;
                document.getElementById("temperatureMaxB112").textContent = data.temperatureB112Max;

                // Graphique de température
                new Chart("temperatureChart", {
                    type: "line",
                    data: {
                        labels: Array.from(new Set([...xValuesB111, ...xValuesB112])),
                        datasets: [
                            {
                                label: "Température B111",
                                data: temperatureDataB111,
                                backgroundColor: "rgba(255,0,0,0.2)",
                                borderColor: "rgba(255,0,0,1.0)",
                                borderWidth: 1
                            },
                            {
                                label: "Température B112",
                                data: temperatureDataB112,
                                backgroundColor: "rgba(0,0,255,0.2)",
                                borderColor: "rgba(0,0,255,1.0)",
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
            });
    </script>
</body>
</html>

