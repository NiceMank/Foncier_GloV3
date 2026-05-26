<?php
// admin/litiges/show.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Accessible à tout le staff administratif et technique
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id   = (int)$_GET['id'];
$conn = getConnexion();
$erreur = '';
$role_user = $_SESSION['user_role'] ?? '';

// Récupération complète du litige, de la parcelle, du propriétaire et de l'agent initiateur
$query = "SELECT l.*,
                 p.id AS p_id, p.reference_cadastrale, p.arrondissement, p.village_quartier, p.superficie, p.type_terrain,
                 pr.nom AS prop_nom, pr.prenom AS prop_prenom, pr.telephone AS prop_tel, pr.npi AS prop_npi,
                 u.nom AS agent_nom, u.prenom AS agent_prenom
          FROM litiges l
          LEFT JOIN parcelles p ON l.parcelle_id = p.id
          LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id
          LEFT JOIN users u ON l.agent_id = u.id
          WHERE l.id = ? LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$litige = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$litige) {
    header('Location: index.php');
    exit();
}

// Traitement du changement de statut (Formulaire d'instruction rapide)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nouveau_statut'])) {
    $nouveau_statut = nettoyer($_POST['nouveau_statut']);
    
    if (in_array($nouveau_statut, ['ouvert', 'en_cours', 'resolu', 'ferme'])) {
        $conn->begin_transaction();
        try {
            // 1. Mise à jour du statut du litige
            $stmt_update = $conn->prepare("UPDATE litiges SET statut = ? WHERE id = ?");
            $stmt_update->bind_param('si', $nouveau_statut, $id);
            $stmt_update->execute();
            $stmt_update->close();

            // 2. Si résolu ou fermé -> on libère automatiquement la parcelle vers 'attribue'
            // Si ouvert ou en cours -> on maintient la parcelle bloquée en 'litige'
            $statut_parcelle = in_array($nouveau_statut, ['resolu', 'ferme']) ? 'attribue' : 'litige';
            
            $stmt_parcelle = $conn->prepare("UPDATE parcelles SET statut = ? WHERE id = ?");
            $stmt_parcelle->bind_param('si', $statut_parcelle, $litige['p_id']);
            $stmt_parcelle->execute();
            $stmt_parcelle->close();

            $conn->commit();
            flashMessage('success', "Le statut du dossier a été mis à jour avec succès.");
            header("Location: show.php?id=" . $id);
            exit();

        } catch (Exception $e) {
            $conn->rollback();
            $erreur = "Erreur technique lors du changement d'état : " . $e->getMessage();
        }
    }
}

