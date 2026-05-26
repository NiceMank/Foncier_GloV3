<?php
// admin/dashboard.php
require_once 'config/session.php';
require_once 'config/database.php';
// Seuls les employés du Staff (Admin, Agent, Chef) ont accès à cette page
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

$titre = "Tableau de bord - Admin";
$conn  = getConnexion();

// -- Statistiques dynamiques --
$total_parcelles = $conn->query("SELECT COUNT(*) as total FROM parcelles")->fetch_assoc()['total'];
$total_alertes   = $conn->query("SELECT COUNT(*) as total FROM alertes WHERE statut = 'nouvelle'")->fetch_assoc()['total'];
$total_litiges   = $conn->query("SELECT COUNT(*) as total FROM litiges WHERE statut IN ('ouvert','en_cours')")->fetch_assoc()['total'];
// Nouvelle stat pour les transferts
$total_transferts_attente = $conn->query("SELECT COUNT(*) as total FROM transferts WHERE statut = 'en_attente'")->fetch_assoc()['total'];
$total_proprietaires = $conn->query("SELECT COUNT(*) as total FROM proprietaires")->fetch_assoc()['total'];
$total_libres    = $conn->query("SELECT COUNT(*) as total FROM parcelles WHERE statut = 'libre'")->fetch_assoc()['total'];

// -- Données récentes (Derniers transferts) --
$transferts_recents_sql = "
    SELECT t.*, p.reference_cadastrale, pr.nom as ancien_nom, pr.prenom as ancien_prenom 
    FROM transferts t 
    JOIN parcelles p ON t.parcelle_id = p.id 
    JOIN proprietaires pr ON t.ancien_proprietaire_id = pr.id 
    ORDER BY t.created_at DESC 
    LIMIT 5
";
$transferts_recents = $conn->query($transferts_recents_sql)->fetch_all(MYSQLI_ASSOC);

$conn->close();

require_once 'includes/header.php'; 
require_once 'includes/navbar_admin.php'; // Inclut la topbar et la sidebar
?>

<div class="container-fluid p-4 p-md-5">
    
    <section class="dashboard-hero mb-4">
        <h1 class="display-6 fw-bold mb-2">Espace Gestionnaire</h1>
        <p class="fs-5 opacity-75 mb-0">
            Session: <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $_SESSION['user_role']))); ?> | Système Foncier Glo
        </p>
    </section>

    <section class="row g-4 mb-5">
        
        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="fw-semibold text-muted small">Total Parcelles</span>
                    <div class="icon-box" style="background-color: var(--md-secondary-container);">
                        <span class="material-symbols-outlined" style="color: var(--md-on-secondary-container);">map</span>
                    </div>
                </div>
                <div class="stat-value text-dark"><?php echo number_format($total_parcelles, 0, ',', ' '); ?></div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="fw-semibold text-muted small">Alertes</span>
                    <div class="icon-box" style="background-color: var(--md-error-container);">
                        <span class="material-symbols-outlined" style="color: var(--md-on-error-container);">warning</span>
                    </div>
                </div>
                <div class="stat-value text-danger"><?php echo $total_alertes; ?></div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="fw-semibold text-muted small">Litiges Actifs</span>
                    <div class="icon-box" style="background-color: var(--md-tertiary-container);">
                        <span class="material-symbols-outlined" style="color: var(--md-on-tertiary-container);">gavel</span>
                    </div>
                </div>
                <div class="stat-value text-dark"><?php echo $total_litiges; ?></div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="fw-semibold text-muted small">Transferts attente</span>
                    <div class="icon-box" style="background-color: var(--md-surface-variant);">
                        <span class="material-symbols-outlined" style="color: var(--md-on-surface-variant);">pending_actions</span>
                    </div>
                </div>
                <div class="stat-value text-dark"><?php echo $total_transferts_attente; ?></div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="fw-semibold text-muted small">Propriétaires</span>
                    <div class="icon-box" style="background-color: var(--md-primary-fixed-dim);">
                        <span class="material-symbols-outlined" style="color: var(--md-on-primary-fixed);">group</span>
                    </div>
                </div>
                <div class="stat-value text-dark"><?php echo number_format($total_proprietaires, 0, ',', ' '); ?></div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="fw-semibold text-muted small">Parcelles Libres</span>
                    <div class="icon-box" style="background-color: var(--md-inverse-primary);">
                        <span class="material-symbols-outlined" style="color: var(--md-on-primary-fixed);">check_circle</span>
                    </div>
                </div>
                <div class="stat-value text-dark"><?php echo number_format($total_libres, 0, ',', ' '); ?></div>
            </div>
        </div>

    </section>

    <section class="table-card shadow-sm mb-4">
        <div class="p-3 d-flex justify-content-between align-items-center border-bottom bg-white">
            <h5 class="mb-0 fw-bold text-dark">Demandes de transfert récentes</h5>
            <a href="/foncier_gloV3/admin/transferts/index.php" class="text-decoration-none fw-medium small">Voir tout</a>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Date</th>
                        <th>Cédant (Ancien)</th>
                        <th>Acquéreur (Nouveau)</th>
                        <th>Statut</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transferts_recents)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Aucune demande de transfert récente.</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach($transferts_recents as $transfert): ?>
                        <tr>
                            <td class="fw-medium"><?php echo htmlspecialchars($transfert['reference']); ?></td>
                            <td class="text-muted"><?php echo date('d M Y', strtotime($transfert['created_at'])); ?></td>
                            <td><?php echo htmlspecialchars($transfert['ancien_prenom'] . ' ' . $transfert['ancien_nom']); ?></td>
                            <td><?php echo htmlspecialchars($transfert['nouveau_prenom'] . ' ' . $transfert['nouveau_nom']); ?></td>
                            <td>
                                <?php 
                                    $badgeClass = 'bg-secondary';
                                    if ($transfert['statut'] == 'en_attente') $badgeClass = 'bg-warning text-dark';
                                    if ($transfert['statut'] == 'en_verification') $badgeClass = 'bg-info text-dark';
                                    if ($transfert['statut'] == 'valide') $badgeClass = 'bg-success';
                                    if ($transfert['statut'] == 'rejete') $badgeClass = 'bg-danger';
                                ?>
                                <span class="badge rounded-pill <?php echo $badgeClass; ?> fw-normal px-3 py-2">
                                    <?php echo ucfirst(str_replace('_', ' ', $transfert['statut'])); ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="/foncier_gloV3/admin/transferts/show.php?id=<?php echo $transfert['id']; ?>" class="btn btn-sm btn-light text-primary border shadow-sm">
                                    <span class="material-symbols-outlined fs-6 align-middle">visibility</span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>

<?php require_once 'includes/footer.php'; ?>