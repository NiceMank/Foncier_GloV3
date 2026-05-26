<?php
// consultant/transferts/show.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Sécurité : Vérifier que l'usager est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: /foncier_gloV3/login.php');
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$transfert_id = (int)$_GET['id'];
$user_id      = (int)$_SESSION['user_id'];
$conn         = getConnexion();

// Récupération sécurisée du dossier (jointure cadastrale, filtrage strict sur le propriétaire connecté)
$sql = "SELECT t.*, p.reference_cadastrale, p.arrondissement, p.village_quartier
        FROM transferts t
        JOIN parcelles p ON t.parcelle_id = p.id
        WHERE t.id = ? AND t.ancien_proprietaire_id = ? LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $transfert_id, $user_id);
$stmt->execute();
$t = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Si le dossier n'existe pas ou n'appartient pas à ce citoyen, redirection de sécurité
if (!$t) {
    $conn->close();
    header('Location: index.php');
    exit();
}

$conn->close();
$titre = "Suivi de Transaction — " . htmlspecialchars($t['reference']);

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_consultant.php'; // Charge la Sidebar et la Topbar du propriétaire
?>

<div class="container-fluid p-4 p-md-5">

    <div class="d-none d-md-block mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="/foncier_gloV3/consultant/dashboard.php" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="/foncier_gloV3/consultant/transferts/index.php" class="text-decoration-none">Demandes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dossier <?php echo htmlspecialchars($t['reference']); ?></li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold mb-1" style="color: var(--md-tertiary);">Suivi de la Demande</h1>
        <p class="text-muted small">État d'avancement de votre dossier de cession immobilière numéro : <strong class="text-dark">#<?php echo htmlspecialchars($t['reference']); ?></strong>.</p>
    </div>

    <?php afficherFlash(); ?>

    <div class="row g-4">
        
        <div class="col-12 col-xl-4 flex-column d-flex gap-3">
            <div class="bento-card bg-white border-0 shadow-sm p-4 relative overflow-hidden">
                <div class="position-absolute top-0 start-0 w-100 bg-primary" style="height: 4px;"></div>
                
                <div class="d-flex justify-content-between align-items-center mb-4 mt-1">
                    <h2 class="h5 fw-bold text-dark m-0">Résumé</h2>
                    <span class="material-symbols-outlined text-primary fs-4">receipt_long</span>
                </div>

                <div class="d-flex flex-column gap-3">
                    <div>
                        <small class="text-muted font-label-sm d-block mb-1" style="font-size: 0.75rem;">Référence unique</small>
                        <span class="fw-bold font-monospace text-dark fs-6"><?php echo htmlspecialchars($t['reference']); ?></span>
                    </div>
                    <hr class="text-muted opacity-10 my-1">

                    <div>
                        <small class="text-muted font-label-sm d-block mb-1" style="font-size: 0.75rem;">Parcelle concernée</small>
                        <span class="fw-bold text-dark font-monospace d-inline-flex align-items-center gap-2">
                            <?php echo htmlspecialchars($t['reference_cadastrale']); ?>
                            <span class="material-symbols-outlined text-primary fs-6">map</span>
                        </span>
                        <small class="text-muted d-block mt-1"><?php echo htmlspecialchars($t['arrondissement'] . ' — ' . $t['village_quartier']); ?></small>
                    </div>
                    <hr class="text-muted opacity-10 my-1">

                    <div>
                        <small class="text-muted font-label-sm d-block mb-1" style="font-size: 0.75rem;">Acquéreur (Bénéficiaire)</small>
                        <span class="fw-semibold text-dark d-block mb-1"><?php echo htmlspecialchars($t['nouveau_prenom'] . ' ' . $t['nouveau_nom']); ?></span>
                        <small class="text-muted font-monospace d-block" style="font-size: 0.75rem;">NPI: <?php echo htmlspecialchars($t['nouveau_npi']); ?></small>
                    </div>
                    <hr class="text-muted opacity-10 my-1">

                    <div>
                        <small class="text-muted font-label-sm d-block mb-1" style="font-size: 0.75rem;">Date de dépôt</small>
                        <span class="text-dark small fw-medium"><?php echo date('d M Y à H:i', strtotime($t['created_at'])); ?></span>
                    </div>
                </div>
            </div>

            <a href="/foncier_gloV3/assets/uploads/transferts/<?php echo htmlspecialchars($t['document_preuve']); ?>" target="_blank" class="btn btn-white border font-semibold w-100 py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 text-primary bg-white shadow-sm">
                <span class="material-symbols-outlined fs-5">download</span>
                Consulter l'acte téléversé
            </a>
        </div>

        <div class="col-12 col-xl-8">
            <div class="bento-card bg-white border-0 shadow-sm p-4 p-md-5">
                
                <?php
                $statut = $t['statut'];
                // Mappage logique
                $st1_complete = true; // Demande toujours soumise
                
                $st2_active   = ($statut === 'en_attente');
                $st2_complete = ($statut === 'en_verification' || $statut === 'valide' || $statut === 'rejete');
                
                $st3_active   = ($statut === 'en_verification');
                $st3_complete = ($statut === 'valide');
                
                $st4_complete = ($statut === 'valide');
                $st4_failed   = ($statut === 'rejete');
                ?>

                <div class="position-relative ps-4 ms-2 border-start border-2 border-light-subtle space-y-5">
                    
                    <div class="position-relative mb-5">
                        <div class="position-absolute rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm" 
                             style="width: 32px; height: 32px; left: -41px; top: 0; background-color: #10B981; z-index: 10;">
                            <span class="material-symbols-outlined text-[16px] fw-bold">check</span>
                        </div>
                        <div class="d-flex flex-column">
                            <h3 class="h6 fw-bold text-dark m-0">Demande Soumise</h3>
                            <p class="text-muted small m-0 mt-1">Votre dossier numérique a été reçu avec succès par la plateforme cadastrale.</p>
                            <small class="text-muted mt-2 font-monospace" style="font-size: 0.7rem;"><?php echo date('d/m/Y à H:i', strtotime($t['created_at'])); ?></small>
                        </div>
                    </div>

                    <div class="position-relative mb-5 <?php echo (!$st2_active && !$st2_complete) ? 'opacity-50' : ''; ?>">
                        <div class="position-absolute rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm border" 
                             style="width: 32px; height: 32px; left: -41px; top: 0; background-color: <?php echo $st2_complete ? '#10B981' : ($st2_active ? '#F59E0B' : '#FFFFFF'); ?>; color: <?php echo ($st2_active || $st2_complete) ? '#FFFFFF' : 'var(--md-outline)'; ?>; z-index: 10;">
                            <?php if ($st2_complete): ?><span class="material-symbols-outlined text-[16px] fw-bold">check</span>
                            <?php else: ?><span class="material-symbols-outlined text-[16px]">hourglass_empty</span><?php endif; ?>
                        </div>
                        <div class="d-flex flex-column">
                            <?php if ($st2_active): ?>
                                <div class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded small fw-semibold mb-1 w-max text-dark d-inline-flex align-items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-warning animate-pulse"></span> En cours
                                </div>
                            <?php endif; ?>
                            <h3 class="h6 fw-bold text-dark m-0">En cours de traitement par l'Agent</h3>
                            <p class="text-muted small m-0 mt-1">L'agent vérificateur examine la validité technique de votre acte et la conformité des parcelles.</p>
                        </div>
                    </div>

                    <div class="position-relative mb-5 <?php echo (!$st3_active && !$st3_complete) ? 'opacity-50' : ''; ?>">
                        <div class="position-absolute rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm border" 
                             style="width: 32px; height: 32px; left: -41px; top: 0; background-color: <?php echo $st3_complete ? '#10B981' : ($st3_active ? '#F59E0B' : '#FFFFFF'); ?>; color: <?php echo ($st3_active || $st3_complete) ? '#FFFFFF' : 'var(--md-outline)'; ?>; z-index: 10;">
                            <?php if ($st3_complete): ?><span class="material-symbols-outlined text-[16px] fw-bold">check</span>
                            <?php else: ?><span class="material-symbols-outlined text-[16px]">gavel</span><?php endif; ?>
                        </div>
                        <div class="d-flex flex-column">
                            <?php if ($st3_active): ?>
                                <div class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded small fw-semibold mb-1 w-max text-dark d-inline-flex align-items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-warning animate-pulse"></span> En arbitrage
                                </div>
                            <?php endif; ?>
                            <h3 class="h6 fw-bold text-dark m-0">Validation finale par le Chef de Service</h3>
                            <p class="text-muted small m-0 mt-1">Examen de conformité juridique suprême avant signature de l'arrêté de mutation cadastrale.</p>
                        </div>
                    </div>

                    <div class="position-relative <?php echo (!$st4_complete && !$st4_failed) ? 'opacity-50' : ''; ?>">
                        <div class="position-absolute rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm border" 
                             style="width: 32px; height: 32px; left: -41px; top: 0; background-color: <?php echo $st4_complete ? '#10B981' : ($st4_failed ? '#EF4444' : '#FFFFFF'); ?>; color: <?php echo ($st4_complete || $st4_failed) ? '#FFFFFF' : 'var(--md-outline)'; ?>; z-index: 10;">
                            <?php if ($st4_complete): ?><span class="material-symbols-outlined text-[16px] fw-bold">verified</span>
                            <?php elseif ($st4_failed): ?><span class="material-symbols-outlined text-[16px]">cancel</span><?php else: ?><span class="w-2 h-2 rounded-circle bg-secondary"></span><?php endif; ?>
                        </div>
                        <div class="d-flex flex-column">
                            <h3 class="h6 fw-bold text-dark m-0">
                                <?php echo $st4_failed ? 'Transfert Rejeté' : 'Transfert Effectué'; ?>
                            </h3>
                            <p class="text-muted small m-0 mt-1">
                                <?php echo $st4_failed ? 'L\'administration a rejeté votre demande.' : 'Le titre foncier a été officiellement muté au nom de l\'acquéreur.'; ?>
                            </p>
                            
                            <?php if (!empty($t['commentaire'])): ?>
                                <div class="mt-3 p-3 rounded border <?php echo $st4_failed ? 'bg-danger bg-opacity-10 text-danger border-danger border-opacity-10' : 'bg-light'; ?> small lh-base">
                                    <strong>Notes administratives :</strong><br>
                                    <?php echo htmlspecialchars($t['commentaire']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

<?php require_once '../../includes/footer.php'; ?>