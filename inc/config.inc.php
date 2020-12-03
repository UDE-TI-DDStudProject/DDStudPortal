<?php

//Hier Verbindungsdaten zur Datenbank eintragen
$db_host = 'localhost';
$db_name = 'ddstudportal';
$db_user = 'root';
$db_password = '';
$pdo = new pdo("mysql:host=$db_host;dbname=$db_name;port=3308", $db_user, $db_password);

try {
    $pdo = new pdo("mysql:host=$db_server;dbname=$db_name;port=$db_port;charset=utf8", $db_user, $db_password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
