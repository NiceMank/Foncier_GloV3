<?php
// consultant/transferts/index.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Sécurité : Vérifier la validité de la session citoyenne
if (!isset($_SESSION['user_id'])) {
    header('Location: /foncier_gloV3/login.php');
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$titre   = "Suivi de mes Transactions";
$conn    = getConnexion();

// Requête préparée pour isoler uniquement les dossiers initiés par ce propriétaire (Cédant)
$sql = "SELECT t.*, p.reference_cadastrale, p.arrondissement, p.village_quartier
        FROM transferts t
        JOIN parcelles p ON t.parcelle_id = p.id
        WHERE t.ancien_proprietaire_id = ?
        ORDER BY t.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$transferts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_consultant.php'; // Charge la Sidebar et la Topbar citoyenne
?>

<div class="container-fluid p-4 p-md-5">

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: var(--md-tertiary);">Mes Demandes de Mutation</h1>
            <p class="text-muted small mb-0">Historique complet et suivi en temps réel de vos cessions de titres fonciers à Glo-Djigbé.</p>
        </div>
        <a href="/foncier_gloV3/consultant/transferts/create.php" class="btn text-white fw-semibold d-flex align-items-center gap-2 shadow-sm" style="background-color: var(--md-tertiary); border-radius: 8px; border: none; padding: 10px 20px;">
            <span class="material-symbols-outlined fs-5">add</span>
            Nouvelle demande de vente
        </a>
    </div>

    <?php afficherFlash(); ?>

    <div class="table-card shadow-sm bg-white border-0 rounded-3">
        <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-white">
            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                <span class="material-symbols-outlined text-secondary">receipt_long</span>
                Registre des transactions
            </h5>
            <span class="badge rounded-pill px-3 py-2 fw-normal" style="background-color: var(--md-tertiary-container); color: var(--md-on-tertiary-container);">
                <?php echo count($transferts); ?> dossier(s) soumis
            </span>
        </div>
        
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Référence Dossier</th>
                        <th>Parcelle cédée</th>
                        <th>Acquéreur (Acheteur)</th>
                        <th>Date de dépôt</th>
                        <th>Statut de l'instruction</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transferts)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <span class="material-symbols-outlined fs-1 opacity-25 mb-2 d-block">shopping_cart</span>
                                Vous n'avez pas encore initié de demande de transfert de propriété en ligne.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($transferts as $t): ?>
                            <tr>
                                <td class="fw-bold text-dark font-monospace small">#<?php echo htmlspecialchars($t['reference']); ?></td>
                                
                                <td>
                                    <span class="fw-bold font-monospace text-primary d-block"><?php echo htmlspecialchars($t['reference_cadastrale']); ?></span>
                                    <small class="text-muted text-truncate d-block" style="max-width: 220px;">
                                        <?php echo htmlspecialchars($t['arrondissement'] . ' — ' . $t['village_quartier']); ?>
                                    </small>
                                </td>
                                
                                <td class="fw-semibold text-dark"><?php echo htmlspecialchars($t['nouveau_prenom'] . ' ' . $t['nouveau_nom']); ?></td>
                                
                                <td class="small text-muted"><?php echo date('d/m/Y', strtotime($t['created_at'])); ?></td>
                                
                                <td>
                                    <?php 
                                        $badge_color = match($t['statut']) {
                                            'en_attente'       => 'bg-warning text-dark',
                                            'en_verification'  => 'bg-info text-dark',
                                            'valide'           => 'bg-success text-white',
                                            'rejete'           => 'bg-danger text-white',
                                            default            => 'bg-secondary text-white'
                                        };
                                        $status_label = match($t['statut']) {
                                            'en_attente'       => '⏳ Soumis / En attente',
                                            'en_verification'  => '🔍 En vérification',
                                            'valide'           => '🟢 Validé / Transféré',
                                            'rejete'           => '🔴 Rejeté par l\'administration',
                                            default            => $t['statut']
                                        };
                                    ?>
                                    <span class="badge <?php echo $badge_color; ?> px-3 py-2 rounded-pill fw-normal" style="font-size: 0.75rem;">
                                        <?php echo $status_label; ?>
                                    </span>
                                </td>
                                
                                <td class="text-end">
                                    <a href="/foncier_gloV3/consultant/transferts/show.php?id=<?php echo $t['id']; ?>" class="btn btn-sm btn-light border text-primary shadow-sm fw-semibold px-3 rounded-3 d-inline-flex align-items-center gap-1">
                                        <span>Suivre</span>
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