<?php
// admin/parcelles/edit.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// NOUVELLE RÈGLE : Seul l'Agent SADE peut modifier les parcelles
requiertRole(['agent_sade']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /foncier_gloV3/admin/parcelles/index.php');
    exit();
}

$id = (int)$_GET['id'];
$erreurs = [];
$conn = getConnexion();

$sql_parcelle = "SELECT * FROM parcelles WHERE id = ?";
$stmt_parcelle = $conn->prepare($sql_parcelle);
$stmt_parcelle->bind_param('i', $id);
$stmt_parcelle->execute();
$parcelle = $stmt_parcelle->get_result()->fetch_assoc();
$stmt_parcelle->close();

if (!$parcelle) {
    header('Location: /foncier_gloV3/admin/parcelles/index.php');
    exit();
}

$proprietaires = $conn->query("SELECT id, nom, prenom FROM proprietaires ORDER BY nom ASC")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reference    = nettoyer($_POST['reference_cadastrale']);
    $superficie   = nettoyer($_POST['superficie']);
    $latitude     = nettoyer($_POST['latitude']);
    $longitude    = nettoyer($_POST['longitude']);
    $arrondissem  = nettoyer($_POST['arrondissement']);
    $village      = nettoyer($_POST['village_quartier']);
    $type_terrain = nettoyer($_POST['type_terrain']);
    $statut       = nettoyer($_POST['statut']);
    $description  = nettoyer($_POST['description']);
    $prop_id      = !empty($_POST['proprietaire_id']) ? (int)$_POST['proprietaire_id'] : null;

    if (empty($reference)) $erreurs[] = 'La référence cadastrale est obligatoire.';
    if (empty($superficie) || !is_numeric($superficie)) $erreurs[] = 'La superficie doit être un nombre valide.';
    if (empty($latitude) || !is_numeric($latitude)) $erreurs[] = 'La latitude GPS est obligatoire.';
    if (empty($longitude) || !is_numeric($longitude)) $erreurs[] = 'La longitude GPS est obligatoire.';
    if (empty($arrondissem)) $erreurs[] = 'L\'arrondissement est obligatoire.';
    if (empty($village)) $erreurs[] = 'Le village/quartier est obligatoire.';
    if (empty($prop_id)) $erreurs[] = 'Le propriétaire est obligatoire.';

    $stmt_check = $conn->prepare("SELECT id FROM parcelles WHERE reference_cadastrale = ? AND id != ?");
    $stmt_check->bind_param('si', $reference, $id);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        $erreurs[] = 'Cette référence cadastrale est déjà attribuée.';
    }
    $stmt_check->close();

    if (empty($erreurs)) {
        $sql_update = "UPDATE parcelles SET 
                        reference_cadastrale = ?, superficie = ?, latitude = ?, longitude = ?, 
                        arrondissement = ?, village_quartier = ?, type_terrain = ?, statut = ?, 
                        description = ?, proprietaire_id = ? WHERE id = ?";

        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param(
            'sdddsssssii',
            $reference, $superficie, $latitude, $longitude,
            $arrondissem, $village, $type_terrain, $statut,
            $description, $prop_id, $id
        );

        if ($stmt_update->execute()) {
            flashMessage('success', 'Les modifications de la parcelle ont été enregistrées.');
            header('Location: /foncier_gloV3/admin/parcelles/show.php?id=' . $id);
            exit();
        } else {
            $erreurs[] = 'Erreur lors de la mise à jour.';
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
                <li class="breadcrumb-item"><a href="/foncier_gloV3/admin/parcelles/index.php" class="text-decoration-none">Registre Cadastral</a></li>
                <li class="breadcrumb-item"><a href="/foncier_gloV3/admin/parcelles/show.php?id=<?php echo $id; ?>" class="text-decoration-none">Fiche Parcelle</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifier</li>
            </ol>
        </nav>
        <h2 class="h3 fw-bold" style="color: var(--md-primary);">Modifier la Parcelle</h2>
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
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Référence Cadastrale *</label>
                            <input type="text" name="reference_cadastrale" class="form-control" value="<?php echo htmlspecialchars($parcelle['reference_cadastrale']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Superficie (m²) *</label>
                            <input type="number" name="superficie" class="form-control" step="0.01" value="<?php echo htmlspecialchars($parcelle['superficie']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Arrondissement *</label>
                            <input type="text" name="arrondissement" class="form-control" value="<?php echo htmlspecialchars($parcelle['arrondissement']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Village / Quartier *</label>
                            <input type="text" name="village_quartier" class="form-control" value="<?php echo htmlspecialchars($parcelle['village_quartier']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Latitude (GPS) *</label>
                            <input type="number" name="latitude" class="form-control" step="0.0000001" value="<?php echo htmlspecialchars($parcelle['latitude']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Longitude (GPS) *</label>
                            <input type="number" name="longitude" class="form-control" step="0.0000001" value="<?php echo htmlspecialchars($parcelle['longitude']); ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="bento-card mb-4 border-0 shadow-sm h-100">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Statut de la parcelle *</label>
                        <select name="statut" class="form-select" required>
                            <?php $s_actuel = $parcelle['statut']; ?>
                            <option value="attribue" <?php echo $s_actuel === 'attribue' ? 'selected' : ''; ?>>🔵 Attribuée</option>
                            <option value="litige" <?php echo $s_actuel === 'en_litige' || $s_actuel === 'litige' ? 'selected' : ''; ?>>🔴 En litige</option>
                            <option value="reserve" <?php echo $s_actuel === 'reserve' ? 'selected' : ''; ?>>🟡 Réservée</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Propriétaire *</label>
                        <select name="proprietaire_id" class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <?php foreach ($proprietaires as $p): ?>
                                <option value="<?php echo $p['id']; ?>" <?php echo $parcelle['proprietaire_id'] == $p['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($p['nom'] . ' ' . $p['prenom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Type de terrain *</label>
                        <select name="type_terrain" class="form-select" required>
                            <option value="residentiel" <?php echo $parcelle['type_terrain'] == 'residentiel' ? 'selected' : ''; ?>>Résidentiel</option>
                            <option value="agricole" <?php echo $parcelle['type_terrain'] == 'agricole' ? 'selected' : ''; ?>>Agricole</option>
                            <option value="commercial" <?php echo $parcelle['type_terrain'] == 'commercial' ? 'selected' : ''; ?>>Commercial</option>
                            <option value="industriel" <?php echo $parcelle['type_terrain'] == 'industriel' ? 'selected' : ''; ?>>Industriel</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
            <a href="/foncier_gloV3/admin/parcelles/show.php?id=<?php echo $id; ?>" class="btn btn-light border fw-semibold text-muted px-4 py-2 rounded-3">Annuler</a>
            <button type="submit" class="btn text-white fw-semibold px-4 py-2 rounded-3 d-flex align-items-center gap-2" style="background-color: var(--md-primary-container);">
                <span class="material-symbols-outlined fs-5">save</span> Sauvegarder les modifications
            </button>
        </div>
    </form>
</div>
<?php require_once '../../includes/footer.php'; ?>