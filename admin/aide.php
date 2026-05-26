<?php
// admin/aide.php
require_once '../config/session.php';
require_once '../config/database.php';
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

$titre = "Centre d'Aide";
require_once '../includes/header.php'; 
require_once '../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1" style="color: var(--md-primary);">Support & Centre de Ressources</h1>
        <p class="text-muted small">Guides méthodologiques et documents légaux pour l'exercice de vos fonctions.</p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card bg-white shadow-sm p-4 h-100 d-flex flex-column border-0">
                <span class="material-symbols-outlined text-primary fs-2 mb-3">menu_book</span>
                <h5 class="fw-bold text-dark mb-2">Guide d'utilisation de l'Agent</h5>
                <p class="small text-muted flex-grow-1">Découvrez la procédure réglementaire pour consigner une nouvelle parcelle, relever des coordonnées GPS valides et affecter un citoyen.</p>
                <button class="btn btn-light border text-primary btn-sm w-100 mt-3 fw-semibold">Ouvrir le guide ↗</button>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card bg-white shadow-sm p-4 h-100 d-flex flex-column border-0">
                <span class="material-symbols-outlined text-danger fs-2 mb-3">gavel</span>
                <h5 class="fw-bold text-dark mb-2">Code Foncier & Domanial</h5>
                <p class="small text-muted flex-grow-1">Consultez l'ensemble du recueil de lois régissant le foncier en République du Bénin pour instruire efficacement les litiges et blocages.</p>
                <button class="btn btn-light border text-danger btn-sm w-100 mt-3 fw-semibold">Consulter la loi ↗</button>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card bg-white shadow-sm p-4 h-100 d-flex flex-column border-0">
                <span class="material-symbols-outlined text-success fs-2 mb-3">contact_support</span>
                <h5 class="fw-bold text-dark mb-2">Assistance Informatique</h5>
                <p class="small text-muted flex-grow-1">Une anomalie avec les tracés géométriques ou un bug de base de données ? Écrivez à l'assistance technique centrale du ministère.</p>
                <div class="bg-light p-2.5 rounded text-center font-monospace small border text-dark mt-3 fw-semibold">support.foncier@gouv.bj</div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>