<?php
/**
 * index.php - Contrôleur frontal (Front Controller)
 * -----------------------------------------------------------
 * Dans une architecture MVC, TOUTES les requêtes passent par
 * ce seul fichier. Il regarde le paramètre ?page=... dans
 * l'URL et appelle la bonne méthode du bon contrôleur.
 *
 * C'est le seul fichier "routeur" du projet : il ne contient
 * ni SQL, ni HTML, juste un aiguillage (switch).
 * -----------------------------------------------------------
 */

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
