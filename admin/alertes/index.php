<?php
// admin/alertes/index.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Sécurité : Accessible à tout le staff (Admin, Agent SADE, Chef de Service)
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

$titre = "Centre de Notifications & Alertes";
$conn  = getConnexion();

// ---- TRAITEMENT DES ACTIONS RAPIDES (POST) ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alert_id'], $_POST['action_statut'])) {
    $alert_id = (int)$_POST['alert_id'];
    $nouveau_statut = nettoyer($_POST['action_statut']);
    
    if (in_array($nouveau_statut, ['nouvelle', 'lue', 'resolue'])) {
        $stmt = $conn->prepare("UPDATE alertes SET statut = ? WHERE id = ?");
        $stmt->bind_param('si', $nouveau_statut, $alert_id);
        
        if ($stmt->execute()) {
            flashMessage('success', "Le statut de l'alerte a été mis à jour avec succès.");
        } else {
            flashMessage('danger', "Erreur lors de la mise à jour de l'alerte.");
        }
        $stmt->close();
        header("Location: index.php" . (isset($_GET['niveau']) ? "?niveau=" . urlencode($_GET['niveau']) : ""));
        exit();
    }
}

// ---- FILTRAGE DES ALERTES ----
$filtre_niveau = isset($_GET['niveau']) ? nettoyer($_GET['niveau']) : '';

// 1. Récupération des statistiques globales pour les Bento Cards
$stat_total = $conn->query("SELECT COUNT(*) as c FROM alertes")->fetch_assoc()['c'];
$stat_critique = $conn->query("SELECT COUNT(*) as c FROM alertes WHERE niveau = 'critique' AND statut = 'nouvelle'")->fetch_assoc()['c'];
$stat_warning = $conn->query("SELECT COUNT(*) as c FROM alertes WHERE niveau = 'warning' AND statut = 'nouvelle'")->fetch_assoc()['c'];
$stat_resolue = $conn->query("SELECT COUNT(*) as c FROM alertes WHERE statut = 'resolue'")->fetch_assoc()['c'];

// 2. Construction de la requête principale avec jointure cadastrale
$sql = "SELECT a.*, p.reference_cadastrale, p.arrondissement
        FROM alertes a
        LEFT JOIN parcelles p ON a.parcelle_id = p.id
        WHERE 1=1";

