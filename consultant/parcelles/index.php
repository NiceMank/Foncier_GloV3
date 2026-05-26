<?php
// consultant/parcelles/index.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Sécurité : Vérifier l'authentification active du consultant propriétaire
if (!isset($_SESSION['user_id'])) {
    header('Location: /foncier_gloV3/login.php');
    exit();
}

// Récupération de l'identifiant unique du citoyen en session
$user_id = (int)$_SESSION['user_id'];
$titre   = "Mon Patrimoine Foncier";
$conn    = getConnexion();

// Capture du filtre de recherche (Topbar ou Mobile)
$filtre_recherche = isset($_GET['recherche']) ? nettoyer($_GET['recherche']) : '';

// Requête préparée isolant uniquement les parcelles du citoyen connecté
$sql = "SELECT * FROM parcelles WHERE proprietaire_id = ?";

$params = [$user_id];
$types  = "i";

// Application dynamique des critères de recherche transversaux
if (!empty($filtre_recherche)) {
    $sql .= " AND (reference_cadastrale LIKE ? OR arrondissement LIKE ? OR village_quartier LIKE ? OR type_terrain LIKE ?)";
    $search_param = "%" . $filtre_recherche . "%";
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= "ssss";
}

$sql .= " ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$parcelles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_consultant.php'; // Injecte la Sidebar et la Topbar du consultant
?>

<div class="container-fluid p-4 p-md-5">

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: var(--md-tertiary);">Mon Patrimoine Foncier</h1>
            <p class="text-muted small mb-0">Consultez l'inventaire officiel, la superficie certifiée et le statut légal de vos parcelles enregistrées.</p>
        </div>
        <a href="/foncier_gloV3/consultant/transferts/create.php" class="btn text-white fw-semibold d-flex align-items-center gap-2 shadow-sm" style="background-color: var(--md-tertiary); border-radius: 8px; border: none; padding: 10px 20px;">
            <span class="material-symbols-outlined fs-5">add_business</span>
            Initier une Demande de Vente
        </a>
    </div>

    <?php afficherFlash(); ?>

    <div class="bento-card mb-4 bg-white shadow-sm border-0 p-3 d-lg-none">
        <form method="GET" action="" class="d-flex gap-2">
            <div class="position-relative flex-grow-1">
                <span class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ms-3 text-muted fs-5">search</span>
                <input type="text" name="recherche" class="form-control ps-5" placeholder="Rechercher une parcelle..." value="<?php echo htmlspecialchars($filtre_recherche); ?>" style="border-radius: 8px;">
            </div>
            <button type="submit" class="btn text-white fw-semibold px-3" style="background-color: var(--md-tertiary); border: none; border-radius: 8px;">
                Filtrer
            </button>
        </form>
    </div>

    <div class="row g-4">
        <?php if (empty($parcelles)): ?>
            <div class="col-12">
                <div class="bento-card text-center py-5 bg-white shadow-sm border-0">
                    <span class="material-symbols-outlined text-muted fs-1 opacity-25 mb-2 d-block">map</span>
                    <h5 class="text-dark fw-bold mb-1">Aucune propriété répertoriée</h5>
                    <p class="text-muted small m-0 px-3">
                        <?php if (!empty($filtre_recherche)): ?>
                            Aucun de vos biens fonciers ne correspond au terme recherché : "<strong><?php echo htmlspecialchars($filtre_recherche); ?></strong>".
                        <?php else: ?>
                            Aucun titre foncier ni parcelle n'est actuellement associé à votre compte de connexion.
                        <?php endif; ?>
                    </p>
                    <?php if (!empty($filtre_recherche)): ?>
                        <a href="/foncier_gloV3/consultant/parcelles/index.php" class="btn btn-sm btn-light border mt-3 fw-semibold px-3 rounded-pill">Réinitialiser les filtres</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($parcelles as $p): ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="bento-card bg-white border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-between">
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                <div>
                                    <small class="text-muted text-uppercase tracking-wider font-label-sm d-block" style="font-size: 0.65rem; letter-spacing: 0.5px;">Référence Cadastrale</small>
                                    <span class="font-monospace fw-bold fs-5 text-dark d-block mt-0.5"><?php echo htmlspecialchars($p['reference_cadastrale']); ?></span>
                                </div>
                                
                                <?php if ($p['statut'] === 'litige'): ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2.5 py-1.5 rounded d-inline-flex align-items-center gap-1 small fw-semibold">
                                        <span class="material-symbols-outlined text-[14px]">warning</span> Gelé / En Litige
                                    </span>
                                <?php elseif ($p['statut'] === 'reserve'): ?>
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2.5 py-1.5 rounded d-inline-flex align-items-center gap-1 small fw-semibold text-dark">
                                        <span class="material-symbols-outlined text-[14px]">lock</span> Réservée State
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2.5 py-1.5 rounded d-inline-flex align-items-center gap-1 small fw-semibold">
                                        <span class="material-symbols-outlined text-[14px]">check_circle</span> Titre Validé
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <hr class="text-muted opacity-10 my-2">
                            
                            <div class="d-flex flex-column gap-2 mt-2">
                                <div class="small text-dark d-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined text-muted fs-6">location_on</span>
                                    <span class="text-truncate fw-medium"><?php echo htmlspecialchars($p['arrondissement'] . ' — ' . $p['village_quartier']); ?></span>
                                </div>
                                <div class="small text-muted d-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined text-muted fs-6">layers</span>
                                    <span>Typologie cadastrale : <?php echo ucfirst(htmlspecialchars($p['type_terrain'])); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3 d-flex justify-content-between align-items-end mt-4">
                            <div>
                                <small class="text-muted d-block font-label-sm mb-0.5" style="font-size: 0.75rem;">Superficie certifiée</small>
                                <span class="fw-bold text-dark fs-5"><?php echo number_format($p['superficie'], 2, ',', ' '); ?> m²</span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="/foncier_gloV3/consultant/parcelles/show.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-light border font-semibold p-2 d-flex align-items-center justify-content-center text-primary" title="Ouvrir la fiche technique" style="width: 38px; height: 38px; border-radius: 8px;">
                                    <span class="material-symbols-outlined fs-5">visibility</span>
                                </a>
                                <?php if ($p['statut'] === 'attribue'): ?>
                                    <a href="/foncier_gloV3/consultant/transferts/create.php?parcelle_id=<?php echo $p['id']; ?>" class="btn btn-sm btn-outline-secondary font-semibold p-2 d-flex align-items-center justify-content-center text-tertiary" title="Initier une vente sur ce bien" style="width: 38px; height: 38px; border-radius: 8px;">
                                        <span class="material-symbols-outlined fs-5">sell</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>