<?php
// Sécurité : connexion obligatoire
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

// Vérifier que l'ID est fourni
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id   = (int)$_GET['id'];
$conn = getConnexion();

// ---- RÉCUPÉRER LE LITIGE ----
$sql = "SELECT l.*,
               p.reference_cadastrale,
               p.arrondissement,
               p.village_quartier,
               p.statut AS parcelle_statut,
               p.id AS parcelle_id,
               pr.nom AS prop_nom,
               pr.prenom AS prop_prenom,
               pr.telephone AS prop_tel,
               u.nom AS agent_nom,
               u.prenom AS agent_prenom
        FROM litiges l
        LEFT JOIN parcelles p
        ON l.parcelle_id = p.id
        LEFT JOIN proprietaires pr
        ON p.proprietaire_id = pr.id
        LEFT JOIN users u
        ON l.agent_id = u.id
        WHERE l.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$litige = $stmt->get_result()->fetch_assoc();

// Si litige introuvable
if (!$litige) {
    header('Location: index.php');
    exit();
}

// ---- TRAITEMENT CHANGEMENT STATUT ----
if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['nouveau_statut'])) {

    $nouveau_statut = nettoyer($_POST['nouveau_statut']);
    $statuts_ok     = ['ouvert', 'en_cours', 'resolu', 'classe'];

    if (in_array($nouveau_statut, $statuts_ok)) {

        // Mettre à jour le statut du litige
        $date_resolution = $nouveau_statut == 'resolu'
                         ? date('Y-m-d H:i:s') : null;

        $sql  = "UPDATE litiges
                 SET statut = ?,
                     date_resolution = ?
                 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'ssi',
            $nouveau_statut,
            $date_resolution,
            $id
        );
        $stmt->execute();

        // Si résolu → remettre statut parcelle à libre
        if ($nouveau_statut == 'resolu'
            || $nouveau_statut == 'classe') {
            $sql_p = "UPDATE parcelles
                      SET statut = 'libre'
                      WHERE id = ?";
            $stmt2 = $conn->prepare($sql_p);
            $stmt2->bind_param('i', $litige['parcelle_id']);
            $stmt2->execute();
        }

        header("Location: show.php?id=$id&success=1");
        exit();
    }
}

