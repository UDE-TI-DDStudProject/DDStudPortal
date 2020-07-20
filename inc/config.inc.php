<?php

//Hier Verbindungsdaten zur Datenbank eintragen
$db_host = 'localhost';
$db_name = 'ddstudportal';
$db_user = 'root';
$db_password = '';
$pdo = new pdo("mysql:host=$db_host;dbname=$db_name;port=3308", $db_user, $db_password);

// $db_host = 'https://www.uni-due.de/phpmyadmin/?server=5';
// $db_name = 'smchnage_1';
// $db_port = '3306';
// $db_user = 'smchnage';
// $db_password = 'smYo6cwlsV5l';
// $db_server = 'db12.uni-duisburg-essen.de';

// try {
//     $pdo = new pdo("mysql:host=$db_server;dbname=$db_name;port=$db_port", $db_user, $db_password);
// } catch (PDOException $e) {
//     echo 'Connection failed: ' . $e->getMessage();
// }

?>
