<?php
/**
 * views/formulaire_article.php
 * Un seul et même formulaire sert pour l'ajout ET la modification :
 * - si $article est vide -> on est en mode "ajout"
 * - si $article contient des données -> on est en mode "modification"
 */
$categories = $data['categories'];
$article = $data['article'];
$categorieActive = null;

require __DIR__ . '/partials/header.php';
?>

<a class="lien-retour" href="index.php?page=accueil">&larr; Retour aux actualités</a>

<h2 class="titre-page"><?= $article ? 'Modifier l\'article' : 'Ajouter un article' ?></h2>

<form class="formulaire" action="index.php?page=article_enregistrer" method="post">

    <!-- Si on modifie un article, on transmet son id en champ caché -->
    <?php if ($article): ?>
        <input type="hidden" name="id" value="<?= $article['id'] ?>">
    <?php endif; ?>

    <label for="titre">Titre</label>
    <input type="text" id="titre" name="titre" required
           value="<?= $article ? htmlspecialchars($article['titre']) : '' ?>">

    <label for="categorie">Catégorie</label>
    <select id="categorie" name="categorie" required>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"
                <?= ($article && $article['categorie'] == $cat['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['libelle']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="contenu">Contenu</label>
    <textarea id="contenu" name="contenu" required><?= $article ? htmlspecialchars($article['contenu']) : '' ?></textarea>

    <button type="submit"><?= $article ? 'Enregistrer les modifications' : 'Publier l\'article' ?></button>
</form>

<?php require __DIR__ . '/partials/footer.php'; ?>
