<?php
/**
 * Page: Gestion des Utilisateurs
 * Role: Admin
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système Foncier Glo - Gestion des Utilisateurs</title>
    
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
        }
        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        
        /* Sidebar Navigation */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 18rem;
            background-color: #1f4e79;
            color: white;
            padding: 1.5rem;
            z-index: 1050;
            overflow-y: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .sidebar .brand {
            margin-bottom: 2rem;
        }
        
        .sidebar .brand h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .sidebar .brand p {
            font-size: 0.85rem;
            opacity: 0.8;
        }
        
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }
        
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .sidebar-nav a:hover {
            background-color: rgba(0,0,0,0.2);
            color: white;
        }
        
        .sidebar-nav a.active {
            background-color: var(--secondary);
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Main Content */
        .main-wrapper {
            margin-left: 18rem;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .top-app-bar {
            position: sticky;
            top: 0;
            z-index: 40;
            background-color: white;
            border-bottom: 1px solid #c2c7d0;
            padding: 1rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 4rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        
        .top-app-bar h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: var(--primary);
        }
        
        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2.5rem;
            overflow-y: auto;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
        }
        
        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #0b1c30;
            margin: 0 0 0.5rem 0;
        }
        
        .page-header p {
            color: #42474f;
            margin: 0;
        }
        
        .btn-new {
            background-color: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.15);
        }
        
        .btn-new:hover {
            background-color: #184974;
        }
        
        .card-table {
            background-color: white;
            border: 1px solid #d3e4fe;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 600px;
        }
        
        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #d3e4fe;
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h3 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #0b1c30;
        }
        
        .header-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.375rem;
            color: #42474f;
            border-radius: 0.25rem;
            transition: all 0.2s;
        }
        
        .icon-btn:hover {
            background-color: #eff4ff;
            color: var(--primary);
        }
        
        .table-wrapper {
            flex: 1;
            overflow: auto;
        }
        
        .table {
            margin-bottom: 0;
            border-collapse: collapse;
        }
        
        .table thead {
            background-color: #eff4ff;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .table thead th {
            padding: 1rem;
            font-weight: 600;
            font-size: 0.75rem;
            color: #42474f;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: none;
            background-color: #eff4ff;
        }
        
        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #d3e4fe;
            font-size: 0.875rem;
            color: #0b1c30;
        }
        
        .table tbody tr:hover {
            background-color: #eff4ff;
        }
        
        .table tbody tr:nth-child(even) {
            background-color: white;
        }
        
        .user-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
            color: white;
            margin-right: 0.5rem;
        }
        
        .avatar-1 {
            background-color: #7cbaff;
        }
        
        .avatar-2 {
            background-color: #9ecaff;
        }
        
        .avatar-3 {
            background-color: #cbdbf5;
            color: #0b1c30;
        }
        
        .role-select {
            padding: 0.375rem 0.75rem;
            border: 1px solid #c2c7d0;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            background-color: white;
            color: #0b1c30;
        }
        
        .role-select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(11, 97, 161, 0.2);
        }
        
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 2.25rem;
            height: 1.25rem;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #c2c7d0;
            transition: 0.4s;
            border-radius: 1.25rem;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 1rem;
            width: 1rem;
            left: 0.125rem;
            bottom: 0.125rem;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }
        
        input:checked + .toggle-slider {
            background-color: var(--primary);
        }
        
        input:checked + .toggle-slider:before {
            transform: translateX(1rem);
        }
        
        .card-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #d3e4fe;
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
            color: #42474f;
        }
        
        .pagination-buttons {
            display: flex;
            gap: 0.25rem;
        }
        
        .page-btn {
            padding: 0.375rem 0.75rem;
            border: 1px solid #d3e4fe;
            background-color: white;
            color: #42474f;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        
        .page-btn:hover:not(:disabled) {
            background-color: #eff4ff;
        }
        
        .page-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
            font-weight: bold;
        }
        
        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .sidebar-widget {
            background-color: white;
            border: 1px solid #d3e4fe;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
        }
    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<nav class="sidebar">
    <div class="brand">
        <h1>Système Foncier</h1>
        <p>Administration</p>
    </div>
    
    <ul class="sidebar-nav">
        <li>
            <a href="/foncier_gloV3/admin/dashboard.php">
                <span class="material-symbols-outlined">dashboard</span>
                Tableau de bord
            </a>
        </li>
        <li>
            <a href="/foncier_gloV3/admin/agents.php" class="active">
                <span class="material-symbols-outlined">group</span>
                Utilisateurs
            </a>
        </li>
        <li>
            <a href="/foncier_gloV3/admin/transferts/index.php">
                <span class="material-symbols-outlined">swap_horiz</span>
                Transferts
            </a>
        </li>
        <li>
            <a href="/foncier_gloV3/admin/litiges/index.php">
                <span class="material-symbols-outlined">gavel</span>
                Litiges
            </a>
        </li>
        <li>
            <a href="/foncier_gloV3/admin/settings.php">
                <span class="material-symbols-outlined">settings</span>
                Paramètres
            </a>
        </li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-wrapper">
    <!-- Top App Bar -->
    <header class="top-app-bar">
        <h2>Gestion des Utilisateurs</h2>
        <div style="display: flex; gap: 1rem;">
            <button style="background: none; border: none; color: #42474f; cursor: pointer;">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button style="background: none; border: none; color: #42474f; cursor: pointer;">
                <span class="material-symbols-outlined">account_circle</span>
            </button>
        </div>
    </header>
    
    <!-- Content Area -->
    <div class="content-area">
        <div class="page-header">
            <div>
                <h1>Gestion des Utilisateurs</h1>
                <p>Gérez les accès, les rôles et surveillez l'activité du système.</p>
            </div>
            <button class="btn-new">
                <span class="material-symbols-outlined">add</span>
                Nouvel Agent
            </button>
        </div>
        
        <!-- Main Table Card -->
        <div class="card-table">
            <div class="card-header">
                <h3>
                    <span class="material-symbols-outlined" style="color: var(--primary);">group</span>
                    Personnel Autorisé
                </h3>
                <div class="header-actions">
                    <button class="icon-btn" title="Filtrer">
                        <span class="material-symbols-outlined">filter_list</span>
                    </button>
                    <button class="icon-btn" title="Télécharger">
                        <span class="material-symbols-outlined">download</span>
                    </button>
                </div>
            </div>
            
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom de l'agent</th>
                            <th>Email</th>
                            <th>Date de création</th>
                            <th>Rôle</th>
                            <th style="text-align: right;">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <div class="user-avatar avatar-1">JD</div>
                                    <span style="font-weight: 600;">Jean Dupont</span>
                                </div>
                            </td>
                            <td>j.dupont@foncier.bj</td>
                            <td>12 Oct 2023</td>
                            <td>
                                <select class="role-select">
                                    <option selected>Admin</option>
                                    <option>Chef de Service</option>
                                    <option>Agent</option>
                                </select>
                            </td>
                            <td style="text-align: right;">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <div class="user-avatar avatar-2">MA</div>
                                    <span style="font-weight: 600;">Marie Assogba</span>
                                </div>
                            </td>
                            <td>m.assogba@foncier.bj</td>
                            <td>05 Nov 2023</td>
                            <td>
                                <select class="role-select">
                                    <option>Admin</option>
                                    <option selected>Chef de Service</option>
                                    <option>Agent</option>
                                </select>
                            </td>
                            <td style="text-align: right;">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <div class="user-avatar avatar-3">PL</div>
                                    <span style="font-weight: 600;">Paul Lokossou</span>
                                </div>
                            </td>
                            <td>p.lokossou@foncier.bj</td>
                            <td>22 Jan 2024</td>
                            <td>
                                <select class="role-select">
                                    <option>Admin</option>
                                    <option>Chef de Service</option>
                                    <option selected>Agent</option>
                                </select>
                            </td>
                            <td style="text-align: right;">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <div class="user-avatar avatar-3">FK</div>
                                    <span style="font-weight: 600;">Fatima Kaba</span>
                                </div>
                            </td>
                            <td>f.kaba@foncier.bj</td>
                            <td>14 Fev 2024</td>
                            <td>
                                <select class="role-select">
                                    <option>Admin</option>
                                    <option>Chef de Service</option>
                                    <option selected>Agent</option>
                                </select>
                            </td>
                            <td style="text-align: right;">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer">
                <span>Affichage de 1 à 4 sur 24 agents</span>
                <div class="pagination-buttons">
                    <button class="page-btn" disabled>Préc</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">Suiv</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
