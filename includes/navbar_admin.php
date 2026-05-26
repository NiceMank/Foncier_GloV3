<?php
// includes/navbar_admin.php - Barre latérale & supérieure unifiée pour l'Administration
$script_name = $_SERVER['SCRIPT_NAME'];

// Détection dynamique de la page active pour le style visuel
$est_admin_dashboard     = (strpos($script_name, '/dashboard.php') !== false);
$est_admin_parcelles     = (strpos($script_name, '/admin/parcelles/') !== false);
$est_admin_proprietaires = (strpos($script_name, '/admin/proprietaires/') !== false);
$est_admin_transferts    = (strpos($script_name, '/admin/transferts/') !== false);
$est_admin_litiges       = (strpos($script_name, '/admin/litiges/') !== false);
$est_admin_alertes       = (strpos($script_name, '/admin/alertes/') !== false);
$est_admin_users         = (strpos($script_name, '/admin/users/') !== false);
$est_admin_settings      = (strpos($script_name, '/admin/settings.php') !== false);
$est_admin_aide          = (strpos($script_name, '/admin/aide.php') !== false);

$prenom_user = isset($_SESSION['user_prenom']) ? htmlspecialchars($_SESSION['user_prenom']) : 'Utilisateur';
$role_user   = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : '';

// --- LOGIQUE DYNAMIQUE DES NOTIFICATIONS SELON LE RÔLE ---
$db_notif = getConnexion();
$notifications_systeme = [];
$count_notifs = 0;

if ($db_notif) {
    $sql_notifs = "";
    
    if ($role_user === 'chef_service') {
        // Le Chef est notifié des transferts soumis par l'agent et des alertes critiques
        $sql_notifs = "SELECT 'alerte' AS nature, code AS ref, message AS txt, niveau AS info, created_at 
                       FROM alertes WHERE statut = 'nouvelle'
                       UNION ALL
                       SELECT 'transfert' AS nature, reference AS ref, 'Dossier soumis par l\'agent pour validation finale.' AS txt, 'info' AS info, created_at 
                       FROM transferts WHERE statut = 'en_verification'
                       ORDER BY created_at DESC LIMIT 4";
    } elseif ($role_user === 'agent_sade') {
        // L'Agent est notifié des nouvelles demandes citoyennes et des alertes
        $sql_notifs = "SELECT 'alerte' AS nature, code AS ref, message AS txt, niveau AS info, created_at 
                       FROM alertes WHERE statut = 'nouvelle'
                       UNION ALL
                       SELECT 'transfert' AS nature, reference AS ref, 'Nouvelle demande citoyenne à analyser.' AS txt, 'info' AS info, created_at 
                       FROM transferts WHERE statut = 'en_attente'
                       ORDER BY created_at DESC LIMIT 4";
    }
    // L'administrateur n'a pas de requête de notification car il ne gère plus l'opérationnel
    
    if (!empty($sql_notifs)) {
        $res_notifs = $db_notif->query($sql_notifs);
        if ($res_notifs) {
            $notifications_systeme = $res_notifs->fetch_all(MYSQLI_ASSOC);
            $count_notifs = count($notifications_systeme);
        }
    }
    $db_notif->close();
}
?>

<aside class="sidebar-wrapper p-3">
    <div class="d-flex align-items-center gap-3 mb-4 mt-2 px-2">
        <div class="icon-box" style="background-color: var(--md-primary-container);">
            <span class="material-symbols-outlined" style="color: var(--md-on-primary-container); font-variation-settings: 'FILL' 1;">assured_workload</span>
        </div>
        <div class="d-flex flex-column">
            <span class="fw-bold fs-5 text-truncate" style="color: var(--md-primary); line-height: 1.2;">Foncier Glo</span>
            <small class="text-muted" style="font-size: 0.75rem;">Administration</small>
        </div>
    </div>

    <?php if ($role_user === 'agent_sade'): ?>
        <a href="/foncier_gloV3/admin/parcelles/create.php" class="btn w-100 mb-4 fw-semibold d-flex justify-content-center align-items-center gap-2 text-white"
            style="background-color: var(--md-primary); border-radius: 8px; py: 2.5;">
            <span class="material-symbols-outlined fs-6">add</span> Enregistrer une parcelle
        </a>
    <?php endif; ?>

    <nav class="d-flex flex-column gap-2 flex-grow-1 overflow-auto">
        <a href="/foncier_gloV3/admin/dashboard.php" class="text-decoration-none nav-link-custom <?php echo $est_admin_dashboard ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_admin_dashboard ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>dashboard</span>
            Dashboard
        </a>

        <a href="/foncier_gloV3/admin/parcelles/index.php" class="text-decoration-none nav-link-custom <?php echo $est_admin_parcelles ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_admin_parcelles ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>map</span>
            Parcelles
        </a>

        <a href="/foncier_gloV3/admin/proprietaires/index.php" class="text-decoration-none nav-link-custom <?php echo $est_admin_proprietaires ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_admin_proprietaires ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>person_pin</span>
            Propriétaires
        </a>

        <?php if ($role_user === 'chef_service' || $role_user === 'agent_sade'): ?>
            <a href="/foncier_gloV3/admin/transferts/index.php" class="text-decoration-none nav-link-custom <?php echo $est_admin_transferts ? 'active' : ''; ?>">
                <span class="material-symbols-outlined" <?php echo $est_admin_transferts ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>swap_horiz</span>
                Transferts
            </a>

            <a href="/foncier_gloV3/admin/litiges/index.php" class="text-decoration-none nav-link-custom <?php echo $est_admin_litiges ? 'active' : ''; ?>">
                <span class="material-symbols-outlined" <?php echo $est_admin_litiges ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>gavel</span>
                Litiges
            </a>

            <a href="/foncier_gloV3/admin/alertes/index.php" class="text-decoration-none nav-link-custom <?php echo $est_admin_alertes ? 'active' : ''; ?>">
                <span class="material-symbols-outlined" <?php echo $est_admin_alertes ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>warning</span>
                Alertes
            </a>
        <?php endif; ?>
    </nav>

    <div class="mt-auto border-top pt-3">
        <?php if ($role_user === 'administrateur' || $role_user === 'chef_service'): ?>
            <a href="/foncier_gloV3/admin/users/index.php" class="text-decoration-none nav-link-custom mb-1 <?php echo $est_admin_users ? 'active' : ''; ?>">
                <span class="material-symbols-outlined" <?php echo $est_admin_users ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>supervisor_account</span>
                <?php echo $role_user === 'administrateur' ? 'Gérer les Chefs' : 'Gérer les Agents'; ?>
            </a>
        <?php endif; ?>
        
        <a href="/foncier_gloV3/admin/settings.php" class="text-decoration-none nav-link-custom <?php echo $est_admin_settings ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_admin_settings ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>settings</span>
            Paramètres
        </a>
    </div>
