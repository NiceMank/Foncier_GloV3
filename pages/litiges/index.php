<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

$titre = "Gestion des Litiges";
$conn  = getConnexion();

// Filtrage par statut si fourni
$statut_filtre = isset($_GET['statut']) ? $_GET['statut'] : null;

// Récupération des litiges
if ($statut_filtre) {
    $query = "SELECT l.*,
                     p.reference_cadastrale,
                     p.arrondissement,
                     pr.nom AS prop_nom,
                     pr.prenom AS prop_prenom,
                     u.nom AS agent_nom,
                     u.prenom AS agent_prenom
              FROM litiges l
              LEFT JOIN parcelles p ON l.parcelle_id = p.id
              LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id
              LEFT JOIN users u ON l.agent_id = u.id
              WHERE l.statut = ?
              ORDER BY l.created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $statut_filtre);
    $stmt->execute();
    $litiges = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    $query = "SELECT l.*,
                     p.reference_cadastrale,
                     p.arrondissement,
                     pr.nom AS prop_nom,
                     pr.prenom AS prop_prenom,
                     u.nom AS agent_nom,
                     u.prenom AS agent_prenom
              FROM litiges l
              LEFT JOIN parcelles p ON l.parcelle_id = p.id
              LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id
              LEFT JOIN users u ON l.agent_id = u.id
              ORDER BY l.created_at DESC";
    $litiges = $conn->query($query)->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
?>

<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<main>
<div class="container-fluid py-4">

    <div class="dash-hero">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="fw-bold mb-1">
                    <span class="material-symbols-outlined me-2" style="vertical-align: middle;">gavel</span>Gestion des Litiges
                </h3>
                <p class="mb-0 opacity-75">
                    Consultez et gérez les litiges fonciers déclarés dans la commune.
                </p>
            </div>
            <div class="col-md-4 text-md-end text-start mt-3 mt-md-0">
                <a href="/foncier_gloV3/pages/litiges/create.php" class="btn btn-light text-teal fw-semibold rounded-pill px-4 shadow-sm" style="color: var(--primary);">
                    <i class="fas fa-plus me-2"></i>Déclarer un Litige
                </a>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-3">
        <div class="card-header">
            <strong>Filtres</strong>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <select class="form-select" onchange="if(this.value) window.location='?statut=' + this.value; else window.location='index.php';">
                        <option value="">-- Tous les statuts --</option>
                        <option value="ouvert" <?php echo $statut_filtre === 'ouvert' ? 'selected' : ''; ?>>Ouvert</option>
                        <option value="en_cours" <?php echo $statut_filtre === 'en_cours' ? 'selected' : ''; ?>>En cours</option>
                        <option value="resolu" <?php echo $statut_filtre === 'resolu' ? 'selected' : ''; ?>>Résolu</option>
                        <option value="ferme" <?php echo $statut_filtre === 'ferme' ? 'selected' : ''; ?>>Fermé</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card table-card">
        <div class="card-header bg-stat-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold"><span class="material-symbols-outlined me-2 text-danger" style="vertical-align: middle;">warning</span>Liste des Litiges</span>
            <span class="badge bg-danger rounded-pill"><?php echo count($litiges); ?> litige<?php echo count($litiges) > 1 ? 's' : ''; ?></span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Type</th>
                            <th>Parcelle</th>
                            <th>Propriétaire</th>
                            <th>Statut</th>
                            <th>Date de Déclaration</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($litiges)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <span class="material-symbols-outlined fa-3x mb-3 d-block" style="font-size: 3rem;">folder_open</span>
                                Aucun litige enregistré.
                            </td>
                        </tr>
                    <?php else: ?>
                    <?php foreach ($litiges as $l): ?>
                        <tr>
                            <td class="fw-semibold text-dark">
                                <?php echo htmlspecialchars($l['reference']); ?>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    <?php echo ucfirst(str_replace('_', ' ', $l['type'])); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($l['reference_cadastrale']): ?>
                                    <span class="material-symbols-outlined text-primary me-1" style="vertical-align: middle; font-size: 1rem;">location_on</span>
                                    <?php echo htmlspecialchars($l['reference_cadastrale']); ?>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($l['prop_nom']): ?>
                                    <?php echo htmlspecialchars($l['prop_nom'] . ' ' . $l['prop_prenom']); ?>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $statut_badges = [
                                    'ouvert' => 'danger',
                                    'en_cours' => 'warning',
                                    'resolu' => 'success',
                                    'ferme' => 'secondary'
                                ];
                                $color = $statut_badges[$l['statut']] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?php echo $color; ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $l['statut'])); ?>
                                </span>
                            </td>
                            <td>
                                <?php echo date('d/m/Y', strtotime($l['created_at'])); ?>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="show.php?id=<?php echo $l['id']; ?>" class="btn btn-outline-primary" title="Voir">
                                        <span class="material-symbols-outlined" style="font-size: 1rem;">visibility</span>
                                    </a>
                                    <a href="edit.php?id=<?php echo $l['id']; ?>" class="btn btn-outline-warning" title="Modifier">
                                        <span class="material-symbols-outlined" style="font-size: 1rem;">edit</span>
                                    </a>
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

</div>
</main>

<?php require_once '../../includes/footer.php'; ?>
