<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }
        h1 {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 36px;
            z-index: 10;
        }
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/screen2.jpg') no-repeat center center;
            background-size: cover;
        }
        .building {
            position: absolute;
            cursor: pointer;
            border: 2px solid rgba(255, 255, 255, 0.7);
            background: rgba(255, 255, 255, 0.3);
        }
        #info {
            top: 45%;
            left: 15%;
            width: 20%;
            height: 15%;
        }
        #rt {
            top: 45%;
            left: 60%;
            width: 20%;
            height: 15%;
        }
        #temperatureBox {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            padding: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 10px;
            display: none;
            z-index: 10;
        }
    </style>
</head>
<body>
    <h1>Consultation</h1>
    <div class="background"></div>
    <div id="info" class="building" onclick="showTemperature('INFO')"></div>
    <div id="rt" class="building" onclick="showTemperature('RT')"></div>
    <div id="temperatureBox"></div>
    <script>
        function showTemperature(building) {
            fetch(`getTemperature.php?building=${building}`)
                .then(response => response.json())
                .then(data => {
                    const temperatureBox = document.getElementById('temperatureBox');
                    temperatureBox.style.display = 'block';
                    temperatureBox.textContent = `Dernière température du bâtiment ${building}: ${data.temperature}°C`;
                    setTimeout(() => {
                        temperatureBox.style.display = 'none';
                    }, 5000);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
        }
    </script>
</body>
</html>
