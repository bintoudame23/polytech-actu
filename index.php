<?php


require_once __DIR__ . '/controllers/ArticleController.php';
require_once __DIR__ . '/controllers/CategorieController.php';

// La page demandée. Par défaut : l'accueil.
$page = $_GET['page'] ?? 'accueil';

$articleController = new ArticleController();
$categorieController = new CategorieController();

switch ($page) {

    // ---- Articles ----
    case 'accueil':
        $articleController->accueil();
        break;

    case 'detail':
        $articleController->detail();
        break;

    case 'article_form':
        $articleController->formulaire();
        break;

    case 'article_enregistrer':
        $articleController->enregistrer();
        break;

    case 'article_supprimer':
        $articleController->supprimer();
        break;

    // ---- Catégories ----
    case 'categorie_form':
        $categorieController->formulaire();
        break;

    case 'categorie_enregistrer':
        $categorieController->enregistrer();
        break;

    case 'categorie_supprimer':
        $categorieController->supprimer();
        break;

    // ---- Page inconnue ----
    default:
        echo "Page introuvable.";
        break;
}
