<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/styleGT.css">
    <title>Gestion de Projet</title>
</head>
<body>
    // Navigation Menu 
    <nav>
        <section class="heading">
            <h4>SAE23</h4>
        </section>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="gestion.php">Gestion</a></li>
            <li><a href="administration.php">Admin</a></li>
            <li><a href="consultation.php">Consultation</a></li>
            <li><a class="active" href="gestion_projet.php">Projet</a></li>
        </ul>
    </nav>
        // Project Management Overview 
    <section id="first">
        <h1>Gestion de Projet</h1>
        <table>
            <tr>
                <th>Page</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>Accueil</td>
                <td>Description de l’objectif du site, affichage des bâtiments gérés, des salles équipées, mentions légales. <img src="images/valide.png" alt="valide" heigth="50" width="50"></td>
            </tr>
            <tr>
                <td>Administration</td>
                <td>Accessible uniquement par l’Administrateur du site (login/mdp). Ajout/suppression de bâtiments, de salles et de capteurs. <img src="images/valide.png" alt="valide" heigth="50" width="50"></td>
            </tr>
            <tr>
                <td>Gestion</td>
                <td>Accessible uniquement par les Gestionnaires. Affichage des mesures des capteurs de leur bâtiment uniquement. Affichage des moyennes, min et max des salles de leur bâtiment. <img src="images/valide.png" alt="valide" heigth="50" width="50"></td>
            </tr>
            <tr>
                <td>Consultation</td>
                <td>Accessible à tous qui affiche la dernière mesure de tous les capteurs. <img src="images/valide.png" alt="valide" heigth="50" width="50"></td>
            </tr>
            <tr>
                <td>Gestion de Projet</td>
                <td>GANTT final, captures d’écran outils collaboratifs utilisés, synthèse personnelle de chaque membre sur travail précis réalisé, problèmes rencontrés, solutions proposées, et une conclusion sur degré de satisfaction du cahier des charges. <img src="images/valide.png" alt="valide" heigth="50" width="50"></td>
            </tr>
        </table>
    </section>
    // Optional Advanced Features
    <section id="advanced">
        <h2>Fonctionnalités Avancées Facultatives</h2>
        <table>
            <tr>
                <th>Fonctionnalité</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>Hébergement</td>
                <td>Hébergement sur Eohost ou autre hébergeur gratuit.</td>
            </tr>
            <tr>
                <td>Graphiques avec Canvas</td>
                <td>Réalisation de graphiques grâce à Canvas (<a href="https://www.w3schools.com/js/js_graphics_chartjs.asp" target="_blank">Chart.js</a>) ou <a href="https://developers.google.com/chart" target="_blank">Google Charts</a>. <img src="images/valide.png" alt="valide" heigth="50" width="50"></td>
            </tr>
            <tr>
                <td>Plus de Bâtiments et Capteurs</td>
                <td>Ajout de plus de bâtiments et de capteurs par bâtiment. <img src="images/valide.png" alt="valide" heigth="50" width="50"></td>
            </tr>
            <tr>
                <td>Rafraîchissement Automatique</td>
                <td>Rafraîchissement automatique des pages avec graphiques.</td>
            </tr>
            <tr>
                <td>Chiffrement MD5</td>
                <td>Chiffrement MD5 des mots de passe dans la base de données.</td>
            </tr>
        </table>
    </section>
    // Project Management Tools and Screenshots 
    <section id="gestion">
        <p>Pour la gestion de cette SAE, nous avons utilisé différents outils tels que Gantt, Trello et Github.</p>
        <p>Durant ce projet, nous avions à faire différentes tâches afin de les séparer et de les répartir entre les différents membres du groupe.</p>
        <h6>Trello SAE23</h6>
        <a href="https://trello.com/invite/b/FhmZlydO/ATTIaf07640a2e5972dfa21c23979f254bc5F3ACBCDD/sae232024" target="_blank">
            <img src="images/trello.jpg" alt="Gantt de début de projet">
        </a>
    </section>
        // Initial Gantt Chart 
    <section id="gestion">
        <p>Afin de répartir les tâches tout au long du projet, nous avons créé un premier emploi du temps sur Gantt lors de la première séance de SAE.</p>
        <h6>Gantt de début de projet</h6>
        <p><img src="images/tachesSAE23.png" alt="Gantt de début de projet"></p>
        <h6>Gantt de fin de projet</h6>
        <p><img src="images/screengantt-sae23.png" alt="Gantt de début de projet"></p>
                // Task Roles 
        <h6>Voici les rôles attribués pour chaque tâche</h6>
        <p><img src="images/screen-tache-rôle.png" alt="Rôle de projet"></p>
        <br>
                // GitHub Link 
        <h6>Gestionnaire de version du projet Github</h6>
        <p>Pour gérer les différentes l'avancement et les différentes versions du projet nous avons utilisé "git", plus spécifiquement "github desktop".</p>
        Lien vers notre git : <a href="https://github.com/Faresrt/SAE23_2024.git" target="_blank">
        <img src="images/github.jpg" alt="github desktop">
        </a>
    </section>
        // Project Development 
    <section id="gestion">
        <h1>Développement du projet</h1>
        <p>Chaîne de traitement via des conteneurs:</p>
        <p> Docker Pour cette partie, le principal problème a été le traitement du JSON envoyé par le serveur MQTT. En cherchant sur des forums, nous avons trouvé une méthode en utilisant une fonction balise. Nous avons mis en place des capteurs d 'humidité et de température dans 2 salles par bâtiment.</p>
        <p>Création du site web dynamique</p>
        <p> Pour la création du site Web dynamique, les tâches ont été réparties entre tous les membres du groupe. Nous avons pu mettre en place l'affichage de deux capteurs par bâtiment, à savoir le capteur d'humidité et de température de la salle E208 pour le bâtiment RT et de la salle B108 pour le bâtiment informatique. Nous avons rencontré des problèmes pour l'affichage des données avec des graphiques en JavaScript et pour la gestion des connexions des utilisateurs des bâtiments. Pour l'affichage des graphiques, nous avons eu des difficultés à comprendre l'utilisation des canvas. Pour les logins sur la page d'administration, la difficulté principale a été de créer une page permettant de modifier les logins des utilisateurs de tous les bâtiments en une seule page. La solution a été d'utiliser l'ID des bâtiments dans la base de données pour déterminer quel utilisateur modifier.</p>
        <p>Script de récupération des données : </p>
        <p>Le script est en bash et permet de récupérer les données afin de les mettre dans la base de données. Le script fonctionne en 2 temps : dans un premier temps, il traite le JSON pour récupérer la température et l'humidité des salles, puis les met dans un fichier texte. Dans un second temps, un autre script récupère les données du fichier texte et les envoie dans la base de données.</p>
    </section>
        // Docker and Grafana Screenshots 
    <section id="gestion">
        <h1>Chaîne de traitement via des conteneurs Docker</h1>
        <h6>FLOW-NODE-RED:</h6>
        <img src="images/flownodered.jpg" alt="flow node red">
        <br>
        <h6>Dans Grafana il y a 2 dossiers contenant les graphiques:</h6>
        <img src="images/grafanabat.png" alt="dossiers Batiments">
        <br>
        <h6>Graphique des capteurs du bâtiment Réseaux et télécommunications :</h6>
        <img src="images/Grafana-Batiment-RT.png" alt="Batiments Réseaux et télécommunications">
        <br>
        <h6>Graphique des capteurs du bâtiment informatique :</h6>
        <img src="images/Grafana-Batiment-Informatique.png" alt="Batiments informatique">
        <br>
    </section>
</body>
</html>
