<?php

require '../Connexion/connect.php';




error_log("GET : " . print_r($_GET, 1));


if (isset($_GET['Id']) and !empty($_GET['Id'])) {
    $Id = htmlspecialchars($_GET['Id']);

    $query = $db->prepare('SELECT * FROM gestion WHERE Id = ?');
    $query->execute(array($Id));
    $produit = $query->fetch(PDO::FETCH_ASSOC);
}

error_log("POST :" . print_r($_POST, 1));
if (empty($errors) && isset($_POST['submit'])) {
    extract($_POST);

    $query = $db->prepare("UPDATE gestion SET Etage = :Etage, Position = :Position, Prix = :Prix WHERE Id = :Id");

    $query->execute(array(
        ':Id' => $Id,
        ':Etage' => $Etage,
        ':Position' => $Position,
        ':Prix' => $Prix

    ));


    header('Location: ../index.php');
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" />
    <title>Formulaire</title>
</head>

<body>
    <nav>
        <a class="btn-href" href="../index.php">Accueil</a>
        <a class="btn-href" href="../formulaire.php">Formmulaire</a>
    </nav>
    <?php if (isset($_GET['Id']) and !empty($_GET['Id'])) { ?>
        <div class="form-container">
            <form action='Update.php' method="POST">
               
            <h1 class="titre">Ajout changements d'ampoules</h1>
            <input type="hidden" name="Id" value="<?= $_GET['Id'] ?>">

                <div class="input-etage">
                    <label for="select">Etage</label>
                    <select name="Etage" class="groupe1">
                        <label>Etage</label>
                        <option value="">Etage</option>
                        <?php for ($i = 0; $i <= 11; $i++) { ?>
                            <option value=<?php echo $i ?> <?php if ($i == $produit['Etage']) { ?> selected <?php } ?>><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                </div>

                    <div class="input-position">
                        <label for="select">Position :</label>
                        <select name="Position" class="groupe">

                            <?php
                            $position = ['droite', 'gauche', 'fond'];
                            for ($i = 0; $i <= 2; $i++) { ?>
                                <option value="<?= $i ?>" <?php ($i == $produit['Position']) ? "selected = selected" : ""  ?>><?= $position[$i] ?></option>
                            <?php  } ?>

                        </select>
                    </div>

                    <div class="input-prix">
                        <label>Prix :</label>
                        <input name='Prix' type="text" value=<?php echo $produit['Prix'] ?>>
                    </div>

                    <div class="input-submit">
                        <button type="submit" class="btn-submit" name='submit'> Envoyer </button>
                    </div>
            </form>
        </div>
    <?php } ?>
</body>

</html>