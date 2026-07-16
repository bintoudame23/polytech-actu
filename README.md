# Polytech Actu — Version MVC

## Architecture

```
actu-app/
├── config/
│   └── Database.php          -> connexion PDO à MySQL
├── models/
│   ├── Article.php           -> requêtes SQL sur les articles
│   └── Categorie.php         -> requêtes SQL sur les catégories
├── controllers/
│   ├── ArticleController.php -> logique des pages articles
│   └── CategorieController.php -> logique des pages catégories
├── views/
│   ├── partials/
│   │   ├── header.php        -> bandeau + menu (inclus partout)
│   │   └── footer.php        -> fin de page (inclus partout)
│   ├── accueil.php           -> liste des articles
│   ├── detail.php            -> détail d'un article
│   ├── formulaire_article.php   -> ajout / modification d'un article
│   └── formulaire_categorie.php -> gestion des catégories
├── public/css/style.css      -> tous les styles du site
├── index.php                 -> contrôleur frontal (routeur unique)
└── mglsi_news.sql            -> script de création de la base
```

## Principe MVC

- **Modèle** (`models/`) : parle uniquement à la base de données (SQL). Aucun HTML.
- **Vue** (`views/`) : affiche uniquement du HTML à partir des données reçues. Aucun SQL.
- **Contrôleur** (`controllers/`) : récupère les données via le Modèle puis choisit la Vue à afficher. Aucun SQL, aucun HTML.
- **index.php** : point d'entrée unique. Toutes les URLs passent par `index.php?page=...` et sont redirigées vers le bon contrôleur.

## Installation

1. Créer la base de données :
   ```
   mysql -u root -p < mglsi_news.sql
   ```
2. Copier le dossier `actu-app` dans le dossier de votre serveur local (ex: `htdocs` pour XAMPP, `www` pour WAMP).
3. Ouvrir dans le navigateur : `http://localhost/actu-app/`

Si votre utilisateur/mot de passe MySQL diffèrent, modifiez-les dans `config/Database.php`.

## Fonctionnalités

- Page d'accueil listant tous les articles.
- Filtrage par catégorie via le menu (Sport, Santé, Education, Politique, ...).
- Page de détail d'un article.
- Ajout / modification / suppression d'un article.
- Ajout / modification / suppression d'une catégorie.
- Toutes les données viennent de la base MySQL (rien n'est écrit en dur).
