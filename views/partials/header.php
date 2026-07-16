<?php
/**
 * views/partials/header.php
 * -----------------------------------------------------------
 * Ce partiel affiche le <head>, le bandeau titre et le menu.
 * Il est inclus au début de chaque vue pour éviter de répéter
 * ce code partout (DRY : Don't Repeat Yourself).
 *
 * Il attend une variable $categories (liste des catégories)
 * et éventuellement $categorieActive (id de la catégorie
 * actuellement sélectionnée, pour la surligner dans le menu).
 * -----------------------------------------------------------
 */
if (!isset($categorieActive)) {
    $categorieActive = null;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Polytech Actu</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<header class="site-header">
    <h1>Actualités Polytechniciennes</h1>
</header>

<nav class="site-nav">
    <ul>
        <li><a href="index.php?page=accueil" class="<?= $categorieActive === null ? 'actif' : '' ?>">Accueil</a></li>
        <?php foreach ($categories as $cat): ?>
            <li>
                <a href="index.php?page=accueil&categorie=<?= $cat['id'] ?>"
                   class="<?= $categorieActive == $cat['id'] ? 'actif' : '' ?>">
                    <?= htmlspecialchars($cat['libelle']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<main>
