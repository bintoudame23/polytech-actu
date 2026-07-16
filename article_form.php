<?php
/**
 * article_form.php
 * -----------------------------------------------------------
 * Version 1 - Simple. Un seul formulaire pour ajouter OU modifier
 * un article :
 * - article_form.php            -> mode ajout
 * - article_form.php?id=3       -> mode modification (pré-rempli)
 * Le formulaire envoie ses données à article_action.php
 * -----------------------------------------------------------
 */
require 'db.php';

$categories = $pdo->query("SELECT * FROM Categorie ORDER BY libelle")->fetchAll(PDO::FETCH_ASSOC);

$article = null;
if (isset($_GET['id'])) {
    $requete = $pdo->prepare("SELECT * FROM Article WHERE id = ?");
    $requete->execute([(int) $_GET['id']]);
    $article = $requete->fetch(PDO::FETCH_ASSOC);
}
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

    <h2 class="titre-page"><?= $article ? "Modifier l'article" : "Ajouter un article" ?></h2>

    <form class="formulaire" action="article_action.php" method="post">

        <input type="hidden" name="action" value="<?= $article ? 'modifier' : 'ajouter' ?>">

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

        <button type="submit"><?= $article ? 'Enregistrer les modifications' : "Publier l'article" ?></button>
    </form>
</main>

</body>
</html>
