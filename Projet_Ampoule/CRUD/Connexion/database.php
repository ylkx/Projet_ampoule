<?php

require 'connect.php';

try {
    $sql = "CREATE TABLE gestion(
    Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    Etage INT(2) NOT NULL,
    Position VARCHAR(255) NOT NULL,
    Prix VARCHAR(255) NOT NULL
    )";

        $db->exec($sql);

    echo "Table crée";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
