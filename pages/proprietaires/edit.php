<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id      = (int)$_GET['id'];
$conn    = getConnexion();
$erreurs = [];

$sql  = "SELECT * FROM proprietaires WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$proprietaire = $stmt->get_result()->fetch_assoc();

if (!$proprietaire) {
    header('Location: index.php');
    exit();
}

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

    if (empty($erreurs)) {
        $sql = "UPDATE proprietaires SET
                    nom            = ?,
                    prenom         = ?,
                    npi            = ?,
                    telephone      = ?,
                    email          = ?,
                    adresse        = ?,
                    type           = ?,
                    piece_identite = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'ssssssssi',
            $nom, $prenom, $npi,
            $telephone, $email,
            $adresse, $type,
            $piece_identite, $id
        );

        if ($stmt->execute()) {
            header('Location: show.php?id=' . $id . '&success=1');
            exit();
        } else {
            $erreurs[] = 'Erreur lors de la mise à jour.';
        }
    }
}

$titre = "Modifier Propriétaire";
$conn->close();
?>
<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<main>
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between
                align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <span class="material-symbols-outlined me-2">edit</span>
            Modifier le Propriétaire
        </h4>
        <a href="show.php?id=<?php echo $id; ?>"
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
            <span class="material-symbols-outlined me-2">edit</span>
            Modifier les informations
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nom *</label>
                        <input type="text"
                            name="nom"
                            class="form-control"
                            value="<?php echo htmlspecialchars(
                                $_POST['nom'] ?? $proprietaire['nom']
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Prénom *</label>
                        <input type="text"
                            name="prenom"
                            class="form-control"
                            value="<?php echo htmlspecialchars(
                                $_POST['prenom'] ?? $proprietaire['prenom']
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">NPI *</label>
                        <input type="text"
                            name="npi"
                            class="form-control"
                            value="<?php echo htmlspecialchars(
                                $_POST['npi'] ?? $proprietaire['npi']
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Téléphone *</label>
                        <input type="text"
                            name="telephone"
                            class="form-control"
                            value="<?php echo htmlspecialchars(
                                $_POST['telephone']
                                ?? $proprietaire['telephone']
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            value="<?php echo htmlspecialchars(
                                $_POST['email'] ?? $proprietaire['email']
                            ); ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Type *</label>
                        <select name="type"
                                class="form-select" required>
                            <option value="personne_physique"
                                <?php echo (
                                    ($_POST['type'] ??
                                     $proprietaire['type'])
                                    == 'personne_physique'
                                ) ? 'selected' : ''; ?>>
                                👤 Personne Physique
                            </option>
                            <option value="personne_morale"
                                <?php echo (
                                    ($_POST['type'] ??
                                     $proprietaire['type'])
                                    == 'personne_morale'
                                ) ? 'selected' : ''; ?>>
                                🏢 Personne Morale
                            </option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Adresse *</label>
                        <textarea name="adresse"
                            class="form-control"
                            rows="2"
                            required><?php echo htmlspecialchars(
                                $_POST['adresse']
                                ?? $proprietaire['adresse']
                            ); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Pièce d'identité
                        </label>
                        <input type="text"
                            name="piece_identite"
                            class="form-control"
                            value="<?php echo htmlspecialchars(
                                $_POST['piece_identite']
                                ?? $proprietaire['piece_identite']
                            ); ?>">
                    </div>

                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit"
                            class="btn btn-warning">
                        <span class="material-symbols-outlined me-2">save</span>
                        Mettre à jour
                    </button>
                    <a href="show.php?id=<?php echo $id; ?>"
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