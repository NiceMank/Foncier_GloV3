<?php
// includes/navbar_consultant.php - Navbar pour Consultant (Propriétaire)
$script_name = $_SERVER['SCRIPT_NAME'];
$est_consultant_dashboard = (strpos($script_name, '/consultant/dashboard.php') !== false);
$est_consultant_parcelles = (strpos($script_name, '/consultant/parcelles/') !== false);
$est_consultant_transferts = (strpos($script_name, '/consultant/transferts/') !== false);

$prenom_user = isset($_SESSION['user_prenom']) ? htmlspecialchars($_SESSION['user_prenom']) : 'Utilisateur';
$email_user = isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : '';
?>

<aside class="sidebar-wrapper p-3">
    <div class="d-flex align-items-center gap-3 mb-4 mt-2 px-2">
        <div class="icon-box" style="background-color: var(--md-tertiary-container);">
            <span class="material-symbols-outlined" style="color: var(--md-on-tertiary-container); font-variation-settings: 'FILL' 1;">person</span>
        </div>
        <div class="d-flex flex-column">
            <span class="fw-bold fs-5 text-truncate" style="color: var(--md-tertiary); line-height: 1.2;">Foncier Glo</span>
            <small class="text-muted" style="font-size: 0.75rem;">Espace Consultant</small>
        </div>
    </div>

    <!-- Bouton Action Primaire -->
    <a href="/foncier_gloV3/consultant/transferts/create.php" class="btn w-100 mb-4 fw-semibold d-flex justify-content-center align-items-center gap-2" 
       style="background-color: var(--md-tertiary); color: white; border-radius: 8px;">
        <span class="material-symbols-outlined fs-6">add</span> Demander une Vente
    </a>

    <nav class="d-flex flex-column gap-2 flex-grow-1 overflow-auto">
        <!-- Dashboard -->
        <a href="/foncier_gloV3/consultant/dashboard.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_consultant_dashboard ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_consultant_dashboard ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>dashboard</span> 
            Accueil
        </a>

        <!-- Mes Parcelles -->
        <a href="/foncier_gloV3/consultant/parcelles/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_consultant_parcelles ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_consultant_parcelles ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>map</span> 
            Mes Parcelles
        </a>

        <!-- Mes Demandes -->
        <a href="/foncier_gloV3/consultant/transferts/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_consultant_transferts ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_consultant_transferts ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>shopping_cart</span> 
            Mes Demandes
        </a>
    </nav>

    <hr class="my-3">

    <!-- User Profile -->
    <div class="d-flex align-items-center justify-content-between gap-2 px-2">
        <div class="d-flex align-items-center gap-2 flex-grow-1 text-truncate">
            <div class="avatar-mini" style="background-color: var(--md-tertiary-container); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined text-tertiary" style="font-size: 1.5rem;">account_circle</span>
            </div>
            <div class="d-flex flex-column text-truncate" style="min-width: 0;">
                <small class="fw-semibold text-dark text-truncate"><?php echo $prenom_user; ?></small>
                <small class="text-muted text-truncate" style="font-size: 0.7rem;">Propriétaire</small>
            </div>
        </div>
        <a href="/foncier_gloV3/logout.php" class="btn btn-sm btn-outline-danger" title="Déconnexion">
            <span class="material-symbols-outlined" style="font-size: 1rem;">logout</span>
        </a>
    </div>
</aside>
