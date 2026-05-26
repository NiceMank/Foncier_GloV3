<?php
// admin/transferts/index.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Sécurité : Seuls le Chef de Service et l'Agent SADE ont accès aux transferts
requiertRole(['agent_sade', 'chef_service']);

$titre = "Suivi des Transferts";
$role_user = $_SESSION['user_role'] ?? '';
$conn = getConnexion();

$filtre_statut = isset($_GET['statut']) ? nettoyer($_GET['statut']) : '';

// Requête SQL de base
$sql = "SELECT t.*, 
               p.reference_cadastrale, 
               pr.nom AS ancien_nom, pr.prenom AS ancien_prenom
        FROM transferts t
        JOIN parcelles p ON t.parcelle_id = p.id
        JOIN proprietaires pr ON t.ancien_proprietaire_id = pr.id";

// Logique de filtrage stricte selon le rôle
if ($role_user === 'chef_service') {
    // Le Chef de Service ne voit QUE les dossiers transmis par l'agent ou déjà traités
    $sql .= " WHERE t.statut IN ('en_verification', 'valide', 'rejete') ";
    if (!empty($filtre_statut)) {
        $sql .= " AND t.statut = ? ";
    }
} else {
    // L'agent voit l'intégralité du flux d'entrée citoyen
    if (!empty($filtre_statut)) {
        $sql .= " WHERE t.statut = ? ";
    }
}

$sql .= " ORDER BY t.updated_at DESC, t.created_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($filtre_statut)) {
    $stmt->bind_param('s', $filtre_statut);
}
$stmt->execute();
$transferts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: var(--md-primary);">Demandes de Mutations</h1>
            <p class="text-muted small mb-0">
                <?php echo $role_user === 'chef_service' ? 'Dossiers fonciers transmis par les agents pour validation finale.' : 'Analyse et traitement des actes de ventes citoyens.'; ?>
            </p>
        </div>
    </div>

    <?php afficherFlash(); ?>

    <div class="mb-4">
        <div class="btn-group shadow-sm bg-white p-1 rounded-3 border">
            <a href="index.php" class="btn btn-sm px-3 fw-medium <?php echo empty($filtre_statut) ? 'btn-primary rounded-2 text-white' : 'btn-light border-0 text-muted'; ?>">
                Vue Générale
            </a>
            <?php if ($role_user === 'agent_sade'): ?>
                <a href="index.php?statut=en_attente" class="btn btn-sm px-3 fw-medium <?php echo $filtre_statut === 'en_attente' ? 'btn-warning rounded-2 text-dark' : 'btn-light border-0 text-muted'; ?>">
                    À analyser (Nouveau)
                </a>
            <?php endif; ?>
            <a href="index.php?statut=en_verification" class="btn btn-sm px-3 fw-medium <?php echo $filtre_statut === 'en_verification' ? 'btn-info rounded-2 text-dark' : 'btn-light border-0 text-muted'; ?>">
                En arbitrage Chef
            </a>
            <a href="index.php?statut=valide" class="btn btn-sm px-3 fw-medium <?php echo $filtre_statut === 'valide' ? 'btn-success rounded-2 text-white' : 'btn-light border-0 text-muted'; ?>">
                Validés
            </a>
        </div>
    </div>

    <div class="table-card shadow-sm bg-white">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Référence Dossier</th>
                        <th>Parcelle</th>
                        <th>Cédant (Vendeur)</th>
                        <th>Acquéreur (Acheteur)</th>
                        <th>Date de dépôt</th>
                        <th>Statut</th>
                        <th class="text-end">Instruction</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transferts)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <span class="material-symbols-outlined fs-1 opacity-25 mb-2 d-block">folder_open</span>
                                Aucun dossier de transfert en attente pour votre profil.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($transferts as $t): ?>
                            <tr>
                                <td class="fw-bold text-dark font-monospace"><?php echo htmlspecialchars($t['reference']); ?></td>
                                <td class="fw-semibold text-primary"><?php echo htmlspecialchars($t['reference_cadastrale']); ?></td>
                                <td><?php echo htmlspecialchars($t['ancien_prenom'] . ' ' . $t['ancien_nom']); ?></td>
                                <td><span class="fw-medium text-dark"><?php echo htmlspecialchars($t['nouveau_prenom'] . ' ' . $t['nouveau_nom']); ?></span></td>
                                <td class="small text-muted"><?php echo date('d/m/Y', strtotime($t['created_at'])); ?></td>
                                <td>
                                    <?php 
                                        $badge = match($t['statut']) {
                                            'en_attente' => 'bg-warning text-dark',
                                            'en_verification' => 'bg-info text-dark',
                                            'valide' => 'bg-success text-white',
                                            'rejete' => 'bg-danger text-white',
                                            default => 'bg-secondary'
                                        };
                                        $label = match($t['statut']) {
                                            'en_attente' => 'En attente',
                                            'en_verification' => 'Soumis au Chef',
                                            'valide' => 'Approuvé',
                                            'rejete' => 'Rejeté',
                                            default => $t['statut']
                                        };
                                    ?>
                                    <span class="badge <?php echo $badge; ?> px-3 py-2 rounded-pill fw-normal">
                                        <?php echo $label; ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/foncier_gloV3/admin/transferts/show.php?id=<?php echo $t['id']; ?>" class="btn btn-sm btn-light border text-primary shadow-sm fw-semibold px-3 d-inline-flex align-items-center gap-1">
                                        <span>Traiter</span>
                                        <span class="material-symbols-outlined fs-6">chevron_right</span>
                                    </a>
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