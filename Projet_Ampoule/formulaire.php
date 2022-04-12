<?php
require './Connexion/connect.php';

if (isset($_POST['Etage']) && isset($_POST['Position']) && isset($_POST['Prix'])) {

  $etage = $_POST['Etage'];
  $position = $_POST['Position'];
  $prix = $_POST['Prix'];

  $query = $db->prepare("INSERT INTO gestion(`Etage`, `Position`, `Prix`) VALUES (:Etage, :Position, :Prix)");

  $query->execute(array(
    'Position' => $position,
    'Etage' => $etage,
    'Prix' => $prix
  ));
  echo 'Ajout ok';
  header("Location: index.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="style.css" />
  <title>Formulaire</title>
</head>

<body>
  <nav>
    <a class=" btn-href" href="index.php">Accueil</a>
    <a class="btn-href" href="formulaire.php">Formmulaire</a>
  </nav>
  <div class="form-container">
    <form action='formulaire.php' method="POST" class="form">

      <h1 class="titre">Ajout changements d'ampoules</h1>
    
      <div class="input-etage">

        <label for="select">Etage :</label>
        <select name="Etage" id="select" class="groupe1">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
        </select>
      </div>

      <div class="input-position">
        <label for="select">Position :</label>
        <select name="Position" class="groupe">
          <option value="0">Droite</option>
          <option value="1">Gauche</option>
          <option value="2">Fond</option>
        </select>
      </div>

      <div class="input-prix">
        <label>Prix :</label>
        <input name='Prix' type="text">

      </div>


      <div class="input-submit">
        <button type="submit" class="btn-submit"> Envoyer </button>
      </div>

  </form>
  </div>

</body>

</html>