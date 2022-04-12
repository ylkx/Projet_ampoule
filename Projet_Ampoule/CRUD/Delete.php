<?php

require_once '../Connexion/connect.php';

$id = $_GET['Id'];
$query = $db->prepare("DELETE FROM gestion WHERE Id =$id");
    $query->execute();
    
    $_SESSION['Delete'] = TRUE;
    
    header("Location: ../index.php");