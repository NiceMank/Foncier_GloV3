<?php
/**
 * Page: Gestion Nouveau Propriétaire
 * Role: Admin
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Nouveau Propriétaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --primary: #00375e; --secondary: #0b61a1; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9ff; color: #0b1c30; }
        .sidebar { position: fixed; left: 0; top: 0; height: 100vh; width: 18rem; background-color: #1f4e79; color: white; padding: 1.5rem; z-index: 1050; overflow-y: auto; }
        .sidebar a { display: flex; align-items: center; gap: 1rem; padding: 0.75rem 1rem; color: rgba(255,255,255,0.8); text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: var(--secondary); color: white; }
        .main-wrapper { margin-left: 18rem; display: flex; flex-direction: column; min-height: 100vh; }
        .top-app-bar { position: sticky; top: 0; z-index: 40; background-color: white; border-bottom: 1px solid #c2c7d0; padding: 1rem 2.5rem; display: flex; justify-content: space-between; align-items: center; min-height: 4rem; }
        .content-area { flex: 1; padding: 2.5rem; max-width: 80rem; margin: 0 auto; width: 100%; }
        .form-card { background-color: white; border: 1px solid #d3e4fe; border-radius: 0.75rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden; }
        .form-section { padding: 2rem; border-bottom: 1px solid #d3e4fe; }
        .form-section h2 { font-size: 1.1rem; font-weight: 600; color: var(--primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; margin-top: 0; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .form-row.full { grid-template-columns: 1fr; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-weight: 600; font-size: 0.875rem; color: #42474f; margin-bottom: 0.5rem; }
        .form-group label .required { color: red; }
        .form-group input, .form-group select { padding: 0.75rem; border: 1px solid #c2c7d0; border-radius: 0.5rem; font-size: 0.875rem; }
        .form-group input:focus, .form-group select:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(0,55,94,0.1); }
        .form-group input[readonly] { background-color: #eff4ff; }
        .account-info { background-color: #eff4ff; padding: 1.5rem; border-radius: 0.5rem; border: 1px solid #d3e4fe; }
        .account-info-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .account-info-row.full { grid-template-columns: 1fr; }
        .account-info-label { font-weight: 600; font-size: 0.875rem; color: #42474f; margin-bottom: 0.5rem; }
        .btn-group { display: flex; gap: 1rem; margin-top: 2rem; padding: 1.5rem; background-color: white; border-top: 1px solid #d3e4fe; }
        .btn { padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; border: none; cursor: pointer; font-size: 0.875rem; }
        .btn-primary { background-color: var(--primary); color: white; }
        .btn-secondary { background-color: white; color: var(--primary); border: 2px solid var(--primary); }
        .checkbox-group { display: flex; align-items: center; gap: 0.5rem; }
        .checkbox-group input { width: 1.25rem; height: 1.25rem; cursor: pointer; }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; margin: 0;">Système Foncier</h1>
        <p style="font-size: 0.85rem; opacity: 0.8; margin: 0;">Propriétaires</p>
    </div>
    <ul style="list-style: none; padding: 0; margin: 0;">
        <li><a href="#"><span class="material-symbols-outlined">dashboard</span> Tableau de Bord</a></li>
        <li><a href="#" class="active"><span class="material-symbols-outlined">group</span> Propriétaires</a></li>
        <li><a href="#"><span class="material-symbols-outlined">settings</span> Paramètres</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-wrapper">
    <header class="top-app-bar">
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: var(--primary);">Ajouter Nouveau Propriétaire</h2>
    </header>
    
    <div class="content-area">
        <form class="form-card">
            <!-- Information Civile -->
            <div class="form-section">
                <h2><span class="material-symbols-outlined">person</span> Information Civile</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Nom <span class="required">*</span></label>
                        <input type="text" required placeholder="Nom de famille">
                    </div>
                    <div class="form-group">
                        <label>Prénom <span class="required">*</span></label>
                        <input type="text" required placeholder="Prénom">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Numéro IFU <span class="required">*</span></label>
                        <input type="text" required placeholder="12 chiffres">
                    </div>
                    <div class="form-group">
                        <label>Numéro CNIB <span class="required">*</span></label>
                        <input type="text" required placeholder="Numéro unique">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Téléphone <span class="required">*</span></label>
                        <input type="tel" required placeholder="+229 ...">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="email@domaine.com">
                    </div>
                </div>
            </div>
            
            <!-- Génération de Compte -->
            <div class="form-section">
                <h2><span class="material-symbols-outlined">lock</span> Génération de Compte</h2>
                
                <div class="account-info">
                    <p style="margin: 0 0 1rem 0; font-size: 0.875rem; color: #42474f;">Un compte utilisateur sera automatiquement créé avec les identifiants ci-dessous.</p>
                    
                    <div class="account-info-row">
                        <div>
                            <div class="account-info-label">Nom d'Utilisateur</div>
                            <input type="text" readonly value="dupont_jean" style="width: 100%; padding: 0.75rem; border: 1px solid #c2c7d0; border-radius: 0.5rem;">
                        </div>
                        <div>
                            <div class="account-info-label">Mot de Passe Temporaire</div>
                            <input type="text" readonly value="TMP_123456789" style="width: 100%; padding: 0.75rem; border: 1px solid #c2c7d0; border-radius: 0.5rem;">
                        </div>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="activate_account" checked>
                        <label for="activate_account" style="margin: 0; font-size: 0.875rem;">Activer le compte immédiatement</label>
                    </div>
                </div>
            </div>
            
            <!-- Buttons -->
            <div class="btn-group">
                <button type="button" class="btn btn-secondary">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer le Propriétaire</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