</aside>

<div class="main-content">

    <header class="topbar d-flex justify-content-between align-items-center shadow-sm">
        <div class="d-flex align-items-center gap-4">
            <h5 class="m-0 fw-bold d-none d-md-block" style="color: var(--md-primary); text-transform: uppercase; font-size: 0.95rem; letter-spacing: 0.5px;">Système Cadastral Glo</h5>

            <form method="GET" action="/foncier_gloV3/admin/search.php" class="d-none d-lg-block">
                <div class="position-relative">
                    <span class="material-symbols-outlined search-icon position-absolute top-50 start-0 translate-middle-y ms-3 text-muted fs-5">search</span>
                    <input type="text" name="q" class="form-control search-input ps-5" placeholder="Rechercher référence, NPI..." style="width: 360px; border-radius: 20px;" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
                </div>
            </form>
        </div>

        <div class="d-flex align-items-center gap-3">
            
            <?php if ($role_user !== 'administrateur'): ?>
                <div class="dropdown">
                    <button class="btn btn-light rounded-circle p-2 d-flex align-items-center justify-content-center text-muted position-relative" 
                            type="button" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 40px; height: 40px;">
                        <span class="material-symbols-outlined fs-5">notifications</span>
                        <?php if ($count_notifs > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-white rounded-circle"></span>
                        <?php endif; ?>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2 mt-2" aria-labelledby="notifDropdown" style="width: 320px; border-radius: 12px; z-index: 1100;">
                        <li class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center bg-light">
                            <span class="fw-bold text-dark small">Tâches & Alertes</span>
                            <span class="badge bg-danger rounded-pill small"><?php echo $count_notifs; ?></span>
                        </li>
                        
                        <?php if (empty($notifications_systeme)): ?>
                            <li class="px-3 py-4 text-center text-muted small">
                                <span class="material-symbols-outlined fs-3 d-block mb-1 opacity-50">notifications_off</span>
                                Aucune notification en attente.
                            </li>
                        <?php else: ?>
                            <?php foreach($notifications_systeme as $n): ?>
                                <li>
                                    <a class="dropdown-item px-3 py-2 border-bottom border-light d-flex gap-3 align-items-start text-wrap" 
                                       href="<?php echo $n['nature'] === 'alerte' ? '/foncier_gloV3/admin/alertes/index.php' : '/foncier_gloV3/admin/transferts/index.php'; ?>">
                                        <div class="mt-1">
                                            <?php if ($n['info'] === 'critique'): ?>
                                                <span class="material-symbols-outlined text-danger fs-5">gavel</span>
                                            <?php else: ?>
                                                <span class="material-symbols-outlined text-warning fs-5">swap_horiz</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-0.5">
                                                <strong class="text-dark small" style="font-size: 0.8rem;"><?php echo htmlspecialchars($n['ref']); ?></strong>
                                                <small class="text-muted" style="font-size: 0.65rem;"><?php echo date('H:i', strtotime($n['created_at'])); ?></small>
                                            </div>
                                            <p class="text-muted m-0 small" style="font-size: 0.75rem; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php echo htmlspecialchars($n['txt']); ?></p>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li>
                                <a class="dropdown-item text-center text-primary fw-semibold small py-2 bg-light mb-0" href="/foncier_gloV3/admin/alertes/index.php">
                                    Ouvrir le centre de sécurité
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <a href="/foncier_gloV3/admin/aide.php" class="btn btn-light rounded-circle p-2 d-flex align-items-center justify-content-center text-muted <?php echo $est_admin_aide ? 'bg-secondary bg-opacity-10 text-primary' : ''; ?>" style="width: 40px; height: 40px;" title="Documentation & Manuel">
                <span class="material-symbols-outlined fs-5">help</span>
            </a>

            <div class="vr mx-2 text-muted"></div>

            <div class="dropdown">
                <button class="btn border-0 d-flex align-items-center gap-2 dropdown-toggle p-1" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-mini text-white d-flex align-items-center justify-content-center fw-bold" style="background-color: var(--md-primary); width: 36px; height: 36px; border-radius: 50%;">
                        <?php echo strtoupper(substr($prenom_user, 0, 1)); ?>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown" style="border-radius: 8px;">
                    <li class="px-3 py-2 text-muted small border-bottom mb-2">Connecté en tant que :<br><strong class="text-dark"><?php echo ucfirst(str_replace('_', ' ', $role_user)); ?></strong></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2" href="/foncier_gloV3/admin/settings.php"><span class="material-symbols-outlined fs-6">person</span> Mon Profil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="/foncier_gloV3/logout.php"><span class="material-symbols-outlined fs-6">logout</span> Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </header>