$titre = "Litige — " . $litige['reference'];
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
            <i class="fas fa-gavel me-2"></i>
            Détails du Litige
        </h4>
        <a href="index.php"
           class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Retour
        </a>
    </div>

    <!-- Message succès -->
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible">
        <i class="fas fa-check-circle me-2"></i>
        Statut du litige mis à jour avec succès !
        <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="row g-4">

        <!-- ---- INFOS LITIGE ---- -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-gavel me-2"></i>
                    Informations du Litige
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold text-muted w-50">
                                Référence
                            </td>
                            <td class="fw-bold">
                                <?php echo $litige['reference']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Type
                            </td>
                            <td>
                                <?php echo ucfirst(str_replace(
                                    '_', ' ', $litige['type']
                                )); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Statut actuel
                            </td>
                            <td>
                                <?php
                                $c = match($litige['statut']) {
                                    'ouvert'   => 'danger',
                                    'en_cours' => 'warning',
                                    'resolu'   => 'success',
                                    default    => 'secondary'
                                };
                                ?>
                                <span class="badge bg-<?php echo $c; ?>">
                                    <?php echo ucfirst($litige['statut']); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Agent responsable
                            </td>
                            <td>
                                <?php echo $litige['agent_prenom']
                                    . ' ' . $litige['agent_nom']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Date déclaration
                            </td>
                            <td>
                                <?php echo date('d/m/Y H:i',
                                    strtotime($litige['created_at'])
                                ); ?>
                            </td>
                        </tr>
                        <?php if ($litige['date_resolution']): ?>
                        <tr>
                            <td class="fw-bold text-muted">
                                Date résolution
                            </td>
                            <td class="text-success fw-bold">
                                <?php echo date('d/m/Y H:i',
                                    strtotime($litige['date_resolution'])
                                ); ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>

                    <!-- Description -->
                    <div class="mt-3">
                        <strong class="text-muted">
                            Description :
                        </strong>
                        <p class="mt-2 p-3 bg-light rounded">
                            <?php echo $litige['description']; ?>
                        </p>
                    </div>

                    <!-- ---- CHANGER STATUT ---- -->
                    <?php if ($litige['statut'] != 'resolu'
                        && $litige['statut'] != 'classe'): ?>
                    <div class="mt-3">
                        <strong class="text-muted">
                            Mettre à jour le statut :
                        </strong>
                        <form method="POST" class="mt-2">
                            <div class="d-flex gap-2">
                                <select name="nouveau_statut"
                                        class="form-select">
                                    <option value="ouvert"
                                        <?php echo $litige['statut']
                                            == 'ouvert'
                                            ? 'selected' : ''; ?>>
                                        🔴 Ouvert
                                    </option>
                                    <option value="en_cours"
                                        <?php echo $litige['statut']
                                            == 'en_cours'
                                            ? 'selected' : ''; ?>>
                                        🟡 En cours
                                    </option>
                                    <option value="resolu"
                                        <?php echo $litige['statut']
                                            == 'resolu'
                                            ? 'selected' : ''; ?>>
                                        🟢 Résolu
                                    </option>
                                    <option value="classe">
                                        ⚫ Classé
                                    </option>
                                </select>
                                <button type="submit"
                                        class="btn btn-primary">
                                    <i class="fa-solid fa-floppy-disk me-1"></i>
                                    Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-success mt-3">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        Ce litige est
                        <strong>
                            <?php echo $litige['statut'] == 'resolu'
                                ? 'résolu' : 'classé'; ?>
                        </strong>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- ---- COLONNE DROITE ---- -->
        <div class="col-md-6">

            <!-- Parcelle concernée -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    Parcelle concernée
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="fw-bold text-muted w-50">
                                Référence
                            </td>
                            <td class="fw-bold">
                                <?php echo $litige['reference_cadastrale']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Arrondissement
                            </td>
                            <td>
                                <?php echo $litige['arrondissement']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Village
                            </td>
                            <td>
                                <?php echo $litige['village_quartier']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Statut parcelle
                            </td>
                            <td>
                                <span class="badge-<?php
                                    echo $litige['parcelle_statut']; ?>">
                                    <?php echo ucfirst(
                                        $litige['parcelle_statut']
                                    ); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Propriétaire
                            </td>
                            <td>
                                <?php echo $litige['prop_nom']
                                    ? $litige['prop_prenom']
                                      . ' ' . $litige['prop_nom']
                                    : '—'; ?>
                            </td>
                        </tr>
                        <?php if ($litige['prop_tel']): ?>
                        <tr>
                            <td class="fw-bold text-muted">
                                Téléphone
                            </td>
                            <td>
                                <?php echo $litige['prop_tel']; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>

                    <a href="../parcelles/show.php
                       ?id=<?php echo $litige['parcelle_id']; ?>"
                       class="btn btn-outline-primary w-100 mt-3">
                        <i class="fa-solid fa-eye me-2"></i>
                        Voir la parcelle complète
                    </a>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-bolt me-2"></i>
                    Actions rapides
                </div>
                <div class="card-body d-flex
                            flex-column gap-2">
                    <a href="../parcelles/show.php
                       ?id=<?php echo $litige['parcelle_id']; ?>"
                       class="btn btn-outline-primary">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Voir la parcelle
                    </a>
                    <a href="../alertes/index.php"
                       class="btn btn-outline-danger">
                        <i class="fa-solid fa-bell me-2"></i>
                        Voir les alertes
                    </a>
                    <a href="index.php"
                       class="btn btn-outline-secondary">
                        <i class="fa-solid fa-list me-2"></i>
                        Tous les litiges
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
</main>

<?php require_once '../../includes/footer.php'; ?>