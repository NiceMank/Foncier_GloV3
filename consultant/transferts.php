<?php
/**
 * Page: Transfert de Propriété (Consultant View)
 * Role: Consultant
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système Foncier Glo - Transfert de Propriété</title>
    
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
        
        .nav-links {
            display: none;
            gap: 2rem;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        @media (min-width: 768px) {
            .nav-links {
                display: flex;
            }
        }
        
        .nav-links li {
            color: #42474f;
            cursor: pointer;
            font-size: 0.875rem;
            transition: color 0.3s;
        }
        
        .nav-links li:hover {
            color: var(--primary);
        }
        
        .nav-links li.active {
            color: var(--primary);
            font-weight: bold;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 0.25rem;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            container: main / inline-size;
            padding: 2rem 1rem;
            max-width: 80rem;
            margin: 0 auto;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: #42474f;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }
        
        /* Stepper */
        .stepper {
            background-color: white;
            border-radius: 0.75rem;
            border: 1px solid #c2c7d0;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
            overflow-x: auto;
        }
        
        .stepper-steps {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            min-width: max-content;
            gap: 1rem;
        }
        
        .stepper-line {
            position: absolute;
            top: 2.5rem;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #c2c7d0;
            z-index: -1;
        }
        
        .stepper-line-active {
            position: absolute;
            top: 2.5rem;
            left: 0;
            height: 2px;
            background-color: #2e75b6;
            z-index: -1;
            width: 50%;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            background-color: white;
            padding: 1rem;
            flex: 1;
        }
        
        .step-circle {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .step-circle.completed {
            background-color: #10b981;
        }
        
        .step-circle.active {
            background-color: #2e75b6;
            box-shadow: 0 0 0 4px #dce9ff;
        }
        
        .step-circle.inactive {
            background-color: #e5eeff;
            color: #42474f;
            border: 2px solid #c2c7d0;
        }
        
        .step-label {
            font-size: 0.875rem;
            font-weight: 600;
            text-align: center;
            max-width: 150px;
        }
        
        .step-label.active {
            color: #2e75b6;
            font-weight: bold;
        }
        
        .step-label.inactive {
            color: #42474f;
            opacity: 0.6;
        }
        
        /* Two Column Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 6rem;
        }
        
        @media (min-width: 1024px) {
            .content-grid {
                grid-template-columns: 1.4fr 1fr;
            }
        }
        
        .card-form {
            background-color: white;
            border-radius: 0.75rem;
            border: 1px solid #c2c7d0;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .card-header-icon {
            width: 2rem;
            height: 2rem;
            border-radius: 0.25rem;
            background-color: #eff4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }
        
        .card-header h2 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            color: var(--primary);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #42474f;
            margin-bottom: 0.5rem;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #c2c7d0;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #0b1c30;
            background-color: white;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--secondary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(11, 97, 161, 0.1);
        }
        
        .form-group-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        /* Upload Zone */
        .upload-zone {
            border: 2px dashed #c2c7d0;
            border-radius: 0.75rem;
            background-color: #eff4ff;
            padding: 2rem;
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .upload-zone:hover {
            border-color: var(--secondary);
            background-color: #e5eeff;
        }
        
        .upload-icon {
            font-size: 3rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }
        
        .upload-text-main {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }
        
        .upload-text-sub {
            font-size: 0.75rem;
            color: #42474f;
            margin-bottom: 1rem;
        }
        
        .btn-browse {
            padding: 0.5rem 1rem;
            border: 1px solid var(--secondary);
            background-color: white;
            color: var(--secondary);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-browse:hover {
            background-color: #dce9ff;
        }
        
        /* Bottom Action Bar */
        .action-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            border-top: 1px solid #c2c7d0;
            padding: 1rem 2rem;
            box-shadow: 0 -4px 12px rgba(31, 78, 121, 0.05);
            z-index: 30;
        }
        
        .action-bar-content {
            max-width: 80rem;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .btn {
            padding: 0.625rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-secondary {
            background-color: #e5eeff;
            color: #42474f;
        }
        
        .btn-secondary:hover {
            background-color: #d3e4fe;
        }
        
        .btn-primary {
            background-color: #1f4e79;
            color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .btn-primary:hover {
            background-color: #184974;
        }
    </style>
</head>
<body>

<!-- Top Navigation -->
<nav class="top-nav">
    <div style="display: flex; align-items: center; gap: 2rem;">
        <h1 class="nav-brand">
            <span class="material-symbols-outlined">account_balance</span>
            Benin Cadastre
        </h1>
        <ul class="nav-links">
            <li>Tableau de Bord</li>
            <li>Mes Titres</li>
            <li class="active">Transactions</li>
            <li>Support</li>
        </ul>
    </div>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <button style="background: none; border: none; color: #42474f; cursor: pointer;">
            <span class="material-symbols-outlined">search</span>
        </button>
        <button style="background: none; border: none; color: #42474f; cursor: pointer; position: relative;">
            <span class="material-symbols-outlined">notifications</span>
            <span style="position: absolute; top: 0.25rem; right: 0.25rem; width: 0.5rem; height: 0.5rem; background-color: #ba1a1a; border-radius: 50%;"></span>
        </button>
        <button style="background: none; border: none; color: #42474f; cursor: pointer;">
            <span class="material-symbols-outlined">settings</span>
        </button>
    </div>
</nav>

<!-- Main Content -->
<div class="main-content">
    <!-- Page Header -->
    <h1 class="page-title">Transfert de Propriété</h1>
    <p class="page-subtitle">Veuillez renseigner les informations nécessaires pour initier le transfert de votre titre foncier.</p>
    
    <!-- Stepper -->
    <div class="stepper">
        <div class="stepper-steps">
            <div class="stepper-line"></div>
            <div class="stepper-line-active"></div>
            
            <div class="step">
                <div class="step-circle completed">
                    <span class="material-symbols-outlined" style="font-size: 1.5rem;">check</span>
                </div>
                <span class="step-label">1. Sélection du Terrain</span>
            </div>
            
            <div class="step">
                <div class="step-circle active">
                    <span style="font-weight: bold;">2</span>
                </div>
                <span class="step-label active">2. Informations de l'Acquéreur</span>
            </div>
            
            <div class="step">
                <div class="step-circle inactive" style="opacity: 0.6;">
                    <span style="font-weight: bold;">3</span>
                </div>
                <span class="step-label inactive">3. Justificatifs de Vente</span>
            </div>
        </div>
    </div>
    
    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Left Column: Form -->
        <div class="card-form">
            <div class="card-header">
                <div class="card-header-icon">
                    <span class="material-symbols-outlined">person</span>
                </div>
                <h2>Détails de l'Acquéreur</h2>
            </div>
            
            <div class="form-group">
                <label>Nom complet de l'acquéreur</label>
                <input type="text" placeholder="Ex: Jean Dupont">
            </div>
            
            <div class="form-group">
                <label>Numéro IFU / CNIB</label>
                <input type="text" placeholder="Numéro d'identification">
            </div>
            
            <div class="form-group-grid">
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" placeholder="+229 ...">
                </div>
                <div class="form-group">
                    <label>Adresse Email</label>
                    <input type="email" placeholder="email@domaine.com">
                </div>
            </div>
        </div>
        
        <!-- Right Column: Documents -->
        <div class="card-form" style="display: flex; flex-direction: column;">
            <div class="card-header">
                <div class="card-header-icon">
                    <span class="material-symbols-outlined">upload_file</span>
                </div>
                <h2>Pièces Jointes</h2>
            </div>
            
            <p style="color: #42474f; font-size: 0.875rem; margin-bottom: 1rem;">Veuillez fournir une copie numérisée de l'acte de vente signé par les deux parties.</p>
            
            <div class="upload-zone">
                <span class="material-symbols-outlined upload-icon">cloud_upload</span>
                <p class="upload-text-main">Glissez-déposez l'acte de vente signé</p>
                <p class="upload-text-sub">(PDF ou PNG, max 10Mo)</p>
                <button class="btn-browse">Parcourir les fichiers</button>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Action Bar -->
<div class="action-bar">
    <div class="action-bar-content">
        <button class="btn btn-secondary">Annuler</button>
        <button class="btn btn-primary">
            Soumettre le dossier au SADE
            <span class="material-symbols-outlined" style="font-size: 1rem;">arrow_forward</span>
        </button>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
