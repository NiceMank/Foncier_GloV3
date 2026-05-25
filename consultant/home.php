<?php
/**
 * Page: Tableau de bord - Consultant
 * Role: Consultant
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système Foncier Glo - Tableau de bord</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Material Symbols Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Plus Jakarta Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #00375e;
            --secondary: #0b61a1;
            --surface: #f8f9ff;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', Segoe UI, Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--surface);
            color: #0b1c30;
            padding-bottom: 6rem;
        }
        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        
        /* Top Navigation */
        .top-nav {
            background-color: white;
            border-bottom: 1px solid #c2c7d0;
            padding: 1rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        
        .nav-brand {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
        }
        
        /* Main Container */
        .main-container {
            max-width: 80rem;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #0b1c30;
            margin: 0 0 0.5rem 0;
        }
        
        /* Grid Layout */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        @media (min-width: 1024px) {
            .content-grid {
                grid-template-columns: repeat(12, 1fr);
            }
        }
        
        .card {
            background-color: white;
            border: 1px solid #c2c7d0;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
            padding: 1.5rem;
        }
        
        .card.lg-8 {
            grid-column: span 8;
        }
        
        .card.lg-4 {
            grid-column: span 4;
        }
        
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 1rem 0;
            color: #0b1c30;
        }
        
        .metric {
            margin-bottom: 1.5rem;
        }
        
        .metric-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .metric-label {
            font-size: 0.875rem;
            color: #42474f;
            margin-top: 0.25rem;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        
        /* Parcel Cards */
        .parcel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .parcel-card {
            background-color: white;
            border: 1px solid #c2c7d0;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
            transition: all 0.3s;
        }
        
        .parcel-card:hover {
            box-shadow: 0 8px 20px rgba(31, 78, 121, 0.15);
            transform: translateY(-2px);
        }
        
        .parcel-image {
            width: 100%;
            height: 150px;
            background: linear-gradient(135deg, #e5eeff 0%, #d3e4fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            border-bottom: 1px solid #c2c7d0;
        }
        
        .parcel-content {
            padding: 1rem;
        }
        
        .parcel-name {
            font-size: 0.95rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
            color: #0b1c30;
        }
        
        .parcel-info {
            font-size: 0.75rem;
            color: #42474f;
            margin-bottom: 0.75rem;
        }
        
        .parcel-status {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            color: #10b981;
        }
        
        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            border-top: 1px solid #c2c7d0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 0.5rem 0;
            z-index: 40;
        }
        
        @media (min-width: 768px) {
            .bottom-nav {
                display: none;
            }
        }
        
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            padding: 0.5rem 1rem;
            color: #42474f;
            text-decoration: none;
            font-size: 0.7rem;
            cursor: pointer;
        }
        
        .nav-item.active {
            color: var(--primary);
        }
    </style>
</head>
<body>

<!-- Top Navigation -->
<nav class="top-nav">
    <h1 class="nav-brand">
        <span class="material-symbols-outlined">dashboard</span>
        Benin Cadastre
    </h1>
    <div style="display: flex; gap: 1rem;">
        <button style="background: none; border: none; color: #42474f; cursor: pointer;">
            <span class="material-symbols-outlined">notifications</span>
        </button>
        <button style="background: none; border: none; color: #42474f; cursor: pointer;">
            <span class="material-symbols-outlined">account_circle</span>
        </button>
    </div>
</nav>

