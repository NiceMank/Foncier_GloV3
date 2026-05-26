<?php
// admin/litiges/show.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Accessible à tout le staff (Admin, Agent SADE, Chef de Service)
requiertRole(['agent_sade']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id'];
$conn = getConnexion();
$erreur = '';

// Récupération complète du litige, de la parcelle, du titulaire et de l'agent
$query = "SELECT l.*,
                 p.id AS p_id, p.reference_cadastrale, p.arrondissement, p.village_quartier, p.superficie, p.type_terrain, p.latitude, p.longitude,
                 pr.nom AS prop_nom, pr.prenom AS prop_prenom, pr.telephone AS prop_tel, pr.npi AS prop_npi,
                 u.nom AS agent_nom, u.prenom AS agent_prenom
          FROM litiges l
          LEFT JOIN parcelles p ON l.parcelle_id = p.id
          LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id
          LEFT JOIN users u ON l.agent_id = u.id
          WHERE l.id = ? LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$litige = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$litige) {
    header('Location: index.php');
    exit();
}

// TRAITEMENT DE LA CLÔTURE JURIDIQUE ET DU DÉBLOCAGE AUTOMATIQUE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resolution_administrative'])) {
    $rapport = nettoyer($_POST['resolution_administrative']);
    
    if (empty($rapport)) {
        $erreur = "Veuillez rédiger le rapport de résolution avant de clôturer le dossier.";
    } else {
        $conn->begin_transaction();
        try {
            // A. Passage du litige au statut 'resolu' avec enregistrement du PV final
            $stmt_litige = $conn->prepare("UPDATE litiges SET statut = 'resolu', commentaire = ? WHERE id = ?");
            $stmt_litige->bind_param('si', $rapport, $id);
            $stmt_litige->execute();
            $stmt_litige->close();

            // B. Libération immédiate de la parcelle (Statut repasse à 'attribue')
            $stmt_parcelle = $conn->prepare("UPDATE parcelles SET statut = 'attribue' WHERE id = ?");
            $stmt_parcelle->bind_param('ii', $litige['p_id']);
            $stmt_parcelle->execute();
            $stmt_parcelle->close();

            $conn->commit();
            flashMessage('success', "Le litige a été résolu de manière définitive. La parcelle a été débloquée au cadastre.");
            header("Location: index.php");
            exit();

        } catch (Exception $e) {
            $conn->rollback();
            $erreur = "Erreur technique lors de la clôture du dossier : " . $e->getMessage();
        }
    }
}

