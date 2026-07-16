<?php
/**
 * views/accueil.php
 * -----------------------------------------------------------
 * Cette vue affiche uniquement du HTML. Toutes les données
 * dont elle a besoin ($articles, $categories, $categorieActive)
 * lui sont transmises par ArticleController::accueil().
 * -----------------------------------------------------------
 */
$categories = $data['categories'];
$categorieActive = $data['categorieActive'];
$articles = $data['articles'];

require __DIR__ . '/partials/header.php';
?>

<h2 class="titre-page">Les dernières actualités</h2>

<div class="barre-actions">
    <a href="index.php?page=article_form">+ Ajouter un article</a>
    <a href="index.php?page=categorie_form">Gérer les catégories</a>
</div>

<?php if (empty($articles)): ?>
    <p>Aucun article pour le moment.</p>
<?php endif; ?>

<?php foreach ($articles as $article): ?>
    <div class="carte-article">
        <h3><a href="index.php?page=detail&id=<?= $article['id'] ?>"><?= htmlspecialchars($article['titre']) ?></a></h3>

        <p><?= htmlspecialchars(substr($article['contenu'], 0, 220)) ?>...</p>

        <div class="meta">
            Catégorie : <?= htmlspecialchars($article['categorie_libelle']) ?>
            &nbsp;|&nbsp;
            Publié le <?= date('d/m/Y', strtotime($article['dateCreation'])) ?>
        </div>

        <div class="actions">
            <a href="index.php?page=article_form&id=<?= $article['id'] ?>">Modifier</a>
            <a href="index.php?page=article_supprimer&id=<?= $article['id'] ?>"
               onclick="return confirm('Supprimer cet article ?');">Supprimer</a>
        </div>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/partials/footer.php'; ?>
