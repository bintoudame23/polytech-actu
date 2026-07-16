<?php
/**
 * controllers/CategorieController.php
 * -----------------------------------------------------------
 * Même logique que ArticleController, mais pour gérer les
 * catégories (ajouter / modifier / supprimer).
 * -----------------------------------------------------------
 */

require_once __DIR__ . '/../models/Categorie.php';

class CategorieController
{
    private $categorieModel;

    public function __construct()
    {
        $this->categorieModel = new Categorie();
    }

    // Formulaire d'ajout / modification d'une catégorie
    public function formulaire()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        $data = [
            'categorieAModifier' => $id ? $this->categorieModel->getById($id) : null,
            'categories'         => $this->categorieModel->getAll(),
        ];

        require __DIR__ . '/../views/formulaire_categorie.php';
    }

    // Enregistrement (ajout ou modification) envoyé par le formulaire
    public function enregistrer()
    {
        $libelle = trim($_POST['libelle']);

        if (!empty($_POST['id'])) {
            $this->categorieModel->update($_POST['id'], $libelle);
        } else {
            $this->categorieModel->create($libelle);
        }

        header('Location: index.php?page=accueil');
        exit;
    }

    // Suppression d'une catégorie
    public function supprimer()
    {
        $this->categorieModel->delete((int) $_GET['id']);
        header('Location: index.php?page=accueil');
        exit;
    }
}
