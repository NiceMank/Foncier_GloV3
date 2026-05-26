<?php
// admin/users/create.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Seuls l'Admin et le Chef ont le droit d'habiliter des profils
requiertRole(['administrateur', 'chef_service']);

$titre = "Habiliter un employé";
$role_user = $_SESSION['user_role'];
$erreurs = [];
$conn = getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom      = nettoyer($_POST['nom']);
    $prenom   = nettoyer($_POST['prenom']);
    $email    = nettoyer($_POST['email']);
    $password = $_POST['password'];
    
    // Détermination forcée du rôle selon les directives métiers
    $role_attribue = ($role_user === 'administrateur') ? 'chef_service' : 'agent_sade';

    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        $erreurs[] = "Tous les champs marqués d'un astérisque sont obligatoires.";
    }

    if (empty($erreurs)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $actif = 1;

        // SOLUTION AU CRASH SQL : Génération d'un matricule unique
        $prefix = ($role_attribue === 'chef_service') ? 'CDS-' : 'AGT-';
        $matricule = $prefix . date('Y') . '-' . strtoupper(substr(uniqid(), -4));

        // On ajoute le matricule dans la requête INSERT
        $stmt = $conn->prepare("INSERT INTO users (matricule, nom, prenom, email, password, role, actif) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssi', $matricule, $nom, $prenom, $email, $password_hash, $role_attribue, $actif);
        
        if ($stmt->execute()) {
            flashMessage('success', "Le compte de l'employé a été créé avec le rôle : " . ($role_attribue === 'chef_service' ? 'Chef de Service' : 'Agent SADE') . " (Matricule : $matricule)");
            header('Location: index.php');
            exit();
        } else {
            $erreurs[] = "Cette adresse email ou ce matricule est déjà attribué, ou une erreur serveur est survenue.";
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
        <h2 class="h3 fw-bold text-dark">Ajouter un Collaborateur</h2>
        <p class="text-muted small">
            <?php echo $role_user === 'administrateur' ? 'En tant qu\'Administrateur, vous créez exclusivement des <strong>Chefs de Service</strong>.' : 'En tant que Chef de Service, vous créez exclusivement des <strong>Agents SADE</strong>.'; ?>
        </p>
    </div>

    <?php if(!empty($erreurs)): ?><div class="alert alert-danger border-0"><?php echo implode('<br>', $erreurs); ?></div><?php endif; ?>

    <div class="bento-card bg-white shadow-sm border-0 col-12 col-xl-8 p-4">
        <form method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold text-muted">Nom de famille *</label>
                    <input type="text" name="nom" class="form-control" required placeholder="Ex: ASSOGBA">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold text-muted">Prénom *</label>
                    <input type="text" name="prenom" class="form-control" required placeholder="Ex: Chantal">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold text-muted">Adresse Email Professionnelle *</label>
                    <input type="email" name="email" class="form-control font-monospace" required placeholder="nom@foncier.bj">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold text-muted">Mot de passe initial *</label>
                    <input type="password" name="password" class="form-control" required placeholder="Minimum 6 caractères">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold text-muted">Rôle système affecté d'office (Verrouillé)</label>
                    <input type="text" class="form-control bg-light fw-bold text-primary" value="<?php echo $role_user === 'administrateur' ? '💼 Chef de Service' : '🔍 Agent SADE'; ?>" readonly>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
                <a href="index.php" class="btn btn-light border fw-semibold text-muted px-4">Annuler</a>
                <button type="submit" class="btn text-white fw-semibold px-4" style="background-color: var(--md-primary); border-radius: 8px;">Habiliter le collaborateur</button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>