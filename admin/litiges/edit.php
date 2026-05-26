<?php
// admin/litiges/edit.php
require_once '../../config/session.php';
require_once '../../config/database.php';

requiertRole(['agent_sade']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id'];
$erreurs = [];
$conn = getConnexion();

$sql = "SELECT l.*, p.reference_cadastrale FROM litiges l JOIN parcelles p ON l.parcelle_id = p.id WHERE l.id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$litige = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$litige) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reference   = nettoyer($_POST['reference']);
    $type        = nettoyer($_POST['type']);
    $description = nettoyer($_POST['description']);

    if (empty($reference)) $erreurs[] = "La référence est obligatoire.";
    if (empty($type)) $erreurs[] = "La nature du conflit est requise.";
    if (empty($description)) $erreurs[] = "La description textuelle ne peut pas être vide.";

    $stmt_check = $conn->prepare("SELECT id FROM litiges WHERE reference = ? AND id != ?");
    $stmt_check->bind_param('si', $reference, $id);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        $erreurs[] = "Cette référence de litige est déjà affectée à un autre dossier.";
    }
    $stmt_check->close();

    if (empty($erreurs)) {
        $sql_update = "UPDATE litiges SET reference = ?, type = ?, description = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param('sssi', $reference, $type, $description, $id);

        if ($stmt_update->execute()) {
            flashMessage('success', "Le dossier contentieux a été mis à jour.");
            header("Location: /foncier_gloV3/admin/litiges/show.php?id=" . $id);
            exit();
        } else {
            $erreurs[] = "Erreur technique de mise à jour.";
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
        <h2 class="h3 fw-bold" style="color: var(--md-primary);">Modifier les Données du Litige</h2>
        <p class="text-muted">Corrigez l'intitulé ou enrichissez les termes de la réclamation.</p>
    </div>

    <?php if (!empty($erreurs)): ?>
        <div class="alert alert-danger border-0">
            <ul class="mb-0">
                <?php foreach ($erreurs as $e): ?><li><?php echo htmlspecialchars($e); ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="bento-card bg-white shadow-sm border-0 p-4">
                <form method="POST">
                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-muted">Référence du litige *</label>
                        <input type="text" name="reference" class="form-control font-monospace fw-bold" value="<?php echo htmlspecialchars($_POST['reference'] ?? $litige['reference']); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-muted">Parcelle immobilisée (Non modifiable)</label>
                        <input type="text" class="form-control font-monospace text-muted" value="<?php echo htmlspecialchars($litige['reference_cadastrale']); ?>" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-muted">Nature du conflit *</label>
                        <select name="type" class="form-select" required>
                            <?php $t = $_POST['type'] ?? $litige['type']; ?>
                            <option value="double_attribution" <?php echo $t === 'double_attribution' ? 'selected' : ''; ?>>Double attribution</option>
                            <option value="bornage" <?php echo $t === 'bornage' ? 'selected' : ''; ?>>Contestation de bornage</option>
                            <option value="succession" <?php echo $t === 'succession' ? 'selected' : ''; ?>>Succession familiale</option>
                            <option value="usurpation" <?php echo $t === 'usurpation' ? 'selected' : ''; ?>>Usurpation</option>
                            <option value="autre" <?php echo $t === 'autre' ? 'selected' : ''; ?>>Autre</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-muted">Description détaillée des faits *</label>
                        <textarea name="description" class="form-control" rows="6" required><?php echo htmlspecialchars($_POST['description'] ?? $litige['description']); ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-3 pt-3 border-top">
                        <a href="/foncier_gloV3/admin/litiges/show.php?id=<?php echo $id; ?>" class="btn btn-light border">Annuler</a>
                        <button type="submit" class="btn text-white fw-semibold" style="background-color: var(--md-primary); border-radius: 8px;">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>