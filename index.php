<?php
/**
 * index.php
 * -----------------------------------------------------------
 * Version 1 - Simple (pas de MVC ici, tout est dans la même page :
 * connexion, requêtes SQL et affichage HTML mélangés).
 *
 * Cette page affiche :
 * - la liste de toutes les catégories dans le menu
 * - la liste des articles (tous, ou filtrés par catégorie si
 *   l'URL contient ?categorie=X)
 * -----------------------------------------------------------
 */
require 'db.php';

// 1. Récupérer toutes les catégories, pour construire le menu
$categories = $pdo->query("SELECT * FROM Categorie ORDER BY libelle")->fetchAll(PDO::FETCH_ASSOC);

// 2. Regarder si une catégorie a été choisie dans l'URL (ex: index.php?categorie=1)
$categorieActive = isset($_GET['categorie']) ? (int) $_GET['categorie'] : null;

// 3. Récupérer les articles : tous, ou seulement ceux de la catégorie choisie
if ($categorieActive) {
    $requete = $pdo->prepare(
        "SELECT a.*, c.libelle AS categorie_libelle
         FROM Article a
         JOIN Categorie c ON a.categorie = c.id
         WHERE a.categorie = ?
         ORDER BY a.dateCreation DESC"
    );
    $requete->execute([$categorieActive]);
} else {
    $requete = $pdo->query(
        "SELECT a.*, c.libelle AS categorie_libelle
         FROM Article a
         JOIN Categorie c ON a.categorie = c.id
         ORDER BY a.dateCreation DESC"
    );
}
$articles = $requete->fetchAll(PDO::FETCH_ASSOC);
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
        <li><a href="index.php" class="<?= $categorieActive === null ? 'actif' : '' ?>">Accueil</a></li>
        <?php foreach ($categories as $cat): ?>
            <li>
                <a href="index.php?categorie=<?= $cat['id'] ?>"
                   class="<?= $categorieActive == $cat['id'] ? 'actif' : '' ?>">
                    <?= htmlspecialchars($cat['libelle']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<main>
    <h2 class="titre-page">Les dernières actualités</h2>

    <div class="barre-actions">
        <a href="article_form.php">+ Ajouter un article</a>
        <a href="categorie_form.php">Gérer les catégories</a>
    </div>

    <?php if (empty($articles)): ?>
        <p>Aucun article pour le moment.</p>
    <?php endif; ?>

    <?php foreach ($articles as $article): ?>
        <div class="carte-article">
            <h3><a href="detail.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['titre']) ?></a></h3>

            <p><?= htmlspecialchars(substr($article['contenu'], 0, 220)) ?>...</p>

            <div class="meta">
                Catégorie : <?= htmlspecialchars($article['categorie_libelle']) ?>
                &nbsp;|&nbsp;
                Publié le <?= date('d/m/Y', strtotime($article['dateCreation'])) ?>
            </div>

            <div class="actions">
                <a href="article_form.php?id=<?= $article['id'] ?>">Modifier</a>
                <a href="article_action.php?action=supprimer&id=<?= $article['id'] ?>"
                   onclick="return confirm('Supprimer cet article ?');">Supprimer</a>
            </div>
        </div>
    <?php endforeach; ?>
</main>

</body>
</html>
