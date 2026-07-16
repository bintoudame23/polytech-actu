<?php
/**
 * views/formulaire_categorie.php
 * Affiche la liste des catégories existantes ainsi qu'un
 * formulaire pour en ajouter une nouvelle ou modifier l'une
 * d'entre elles.
 */
$categorieActive = null;
$categorieAModifier = $data['categorieAModifier'];

require __DIR__ . '/partials/header.php';
?>

<a class="lien-retour" href="index.php?page=accueil">&larr; Retour aux actualités</a>

<h2 class="titre-page">Gestion des catégories</h2>

<div class="carte-article">
    <h3>Catégories existantes</h3>
    <ul>
        <?php foreach ($categories as $cat): ?>
            <li>
                <?= htmlspecialchars($cat['libelle']) ?>
                &nbsp;
                <a href="index.php?page=categorie_form&id=<?= $cat['id'] ?>">Modifier</a>
                &nbsp;
                <a href="index.php?page=categorie_supprimer&id=<?= $cat['id'] ?>"
                   onclick="return confirm('Supprimer cette catégorie ? Les articles liés seront aussi supprimés.');">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<form class="formulaire" action="index.php?page=categorie_enregistrer" method="post">

    <?php if ($categorieAModifier): ?>
        <input type="hidden" name="id" value="<?= $categorieAModifier['id'] ?>">
    <?php endif; ?>

    <label for="libelle"><?= $categorieAModifier ? 'Modifier la catégorie' : 'Nouvelle catégorie' ?></label>
    <input type="text" id="libelle" name="libelle" maxlength="20" required
           value="<?= $categorieAModifier ? htmlspecialchars($categorieAModifier['libelle']) : '' ?>">

    <button type="submit"><?= $categorieAModifier ? 'Enregistrer' : 'Ajouter' ?></button>
</form>

<?php require __DIR__ . '/partials/footer.php'; ?>
