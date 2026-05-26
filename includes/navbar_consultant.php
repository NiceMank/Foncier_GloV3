<?php
// includes/navbar_consultant.php - Barre latérale & supérieure pour l'Espace Citoyen Propriétaire
$script_name = $_SERVER['SCRIPT_NAME'];

// Détection dynamique de la page active pour l'illumination du menu
$est_consultant_dashboard  = (strpos($script_name, '/consultant/dashboard.php') !== false);
$est_consultant_parcelles  = (strpos($script_name, '/consultant/parcelles/') !== false);
$est_consultant_transferts = (strpos($script_name, '/consultant/transferts/') !== false);
$est_consultant_settings   = (strpos($script_name, '/consultant/settings.php') !== false);
$est_consultant_aide       = (strpos($script_name, '/consultant/aide.php') !== false);

$prenom_user = isset($_SESSION['user_prenom']) ? htmlspecialchars($_SESSION['user_prenom']) : 'Utilisateur';
$role_user   = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'proprietaire';
$user_id     = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

// --- LOGIQUE DYNAMIQUE DES NOTIFICATIONS DU CITOYEN ---
$db_notif = getConnexion();
$notifications_citoyen = [];
$count_notifs_citoyen = 0;

if ($db_notif && $user_id > 0) {
    // Récupérer les 4 dernières mises à jour de dossiers concernant ce propriétaire spécifique
    // (Changements de statut de ses demandes de transfert ou alertes sur ses parcelles)
    $sql_notifs = "SELECT 'transfert' AS nature, reference AS ref, 
                          CASE statut 
                            WHEN 'valide' THEN 'Votre demande de transfert a été approuvée et validée.'
                            WHEN 'rejete' THEN 'Votre demande de transfert a été rejetée par l\'administration.'
                            WHEN 'en_verification' THEN 'Votre dossier est en cours d\'analyse documentaire.'
                            ELSE 'Votre demande de transfert est en attente d\'instruction.'
                          END AS txt, 
                          statut AS info, updated_at AS created_at
                   FROM transferts 
                   WHERE ancien_proprietaire_id = ? 
                   ORDER BY updated_at DESC LIMIT 4";
    
    $stmt_notifs = $db_notif->prepare($sql_notifs);
    if ($stmt_notifs) {
        $stmt_notifs->bind_param('i', $user_id);
        $stmt_notifs->execute();
        $notifications_citoyen = $stmt_notifs->get_result()->fetch_all(MYSQLI_ASSOC);
        
        // On compte uniquement les dossiers qui ont évolué et ne sont pas juste en attente
        foreach ($notifications_citoyen as $n) {
            if (in_array($n['info'], ['valide', 'rejete', 'en_verification'])) {
                $count_notifs_citoyen++;
            }
        }
        $stmt_notifs->close();
    }
    $db_notif->close();
}
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

    <a href="/foncier_gloV3/consultant/transferts/create.php" class="btn w-100 mb-4 fw-semibold d-flex justify-content-center align-items-center gap-2 text-white" 
       style="background-color: var(--md-tertiary); border-radius: 8px; py: 2.5;">
        <span class="material-symbols-outlined fs-6">add</span> Demander une Vente
    </a>

    <nav class="d-flex flex-column gap-2 flex-grow-1 overflow-auto">
        <a href="/foncier_gloV3/consultant/dashboard.php" class="text-decoration-none nav-link-custom <?php echo $est_consultant_dashboard ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_consultant_dashboard ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>dashboard</span> 
            Accueil
        </a>

        <a href="/foncier_gloV3/consultant/parcelles/index.php" class="text-decoration-none nav-link-custom <?php echo $est_consultant_parcelles ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_consultant_parcelles ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>map</span> 
            Mes Parcelles
        </a>

        <a href="/foncier_gloV3/consultant/transferts/index.php" class="text-decoration-none nav-link-custom <?php echo $est_consultant_transferts ? 'active' : ''; ?>">
            <span class="material-symbols-outlined" <?php echo $est_consultant_transferts ? 'style="font-variation-settings: \'FILL\' 1;"' : ''; ?>>shopping_cart</span> 
            Mes Demandes
        </a>
    </nav>
</aside>

