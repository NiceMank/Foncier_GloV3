<?php
/**
 * Page: Gestion des Transferts
 * Role: Admin
 * Converted from Tailwind CSS to Bootstrap 5
 * Based on: EXAMPLE_CONVERTED_GESTION_TRANSFERTS.html
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Transferts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #00375e;
            --secondary: #0b61a1;
            --tertiary: #41009d;
            --surface: #f8f9ff;
            --surface-container: #e5eeff;
            --outline: #7a8a98;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--surface);
            color: #0b1c30;
            line-height: 1.6;
        }

        /* Sidebar Navigation */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 18rem;
            background: linear-gradient(135deg, #1f4e79 0%, #0b3d66 100%);
            color: white;
            padding: 1.5rem;
            z-index: 1050;
            overflow-y: auto;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar h1 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .sidebar p {
            font-size: 0.875rem;
            opacity: 0.8;
            margin-bottom: 2rem;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar a.active {
            background-color: var(--secondary);
            color: white;
            font-weight: 600;
        }

        /* Main Wrapper */
        .main-wrapper {
            margin-left: 18rem;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top App Bar */
        .top-app-bar {
            position: sticky;
            top: 0;
            z-index: 40;
            background-color: white;
            border-bottom: 1px solid #c2c7d0;
            padding: 1rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 4rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .top-app-bar h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
        }

        .top-app-bar-actions {
            display: flex;
            gap: 1rem;
        }

        .icon-button {
            background: none;
            border: none;
            color: #42474f;
            cursor: pointer;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s;
        }

        .icon-button:hover {
            color: var(--primary);
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2.5rem;
            overflow-y: auto;
        }

        /* Card */
        .card {
            background-color: white;
            border: 1px solid #d3e4fe;
            border-radius: 0.75rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        /* Filter Section */
        .filter-section {
            padding: 1.5rem;
            border-bottom: 1px solid #d3e4fe;
            background-color: #f8f9ff;
        }

        .filter-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.875rem;
            color: #42474f;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select {
            padding: 0.5rem 0.75rem;
            border: 1px solid #c2c7d0;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 55, 94, 0.1);
        }

        /* Table */
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
            width: 100%;
        }

        .table thead {
            background-color: #eff4ff;
        }

        .table thead th {
            padding: 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: #42474f;
            border: none;
            border-bottom: 2px solid #d3e4fe;
        }

        .table tbody td {
            padding: 1rem;
            border-color: #eff4ff;
            font-size: 0.875rem;
        }

        .table tbody tr:hover {
            background-color: rgba(209, 228, 255, 0.2);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-processing {
            background-color: #dbeafe;
            color: #0c4a6e;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #002d4a;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
        }

        .btn-secondary {
            background-color: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background-color: #f0f4ff;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            background-color: #f8f9ff;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: #42474f;
        }

        .pagination-controls {
            display: flex;
            gap: 0.5rem;
        }

        .page-btn {
            padding: 0.5rem 0.75rem;
            border: 1px solid #c2c7d0;
            border-radius: 0.5rem;
            background-color: white;
            color: #42474f;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.3s;
        }

        .page-btn:hover {
            background-color: var(--surface-container);
        }

        .page-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Avatar */
        .avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: inline-block;
            object-fit: cover;
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar">
    <div>
        <h1>Système Foncier</h1>
        <p>Gestion des Transferts</p>
    </div>
    <ul>
        <li><a href="#"><span class="material-symbols-outlined">dashboard</span> Tableau de Bord</a></li>
        <li><a href="#" class="active"><span class="material-symbols-outlined">compare_arrows</span> Transferts</a></li>
        <li><a href="#"><span class="material-symbols-outlined">group</span> Propriétaires</a></li>
        <li><a href="#"><span class="material-symbols-outlined">map</span> Parcelles</a></li>
        <li><a href="#"><span class="material-symbols-outlined">gavel</span> Litiges</a></li>
        <li><a href="#"><span class="material-symbols-outlined">settings</span> Paramètres</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-wrapper">
    <header class="top-app-bar">
        <h2>Gestion des Transferts de Propriété</h2>
        <div class="top-app-bar-actions">
            <button class="icon-button" title="Notifications">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button class="icon-button" title="Profil">
                <span class="material-symbols-outlined">account_circle</span>
            </button>
        </div>
    </header>
    
    <div class="content-area">
        <!-- Filters -->
        <div class="card">
            <div class="filter-section">
                <div class="filter-group">
                    <div class="form-group">
                        <label>Statut du Transfert</label>
                        <select>
                            <option value="">Tous les statuts</option>
                            <option value="pending">En Attente</option>
                            <option value="approved">Approuvé</option>
                            <option value="rejected">Rejeté</option>
                            <option value="processing">En Traitement</option>
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
                    <div class="form-group">
                        <label>Période</label>
                        <input type="date">
                    </div>
                </div>
            </div>
            
            <!-- Table -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Propriétaire Source</th>
                            <th>Propriétaire Destination</th>
                            <th>Parcelle</th>
                            <th>Date de Demande</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#TRF-2024-001</td>
                            <td>Jean Dupont</td>
                            <td>Marie Assogba</td>
                            <td>P-2024-150</td>
                            <td>15/01/2024</td>
                            <td><span class="status-badge status-pending">En Attente</span></td>
                            <td><button class="btn btn-sm btn-primary">Examiner</button></td>
                        </tr>
                        <tr>
                            <td>#TRF-2024-002</td>
                            <td>Paul Sossa</td>
                            <td>Fatima Diallo</td>
                            <td>P-2024-151</td>
                            <td>14/01/2024</td>
                            <td><span class="status-badge status-approved">Approuvé</span></td>
                            <td><button class="btn btn-sm btn-primary">Détails</button></td>
                        </tr>
                        <tr>
                            <td>#TRF-2024-003</td>
                            <td>Sophie Martin</td>
                            <td>Jean Baptiste</td>
                            <td>P-2024-152</td>
                            <td>13/01/2024</td>
                            <td><span class="status-badge status-processing">En Traitement</span></td>
                            <td><button class="btn btn-sm btn-primary">Suivre</button></td>
                        </tr>
                        <tr>
                            <td>#TRF-2024-004</td>
                            <td>Ahmed Hassan</td>
                            <td>Kofi Mensah</td>
                            <td>P-2024-153</td>
                            <td>12/01/2024</td>
                            <td><span class="status-badge status-rejected">Rejeté</span></td>
                            <td><button class="btn btn-sm btn-primary">Voir</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                <div class="pagination-info">
                    Affichage 1-4 de 24 transferts
                </div>
                <div class="pagination-controls">
                    <button class="page-btn">← Précédent</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">Suivant →</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