if (!empty($filtre_niveau)) {
    $sql .= " AND a.niveau = ?";
}
$sql .= " ORDER BY CASE a.statut WHEN 'nouvelle' THEN 1 WHEN 'lue' THEN 2 ELSE 3 END, a.created_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($filtre_niveau)) {
    $stmt->bind_param('s', $filtre_niveau);
}
$stmt->execute();
$alertes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">

    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1" style="color: var(--md-primary);">Centre de Sécurité & Alertes</h1>
        <p class="text-muted small mb-0">Supervisez les anomalies foncières, les blocages de titres et les notifications automatiques du cadastre.</p>
    </div>

    <?php afficherFlash(); ?>

    <section class="row g-4 mb-4">
        
        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card h-100 border-start border-4 border-danger border-top-0 border-end-0 border-bottom-0 shadow-sm bg-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="fw-semibold text-muted small d-block mb-1">Critiques en attente</span>
                        <h3 class="fw-bold text-danger m-0 fs-2"><?php echo $stat_critique; ?></h3>
                    </div>
                    <div class="icon-box bg-danger bg-opacity-10 text-danger rounded p-2">
                        <span class="material-symbols-outlined fs-4">gavel</span>
                    </div>
                </div>
                <small class="text-muted d-block mt-2">Nécessitent un arbitrage immédiat</small>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card h-100 border-start border-4 border-warning border-top-0 border-end-0 border-bottom-0 shadow-sm bg-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="fw-semibold text-muted small d-block mb-1">Avertissements non lus</span>
                        <h3 class="fw-bold text-warning m-0 fs-2 text-dark"><?php echo $stat_warning; ?></h3>
                    </div>
                    <div class="icon-box bg-warning bg-opacity-10 text-warning rounded p-2">
                        <span class="material-symbols-outlined fs-4">warning</span>
                    </div>
                </div>
                <small class="text-muted d-block mt-2">Vérifications documentaires en suspens</small>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="bento-card h-100 border-start border-4 border-success border-top-0 border-end-0 border-bottom-0 shadow-sm bg-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="fw-semibold text-muted small d-block mb-1">Alertes résolues</span>
                        <h3 class="fw-bold text-success m-0 fs-2"><?php echo $stat_resolue; ?></h3>
                    </div>
                    <div class="icon-box bg-success bg-opacity-10 text-success rounded p-2">
                        <span class="material-symbols-outlined fs-4">check_circle</span>
                    </div>
                </div>
                <small class="text-muted d-block mt-2">Sur un total historique de <?php echo $stat_total; ?> notifications</small>
            </div>
        </div>

    </section>

    <div class="mb-4">
        <div class="btn-group shadow-sm bg-white p-1 rounded-3 border">
            <a href="index.php" class="btn btn-sm px-3 fw-medium <?php echo empty($filtre_niveau) ? 'btn-primary rounded-2 text-white' : 'btn-light border-0 text-muted'; ?>">
                Toutes les alertes
            </a>
            <a href="index.php?niveau=critique" class="btn btn-sm px-3 fw-medium <?php echo $filtre_niveau === 'critique' ? 'btn-danger rounded-2 text-white' : 'btn-light border-0 text-muted'; ?>">
                🔴 Critiques
            </a>
            <a href="index.php?niveau=warning" class="btn btn-sm px-3 fw-medium <?php echo $filtre_niveau === 'warning' ? 'btn-warning rounded-2 text-dark' : 'btn-light border-0 text-muted'; ?>">
                🟡 Avertissements
            </a>
            <a href="index.php?niveau=info" class="btn btn-sm px-3 fw-medium <?php echo $filtre_niveau === 'info' ? 'btn-info rounded-2 text-dark' : 'btn-light border-0 text-muted'; ?>">
                🔵 Informations
            </a>
        </div>
    </div>

    <div class="table-card shadow-sm bg-white">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Niveau</th>
                        <th>Type d'anomalie</th>
                        <th>Message / Justification</th>
                        <th>Parcelle impactée</th>
                        <th>Date de l'événement</th>
                        <th class="text-end">Actions de traitement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($alertes)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <span class="material-symbols-outlined fs-1 opacity-25 mb-2 d-block">notifications_off</span>
                                Aucune alerte enregistrée dans cette catégorie.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($alertes as $a): ?>
                            <tr class="<?php echo $a['statut'] === 'resolu' ? 'opacity-50 bg-light' : ''; ?>">
                                <td class="fw-bold font-monospace text-dark small"><?php echo htmlspecialchars($a['code']); ?></td>
                                <td>
                                    <?php 
                                        $badge_nv = match($a['niveau']) {
                                            'critique' => 'bg-danger text-white',
                                            'warning'  => 'bg-warning text-dark',
                                            'info'     => 'bg-info text-dark',
                                            default    => 'bg-secondary'
                                        };
                                    ?>
                                    <span class="badge <?php echo $badge_nv; ?> rounded-pill px-2.5 py-1.5 fw-normal text-uppercase" style="font-size: 0.7rem;">
                                        <?php echo $a['niveau']; ?>
                                    </span>
                                </td>
                                <td class="fw-semibold small text-dark">
                                    <?php echo ucfirst(str_replace('_', ' ', $a['type'])); ?>
                                </td>
                                <td>
                                    <div class="small text-wrap text-dark lh-base" style="max-width: 400px;">
                                        <?php echo htmlspecialchars($a['message']); ?>
                                    </div>
                                </td>
                                <td class="fw-bold font-monospace text-primary">
                                    <?php if ($a['parcelle_id']): ?>
                                        <a href="/foncier_gloV3/admin/parcelles/show.php?id=<?php echo $a['parcelle_id']; ?>" class="text-decoration-none d-inline-flex align-items-center gap-1">
                                            <span class="material-symbols-outlined fs-6">location_on</span>
                                            <span><?php echo htmlspecialchars($a['reference_cadastrale']); ?></span>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small italic">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted small"><?php echo date('d/m/Y H:i', strtotime($a['created_at'])); ?></td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <?php if ($a['statut'] === 'nouvelle'): ?>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="alert_id" value="<?php echo $a['id']; ?>">
                                                <button type="submit" name="action_statut" value="lue" class="btn btn-sm btn-light border shadow-sm text-primary px-2.5 py-1.5 d-inline-flex align-items-center gap-1" title="Marquer comme lue">
                                                    <span class="material-symbols-outlined fs-6">visibility</span>
                                                    <span class="small fw-medium">Marquer lue</span>
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <?php if ($a['statut'] !== 'resolu'): ?>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="alert_id" value="<?php echo $a['id']; ?>">
                                                <button type="submit" name="action_statut" value="resolue" class="btn btn-sm btn-light border shadow-sm text-success px-2.5 py-1.5 d-inline-flex align-items-center gap-1" title="Résoudre l'anomalie">
                                                    <span class="material-symbols-outlined fs-6">check_circle</span>
                                                    <span class="small fw-medium">Résoudre</span>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-success small fw-semibold d-inline-flex align-items-center gap-1 px-3 py-1 bg-success bg-opacity-10 rounded border border-success border-opacity-10">
                                                <span class="material-symbols-outlined fs-6">verified</span> Classée
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>