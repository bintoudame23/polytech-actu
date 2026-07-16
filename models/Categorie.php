<?php
/**
 * models/Categorie.php
 * -----------------------------------------------------------
 * Le "Modèle" est la seule partie du code qui parle à la base
 * de données. Il contient uniquement des requêtes SQL, pas
 * d'affichage (HTML) ni de logique de page.
 * -----------------------------------------------------------
 */

require_once __DIR__ . '/../config/Database.php';

class Categorie
{
    private $pdo;

    public function __construct()
    {
        // On récupère la connexion PDO dès la création de l'objet
        $db = new Database();
        $this->pdo = $db->getConnexion();
    }

    // Récupère toutes les catégories, triées par libellé
    public function getAll()
    {
        $requete = $this->pdo->query("SELECT * FROM Categorie ORDER BY libelle");
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère une seule catégorie grâce à son id
    public function getById($id)
    {
        $requete = $this->pdo->prepare("SELECT * FROM Categorie WHERE id = ?");
        $requete->execute([$id]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    // Ajoute une nouvelle catégorie
    public function create($libelle)
    {
        $requete = $this->pdo->prepare("INSERT INTO Categorie (libelle) VALUES (?)");
        $requete->execute([$libelle]);
    }

    // Modifie le libellé d'une catégorie existante
    public function update($id, $libelle)
    {
        $requete = $this->pdo->prepare("UPDATE Categorie SET libelle = ? WHERE id = ?");
        $requete->execute([$libelle, $id]);
    }

    // Supprime une catégorie
    public function delete($id)
    {
        $requete = $this->pdo->prepare("DELETE FROM Categorie WHERE id = ?");
        $requete->execute([$id]);
    }
}
