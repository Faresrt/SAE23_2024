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
      // Navigation bar 
    <nav>
      <section class="heading">
        <h4>SAE23</h4>
      </section>
      // Navigation links
      <ul class="nav-links">
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="gestion.php">Gestion</a></li>
        <li><a href="intadmin.php">Admin</a></li>
        <li><a href="consultation.php">Consultation</a></li>
        <li><a href="gestion_projet.php">Projet</a></li>
      </ul>
    </nav>
    <section id="first" class="centered-text">
      // Buildings list 
        <h2>Liste des bâtiments</h2>
        <table class="ptitable">
            <tr>
                <th>Batiment</th>
                <th>Capteur</th>
              </tr>
              <tr>
                <td>Informatique</td>
                <td>Temperature</td>
              </tr>
              <tr>
                <td>Réseaux et Télécomnnuication</td>
                <td>Temperature</td>
              </tr>
        </table>
         // Resources table
            <h2>Ressources en appui</h2>
            <table class="styled-table">
              <tr>
                <th>Ressources transverses</th>
                <th>Ressources techniques</th>
              </tr>
              <tr>
                <td>R210 : documentation des codes en anglais</td>
                <td>R107 & R208 : algorithmie, programmation</td>
              </tr>
              <tr>
                <td>R211 : présentation orale de la maquette, rédaction technique</td>
                <td>R108 : environnement GNU/Linux, scripts Bash, commandes systèmes</td>
              </tr>
              <tr>
                <td>R115 : organisation du travail</td>
                <td>R109 & R209 : mise en forme d’une page web dynamique, publication sur un serveur</td>
              </tr>
              <tr>
                <td></td>
                <td>R207 : mise en place d’une base de données</td>
              </tr>
              <tr>
                <td></td>
                <td>R202 : mise en place de conteneurs Docker</td>
              </tr>
            </table>
    </section>
    
    
  </body>
</html>
