<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id      = (int)$_GET['id'];
$conn    = getConnexion();
$erreurs = [];

$stmt = $conn->prepare(
    "SELECT * FROM parcelles WHERE id = ?"
);
$stmt->bind_param('i', $id);
$stmt->execute();
$parcelle = $stmt->get_result()->fetch_assoc();

if (!$parcelle) {
    header('Location: index.php');
    exit();
}

$proprietaires = $conn->query(
    "SELECT id, nom, prenom
     FROM proprietaires ORDER BY nom ASC"
)->fetch_all(MYSQLI_ASSOC);

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
    $prop_id      = !empty($_POST['proprietaire_id'])
                    ? (int)$_POST['proprietaire_id']
                    : null;

    if (empty($reference))
        $erreurs[] = 'La référence est obligatoire.';
    if (empty($superficie) || !is_numeric($superficie))
        $erreurs[] = 'La superficie doit être un nombre.';
    if (empty($arrondissem))
        $erreurs[] = 'L\'arrondissement est obligatoire.';

    if (empty($erreurs)) {
        $sql = "UPDATE parcelles SET
                    reference_cadastrale = ?,
                    superficie           = ?,
                    latitude             = ?,
                    longitude            = ?,
                    arrondissement       = ?,
                    village_quartier     = ?,
                    type_terrain         = ?,
                    statut               = ?,
                    description          = ?,
                    proprietaire_id      = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'sdddsssssii',
            $reference, $superficie,
            $latitude, $longitude,
            $arrondissem, $village,
            $type_terrain, $statut,
            $description, $prop_id, $id
        );

        if ($stmt->execute()) {
            header('Location: index.php?success=update');
            exit();
        } else {
            $erreurs[] = 'Erreur lors de la mise à jour.';
        }
    }
}

$titre = "Modifier Parcelle";
$conn->close();
?>
<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<main>
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between
                align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <i class="fas fa-pen me-2"></i>
            Modifier la Parcelle
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

    <div class="card border-0 shadow-sm">
        <div class="card-header fw-bold text-white"
             style="background:linear-gradient(
                    135deg,#D35400,#E67E22)">
            <i class="fas fa-pen me-2"></i>
            Modifier les informations
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-hashtag me-1
                               text-primary"></i>
                            Référence cadastrale *
                        </label>
                        <input type="text"
                            name="reference_cadastrale"
                            class="form-control"
                            value="<?php echo htmlspecialchars(
                                $_POST['reference_cadastrale']
                                ?? $parcelle['reference_cadastrale']
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-ruler-combined me-1
                               text-primary"></i>
                            Superficie (m²) *
                        </label>
                        <input type="number"
                            name="superficie"
                            class="form-control"
                            step="0.01" min="1"
                            value="<?php echo
                                $_POST['superficie']
                                ?? $parcelle['superficie']; ?>"
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
                            step="0.0000001"
                            value="<?php echo
                                $_POST['latitude']
                                ?? $parcelle['latitude']; ?>"
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
                            step="0.0000001"
                            value="<?php echo
                                $_POST['longitude']
                                ?? $parcelle['longitude']; ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-map-pin me-1
                               text-primary"></i>
                            Arrondissement *
                        </label>
                        <input type="text"
                            name="arrondissement"
                            class="form-control"
                            value="<?php echo htmlspecialchars(
                                $_POST['arrondissement']
                                ?? $parcelle['arrondissement']
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-home me-1
                               text-primary"></i>
                            Village / Quartier *
                        </label>
                        <input type="text"
                            name="village_quartier"
                            class="form-control"
                            value="<?php echo htmlspecialchars(
                                $_POST['village_quartier']
                                ?? $parcelle['village_quartier']
                            ); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-tag me-1
                               text-primary"></i>
                            Type de terrain *
                        </label>
                        <select name="type_terrain"
                                class="form-select" required>
                            <?php
                            $types = [
                                'residentiel' => '🏘️ Résidentiel',
                                'agricole'    => '🌾 Agricole',
                                'commercial'  => '🏪 Commercial',
                                'industriel'  => '🏭 Industriel'
                            ];
                            foreach ($types as $v => $l):
                                $sel = (
                                    ($_POST['type_terrain']
                                    ?? $parcelle['type_terrain'])
                                    == $v
                                ) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $v; ?>"
                                    <?php echo $sel; ?>>
                                <?php echo $l; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-traffic-light me-1
                               text-primary"></i>
                            Statut *
                        </label>
                        <select name="statut"
                                class="form-select" required>
                            <?php
                            $statuts = [
                                'libre'    => '🟢 Libre',
                                'attribue' => '🔵 Attribué',
                                'litige'   => '🔴 Litige',
                                'reserve'  => '🟡 Réservé',
                                'vendu'    => '⚫ Vendu'
                            ];
                            foreach ($statuts as $v => $l):
                                $sel = (
                                    ($_POST['statut']
                                    ?? $parcelle['statut'])
                                    == $v
                                ) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $v; ?>"
                                    <?php echo $sel; ?>>
                                <?php echo $l; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user-tie me-1
                               text-primary"></i>
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
                                    ($_POST['proprietaire_id']
                                    ?? $parcelle['proprietaire_id'])
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
                            <i class="fas fa-align-left me-1
                               text-primary"></i>
                            Description
                        </label>
                        <textarea name="description"
                            class="form-control"
                            rows="3">
<?php echo htmlspecialchars(
    $_POST['description']
    ?? $parcelle['description']
); ?>
                        </textarea>
                    </div>

                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit"
                            class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>
                        Mettre à jour
                    </button>
                    <a href="show.php?id=<?php echo $id; ?>"
                       class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
</main>

<?php require_once '../../includes/footer.php'; ?>