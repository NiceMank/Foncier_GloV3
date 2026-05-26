<?php
// admin/transferts/show.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Sécurité : Seuls l'Agent SADE et le Chef de Service peuvent instruire un transfert
requiertRole(['agent_sade', 'chef_service']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id'];
$role_user = $_SESSION['user_role'];
$conn = getConnexion();
$erreur = '';

// Récupération des informations du transfert
$sql = "SELECT t.*, 
               p.reference_cadastrale, p.superficie, p.arrondissement, p.village_quartier, p.type_terrain,
               pr.nom AS ancien_nom, pr.prenom AS ancien_prenom, pr.npi AS ancien_npi, pr.telephone AS ancien_tel
        FROM transferts t
        JOIN parcelles p ON t.parcelle_id = p.id
        JOIN proprietaires pr ON t.ancien_proprietaire_id = pr.id
        WHERE t.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$t = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$t) {
    header('Location: index.php');
    exit();
}

// LOGIQUE DE TRAITEMENT DES DÉCISIONS ADMINISTRATIVES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentaire = nettoyer($_POST['commentaire']);
    $agent_id = $_SESSION['user_id'];

    // Action de l'Agent SADE : Transmettre le dossier au Chef
    if ($role_user === 'agent_sade' && isset($_POST['action_agent']) && $_POST['action_agent'] === 'soumettre') {
        $stmt_upd = $conn->prepare("UPDATE transferts SET statut = 'en_verification', commentaire = ? WHERE id = ?");
        $stmt_upd->bind_param('si', $commentaire, $id);
        $stmt_upd->execute();
        $stmt_upd->close();
        flashMessage('success', "Dossier analysé et transmis au Chef de Service pour validation finale.");
        header('Location: index.php');
        exit();
    }

    // Action du Chef de Service : Valider ou Rejeter définitivement
    if ($role_user === 'chef_service' && isset($_POST['action_chef'])) {
        $action = $_POST['action_chef'];

        if ($action === 'rejeter') {
            $stmt_rej = $conn->prepare("UPDATE transferts SET statut = 'rejete', commentaire = ?, agent_validateur_id = ?, date_validation = NOW() WHERE id = ?");
            $stmt_rej->bind_param('sii', $commentaire, $agent_id, $id);
            $stmt_rej->execute();
            $stmt_rej->close();
            flashMessage('danger', 'La demande de mutation a été rejetée.');
            header('Location: index.php');
            exit();
        } 
        
        if ($action === 'valider') {
            $conn->begin_transaction();
            try {
                // Vérifier l'existence de l'acquéreur via son NPI
                $stmt_check = $conn->prepare("SELECT id FROM proprietaires WHERE npi = ? LIMIT 1");
                $stmt_check->bind_param('s', $t['nouveau_npi']);
                $stmt_check->execute();
                $res_check = $stmt_check->get_result()->fetch_assoc();
                $stmt_check->close();

                if ($res_check) {
                    $nouveau_owner_id = $res_check['id'];
                } else {
                    // Création automatique du compte propriétaire
                    $chaine = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
                    $pass_clair = substr(str_shuffle($chaine), 0, 8);
                    $pass_hash = password_hash($pass_clair, PASSWORD_DEFAULT);
                    $type_defaut = 'personne_physique';
                    $actif_defaut = 'oui';

                    $sql_ins_prop = "INSERT INTO proprietaires (nom, prenom, npi, telephone, type, email_connexion, password_connexion, compte_actif) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt_ins = $conn->prepare($sql_ins_prop);
                    $stmt_ins->bind_param('ssssssss', $t['nouveau_nom'], $t['nouveau_prenom'], $t['nouveau_npi'], $t['nouveau_telephone'], $type_defaut, $t['nouveau_email'], $pass_hash, $actif_defaut);
                    $stmt_ins->execute();
                    $nouveau_owner_id = $conn->insert_id;
                    $stmt_ins->close();
                }

                // Mutation légale de la parcelle
                $stmt_mut = $conn->prepare("UPDATE parcelles SET statut = 'attribue', proprietaire_id = ? WHERE id = ?");
                $stmt_mut->bind_param('ii', $nouveau_owner_id, $t['parcelle_id']);
                $stmt_mut->execute();
                $stmt_mut->close();

                // Validation finale du transfert
                $stmt_trans = $conn->prepare("UPDATE transferts SET statut = 'valide', commentaire = ?, agent_validateur_id = ?, date_validation = NOW() WHERE id = ?");
                $stmt_trans->bind_param('sii', $commentaire, $agent_id, $id);
                $stmt_trans->execute();
                $stmt_trans->close();

                $conn->commit();
                flashMessage('success', 'Mutation foncière enregistrée. La parcelle a changé de titulaire.');
                header('Location: index.php');
                exit();

            } catch (Exception $e) {
                $conn->rollback();
                $erreur = "Erreur système lors du transfert : " . $e->getMessage();
            }
        }
    }
}

