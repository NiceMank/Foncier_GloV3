<?php
// admin/proprietaires/edit.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// NOUVELLE RÈGLE : Seul l'Agent SADE a le droit de modifier les données citoyennes
requiertRole(['agent_sade']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /foncier_gloV3/admin/proprietaires/index.php');
    exit();
}

$id = (int)$_GET['id'];
$erreurs = [];
$conn = getConnexion();

// 1. Récupération des données actuelles du propriétaire
$sql_prop = "SELECT * FROM proprietaires WHERE id = ?";
$stmt_prop = $conn->prepare($sql_prop);
$stmt_prop->bind_param('i', $id);
$stmt_prop->execute();
$proprietaire = $stmt_prop->get_result()->fetch_assoc();
$stmt_prop->close();

if (!$proprietaire) {
    header('Location: /foncier_gloV3/admin/proprietaires/index.php');
    exit();
}

// 2. Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom            = nettoyer($_POST['nom']);
    $prenom         = nettoyer($_POST['prenom']);
    $npi            = nettoyer($_POST['npi']);
    $telephone      = nettoyer($_POST['telephone']);
    $type           = nettoyer($_POST['type']);
    $email          = nettoyer($_POST['email_connexion']);
    $compte_actif   = nettoyer($_POST['compte_actif']);

    if (empty($nom)) $erreurs[] = 'Le nom est obligatoire.';
    if (empty($prenom)) $erreurs[] = 'Le prénom est obligatoire.';
    if (empty($telephone)) $erreurs[] = 'Le numéro de téléphone est obligatoire.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = 'Une adresse email valide est obligatoire pour conserver l\'accès Consultant.';
    }

    // Vérifier l'unicité de l'email et du NPI (en excluant ce propriétaire lui-même)
    $stmt_check = $conn->prepare("SELECT id FROM proprietaires WHERE (npi = ? AND id != ?) OR (email_connexion = ? AND id != ?)");
    $stmt_check->bind_param('sisi', $npi, $id, $email, $id);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        $erreurs[] = 'Ce NPI/IFU ou cette adresse email est déjà rattaché(e) à un autre propriétaire.';
    }
    $stmt_check->close();

    if (empty($erreurs)) {
        $sql_update = "UPDATE proprietaires SET 
                        nom = ?, prenom = ?, npi = ?, telephone = ?, 
                        type = ?, email_connexion = ?, compte_actif = ? 
                       WHERE id = ?";
        
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param(
            'sssssssi',
            $nom, $prenom, $npi, $telephone, $type, $email, $compte_actif, $id
        );

        if ($stmt_update->execute()) {
            flashMessage('success', 'Les modifications du profil du propriétaire ont été enregistrées.');
            header('Location: /foncier_gloV3/admin/proprietaires/show.php?id=' . $id);
            exit();
        } else {
            $erreurs[] = 'Erreur lors de la mise à jour des informations.';
        }
        $stmt_update->close();
    }
}
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">

    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="/foncier_gloV3/admin/proprietaires/index.php" class="text-decoration-none">Annuaire</a></li>
                <li class="breadcrumb-item"><a href="/foncier_gloV3/admin/proprietaires/show.php?id=<?php echo $id; ?>" class="text-decoration-none">Fiche</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifier</li>
            </ol>
        </nav>
        <h2 class="h3 fw-bold" style="color: var(--md-primary);">Modifier le Profil Propriétaire</h2>
        <p class="text-muted">Mettez à jour les coordonnées civiles ou gérez les droits d'accès à l'Espace Consultant.</p>
    </div>

    <?php if (!empty($erreurs)): ?>
        <div class="alert alert-danger border-0">
            <ul class="mb-0">
                <?php foreach ($erreurs as $e): ?><li><?php echo $e; ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="row g-4">
            
            <div class="col-12 col-lg-8">
                <div class="bento-card mb-4 border-0 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-box" style="background-color: var(--md-surface-container); color: var(--md-primary);">
                            <span class="material-symbols-outlined fs-5">manage_accounts</span>
                        </div>
                        <h4 class="h5 m-0 fw-bold">Champs d'identité civile</h4>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Nom / Raison Sociale *</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($_POST['nom'] ?? $proprietaire['nom']); ?>" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Prénom *</label>
                            <input type="text" name="prenom" class="form-control" value="<?php echo htmlspecialchars($_POST['prenom'] ?? $proprietaire['prenom']); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Type de structure *</label>
                            <select name="type" class="form-select" required>
                                <?php $t = $_POST['type'] ?? $proprietaire['type']; ?>
                                <option value="personne_physique" <?php echo ($t === 'personne_physique') ? 'selected' : ''; ?>>👤 Personne Physique</option>
                                <option value="personne_morale" <?php echo ($t === 'personne_morale') ? 'selected' : ''; ?>>🏢 Personne Morale</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Numéro NPI / IFU *</label>
                            <input type="text" name="npi" class="form-control font-monospace" value="<?php echo htmlspecialchars($_POST['npi'] ?? $proprietaire['npi']); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Numéro de Téléphone *</label>
                            <input type="text" name="telephone" class="form-control" value="<?php echo htmlspecialchars($_POST['telephone'] ?? $proprietaire['telephone']); ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="bento-card mb-4 border-0 shadow-sm h-100">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-box" style="background-color: var(--md-secondary-container); color: var(--md-on-secondary-container);">
                            <span class="material-symbols-outlined fs-5">lock_open</span>
                        </div>
                        <h4 class="h5 m-0 fw-bold">Sécurité & Identifiants</h4>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-muted">Email de connexion (Identifiant) *</label>
                        <input type="email" name="email_connexion" class="form-control font-monospace" value="<?php echo htmlspecialchars($_POST['email_connexion'] ?? $proprietaire['email_connexion']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Autoriser la connexion *</label>
                        <select name="compte_actif" class="form-select" required>
                            <?php $ca = $_POST['compte_actif'] ?? $proprietaire['compte_actif']; ?>
                            <option value="oui" <?php echo ($ca === 'oui') ? 'selected' : ''; ?>>🟢 Compte activé</option>
                            <option value="non" <?php echo ($ca === 'non') ? 'selected' : ''; ?>>🔴 Compte bloqué / suspendu</option>
                        </select>
                        <small class="text-muted d-block mt-2">Le blocage du compte empêche le propriétaire d'initier de nouvelles ventes en ligne sur l'Espace Consultant.</small>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
            <a href="/foncier_gloV3/admin/proprietaires/show.php?id=<?php echo $id; ?>" class="btn btn-light border fw-semibold text-muted px-4 py-2 rounded-3">Annuler</a>
            <button type="submit" class="btn text-white fw-semibold px-4 py-2 rounded-3 d-flex align-items-center gap-2" style="background-color: var(--md-primary-container);">
                <span class="material-symbols-outlined fs-5">save</span> Sauvegarder les modifications
            </button>
        </div>
    </form>

</div>

<?php require_once '../../includes/footer.php'; ?>