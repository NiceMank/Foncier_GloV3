
# Cahier des Charges : Système Foncier Glo

## 1. Présentation du Projet
Le projet "Système Foncier Glo" est une plateforme de gestion foncière destinée à la commune de Glo-Djigbé (Bénin). Son objectif est de digitaliser le suivi des parcelles, des propriétaires et des litiges pour une meilleure transparence et efficacité administrative.

## 2. Objectifs
- **Digitalisation :** Remplacer les registres papier par une base de données centralisée.
- **Cartographie :** Visualiser les parcelles sur une carte interactive (Leaflet).
- **Sécurité :** Contrôler strictement les accès aux données foncières.

## 3. Architecture Technique
- **Serveur :** PHP 8.x
- **Base de données :** MySQL
- **Interface :** HTML5, CSS3 (Bootstrap 5, Material Design)
- **Cartographie :** Leaflet.js

## 4. Fonctionnalités Détaillées

### A. Gestion des Parcelles
- Enregistrement (Référence, superficie, localisation).
- Attribution à un propriétaire.
- Suivi du statut (Libre / Occupée / En litige).

### B. Gestion des Propriétaires
- Annuaire centralisé.
- Historique des parcelles possédées.

### C. Cartographie
- Affichage des parcelles via marqueurs géographiques.
- Filtrage par arrondissement ou par statut.

### D. Gestion des Litiges et Alertes
- Système de signalement automatique (ex: occupation illégale).
- Suivi du cycle de vie du litige (Ouvert -> En cours -> Résolu).

## 5. Rôles et Responsabilités
| Rôle | Permissions |
| :--- | :--- |
| **Agent** | Saisie des données, consultation, modification simple |
| **Administrateur** | Gestion des comptes, validation, rapports, accès total |

## 6. Flux de Données (Processus)
1. **Saisie :** L'agent saisit une nouvelle parcelle dans `create.php`.
2. **Traitement :** Les données sont nettoyées (`session.php`) avant insertion.
3. **Visualisation :** Les données apparaissent instantanément sur le Dashboard et la Carte.
4. **Analyse :** L'admin consulte les statistiques pour prendre des décisions.

## 7. Roadmap d'Évolution
- [ ] Export des données en PDF/Excel.
- [ ] Upload de documents scannés (titres fonciers).
- [ ] Historique des modifications (Audit Log).
