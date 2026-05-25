<?php
// Sécurité : connexion obligatoire
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

$titre   = "Déclarer un Litige";
$erreurs = [];
$conn    = getConnexion();

// Récupérer les parcelles
$sql_parcelles = "SELECT id, reference_cadastrale,
                         arrondissement
                  FROM parcelles
                  ORDER BY reference_cadastrale ASC";
$parcelles = $conn->query($sql_parcelles)
                  ->fetch_all(MYSQLI_ASSOC);

// Pré-remplir si vient d'une parcelle
$parcelle_id_pre = isset($_GET['parcelle_id'])
                   ? (int)$_GET['parcelle_id'] : null;

// ---- TRAITEMENT DU FORMULAIRE ----
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Récupérer et nettoyer
    $reference   = nettoyer($_POST['reference']);
    $type        = nettoyer($_POST['type']);
    $description = nettoyer($_POST['description']);
    $parcelle_id = (int)$_POST['parcelle_id'];

    // ---- VALIDATIONS ----
    if (empty($reference)) {
        $erreurs[] = 'La référence est obligatoire.';
    }
    if (empty($type)) {
        $erreurs[] = 'Le type de litige est obligatoire.';
    }
    if (empty($description)) {
        $erreurs[] = 'La description est obligatoire.';
    }
    if (empty($parcelle_id)) {
        $erreurs[] = 'La parcelle est obligatoire.';
    }

    // Vérifier référence unique
    $sql_check = "SELECT id FROM litiges
                  WHERE reference = ?";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param('s', $reference);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $erreurs[] = 'Cette référence de litige existe déjà !';
    }

    // ---- ENREGISTREMENT ----
    if (empty($erreurs)) {

        // Enregistrer le litige
        $sql = "INSERT INTO litiges (
                    reference,
                    type,
                    description,
                    statut,
                    parcelle_id,
                    agent_id
                ) VALUES (?, ?, ?, 'ouvert', ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'sssii',
            $reference,
            $type,
            $description,
            $parcelle_id,
            $_SESSION['user_id']
        );

        if ($stmt->execute()) {

            // Mettre à jour statut parcelle → litige
            $sql_update = "UPDATE parcelles
                           SET statut = 'litige'
                           WHERE id = ?";
            $stmt2 = $conn->prepare($sql_update);
            $stmt2->bind_param('i', $parcelle_id);
            $stmt2->execute();

            // Générer une alerte automatique
            $code_alerte = 'ALT/' . date('Y') . '/'
                         . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
            $message     = "Litige déclaré sur la parcelle. "
                         . "Référence : $reference. "
                         . "Type : $type.";

            $sql_alerte = "INSERT INTO alertes (
                               code,
                               type,
                               niveau,
                               message,
                               statut,
                               parcelle_id
                           ) VALUES (
                               ?, 'double_attribution',
                               'critique', ?, 'nouvelle', ?
                           )";
            $stmt3 = $conn->prepare($sql_alerte);
            $stmt3->bind_param(
                'ssi',
                $code_alerte,
                $message,
                $parcelle_id
            );
            $stmt3->execute();

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

    <!-- En-tête -->
    <div class="d-flex justify-content-between
                align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <span class="material-symbols-outlined me-2">gavel</span>
            Déclarer un Litige
        </h4>
        <a href="index.php"
           class="btn btn-outline-secondary">
            <span class="material-symbols-outlined me-2">arrow_back</span>
            Retour à la liste
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

    <!-- ---- FORMULAIRE ---- -->
    <div class="card">
        <div class="card-header bg-danger text-white">
            <span class="material-symbols-outlined me-2">warning</span>
            Informations du litige
        </div>
        <div class="card-body">
            <form method="POST">

                <div class="row g-3">

                    <!-- Référence -->
                    <div class="col-md-6">
                        <label class="form-label">
                            Référence du litige *
                        </label>
                        <input type="text"
                            name="reference"
                            class="form-control"
                            placeholder="Ex: LIT/2024/001"
                            value="<?php echo htmlspecialchars(
                                $_POST['reference'] ?? ''
                            ); ?>"
                            required>
                    </div>

                    <!-- Type -->
                    <div class="col-md-6">
                        <label class="form-label">
                            Type de litige *
                        </label>
                        <select name="type"
                                class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <option value="double_attribution"
                                <?php echo ($_POST['type'] ?? '')
                                    == 'double_attribution'
                                    ? 'selected' : ''; ?>>
                                Double attribution
                            </option>
                            <option value="bornage"
                                <?php echo ($_POST['type'] ?? '')
                                    == 'bornage'
                                    ? 'selected' : ''; ?>>
                                Bornage
                            </option>
                            <option value="succession"
                                <?php echo ($_POST['type'] ?? '')
                                    == 'succession'
                                    ? 'selected' : ''; ?>>
                                Succession
                            </option>
                            <option value="usurpation"
                                <?php echo ($_POST['type'] ?? '')
                                    == 'usurpation'
                                    ? 'selected' : ''; ?>>
                                Usurpation
                            </option>
                            <option value="autre"
                                <?php echo ($_POST['type'] ?? '')
                                    == 'autre'
                                    ? 'selected' : ''; ?>>
                                Autre
                            </option>
                        </select>
                    </div>

                    <!-- Parcelle -->
                    <div class="col-md-12">
                        <label class="form-label">
                            Parcelle concernée *
                        </label>
                        <select name="parcelle_id"
                                class="form-select" required>
                            <option value="">
                                -- Choisir une parcelle --
                            </option>
                            <?php foreach ($parcelles as $p): ?>
                            <option value="<?php echo $p['id']; ?>"
                                <?php echo (
                                    ($_POST['parcelle_id'] ??
                                     $parcelle_id_pre)
                                    == $p['id']
                                ) ? 'selected' : ''; ?>>
                                <?php echo $p['reference_cadastrale']
                                    . ' — '
                                    . $p['arrondissement']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label class="form-label">
                            Description du litige *
                        </label>
                        <textarea name="description"
                            class="form-control"
                            rows="5"
                            placeholder="Décrivez en détail le litige..."
                            required>
<?php echo htmlspecialchars(
    $_POST['description'] ?? ''
); ?>
                        </textarea>
                    </div>

                </div>

                <!-- Info alerte auto -->
                <div class="alert alert-warning mt-4">
                    <span class="material-symbols-outlined me-2">info</span>
                    <strong>Information :</strong>
                    La déclaration de ce litige va
                    automatiquement :
                    <ul class="mb-0 mt-1">
                        <li>Changer le statut de la parcelle
                            en <strong>"Litige"</strong></li>
                        <li>Générer une <strong>alerte critique</strong>
                            automatiquement</li>
                    </ul>
                </div>

                <!-- Boutons -->
                <div class="d-flex gap-2 mt-3">
                    <button type="submit"
                            class="btn btn-danger">
                        <span class="material-symbols-outlined me-2">gavel</span>
                        Déclarer le litige
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