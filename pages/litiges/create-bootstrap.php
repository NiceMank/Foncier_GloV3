<?php
/**
 * Page: Ouvrir un Dossier de Litige
 * Role: Consultant/Admin
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ouvrir un Dossier de Litige - Système Foncier Glo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --primary: #00375e; --secondary: #0b61a1; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9ff; color: #0b1c30; }
        .sidebar { position: fixed; left: 0; top: 0; height: 100vh; width: 18rem; background: linear-gradient(135deg, #1f4e79 0%, #0b3d66 100%); color: white; padding: 1.5rem; z-index: 1050; overflow-y: auto; }
        .sidebar h1 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .sidebar p { font-size: 0.875rem; opacity: 0.8; margin-bottom: 2rem; }
        .sidebar a { display: flex; align-items: center; gap: 1rem; padding: 0.75rem 1rem; color: rgba(255,255,255,0.8); text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.3s; margin-bottom: 0.5rem; }
        .sidebar a:hover, .sidebar a.active { background-color: var(--secondary); color: white; }
        .main-wrapper { margin-left: 18rem; display: flex; flex-direction: column; min-height: 100vh; }
        .top-app-bar { position: sticky; top: 0; z-index: 40; background-color: white; border-bottom: 1px solid #c2c7d0; padding: 1rem 2.5rem; display: flex; justify-content: space-between; align-items: center; min-height: 4rem; }
        .content-area { flex: 1; padding: 2.5rem; overflow-y: auto; }
        .form-card { background-color: white; border: 1px solid #d3e4fe; border-radius: 0.75rem; box-shadow: 0 4px 12px rgba(31,78,121,0.05); }
        .card-header { padding: 1.5rem; border-bottom: 1px solid #c2c7d0; background-color: #f8f9ff; display: flex; justify-content: space-between; align-items: center; }
        .card-header h3 { margin: 0; font-size: 1.1rem; font-weight: 600; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }
        .form-section { padding: 2rem; }
        .form-section h4 { font-size: 0.875rem; font-weight: 600; color: #42474f; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #c2c7d0; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem; }
        .form-row.full { grid-template-columns: 1fr; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-weight: 600; font-size: 0.875rem; color: #42474f; margin-bottom: 0.5rem; }
        .form-group label .required { color: #ba1a1a; }
        .form-group input, .form-group select, .form-group textarea { padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.875rem; font-family: inherit; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(0,55,94,0.1); }
        .icon-input { position: relative; }
        .icon-input .material-symbols-outlined { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); pointer-events: none; color: #72777f; font-size: 1.25rem; }
        .icon-input input, .icon-input select { padding-left: 2.75rem; }
        .icon-input:focus-within .material-symbols-outlined { color: var(--primary); }
        .upload-zone { border: 2px dashed #cbd5e1; border-radius: 0.75rem; padding: 2rem; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; background-color: #eff4ff; cursor: pointer; transition: all 0.3s; }
        .upload-zone:hover { background-color: #e5eeff; border-color: var(--primary); }
        .upload-icon { width: 3rem; height: 3rem; border-radius: 50%; background-color: #dce9ff; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; }
        .upload-zone:hover .upload-icon { background-color: #1f4e79; color: white; }
        .button-group { display: flex; gap: 1rem; padding: 2rem; background-color: white; border-top: 1px solid #c2c7d0; }
        .btn { padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; border: none; cursor: pointer; font-size: 0.875rem; }
        .btn-primary { background-color: var(--primary); color: white; }
        .btn-secondary { background-color: white; color: var(--primary); border: 2px solid var(--primary); }
        @media (max-width: 768px) { .form-row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar">
    <div>
        <h1>Système Foncier</h1>
        <p>Nouveau Dossier</p>
    </div>
    <ul style="list-style: none; padding: 0; margin: 0;">
        <li><a href="#"><span class="material-symbols-outlined">dashboard</span> Tableau de Bord</a></li>
        <li><a href="#" class="active"><span class="material-symbols-outlined">gavel</span> Litiges</a></li>
        <li><a href="#"><span class="material-symbols-outlined">map</span> Parcelles</a></li>
        <li><a href="#"><span class="material-symbols-outlined">group</span> Propriétaires</a></li>
        <li><a href="#"><span class="material-symbols-outlined">settings</span> Paramètres</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-wrapper">
    <header class="top-app-bar">
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: var(--primary);">Ouvrir un Nouveau Dossier</h2>
    </header>
    
    <div class="content-area">
        <form class="form-card">
            <!-- Card Header -->
            <div class="card-header">
                <h3><span class="material-symbols-outlined">gavel</span> Nouveau Dossier</h3>
                <span style="font-size: 0.875rem; color: #72777f;">Date: <span id="currentDate">12 Nov 2023</span></span>
            </div>
            
            <!-- Form Body -->
            <div class="form-section">
                <div class="form-row">
                    <!-- Left Column: Infos Terrain & Plaignant -->
                    <div>
                        <h4><span class="material-symbols-outlined">map</span> Infos Terrain & Plaignant</h4>
                        
                        <!-- Parcelle Reference -->
                        <div class="form-group mb-4">
                            <label>Référence de la parcelle <span class="required">*</span></label>
                            <div class="icon-input">
                                <span class="material-symbols-outlined">map</span>
                                <select required>
                                    <option value="" disabled selected>Sélectionner une référence...</option>
                                    <option value="REF-GLO-882">REF-GLO-882 (Zone Nord)</option>
                                    <option value="REF-GLO-883">REF-GLO-883 (Zone Sud)</option>
                                    <option value="REF-GLO-884">REF-GLO-884 (Centre-Ville)</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Plaignant Name -->
                        <div class="form-group mb-4">
                            <label>Nom du Plaignant <span class="required">*</span></label>
                            <div class="icon-input">
                                <span class="material-symbols-outlined">person</span>
                                <input type="text" required placeholder="Nom complet ou raison sociale">
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="form-group mb-4">
                            <label>Contact Téléphone</label>
                            <div class="icon-input">
                                <span class="material-symbols-outlined">call</span>
                                <input type="tel" placeholder="+229 XX XX XX XX">
                            </div>
                        </div>
                        
                        <!-- IFU/NPI -->
                        <div class="form-group">
                            <label>Numéro IFU/NPI</label>
                            <div class="icon-input">
                                <span class="material-symbols-outlined">badge</span>
                                <input type="text" placeholder="Identifiant Fiscal ou National" style="text-transform: uppercase;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Détails du Conflit -->
                    <div>
                        <h4><span class="material-symbols-outlined">category</span> Détails du Conflit</h4>
                        
                        <!-- Type de Litige -->
                        <div class="form-group mb-4">
                            <label>Type de litige <span class="required">*</span></label>
                            <div class="icon-input">
                                <span class="material-symbols-outlined">category</span>
                                <select required>
                                    <option value="" disabled selected>Catégorie du conflit...</option>
                                    <option value="double_vente">Double Vente</option>
                                    <option value="succession">Succession/Héritage</option>
                                    <option value="empietement">Empiètement de limites</option>
                                    <option value="faux_titre">Faux Titre Foncier</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="form-group">
                            <label>Description détaillée des faits <span class="required">*</span></label>
                            <textarea required placeholder="Décrivez clairement la nature du conflit, les parties impliquées et l'historique récent..." rows="4"></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- File Upload -->
                <div class="form-group form-row full">
                    <div>
                        <label>Pièces Justificatives</label>
                        <div class="upload-zone">
                            <div class="upload-icon">
                                <span class="material-symbols-outlined">upload_file</span>
                            </div>
                            <p style="margin: 0.5rem 0; font-weight: 600; font-size: 0.875rem;">Déposez ici les plaintes officielles ou ordonnances judiciaires</p>
                            <p style="margin: 0; font-size: 0.75rem; color: #72777f;">PDF, PNG ou JPG (Max 10MB)</p>
                            <input type="file" id="fileUpload" multiple accept=".pdf,.png,.jpg,.jpeg" style="display: none;">
                            <button type="button" class="btn btn-secondary" style="margin-top: 1rem; font-size: 0.75rem; padding: 0.5rem 1rem;" onclick="document.getElementById('fileUpload').click()">
                                Parcourir les fichiers
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="button-group">
                <button type="button" class="btn btn-secondary">Annuler</button>
                <button type="submit" class="btn btn-primary">Ouvrir le Dossier</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
