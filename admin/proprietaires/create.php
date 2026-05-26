<?php
// admin/proprietaires/create.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// NOUVELLE RÈGLE : Seul l'Agent SADE peut inscrire de nouveaux propriétaires
requiertRole(['agent_sade']);

$titre   = "Enregistrer un Propriétaire";
$erreurs = [];
$succes_creation = false;
$identifiants_generes = [];
$conn    = getConnexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom       = nettoyer($_POST['nom']);
    $prenom    = nettoyer($_POST['prenom']);
    $npi       = nettoyer($_POST['npi']);
    $telephone = nettoyer($_POST['telephone']);
    $type      = nettoyer($_POST['type']); // 'personne_physique' ou 'personne_morale'
    $email     = nettoyer($_POST['email']); // Utilisé comme email_connexion

    // Validations de base
    if (empty($nom)) $erreurs[] = 'Le nom est obligatoire.';
    if (empty($prenom)) $erreurs[] = 'Le prénom est obligatoire.';
    if (empty($telephone)) $erreurs[] = 'Le numéro de téléphone est obligatoire.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = 'Une adresse email valide est obligatoire pour la création du compte Consultant.';
    }

    // Vérification de l'unicité du NPI et de l'Email
    if (empty($erreurs)) {
        $stmt_check = $conn->prepare("SELECT id FROM proprietaires WHERE npi = ? OR email_connexion = ?");
        $stmt_check->bind_param('ss', $npi, $email);
        $stmt_check->execute();
        if ($stmt_check->get_result()->num_rows > 0) {
            $erreurs[] = 'Ce NPI/IFU ou cette adresse email existe déjà dans le système.';
        }
        $stmt_check->close();
    }

    if (empty($erreurs)) {
        // --- GÉNÉRATION AUTOMATIQUE DU COMPTE CONSULTANT ---
        // Génération d'un mot de passe aléatoire de 8 caractères
        $chaine = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ!@#';
        $mot_de_passe_clair = substr(str_shuffle($chaine), 0, 8);
        $mot_de_passe_hash  = password_hash($mot_de_passe_clair, PASSWORD_DEFAULT);
        $compte_actif       = 'oui';

        $sql = "INSERT INTO proprietaires (
                    nom, prenom, npi, telephone, type, 
                    email_connexion, password_connexion, compte_actif
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'ssssssss',
            $nom, $prenom, $npi, $telephone, $type,
            $email, $mot_de_passe_hash, $compte_actif
        );

        if ($stmt->execute()) {
            $succes_creation = true;
            // On sauvegarde les accès en clair juste pour les afficher à l'agent une seule fois
            $identifiants_generes = [
                'email' => $email,
                'password' => $mot_de_passe_clair
            ];
        } else {
            $erreurs[] = 'Erreur lors de l\'enregistrement en base de données.';
        }
        $stmt->close();
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
                <li class="breadcrumb-item active" aria-current="page">Nouveau Propriétaire</li>
            </ol>
        </nav>
        <h2 class="h3 fw-bold" style="color: var(--md-primary);">Enregistrer un Propriétaire</h2>
        <p class="text-muted">Créez un profil pour un propriétaire et générez automatiquement son accès à l'Espace Consultant.</p>
    </div>

    <?php if ($succes_creation): ?>
        <div class="alert alert-success border border-success border-opacity-25 shadow-sm p-4 rounded-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-3">
                <span class="material-symbols-outlined fs-1 text-success">check_circle</span>
                <div>
                    <h4 class="alert-heading fw-bold mb-1">Propriétaire enregistré avec succès !</h4>
                    <p class="m-0">Le compte Consultant a été généré. Veuillez communiquer ces identifiants au propriétaire :</p>
                </div>
            </div>
            <hr class="border-success opacity-25">
            <div class="bg-white p-3 rounded-3 border border-success border-opacity-10 font-monospace">
                <p class="mb-2"><strong class="text-dark">Lien de connexion :</strong> <a href="/foncier_gloV3/login.php" class="text-decoration-none">/foncier_gloV3/login.php</a></p>
                <p class="mb-2"><strong class="text-dark">Email (Identifiant) :</strong> <span class="text-primary"><?php echo htmlspecialchars($identifiants_generes['email']); ?></span></p>
                <p class="mb-0"><strong class="text-dark">Mot de passe temporaire :</strong> <span class="text-danger fw-bold fs-5"><?php echo htmlspecialchars($identifiants_generes['password']); ?></span></p>
            </div>
            <div class="mt-3">
                <a href="/foncier_gloV3/admin/proprietaires/index.php" class="btn btn-success fw-semibold">Retour à l'annuaire</a>
                <a href="/foncier_gloV3/admin/proprietaires/create.php" class="btn btn-outline-success fw-semibold ms-2">Enregistrer un autre</a>
            </div>
        </div>
    <?php else: ?>

        <?php if (!empty($erreurs)): ?>
            <div class="alert alert-danger alert-dismissible fade show border-0" role="alert" style="background-color: var(--md-error-container); color: var(--md-on-error-container);">
                <ul class="mb-0">
                    <?php foreach ($erreurs as $e): ?><li><?php echo $e; ?></li><?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="row g-4">
                
                <div class="col-12 col-lg-8">
                    <div class="bento-card mb-4 shadow-sm border-0">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-box" style="background-color: var(--md-primary-container); color: var(--md-on-primary-container);">
                                <span class="material-symbols-outlined fs-5">badge</span>
                            </div>
                            <h4 class="h5 m-0 fw-bold">Informations Civiles ou Morales</h4>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Nom / Raison Sociale *</label>
                                <input type="text" name="nom" class="form-control" placeholder="Ex: DUPONT" value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Prénom (Si personne physique) *</label>
                                <input type="text" name="prenom" class="form-control" placeholder="Ex: Jean" value="<?php echo htmlspecialchars($_POST['prenom'] ?? ''); ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Type de propriétaire *</label>
                                <select name="type" class="form-select" required>
                                    <option value="personne_physique" <?php echo (isset($_POST['type']) && $_POST['type'] == 'personne_physique') ? 'selected' : ''; ?>>👤 Personne Physique</option>
                                    <option value="personne_morale" <?php echo (isset($_POST['type']) && $_POST['type'] == 'personne_morale') ? 'selected' : ''; ?>>🏢 Personne Morale (Entreprise/État)</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Numéro Personnel d'Identification (NPI / IFU)</label>
                                <input type="text" name="npi" class="form-control font-monospace" placeholder="Ex: 1234567890" value="<?php echo htmlspecialchars($_POST['npi'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="bento-card mb-4 shadow-sm border-0 h-100">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-box" style="background-color: var(--md-secondary-container); color: var(--md-on-secondary-container);">
                                <span class="material-symbols-outlined fs-5">contact_mail</span>
                            </div>
                            <h4 class="h5 m-0 fw-bold">Contact & Accès</h4>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Téléphone *</label>
                            <input type="text" name="telephone" class="form-control" placeholder="Ex: +229 00 00 00 00" value="<?php echo htmlspecialchars($_POST['telephone'] ?? ''); ?>" required>
                        </div>

                        <hr class="text-muted opacity-25 my-4">
                        
                        <div class="alert bg-light border p-3 rounded-3">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-primary fs-5">lock_person</span>
                                <span class="fw-bold text-dark small text-uppercase tracking-wider">Espace Consultant</span>
                            </div>
                            <p class="small text-muted mb-3">L'adresse email saisie ci-dessous servira d'identifiant de connexion pour le propriétaire. Le mot de passe sera généré automatiquement.</p>
                            
                            <label class="form-label small fw-semibold text-muted">Adresse Email (Identifiant) *</label>
                            <input type="email" name="email" class="form-control" placeholder="nom@exemple.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
                <a href="/foncier_gloV3/admin/proprietaires/index.php" class="btn btn-light border fw-semibold text-muted px-4 py-2 rounded-3">Annuler</a>
                <button type="submit" class="btn text-white fw-semibold px-4 py-2 rounded-3 d-flex align-items-center gap-2" style="background-color: var(--md-primary-container);">
                    <span class="material-symbols-outlined fs-5">how_to_reg</span>
                    Enregistrer et générer l'accès
                </button>
            </div>
        </form>
    <?php endif; ?>

</div>

<?php require_once '../../includes/footer.php'; ?>