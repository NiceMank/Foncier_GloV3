<?php
/**
 * Page: Détails Après Transfert
 * Role: Consultant
 * Converted from Tailwind CSS to Bootstrap 5
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Transfert Complété</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --primary: #00375e; --secondary: #0b61a1; --surface: #f8f9ff; }
        body { font-family: 'Plus Jakarta Sans', Segoe UI, sans-serif; background-color: var(--surface); color: #0b1c30; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .top-nav { background-color: white; border-bottom: 1px solid #c2c7d0; padding: 1rem 2.5rem; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 40; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .nav-brand { font-size: 1.25rem; font-weight: 600; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; margin: 0; }
        .main-container { max-width: 80rem; margin: 0 auto; padding: 2rem 1rem; }
        .page-title { font-size: 2rem; font-weight: 700; color: var(--primary); margin-bottom: 2rem; }
        .card { background-color: white; border: 1px solid #c2c7d0; border-radius: 0.75rem; box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05); padding: 1.5rem; margin-bottom: 1.5rem; }
        .summary-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #c2c7d0; }
        .summary-header h2 { margin: 0; font-size: 1.1rem; font-weight: 600; color: #0b1c30; }
        .info-row { display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid #eff4ff; }
        .info-label { font-size: 0.875rem; color: #42474f; font-weight: 500; }
        .info-value { font-size: 0.95rem; font-weight: 600; color: #0b1c30; }
        .status-badge-success { display: inline-flex; align-items: center; gap: 0.5rem; background-color: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.5rem 1rem; border-radius: 9999px; font-weight: 600; }
        .timeline { position: relative; padding: 2rem 0; }
        .timeline-item { position: relative; padding-left: 4rem; margin-bottom: 2rem; }
        .timeline-marker { position: absolute; left: 0; top: 0; width: 2rem; height: 2rem; background-color: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; }
        .timeline-line { position: absolute; left: 0.875rem; top: 2rem; width: 2px; height: calc(100% + 1rem); background-color: #d3e4fe; }
        .timeline-item:last-child .timeline-line { display: none; }
        .timeline-title { font-weight: 600; color: #0b1c30; margin-bottom: 0.25rem; }
        .timeline-date { font-size: 0.875rem; color: #42474f; }
        .download-btn { display: inline-flex; align-items: center; gap: 0.5rem; background-color: white; border: 2px solid var(--primary); color: var(--primary); padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .download-btn:hover { background-color: var(--primary); color: white; }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="top-nav">
    <h1 class="nav-brand">
        <span class="material-symbols-outlined">account_balance</span>
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

<!-- Main Content -->
<div class="main-container">
    <h1 class="page-title">Transfert Complété</h1>
    
    <!-- Summary Card -->
    <div class="card">
        <div class="summary-header">
            <span class="material-symbols-outlined" style="color: #10b981; font-size: 1.75rem;">check_circle</span>
            <h2>Résumé de la Transaction</h2>
        </div>
        
        <div class="info-row">
            <div>
                <div class="info-label">Référence</div>
                <div class="info-value">TRANS/001/2024</div>
            </div>
            <div>
                <div class="info-label">Date</div>
                <div class="info-value">25 Mai 2024</div>
            </div>
            <div>
                <div class="info-label">Statut</div>
                <div class="status-badge-success">
                    <span class="material-symbols-outlined">check_circle</span>
                    Complété
                </div>
            </div>
        </div>
        
        <div class="info-row">
            <div>
                <div class="info-label">Propriétaire Précédent</div>
                <div class="info-value">Jean-Paul Dossou</div>
            </div>
            <div>
                <div class="info-label">Nouveau Propriétaire</div>
                <div class="info-value">Marie-Claire Afiwa</div>
            </div>
        </div>
    </div>
    
    <!-- Timeline Card -->
    <div class="card">
        <div class="summary-header">
            <span class="material-symbols-outlined" style="color: var(--primary);">history</span>
            <h2>Historique de la Transaction</h2>
        </div>
        
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-marker">
                    <span class="material-symbols-outlined" style="font-size: 1rem;">check</span>
                </div>
                <div class="timeline-line"></div>
                <div class="timeline-title">Dossier Créé</div>
                <div class="timeline-date">12 Mai 2024 à 09:30</div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-marker">
                    <span class="material-symbols-outlined" style="font-size: 1rem;">check</span>
                </div>
                <div class="timeline-line"></div>
                <div class="timeline-title">Documents Vérifiés</div>
                <div class="timeline-date">15 Mai 2024 à 14:15</div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-marker">
                    <span class="material-symbols-outlined" style="font-size: 1rem;">check</span>
                </div>
                <div class="timeline-line"></div>
                <div class="timeline-title">Identités Confirmées</div>
                <div class="timeline-date">18 Mai 2024 à 10:45</div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-marker">
                    <span class="material-symbols-outlined" style="font-size: 1rem;">check</span>
                </div>
                <div class="timeline-title">Transfert Approuvé</div>
                <div class="timeline-date">25 Mai 2024 à 16:20</div>
            </div>
        </div>
    </div>
    
    <!-- Documents Card -->
    <div class="card">
        <div class="summary-header">
            <span class="material-symbols-outlined" style="color: var(--primary);">folder</span>
            <h2>Documents</h2>
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background-color: #eff4ff; border-radius: 0.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <span class="material-symbols-outlined">picture_as_pdf</span>
                    <div>
                        <div style="font-weight: 600; color: #0b1c30;">Acte de Vente Signé</div>
                        <div style="font-size: 0.875rem; color: #42474f;">TF_4958.pdf • 2.4 MB</div>
                    </div>
                </div>
                <button class="download-btn">
                    <span class="material-symbols-outlined">download</span>
                    Télécharger
                </button>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background-color: #eff4ff; border-radius: 0.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <span class="material-symbols-outlined">picture_as_pdf</span>
                    <div>
                        <div style="font-weight: 600; color: #0b1c30;">Titre Foncier Initial</div>
                        <div style="font-size: 0.875rem; color: #42474f;">TF_4957_Old.pdf • 1.8 MB</div>
                    </div>
                </div>
                <button class="download-btn">
                    <span class="material-symbols-outlined">download</span>
                    Télécharger
                </button>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
        <button style="padding: 0.75rem 1.5rem; background-color: var(--primary); color: white; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer;">
            Retour aux Transferts
        </button>
        <button style="padding: 0.75rem 1.5rem; background-color: white; color: var(--primary); border: 2px solid var(--primary); border-radius: 0.5rem; font-weight: 600; cursor: pointer;">
            Imprimer le Certificat
        </button>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
