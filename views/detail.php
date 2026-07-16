<?php
/**
 * views/detail.php
 * Affiche un article en entier (titre + contenu complet).
 */
$categories = $data['categories'];
$article = $data['article'];
$categorieActive = null;

require __DIR__ . '/partials/header.php';
?>

<a class="lien-retour" href="index.php?page=accueil">&larr; Retour aux actualités</a>

<?php if (!$article): ?>
    <p>Article introuvable.</p>
<?php else: ?>
    <div class="detail-article">
        <h2><?= htmlspecialchars($article['titre']) ?></h2>

        <div class="meta">
            Catégorie : <?= htmlspecialchars($article['categorie_libelle']) ?>
            &nbsp;|&nbsp;
            Publié le <?= date('d/m/Y à H:i', strtotime($article['dateCreation'])) ?>
            <?php if ($article['dateModification'] !== $article['dateCreation']): ?>
                (modifié le <?= date('d/m/Y à H:i', strtotime($article['dateModification'])) ?>)
            <?php endif; ?>
        </div>

        <p><?= nl2br(htmlspecialchars($article['contenu'])) ?></p>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/partials/footer.php'; ?>
