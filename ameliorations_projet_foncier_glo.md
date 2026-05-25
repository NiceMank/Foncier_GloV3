# 🏛️ Améliorations du Projet — Système Foncier Glo

## 📅 Date : 25/05/2026

---

## 🎯 Idée Principale

Améliorer le système de gestion foncière en ajoutant :
- Un espace **Consultant** pour les propriétaires
- Un système de **transfert de propriété** en ligne
- Un **dashboard admin** selon le rôle
- La **génération automatique** des identifiants consultant

---

## 👥 Les 4 Rôles

| Rôle | Description |
|---|---|
| **Administrateur** | Peut tout faire + gérer les comptes |
| **Agent SADE** | Enregistre parcelles et propriétaires |
| **Chef de Service** | Supervise et valide les transferts |
| **Consultant** | Propriétaire qui consulte et vend |

---

## 🔄 Nouveau Flux de Fonctionnement

### ÉTAPE 1 — Enregistrement à l'agence
- Propriétaire vient à l'agence centrale
- Agent enregistre ses infos + sa parcelle
- Système génère email + mot de passe automatiquement
- Propriétaire reçoit ses identifiants de connexion

### ÉTAPE 2 — Connexion Consultant
- Propriétaire va sur le site
- Se connecte avec email + mot de passe reçus
- Accède à son dashboard personnel
- Visualise ses parcelles

### ÉTAPE 3 — Demande de Vente
- Consultant choisit la parcelle à vendre
- Remplit les infos du nouveau propriétaire
- Upload le document de preuve (PDF ou PNG)
- Soumet la demande → Statut : **En attente**

### ÉTAPE 4 — Vérification par les Gestionnaires
- Agent/Chef reçoit la notification
- Vérifie le document uploadé
- Appelle les parties concernées
- **Si valide** → Transfert effectué, parcelle change de propriétaire
- **Si rejeté** → Commentaire envoyé au consultant

---

## 📁 Nouvelle Structure du Projet

```
foncier_glo/
│
├── 📄 login.php              ← Connexion unifiée
├── 📄 logout.php
│
├── 📁 config/
│   ├── 📄 database.php
│   └── 📄 session.php        ← Gestion des 4 rôles
│
├── 📁 includes/
│   ├── 📄 header.php
│   ├── 📄 navbar_admin.php        ← Menu Admin/Agent/Chef
│   ├── 📄 navbar_consultant.php   ← Menu Consultant
│   └── 📄 footer.php
│
├── 📁 assets/
│   ├── 📁 css/
│   │   ├── 📄 style.css
│   │   ├── 📄 dashboard.css
│   │   └── 📄 consultant.css      ← Style interface consultant
│   ├── 📁 js/
│   │   └── 📄 script.js
│   └── 📁 uploads/
│       └── 📁 transferts/         ← Documents de vente uploadés
│
├── 📁 admin/                      ← Espace Admin/Agent/Chef
│   ├── 📄 dashboard.php           ← Dashboard selon rôle
│   ├── 📁 parcelles/
│   ├── 📁 proprietaires/          ← Génère identifiants consultant
│   ├── 📁 alertes/
│   ├── 📁 litiges/
│   ├── 📁 transferts/             ← Gestion transferts propriété
│   │   ├── 📄 index.php           ← Liste demandes
│   │   ├── 📄 show.php            ← Détails + validation
│   │   └── 📄 valider.php         ← Validation transfert
│   └── 📁 users/                  ← Gestion agents (Admin only)
│       ├── 📄 index.php
│       ├── 📄 create.php
│       └── 📄 edit.php
│
└── 📁 consultant/                 ← Espace Consultant
    ├── 📄 dashboard.php           ← Mes parcelles
    ├── 📁 parcelles/
    │   ├── 📄 index.php           ← Mes parcelles
    │   └── 📄 show.php            ← Détails
    └── 📁 transferts/
        ├── 📄 create.php          ← Demande de vente
        ├── 📄 index.php           ← Mes demandes
        └── 📄 show.php            ← Statut demande
```

---

## 🗄️ Nouvelles Tables SQL

### Table `transferts`
```sql
CREATE TABLE transferts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reference VARCHAR(100) NOT NULL UNIQUE,
    parcelle_id INT UNSIGNED NOT NULL,
    ancien_proprietaire_id INT UNSIGNED NOT NULL,
    nouveau_nom VARCHAR(100) NOT NULL,
    nouveau_prenom VARCHAR(100) NOT NULL,
    nouveau_npi VARCHAR(50) NOT NULL,
    nouveau_telephone VARCHAR(20) NOT NULL,
    nouveau_email VARCHAR(150) NULL,
    nouveau_adresse TEXT NOT NULL,
    document_preuve VARCHAR(255) NOT NULL,
    statut ENUM('en_attente','en_verification','valide','rejete')
           NOT NULL DEFAULT 'en_attente',
    commentaire TEXT NULL,
    agent_validateur_id INT UNSIGNED NULL,
    date_validation TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
               ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Modifications table `proprietaires`
```sql
ALTER TABLE proprietaires
    ADD COLUMN email_connexion VARCHAR(150) UNIQUE NULL,
    ADD COLUMN password_connexion VARCHAR(255) NULL,
    ADD COLUMN compte_actif ENUM('oui','non') DEFAULT 'non';
```

---

## 🎨 Interfaces à Concevoir (Maquettes)

- [ ] Page de connexion unifiée
- [ ] Dashboard Admin
- [ ] Dashboard Agent SADE
- [ ] Dashboard Chef de Service
- [ ] Dashboard Consultant
- [ ] Formulaire demande de vente
- [ ] Page validation transfert

---

## ⚠️ Statut

```
✅ Idée documentée
⏳ À implémenter après la structure actuelle
```