$titre = "Dossier Contentieux — " . htmlspecialchars($litige['reference']);
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 bento-card border-0 shadow-sm p-4">
        <div>
            <div class="d-flex align-items-center gap-3 mb-1">
                <h2 class="h4 m-0 fw-bold" style="color: var(--md-primary);">Dossier de Litige</h2>
                <?php
                $color = match($litige['statut']) {
                    'ouvert'   => 'bg-danger text-white',
                    'en_cours' => 'bg-warning text-dark',
                    'resolu'   => 'bg-success text-white',
                    'ferme'    => 'bg-secondary text-white',
                    default    => 'bg-secondary'
                };
                ?>
                <span class="badge rounded-pill <?php echo $color; ?> px-3 py-2 fw-medium">
                    <?php echo ucfirst(str_replace('_', ' ', $litige['statut'])); ?>
                </span>
            </div>
            <p class="fs-5 m-0 text-muted font-monospace tracking-wide"><?php echo htmlspecialchars($litige['reference']); ?></p>
        </div>
        
        <div class="d-flex gap-2">
            <a href="index.php" class="btn btn-light border text-muted fw-semibold d-flex align-items-center gap-2 shadow-sm" style="border-radius: 8px;">
                <span class="material-symbols-outlined fs-5">arrow_back</span> Retour
            </a>
            <?php if ($role_user === 'administrateur' || $role_user === 'agent_sade'): ?>
                <a href="/foncier_gloV3/admin/litiges/edit.php?id=<?php echo $id; ?>" class="btn text-white fw-semibold d-flex align-items-center gap-2 shadow-sm" style="background-color: var(--md-primary-container); border-radius: 8px;">
                    <span class="material-symbols-outlined fs-5">edit</span> Modifier la déclaration
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if(!empty($erreur)): ?><div class="alert alert-danger border-0"><?php echo $erreur; ?></div><?php endif; ?>
    <?php afficherFlash(); ?>

    <div class="row g-4">
        
        <div class="col-12 col-lg-8 flex-grow-1">
            <div class="bento-card border-0 shadow-sm mb-4">
                <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-danger">gavel</span>
                    Procès-verbal d'ouverture des faits
                </h5>
                <hr class="text-muted opacity-25">
                <div class="mb-3 mt-3">
                    <small class="text-muted fw-semibold uppercase tracking-wider d-block mb-2" style="font-size: 0.75rem;">Nature du conflit</small>
                    <span class="badge bg-light text-dark border px-3 py-2 fs-6 fw-semibold text-wrap">
                        <?php echo ucfirst(str_replace('_', ' ', $litige['type'])); ?>
                    </span>
                </div>
                <div class="mb-0">
                    <small class="text-muted fw-semibold uppercase tracking-wider d-block mb-2" style="font-size: 0.75rem;">Description détaillée des revendications</small>
                    <div class="bg-light p-3 rounded-3 text-dark border lh-base" style="white-space: pre-line;">
                        <?php echo htmlspecialchars($litige['description']); ?>
                    </div>
                </div>
            </div>

            <div class="bento-card border-0 shadow-sm">
                <h5 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-primary">map</span>
                    Propriété foncière immobilisée
                </h5>
                <div class="row g-3">
                    <div class="col-sm-6 col-md-4">
                        <small class="text-muted d-block">Référence cadastrale</small>
                        <a href="/foncier_gloV3/admin/parcelles/show.php?id=<?php echo $litige['parcelle_id']; ?>" class="fw-bold font-monospace text-decoration-none">
                            <?php echo htmlspecialchars($litige['reference_cadastrale'] ?? 'N/A'); ?>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <small class="text-muted d-block">Superficie</small>
                        <span class="fw-semibold text-dark"><?php echo number_format($litige['superficie'] ?? 0, 2, ',', ' '); ?> m²</span>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <small class="text-muted d-block">Situation</small>
                        <span class="text-dark"><?php echo htmlspecialchars(($litige['arrondissement'] ?? '') . ' - ' . ($litige['village_quartier'] ?? '')); ?></span>
                    </div>
                    <div class="col-12 border-top pt-3 mt-3">
                        <small class="text-muted d-block mb-1">Titulaire actuel inscrit au registre</small>
                        <span class="fw-bold text-dark fs-6">
                            👤 <?php echo htmlspecialchars(($litige['prop_prenom'] ?? '') . ' ' . ($litige['prop_nom'] ?? 'Aucun propriétaire')); ?>
                        </span>
                        <small class="text-muted d-block mt-1 font-monospace">NPI: <?php echo htmlspecialchars($litige['prop_npi'] ?? 'N/A'); ?> | Tel: <?php echo htmlspecialchars($litige['prop_tel'] ?? 'N/A'); ?></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="bento-card border-0 shadow-sm position-sticky" style="top: 100px;">
                <h5 class="fw-bold mb-3 text-dark">Suivi Administratif</h5>
                
                <div class="list-group list-group-flush small mb-4">
                    <div class="list-group-item px-0 py-2 d-flex justify-between">
                        <span class="text-muted">Déclaré par</span>
                        <span class="fw-medium text-dark"><?php echo htmlspecialchars(($litige['agent_prenom'] ?? 'Système') . ' ' . ($litige['agent_nom'] ?? '')); ?></span>
                    </div>
                    <div class="list-group-item px-0 py-2 d-flex justify-between">
                        <span class="text-muted">Date ouverture</span>
                        <span class="text-dark"><?php echo date('d/m/Y H:i', strtotime($litige['created_at'])); ?></span>
                    </div>
                </div>

                <form method="POST" class="border-top pt-3">
                    <label class="form-label small fw-semibold text-muted mb-2">Faire évoluer le statut du litige</label>
                    <div class="mb-3">
                        <select name="nouveau_statut" class="form-select" style="border-radius: 8px;">
                            <option value="ouvert" <?php echo $litige['statut'] === 'ouvert' ? 'selected' : ''; ?>>🔴 Ouvert / Bloqué</option>
                            <option value="en_cours" <?php echo $litige['statut'] === 'en_cours' ? 'selected' : ''; ?>>&nbsp;&nbsp; En cours de médiation</option>
                            <option value="resolu" <?php echo $litige['statut'] === 'resolu' ? 'selected' : ''; ?>>🟢 Résolu (Débloquer le bien)</option>
                            <option value="ferme" <?php echo $litige['statut'] === 'ferme' ? 'selected' : ''; ?>>⚫ Fermé administrativement</option>
                        </select>
                    </div>
                    <button type="submit" class="btn text-white w-100 fw-semibold d-flex align-items-center justify-content-center gap-2" 
                            style="background-color: var(--md-primary); border-radius: 8px;"
                            onclick="return confirm('Voulez-vous modifier l\'état de ce conflit ? Si vous choisissez Résolu ou Fermé, la parcelle sera instantanément débloquée pour les ventes.');">
                        <span class="material-symbols-outlined fs-5">gavel</span>
                        Enregistrer la décision
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>

<?php require_once '../../includes/footer.php'; ?>