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

// ---- RÉCUPÉRER L'ALERTE ----
$sql = "SELECT a.*,
               p.reference_cadastrale,
               p.arrondissement,
               p.statut AS parcelle_statut,
               pr.nom AS prop_nom,
               pr.prenom AS prop_prenom,
               pr.telephone AS prop_tel
        FROM alertes a
        LEFT JOIN parcelles p
        ON a.parcelle_id = p.id
        LEFT JOIN proprietaires pr
        ON p.proprietaire_id = pr.id
        WHERE a.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$alerte = $stmt->get_result()->fetch_assoc();

// Si alerte introuvable
if (!$alerte) {
    header('Location: index.php');
    exit();
}

// ---- TRAITEMENT CHANGEMENT STATUT ----
if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['nouveau_statut'])) {

    $nouveau_statut = nettoyer($_POST['nouveau_statut']);
    $statuts_ok     = ['nouvelle', 'en_cours', 'resolue'];

    if (in_array($nouveau_statut, $statuts_ok)) {
        $sql  = "UPDATE alertes
                 SET statut = ?
                 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $nouveau_statut, $id);
        $stmt->execute();

        // Recharger la page
        header("Location: show.php?id=$id&success=1");
        exit();
    }
}

$titre = "Alerte — " . $alerte['code'];
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
            <i class="fas fa-bell me-2"></i>
            Détails de l'Alerte
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
        Statut de l'alerte mis à jour avec succès !
        <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="row g-4">

        <!-- ---- INFOS ALERTE ---- -->
        <div class="col-md-6">
            <div class="card alerte-<?php echo $alerte['niveau']; ?>">
                <div class="card-header">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    Informations de l'Alerte
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold text-muted w-50">
                                Code
                            </td>
                            <td class="fw-bold">
                                <?php echo $alerte['code']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Type</td>
                            <td>
                                <?php echo ucfirst(str_replace(
                                    '_', ' ', $alerte['type']
                                )); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Niveau
                            </td>
                            <td>
                                <?php
                                $c = match($alerte['niveau']) {
                                    'critique' => 'danger',
                                    'warning'  => 'warning',
                                    default    => 'info'
                                };
                                ?>
                                <span class="badge bg-<?php echo $c; ?>">
                                    <?php echo ucfirst($alerte['niveau']); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Statut actuel
                            </td>
                            <td>
                                <?php
                                $cs = match($alerte['statut']) {
                                    'nouvelle'  => 'danger',
                                    'en_cours'  => 'warning',
                                    'resolue'   => 'success',
                                    default     => 'secondary'
                                };
                                ?>
                                <span class="badge bg-<?php echo $cs; ?>">
                                    <?php echo ucfirst($alerte['statut']); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Date génération
                            </td>
                            <td>
                                <?php echo date('d/m/Y H:i',
                                    strtotime($alerte['created_at'])
                                ); ?>
                            </td>
                        </tr>
                    </table>

                    <!-- Message de l'alerte -->
                    <div class="mt-3">
                        <strong class="text-muted">
                            Message :
                        </strong>
                        <div class="alert alert-<?php echo $c; ?> mt-2">
                            <i class="fa-solid fa-circle-info me-2"></i>
                            <?php echo $alerte['message']; ?>
                        </div>
                    </div>

                    <!-- ---- CHANGER STATUT ---- -->
                    <div class="mt-3">
                        <strong class="text-muted">
                            Changer le statut :
                        </strong>
                        <form method="POST" class="mt-2">
                            <div class="d-flex gap-2">
                                <select name="nouveau_statut"
                                        class="form-select">
                                    <option value="nouvelle"
                                        <?php echo $alerte['statut']
                                            == 'nouvelle'
                                            ? 'selected' : ''; ?>>
                                        Nouvelle
                                    </option>
                                    <option value="en_cours"
                                        <?php echo $alerte['statut']
                                            == 'en_cours'
                                            ? 'selected' : ''; ?>>
                                        En cours
                                    </option>
                                    <option value="resolue"
                                        <?php echo $alerte['statut']
                                            == 'resolue'
                                            ? 'selected' : ''; ?>>
                                        Résolue
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

                </div>
            </div>
        </div>

        <!-- ---- INFOS PARCELLE CONCERNÉE ---- -->
        <div class="col-md-6">
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
                                <?php echo $alerte['reference_cadastrale']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Arrondissement
                            </td>
                            <td>
                                <?php echo $alerte['arrondissement']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Statut parcelle
                            </td>
                            <td>
                                <span class="badge-<?php
                                    echo $alerte['parcelle_statut']; ?>">
                                    <?php echo ucfirst(
                                        $alerte['parcelle_statut']
                                    ); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                Propriétaire
                            </td>
                            <td>
                                <?php echo $alerte['prop_nom']
                                    ? $alerte['prop_prenom']
                                      . ' ' . $alerte['prop_nom']
                                    : '—'; ?>
                            </td>
                        </tr>
                        <?php if ($alerte['prop_tel']): ?>
                        <tr>
                            <td class="fw-bold text-muted">
                                Téléphone
                            </td>
                            <td>
                                <?php echo $alerte['prop_tel']; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>

                    <!-- Lien vers la parcelle -->
                    <div class="mt-3">
                        <a href="../parcelles/show.php
                           ?id=<?php echo $alerte['parcelle_id']; ?>"
                           class="btn btn-outline-primary w-100">
                            <i class="fa-solid fa-eye me-2"></i>
                            Voir la parcelle complète
                        </a>
                    </div>

                </div>
            </div>

            <!-- ---- ACTIONS RAPIDES ---- -->
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-bolt me-2"></i>
                    Actions rapides
                </div>
                <div class="card-body d-flex
                            flex-column gap-2">
                    <a href="../litiges/create.php
                       ?parcelle_id=<?php echo $alerte['parcelle_id']; ?>"
                       class="btn btn-danger">
                        <i class="fa-solid fa-gavel me-2"></i>
                        Déclarer un litige
                    </a>
                    <a href="../parcelles/show.php
                       ?id=<?php echo $alerte['parcelle_id']; ?>"
                       class="btn btn-outline-primary">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Voir la parcelle
                    </a>
                    <a href="index.php"
                       class="btn btn-outline-secondary">
                        <i class="fa-solid fa-list me-2"></i>
                        Toutes les alertes
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
</main>

<?php require_once '../../includes/footer.php'; ?>