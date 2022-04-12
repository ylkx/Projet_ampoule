<?php

require 'Connexion/connect.php';

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}

$sql = ("SELECT COUNT(*) AS Id FROM gestion");
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetch();


$nbArticles = (int) $result['Id'];
$parPage = 5;
$pages = ceil($nbArticles / $parPage);
$premier = ($currentPage * $parPage) - $parPage;


$sql = ("SELECT * FROM gestion ORDER BY `Date` DESC LIMIT :premier, :parpage");
$query = $db->prepare($sql);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$query->execute();
$produit = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>

<html>

<head>
    <title>View Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <div class="container" style="background-color: #fef1df;">
        <h2>Historique changements d'ampoules</h2>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Etage</th>
                    <th>Position</th>
                    <th>Prix</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $position = ['droite', 'gauche', 'fond'];
                foreach ($produit as $key => $value) { ?>
                    <tr>
                        <td><?= $produit[$key]['Date'] ?></td>
                        <td><?= $produit[$key]['Etage'] ?></td>
                        <td><?= $position[$produit[$key]['Position']] ?></td>
                        <td><?= $produit[$key]['Prix'] ?>€</td>
                        <td><a href="CRUD\Update.php?Id=<?= $produit[$key]['Id'] ?>">Modifier</a></td>
                        <td><a href="CRUD\Delete.php?Id=<?= $produit[$key]['Id'] ?>" onclick="return confirm('Vous voulez vraiment supprimer cet donnée')">Supprimer</a></td>
                    </tr>

                <?php } ?>


            </tbody>
        </table>
    </div>

    <div class="barnabe">
  
        <ul class="d-flex" style="justify-content: center;"> 

            <li class="page-item" style="list-style-type: none;<?= ($currentPage == 1) ? "disabled" : "" ?>">
                <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
            </li>
            <?php for ($page = 1; $page <= $pages; $page++) : ?>

                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
            <?php endfor ?>

            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
            </li>
        </ul>

    </div>
    <?php /* if (isset($_SESSION['Delete']) && $_SESSION['Delete'] == true) { ?>
        <script type="text/javascript">
            $(function() {
                toastr.success('Donnée supprimer</b>', 'delete', {
                    positionClass: "toast-top-full-width",
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            });
        </script>
    <?php }
    $_SESSION['Delete'] = false; */ ?>

</body>

</html>