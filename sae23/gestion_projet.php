<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles/styleGT.css" />
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
        <li><a href="consultation.php">Consultation</a></li>
        <li><a class="active" href="gestion_projet.php">Projet</a></li>
      </ul>
    </nav>
 <section id="first">
    <h1>Gestion de projet</h1>
</section>
<section id="gestion">
    <p>Pour la gestion de cette SAE, nous avons utilisé différents outils tels que Gantt, Trello et Github.</p>
    
        <p>Durant ce projet, nous avions à faire différentes tâches afin de les séparer et de les répartir entre les différents membres du groupe.</p>
		<h6>Trello SAE23</h6>
		 <a href="https://trello.com/invite/b/FhmZlydO/ATTIaf07640a2e5972dfa21c23979f254bc5F3ACBCDD/sae232024" target="_blank">
		 <img src="images/trello.jpg" alt="Gantt de début de projet" >
    	</a>
</section>

 <section id="gestion">
    
        <p>Afin de répartir les tâches tout au long du projet, nous avons créé un premier emploi du temps sur Gantt lors de la première séance de SAE.</p>
		<h6>Gantt de début de projet</h6>
		<p> <img src="images/tachesSAE23.png" alt="Gantt de début de projet"></p>
		<h6>Gantt de fin de projet</h6>
		<p> <img src="images/screengantt-sae23.png" alt="Gantt de début de projet" ></p>
		<h6>Voici les rôles attribués pour chaque tâche</h6>
		<p> <img src="images/screen-tache-rôle.png" alt="Rôle de projet" ></p>
     </br>
     <h6>Gestionnaire de version du projet Github</h6>
     <p>Lien vers notre git : <a href="https://github.com/Faresrt/SAE23_2024.git">https://github.com/Faresrt/SAE23_2024</a></p>

  <p>Pour gérer les différentes l'avancement et les différentes versions du projet nous avons utilisé "git", plus spécifiquement "github desktop".</p>
  <p> <img src="images/git.png" alt="github desktop"></p>
</section>
 <section id="gestion">
    <h1>Développement du projet</h1>
    <p>Chaîne de traitement via des conteneurs:</p>
    <p> Docker Pour cette partie, le principal problème a été le traitement du JSON envoyé par le serveur MQTT. En cherchant sur des forums, nous avons trouvé une méthode en utilisant une fonction balise. Nous avons mis en place des capteurs d 'humidité et de température dans 2 salles par bâtiment.</p>
    <p>Création du site web dynamique</p>
    <p> Pour la création du site Web dynamique, les tâches ont été réparties entre tous les membres du groupe. Nous avons pu mettre en place l'affichage de deux capteurs par bâtiment, à savoir le capteur d'humidité et de température de la salle E208 pour le bâtiment RT et de la salle B108 pour le bâtiment informatique. Nous avons rencontré des problèmes pour l'affichage des données avec des graphiques en JavaScript et pour la gestion des connexions des utilisateurs des bâtiments. Pour l'affichage des graphiques, nous avons eu des difficultés à comprendre l'utilisation des canvas. Pour les logins sur la page d'administration, la difficulté principale a été de créer une page permettant de modifier les logins des utilisateurs de tous les bâtiments en une seule page. La solution a été d'utiliser l'ID des bâtiments dans la base de données pour déterminer quel utilisateur modifier.</p>
    <p>Script de récupération des données : </p>
    <p>Le script est en bash et permet de récupérer les données afin de les mettre dans la base de données. Le script fonctionne en 2 temps : dans un premier temps, il traite le JSON pour récupérer la température et l'humidité des salles, puis les met dans un fichier texte. Dans un second temps, un autre script récupère les données du fichier texte et les envoie dans la base de données.</p>
    </section>
    <section id="gestion">
      <h1>Chaîne de traitement via des conteneurs Docker</h1>
      <h6>FLOW-NODE-RED:</h6>
      <img src="images/nodered1.png" alt="flow node red">
      </br>
      <h6>Programmation du block function:</h6>
      <img src="images/noderedconfigchangeJSON.png" alt="block fonction JSON">
      </br>
      <h6>Dans Grafana il y a 2 dossiers contenant les graphiques:</h6>
      <img src="images/grafanabat.png" alt="dossiers Batiments">
      </br>
      <h6>Graphique des capteurs du bâtiment Réseaux et télécommunications :</h6>
      <img src="images/grafanaRT.png" alt="Batiments Réseaux et télécommunications">
      </br>
      <h6>Graphique des capteurs du bâtiment informatique :</h6>
      <img src="images/grafanaINFO.png" alt="Batiments informatique">
      </br>
</body>
</html>

