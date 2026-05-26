<?php
// consultant/transferts/create.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Sécurité : Vérifier que le citoyen est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: /foncier_gloV3/login.php');
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$titre   = "Initier un Transfert de Propriété";
$erreurs = [];
$conn    = getConnexion();

// 1. Récupération des parcelles valides du citoyen (Uniquement celles avec statut 'attribue')
// On exclut les parcelles déjà en litige ou réservées pour éviter les fraudes ou doubles ventes
$sql_parcelles = "SELECT id, reference_cadastrale, arrondissement, village_quartier, superficie 
                  FROM parcelles 
                  WHERE proprietaire_id = ? AND statut = 'attribue' 
                  ORDER BY reference_cadastrale ASC";
$stmt_p = $conn->prepare($sql_parcelles);
$stmt_p->bind_param('i', $user_id);
$stmt_p->execute();
$mes_parcelles = $stmt_p->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_p->close();

// Optionnel : Pré-remplir la parcelle si l'ID est transmis via l'URL (Depuis Mes Parcelles)
$parcelle_id_pre = isset($_GET['parcelle_id']) ? (int)$_GET['parcelle_id'] : null;

// 2. Traitement de la soumission du dossier (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parcelle_id   = (int)$_POST['parcelle_id'];
    $nouveau_nom   = nettoyer($_POST['nouveau_nom']);
    $nouveau_prenom = nettoyer($_POST['nouveau_prenom']);
    $nouveau_npi   = nettoyer($_POST['nouveau_npi']);
    $nouveau_tel   = nettoyer($_POST['nouveau_telephone']);
    $nouveau_email = nettoyer($_POST['nouveau_email']);

    // Validations de base des champs
    if (empty($parcelle_id)) $erreurs[] = "Veuillez sélectionner la parcelle à céder.";
    if (empty($nouveau_nom)) $erreurs[] = "Le nom de l'acquéreur est obligatoire.";
    if (empty($nouveau_prenom)) $erreurs[] = "Le prénom de l'acquéreur est obligatoire.";
    if (empty($nouveau_npi)) $erreurs[] = "Le numéro NPI/IFU de l'acquéreur est obligatoire pour l'enregistrement du cadastre.";
    if (empty($nouveau_tel)) $erreurs[] = "Le numéro de téléphone de l'acquéreur est requis.";

    // Vérifier que la parcelle sélectionnée appartient bien à l'utilisateur connecté (Sécurité anti-injection)
    $stmt_check = $conn->prepare("SELECT id FROM parcelles WHERE id = ? AND proprietaire_id = ? AND statut = 'attribue' LIMIT 1");
    $stmt_check->bind_param('ii', $parcelle_id, $user_id);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows === 0) {
        $erreurs[] = "La parcelle sélectionnée n'est pas valide ou ne fait pas partie de votre patrimoine cessible.";
    }
    $stmt_check->close();

    // Gestion sécurisée du téléversement de l'acte justificatif
    $nom_fichier_final = '';
    if (isset($_FILES['document_preuve']) && $_FILES['document_preuve']['error'] === UPLOAD_ERR_OK) {
        $file_tmp   = $_FILES['document_preuve']['tmp_name'];
        $file_name  = $_FILES['document_preuve']['name'];
        $file_size  = $_FILES['document_preuve']['size'];
        $file_ext   = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $extensions_autorisees = ['pdf', 'png', 'jpg', 'jpeg'];

        // Validation A : Extension du fichier
        if (!in_array($file_ext, $extensions_autorisees)) {
            $erreurs[] = "Format de fichier refusé. Veuillez téléverser un document au format PDF, PNG ou JPG.";
        }
        // Validation B : Limite de taille fixée à 10 Mo
        if ($file_size > 10 * 1024 * 1024) {
            $erreurs[] = "Le document justificatif est trop volumineux (Maximum 10 Mo).";
        }

        if (empty($erreurs)) {
            // Création d'un nom de fichier unique pour éviter l'écrasement sur le serveur
            $nom_fichier_final = "ACTE_" . date('Ymd_His') . "_" . uniqid() . "." . $file_ext;
            $dossier_destination = "../../assets/uploads/transferts/";

            // Création automatique du dossier s'il n'existe pas encore sur le serveur
            if (!is_dir($dossier_destination)) {
                mkdir($dossier_destination, 0755, true);
            }

            if (!move_uploaded_file($file_tmp, $dossier_destination . $nom_fichier_final)) {
                $erreurs[] = "Échec technique lors de l'enregistrement du document sur le serveur.";
            }
        }
    } else {
        $erreurs[] = "Veuillez joindre la copie numérisée de l'acte de vente ou de cession signé.";
    }

    // Insertion définitive en base de données
    if (empty($erreurs)) {
        // Génération de la référence unique du dossier conforme à la maquette
        $reference = "TR-" . date('Y') . "-" . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
        $statut_initial = "en_attente";

        $sql_insert = "INSERT INTO transferts (
                            reference, parcelle_id, ancien_proprietaire_id, 
                            nouveau_nom, nouveau_prenom, nouveau_npi, 
                            nouveau_telephone, nouveau_email, document_preuve, statut
                       ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_ins = $conn->prepare($sql_insert);
        $stmt_ins->bind_param(
            'siisssssss',
            $reference,
            $parcelle_id,
            $user_id,
            $nouveau_nom,
            $nouveau_prenom,
            $nouveau_npi,
            $nouveau_tel,
            $nouveau_email,
            $nom_fichier_final,
            $statut_initial
        );

        if ($stmt_ins->execute()) {
            flashMessage('success', "Votre demande de transfert de propriété $reference a été soumise avec succès au SADE.");
            header('Location: /foncier_gloV3/consultant/transferts/index.php');
            exit();
        } else {
            $erreurs[] = "Erreur système lors de l'ouverture du dossier de transaction.";
        }
        $stmt_ins->close();
    }
}

