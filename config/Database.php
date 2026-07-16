<?php
/**
 * config/Database.php
 * -----------------------------------------------------------
 * Ce fichier ne fait qu'une seule chose : ouvrir la connexion
 * vers la base de données MySQL "mglsi_news" et la renvoyer.
 * Tous les Modèles (Article, Categorie) utiliseront cette
 * connexion pour lire/écrire dans la base.
 * -----------------------------------------------------------
 */

class Database
{
    // Informations de connexion (à adapter si besoin)
    private $host = "localhost";
    private $dbname = "mglsi_news";
    private $user = "mglsi_user";
    private $password = "passer";

    // Retourne un objet PDO connecté à la base
    public function getConnexion()
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->password
            );
            // Pour que PDO nous prévienne en cas d'erreur SQL
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}
