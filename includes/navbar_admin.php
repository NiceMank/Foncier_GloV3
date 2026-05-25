<?php
// includes/navbar_admin.php - Navbar pour Admin, Agent, Chef
$script_name = $_SERVER['SCRIPT_NAME'];
$est_admin_dashboard = (strpos($script_name, '/admin/dashboard.php') !== false);
$est_admin_parcelles = (strpos($script_name, '/admin/parcelles/') !== false);
$est_admin_proprietaires = (strpos($script_name, '/admin/proprietaires/') !== false);
$est_admin_alertes = (strpos($script_name, '/admin/alertes/') !== false);
$est_admin_litiges = (strpos($script_name, '/admin/litiges/') !== false);
$est_admin_transferts = (strpos($script_name, '/admin/transferts/') !== false);
$est_admin_users = (strpos($script_name, '/admin/users/') !== false && $_SESSION['user_role'] === 'administrateur');

$prenom_user = isset($_SESSION['user_prenom']) ? htmlspecialchars($_SESSION['user_prenom']) : 'Utilisateur';
$email_user = isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : '';
$role_user = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : '';
?>

<aside class="sidebar-wrapper p-3">
    <div class="d-flex align-items-center gap-3 mb-4 mt-2 px-2">
        <div class="icon-box" style="background-color: var(--md-primary-container);">
            <span class="material-symbols-outlined" style="color: var(--md-on-primary-container); font-variation-settings: 'FILL' 1;">admin_panel_settings</span>
        </div>
        <div class="d-flex flex-column">
            <span class="fw-bold fs-5 text-truncate" style="color: var(--md-primary); line-height: 1.2;">Foncier Glo</span>
            <small class="text-muted" style="font-size: 0.75rem;">Admin</small>
        </div>
    </div>

    <!-- Bouton Action Primaire -->
    <?php if($role_user === 'administrateur' || $role_user === 'agent_sade'): ?>
        <a href="/foncier_gloV3/admin/parcelles/create.php" class="btn w-100 mb-4 fw-semibold d-flex justify-content-center align-items-center gap-2" 
           style="background-color: var(--md-primary); color: white; border-radius: 8px;">
            <span class="material-symbols-outlined fs-6">add</span> Nouvelle Parcelle
        </a>
    <?php endif; ?>

    <nav class="d-flex flex-column gap-2 flex-grow-1 overflow-auto">
        <!-- Dashboard -->
        <a href="/foncier_gloV3/admin/dashboard.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_admin_dashboard ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_admin_dashboard ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>dashboard</span> 
            Dashboard
        </a>

        <!-- Parcelles -->
        <a href="/foncier_gloV3/admin/parcelles/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_admin_parcelles ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_admin_parcelles ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>map</span> 
            Parcelles
        </a>

        <!-- Propriétaires -->
        <a href="/foncier_gloV3/admin/proprietaires/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_admin_proprietaires ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_admin_proprietaires ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>person_pin</span> 
            Propriétaires
        </a>

        <!-- Alertes -->
        <a href="/foncier_gloV3/admin/alertes/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_admin_alertes ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_admin_alertes ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>warning</span> 
            Alertes
        </a>

        <!-- Litiges -->
        <a href="/foncier_gloV3/admin/litiges/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_admin_litiges ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_admin_litiges ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>gavel</span> 
            Litiges
        </a>

        <!-- Transferts (Chef/Admin) -->
        <?php if(in_array($role_user, ['chef_service', 'administrateur'])): ?>
            <a href="/foncier_gloV3/admin/transferts/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_admin_transferts ? 'active' : ''; ?>">
                <span class="material-symbols-outlined" <?php echo $est_admin_transferts ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>swap_horiz</span> 
                Transferts
            </a>
        <?php endif; ?>

        <!-- Gestion Agents (Admin only) -->
        <?php if($role_user === 'administrateur'): ?>
            <hr class="my-2">
            <a href="/foncier_gloV3/admin/users/index.php" class="text-decoration-none d-flex align-items-center gap-3 nav-link-custom <?php echo $est_admin_users ? 'active' : ''; ?>">
                <span class="material-symbols-outlined" <?php echo $est_admin_users ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>supervisor_account</span> 
                Agents & Chefs
            </a>
        <?php endif; ?>
    </nav>

    <hr class="my-3">

    <!-- User Profile -->
    <div class="d-flex align-items-center justify-content-between gap-2 px-2">
        <div class="d-flex align-items-center gap-2 flex-grow-1 text-truncate">
            <div class="avatar-mini" style="background-color: var(--md-secondary-container); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined text-secondary" style="font-size: 1.5rem;">account_circle</span>
            </div>
            <div class="d-flex flex-column text-truncate" style="min-width: 0;">
                <small class="fw-semibold text-dark text-truncate"><?php echo $prenom_user; ?></small>
                <small class="text-muted text-truncate" style="font-size: 0.7rem;"><?php echo ucfirst(str_replace('_', ' ', $role_user)); ?></small>
            </div>
        </div>
        <a href="/foncier_gloV3/logout.php" class="btn btn-sm btn-outline-danger" title="Déconnexion">
            <span class="material-symbols-outlined" style="font-size: 1rem;">logout</span>
        </a>
    </div>
</aside>
