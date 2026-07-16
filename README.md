# Polytech Actu — Version 1 (simple, sans MVC)

## Principe

Cette version 1 est volontairement **simple** : chaque page PHP contient à la
fois la connexion, les requêtes SQL et le HTML. C'est la base de départ,
avant de passer à l'architecture MVC (voir la branche `v2`).

## Fichiers

```
actu-app-v1/
├── db.php                -> connexion à la base de données
├── index.php              -> page d'accueil (liste + filtre par catégorie)
├── detail.php              -> détail d'un article
├── article_form.php        -> formulaire ajout/modification d'un article
├── article_action.php      -> traite le formulaire (ajout/modif/suppression)
├── categorie_form.php      -> liste + formulaire des catégories
├── categorie_action.php    -> traite le formulaire catégorie
├── css/style.css           -> styles du site
└── mglsi_news.sql          -> script de création de la base
```

## Installation

1. Importer `mglsi_news.sql` dans MySQL (via phpMyAdmin par exemple).
2. Copier ce dossier dans `htdocs` (XAMPP).
3. Vérifier les identifiants dans `db.php` (host, port, user, password).
4. Ouvrir `http://localhost/actu-app-v1/`.

## Fonctionnalités

- Accueil listant tous les articles.
- Filtrage par catégorie via le menu.
- Détail d'un article.
- Ajout / modification / suppression d'un article.
- Ajout / modification / suppression d'une catégorie.
