<?php

//Hier Verbindungsdaten zur Datenbank eintragen
$db_host = 'localhost';
$db_name = 'testdb';
$db_user = 'root';
$db_password = '';
$pdo = new pdo("mysql:host=$db_host;dbname=$db_name;port=3308", $db_user, $db_password);
