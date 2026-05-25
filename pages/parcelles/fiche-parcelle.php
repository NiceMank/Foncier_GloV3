<?php
/**
 * Page: Fiche Parcelle
 * Role: General
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Parcelle</title>
    
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
        .content-area { flex: 1; padding: 2.5rem; overflow-y: auto; max-width: 80rem; margin: 0 auto; width: 100%; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #c2c7d0; }
        .page-title { font-size: 1.5rem; font-weight: 700; color: var(--primary); margin: 0; }
        .card { background-color: white; border: 1px solid #d3e4fe; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 1.5rem; }
        .card-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }
        .info-row { display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid #eff4ff; }
        .info-label { font-weight: 600; color: #42474f; font-size: 0.875rem; }
        .info-value { color: #0b1c30; font-size: 0.95rem; }
        .btn { padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 600; border: none; cursor: pointer; font-size: 0.875rem; }
        .btn-primary { background-color: var(--primary); color: white; }
        .btn-secondary { background-color: white; color: var(--primary); border: 2px solid var(--primary); }
        .badge { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0.75rem; border-radius: 9999px; font-weight: 600; font-size: 0.85rem; }
        .badge-active { background-color: rgba(16,185,129,0.1); color: #10b981; }
        .two-col { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; }
        @media (max-width: 1024px) { .two-col { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; margin: 0;">Système Foncier</h1>
        <p style="font-size: 0.85rem; opacity: 0.8; margin: 0;">Parcelles</p>
    </div>
    <ul style="list-style: none; padding: 0; margin: 0;">
        <li><a href="#"><span class="material-symbols-outlined">dashboard</span> Tableau de Bord</a></li>
        <li><a href="#" class="active"><span class="material-symbols-outlined">map</span> Parcelles</a></li>
        <li><a href="#"><span class="material-symbols-outlined">settings</span> Paramètres</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-wrapper">
    <!-- Top App Bar -->
    <header class="top-app-bar">
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: var(--primary);">Fiche Parcelle PAR/001/2024</h2>
        <div style="display: flex; gap: 1rem;">
            <button style="background: none; border: none; color: #42474f; cursor: pointer;"><span class="material-symbols-outlined">edit</span></button>
            <button style="background: none; border: none; color: #42474f; cursor: pointer;"><span class="material-symbols-outlined">more_vert</span></button>
        </div>
    </header>
    
    <!-- Content Area -->
    <div class="content-area">
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">Parcelle PAR/001/2024</h1>
            <span class="badge badge-active">
                <span class="material-symbols-outlined">check_circle</span>
                Validée
            </span>
        </div>
        
        <!-- Two Column Layout -->
        <div class="two-col">
            <!-- Left Column -->
            <div>
                <!-- Information Générale -->
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-symbols-outlined">info</span>
                        Informations Générales
                    </h3>
                    
                    <div class="info-row">
                        <div class="info-label">Référence Cadastrale</div>
                        <div class="info-value">PAR/001/2024</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Arrondissement</div>
                        <div class="info-value">Cotonou - Fidjrossè</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Superficie</div>
                        <div class="info-value">500 m²</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Numéro TF</div>
                        <div class="info-value">4958</div>
                    </div>
                    <div class="info-row" style="border-bottom: none;">
                        <div class="info-label">Date d'Enregistrement</div>
                        <div class="info-value">12/01/2020</div>
                    </div>
                </div>
                
                <!-- Propriétaire -->
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-symbols-outlined">person</span>
                        Propriétaire
                    </h3>
                    
                    <div class="info-row">
                        <div class="info-label">Nom Complet</div>
                        <div class="info-value">Jean-Paul Dossou</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Numéro IFU</div>
                        <div class="info-value">1029384756</div>
                    </div>
                    <div class="info-row" style="border-bottom: none;">
                        <div class="info-label">Téléphone</div>
                        <div class="info-value">+229 97 00 11 22</div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column -->
            <div>
                <!-- Map Preview -->
                <div class="card" style="min-height: 300px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #e5eeff 0%, #d3e4fe 100%);">
                    <div style="text-align: center;">
                        <span class="material-symbols-outlined" style="font-size: 3rem; color: var(--primary);">map</span>
                        <p style="margin: 1rem 0 0 0; color: var(--primary); font-weight: 600;">Aperçu Carte</p>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="card">
                    <h3 class="card-title">Actions</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <button class="btn btn-primary" style="width: 100%; text-align: left;">
                            <span class="material-symbols-outlined" style="vertical-align: middle;">edit</span>
                            Modifier
                        </button>
                        <button class="btn btn-secondary" style="width: 100%; text-align: left;">
                            <span class="material-symbols-outlined" style="vertical-align: middle;">download</span>
                            Télécharger Titre
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
