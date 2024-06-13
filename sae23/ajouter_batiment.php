<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles/styleMP.css" />
    <title>Administrateur</title>
  </head>
  <body>
    <nav>
      <section class="heading">
        <h4>SAE23</h4>
      </section>
      <ul class="nav-links">
        <li><a href="intadmin.php">Administrateur</a></li>
        <li><a class="active" href="ajouter_batiment.php">Ajouter</a></li>
		<li><a href="liste_batiments.php">Supprimer</a></li>
        <li><a href="modifier_mot_de_passe.php">Modifier</a></li>
        
      </ul>
    </nav>
	<section id="first" class="centered-text">
    <h2>Ajouter un bâtiment :</h2>
    <form method="post" action="ajouter_batiment_traitement.php">
        <label for="buildingName">Nom :</label>
        <input type="text" id="buildingName" name="buildingName" required>

        <label for="buildingLogin">Login :</label>
        <input type="text" id="buildingLogin" name="buildingLogin" required>

        <label for="buildingPassword">Mot de passe :</label>
        <input type="password" id="buildingPassword" name="buildingPassword" required>

        <input type="submit" name="addBuilding" value="Ajouter">
    </form>
	</section>
</body>

</html>

