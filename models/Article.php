<?php
/**
 * models/Article.php
 * -----------------------------------------------------------
 * Même principe que Categorie.php : uniquement des requêtes
 * SQL pour lire/écrire des articles dans la base.
 * -----------------------------------------------------------
 */

require_once __DIR__ . '/../config/Database.php';

class Article
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnexion();
    }

    // Récupère tous les articles (avec le libellé de leur catégorie grâce à une jointure)
    // Si $categorieId est fourni, on ne récupère que les articles de cette catégorie
    public function getAll($categorieId = null)
    {
        $sql = "SELECT a.*, c.libelle AS categorie_libelle
                FROM Article a
                JOIN Categorie c ON a.categorie = c.id";

        if ($categorieId) {
            $sql .= " WHERE a.categorie = ?";
            $sql .= " ORDER BY a.dateCreation DESC";
            $requete = $this->pdo->prepare($sql);
            $requete->execute([$categorieId]);
        } else {
            $sql .= " ORDER BY a.dateCreation DESC";
            $requete = $this->pdo->query($sql);
        }

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère un seul article grâce à son id
    public function getById($id)
    {
        $sql = "SELECT a.*, c.libelle AS categorie_libelle
                FROM Article a
                JOIN Categorie c ON a.categorie = c.id
                WHERE a.id = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->execute([$id]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    // Ajoute un nouvel article
    public function create($titre, $contenu, $categorieId)
    {
        $sql = "INSERT INTO Article (titre, contenu, categorie) VALUES (?, ?, ?)";
        $requete = $this->pdo->prepare($sql);
        $requete->execute([$titre, $contenu, $categorieId]);
    }

    // Modifie un article existant (la dateModification se met à jour automatiquement)
    public function update($id, $titre, $contenu, $categorieId)
    {
        $sql = "UPDATE Article
                SET titre = ?, contenu = ?, categorie = ?, dateModification = NOW()
                WHERE id = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->execute([$titre, $contenu, $categorieId, $id]);
    }

    // Supprime un article
    public function delete($id)
    {
        $requete = $this->pdo->prepare("DELETE FROM Article WHERE id = ?");
        $requete->execute([$id]);
    }
}
