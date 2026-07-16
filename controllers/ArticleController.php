<?php

require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../models/Categorie.php';

class ArticleController
{
    private $articleModel;
    private $categorieModel;

    public function __construct()
    {
        $this->articleModel = new Article();
        $this->categorieModel = new Categorie();
    }

    // Page d'accueil : liste des articles (toutes catégories ou une seule)
    public function accueil()
    {
        $categorieId = isset($_GET['categorie']) ? (int) $_GET['categorie'] : null;

        $data = [
            'articles'    => $this->articleModel->getAll($categorieId),
            'categories'  => $this->categorieModel->getAll(),
            'categorieActive' => $categorieId,
        ];

        require __DIR__ . '/../views/accueil.php';
    }

    // Page de détail d'un article
    public function detail()
    {
        $id = (int) $_GET['id'];

        $data = [
            'article'    => $this->articleModel->getById($id),
            'categories' => $this->categorieModel->getAll(),
        ];

        require __DIR__ . '/../views/detail.php';
    }

    // Formulaire d'ajout / modification d'un article
    public function formulaire()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        $data = [
            'article'    => $id ? $this->articleModel->getById($id) : null,
            'categories' => $this->categorieModel->getAll(),
        ];

        require __DIR__ . '/../views/formulaire_article.php';
    }

    // Traitement de l'enregistrement (ajout ou modification) envoyé par le formulaire
    public function enregistrer()
    {
        $titre = trim($_POST['titre']);
        $contenu = trim($_POST['contenu']);
        $categorieId = (int) $_POST['categorie'];

        if (!empty($_POST['id'])) {
            // Un id existe déjà -> on modifie l'article
            $this->articleModel->update($_POST['id'], $titre, $contenu, $categorieId);
        } else {
            // Pas d'id -> nouvel article
            $this->articleModel->create($titre, $contenu, $categorieId);
        }

        header('Location: index.php?page=accueil');
        exit;
    }

    // Suppression d'un article
    public function supprimer()
    {
        $this->articleModel->delete((int) $_GET['id']);
        header('Location: index.php?page=accueil');
        exit;
    }
}
