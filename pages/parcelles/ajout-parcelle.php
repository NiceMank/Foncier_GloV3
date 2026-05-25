<?php
/**
 * Page: Ajouter Parcelle
 * Role: Admin/Agent
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Parcelle</title>
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
        .form-card { background-color: white; border: 1px solid #d3e4fe; border-radius: 0.75rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden; }
        .form-section { padding: 2rem; border-bottom: 1px solid #d3e4fe; }
        .form-section h2 { font-size: 1.1rem; font-weight: 600; color: var(--primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; margin-top: 0; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .form-row.full { grid-template-columns: 1fr; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-weight: 600; font-size: 0.875rem; color: #42474f; margin-bottom: 0.5rem; }
        .form-group input, .form-group select { padding: 0.75rem; border: 1px solid #c2c7d0; border-radius: 0.5rem; font-size: 0.875rem; }
        .form-group input:focus, .form-group select:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(0,55,94,0.1); }
        .btn-group { display: flex; gap: 1rem; margin-top: 2rem; padding: 1.5rem; background-color: white; border-top: 1px solid #d3e4fe; }
        .btn { padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; border: none; cursor: pointer; font-size: 0.875rem; }
        .btn-primary { background-color: var(--primary); color: white; }
        .btn-secondary { background-color: white; color: var(--primary); border: 2px solid var(--primary); }
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
        <li><a href="#" class="active"><span class="material-symbols-outlined">add_location</span> Ajouter Parcelle</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-wrapper">
    <header class="top-app-bar">
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: var(--primary);">Ajouter une Nouvelle Parcelle</h2>
    </header>
    
    <div class="content-area">
        <form class="form-card">
            <!-- Information Géographique -->
            <div class="form-section">
                <h2><span class="material-symbols-outlined">location_on</span> Information Géographique</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Latitude *</label>
                        <input type="text" placeholder="6.4969° N" required>
                    </div>
                    <div class="form-group">
                        <label>Longitude *</label>
                        <input type="text" placeholder="2.6289° E" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Arrondissement *</label>
                        <select required>
                            <option value="">Sélectionnez</option>
                            <option>Cotonou</option>
                            <option>Porto-Novo</option>
                            <option>Abomey-Calavi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quartier *</label>
                        <input type="text" placeholder="Nom du quartier" required>
                    </div>
                </div>
            </div>
            
            <!-- Caractéristiques -->
            <div class="form-section">
                <h2><span class="material-symbols-outlined">crop_landscape</span> Caractéristiques</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Superficie (m²) *</label>
                        <input type="number" placeholder="500" required>
                    </div>
                    <div class="form-group">
                        <label>Numéro Titre Foncier *</label>
                        <input type="text" placeholder="TF-XXXX" required>
                    </div>
                </div>
            </div>
            
            <!-- Propriétaire -->
            <div class="form-section">
                <h2><span class="material-symbols-outlined">person</span> Propriétaire</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Nom Propriétaire *</label>
                        <input type="text" placeholder="Jean Dupont" required>
                    </div>
                    <div class="form-group">
                        <label>Numéro IFU *</label>
                        <input type="text" placeholder="1029384756" required>
                    </div>
                </div>
            </div>
            
            <!-- Buttons -->
            <div class="btn-group">
                <button type="button" class="btn btn-secondary">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer la Parcelle</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