<!-- Main Container -->
<div class="main-container">
    <div class="page-header">
        <h1 class="page-title">Tableau de Bord</h1>
    </div>
    
    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Welcome Card (8 cols) -->
        <div class="card lg-8">
            <h2 class="card-title">Bienvenue, Consultant!</h2>
            <p style="color: #42474f; margin: 0;">Vous avez 3 demandes de transfert en attente de validation et 2 dossiers complétés cette semaine.</p>
            <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                <button style="padding: 0.5rem 1rem; background-color: var(--primary); color: white; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer;">Voir les détails</button>
            </div>
        </div>
        
        <!-- Quick Actions (4 cols) -->
        <div class="card lg-4">
            <h2 class="card-title">Actions Rapides</h2>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <button style="padding: 0.75rem; background-color: #eff4ff; color: var(--primary); border: 1px solid #c2c7d0; border-radius: 0.5rem; font-weight: 600; cursor: pointer; text-align: left; display: flex; align-items: center; gap: 0.5rem;">
                    <span class="material-symbols-outlined">add</span>
                    Nouveau Transfert
                </button>
                <button style="padding: 0.75rem; background-color: #eff4ff; color: var(--primary); border: 1px solid #c2c7d0; border-radius: 0.5rem; font-weight: 600; cursor: pointer; text-align: left; display: flex; align-items: center; gap: 0.5rem;">
                    <span class="material-symbols-outlined">folder</span>
                    Mes Dossiers
                </button>
            </div>
        </div>
    </div>
    
    <!-- Metrics Row -->
    <div class="content-grid" style="margin-bottom: 2rem;">
        <div class="card" style="grid-column: span 3;">
            <div class="metric">
                <div class="metric-value">12</div>
                <div class="metric-label">Transferts Actifs</div>
            </div>
        </div>
        <div class="card" style="grid-column: span 3;">
            <div class="metric">
                <div class="metric-value">45</div>
                <div class="metric-label">Titres Fonciers</div>
            </div>
        </div>
        <div class="card" style="grid-column: span 3;">
            <div class="metric">
                <div class="metric-value">8</div>
                <div class="metric-label">En Attente</div>
            </div>
        </div>
        <div class="card" style="grid-column: span 3;">
            <div class="metric">
                <div class="metric-value">156</div>
                <div class="metric-label">Total Traité</div>
            </div>
        </div>
    </div>
    
    <!-- Parcel Cards Section -->
    <h2 class="card-title" style="margin-top: 2rem; margin-bottom: 1rem;">Mes Parcelles</h2>
    <div class="parcel-grid">
        <div class="parcel-card">
            <div class="parcel-image">
                <span class="material-symbols-outlined" style="font-size: 2rem;">map</span>
            </div>
            <div class="parcel-content">
                <h3 class="parcel-name">PAR/001/2024</h3>
                <div class="parcel-info">Cotonou - Fidjrossè</div>
                <div class="parcel-info">500 m²</div>
                <div class="parcel-status">
                    <span class="material-symbols-outlined" style="font-size: 0.875rem;">check_circle</span>
                    Validée
                </div>
            </div>
        </div>
        
        <div class="parcel-card">
            <div class="parcel-image">
                <span class="material-symbols-outlined" style="font-size: 2rem;">map</span>
            </div>
            <div class="parcel-content">
                <h3 class="parcel-name">PAR/002/2024</h3>
                <div class="parcel-info">Porto-Novo - Akassato</div>
                <div class="parcel-info">250 m²</div>
                <div class="parcel-status">
                    <span class="material-symbols-outlined" style="font-size: 0.875rem;">check_circle</span>
                    Validée
                </div>
            </div>
        </div>
        
        <div class="parcel-card">
            <div class="parcel-image">
                <span class="material-symbols-outlined" style="font-size: 2rem;">map</span>
            </div>
            <div class="parcel-content">
                <h3 class="parcel-name">PAR/003/2024</h3>
                <div class="parcel-info">Abomey-Calavi - Zoca</div>
                <div class="parcel-info">800 m²</div>
                <div class="parcel-status">
                    <span class="material-symbols-outlined" style="font-size: 0.875rem;">pending_actions</span>
                    En Attente
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Navigation (Mobile) -->
<nav class="bottom-nav">
    <a href="#" class="nav-item active">
        <span class="material-symbols-outlined">home</span>
        Accueil
    </a>
    <a href="#" class="nav-item">
        <span class="material-symbols-outlined">folder</span>
        Dossiers
    </a>
    <a href="#" class="nav-item">
        <span class="material-symbols-outlined">swap_horiz</span>
        Transferts
    </a>
    <a href="#" class="nav-item">
        <span class="material-symbols-outlined">account_circle</span>
        Profil
    </a>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
