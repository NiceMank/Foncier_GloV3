<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

$titre = "Modifier un Litige";
$erreurs = [];
$conn  = getConnexion();

// Vérifier que l'ID est fourni
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id'];

// ---- RÉCUPÉRER LE LITIGE ----
$sql = "SELECT l.*, p.id AS parcelle_id
        FROM litiges l
        LEFT JOIN parcelles p ON l.parcelle_id = p.id
        WHERE l.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$litige = $stmt->get_result()->fetch_assoc();

if (!$litige) {
    header('Location: index.php');
    exit();
}

// Récupérer les parcelles pour le formulaire
$sql_parcelles = "SELECT id, reference_cadastrale, arrondissement
                  FROM parcelles ORDER BY reference_cadastrale ASC";
$parcelles = $conn->query($sql_parcelles)->fetch_all(MYSQLI_ASSOC);

// ---- TRAITEMENT DU FORMULAIRE ----
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $reference   = nettoyer($_POST['reference'] ?? '');
    $type        = nettoyer($_POST['type'] ?? '');
    $description = nettoyer($_POST['description'] ?? '');
    $parcelle_id = (int)($_POST['parcelle_id'] ?? 0);
    $statut      = nettoyer($_POST['statut'] ?? '');

    // Validations
    if (empty($reference)) {
        $erreurs[] = 'La référence est obligatoire.';
    }
    if (empty($type)) {
        $erreurs[] = 'Le type est obligatoire.';
    }
    if (empty($description)) {
        $erreurs[] = 'La description est obligatoire.';
    }
    if (empty($statut)) {
        $erreurs[] = 'Le statut est obligatoire.';
    }

    // Vérifier unicité de la référence (si modifiée)
    if ($reference !== $litige['reference']) {
        $sql_check = "SELECT id FROM litiges WHERE reference = ? AND id != ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param('si', $reference, $id);
        $stmt_check->execute();
        if ($stmt_check->get_result()->num_rows > 0) {
            $erreurs[] = 'Cette référence de litige existe déjà !';
        }
    }

    // Enregistrement
    if (empty($erreurs)) {
        $sql_update = "UPDATE litiges
                      SET reference = ?,
                          type = ?,
                          description = ?,
                          statut = ?,
                          parcelle_id = ?
                      WHERE id = ?";
        $stmt_up = $conn->prepare($sql_update);
        $stmt_up->bind_param('sssiii', $reference, $type, $description, $statut, $parcelle_id, $id);

        if ($stmt_up->execute()) {
            flashMessage('success', 'Litige modifié avec succès !');
            header('Location: show.php?id=' . $id);
            exit();
        } else {
            $erreurs[] = 'Erreur lors de la modification.';
        }
    }
} else {
    // Pré-remplir le formulaire
    $reference   = $litige['reference'];
    $type        = $litige['type'];
    $description = $litige['description'];
    $parcelle_id = $litige['parcelle_id'];
    $statut      = $litige['statut'];
}

$conn->close();
?>

<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<main>
<div class="container-fluid py-4">

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <span class="material-symbols-outlined me-2">edit</span>
            Modifier le Litige
        </h4>
        <a href="show.php?id=<?php echo $id; ?>" class="btn btn-outline-secondary">
            <span class="material-symbols-outlined me-2">arrow_back</span>
            Retour
        </a>
    </div>

    <!-- Messages d'erreurs -->
    <?php if (!empty($erreurs)): ?>
    <div class="alert alert-danger">
        <span class="material-symbols-outlined me-2">info</span>
        <strong>Erreurs :</strong>
        <ul class="mb-0 mt-2">
            <?php foreach ($erreurs as $erreur): ?>
                <li><?php echo $erreur; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <span class="material-symbols-outlined me-2">edit</span>
            Informations du Litige
        </div>
        <div class="card-body">
            <form method="POST">

                <div class="row g-3">

                    <!-- Référence -->
                    <div class="col-md-6">
                        <label class="form-label">Référence du litige *</label>
                        <input type="text"
                            name="reference"
                            class="form-control"
                            placeholder="Ex: LIT/2024/001"
                            value="<?php echo htmlspecialchars($reference); ?>"
                            required>
                    </div>

                    <!-- Type -->
                    <div class="col-md-6">
                        <label class="form-label">Type de litige *</label>
                        <select name="type" class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <option value="double_attribution" <?php echo $type === 'double_attribution' ? 'selected' : ''; ?>>
                                Double attribution
                            </option>
                            <option value="bornage" <?php echo $type === 'bornage' ? 'selected' : ''; ?>>
                                Bornage
                            </option>
                            <option value="succession" <?php echo $type === 'succession' ? 'selected' : ''; ?>>
                                Succession
                            </option>
                            <option value="usurpation" <?php echo $type === 'usurpation' ? 'selected' : ''; ?>>
                                Usurpation
                            </option>
                            <option value="autre" <?php echo $type === 'autre' ? 'selected' : ''; ?>>
                                Autre
                            </option>
                        </select>
                    </div>

                    <!-- Parcelle -->
                    <div class="col-md-6">
                        <label class="form-label">Parcelle concernée *</label>
                        <select name="parcelle_id" class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <?php foreach ($parcelles as $p): ?>
                            <option value="<?php echo $p['id']; ?>"
                                <?php echo $parcelle_id == $p['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($p['reference_cadastrale'] . ' — ' . $p['arrondissement']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Statut -->
                    <div class="col-md-6">
                        <label class="form-label">Statut *</label>
                        <select name="statut" class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <option value="ouvert" <?php echo $statut === 'ouvert' ? 'selected' : ''; ?>>
                                Ouvert
                            </option>
                            <option value="en_cours" <?php echo $statut === 'en_cours' ? 'selected' : ''; ?>>
                                En cours
                            </option>
                            <option value="resolu" <?php echo $statut === 'resolu' ? 'selected' : ''; ?>>
                                Résolu
                            </option>
                            <option value="ferme" <?php echo $statut === 'ferme' ? 'selected' : ''; ?>>
                                Fermé
                            </option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label class="form-label">Description du litige *</label>
                        <textarea name="description"
                            class="form-control"
                            rows="5"
                            placeholder="Décrivez le litige..."
                            required><?php echo htmlspecialchars($description); ?></textarea>
                    </div>

                </div>

                <!-- Boutons -->
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-warning">
                        <span class="material-symbols-outlined me-2">save</span>
                        Enregistrer les modifications
                    </button>
                    <a href="show.php?id=<?php echo $id; ?>" class="btn btn-outline-secondary">
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
