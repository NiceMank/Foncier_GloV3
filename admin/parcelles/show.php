<?php
// admin/parcelles/show.php
require_once '../../config/session.php';
require_once '../../config/database.php';
// Accessible aux Admins, Agents et Chefs de service pour la consultation
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /foncier_gloV3/admin/parcelles/index.php');
    exit();
}

$id   = (int)$_GET['id'];
$conn = getConnexion();
$role_user = $_SESSION['user_role'] ?? '';

// Récupération de la parcelle, du propriétaire et de l'agent
$sql = "SELECT p.*,
               pr.nom AS prop_nom,
               pr.prenom AS prop_prenom,
               pr.telephone AS prop_tel,
               pr.npi AS prop_npi,
               u.nom AS agent_nom,
               u.prenom AS agent_prenom
        FROM parcelles p
        LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id
        LEFT JOIN users u ON p.agent_id = u.id
        WHERE p.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$parcelle = $stmt->get_result()->fetch_assoc();

if (!$parcelle) {
    header('Location: /foncier_gloV3/admin/parcelles/index.php');
    exit();
}

// Récupération des litiges
$litiges = $conn->query("SELECT * FROM litiges WHERE parcelle_id = $id ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);

// Récupération des alertes
$alertes = $conn->query("SELECT * FROM alertes WHERE parcelle_id = $id ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);

$titre = "Fiche Parcelle — " . htmlspecialchars($parcelle['reference_cadastrale']);
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 bento-card border-0 shadow-sm p-4">
        <div>
            <div class="d-flex align-items-center gap-3 mb-2">
                <h2 class="h3 m-0 fw-bold" style="color: var(--md-primary);">Fiche Parcelle</h2>
                <?php 
                    $badgeStatut = match($parcelle['statut']) {
                        'attribue' => 'bg-primary',
                        'litige'   => 'bg-danger',
                        'reserve'  => 'bg-warning text-dark',
                        default    => 'bg-secondary'
                    };
                    $texteStatut = match($parcelle['statut']) {
                        'attribue' => 'Attribuée',
                        'litige'   => 'En litige',
                        'reserve'  => 'Réservée',
                        default    => ucfirst($parcelle['statut'])
                    };
                ?>
                <span class="badge rounded-pill <?php echo $badgeStatut; ?> d-flex align-items-center gap-1 px-3 py-2 fw-medium">
                    <span class="material-symbols-outlined fs-6"><?php echo $parcelle['statut'] === 'litige' ? 'warning' : 'check_circle'; ?></span>
                    <?php echo $texteStatut; ?>
                </span>
            </div>
            <p class="fs-5 m-0 text-muted fw-semibold font-monospace tracking-wide">
                <?php echo htmlspecialchars($parcelle['reference_cadastrale']); ?>
            </p>
        </div>
        
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-light border text-primary fw-semibold d-flex align-items-center gap-2 px-4 shadow-sm" style="border-radius: 8px;">
                <span class="material-symbols-outlined fs-5">print</span> Imprimer
            </button>
            
            <?php if ($role_user === 'agent_sade'): ?>
                <a href="/foncier_gloV3/admin/parcelles/edit.php?id=<?php echo $id; ?>" class="btn text-white fw-semibold d-flex align-items-center gap-2 px-4 shadow-sm" style="background-color: var(--md-primary-container); border-radius: 8px;">
                    <span class="material-symbols-outlined fs-5">edit</span> Modifier
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php afficherFlash(); ?>

    <div class="row g-4">
        
        <div class="col-12 col-xl-5 d-flex flex-column gap-4">
            
            <div class="bento-card border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <h3 class="h5 m-0 fw-bold d-flex align-items-center gap-2" style="color: var(--md-primary);">
                        <span class="material-symbols-outlined" style="color: var(--md-primary-container);">person</span>
                        Titulaire / Propriétaire
                    </h3>
                </div>
                
                <?php if ($parcelle['proprietaire_id']): ?>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted fw-semibold d-block mb-1">Nom complet</small>
                            <span class="fw-bold text-dark fs-6"><?php echo htmlspecialchars($parcelle['prop_prenom'] . ' ' . $parcelle['prop_nom']); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted fw-semibold d-block mb-1">Identifiant unique</small>
                            <span class="text-dark font-monospace fw-medium"><?php echo htmlspecialchars($parcelle['prop_npi'] ?? 'N/A'); ?></span>
                        </div>
                        <div class="col-sm-12">
                            <small class="text-muted fw-semibold d-block mb-1">Contact</small>
                            <span class="text-dark"><?php echo htmlspecialchars($parcelle['prop_tel'] ?? 'N/A'); ?></span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4 text-muted">
                        <span class="material-symbols-outlined fs-1 mb-2 opacity-50">person_off</span>
                        <p class="m-0">Aucun propriétaire assigné</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="bento-card border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <h3 class="h5 m-0 fw-bold d-flex align-items-center gap-2" style="color: var(--md-primary);">
                        <span class="material-symbols-outlined" style="color: var(--md-primary-container);">gavel</span>
                        Données Cadastrales
                    </h3>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-bottom border-light">
                        <span class="text-muted fw-medium">Superficie</span>
                        <span class="fw-bold text-dark"><?php echo number_format($parcelle['superficie'], 2, ',', ' '); ?> m²</span>
                    </li>
                    <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-bottom border-light">
                        <span class="text-muted fw-medium">Localité</span>
                        <span class="text-dark text-end"><?php echo htmlspecialchars($parcelle['arrondissement'] . ' - ' . $parcelle['village_quartier']); ?></span>
                    </li>
                    <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-bottom border-light">
                        <span class="text-muted fw-medium">Type de terrain</span>
                        <span class="text-dark"><?php echo ucfirst(htmlspecialchars($parcelle['type_terrain'])); ?></span>
                    </li>
                    <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-bottom border-light">
                        <span class="text-muted fw-medium">Agent Enregistreur</span>
                        <span class="text-dark"><?php echo htmlspecialchars($parcelle['agent_prenom'] . ' ' . $parcelle['agent_nom']); ?></span>
                    </li>
                    <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                        <span class="text-muted fw-medium">Date d'enregistrement</span>
                        <span class="text-dark"><?php echo date('d/m/Y H:i', strtotime($parcelle['created_at'])); ?></span>
                    </li>
                </ul>
            </div>

            <div class="bento-card border-0 shadow-sm">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold" id="pills-litiges-tab" data-bs-toggle="pill" data-bs-target="#pills-litiges" type="button" role="tab">Litiges (<?php echo count($litiges); ?>)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold" id="pills-alertes-tab" data-bs-toggle="pill" data-bs-target="#pills-alertes" type="button" role="tab">Alertes (<?php echo count($alertes); ?>)</button>
                    </li>
                </ul>
                
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-litiges" role="tabpanel">
                        <?php if (empty($litiges)): ?>
                            <div class="text-center py-3 text-muted">
                                <span class="material-symbols-outlined text-success fs-2 mb-2">check_circle</span>
                                <p class="m-0 small">Aucun litige actif sur cette parcelle.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0">
                                    <tbody>
                                        <?php foreach ($litiges as $l): ?>
                                            <tr>
                                                <td class="fw-medium small"><?php echo htmlspecialchars($l['reference'] ?? 'N/A'); ?></td>
                                                <td>
                                                    <?php $c = ($l['statut'] == 'ouvert') ? 'danger' : (($l['statut'] == 'resolu') ? 'success' : 'warning'); ?>
                                                    <span class="badge bg-<?php echo $c; ?>"><?php echo ucfirst($l['statut']); ?></span>
                                                </td>
                                                <td class="text-end small text-muted"><?php echo date('d/m/Y', strtotime($l['created_at'])); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="tab-pane fade" id="pills-alertes" role="tabpanel">
                        <?php if (empty($alertes)): ?>
                            <div class="text-center py-3 text-muted">
                                <span class="material-symbols-outlined text-success fs-2 mb-2">shield</span>
                                <p class="m-0 small">Aucune alerte signalée.</p>
                            </div>
                        <?php else: ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($alertes as $a): ?>
                                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        <span class="small fw-medium"><?php echo ucfirst(str_replace('_', ' ', $a['type'])); ?></span>
                                        <?php $c = ($a['niveau'] == 'critique') ? 'danger' : (($a['niveau'] == 'warning') ? 'warning' : 'info'); ?>
                                        <span class="badge bg-<?php echo $c; ?>"><?php echo ucfirst($a['niveau']); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 col-xl-7">
            <div class="bento-card h-100 p-2 position-relative d-flex flex-column border-0 shadow-sm" style="min-height: 600px;">
                
                <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4 z-3">
                    <div class="bg-white px-4 py-3 rounded-pill shadow d-flex align-items-center gap-4 border" style="opacity: 0.95;">
                        <div class="d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined text-primary">explore</span>
                            <div>
                                <p class="m-0 text-muted" style="font-size: 0.65rem; text-transform: uppercase;">Coordonnées GPS</p>
                                <p class="m-0 fw-bold font-monospace small"><?php echo htmlspecialchars($parcelle['latitude']); ?>° N, <?php echo htmlspecialchars($parcelle['longitude']); ?>° E</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="carte-parcelles" class="w-100 flex-grow-1 rounded-3 z-1" style="background-color: #e9ecef;"></div>

            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var lat = <?php echo json_encode($parcelle['latitude']); ?>;
    var lng = <?php echo json_encode($parcelle['longitude']); ?>;
    var ref = <?php echo json_encode($parcelle['reference_cadastrale']); ?>;

    // Si Leaflet est bien chargé depuis header.php ou footer.php
    if (typeof L !== 'undefined') {
        var carte = L.map('carte-parcelles', {
            zoomControl: false // On désactive pour repositionner si on veut, ou on laisse par défaut
        }).setView([lat, lng], 16);

        // Ajout du bouton de zoom en haut à droite
        L.control.zoom({ position: 'topright' }).addTo(carte);

        // Couche OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap - Foncier Glo',
            maxZoom: 19
        }).addTo(carte);

        // Icône personnalisée moderne
        var icone = L.divIcon({
            className: 'custom-icon',
            html: '<div style="position:relative; display:flex; flex-direction:column; align-items:center;">' +
                  '<span class="material-symbols-outlined text-danger drop-shadow" style="font-size:40px; font-variation-settings: \'FILL\' 1;">location_on</span>' +
                  '<div style="width:12px; height:4px; background:rgba(0,0,0,0.3); border-radius:50%; filter:blur(1px); margin-top:-8px;"></div>' +
                  '</div>',
            iconSize: [40, 48],
            iconAnchor: [20, 48],
            popupAnchor: [0, -40]
        });

        // Marqueur
        L.marker([lat, lng], { icon: icone })
         .addTo(carte)
         .bindPopup('<div class="text-center p-1"><b class="d-block mb-1 text-primary">📍 ' + ref + '</b><small class="text-muted">Parcelle de Glo-Djigbé</small></div>')
         .openPopup();
    } else {
        console.error("Leaflet n'est pas chargé sur cette page.");
        document.getElementById('carte-parcelles').innerHTML = '<div class="d-flex h-100 align-items-center justify-content-center text-muted">Erreur: Carte indisponible.</div>';
    }
});
</script>

<style>
@media print {
    .sidebar-wrapper, .topbar, .btn {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
    }
    .bento-card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
}
</style>

<?php require_once '../../includes/footer.php'; ?>