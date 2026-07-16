<?php
/**
 * detail.php
 * -----------------------------------------------------------
 * Version 1 - Simple. Affiche un article en entier.
 * L'id de l'article vient de l'URL : detail.php?id=3
 * -----------------------------------------------------------
 */
require 'db.php';

$id = (int) $_GET['id'];

$requete = $pdo->prepare(
    "SELECT a.*, c.libelle AS categorie_libelle
     FROM Article a
     JOIN Categorie c ON a.categorie = c.id
     WHERE a.id = ?"
);
$requete->execute([$id]);
$article = $requete->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Polytech Actu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="site-header">
    <h1>Actualités Polytechniciennes</h1>
</header>

<nav class="site-nav">
    <ul>
        <li><a href="index.php">Accueil</a></li>
    </ul>
</nav>

<main>
    <a class="lien-retour" href="index.php">&larr; Retour aux actualités</a>

    <?php if (!$article): ?>
        <p>Article introuvable.</p>
    <?php else: ?>
        <div class="detail-article">
            <h2><?= htmlspecialchars($article['titre']) ?></h2>

            <div class="meta">
                Catégorie : <?= htmlspecialchars($article['categorie_libelle']) ?>
                &nbsp;|&nbsp;
                Publié le <?= date('d/m/Y à H:i', strtotime($article['dateCreation'])) ?>
            </div>

            <p><?= nl2br(htmlspecialchars($article['contenu'])) ?></p>
        </div>
    <?php endif; ?>
</main>

</body>
</html>
