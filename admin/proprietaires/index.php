<?php
// admin/proprietaires/index.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Vérification de l'accès (Admin, Agent SADE, Chef de Service)
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

$titre = "Annuaire des Propriétaires";
$role_user = $_SESSION['user_role'] ?? '';
$conn = getConnexion();

$filtre_recherche = isset($_GET['recherche']) ? nettoyer($_GET['recherche']) : '';

// Requête SQL : Récupère les propriétaires et compte leurs parcelles
$sql = "SELECT pr.*, COUNT(p.id) AS total_parcelles 
        FROM proprietaires pr 
        LEFT JOIN parcelles p ON pr.id = p.proprietaire_id ";

$params = [];
$types = "";

if (!empty($filtre_recherche)) {
    $sql .= " WHERE pr.nom LIKE ? OR pr.prenom LIKE ? OR pr.npi LIKE ? OR pr.telephone LIKE ?";
    $search_param = "%" . $filtre_recherche . "%";
    // 4 paramètres pour la recherche
    $params = array_fill(0, 4, $search_param);
    $types = "ssss";
}

$sql .= " GROUP BY pr.id ORDER BY pr.created_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$proprietaires = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: var(--md-primary);">Annuaire des Propriétaires</h1>
            <p class="text-muted small mb-0">Gestion centralisée des titulaires fonciers et de leurs accès Consultant.</p>
        </div>
        <?php if ($role_user === 'agent_sade'): ?>
            <a href="/foncier_gloV3/admin/proprietaires/create.php" class="btn d-flex align-items-center gap-2 fw-semibold shadow-sm text-white" style="background-color: var(--md-primary); border-radius: 8px;">
                <span class="material-symbols-outlined fs-5">person_add</span>
                Nouveau Propriétaire
            </a>
        <?php endif; ?>
    </div>

    <?php afficherFlash(); ?>

    <div class="bento-card mb-4 bg-white shadow-sm">
        <form method="GET" action="" class="row g-3 align-items-end">
            <div class="col-12 col-md-9">
                <label for="recherche" class="form-label small fw-semibold text-muted">Rechercher un propriétaire</label>
                <div class="position-relative">
                    <input type="text" name="recherche" id="recherche" class="form-control ps-5" placeholder="Nom, Prénom, NPI/IFU ou Téléphone..." value="<?php echo htmlspecialchars($filtre_recherche); ?>" style="border-radius: 8px;">
                    <span class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ms-3 text-muted fs-5">search</span>
                </div>
            </div>
            
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn text-white w-100 fw-semibold d-flex align-items-center justify-content-center gap-2" style="background-color: var(--md-secondary); border: none; border-radius: 8px;">
                    Rechercher
                </button>
                <?php if (!empty($filtre_recherche)): ?>
                    <a href="/foncier_gloV3/admin/proprietaires/index.php" class="btn btn-light border" title="Réinitialiser" style="border-radius: 8px;">
                        <span class="material-symbols-outlined fs-5 align-middle">close</span>
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="table-card shadow-sm bg-white mb-4">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nom & Prénom</th>
                        <th>NPI / IFU</th>
                        <th>Contact</th>
                        <th class="text-center">Parcelles</th>
                        <th>Compte Consultant</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($proprietaires)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Aucun propriétaire ne correspond à vos critères.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($proprietaires as $prop): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-mini bg-light text-primary fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <?php echo strtoupper(substr($prop['prenom'] ?? '', 0, 1) . substr($prop['nom'] ?? '', 0, 1)); ?>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block"><?php echo htmlspecialchars(($prop['prenom'] ?? '') . ' ' . ($prop['nom'] ?? '')); ?></span>
                                            <small class="text-muted">Inscrit le <?php echo date('d/m/Y', strtotime($prop['created_at'])); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="font-monospace text-muted"><?php echo htmlspecialchars($prop['npi'] ?? 'Non renseigné'); ?></td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark"><?php echo htmlspecialchars($prop['telephone'] ?? ''); ?></span>
                                        <?php if (!empty($prop['email_connexion'])): ?>
                                            <small class="text-muted"><?php echo htmlspecialchars($prop['email_connexion']); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill fw-medium" style="background-color: var(--md-primary-fixed-dim); color: var(--md-on-primary-fixed);">
                                        <?php echo $prop['total_parcelles']; ?> parcelle(s)
                                    </span>
                                </td>
                                <td>
                                    <?php if (isset($prop['compte_actif']) && $prop['compte_actif'] === 'oui'): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill">
                                            Actif
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2 rounded-pill text-dark">
                                            Non activé
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="/foncier_gloV3/admin/proprietaires/show.php?id=<?php echo $prop['id']; ?>" class="btn btn-sm btn-light text-primary border shadow-sm" title="Voir la fiche">
                                            <span class="material-symbols-outlined fs-6 align-middle">visibility</span>
                                        </a>
                                        
                                        <?php if ($role_user === 'agent_sade'): ?>
                                            <a href="/foncier_gloV3/admin/proprietaires/edit.php?id=<?php echo $prop['id']; ?>" class="btn btn-sm btn-light text-warning border shadow-sm" title="Modifier">
                                                <span class="material-symbols-outlined fs-6 align-middle">edit</span>
                                            </a>
                                            <a href="/foncier_gloV3/admin/proprietaires/delete.php?id=<?php echo $prop['id']; ?>" class="btn btn-sm btn-light text-danger border shadow-sm" onclick="return confirm('Supprimer définitivement ce propriétaire ? (Impossible s\'il possède encore des terres)');" title="Supprimer">
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