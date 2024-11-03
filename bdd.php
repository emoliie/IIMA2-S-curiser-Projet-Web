<?php

// Paramètres de connexion
$host = 'localhost';
$db = 'votre_database';
$user = 'votre_username';
$pass = 'votre_mot_de_passe';

try {

    $database = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die($e->getMessage());
}
