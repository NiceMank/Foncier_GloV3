<?php
// Détection dynamique de la page active
$script_name = $_SERVER['SCRIPT_NAME'];
$est_accueil = (strpos($script_name, 'dashboard.php') !== false);
$est_parcelles = (strpos($script_name, '/pages/parcelles/') !== false);
$est_proprietaires = (strpos($script_name, '/pages/proprietaires/') !== false);
$est_alertes = (strpos($script_name, '/pages/alertes/') !== false);
$est_litiges = (strpos($script_name, '/pages/litiges/') !== false);

// Rôle et Nom pour l'affichage
$prenom_user = isset($_SESSION['user_prenom']) ? htmlspecialchars($_SESSION['user_prenom']) : 'Utilisateur';
$email_user = isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : '';
$role_user = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : '';
?>

<aside class="sidebar-wrapper p-3">
    <div class="d-flex align-items-center gap-3 mb-4 mt-2 px-2">
        <div class="icon-box" style="background-color: var(--md-primary-container);">
            <span class="material-symbols-outlined" style="color: var(--md-on-primary-container); font-variation-settings: 'FILL' 1;">assured_workload</span>
        </div>
        <div class="d-flex flex-column">
            <span class="fw-bold fs-5 text-truncate" style="color: var(--md-primary); line-height: 1.2;">Foncier Glo</span>
            <small class="text-muted" style="font-size: 0.75rem;">Admin Portal v2.0</small>
        </div>
    </div>

    <?php if($role_user === 'administrateur' || $role_user === 'agent_sade'): ?>
        <a href="/foncier_gloV3/pages/parcelles/create.php" class="btn w-100 mb-4 fw-semibold d-flex justify-content-center align-items-center gap-2" 
           style="background-color: var(--md-primary); color: white; border-radius: 8px;">
            <span class="material-symbols-outlined fs-6">add</span> Nouvelle Parcelle
        </a>
    <?php endif; ?>

    <nav class="d-flex flex-column gap-2 flex-grow-1 overflow-auto">
        <a href="/foncier_gloV3/dashboard.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_accueil ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_accueil ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>dashboard</span> 
            Dashboard
        </a>
        <a href="/foncier_gloV3/pages/parcelles/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_parcelles ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_parcelles ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>map</span> 
            Parcelles
        </a>
        <a href="/foncier_gloV3/pages/proprietaires/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_proprietaires ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_proprietaires ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>person_pin</span> 
            Propriétaires
        </a>
        <a href="/foncier_gloV3/pages/alertes/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_alertes ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_alertes ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>warning</span> 
            Alertes
        </a>
        <a href="/foncier_gloV3/pages/litiges/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_litiges ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_litiges ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>gavel</span> 
            Litiges
        </a>
    </nav>

    <div class="mt-auto pt-3 border-top">
        <a href="#" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom">
            <span class="material-symbols-outlined">settings</span> Paramètres
        </a>
    </div>
</aside>

<div class="main-content">
    
    <header class="topbar d-flex justify-content-between align-items-center shadow-sm">
        
        <div class="d-flex align-items-center gap-4">
            <h5 class="mb-0 fw-bold d-none d-sm-block" style="color: var(--md-primary);">Réforme Foncière</h5>
            <form action="/foncier_gloV3/pages/parcelles/index.php" method="GET" class="position-relative d-none d-md-block">
                <span class="material-symbols-outlined search-icon">search</span>
                <input type="text" name="reference" class="form-control search-input" placeholder="Rechercher une référence...">
            </form>
        </div>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light rounded-circle p-2 d-flex position-relative">
                <span class="material-symbols-outlined text-muted">notifications</span>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            </button>
            
            <div class="vr mx-1"></div>
            
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none gap-2" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex flex-column text-end d-none d-sm-block">
                        <span class="fw-bold small text-dark lh-1"><?php echo $prenom_user; ?></span>
                        <span class="text-muted" style="font-size: 0.75rem;"><?php echo ucfirst(str_replace('_', ' ', $role_user)); ?></span>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($prenom_user); ?>&background=0b61a1&color=fff&rounded=true" alt="Profil" width="38" height="38" class="border">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li class="px-3 py-2 text-muted small"><?php echo $email_user; ?></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger d-flex align-items-center gap-2" href="/foncier_gloV3/logout.php">
                            <span class="material-symbols-outlined fs-6">logout</span> Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>