$conn->close();

require_once '../../includes/header.php';
require_once '../../includes/navbar_consultant.php'; // Injecte la Topbar et la Sidebar citoyenne
?>

<div class="container-fluid p-4 p-md-5" style="margin-bottom: 110px;">

    <div class="mb-4">
        <h1 class="h3 fw-bold mb-2" style="color: var(--md-tertiary);">Transfert de Propriété</h1>
        <p class="text-muted small">Veuillez renseigner les informations nécessaires pour initier le transfert en ligne de votre titre foncier.</p>
    </div>

    <?php if (!empty($erreurs)): ?>
        <div class="alert alert-danger border-0 rounded-3 mb-4" style="background-color: var(--md-error-container); color: var(--md-on-error-container);">
            <ul class="mb-0 small">
                <?php foreach ($erreurs as $e): ?><li><?php echo htmlspecialchars($e); ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="bento-card bg-white border-0 shadow-sm p-4 mb-4 overflow-hidden">
        <div class="d-flex flex-column flex-sm-row justify-content-around align-items-center gap-4 position-relative">
            <div class="position-absolute top-50 start-0 translate-middle-y w-100 d-none d-sm-block bg-light border-top border-2 border-outline-variant" style="z-index: 1;"></div>

            <div class="d-flex flex-column align-items-center gap-2 bg-white px-3 position-relative z-2">
                <div class="avatar-mini rounded-circle bg-success text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
                    <span class="material-symbols-outlined fs-5">check</span>
                </div>
                <span class="small fw-semibold text-muted">1. Sélection du Terrain</span>
            </div>

            <div class="d-flex flex-column align-items-center gap-2 bg-white px-3 position-relative z-2">
                <div class="avatar-mini rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; background-color: var(--md-tertiary);">
                    <span class="font-label-md fw-bold">2</span>
                </div>
                <span class="small fw-bold text-primary">2. Informations de l'Acquéreur</span>
            </div>

            <div class="d-flex flex-column align-items-center gap-2 bg-white px-3 position-relative z-2 opacity-50">
                <div class="avatar-mini rounded-circle bg-light text-muted d-flex align-items-center justify-content-center border" style="width: 40px; height: 40px;">
                    <span class="font-label-md fw-bold">3</span>
                </div>
                <span class="small text-muted">3. Justificatifs de Vente</span>
            </div>
        </div>
    </div>

    <form method="POST" enctype="multipart/form-data">
        <div class="row g-4">

            <div class="col-12 col-lg-7">
                <div class="bento-card bg-white border-0 shadow-sm p-4 h-100">

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-box text-primary bg-light rounded d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <span class="material-symbols-outlined fs-5">person</span>
                        </div>
                        <h2 class="h5 m-0 fw-bold text-dark">Détails de l'Acquéreur</h2>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-muted">Parcelle à céder *</label>
                        <select name="parcelle_id" class="form-select font-monospace text-primary" required>
                            <option value="">-- Choisir parmi vos parcelles éligibles --</option>
                            <?php foreach ($mes_parcelles as $p): ?>
                                <option value="<?php echo $p['id']; ?>" <?php echo (($parcelle_id_pre ?? $_POST['parcelle_id'] ?? '') == $p['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($p['reference_cadastrale'] . ' — ' . $p['arrondissement'] . ' (' . number_format($p['superficie'], 0) . ' m²)'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted d-block mt-1">Seules vos propriétés sans aucun litige en cours apparaissent dans ce menu déroulant.</small>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Prénom de l'acquéreur *</label>
                            <input type="text" name="nouveau_prenom" class="form-control" placeholder="Ex: Jean" value="<?php echo htmlspecialchars($_POST['nouveau_prenom'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Nom de l'acquéreur *</label>
                            <input type="text" name="nouveau_nom" class="form-control" placeholder="Ex: Dupont" value="<?php echo htmlspecialchars($_POST['nouveau_nom'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-muted">Numéro Personnel d'Identification (NPI / IFU) *</label>
                        <input type="text" name="nouveau_npi" class="form-control font-monospace border-primary" placeholder="Identifiant unique de l'acheteur" value="<?php echo htmlspecialchars($_POST['nouveau_npi'] ?? ''); ?>" required>

                        <div class="d-flex align-items-start gap-2 mt-2 text-success bg-success bg-opacity-10 p-2 rounded">
                            <span class="material-symbols-outlined fs-6 mt-0.5">auto_awesome</span>
                            <small class="fw-medium">Si cet acquéreur est déjà enregistré au cadastre, le système liera automatiquement la nouvelle parcelle à son compte existant grâce à ce numéro NPI.</small>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Numéro de Téléphone *</label>
                            <input type="tel" name="nouveau_telephone" class="form-control" placeholder="Ex: +229 00 00 00 00" value="<?php echo htmlspecialchars($_POST['nouveau_telephone'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Adresse Email (Optionnel)</label>
                            <input type="email" name="nouveau_email" class="form-control font-monospace" placeholder="email@domaine.com" value="<?php echo htmlspecialchars($_POST['nouveau_email'] ?? ''); ?>">
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="bento-card bg-white border-0 shadow-sm p-4 h-100 flex-column d-flex justify-content-between">

                    <div>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-box text-primary bg-light rounded d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <span class="material-symbols-outlined fs-5">upload_file</span>
                            </div>
                            <h2 class="h5 m-0 fw-bold text-dark">Pièces Jointes</h2>
                        </div>
                        <p class="text-muted small mb-4">Veuillez fournir une copie numérisée lisible de l'acte de vente signé conjointement par les deux parties.</p>
                    </div>

                    <div class="flex-grow-1 border-2 border-dashed rounded-3 p-4 text-center d-flex flex-column align-items-center justify-content-center bg-light transition-all cursor-pointer group"
                        style="min-height: 200px; border-color: var(--md-outline-variant);"
                        onclick="document.getElementById('document_preuve').click();">

                        <div class="avatar-large rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center mb-3 text-primary group-hover:scale-105 transition-transform" style="width: 52px; height: 52px;">
                            <span class="material-symbols-outlined fs-2">cloud_upload</span>
                        </div>

                        <p class="small fw-semibold text-dark mb-1">Glissez-déposez l'acte de vente signé</p>
                        <p class="text-muted mb-3" style="font-size: 0.75rem;">Formats acceptés : PDF, PNG ou JPG (Max 10 Mo)</p>

                        <input type="file" name="document_preuve" id="document_preuve" class="d-none" accept=".pdf,.png,.jpg,.jpeg" onchange="afficherNomFichier(this);">
                        <button type="button" class="btn btn-sm btn-white border px-3 fw-semibold text-muted bg-white">Parcourir les fichiers</button>

                        <div id="file-feedback" class="mt-3 text-success small fw-medium d-none"></div>
                    </div>

                </div>
            </div>

        </div>

        <div class="fixed-bottom border-top bg-white p-3 shadow-sm" style="left: var(--sidebar-width, 260px); z-index: 1020;">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a href="/foncier_gloV3/consultant/dashboard.php" class="btn btn-light border font-semibold px-4 rounded-3 text-muted">
                    Annuler
                </a>
                <button type="submit" class="btn text-white font-semibold px-4 rounded-3 d-flex align-items-center gap-2" style="background-color: var(--md-primary-container);">
                    <span>Soumettre le dossier au SADE</span>
                    <span class="material-symbols-outlined fs-6">arrow_forward</span>
                </button>
            </div>
        </div>
    </form>

</div>

<script>
    function afficherNomFichier(input) {
        const feedback = document.getElementById('file-feedback');
        if (input.files && input.files[0]) {
            feedback.innerHTML = `<span class="material-symbols-outlined fs-6 align-middle me-1">attachment</span> Fichier prêt : <b>${input.files[0].name}</b>`;
            feedback.classList.remove('d-none');
        } else {
            feedback.classList.add('d-none');
        }
    }
</script>

<?php require_once '../../includes/footer.php'; ?>