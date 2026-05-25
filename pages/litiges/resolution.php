<?php
/**
 * Page: Résolution des Litiges
 * Role: Admin
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résolution des Litiges</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --primary: #00375e; --secondary: #0b61a1; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9ff; color: #0b1c30; padding-bottom: 100px; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .sidebar { position: fixed; left: 0; top: 0; height: 100vh; width: 18rem; background-color: #1f4e79; color: white; padding: 1.5rem; z-index: 1050; overflow-y: auto; }
        .sidebar a { display: flex; align-items: center; gap: 1rem; padding: 0.75rem 1rem; color: rgba(255,255,255,0.8); text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: var(--secondary); color: white; }
        .main-wrapper { margin-left: 18rem; display: flex; flex-direction: column; min-height: 100vh; }
        .top-app-bar { position: sticky; top: 0; z-index: 40; background-color: white; border-bottom: 1px solid #c2c7d0; padding: 1rem 2.5rem; display: flex; justify-content: space-between; align-items: center; min-height: 4rem; }
        .content-area { flex: 1; padding: 2.5rem; overflow-y: auto; }
        .two-pane { display: flex; gap: 1.5rem; }
        .pane { flex: 1; }
        .pane.left { width: 40%; border-right: 1px solid #c2c7d0; padding-right: 1.5rem; }
        .pane.right { width: 60%; }
        .card { background-color: white; border: 1px solid #d3e4fe; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 1.5rem; }
        .card-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }
        .timeline { position: relative; padding: 1rem 0 1rem 2rem; }
        .timeline-item { position: relative; margin-bottom: 2rem; }
        .timeline-marker { position: absolute; left: -2rem; top: 0; width: 1.5rem; height: 1.5rem; background-color: var(--primary); border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px var(--primary); }
        .timeline-date { font-weight: 600; color: #0b1c30; margin-bottom: 0.25rem; }
        .timeline-text { color: #42474f; font-size: 0.875rem; }
        .comparison-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
        .comparison-box { background-color: #eff4ff; padding: 1rem; border-radius: 0.5rem; border-left: 4px solid var(--primary); }
        .comparison-title { font-weight: 600; font-size: 0.85rem; color: var(--primary); margin-bottom: 0.5rem; }
        .action-panel { position: fixed; bottom: 0; left: 18rem; right: 0; background-color: white; border-top: 1px solid #c2c7d0; padding: 1.5rem 2.5rem; box-shadow: 0 -2px 8px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
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
        <p style="font-size: 0.85rem; opacity: 0.8; margin: 0;">Résolution</p>
    </div>
    <ul style="list-style: none; padding: 0; margin: 0;">
        <li><a href="#"><span class="material-symbols-outlined">dashboard</span> Tableau de Bord</a></li>
        <li><a href="#" class="active"><span class="material-symbols-outlined">gavel</span> Litiges</a></li>
        <li><a href="#"><span class="material-symbols-outlined">settings</span> Paramètres</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-wrapper">
    <!-- Top App Bar -->
    <header class="top-app-bar">
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: var(--primary);">Résolution du Litige LIT/001/2024</h2>
        <div style="display: flex; gap: 1rem;">
            <button style="background: none; border: none; color: #42474f; cursor: pointer;"><span class="material-symbols-outlined">notifications</span></button>
            <button style="background: none; border: none; color: #42474f; cursor: pointer;"><span class="material-symbols-outlined">account_circle</span></button>
        </div>
    </header>
    
    <!-- Content Area -->
    <div class="content-area">
        <div class="two-pane">
            <!-- Left Pane: Historique -->
            <div class="pane left">
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-symbols-outlined">history</span>
                        Historique
                    </h3>
                    
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-date">25 Mai 2024</div>
                            <div class="timeline-text">Litige enregistré par Agent Système</div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-date">26 Mai 2024</div>
                            <div class="timeline-text">Visites sur terrain effectuées</div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-date">28 Mai 2024</div>
                            <div class="timeline-text">Documents rassemblés et analysés</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Pane: Comparison & Decision -->
            <div class="pane right">
                <!-- Comparison -->
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-symbols-outlined">compare</span>
                        Comparaison des Revendications
                    </h3>
                    
                    <div class="comparison-row">
                        <div class="comparison-box">
                            <div class="comparison-title">PREMIÈRE PARTIE</div>
                            <div style="font-size: 0.875rem; color: #0b1c30;">Jean Dupont réclame la limite à 5m du bâtiment principal.</div>
                        </div>
                        <div class="comparison-box" style="border-left-color: #ef4444;">
                            <div class="comparison-title" style="color: #ef4444;">DEUXIÈME PARTIE</div>
                            <div style="font-size: 0.875rem; color: #0b1c30;">Pierre Bernard maintient la limite à 8m selon le document cadastral.</div>
                        </div>
                    </div>
                </div>
                
                <!-- Decision -->
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-symbols-outlined">gavel</span>
                        Décision Recommandée
                    </h3>
                    
                    <div style="background-color: #d1fae5; border: 1px solid #a7f3d0; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                        <div style="font-weight: 600; color: #065f46; margin-bottom: 0.5rem;">✓ Favoriser la deuxième partie</div>
                        <div style="font-size: 0.875rem; color: #047857;">La limite à 8m est conforme aux documents cadastraux. La première partie n'a pas présenté de documentation suffisante.</div>
                    </div>
                    
                    <textarea rows="4" placeholder="Notes supplémentaires pour le dossier..." style="width: 100%; padding: 0.75rem; border: 1px solid #c2c7d0; border-radius: 0.5rem; font-size: 0.875rem;"></textarea>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Action Panel -->
    <div class="action-panel">
        <button class="btn btn-secondary">Annuler</button>
        <button class="btn btn-primary">Enregistrer la Résolution</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
