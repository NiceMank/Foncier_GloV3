<?php
// admin/litiges/index.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Sécurité : Accessible à tout le staff (Admin, Agent SADE, Chef de Service)
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

$titre = "Gestion des Litiges";
$conn  = getConnexion();

// Filtrage par statut si fourni
$statut_filtre = isset($_GET['statut']) ? nettoyer($_GET['statut']) : null;

// Récupération des litiges avec jointures pour les détails des parcelles et propriétaires
if ($statut_filtre) {
    $query = "SELECT l.*,
                     p.reference_cadastrale,
                     p.arrondissement,
                     pr.nom AS prop_nom,
                     pr.prenom AS prop_prenom
              FROM litiges l
              LEFT JOIN parcelles p ON l.parcelle_id = p.id
              LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id
              WHERE l.statut = ?
              ORDER BY l.created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $statut_filtre);
    $stmt->execute();
    $litiges = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $query = "SELECT l.*,
                     p.reference_cadastrale,
                     p.arrondissement,
                     pr.nom AS prop_nom,
                     pr.prenom AS prop_prenom
              FROM litiges l
              LEFT JOIN parcelles p ON l.parcelle_id = p.id
              LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id
              ORDER BY l.created_at DESC";
    $litiges = $conn->query($query)->fetch_all(MYSQLI_ASSOC);
}

$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: var(--md-primary);">Gestion des Litiges Fonciers</h1>
            <p class="text-muted small mb-0">Consultez, analysez et suivez la résolution des contentieux du cadastre de Glo-Djigbé.</p>
        </div>
        <?php if ($_SESSION['user_role'] === 'administrateur' || $_SESSION['user_role'] === 'agent_sade'): ?>
            <a href="/foncier_gloV3/admin/litiges/create.php" class="btn text-white fw-semibold d-flex align-items-center gap-2 shadow-sm" style="background-color: var(--md-primary); border-radius: 8px;">
                <span class="material-symbols-outlined fs-5">gavel</span>
                Déclarer un Litige
            </a>
        <?php endif; ?>
    </div>

    <?php afficherFlash(); ?>

    <div class="bento-card mb-4 bg-white shadow-sm">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-4">
                <label class="form-label small fw-semibold text-muted mb-1">Filtrer par état du conflit</label>
                <select class="form-select" style="border-radius: 8px;" onchange="if(this.value) window.location='?statut=' + this.value; else window.location='index.php';">
                    <option value="">-- Tous les statuts --</option>
                    <option value="ouvert" <?php echo $statut_filtre === 'ouvert' ? 'selected' : ''; ?>>🔴 Ouvert (Nouveau / Bloqué)</option>
                    <option value="en_cours" <?php echo $statut_filtre === 'en_cours' ? 'selected' : ''; ?>>🟡 En cours d'instruction</option>
                    <option value="resolu" <?php echo $statut_filtre === 'resolu' ? 'selected' : ''; ?>>🟢 Résolu</option>
                    <option value="ferme" <?php echo $statut_filtre === 'ferme' ? 'selected' : ''; ?>>⚫ Fermé</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-card shadow-sm bg-white mb-4">
        <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-white">
            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                <span class="material-symbols-outlined text-danger">warning</span>
                Dossiers Contentieux
            </h5>
            <span class="badge rounded-pill px-3 py-2 fw-normal" style="background-color: var(--md-error-container); color: var(--md-on-error-container);">
                <?php echo count($litiges); ?> dossier(s) actif(s)
            </span>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Type de Contentieux</th>
                        <th>Parcelle impactée</th>
                        <th>Propriétaire impliqué</th>
                        <th>Date Déclaration</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($litiges)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <span class="material-symbols-outlined fs-1 mb-2 opacity-25 d-block">folder_open</span>
                                Aucun dossier de litige répertorié dans cette catégorie.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($litiges as $l): ?>
                            <tr>
                                <td class="fw-bold text-dark font-monospace"><?php echo htmlspecialchars($l['reference']); ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2.5 py-1.5 fw-medium">
                                        <?php echo ucfirst(str_replace('_', ' ', $l['type'])); ?>
                                    </span>
                                </td>
                                <td class="fw-semibold text-primary font-monospace">
                                    <?php if ($l['reference_cadastrale']): ?>
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <span class="material-symbols-outlined text-muted fs-6">location_on</span>
                                            <span><?php echo htmlspecialchars($l['reference_cadastrale']); ?></span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small italic">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-medium text-dark">
                                    <?php if ($l['prop_nom']): ?>
                                        <?php echo htmlspecialchars($l['prop_prenom'] . ' ' . $l['prop_nom']); ?>
                                    <?php else: ?>
                                        <span class="text-muted small italic">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted small"><?php echo date('d/m/Y', strtotime($l['created_at'])); ?></td>
                                <td>
                                    <?php
                                    $color = match($l['statut']) {
                                        'ouvert'   => 'bg-danger text-white',
                                        'en_cours' => 'bg-warning text-dark',
                                        'resolu'   => 'bg-success text-white',
                                        'ferme'    => 'bg-secondary text-white',
                                        default    => 'bg-secondary'
                                    };
                                    ?>
                                    <span class="badge <?php echo $color; ?> px-3 py-2 rounded-pill fw-normal">
                                        <?php echo ucfirst(str_replace('_', ' ', $l['statut'])); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="/foncier_gloV3/admin/parcelles/show.php?id=<?php echo $l['parcelle_id']; ?>" class="btn btn-sm btn-light text-primary border shadow-sm" title="Consulter la fiche parcelle">
                                            <span class="material-symbols-outlined fs-6 align-middle">visibility</span>
                                        </a>
                                        <?php if ($_SESSION['user_role'] === 'administrateur' || $_SESSION['user_role'] === 'agent_sade'): ?>
                                            <a href="/foncier_gloV3/admin/litiges/edit.php?id=<?php echo $l['id']; ?>" class="btn btn-sm btn-light text-warning border shadow-sm" title="Modifier l'état du litige">
                                                <span class="material-symbols-outlined fs-6 align-middle">edit</span>
                                            </a>
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