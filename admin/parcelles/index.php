<?php
// admin/parcelles/index.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Accessible à tous les rôles pour la consultation
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

$titre = "Gestion des Parcelles";
$role_user = $_SESSION['user_role'] ?? '';
$conn = getConnexion();

$filtre_statut = isset($_GET['statut']) ? nettoyer($_GET['statut']) : '';
$filtre_recherche = isset($_GET['recherche']) ? nettoyer($_GET['recherche']) : '';

$sql = "SELECT p.*, pr.nom AS prop_nom, pr.prenom AS prop_prenom 
        FROM parcelles p 
        LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id 
        WHERE 1=1";

$params = [];
$types = "";

if (!empty($filtre_statut)) {
    $sql .= " AND p.statut = ?";
    $params[] = $filtre_statut;
    $types .= "s";
}

if (!empty($filtre_recherche)) {
    $sql .= " AND (p.reference_cadastrale LIKE ? OR p.arrondissement LIKE ? OR p.village_quartier LIKE ? OR pr.nom LIKE ?)";
    $search_param = "%" . $filtre_recherche . "%";
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= "ssss";
}

$sql .= " ORDER BY p.created_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$parcelles = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: var(--md-primary);">Registre des Parcelles</h1>
            <p class="text-muted small mb-0">Visualisation et suivi des données foncières de Glo-Djigbé.</p>
        </div>
        <?php if ($role_user === 'agent_sade'): ?>
            <a href="/foncier_gloV3/admin/parcelles/create.php" class="btn d-flex align-items-center gap-2 fw-semibold shadow-sm text-white" style="background-color: var(--md-primary); border-radius: 8px;">
                <span class="material-symbols-outlined fs-5">add_map</span> Enregistrer une parcelle
            </a>
        <?php endif; ?>
    </div>

    <?php afficherFlash(); ?>

    <div class="bento-card mb-4 bg-white shadow-sm">
        <form method="GET" action="" class="row g-3 align-items-end">
            <div class="col-12 col-md-5">
                <label for="recherche" class="form-label small fw-semibold text-muted">Rechercher</label>
                <div class="position-relative">
                    <input type="text" name="recherche" id="recherche" class="form-control ps-5" placeholder="Référence, quartier, propriétaire..." value="<?php echo htmlspecialchars($filtre_recherche); ?>" style="border-radius: 8px;">
                    <span class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ms-3 text-muted fs-5">search</span>
                </div>
            </div>
            
            <div class="col-12 col-md-4">
                <label for="statut" class="form-label small fw-semibold text-muted">Statut Cadastral</label>
                <select name="statut" id="statut" class="form-select" style="border-radius: 8px;">
                    <option value="">Tous les statuts</option>
                    <option value="attribue" <?php echo $filtre_statut === 'attribue' ? 'selected' : ''; ?>>Attribuée</option>
                    <option value="litige" <?php echo $filtre_statut === 'litige' ? 'selected' : ''; ?>>En litige</option>
                    <option value="reserve" <?php echo $filtre_statut === 'reserve' ? 'selected' : ''; ?>>Réservée</option>
                </select>
            </div>

            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100 fw-semibold text-white d-flex align-items-center justify-content-center gap-2" style="background-color: var(--md-secondary); border: none; border-radius: 8px;">
                    <span class="material-symbols-outlined fs-5">filter_alt</span> Filtrer
                </button>
                <?php if (!empty($filtre_statut) || !empty($filtre_recherche)): ?>
                    <a href="/foncier_gloV3/admin/parcelles/index.php" class="btn btn-light border" style="border-radius: 8px;">
                        <span class="material-symbols-outlined fs-5 align-middle">close</span>
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="table-card shadow-sm bg-white">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Référence cadastrale</th>
                        <th>Superficie (m²)</th>
                        <th>Localisation / Quartier</th>
                        <th>Propriétaire actuel</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($parcelles)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Aucune parcelle trouvée.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($parcelles as $parcelle): ?>
                            <tr>
                                <td class="fw-bold text-dark"><?php echo htmlspecialchars($parcelle['reference_cadastrale']); ?></td>
                                <td><?php echo number_format($parcelle['superficie'], 2, ',', ' '); ?> m²</td>
                                <td>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <span class="material-symbols-outlined fs-6">location_on</span>
                                        <span><?php echo htmlspecialchars($parcelle['arrondissement'] . ' - ' . $parcelle['village_quartier']); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-medium text-dark">
                                        <?php echo htmlspecialchars($parcelle['prop_prenom'] . ' ' . $parcelle['prop_nom']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                        $badge = match($parcelle['statut']) {
                                            'attribue' => 'bg-primary',
                                            'litige'   => 'bg-danger',
                                            'reserve'  => 'bg-warning text-dark',
                                            default    => 'bg-secondary'
                                        };
                                        $texte_statut = match($parcelle['statut']) {
                                            'attribue' => 'Attribuée',
                                            'litige'   => 'En litige',
                                            'reserve'  => 'Réservée',
                                            default    => ucfirst($parcelle['statut'])
                                        };
                                    ?>
                                    <span class="badge <?php echo $badge; ?> px-3 py-2 rounded-pill fw-normal">
                                        <?php echo $texte_statut; ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="/foncier_gloV3/admin/parcelles/show.php?id=<?php echo $parcelle['id']; ?>" class="btn btn-sm btn-light text-primary border shadow-sm" title="Voir les détails">
                                            <span class="material-symbols-outlined fs-6 align-middle">visibility</span>
                                        </a>

                                        <?php if ($role_user === 'agent_sade'): ?>
                                            <a href="/foncier_gloV3/admin/parcelles/edit.php?id=<?php echo $parcelle['id']; ?>" class="btn btn-sm btn-light text-warning border shadow-sm" title="Modifier">
                                                <span class="material-symbols-outlined fs-6 align-middle">edit</span>
                                            </a>
                                            
                                            <a href="/foncier_gloV3/admin/parcelles/delete.php?id=<?php echo $parcelle['id']; ?>" class="btn btn-sm btn-light text-danger border shadow-sm" onclick="return confirm('Supprimer définitivement cette parcelle ?');" title="Supprimer">
                                                <span class="material-symbols-outlined fs-6 align-middle">delete</span>
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