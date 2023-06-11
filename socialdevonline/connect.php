<?php

$host = "localhost";
$dbname = "socialdev_bdd";
$srv_username = "root";
$srv_password = "";

try {
    $bd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", $srv_username, $srv_password);
} catch (PDOException $e) {
    die("Erreur !: " . $e->getMessage());
}
