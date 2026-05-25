<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

$titre = "Gestion des Parcelles";
$conn  = getConnexion();

// Récupération de l'ensemble des parcelles avec jointure propriétaire
$query = "SELECT p.*, pr.nom, pr.prenom 
          FROM parcelles p
          LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id
          ORDER BY p.reference_cadastrale ASC";
$parcelles = $conn->query($query)->fetch_all(MYSQLI_ASSOC);

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
                    <span class="material-symbols-outlined me-2" style="vertical-align: middle;">layers</span>Gestion des Parcelles
                </h3>
                <p class="mb-0 opacity-75">
                    Consultez, recherchez et gérez l'ensemble du registre parcellaire de la commune de Glo.
                </p>
            </div>
            <div class="col-md-4 text-md-end text-start mt-3 mt-md-0">
                <a href="/foncier_gloV3/pages/parcelles/create.php" class="btn btn-light text-teal fw-semibold rounded-pill px-4 shadow-sm" style="color: var(--primary);">
                    <i class="fas fa-plus me-2"></i>Nouvelle Parcelle
                </a>
            </div>
        </div>
    </div>

    <div class="card table-card">
        <div class="card-header bg-stat-1 d-flex justify-content-between align-items-center">
            <span class="fw-bold"><span class="material-symbols-outlined me-2 text-primary" style="vertical-align: middle;">view_list</span>Registre Cadastral</span>
            <span class="badge bg-primary rounded-pill"><?php echo count($parcelles); ?> parcelles</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Référence Cadastrale</th>
                            <th>Superficie</th>
                            <th>Propriétaire</th>
                            <th>Statut</th>
                            <th>Date d'Enregistrement</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($parcelles)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3 d-block text-slate-300"></i>
                                Aucune parcelle enregistrée dans le système.
                            </td>
                        </tr>
                    <?php else: ?>
                    <?php foreach ($parcelles as $p): ?>
                        <tr>
                            <td class="fw-semibold text-dark">
                                <span class="material-symbols-outlined text-primary me-2" style="vertical-align: middle;">location_on</span>
                                <?php echo htmlspecialchars($p['reference_cadastrale']); ?>
                            </td>
                            <td>
                                <?php echo isset($p['superficie']) ? number_format($p['superficie'], 0, ',', ' ') . ' m²' : '—'; ?>
                            </td>
                            <td>
                                <?php if ($p['nom']): ?>
                                    <span class="material-symbols-outlined text-muted me-2" style="vertical-align: middle;">person</span>
                                    <?php echo htmlspecialchars($p['prenom'] . ' ' . $p['nom']); ?>
                                <?php else: ?>
                                    <span class="text-muted small"><em>— Non attribuée</em></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $c = match($p['statut']) {
                                    'libre'    => 'success',
                                    'attribue' => 'primary',
                                    'litige'   => 'danger',
                                    'reserve'  => 'warning',
                                    default    => 'secondary'
                                };
                                ?>
                                <span class="badge bg-<?php echo $c; ?> badge-status">
                                    <?php echo ucfirst(htmlspecialchars($p['statut'])); ?>
                                </span>
                            </td>
                            <td class="text-muted small">
                                <?php echo date('d/m/Y', strtotime($p['created_at'])); ?>
                            </td>
                            <td class="text-end">
                                <div class="btn-group shadow-sm" role="group">
                                    <a href="/foncier_gloV3/pages/parcelles/show.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-light border" title="Voir">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </a>
                                    <a href="/foncier_gloV3/pages/parcelles/edit.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-light border" title="Modifier">
                                        <span class="material-symbols-outlined text-primary">edit</span>
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