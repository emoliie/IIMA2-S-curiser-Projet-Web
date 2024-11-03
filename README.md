# IIMA2-Securiser-Projet-Web

## Description
Ce projet est une application web CRUD (Créer, Lire, Mettre à jour, Supprimer) développée pour le cours Sécuriser un projet Web. Il permet de gérer des utilisateurs et des articles en utilisant PHP et PDO pour interagir avec une base de données MySQL.

## Fonctionnalités
- **Gestion des utilisateurs** : Inscription, connexion, et gestion des rôles.
- **Gestion des articles** : Création, affichage, modification et suppression d'articles.
- **Contrôle d'accès** : Sécurisation des pages pour les utilisateurs autorisés uniquement.

## Prérequis
- PHP 7.4+
- MySQL
- Serveur web (Apache ou Nginx)

## Installation
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/emoliie/IIMA2-Securiser-Projet-Web.git
   ```
2. Accédez au dossier du projet :
   ```bash
   cd IIMA2-Securiser-Projet-Web
   ```
3. Configurez votre base de données.
4. Modifiez le fichier de configuration pour connecter à votre base de données.

## Configuration
Stockez vos propres informations de connexion dans le fichier `ddb.php` à la racine du projet avec les informations suivantes :
```bash
$host = 'localhost';
$db = 'votre_database';
$user = 'votre_username';
$pass = 'votre_mot_de_passe';
```


## Utilisation
- Inscrivez-vous pour créer un compte.
- Connectez-vous pour gérer des articles.
- Les administrateurs peuvent modifier ou supprimer des articles.

## Auteur
- Emilie XU
