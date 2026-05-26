# Foncier_GloV3

Système de gestion foncière développé en PHP natif avec MySQL. Le projet gère les parcelles, propriétaires, alertes, litiges et transferts fonciers, avec un espace staff (`admin/`) et un espace propriétaire/consultant (`consultant/`).

## Vue d'ensemble

- `index.php` : point d'entrée du projet. Vérifie et crée certains dossiers de sécurité, puis redirige vers le tableau de bord.
- `login.php` : gestion de l'authentification pour le staff (`users`) et les consultants/propriétaires (`proprietaires`).
- `dashboard.php` : interface principale du staff avec des statistiques et des transferts récents.
- `config/database.php` : configuration de connexion MySQL.
- `config/session.php` : gestion des sessions, des rôles, de la validation d'accès et des fonctions utilitaires.
- `foncier_glov2.sql` : script SQL de base de données contenant la structure des tables et des jeux de données initiaux.

## Structure du projet

- `admin/`
  - `alertes/`
  - `litiges/`
  - `parcelles/`
  - `proprietaires/`
  - `transferts/`
  - `users/`
- `consultant/`
  - `parcelles/`
  - `transferts/`
- `assets/`
  - `css/`
  - `images/`
  - `js/`
  - `uploads/`
- `config/`
  - `database.php`
  - `session.php`
- `includes/`
  - `header.php`
  - `footer.php`
  - `navbar_admin.php`
  - `navbar_consultant.php`

## Prérequis

- PHP 8.0+ (ou version compatible)
- MySQL / MariaDB
- Serveur HTTP (Apache, XAMPP, WAMP, etc.)
- Extensions PHP : `mysqli`, `session`

## Installation

1. Copier le projet dans le dossier de votre serveur local, par exemple `C:\xampp\htdocs\Foncier_GloV3`.
2. Créer une base de données MySQL. Par défaut, le fichier `config/database.php` utilise :
   - hôte : `localhost`
   - utilisateur : `root`
   - mot de passe : `` (vide)
   - base : `foncier_v2`

3. Importer le fichier SQL `foncier_glov2.sql` dans la base de données.

   Exemple avec MySQL :
   ```sql
   CREATE DATABASE foncier_v2 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   USE foncier_v2;
   SOURCE /chemin/vers/foncier_glov2.sql;
   ```

4. Vérifier et adapter si nécessaire les constantes dans `config/database.php` :
   - `DB_HOST`
   - `DB_USER`
   - `DB_PASS`
   - `DB_NAME`

5. Ouvrir le projet dans un navigateur via l'URL de votre serveur local, par exemple :
   `http://localhost/Foncier_GloV3/login.php`

## Configuration

- `config/database.php` contient la fonction `getConnexion()` qui initialise la connexion MySQL.
- `config/session.php` gère l'authentification et propose :
  - `estConnecte()`
  - `requiertConnexion()`
  - `requiertRole($roles)`
  - `redirigerSelonRole()`
  - `nettoyer($donnee)`
  - `flashMessage($type, $message)`
  - `afficherFlash()`

## Rôles et accès

Le projet supporte plusieurs rôles métier :

- `administrateur`
- `agent_sade`
- `chef_service`
- `consultant`

### Accès

- `admin/` : réservé au personnel interne (`administrateur`, `agent_sade`, `chef_service`).
- `consultant/` : réservé aux propriétaires / consultants.

## Fonctionnalités principales

- Gestion des parcelles (création, modification, consultation, suppression)
- Gestion des propriétaires et comptes consultants
- Gestion des alertes et litiges fonciers
- Suivi des transferts fonciers et de leur statut
- Dashboard administratif avec statistiques et transferts récents
- Gestion de sessions et contrôle d'accès basé sur les rôles

## Bonnes pratiques

- Protéger l'accès au dossier `assets/uploads/` via le serveur web si nécessaire.
- Ne pas exposer `config/database.php` en dehors du serveur.
- Utiliser des mots de passe sécurisés pour les comptes de production.
- Ajuster `DB_USER` et `DB_PASS` pour éviter l'utilisation du compte `root` en production.

## Notes spécifiques

- `index.php` crée automatiquement certains dossiers nécessaires au premier accès du projet.
- `login.php` traite l’authentification du staff via `users` et des consultants via `proprietaires`.
- La structure SQL inclut des tables pour `parcelles`, `proprietaires`, `transferts`, `litiges`, `alertes`, et `users`.

## Vérification IA

Aucune mention explicite d'IA ou de commentaire généré par un assistant n'a été trouvée dans le code source du projet.

## Utilisation

1. Se connecter via `login.php`.
2. Pour le staff, accéder au tableau de bord principal `dashboard.php`.
3. Pour un consultant, accéder à l’espace `consultant/dashboard.php`.
4. Utiliser les menus `admin/` ou `consultant/` selon le rôle pour gérer les parcelles, transferts et autres entités.

---

Ce `README.md` peut être complété ultérieurement avec des captures d'écran, des exemples de comptes et une documentation détaillée des API si le projet évolue.