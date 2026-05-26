<?php
// consultant/parcelles/show.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Sécurité : Vérifier la connexion active du consultant
if (!isset($_SESSION['user_id'])) {
    header('Location: /foncier_gloV3/login.php');
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$parcelle_id = (int)$_GET['id'];
$user_id     = (int)$_SESSION['user_id'];
$conn        = getConnexion();
$erreur      = '';

// Récupération sécurisée : On s'assure via la clause WHERE que la parcelle appartient bien au citoyen connecté
$sql = "SELECT * FROM parcelles WHERE id = ? AND proprietaire_id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $parcelle_id, $user_id);
$stmt->execute();
$parcelle = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Si aucune ligne ne correspond (ID invalide ou tentative de spoliation d'URL), redirection immédiate
if (!$parcelle) {
    $conn->close();
    header('Location: index.php');
    exit();
}

// Optionnel : Récupération de l'historique des litiges passés ou présents sur cette parcelle pour information du citoyen
$sql_litiges = "SELECT reference, type, statut, created_at FROM litiges WHERE parcelle_id = ? ORDER BY created_at DESC";
$stmt_l = $conn->prepare($sql_litiges);
$stmt_l->bind_param('i', $parcelle_id);
$stmt_l->execute();
$litiges_historique = $stmt_l->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_l->close();

$conn->close();

$titre = "Fiche Technique — " . htmlspecialchars($parcelle['reference_cadastrale']);
require_once '../../includes/header.php'; 
require_once '../../includes/navbar_consultant.php'; // Charge la Sidebar et la Topbar du consultant
?>

<div class="container-fluid p-4 p-md-5">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 bento-card border-0 shadow-sm p-4 bg-white">
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-large text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="background-color: var(--md-tertiary); width: 48px; height: 48px;">
                <span class="material-symbols-outlined fs-4">map</span>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h2 class="h4 font-monospace fw-bold m-0 text-dark"><?php echo htmlspecialchars($parcelle['reference_cadastrale']); ?></h2>
                    
                    <?php if ($parcelle['statut'] === 'litige'): ?>
                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2.5 py-1.5 rounded fw-semibold small">
                            ⚠️ Gelé / En Litige
                        </span>
                    <?php elseif ($parcelle['statut'] === 'reserve'): ?>
                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2.5 py-1.5 rounded fw-semibold small text-dark">
                            🔒 Réservée par l'État
                        </span>
                    <?php else: ?>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2.5 py-1.5 rounded fw-semibold small">
                            🟢 Titre Certifié & Validé
                        </span>
                    <?php endif; ?>
                </div>
                <p class="m-0 text-muted small mt-1">Situation : Arrondissement de <?php echo htmlspecialchars($parcelle['arrondissement'] . ' — ' . $parcelle['village_quartier']); ?></p>
            </div>
        </div>
        
        <div class="d-flex gap-2">
            <a href="/foncier_gloV3/consultant/parcelles/index.php" class="btn btn-light border text-muted fw-semibold d-flex align-items-center gap-2 px-3 shadow-sm" style="border-radius: 8px;">
                <span class="material-symbols-outlined fs-5">arrow_back</span> Retour
            </a>
            
            <?php if ($parcelle['statut'] === 'attribue'): ?>
                <a href="/foncier_gloV3/consultant/transferts/create.php?parcelle_id=<?php echo $parcelle_id; ?>" class="btn text-white fw-semibold d-flex align-items-center gap-2 px-4 shadow-sm" style="background-color: var(--md-tertiary); border-radius: 8px; border: none;">
                    <span class="material-symbols-outlined fs-5">sell</span> Mettre en vente ce bien
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-12 col-lg-4 d-flex flex-column gap-4">
            
            <div class="bento-card border-0 shadow-sm bg-white p-4">
                <h3 class="h6 text-dark fw-bold text-uppercase tracking-wider mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-primary fs-5">analytics</span>
                    Spécifications Cadastrales
                </h3>
                
                <div class="mb-3">
                    <small class="text-muted fw-semibold d-block mb-1">Superficie Certifiée</small>
                    <span class="text-dark fw-bold fs-4"><?php echo number_format($parcelle['superficie'], 2, ',', ' '); ?> m²</span>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted fw-semibold d-block mb-1">Type d'usage du sol</small>
                    <span class="text-dark fw-medium fs-6 bg-light border px-2.5 py-1 rounded d-inline-block"><?php echo ucfirst(htmlspecialchars($parcelle['type_terrain'])); ?></span>
                </div>

                <div class="mb-0">
                    <small class="text-muted fw-semibold d-block mb-1">Date d'homologation au registre</small>
                    <span class="text-muted small font-monospace"><?php echo date('d/m/Y à H:i', strtotime($parcelle['created_at'])); ?></span>
                </div>
            </div>

            <div class="bento-card border-0 shadow-sm bg-white p-4">
                <h3 class="h6 text-dark fw-bold text-uppercase tracking-wider mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-primary fs-5">shield</span>
                    Sécurité Juridique du Bien
                </h3>
                
                <?php if ($parcelle['statut'] === 'litige'): ?>
                    <div class="alert alert-danger border-0 d-flex gap-2 p-3 rounded-3 mb-0 align-items-start" style="background-color: var(--md-error-container); color: var(--md-on-error-container);">
                        <span class="material-symbols-outlined mt-0.5">warning</span>
                        <div class="small">
                            <strong class="d-block mb-1">Bien Foncier Verrouillé</strong>
                            Cette parcelle fait l'objet d'une procédure de litige active au registre de la mairie de Glo-Djigbé. Toute mutation en ligne est temporairement suspendue.
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-success border-0 d-flex gap-2 p-3 rounded-3 mb-0 align-items-center bg-success bg-opacity-10 text-success">
                        <span class="material-symbols-outlined">verified</span>
                        <div class="small fw-medium">Aucun contentieux foncier actif. Ce titre est parfaitement cessible en ligne.</div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($litiges_historique)): ?>
                    <div class="mt-4">
                        <small class="text-muted fw-bold d-block mb-2 text-uppercase tracking-wider" style="font-size: 0.7rem;">Dossiers enregistrés</small>
                        <div class="list-group list-group-flush border-top border-bottom small">
                            <?php foreach ($litiges_historique as $litige): ?>
                                <div class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center bg-transparent">
                                    <div>
                                        <span class="font-monospace text-dark d-block fw-semibold"><?php echo htmlspecialchars($litige['reference']); ?></span>
                                        <small class="text-muted"><?php echo ucfirst(str_replace('_', ' ', $litige['type'])); ?></small>
                                    </div>
                                    <span class="badge rounded-pill <?php echo $litige['statut'] === 'resolu' ? 'bg-success' : 'bg-danger'; ?> font-normal px-2 py-1">
                                        <?php echo ucfirst($litige['statut']); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <div class="col-12 col-lg-8">
            <div class="bento-card border-0 shadow-sm bg-white overflow-hidden p-0 d-flex flex-column" style="height: 520px;">
                <div class="p-3 px-4 border-bottom bg-light d-flex justify-content-between align-items-center">
                    <h5 class="m-0 h6 fw-bold text-dark d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-primary">public</span>
                        Géolocalisation Satellite & Bornage (WGS 84)
                    </h5>
                    <small class="text-muted font-monospace small">Lat: <?php echo number_format($parcelle['latitude'] ?? 6.3667, 4); ?> | Lng: <?php echo number_format($parcelle['longitude'] ?? 2.4333, 4); ?></small>
                </div>
                
                <div id="carte-consultant" class="w-100 flex-grow-1" style="background-color: #e2e8f0;"></div>
            </div>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Récupération sécurisée des coordonnées GPS transmises par le backend PHP
    var lat = <?php echo json_encode($parcelle['latitude'] ?? 6.3667); ?>;
    var lng = <?php echo json_encode($parcelle['longitude'] ?? 2.4333); ?>;
    var ref = <?php echo json_encode($parcelle['reference_cadastrale'] ?? 'Inconnue'); ?>;
    var isLitige = <?php echo json_encode($parcelle['statut'] === 'litige'); ?>;

    if (typeof L !== 'undefined' && lat && lng) {
        // Initialisation de l'instance Leaflet centrée sur la parcelle
        var carte = L.map('carte-consultant', { zoomControl: false }).setView([lat, lng], 16);
        
        // Repositionnement du contrôleur de zoom en haut à droite pour ne pas surcharger le design
        L.control.zoom({ position: 'topright' }).addTo(carte);

        // Chargement de la couche de tuiles OpenStreetMap cartographique standard
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap — Système Foncier Glo Bénin'
        }).addTo(carte);

        // Définition de la couleur du périmètre (Rouge si litige actif, sinon bleu technique du cadastre)
        var marqueurCouleur = isLitige ? '#EF4444' : '#0B61A1';

        // Tracé géométrique circulaire simulant le périmètre certifié du domaine
        L.circle([lat, lng], {
            color: marqueurCouleur,
            fillColor: marqueurCouleur,
            fillOpacity: 0.15,
            radius: 60
        }).addTo(carte);

        // Configuration d'un marqueur personnalisé Material Symbols Outlined
        var iconeProprietaire = L.divIcon({
            className: 'custom-pin-citoyen',
            html: `<span class="material-symbols-outlined" style="font-size:36px; color:${marqueurCouleur}; font-variation-settings: 'FILL' 1;">location_on</span>`,
            iconSize: [36, 36],
            iconAnchor: [18, 36]
        });

        // Liaison du marqueur et ouverture de l'infobulle contextuelle au chargement
        L.marker([lat, lng], { icon: iconeProprietaire }).addTo(carte)
         .bindPopup(`<b>📍 Propriété : ${ref}</b><br>Statut vérifié conforme au cadastre.`)
         .openPopup();
    }
});
</script>

<?php require_once '../../includes/footer.php'; ?>