$titre = "Instruction — " . htmlspecialchars($t['reference']);
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">

    <div class="mb-4">
        <a href="index.php" class="btn btn-sm btn-light border text-muted mb-2 d-inline-flex align-items-center gap-1">
            <span class="material-symbols-outlined fs-6">arrow_back</span> Revenir au registre
        </a>
        <h2 class="h3 fw-bold" style="color: var(--md-primary);">Instruction du Dossier : <?php echo htmlspecialchars($t['reference']); ?></h2>
    </div>

    <?php if(!empty($erreur)): ?><div class="alert alert-danger"><?php echo $erreur; ?></div><?php endif; ?>

    <div class="row g-4">
        
        <div class="col-12 col-lg-8">
            <div class="bento-card mb-4 shadow-sm border-0">
                <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-primary">map</span> Fiche technique de la parcelle
                </h5>
                <div class="row g-3 bg-light p-3 rounded-3 m-0">
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Référence cadastrale</small>
                        <span class="fw-bold text-dark font-monospace"><?php echo htmlspecialchars($t['reference_cadastrale']); ?></span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Superficie</small>
                        <span class="fw-bold text-dark"><?php echo number_format($t['superficie'], 2); ?> m²</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Situation géographique</small>
                        <span><?php echo htmlspecialchars($t['arrondissement'] . ' — ' . $t['village_quartier']); ?></span>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6">
                    <div class="bento-card h-100 border-start border-4 border-danger shadow-sm border-top-0 border-end-0 border-bottom-0">
                        <h6 class="fw-bold text-danger text-uppercase tracking-wider small mb-3">Cédant (Ancien Propriétaire)</h6>
                        <p class="m-0 fw-bold text-dark fs-5"><?php echo htmlspecialchars($t['ancien_prenom'] . ' ' . $t['ancien_nom']); ?></p>
                        <small class="text-muted font-monospace d-block my-2">NPI: <?php echo htmlspecialchars($t['ancien_npi']); ?></small>
                        <small class="text-muted d-block">Tel: <?php echo htmlspecialchars($t['ancien_tel']); ?></small>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="bento-card h-100 border-start border-4 border-success shadow-sm border-top-0 border-end-0 border-bottom-0">
                        <h6 class="fw-bold text-success text-uppercase tracking-wider small mb-3">Acquéreur (Nouveau Propriétaire)</h6>
                        <p class="m-0 fw-bold text-dark fs-5"><?php echo htmlspecialchars($t['nouveau_prenom'] . ' ' . $t['nouveau_nom']); ?></p>
                        <small class="text-muted font-monospace d-block my-2">NPI: <?php echo htmlspecialchars($t['nouveau_npi']); ?></small>
                        <small class="text-muted d-block">Tel: <?php echo htmlspecialchars($t['nouveau_telephone']); ?></small>
                    </div>
                </div>
            </div>

            <div class="bento-card border-0 shadow-sm">
                <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-danger">picture_as_pdf</span> Document justificatif de vente
                </h5>
                <div class="border rounded-3 p-4 text-center bg-light">
                    <span class="material-symbols-outlined fs-1 text-muted opacity-50 mb-2">description</span>
                    <p class="small text-muted mb-3">Veuillez analyser la conformité légale de l'attestation téléversée avant signature.</p>
                    <a href="/foncier_gloV3/assets/uploads/transferts/<?php echo htmlspecialchars($t['document_preuve']); ?>" target="_blank" class="btn btn-sm btn-primary px-4 fw-semibold d-inline-flex align-items-center gap-2">
                        <span class="material-symbols-outlined fs-6">open_in_new</span>
                        <span>Ouvrir la pièce justificative</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="bento-card shadow-sm border-0 position-sticky" style="top: 100px;">
                <h5 class="fw-bold mb-3 text-dark">Clôture Juridique</h5>
                
                <?php if ($t['statut'] === 'valide'): ?>
                    <div class="alert alert-success d-flex align-items-center gap-2 border-0 mb-0 py-3">
                        <span class="material-symbols-outlined">verified</span>
                        <div class="small fw-medium">Ce transfert est approuvé et muté.</div>
                    </div>
                <?php elseif ($t['statut'] === 'rejete'): ?>
                    <div class="alert alert-danger d-flex align-items-center gap-2 border-0 mb-0 py-3">
                        <span class="material-symbols-outlined">cancel</span>
                        <div class="small fw-medium">Dossier classé comme : Rejeté.</div>
                    </div>
                <?php else: ?>
                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-muted">Notes d'instruction administrative</label>
                            <textarea name="commentaire" class="form-control" rows="4" placeholder="Précisez ici vos observations..."><?php echo htmlspecialchars($t['commentaire'] ?? ''); ?></textarea>
                        </div>

                        <?php if ($role_user === 'agent_sade' && $t['statut'] === 'en_attente'): ?>
                            <button type="submit" name="action_agent" value="soumettre" class="btn btn-primary fw-semibold w-100 py-2 d-flex align-items-center justify-content-center gap-2">
                                <span class="material-symbols-outlined fs-5">send</span> Transmettre au Chef de Service
                            </button>
                        
                        <?php elseif ($role_user === 'agent_sade' && $t['statut'] === 'en_verification'): ?>
                            <div class="alert alert-info py-2 small m-0 text-center">Dossier déjà soumis au Chef. En attente de validation.</div>

                        <?php elseif ($role_user === 'chef_service' && $t['statut'] === 'en_verification'): ?>
                            <div class="d-flex flex-column gap-2">
                                <button type="submit" name="action_chef" value="valider" class="btn btn-success fw-semibold w-100 py-2 d-flex align-items-center justify-content-center gap-2" onclick="return confirm('Confirmez-vous la mutation ? La parcelle changera de titulaire de façon immédiate.');">
                                    <span class="material-symbols-outlined fs-5">gavel</span> Approuver la mutation
                                </button>
                                <button type="submit" name="action_chef" value="rejeter" class="btn btn-outline-danger fw-semibold w-100 py-2" onclick="return confirm('Confirmez-vous le rejet de ce dossier ?');">
                                    Rejeter la demande
                                </button>
                            </div>
                        <?php endif; ?>
                    </form>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>