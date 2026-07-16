<?php
/**
 * categorie_form.php
 * -----------------------------------------------------------
 * Version 1 - Simple. Affiche la liste des catégories et un
 * formulaire pour en ajouter une nouvelle ou en modifier une.
 * -----------------------------------------------------------
 */
require 'db.php';

$categories = $pdo->query("SELECT * FROM Categorie ORDER BY libelle")->fetchAll(PDO::FETCH_ASSOC);

$categorieAModifier = null;
if (isset($_GET['id'])) {
    $requete = $pdo->prepare("SELECT * FROM Categorie WHERE id = ?");
    $requete->execute([(int) $_GET['id']]);
    $categorieAModifier = $requete->fetch(PDO::FETCH_ASSOC);
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

    <h2 class="titre-page">Gestion des catégories</h2>

    <div class="carte-article">
        <h3>Catégories existantes</h3>
        <ul>
            <?php foreach ($categories as $cat): ?>
                <li>
                    <?= htmlspecialchars($cat['libelle']) ?>
                    &nbsp;
                    <a href="categorie_form.php?id=<?= $cat['id'] ?>">Modifier</a>
                    &nbsp;
                    <a href="categorie_action.php?action=supprimer&id=<?= $cat['id'] ?>"
                       onclick="return confirm('Supprimer cette catégorie ? Les articles liés seront aussi supprimés.');">Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <form class="formulaire" action="categorie_action.php" method="post">

        <input type="hidden" name="action" value="<?= $categorieAModifier ? 'modifier' : 'ajouter' ?>">

        <?php if ($categorieAModifier): ?>
            <input type="hidden" name="id" value="<?= $categorieAModifier['id'] ?>">
        <?php endif; ?>

        <label for="libelle"><?= $categorieAModifier ? 'Modifier la catégorie' : 'Nouvelle catégorie' ?></label>
        <input type="text" id="libelle" name="libelle" maxlength="20" required
               value="<?= $categorieAModifier ? htmlspecialchars($categorieAModifier['libelle']) : '' ?>">

        <button type="submit"><?= $categorieAModifier ? 'Enregistrer' : 'Ajouter' ?></button>
    </form>
</main>

</body>
</html>
