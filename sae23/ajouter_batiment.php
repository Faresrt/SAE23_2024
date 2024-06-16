<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/styleMP.css">
    <title>Administrateur</title>
</head>

<body>
    // Navigation bar 
    <nav>
        <section class="heading">
            <h4>SAE23</h4>
        </section>
     // Navigation links 
        <ul class="nav-links">
            <li><a href="intadmin.php">Administrateur</a></li>
            <li><a class="active" href="ajouter_batiment.php">Ajouter</a></li>
            <li><a href="liste_batiments.php">Supprimer</a></li>
            <li><a href="modifier_mot_de_passe.php">Modifier</a></li>
        </ul>
    </nav>

    <div class="container">
        // Add building section 
        <section id="addBuilding" class="section">
            <h2>Ajouter un bâtiment :</h2>
        // Form to add a building
            <form method="post" action="ajouter_batiment_traitement.php">
                <label for="buildingName">Nom du bâtiment:</label>
                <input type="text" id="buildingName" name="buildingName" required>

                <label for="buildingLogin">Login du gestionnaire:</label>
                <input type="text" id="buildingLogin" name="buildingLogin" required>

                <label for="buildingPassword">Mot de passe :</label>
                <input type="password" id="buildingPassword" name="buildingPassword" required>

                <input type="submit" name="addBuilding" value="Ajouter">
            </form>
        </section>
        // Add sensor section 
        <section id="addSensor" class="section">
            <h2>Ajouter un Capteur :</h2>
         // Form to add a sensor 
            <form method="post" action="ajouter_capteur_traitement.php">
                <label for="SensorName">Nom du capteur:</label>
                <input type="text" id="SensorName" name="SensorName" required>

               <label for="SensorType">Type de capteur :</label>
        			<select id="SensorType" name="SensorType" required>
            			<option value="CO2">CO2</option>
            			<option value="Temperature">Température</option>
            			<option value="Humidite">Humidité</option>
            			<option value="Luminosite">Luminosité</option>
        			</select>
        		</br>
			
               <label for="SensorRoom">Salle :</label>
        			<select id="SensorRoom" name="SensorRoom" required>
            			<option value="E102">E102</option>
            			<option value="E103">E103</option>
            			<option value="B111">B111</option>
            			<option value="B112">B112</option>
        			</select>
        		</br>

                <input type="submit" name="addSensor" value="Ajouter">
            </form>
        </section>
    </div>

</body>

</html>
