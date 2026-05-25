<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

$titre   = "Nouvelle Parcelle";
$erreurs = [];
$conn    = getConnexion();

$proprietaires = $conn->query(
    "SELECT id, nom, prenom
     FROM proprietaires
     ORDER BY nom ASC"
)->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $reference    = nettoyer($_POST['reference_cadastrale']);
    $superficie   = nettoyer($_POST['superficie']);
    $latitude     = nettoyer($_POST['latitude']);
    $longitude    = nettoyer($_POST['longitude']);
    $arrondissem  = nettoyer($_POST['arrondissement']);
    $village      = nettoyer($_POST['village_quartier']);
    $type_terrain = nettoyer($_POST['type_terrain']);
    $description  = nettoyer($_POST['description']);
    $prop_id      = !empty($_POST['proprietaire_id'])
                    ? (int)$_POST['proprietaire_id']
                    : null;

    if (empty($reference))
        $erreurs[] = 'La référence cadastrale est obligatoire.';
    if (empty($superficie) || !is_numeric($superficie))
        $erreurs[] = 'La superficie doit être un nombre valide.';
    if (empty($latitude) || !is_numeric($latitude))
        $erreurs[] = 'La latitude GPS est obligatoire.';
    if (empty($longitude) || !is_numeric($longitude))
        $erreurs[] = 'La longitude GPS est obligatoire.';
    if (empty($arrondissem))
        $erreurs[] = 'L\'arrondissement est obligatoire.';
    if (empty($village))
        $erreurs[] = 'Le village/quartier est obligatoire.';

    // Vérifier référence unique
    $stmt = $conn->prepare(
        "SELECT id FROM parcelles
         WHERE reference_cadastrale = ?"
    );
    $stmt->bind_param('s', $reference);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $erreurs[] = 'Cette référence cadastrale existe déjà !';
    }

    if (empty($erreurs)) {
        $statut = $prop_id ? 'attribue' : 'libre';
        $sql    = "INSERT INTO parcelles (
                    reference_cadastrale, superficie,
                    latitude, longitude,
                    arrondissement, village_quartier,
                    type_terrain, statut, description,
                    proprietaire_id, agent_id
                  ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'sdddsssssii',
            $reference, $superficie,
            $latitude, $longitude,
            $arrondissem, $village,
            $type_terrain, $statut,
            $description, $prop_id,
            $_SESSION['user_id']
        );

        if ($stmt->execute()) {
            header('Location: index.php?success=create');
            exit();
        } else {
            $erreurs[] = 'Erreur lors de l\'enregistrement.';
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
            <span class="material-symbols-outlined me-2">add_circle</span>
            Nouvelle Parcelle
        </h4>
        <a href="index.php"
           class="btn btn-outline-secondary">
            <span class="material-symbols-outlined me-2">arrow_back</span>
            Retour
        </a>
    </div>

    <?php if (!empty($erreurs)): ?>
    <div class="alert alert-danger">
        <span class="material-symbols-outlined me-2">warning</span>
        <strong>Erreurs :</strong>
        <ul class="mb-0 mt-2">
            <?php foreach ($erreurs as $e): ?>
                <li><?php echo $e; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-header fw-bold text-white"
             style="background:linear-gradient(
                    135deg,#1F4E79,#2E75B6)">
            <span class="material-symbols-outlined me-2">draw_polygon</span>
            Informations de la parcelle
        </div>
        <div class="card-body">
            <form method="POST"
                  enctype="multipart/form-data">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span class="material-symbols-outlined me-1
                               text-primary">tag</span>
                            Référence cadastrale *
                        </label>
                        <input type="text"
                            name="reference_cadastrale"
                            class="form-control"
                            placeholder="Ex: GLO/2024/001"
                            value="<?php echo htmlspecialchars(
                                $_POST['reference_cadastrale'] ?? ''
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span class="material-symbols-outlined me-1
                               text-primary">straighten</span>
                            Superficie (m²) *
                        </label>
                        <input type="number"
                            name="superficie"
                            class="form-control"
                            placeholder="Ex: 250.50"
                            step="0.01" min="1"
                            value="<?php echo
                                $_POST['superficie'] ?? ''; ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-globe me-1
                               text-primary"></i>
                            Latitude GPS *
                        </label>
                        <input type="number"
                            name="latitude"
                            class="form-control"
                            placeholder="Ex: 6.3654127"
                            step="0.0000001"
                            value="<?php echo
                                $_POST['latitude'] ?? ''; ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-globe me-1
                               text-primary"></i>
                            Longitude GPS *
                        </label>
                        <input type="number"
                            name="longitude"
                            class="form-control"
                            placeholder="Ex: 2.3456789"
                            step="0.0000001"
                            value="<?php echo
                                $_POST['longitude'] ?? ''; ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span class="material-symbols-outlined me-1
                               text-primary">location_on</span>
                            Arrondissement *
                        </label>
                        <input type="text"
                            name="arrondissement"
                            class="form-control"
                            placeholder="Ex: Glo-Djigbe"
                            value="<?php echo htmlspecialchars(
                                $_POST['arrondissement'] ?? ''
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span class="material-symbols-outlined me-1
                               text-primary">home</span>
                            Village / Quartier *
                        </label>
                        <input type="text"
                            name="village_quartier"
                            class="form-control"
                            placeholder="Ex: Zoungoudo"
                            value="<?php echo htmlspecialchars(
                                $_POST['village_quartier'] ?? ''
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span class="material-symbols-outlined me-1
                               text-primary">local_offer</span>
                            Type de terrain *
                        </label>
                        <select name="type_terrain"
                                class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <option value="residentiel">
                                🏘️ Résidentiel
                            </option>
                            <option value="agricole">
                                🌾 Agricole
                            </option>
                            <option value="commercial">
                                🏪 Commercial
                            </option>
                            <option value="industriel">
                                🏭 Industriel
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <span class="material-symbols-outlined me-1
                               text-primary">person</span>
                            Propriétaire
                        </label>
                        <select name="proprietaire_id"
                                class="form-select">
                            <option value="">
                                -- Aucun propriétaire --
                            </option>
                            <?php foreach ($proprietaires as $p): ?>
                            <option value="<?php echo $p['id']; ?>"
                                <?php echo (
                                    ($_POST['proprietaire_id'] ?? '')
                                    == $p['id']
                                ) ? 'selected' : ''; ?>>
                                <?php echo $p['prenom']
                                    . ' ' . $p['nom']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <span class="material-symbols-outlined me-1
                               text-primary">format_align_left</span>
                            Description
                        </label>
                        <textarea name="description"
                            class="form-control"
                            rows="3"
                            placeholder="Informations supplémentaires...">
<?php echo htmlspecialchars(
    $_POST['description'] ?? ''
); ?>
                        </textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <span class="material-symbols-outlined me-1
                               text-primary">picture_as_pdf</span>
                            Titre foncier (PDF/Image)
                        </label>
                        <input type="file"
                            name="document_titre"
                            class="form-control"
                            accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted">
                            <span class="material-symbols-outlined me-1"></span>
                            Formats : PDF, JPG, PNG — Max 5MB
                        </small>
                    </div>

                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit"
                            class="btn btn-primary">
                        <span class="material-symbols-outlined me-2">save</span>
                        Enregistrer la parcelle
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