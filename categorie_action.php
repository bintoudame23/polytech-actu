<?php
/**
 * categorie_action.php
 * -----------------------------------------------------------
 * Version 1 - Simple. Reçoit les données du formulaire catégorie
 * (ou un lien "supprimer"), exécute la requête SQL, puis redirige.
 * -----------------------------------------------------------
 */
require 'db.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action === 'ajouter') {
    $libelle = trim($_POST['libelle']);

    $requete = $pdo->prepare("INSERT INTO Categorie (libelle) VALUES (?)");
    $requete->execute([$libelle]);

} elseif ($action === 'modifier') {
    $id = (int) $_POST['id'];
    $libelle = trim($_POST['libelle']);

    $requete = $pdo->prepare("UPDATE Categorie SET libelle = ? WHERE id = ?");
    $requete->execute([$libelle, $id]);

} elseif ($action === 'supprimer') {
    $id = (int) $_GET['id'];

    $requete = $pdo->prepare("DELETE FROM Categorie WHERE id = ?");
    $requete->execute([$id]);
}

header('Location: index.php');
exit;
