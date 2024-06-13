<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles/style1.css" />
    <title>Accueil</title>
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
        <li><a class="active" href="consultation.php">Consultation</a></li>
        <li><a href="gestion_projet.php">Projet</a></li>
      </ul>
    </nav>

<style>
        .container {
            margin-top: 150px;
        }
    </style>

<center>
    <section class="container">
        <table class="styled-table">
            <h2>Bâtiment B</h2>
            <tr>
                <th>Capteur</th>
                <th>Valeur</th>
            </tr>
            <tr>
                <td>Température <strong>ACTUELLE</strong></td>
                <td>
                    <?php
                    $host = "localhost";
                    $dbname = "sae23";
                    $username = "root";
                    $password = "22207448"; 

                    // Database connection
                    try {
                        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Retrieving the last temperature value for building 1
                        $query = "SELECT Donnees.valeur
                                  FROM Capteur
                                  INNER JOIN Donnees ON Capteur.ID_capt = Donnees.ID_capteur
                                  WHERE Capteur.type = 'temperature' AND Capteur.ID_bat = 1
                                  ORDER BY Donnees.date_heure DESC
                                  LIMIT 1";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();

                        // Get data in an associative array
                        $data = $stmt->fetch(PDO::FETCH_ASSOC);

                        //Close database connection
                        $conn = null;

                        // Afficher les données
                        if ($data) {
                            echo $data['valeur'] . " °C";
                        } else {
                            echo "Aucune donnée disponible";
                        }
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                    ?>
                </td>
            </tr>

        </table>


        <table class="styled-table">
            <h2>Bâtiment E</h2>
            <tr>
                <th>Capteur</th>
                <th>Valeur</th>
            </tr>
            <tr>
                <td>Température <strong>ACTUELLE</strong></td>
                <td>
                    <?php
                    // Connexion à la base de données
                    try {
                        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Récupération de la dernière valeur de température pour le bâtiment 2
                        $query = "SELECT Donnees.valeur
                                  FROM Capteur
                                  INNER JOIN Donnees ON Capteur.ID_capt = Donnees.ID_capteur
                                  WHERE Capteur.type = 'temperature' AND Capteur.ID_bat = 2
                                  ORDER BY Donnees.date_heure DESC
                                  LIMIT 1";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();

                        // Récupérer les données dans un tableau associatif
                        $data = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Fermer la connexion à la base de données
                        $conn = null;

                        // Afficher les données
                        if ($data) {
                            echo $data['valeur'] . " °C";
                        } else {
                            echo "Aucune donnée disponible";
                        }
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                    ?>
                </td>
            </tr>
        </table>
    </section>
</center>
</body>
</html>



  
