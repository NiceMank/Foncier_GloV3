<?php
// consultant/dashboard.php
require_once '../config/session.php';
require_once '../config/database.php';

// Sécurité : Vérifie que l'utilisateur est connecté (Rôle : Propriétaire/Consultant)
// Si votre fonction requiertRole gère aussi les consultants, adaptez la chaîne ci-dessous
if (!isset($_SESSION['user_id'])) {
    header('Location: /foncier_gloV3/login.php');
    exit();
}

$user_id     = (int)$_SESSION['user_id'];
$prenom_user = $_SESSION['user_prenom'] ?? 'Monsieur';
$nom_user    = $_SESSION['user_nom'] ?? '';
$conn        = getConnexion();

// 1. Récupération des compteurs pour les blocs Bento supérieurs
// Compteur A : Nombre total de parcelles possédées
$stmt_parcelles_count = $conn->prepare("SELECT COUNT(*) AS total FROM parcelles WHERE proprietaire_id = ?");
$stmt_parcelles_count->bind_param('i', $user_id);
$stmt_parcelles_count->execute();
$total_parcelles = $stmt_parcelles_count->get_result()->fetch_assoc()['total'];
$stmt_parcelles_count->close();

// Compteur B : Nombre de litiges actifs (ouvert/en cours) sur son patrimoine
$stmt_litiges_count = $conn->prepare("SELECT COUNT(*) AS total FROM litiges l 
                                      JOIN parcelles p ON l.parcelle_id = p.id 
                                      WHERE p.proprietaire_id = ? AND l.statut IN ('ouvert', 'en_cours')");
$stmt_litiges_count->bind_param('i', $user_id);
$stmt_litiges_count->execute();
$total_litiges = $stmt_litiges_count->get_result()->fetch_assoc()['total'];
$stmt_litiges_count->close();

// 2. Récupération des parcelles récentes pour la grille d'affichage (Limité aux 2 dernières)
$stmt_parcelles_list = $conn->prepare("SELECT * FROM parcelles WHERE proprietaire_id = ? ORDER BY created_at DESC LIMIT 2");
$stmt_parcelles_list->bind_param('i', $user_id);
$stmt_parcelles_list->execute();
$parcelles_recentes = $stmt_parcelles_list->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_parcelles_list->close();

// 3. Récupération du dossier de mutation le plus récent pour le Stepper de suivi
$stmt_transfert_suivi = $conn->prepare("SELECT t.*, p.reference_cadastrale FROM transferts t 
                                        JOIN parcelles p ON t.parcelle_id = p.id 
                                        WHERE t.ancien_proprietaire_id = ? 
                                        ORDER BY t.created_at DESC LIMIT 1");
$stmt_transfert_suivi->bind_param('i', $user_id);
$stmt_transfert_suivi->execute();
$dernier_transfert = $stmt_transfert_suivi->get_result()->fetch_assoc();
$stmt_transfert_suivi->close();

$conn->close();

$titre = "Espace Citoyen — Tableau de bord";
require_once '../includes/header.php'; 
require_once '../includes/navbar_consultant.php'; // Charge la Sidebar et la Topbar citoyenne
?>

<div class="container-fluid p-4 p-md-5">

    <?php afficherFlash(); ?>

    <div class="row g-4 mb-4">
        
        <div class="col-12 col-xl-8">
            <div class="bento-card bg-white shadow-sm p-4 h-100 d-flex flex-column justify-content-between border-0">
                <div>
                    <h1 class="h2 fw-bold mb-2" style="color: var(--md-primary);">Bonjour, <?php echo htmlspecialchars($prenom_user . ' ' . $nom_user); ?></h1>
                    <p class="text-muted m-0">Voici un aperçu en temps réel de vos propriétés foncières validées et de l'état de vos démarches de mutation à Glo-Djigbé.</p>
                </div>
                
                <div class="row g-3 mt-4">
                    <div class="col-6">
                        <div class="p-3 bg-light border rounded-3">
                            <span class="text-muted font-label-sm text-uppercase tracking-wider d-block mb-1" style="font-size: 0.75rem;">Parcelles Enregistrées</span>
                            <span class="h3 fw-bold m-0 text-primary"><?php echo $total_parcelles; ?></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light border rounded-3">
                            <span class="text-muted font-label-sm text-uppercase tracking-wider d-block mb-1" style="font-size: 0.75rem;">Contentieux / Litiges</span>
                            <span class="h3 fw-bold m-0 <?php echo $total_litiges > 0 ? 'text-danger' : 'text-success'; ?>">
                                <?php echo $total_litiges; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="bento-card border-0 shadow-sm p-4 text-center h-100 d-flex flex-column justify-content-center align-items-center" style="background-color: var(--md-surface-container-low);">
                <div class="avatar-large rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; color: var(--md-primary);">
                    <span class="material-symbols-outlined fs-2">add_business</span>
                </div>
                <h3 class="h5 fw-bold text-dark mb-2">Nouvelle Démarche</h3>
                <p class="small text-muted mb-4 px-2">Initiez un acte de vente légal, préparez la cession de droits ou transférez vos titres certifiés en toute sécurité.</p>
                <a href="/foncier_gloV3/consultant/transferts/create.php" class="btn text-white w-100 fw-bold py-2.5 shadow-sm" style="background-color: var(--md-secondary); border-radius: 8px;">
                    + Initier une vente / Transfert
                </a>
            </div>
        </div>

    </div>

    <div class="d-flex justify-content-between align-items-end mb-3 mt-5">
        <h3 class="h5 fw-bold text-dark m-0 d-flex align-items-center gap-2">
            <span class="material-symbols-outlined text-secondary">map</span> Mes Parcelles Récentes
        </h3>
        <a href="/foncier_gloV3/consultant/parcelles/index.php" class="small fw-semibold text-decoration-none text-primary">Voir tout mon patrimoine</a>
    </div>

    <div class="row g-4 mb-5">
        <?php if (empty($parcelles_recentes)): ?>
            <div class="col-12">
                <div class="bento-card border-0 shadow-sm p-5 text-center bg-white text-muted">
                    <span class="material-symbols-outlined fs-1 opacity-25 mb-2 d-block">map</span>
                    Aucun bien immobilier n'est actuellement rattaché à votre compte d'accès Consultant.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($parcelles_recentes as $p): ?>
                <div class="col-12 col-md-6">
                    <div class="bento-card bg-white border-0 shadow-sm p-4 h-100 flex-column d-flex justify-content-between">
                        <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                            <div>
                                <small class="text-muted text-uppercase font-label-sm tracking-wider d-block" style="font-size: 0.7rem;">Réf. Cadastrale</small>
                                <span class="h4 font-monospace fw-bold text-dark"><?php echo htmlspecialchars($p['reference_cadastrale']); ?></span>
                            </div>
                            
                            <?php if ($p['statut'] === 'litige'): ?>
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2.5 py-1.5 rounded d-inline-flex align-items-center gap-1 small fw-semibold">
                                    <span class="material-symbols-outlined text-[14px]">warning</span> En Litige / Bloqué
                                </span>
                            <?php else: ?>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2.5 py-1.5 rounded d-inline-flex align-items-center gap-1 small fw-semibold">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span> Propriété Validée
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="text-muted small mb-4 d-flex align-items-center gap-1">
                            <span class="material-symbols-outlined text-muted fs-6">location_on</span>
                            <span>Arrondissement de <?php echo htmlspecialchars($p['arrondissement'] . ' — ' . $p['village_quartier']); ?></span>
                        </div>

                        <div class="border-top pt-3 d-flex justify-content-between align-items-end mt-auto">
                            <div>
                                <small class="text-muted d-block font-label-sm mb-0.5" style="font-size: 0.75rem;">Superficie calculée</small>
                                <span class="fw-bold text-dark fs-5"><?php echo number_format($p['superficie'], 2, ',', ' '); ?> m²</span>
                            </div>
                            <a href="/foncier_gloV3/consultant/parcelles/show.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-light border font-semibold px-3 py-2 rounded-3 text-primary">
                                Voir la fiche technique
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if ($dernier_transfert): ?>
        <div class="bento-card bg-white border-0 shadow-sm p-4 mt-5">
            <h3 class="h6 text-dark fw-bold uppercase tracking-wider mb-4 border-bottom pb-2 d-flex align-items-center gap-2">
                <span class="material-symbols-outlined text-primary fs-5">assignment_turned_in</span> Historique des demandes (Récentes)
            </h3>
            
            <div class="row text-center position-relative g-0 mb-4 pt-2">
                
                <div class="position-absolute top-50 start-0 translate-middle-y w-100 d-none d-md-block bg-light-subtle border-top border-2 border-outline-variant" style="z-index: 1;"></div>
                
                <?php
                $st = $dernier_transfert['statut'];
                // Mappage des états pour illuminer le parcours linéaire
                $step1 = true; // Toujours validé car soumis
                $step2 = ($st === 'en_verification' || $st === 'valide' || $st === 'rejete');
                $step3 = ($st === 'valide' || $st === 'rejete');
                $step4 = ($st === 'valide' || $st === 'rejete');
                ?>

                <div class="col-12 col-md-3 position-relative z-2 mb-3 mb-md-0">
                    <div class="avatar-mini bg-success text-white mx-auto rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px;">
                        <span class="material-symbols-outlined text-[18px]">check</span>
                    </div>
                    <div class="small fw-bold text-dark mt-2">Dossier Soumis</div>
                    <small class="text-muted font-monospace" style="font-size: 0.7rem;"><?php echo date('d/m/Y', strtotime($dernier_transfert['created_at'])); ?></small>
                </div>

                <div class="col-12 col-md-3 position-relative z-2 mb-3 mb-md-0 <?php echo !$step2 ? 'opacity-50' : ''; ?>">
                    <div class="avatar-mini mx-auto rounded-circle d-flex align-items-center justify-content-center border border-2 shadow-sm <?php echo $st === 'en_verification' ? 'border-primary bg-white text-primary' : ($step2 ? 'bg-success text-white border-success' : 'bg-white text-muted'); ?>" style="width: 32px; height: 32px;">
                        <?php if ($st === 'en_verification'): ?><span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span><?php elseif ($step2): ?><span class="material-symbols-outlined text-[18px]">check</span><?php endif; ?>
                    </div>
                    <div class="small mt-2 <?php echo $st === 'en_verification' ? 'fw-bold text-primary' : 'text-dark'; ?>">Instruction & Analyse</div>
                </div>

                <div class="col-12 col-md-3 position-relative z-2 mb-3 mb-md-0 <?php echo !$step3 ? 'opacity-50' : ''; ?>">
                    <div class="avatar-mini mx-auto rounded-circle d-flex align-items-center justify-content-center border border-2 shadow-sm <?php echo $step3 ? 'bg-success text-white border-success' : 'bg-white text-muted'; ?>" style="width: 32px; height: 32px;">
                        <?php if ($step3): ?><span class="material-symbols-outlined text-[18px]">check</span><?php endif; ?>
                    </div>
                    <div class="small mt-2">Validation Légale</div>
                </div>

                <div class="col-12 col-md-3 position-relative z-2 <?php echo !$step4 ? 'opacity-50' : ''; ?>">
                    <div class="avatar-mini mx-auto rounded-circle d-flex align-items-center justify-content-center border border-2 shadow-sm <?php echo $st === 'valide' ? 'bg-success text-white border-success' : ($st === 'rejete' ? 'bg-danger text-white border-danger' : 'bg-white text-muted'); ?>" style="width: 32px; height: 32px;">
                        <?php if ($st === 'valide'): ?><span class="material-symbols-outlined text-[18px]">verified</span><?php elseif ($st === 'rejete'): ?><span class="material-symbols-outlined text-[18px]">cancel</span><?php endif; ?>
                    </div>
                    <div class="small mt-2 fw-semibold <?php echo $st === 'valide' ? 'text-success' : ($st === 'rejete' ? 'text-danger' : 'text-dark'); ?>">
                        <?php echo $st === 'rejete' ? 'Dossier Rejeté' : 'Mutation Clôturée'; ?>
                    </div>
                </div>

            </div>

            <div class="p-3 bg-light border rounded-3 mt-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                <div>
                    <div class="fw-bold text-dark small">Mutation Foncière en cours sur la parcelle : <?php echo htmlspecialchars($dernier_transfert['reference_cadastrale']); ?></div>
                    <small class="text-muted font-monospace" style="font-size: 0.75rem;">Numéro de dossier unique : #<?php echo htmlspecialchars($dernier_transfert['reference']); ?></small>
                </div>
                <a href="/foncier_gloV3/consultant/transferts/index.php" class="btn btn-sm btn-outline-primary fw-semibold bg-white text-nowrap px-3 rounded-3">
                    Suivre le dossier
                </a>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php require_once '../includes/footer.php'; ?>