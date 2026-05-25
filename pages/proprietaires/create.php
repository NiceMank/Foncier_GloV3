<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

$titre   = "Nouveau Propriétaire";
$erreurs = [];
$conn    = getConnexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom            = nettoyer($_POST['nom']);
    $prenom         = nettoyer($_POST['prenom']);
    $npi            = nettoyer($_POST['npi']);
    $telephone      = nettoyer($_POST['telephone']);
    $email          = nettoyer($_POST['email']);
    $adresse        = nettoyer($_POST['adresse']);
    $type           = nettoyer($_POST['type']);
    $piece_identite = nettoyer($_POST['piece_identite']);

    if (empty($nom))       $erreurs[] = 'Le nom est obligatoire.';
    if (empty($prenom))    $erreurs[] = 'Le prénom est obligatoire.';
    if (empty($npi))       $erreurs[] = 'Le NPI est obligatoire.';
    if (empty($telephone)) $erreurs[] = 'Le téléphone est obligatoire.';
    if (empty($adresse))   $erreurs[] = 'L\'adresse est obligatoire.';

    // Vérifier NPI unique
    $sql_check = "SELECT id FROM proprietaires WHERE npi = ?";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param('s', $npi);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $erreurs[] = 'Ce NPI existe déjà !';
    }

    if (empty($erreurs)) {
        $sql = "INSERT INTO proprietaires 
                (nom, prenom, npi, telephone, 
                 email, adresse, type, piece_identite)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'ssssssss',
            $nom, $prenom, $npi, $telephone,
            $email, $adresse, $type, $piece_identite
        );
        if ($stmt->execute()) {
            header('Location: index.php?success=1');
            exit();
        }
    }
}
$conn->close();
?>
<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<main>
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between
                align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <span class="material-symbols-outlined me-2">person_add</span>
            Nouveau Propriétaire
        </h4>
        <a href="index.php"
           class="btn btn-outline-secondary">
             <span class="material-symbols-outlined me-2">arrow_back</span>
            Retour
        </a>
    </div>

    <?php if (!empty($erreurs)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($erreurs as $e): ?>
                <li><?php echo $e; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <span class="material-symbols-outlined me-2">person</span>
            Informations du propriétaire
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nom *</label>
                        <input type="text"
                            name="nom"
                            class="form-control"
                            placeholder="Ex: AGOSSA"
                            value="<?php echo htmlspecialchars(
                                $_POST['nom'] ?? ''
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Prénom *</label>
                        <input type="text"
                            name="prenom"
                            class="form-control"
                            placeholder="Ex: Jean"
                            value="<?php echo htmlspecialchars(
                                $_POST['prenom'] ?? ''
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">NPI *</label>
                        <input type="text"
                            name="npi"
                            class="form-control"
                            placeholder="Ex: 123456789"
                            value="<?php echo htmlspecialchars(
                                $_POST['npi'] ?? ''
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Téléphone *
                        </label>
                        <input type="text"
                            name="telephone"
                            class="form-control"
                            placeholder="Ex: 97000000"
                            value="<?php echo htmlspecialchars(
                                $_POST['telephone'] ?? ''
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            placeholder="Ex: jean@gmail.com"
                            value="<?php echo htmlspecialchars(
                                $_POST['email'] ?? ''
                            ); ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Type *</label>
                        <select name="type"
                                class="form-select" required>
                            <option value="personne_physique">
                                👤 Personne Physique
                            </option>
                            <option value="personne_morale">
                                🏢 Personne Morale
                            </option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Adresse *</label>
                        <textarea name="adresse"
                            class="form-control"
                            rows="2"
                            placeholder="Ex: Quartier Zoungoudo, Glo-Djigbe"
                            required><?php echo htmlspecialchars(
                                $_POST['adresse'] ?? ''
                            ); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Pièce d'identité
                        </label>
                        <input type="text"
                            name="piece_identite"
                            class="form-control"
                            placeholder="Ex: CNI-123456"
                            value="<?php echo htmlspecialchars(
                                $_POST['piece_identite'] ?? ''
                            ); ?>">
                    </div>

                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit"
                            class="btn btn-primary">
                        <span class="material-symbols-outlined me-2">save</span>
                        Enregistrer
                    </button>
                    <a href="index.php"
                       class="btn btn-outline-secondary">
                        <span class="material-symbols-outlined me-2">close</span>
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
</main>

<?php require_once '../../includes/footer.php'; ?>