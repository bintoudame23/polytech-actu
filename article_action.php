<?php
/**
 * article_action.php
 * -----------------------------------------------------------
 * Version 1 - Simple. Ce fichier ne s'affiche jamais : il reçoit
 * les données du formulaire (ou un lien "supprimer"), fait la
 * requête SQL correspondante, puis redirige vers l'accueil.
 * -----------------------------------------------------------
 */
require 'db.php';

// L'action peut venir soit d'un formulaire (POST), soit d'un lien (GET)
$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action === 'ajouter') {
    $titre = trim($_POST['titre']);
    $contenu = trim($_POST['contenu']);
    $categorie = (int) $_POST['categorie'];

    $requete = $pdo->prepare("INSERT INTO Article (titre, contenu, categorie) VALUES (?, ?, ?)");
    $requete->execute([$titre, $contenu, $categorie]);

} elseif ($action === 'modifier') {
    $id = (int) $_POST['id'];
    $titre = trim($_POST['titre']);
    $contenu = trim($_POST['contenu']);
    $categorie = (int) $_POST['categorie'];

    $requete = $pdo->prepare(
        "UPDATE Article SET titre = ?, contenu = ?, categorie = ?, dateModification = NOW() WHERE id = ?"
    );
    $requete->execute([$titre, $contenu, $categorie, $id]);

} elseif ($action === 'supprimer') {
    $id = (int) $_GET['id'];

    $requete = $pdo->prepare("DELETE FROM Article WHERE id = ?");
    $requete->execute([$id]);
}

// Une fois l'action terminée, on retourne toujours à l'accueil
header('Location: index.php');
exit;
