<?php
// admin/parcelles/create.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// NOUVELLE RÈGLE : Seul l'Agent SADE peut enregistrer de nouvelles parcelles
requiertRole(['agent_sade']);

$titre   = "Nouvelle Parcelle";
$erreurs = [];
$conn    = getConnexion();

$proprietaires = $conn->query("SELECT id, nom, prenom FROM proprietaires ORDER BY nom ASC")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reference    = nettoyer($_POST['reference_cadastrale']);
    $superficie   = nettoyer($_POST['superficie']);
    $latitude     = nettoyer($_POST['latitude']);
    $longitude    = nettoyer($_POST['longitude']);
    $arrondissem  = nettoyer($_POST['arrondissement']);
    $village      = nettoyer($_POST['village_quartier']);
    $type_terrain = nettoyer($_POST['type_terrain']);
    $description  = nettoyer($_POST['description']);
    $prop_id      = !empty($_POST['proprietaire_id']) ? (int)$_POST['proprietaire_id'] : null;

    if (empty($reference)) $erreurs[] = 'La référence cadastrale est obligatoire.';
    if (empty($superficie) || !is_numeric($superficie)) $erreurs[] = 'La superficie doit être un nombre valide.';
    if (empty($latitude) || !is_numeric($latitude)) $erreurs[] = 'La latitude GPS est obligatoire.';
    if (empty($longitude) || !is_numeric($longitude)) $erreurs[] = 'La longitude GPS est obligatoire.';
    if (empty($arrondissem)) $erreurs[] = 'L\'arrondissement est obligatoire.';
    if (empty($village)) $erreurs[] = 'Le village/quartier est obligatoire.';
    if (empty($prop_id)) $erreurs[] = 'Le rachat ou l\'attribution à un propriétaire est obligatoire.';

    $stmt = $conn->prepare("SELECT id FROM parcelles WHERE reference_cadastrale = ?");
    $stmt->bind_param('s', $reference);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $erreurs[] = 'Cette référence cadastrale existe déjà !';
    }

    if (empty($erreurs)) {
        $statut = 'attribue'; // Forcé à attribué puisqu'il y a obligatoirement un propriétaire
        
        $sql = "INSERT INTO parcelles (
                    reference_cadastrale, superficie, latitude, longitude,
                    arrondissement, village_quartier, type_terrain, statut, 
                    description, proprietaire_id, agent_id
                ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'sdddsssssii',
            $reference, $superficie, $latitude, $longitude,
            $arrondissem, $village, $type_terrain, $statut,
            $description, $prop_id, $_SESSION['user_id']
        );

        if ($stmt->execute()) {
            flashMessage('success', 'La parcelle a été enregistrée et attribuée avec succès.');
            header('Location: /foncier_gloV3/admin/parcelles/index.php');
            exit();
        } else {
            $erreurs[] = 'Erreur lors de l\'enregistrement.';
        }
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
                <li class="breadcrumb-item active" aria-current="page">Nouvelle Parcelle</li>
            </ol>
        </nav>
        <h2 class="h3 fw-bold" style="color: var(--md-primary);">Ajouter une Nouvelle Parcelle</h2>
    </div>

    <?php if (!empty($erreurs)): ?>
        <div class="alert alert-danger border-0">
            <ul class="mb-0">
                <?php foreach ($erreurs as $e): ?><li><?php echo $e; ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            <div class="col-12 col-lg-8">
                <div class="bento-card mb-4 border-0 shadow-sm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Référence Cadastrale *</label>
                            <input type="text" name="reference_cadastrale" class="form-control" placeholder="Ex: GLO/2024/001" value="<?php echo htmlspecialchars($_POST['reference_cadastrale'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Superficie (m²) *</label>
                            <input type="number" name="superficie" class="form-control" placeholder="0.00" step="0.01" value="<?php echo htmlspecialchars($_POST['superficie'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Arrondissement *</label>
                            <input type="text" name="arrondissement" class="form-control" placeholder="Ex: Glo-Djigbe" value="<?php echo htmlspecialchars($_POST['arrondissement'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Village / Quartier *</label>
                            <input type="text" name="village_quartier" class="form-control" placeholder="Ex: Zoungoudo" value="<?php echo htmlspecialchars($_POST['village_quartier'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Latitude (GPS) *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold text-primary">LAT</span>
                                <input type="number" name="latitude" class="form-control" step="0.0000001" value="<?php echo htmlspecialchars($_POST['latitude'] ?? ''); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Longitude (GPS) *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold text-primary">LNG</span>
                                <input type="number" name="longitude" class="form-control" step="0.0000001" value="<?php echo htmlspecialchars($_POST['longitude'] ?? ''); ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="bento-card mb-4 border-0 shadow-sm h-100">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Propriétaire Attribué *</label>
                        <select name="proprietaire_id" class="form-select" required>
                            <option value="">-- Choisir le propriétaire --</option>
                            <?php foreach ($proprietaires as $p): ?>
                                <option value="<?php echo $p['id']; ?>" <?php echo (isset($_POST['proprietaire_id']) && $_POST['proprietaire_id'] == $p['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($p['nom'] . ' ' . $p['prenom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Type de terrain *</label>
                        <select name="type_terrain" class="form-select" required>
                            <option value="residentiel">Résidentiel</option>
                            <option value="agricole">Agricole</option>
                            <option value="commercial">Commercial</option>
                            <option value="industriel">Industriel</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Notes supplémentaires</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
            <a href="/foncier_gloV3/admin/parcelles/index.php" class="btn btn-light border fw-semibold text-muted px-4 py-2 rounded-3">Annuler</a>
            <button type="submit" class="btn text-white fw-semibold px-4 py-2 rounded-3 d-flex align-items-center gap-2" style="background-color: var(--md-primary-container);">
                <span class="material-symbols-outlined fs-5">save</span> Enregistrer la parcelle
            </button>
        </div>
    </form>
</div>
<?php require_once '../../includes/footer.php'; ?>