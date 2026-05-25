<?php
/**
 * Page: Portail Foncier - Validation de Transfert
 * Role: Admin
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail Foncier - Validation de Transfert</title>
    
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
            --tertiary: #41009d;
            --surface: #f8f9ff;
            --surface-container: #e5eeff;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        
        .sidebar-nav li {
            margin-bottom: 0.5rem;
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
        
        .sidebar-nav .material-symbols-outlined {
            font-size: 1.25rem;
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
        
        .top-app-bar-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .top-app-bar-actions button {
            background: none;
            border: none;
            cursor: pointer;
            color: #42474f;
            transition: color 0.3s;
        }
        
        .top-app-bar-actions button:hover {
            color: var(--primary);
        }
        
        /* Content Area */
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: row;
            gap: 1.5rem;
            padding: 1.5rem;
            overflow-y: auto;
            background-color: #eff4ff;
        }
        
        /* Three-Pane Layout */
        .pane-left {
            width: 25%;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            overflow-y: auto;
            padding-right: 1rem;
        }
        
        .pane-center {
            flex: 1;
            background-color: white;
            border-radius: 8px;
            border: 1px solid #c2c7d0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        .pane-right {
            width: 25%;
            min-width: 320px;
            background-color: white;
            border-radius: 8px;
            border: 1px solid #c2c7d0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        
        .card-pane {
            background-color: white;
            border-radius: 8px;
            border: 1px solid #c2c7d0;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #c2c7d0;
        }
        
        .card-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            color: var(--primary);
        }
        
        .info-row {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            margin-bottom: 1rem;
        }
        
        .info-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #42474f;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .info-value {
            font-size: 0.95rem;
            color: #0b1c30;
            font-weight: 500;
        }
        
        .document-header {
            background-color: white;
            border-bottom: 1px solid #c2c7d0;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        
        .document-body {
            flex: 1;
            background-color: #e2e8f0;
            padding: 1.5rem;
            overflow-y: auto;
            display: flex;
            justify-content: center;
        }
        
        .document-preview {
            background-color: white;
            width: 100%;
            max-width: 600px;
            min-height: 800px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 2rem;
            border: 1px solid #c2c7d0;
            position: relative;
        }
        
        .verification-badge {
            position: absolute;
            right: 2rem;
            background-color: #ecfdf5;
            color: #10b981;
            border: 1px solid #d1fae5;
            border-radius: 50%;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            background-color: rgba(90, 32, 195, 0.1);
            color: #5a20c3;
            border: 1px solid rgba(90, 32, 195, 0.2);
        }
        
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-secondary {
            background-color: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        @media (max-width: 1024px) {
            .pane-left, .pane-right {
                width: auto;
                min-width: unset;
            }
            
            .content-area {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<nav class="sidebar">
    <div class="brand">
        <h1>Cadastre National</h1>
        <p>République du Bénin</p>
    </div>
    
    <ul class="sidebar-nav">
        <li>
            <a href="/foncier_gloV3/admin/dashboard.php">
                <span class="material-symbols-outlined">dashboard</span>
                Tableau de bord
            </a>
        </li>
        <li>
            <a href="/foncier_gloV3/admin/parcelles/index.php">
                <span class="material-symbols-outlined">map</span>
                Cadastre
            </a>
        </li>
        <li>
            <a href="/foncier_gloV3/admin/proprietaires/index.php">
                <span class="material-symbols-outlined">description</span>
                Titres fonciers
            </a>
        </li>
        <li>
            <a href="/foncier_gloV3/admin/transferts/index.php" class="active">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">swap_horiz</span>
                Transferts
            </a>
        </li>
        <li>
            <a href="/foncier_gloV3/admin/litiges/index.php">
                <span class="material-symbols-outlined">gavel</span>
                Litiges
            </a>
        </li>
    </ul>
    
    <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 1rem; margin-top: auto;">
        <a href="#" style="display: flex; align-items: center; gap: 1rem; padding: 0.75rem 1rem; color: rgba(255,255,255,0.8); text-decoration: none; border-radius: 0.5rem;">
            <span class="material-symbols-outlined">settings</span>
            Paramètres
        </a>
    </div>
</nav>

<!-- Main Content -->
<div class="main-wrapper">
    <!-- Top App Bar -->
    <header class="top-app-bar">
        <h2>Portail Foncier</h2>
        <div class="top-app-bar-actions">
            <button type="button" title="Notifications">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button type="button" title="Historique">
                <span class="material-symbols-outlined">history</span>
            </button>
            <button type="button" title="Profil">
                <span class="material-symbols-outlined">account_circle</span>
            </button>
        </div>
    </header>
    
    <!-- Content Area -->
    <div class="content-area">
        <!-- Left Pane: Dossier Summary -->
        <section class="pane-left">
            <!-- Vendeur Card -->
            <div class="card-pane">
                <div class="card-header">
                    <h3>Vendeur</h3>
                    <span class="material-symbols-outlined">person</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nom complet</span>
                    <span class="info-value">Jean-Paul Dossou</span>
                </div>
                <div class="info-row">
                    <span class="info-label">NPI / IFU</span>
                    <span class="info-value" style="font-family: monospace; background-color: #eff4ff; padding: 0.25rem; border-radius: 0.25rem;">1029384756 / 32019485729</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Téléphone</span>
                    <span class="info-value">+229 97 00 11 22</span>
                </div>
            </div>
            
            <!-- Acquéreur Card -->
            <div class="card-pane">
                <div class="card-header">
                    <h3>Acquéreur</h3>
                    <span class="material-symbols-outlined">person_add</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nom complet</span>
                    <span class="info-value">Marie-Claire Afiwa</span>
                </div>
                <div class="info-row">
                    <span class="info-label">NPI / IFU</span>
                    <span class="info-value" style="font-family: monospace; background-color: #eff4ff; padding: 0.25rem; border-radius: 0.25rem;">5647382910 / 92857410234</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Téléphone</span>
                    <span class="info-value">+229 95 33 44 55</span>
                </div>
            </div>
            
            <!-- Status Card -->
            <div class="card-pane" style="margin-top: auto;">
                <h4 style="font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--primary);">Statut du Dossier</h4>
                <div class="status-badge">
                    <span class="material-symbols-outlined" style="font-size: 1rem;">pending_actions</span>
                    <span>En cours de vérification</span>
                </div>
            </div>
        </section>
        
        <!-- Center Pane: Document Preview -->
        <section class="pane-center">
            <div class="document-header">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <span class="material-symbols-outlined">description</span>
                    <h3 style="margin: 0; font-size: 1.1rem; font-weight: 600; color: var(--primary);">Acte de Vente - TF_4958.pdf</h3>
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    <button class="btn btn-sm btn-light" title="Zoom In">
                        <span class="material-symbols-outlined">zoom_in</span>
                    </button>
                    <button class="btn btn-sm btn-light" title="Zoom Out">
                        <span class="material-symbols-outlined">zoom_out</span>
                    </button>
                </div>
            </div>
            
            <div class="document-body">
                <div class="document-preview">
                    <!-- Verification Checkmarks -->
                    <div class="verification-badge" style="top: 80px;">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <div class="verification-badge" style="top: 160px;">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <div class="verification-badge" style="top: 320px;">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    
                    <!-- Document Content -->
                    <div style="text-align: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #0b1c30;">
                        <h1 style="font-size: 1.5rem; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em; margin: 0;">Acte de Vente</h1>
                        <p style="font-size: 0.875rem; color: #42474f; margin-top: 0.5rem;">République du Bénin - Notariat de Cotonou</p>
                    </div>
                    
                    <div style="line-height: 1.8; color: #42474f;">
                        <p>Par devant Maître Alexandre ZINZINDOHOUE, Notaire à la résidence de Cotonou, soussigné.</p>
                        
                        <h2 style="font-weight: bold; font-size: 0.875rem; text-transform: uppercase; background-color: #eff4ff; padding: 0.5rem; margin: 1rem 0 0.5rem 0;">Ont Comparu :</h2>
                        
                        <p><strong>Monsieur Jean-Paul DOSSOU</strong>, né le 12/04/1975 à Porto-Novo, profession Commerçant, domicilié à Cotonou, quartier Haie Vive. Agissant en son nom personnel.<br/>
                        Ci-après dénommé <em>"LE VENDEUR"</em>.</p>
                        
                        <p><strong>Madame Marie-Claire AFIWA</strong>, née le 05/09/1982 à Ouidah, profession Enseignante, domiciliée à Abomey-Calavi, quartier Zoca. Agissant en son nom personnel.<br/>
                        Ci-après dénommée <em>"L'ACQUÉREUR"</em>.</p>
                        
                        <h2 style="font-weight: bold; font-size: 0.875rem; text-transform: uppercase; background-color: #eff4ff; padding: 0.5rem; margin: 1.5rem 0 0.5rem 0;">Objet de la Vente :</h2>
                        
                        <p>Le VENDEUR vend, cède et transporte, sous les garanties ordinaires et de droit en pareille matière, à L'ACQUÉREUR qui accepte, l'immeuble dont la désignation suit :</p>
                        
                        <p style="background-color: #f3f4f6; padding: 1rem; border-left: 4px solid var(--primary); font-style: italic;">Une parcelle de terrain bâtie, sise à Cotonou, quartier Fidjrossè, d'une superficie de cinq cent mètres carrés (500 m²), faisant l'objet du Titre Foncier numéro 4958 de la circonscription foncière de Cotonou.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Right Pane: Decision Panel -->
        <section class="pane-right">
            <div style="border-bottom: 1px solid #c2c7d0; padding-bottom: 1rem; margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; margin: 0;">
                    <span class="material-symbols-outlined">gavel</span>
                    Validation Finale
                </h2>
                <p style="font-size: 0.875rem; color: #42474f; margin-top: 0.5rem;">Étape 4/4 : Décision du Chef de Service</p>
            </div>
            
            <div style="flex: 1; display: flex; flex-direction: column; gap: 1.5rem;">
                <div>
                    <label style="font-size: 0.875rem; font-weight: 600; color: #0b1c30; margin-bottom: 0.5rem; display: block;">Commentaires de vérification</label>
                    <textarea class="form-control" placeholder="Saisissez vos observations concernant la conformité des documents et l'identité des parties..." style="font-size: 0.875rem;"></textarea>
                    <p style="font-size: 0.75rem; color: #72777f; margin-top: 0.25rem;">Ces commentaires seront joints à l'historique du dossier.</p>
                </div>
                
                <div class="action-buttons" style="margin-top: auto;">
                    <button class="btn btn-secondary" style="flex: 1;">Rejeter</button>
                    <button class="btn btn-primary" style="flex: 1;">Approuver</button>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
