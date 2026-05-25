<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id   = (int)$_GET['id'];
$conn = getConnexion();

$sql = "SELECT p.*,
               pr.nom AS prop_nom,
               pr.prenom AS prop_prenom,
               pr.telephone AS prop_tel,
               pr.npi AS prop_npi,
               u.nom AS agent_nom,
               u.prenom AS agent_prenom
        FROM parcelles p
        LEFT JOIN proprietaires pr
        ON p.proprietaire_id = pr.id
        LEFT JOIN users u
        ON p.agent_id = u.id
        WHERE p.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$parcelle = $stmt->get_result()->fetch_assoc();

if (!$parcelle) {
    header('Location: index.php');
    exit();
}

$litiges = $conn->query(
    "SELECT * FROM litiges
     WHERE parcelle_id = $id
     ORDER BY created_at DESC"
)->fetch_all(MYSQLI_ASSOC);

$alertes = $conn->query(
    "SELECT * FROM alertes
     WHERE parcelle_id = $id
     ORDER BY created_at DESC"
)->fetch_all(MYSQLI_ASSOC);

$titre = "Détails — " . $parcelle['reference_cadastrale'];
$conn->close();
?>
<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<main>
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between
                align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <i class="fas fa-draw-polygon me-2"></i>
            Détails de la Parcelle
        </h4>
        <div class="d-flex gap-2">
            <a href="edit.php?id=<?php echo $id; ?>"
               class="btn btn-warning">
                <i class="fas fa-pen me-2"></i>
                Modifier
            </a>
            <a href="index.php"
               class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Retour
            </a>
        </div>
    </div>

    <div class="row g-4">

        <!-- Infos parcelle -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header fw-bold text-white"
                     style="background:linear-gradient(
                            135deg,#1F4E79,#2E75B6)">
                    <i class="fas fa-info-circle me-2"></i>
                    Informations de la Parcelle
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold text-muted w-50">
                                <i class="fas fa-hashtag me-1"></i>
                                Référence
                            </td>
                            <td class="fw-bold text-primary">
                                <?php echo $parcelle['reference_cadastrale']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-ruler-combined me-1"></i>
                                Superficie
                            </td>
                            <td>
                                <?php echo number_format(
                                    $parcelle['superficie'], 2
                                ); ?> m²
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-map-pin me-1"></i>
                                Arrondissement
                            </td>
                            <td>
                                <?php echo $parcelle['arrondissement']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-home me-1"></i>
                                Village/Quartier
                            </td>
                            <td>
                                <?php echo $parcelle['village_quartier']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-tag me-1"></i>
                                Type terrain
                            </td>
                            <td>
                                <?php echo ucfirst($parcelle['type_terrain']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-traffic-light me-1"></i>
                                Statut
                            </td>
                            <td>
                                <?php
                                $c = match($parcelle['statut']) {
                                    'libre'    => 'success',
                                    'attribue' => 'primary',
                                    'litige'   => 'danger',
                                    'reserve'  => 'warning',
                                    default    => 'secondary'
                                };
                                ?>
                                <span class="badge bg-<?php echo $c; ?>
                                             badge-status">
                                    <?php echo ucfirst($parcelle['statut']); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-globe me-1"></i>
                                GPS
                            </td>
                            <td>
                                <?php echo $parcelle['latitude']; ?>,
                                <?php echo $parcelle['longitude']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-user-cog me-1"></i>
                                Agent
                            </td>
                            <td>
                                <?php echo $parcelle['agent_prenom']
                                    . ' ' . $parcelle['agent_nom']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Date
                            </td>
                            <td>
                                <?php echo date('d/m/Y H:i',
                                    strtotime($parcelle['created_at'])
                                ); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Propriétaire + Carte -->
        <div class="col-md-6">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header fw-bold text-white"
                     style="background:linear-gradient(
                            135deg,#6C3483,#9B59B6)">
                    <i class="fas fa-user-tie me-2"></i>
                    Propriétaire
                </div>
                <div class="card-body">
                    <?php if ($parcelle['prop_nom']): ?>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="fw-bold text-muted w-50">
                                <i class="fas fa-user me-1"></i>
                                Nom complet
                            </td>
                            <td class="fw-bold">
                                <?php echo $parcelle['prop_prenom']
                                    . ' ' . $parcelle['prop_nom']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-id-card me-1"></i>
                                NPI
                            </td>
                            <td>
                                <?php echo $parcelle['prop_npi']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">
                                <i class="fas fa-phone me-1"></i>
                                Téléphone
                            </td>
                            <td>
                                <?php echo $parcelle['prop_tel']; ?>
                            </td>
                        </tr>
                    </table>
                    <?php else: ?>
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-user-slash fa-2x mb-2 d-block"></i>
                        Aucun propriétaire assigné
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Carte Leaflet -->
            <div class="card border-0 shadow-sm">
                <div class="card-header fw-bold text-white"
                     style="background:linear-gradient(
                            135deg,#0E6655,#1ABC9C)">
                    <i class="fas fa-map-marked-alt me-2"></i>
                    Localisation GPS
                </div>
                <div class="card-body p-2">
                    <div id="carte-parcelles"></div>
                </div>
            </div>

        </div>

        <!-- Litiges -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header d-flex
                            justify-content-between
                            fw-bold text-white"
                     style="background:linear-gradient(
                            135deg,#D35400,#E67E22)">
                    <span>
                        <i class="fas fa-balance-scale me-2"></i>
                        Litiges
                    </span>
                    <a href="/foncier_gloV3/pages/litiges/create.php
                       ?parcelle_id=<?php echo $id; ?>"
                       class="btn btn-sm btn-light text-danger fw-bold">
                        <i class="fas fa-plus me-1"></i>
                        Déclarer
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Référence</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($litiges)): ?>
                            <tr>
                                <td colspan="4"
                                    class="text-center
                                           text-muted py-3">
                                    <i class="fas fa-check-double
                                       text-success me-1"></i>
                                    Aucun litige
                                </td>
                            </tr>
                        <?php else: ?>
                        <?php foreach ($litiges as $l): ?>
                            <tr>
                                <td><?php echo $l['reference']; ?></td>
                                <td>
                                    <?php echo ucfirst(str_replace(
                                        '_', ' ', $l['type']
                                    )); ?>
                                </td>
                                <td>
                                    <?php
                                    $c = match($l['statut']) {
                                        'ouvert'   => 'danger',
                                        'en_cours' => 'warning',
                                        'resolu'   => 'success',
                                        default    => 'secondary'
                                    };
                                    ?>
                                    <span class="badge bg-<?php echo $c; ?>">
                                        <?php echo ucfirst($l['statut']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo date('d/m/Y',
                                        strtotime($l['created_at'])
                                    ); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Alertes -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header fw-bold text-white"
                     style="background:linear-gradient(
                            135deg,#C0392B,#E74C3C)">
                    <i class="fas fa-radiation-alt me-2"></i>
                    Alertes
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Niveau</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($alertes)): ?>
                            <tr>
                                <td colspan="4"
                                    class="text-center
                                           text-muted py-3">
                                    <i class="fas fa-shield-alt
                                       text-success me-1"></i>
                                    Aucune alerte
                                </td>
                            </tr>
                        <?php else: ?>
                        <?php foreach ($alertes as $a): ?>
                            <tr>
                                <td><?php echo $a['code']; ?></td>
                                <td>
                                    <?php echo ucfirst(str_replace(
                                        '_', ' ', $a['type']
                                    )); ?>
                                </td>
                                <td>
                                    <?php
                                    $c = match($a['niveau']) {
                                        'critique' => 'danger',
                                        'warning'  => 'warning',
                                        default    => 'info'
                                    };
                                    ?>
                                    <span class="badge bg-<?php echo $c; ?>">
                                        <?php echo ucfirst($a['niveau']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo date('d/m/Y',
                                        strtotime($a['created_at'])
                                    ); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</main>

<script>
var lat = <?php echo $parcelle['latitude']; ?>;
var lng = <?php echo $parcelle['longitude']; ?>;
var ref = "<?php echo $parcelle['reference_cadastrale']; ?>";

var carte = L.map('carte-parcelles').setView([lat, lng], 15);

L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    { attribution: '© OpenStreetMap' }
).addTo(carte);

var icone = L.divIcon({
    className: 'custom-icon',
    html: '<i class="fas fa-map-marker-alt" '
        + 'style="color:#E74C3C;font-size:28px;"></i>',
    iconSize: [28, 28]
});

L.marker([lat, lng], { icon: icone })
 .addTo(carte)
 .bindPopup('<b>📍 ' + ref + '</b>')
 .openPopup();
</script>

<?php require_once '../../includes/footer.php'; ?>