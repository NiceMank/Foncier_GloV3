<?php
/**
 * Page: Gestion des Litiges - Index
 * Role: Admin/Consultant
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système Foncier Glo - Gestion des Litiges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --primary: #00375e; --secondary: #0b61a1; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9ff; color: #0b1c30; }
        .sidebar { position: fixed; left: 0; top: 0; height: 100vh; width: 18rem; background: linear-gradient(135deg, #1f4e79 0%, #0b3d66 100%); color: white; padding: 1.5rem; z-index: 1050; overflow-y: auto; box-shadow: 2px 0 8px rgba(0,0,0,0.1); }
        .sidebar h1 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .sidebar p { font-size: 0.875rem; opacity: 0.8; margin-bottom: 2rem; }
        .sidebar ul { list-style: none; padding: 0; margin: 0; }
        .sidebar a { display: flex; align-items: center; gap: 1rem; padding: 0.75rem 1rem; color: rgba(255,255,255,0.8); text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s; margin-bottom: 0.5rem; }
        .sidebar a:hover, .sidebar a.active { background-color: var(--secondary); color: white; font-weight: 600; }
        .main-wrapper { margin-left: 18rem; display: flex; flex-direction: column; min-height: 100vh; }
        .top-app-bar { position: sticky; top: 0; z-index: 40; background-color: white; border-bottom: 1px solid #c2c7d0; padding: 1rem 2.5rem; display: flex; justify-content: space-between; align-items: center; min-height: 4rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .top-app-bar h2 { margin: 0; font-size: 1.25rem; font-weight: 600; color: var(--primary); }
        .icon-button { background: none; border: none; color: #42474f; cursor: pointer; padding: 0.5rem; display: flex; align-items: center; justify-content: center; transition: color 0.3s; }
        .icon-button:hover { color: var(--primary); }
        .content-area { flex: 1; padding: 2.5rem; overflow-y: auto; }
        .card { background-color: white; border: 1px solid #d3e4fe; border-radius: 0.75rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden; }
        .filter-section { padding: 1.5rem; border-bottom: 1px solid #d3e4fe; background-color: #f8f9ff; }
        .filter-group { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-weight: 600; font-size: 0.875rem; color: #42474f; margin-bottom: 0.5rem; }
        .form-group input, .form-group select { padding: 0.5rem 0.75rem; border: 1px solid #c2c7d0; border-radius: 0.5rem; font-size: 0.875rem; font-family: inherit; }
        .form-group input:focus, .form-group select:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(0,55,94,0.1); }
        .table-responsive { overflow-x: auto; }
        .table { margin-bottom: 0; width: 100%; }
        .table thead { background-color: #eff4ff; }
        .table thead th { padding: 1rem; font-weight: 600; font-size: 0.875rem; color: #42474f; border: none; border-bottom: 2px solid #d3e4fe; }
        .table tbody td { padding: 1rem; border-color: #eff4ff; font-size: 0.875rem; }
        .table tbody tr { transition: background-color 0.3s; }
        .table tbody tr:hover { background-color: rgba(209, 228, 255, 0.2); }
        .status-badge { display: inline-flex; align-items: center; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-active { background-color: #dbeafe; color: #0c4a6e; }
        .status-resolved { background-color: #d1fae5; color: #065f46; }
        .action-buttons { display: flex; justify-content: flex-end; gap: 0.5rem; opacity: 0; transition: opacity 0.3s; }
        .table tbody tr:hover .action-buttons { opacity: 1; }
        .btn-icon { background: none; border: none; color: #42474f; cursor: pointer; padding: 0.25rem; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; transition: color 0.3s; }
        .btn-icon:hover { color: #2e75b6; }
        .pagination-section { padding: 1.5rem; background-color: #f8f9ff; border-top: 1px solid #d3e4fe; display: flex; justify-content: space-between; align-items: center; }
        .pagination-info { font-size: 0.875rem; color: #42474f; }
        .pagination-controls { display: flex; gap: 0.5rem; }
        .page-btn { padding: 0.5rem 0.75rem; border: 1px solid #c2c7d0; border-radius: 0.5rem; background-color: white; color: #42474f; cursor: pointer; font-size: 0.875rem; transition: all 0.3s; }
        .page-btn:hover { background-color: #eff4ff; }
        .page-btn.active { background-color: var(--primary); color: white; border-color: var(--primary); font-weight: 600; }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar">
    <div>
        <h1>Système Foncier</h1>
        <p>Gestion des Litiges</p>
    </div>
    <ul>
        <li><a href="#"><span class="material-symbols-outlined">dashboard</span> Tableau de Bord</a></li>
        <li><a href="#" class="active"><span class="material-symbols-outlined">gavel</span> Litiges</a></li>
        <li><a href="#"><span class="material-symbols-outlined">map</span> Parcelles</a></li>
        <li><a href="#"><span class="material-symbols-outlined">group</span> Propriétaires</a></li>
        <li><a href="#"><span class="material-symbols-outlined">compare_arrows</span> Transferts</a></li>
        <li><a href="#"><span class="material-symbols-outlined">settings</span> Paramètres</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-wrapper">
    <header class="top-app-bar">
        <h2>Gestion des Litiges</h2>
        <div style="display: flex; gap: 1rem;">
            <button class="icon-button" title="Ajouter"><span class="material-symbols-outlined">add</span></button>
            <button class="icon-button" title="Notifications"><span class="material-symbols-outlined">notifications</span></button>
            <button class="icon-button" title="Profil"><span class="material-symbols-outlined">account_circle</span></button>
        </div>
    </header>
    
    <div class="content-area">
        <!-- Filters -->
        <div class="card" style="margin-bottom: 2rem;">
            <div class="filter-section">
                <div class="filter-group">
                    <div class="form-group">
                        <label>Statut</label>
                        <select>
                            <option value="">Tous les statuts</option>
                            <option value="pending">En Attente</option>
                            <option value="active">Actif</option>
                            <option value="resolved">Résolu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type de Conflit</label>
                        <select>
                            <option value="">Tous les types</option>
                            <option value="double_vente">Double Vente</option>
                            <option value="succession">Succession/Héritage</option>
                            <option value="empietement">Empiètement</option>
                            <option value="faux_titre">Faux Titre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Arrondissement</label>
                        <select>
                            <option value="">Tous</option>
                            <option value="cotonou">Cotonou</option>
                            <option value="porto-novo">Porto-Novo</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Table -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Parcelle</th>
                            <th>Type</th>
                            <th>Plaignant</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1 -->
                        <tr>
                            <td style="font-weight: 600;">LIT-2023-036</td>
                            <td>REF-GLO-449</td>
                            <td>Double Vente</td>
                            <td>Jean Dupont</td>
                            <td>20 Oct 2023</td>
                            <td><span class="status-badge status-pending">En Attente</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-icon" title="Voir"><span class="material-symbols-outlined">visibility</span></button>
                                    <button class="btn-icon" title="Modifier"><span class="material-symbols-outlined">edit</span></button>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: 600;">LIT-2023-037</td>
                            <td>REF-GLO-550</td>
                            <td>Succession</td>
                            <td>Famille Assogba</td>
                            <td>18 Oct 2023</td>
                            <td><span class="status-badge status-active">Actif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-icon" title="Voir"><span class="material-symbols-outlined">visibility</span></button>
                                    <button class="btn-icon" title="Modifier"><span class="material-symbols-outlined">edit</span></button>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr>
                            <td style="font-weight: 600;">LIT-2023-038</td>
                            <td>REF-GLO-551</td>
                            <td>Succession</td>
                            <td>Famille Zogo</td>
                            <td>15 Sep 2023</td>
                            <td><span class="status-badge status-resolved">Résolu</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-icon" title="Voir"><span class="material-symbols-outlined">visibility</span></button>
                                    <button class="btn-icon" title="Télécharger"><span class="material-symbols-outlined">folder_zip</span></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="pagination-section">
                <span class="pagination-info">Affichage 1 - 3 sur 12</span>
                <div class="pagination-controls">
                    <button class="page-btn" disabled><span class="material-symbols-outlined">chevron_left</span></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn"><span class="material-symbols-outlined">chevron_right</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
