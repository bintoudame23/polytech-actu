<?php
/**
 * db.php
 * -----------------------------------------------------------
 * Version 1 - Simple.
 * Ce fichier ouvre juste la connexion à MySQL. On l'inclut
 * (require) en haut de chaque page qui a besoin de la base.
 * Pas de classe ici : on reste simple pour cette version 1.
 * -----------------------------------------------------------
 */

$host = "localhost";
$port = "3307"; // adapte selon la config de ton XAMPP (3306 par défaut)
$dbname = "mglsi_news";
$user = "root";      // remplace par "mglsi_user" si tu as créé cet utilisateur
$password = "";       // remplace par "passer" si tu utilises mglsi_user

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",
        $user,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