$titre = "Résolution Conflit — " . htmlspecialchars($litige['reference']);
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-0 flex-grow-1 d-flex flex-column" style="margin-bottom: 120px;">
    
    <div class="px-4 py-3 border-bottom bg-white d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <small class="text-muted fw-bold text-uppercase tracking-wider" style="font-size: 0.7rem;">Dossier de Litige</small>
                <span class="material-symbols-outlined text-muted fs-6">chevron_right</span>
                <span class="font-monospace fw-bold text-primary"><?php echo htmlspecialchars($litige['reference_cadastrale'] ?? 'N/A'); ?></span>
            </div>
            <h1 class="h4 fw-bold m-0 text-dark">Résolution de Conflit : Commune de Glo-Djigbé</h1>
        </div>
        <div class="d-flex align-items-center gap-3">
            <?php if ($litige['statut'] === 'ouvert'): ?>
                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2 rounded-pill d-flex align-items-center gap-1 fw-medium">
                    <span class="material-symbols-outlined fs-6">warning</span> En Suspens / Bloqué
                </span>
            <?php elseif ($litige['statut'] === 'en_cours'): ?>
                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2 rounded-pill d-flex align-items-center gap-1 fw-medium text-dark">
                    <span class="material-symbols-outlined fs-6">gavel</span> Instruction en cours
                </span>
            <?php else: ?>
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill d-flex align-items-center gap-1 fw-medium">
                    <span class="material-symbols-outlined fs-6">check_circle</span> Conflit Résolu
                </span>
            <?php endif; ?>
            <button onclick="window.print()" class="btn btn-light border text-primary fw-semibold d-flex align-items-center gap-2 shadow-sm" style="border-radius: 8px;">
                <span class="material-symbols-outlined fs-5">print</span> Imprimer le dossier
            </button>
        </div>
    </div>

    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger mx-4 mt-3 border-0 rounded-3"><?php echo $erreur; ?></div>
    <?php endif; ?>

    <div class="row g-0 flex-grow-1 bg-white">
        
        <div class="col-12 col-lg-5 border-end p-4 overflow-auto" style="max-height: calc(100vh - 180px);">
            <div class="d-flex flex-column gap-4">
                
                <section>
                    <h3 class="h6 text-dark fw-bold uppercase tracking-wider mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-primary fs-5">history_edu</span> Historique Administratif
                    </h3>
                    <div class="position-relative ps-3 ms-2 border-start border-2 border-light-subtle space-y-4">
                        <div class="position-relative mb-4">
                            <div class="position-absolute rounded-circle bg-white border border-primary" style="width: 12px; height: 12px; left: -21px; top: 6px;"></div>
                            <small class="text-muted font-monospace d-block mb-1"><?php echo date('d/m/Y à H:i', strtotime($litige['created_at'])); ?></small>
                            <div class="bento-card p-3 bg-light border-0 shadow-none">
                                <h6 class="fw-bold text-dark small mb-1">Ouverture officielle du litige</h6>
                                <p class="text-muted small m-0">Signalement consigné au registre par l'agent <?php echo htmlspecialchars($litige['agent_prenom'] . ' ' . $litige['agent_nom']); ?>.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="h6 text-dark fw-bold uppercase tracking-wider mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-primary fs-5">balance</span> Analyse de la Réclamation
                    </h3>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="p-3 rounded-3 border bg-light">
                                <div class="d-flex align-items-center gap-2 text-primary mb-2 fw-bold small">
                                    <span class="material-symbols-outlined fs-5">person</span>
                                    <span>Titulaire inscrit & Faits déclarés</span>
                                </div>
                                <p class="text-muted small mb-2"><strong>Propriétaire actuel :</strong> <?php echo htmlspecialchars($litige['prop_prenom'] . ' ' . $litige['prop_nom']); ?> (NPI: <?php echo htmlspecialchars($litige['prop_npi']); ?>)</p>
                                <p class="text-dark small mb-0 lh-base">
                                    <strong>Nature du conflit :</strong> <?php echo ucfirst(str_replace('_', ' ', $litige['type'])); ?><br>
                                    <strong>Procès-verbal initial :</strong> <?php echo htmlspecialchars($litige['description']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="h6 text-dark fw-bold uppercase tracking-wider mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-primary fs-5">folder_open</span> Pièces Jointes au Dossier
                    </h3>
                    <div class="d-flex flex-column gap-2">
                        <div class="p-3 bg-light border rounded-3 d-flex align-items-center justify-content-between group">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-mini bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center rounded" style="width: 40px; height: 40px;">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                </div>
                                <div>
                                    <span class="d-block fw-semibold text-dark small text-truncate" style="max-width: 200px;">Levé_Topographique_Contradictoire.pdf</span>
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Document technique cadastral</small>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-light border text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <span class="material-symbols-outlined fs-6">download</span>
                            </button>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <div class="col-12 col-lg-7 bg-light p-0 position-relative" style="height: calc(100vh - 180px);">
            <div class="position-absolute top-0 start-0 m-3 z-3 bg-white bg-opacity-95 backdrop-blur border p-3 rounded-3 shadow-sm max-w-sm">
                <h6 class="fw-bold text-dark d-flex align-items-center gap-2 m-0 fs-6">
                    <span class="material-symbols-outlined text-primary">public</span> Périmètre de l'enquête
                </h6>
                <p class="text-muted small m-0 mt-1">Arrondissement de <?php echo htmlspecialchars($litige['arrondissement'] . ' — ' . $litige['village_quartier']); ?></p>
            </div>
            
            <div id="carte-resolution" class="w-100 h-100" style="background-color: #cbd5e1;"></div>
        </div>

    </div>
</div>

<?php if ($litige['statut'] !== 'resolu'): ?>
    <div class="fixed-bottom border-top bg-light p-3 shadow" style="left: var(--sidebar-width, 260px); z-index: 1000;">
        <form method="POST">
            <div class="container-fluid">
                <div class="row align-items-end g-3">
                    <div class="col-12 col-md-7 col-lg-8">
                        <label class="form-label small fw-bold text-dark d-flex align-items-center gap-1 mb-1">
                            <span class="material-symbols-outlined text-primary fs-6">gavel</span> Résolution Administrative & Conditions de Clôture
                        </label>
                        <textarea name="resolution_administrative" class="form-control" rows="2" placeholder="Saisir les conclusions de l'enquête, l'accord des parties ou l'ordonnance finale du tribunal pour acter le déblocage..." required></textarea>
                    </div>
                    <div class="col-12 col-md-5 col-lg-4">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-white border font-semibold d-flex align-items-center justify-content-center gap-1 text-muted text-nowrap w-50" style="height: 52px; border-radius: 8px;">
                                <span class="material-symbols-outlined fs-5">upload_file</span> Joindre acte
                            </button>
                            <button type="submit" class="btn text-white fw-bold d-flex align-items-center justify-content-center gap-2 w-50" 
                                    style="background-color: #10B981; height: 52px; border-radius: 8px;"
                                    onclick="return confirm('Voulez-vous acter la clôture du dossier ? Le statut de la parcelle repassera instantanément à la valeur Attribuée.');">
                                <span class="material-symbols-outlined fs-5">check_circle</span> Clôturer le litige
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var lat = <?php echo json_encode($litige['latitude'] ?? 6.3667); ?>;
    var lng = <?php echo json_encode($litige['longitude'] ?? 2.4333); ?>;
    var ref = <?php echo json_encode($litige['reference_cadastrale'] ?? 'Inconnue'); ?>;

    if (typeof L !== 'undefined' && lat && lng) {
        var carte = L.map('carte-resolution', { zoomControl: false }).setView([lat, lng], 16);
        L.control.zoom({ position: 'topright' }).addTo(carte);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap — Système Foncier Glo'
        }).addTo(carte);

        // Cercle rouge matérialisant visuellement la zone contestée
        L.circle([lat, lng], {
            color: '#EF4444',
            fillColor: '#EF4444',
            fillOpacity: 0.2,
            radius: 80
        }).addTo(carte);

        var icone = L.divIcon({
            className: 'custom-pin',
            html: '<span class="material-symbols-outlined text-danger" style="font-size:36px; font-variation-settings: \'FILL\' 1;">location_on</span>',
            iconSize: [36, 36],
            iconAnchor: [18, 36]
        });

        L.marker([lat, lng], { icon: icone }).addTo(carte).bindPopup('<b>⚠️ Terrain en Litige : ' + ref + '</b>').openPopup();
    }
});
</script>

<?php require_once '../../includes/footer.php'; ?>