<div class="main-content">

    <header class="topbar d-flex justify-content-between align-items-center shadow-sm">
        <div class="d-flex align-items-center gap-4">
            <h5 class="m-0 fw-bold d-none d-md-block" style="color: var(--md-tertiary); text-transform: uppercase; font-size: 0.95rem; letter-spacing: 0.5px;">Portail Citoyen — ANCFP</h5>

            <form method="GET" action="/foncier_gloV3/consultant/parcelles/index.php" class="d-none d-lg-block">
                <div class="position-relative">
                    <span class="material-symbols-outlined search-icon position-absolute top-50 start-0 translate-middle-y ms-3 text-muted fs-5">search</span>
                    <input type="text" name="recherche" class="form-control search-input ps-5" placeholder="Rechercher parmi mes parcelles..." style="width: 320px; border-radius: 20px;">
                </div>
            </form>
        </div>

        <div class="d-flex align-items-center gap-3">
            
            <div class="dropdown">
                <button class="btn btn-light rounded-circle p-2 d-flex align-items-center justify-content-center text-muted position-relative" 
                        type="button" id="citoyenNotifDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 40px; height: 40px;">
                    <span class="material-symbols-outlined fs-5">notifications</span>
                    <?php if ($count_notifs_citoyen > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-warning border border-white rounded-circle"></span>
                    <?php endif; ?>
                </button>
                
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2 mt-2" aria-labelledby="citoyenNotifDropdown" style="width: 320px; border-radius: 12px; z-index: 1100;">
                    <li class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center bg-light">
                        <span class="fw-bold text-dark small">Suivi de vos dossiers</span>
                        <span class="badge bg-warning text-dark rounded-pill small"><?php echo count($notifications_citoyen); ?></span>
                    </li>
                    
                    <?php if (empty($notifications_citoyen)): ?>
                        <li class="px-3 py-4 text-center text-muted small">
                            <span class="material-symbols-outlined fs-3 d-block mb-1 opacity-50">mail</span>
                            Aucun mouvement de dossier récent.
                        </li>
                    <?php else: ?>
                        <?php foreach($notifications_citoyen as $n): ?>
                            <li>
                                <a class="dropdown-item px-3 py-2 border-bottom border-light d-flex gap-3 align-items-start text-wrap" href="/foncier_gloV3/consultant/transferts/index.php">
                                    <div class="mt-1">
                                        <?php if ($n['info'] === 'valide'): ?>
                                            <span class="material-symbols-outlined text-success fs-5">verified</span>
                                        <?php elseif ($n['info'] === 'rejete'): ?>
                                            <span class="material-symbols-outlined text-danger fs-5">cancel</span>
                                        <?php else: ?>
                                            <span class="material-symbols-outlined text-primary fs-5">hourglass_top</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-0.5">
                                            <strong class="text-dark small" style="font-size: 0.8rem;"><?php echo htmlspecialchars($n['ref']); ?></strong>
                                            <small class="text-muted" style="font-size: 0.65rem;"><?php echo date('d M', strtotime($n['created_at'])); ?></small>
                                        </div>
                                        <p class="text-muted m-0 small" style="font-size: 0.75rem; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php echo htmlspecialchars($n['txt']); ?></p>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li>
                            <a class="dropdown-item text-center text-primary fw-semibold small py-2 bg-light mb-0" href="/foncier_gloV3/consultant/transferts/index.php">
                                Voir toutes mes demandes
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="vr mx-2 text-muted"></div>

            <div class="dropdown">
                <button class="btn border-0 d-flex align-items-center gap-2 dropdown-toggle p-1" type="button" id="consultantUserDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-mini text-white d-flex align-items-center justify-content-center fw-bold" style="background-color: var(--md-tertiary); width: 36px; height: 36px; border-radius: 50%;">
                        <?php echo strtoupper(substr($prenom_user, 0, 1)); ?>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="consultantUserDropdown" style="border-radius: 8px;">
                    <li class="px-3 py-2 text-muted small border-bottom mb-2">Espace Propriétaire :<br><strong class="text-dark"><?php echo $prenom_user; ?></strong></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="/foncier_gloV3/logout.php"><span class="material-symbols-outlined fs-6">logout</span> Quitter l'espace</a></li>
                </ul>
            </div>
        </div>
    </header>