<?php
// admin/search.php
require_once '../config/session.php';
require_once '../config/database.php';

// Accessible à tout le personnel authentifié
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

$query_terme = isset($_GET['q']) ? nettoyer($_GET['q']) : '';
$titre = "Résultats de recherche pour : " . htmlspecialchars($query_terme);

$parcelles_trouvees = [];
$proprietaires_trouves = [];
$litiges_trouves = [];

if (!empty($query_terme)) {
    $conn = getConnexion();
    $search_pattern = "%" . $query_terme . "%";

    // 1. Recherche dans les parcelles
    $sql_p = "SELECT p.*, pr.nom, pr.prenom FROM parcelles p 
              LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id 
              WHERE p.reference_cadastrale LIKE ? OR p.arrondissement LIKE ? OR p.village_quartier LIKE ?";
    $stmt_p = $conn->prepare($sql_p);
    $stmt_p->bind_param('sss', $search_pattern, $search_pattern, $search_pattern);
    $stmt_p->execute();
    $parcelles_trouvees = $stmt_p->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_p->close();

    // 2. Recherche dans les propriétaires
    $sql_pr = "SELECT pr.*, COUNT(p.id) AS total_parcelles FROM proprietaires pr 
               LEFT JOIN parcelles p ON pr.id = p.proprietaire_id 
               WHERE pr.nom LIKE ? OR pr.prenom LIKE ? OR pr.npi LIKE ? OR pr.telephone LIKE ?
               GROUP BY pr.id";
    $stmt_pr = $conn->prepare($sql_pr);
    $stmt_pr->bind_param('ssss', $search_pattern, $search_pattern, $search_pattern, $search_pattern);
    $stmt_pr->execute();
    $proprietaires_trouves = $stmt_pr->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_pr->close();

    // 3. Recherche dans les dossiers de litiges
    $sql_l = "SELECT l.*, p.reference_cadastrale FROM litiges l 
              JOIN parcelles p ON l.parcelle_id = p.id 
              WHERE l.reference LIKE ? OR l.type LIKE ?";
    $stmt_l = $conn->prepare($sql_l);
    $stmt_l->bind_param('ss', $search_pattern, $search_pattern);
    $stmt_l->execute();
    $litiges_trouves = $stmt_l->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_l->close();

    $conn->close();
}

require_once '../includes/header.php'; 
require_once '../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">

    <div class="mb-4">
        <h2 class="h3 fw-bold mb-1" style="color: var(--md-primary);">Recherche Globale Système</h2>
        <p class="text-muted small">Résultats trouvés pour le terme : <strong class="text-dark">"<?php echo htmlspecialchars($query_terme); ?>"</strong></p>
    </div>

    <?php if (empty($parcelles_trouvees) && empty($proprietaires_trouves) && empty($litiges_trouves)): ?>
        <div class="bento-card text-center py-5 bg-white shadow-sm border-0">
            <span class="material-symbols-outlined text-muted fs-1 opacity-25 mb-2 d-block">search_off</span>
            <h5 class="text-dark fw-bold mb-1">Aucun élément ne correspond</h5>
            <p class="text-muted small m-0">Vérifiez l'orthographe ou essayez avec un numéro d'identifiant unique (NPI/IFU) ou une référence cadastrale complète.</p>
        </div>
    <?php else: ?>

        <div class="row g-4">
            
            <?php if (!empty($parcelles_trouvees)): ?>
                <div class="col-12">
                    <div class="table-card shadow-sm bg-white border-0">
                        <div class="p-3 border-bottom d-flex align-items-center gap-2 bg-white">
                            <span class="material-symbols-outlined text-primary">map</span>
                            <h5 class="mb-0 fw-bold text-dark">Parcelles Cadastrales (<?php echo count($parcelles_trouvees); ?>)</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Référence</th>
                                        <th>Localisation</th>
                                        <th>Superficie</th>
                                        <th>Propriétaire</th>
                                        <th>Statut</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($parcelles_trouvees as $p): ?>
                                        <tr>
                                            <td class="fw-bold text-dark font-monospace"><?php echo htmlspecialchars($p['reference_cadastrale']); ?></td>
                                            <td class="text-muted small"><?php echo htmlspecialchars($p['arrondissement'] . ' — ' . $p['village_quartier']); ?></td>
                                            <td><?php echo number_format($p['superficie'], 2, ',', ' '); ?> m²</td>
                                            <td class="fw-medium text-dark"><?php echo htmlspecialchars($p['prenom'] . ' ' . $p['nom']); ?></td>
                                            <td>
                                                <?php $b = match($p['statut']) { 'attribue' => 'bg-primary', 'litige' => 'bg-danger', 'reserve' => 'bg-warning text-dark', default => 'bg-secondary' }; ?>
                                                <span class="badge <?php echo $b; ?> rounded-pill fw-normal px-2.5 py-1.5"><?php echo ucfirst($p['statut']); ?></span>
                                            </td>
                                            <td class="text-end">
                                                <a href="/foncier_gloV3/admin/parcelles/show.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-light border text-primary shadow-sm"><span class="material-symbols-outlined fs-6 align-middle">visibility</span></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($proprietaires_trouves)): ?>
                <div class="col-12">
                    <div class="table-card shadow-sm bg-white border-0">
                        <div class="p-3 border-bottom d-flex align-items-center gap-2 bg-white">
                            <span class="material-symbols-outlined text-primary">group</span>
                            <h5 class="mb-0 fw-bold text-dark">Annuaire Propriétaires (<?php echo count($proprietaires_trouves); ?>)</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Nom complet</th>
                                        <th>NPI / IFU</th>
                                        <th>Téléphone</th>
                                        <th>Patrimoine</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($proprietaires_trouves as $pr): ?>
                                        <tr>
                                            <td class="fw-bold text-dark"><?php echo htmlspecialchars($pr['prenom'] . ' ' . $pr['nom']); ?></td>
                                            <td class="font-monospace text-muted small"><?php echo htmlspecialchars($pr['npi']); ?></td>
                                            <td><?php echo htmlspecialchars($pr['telephone']); ?></td>
                                            <td><span class="badge bg-light text-dark border"><?php echo $pr['total_parcelles']; ?> bien(s) possédé(s)</span></td>
                                            <td class="text-end">
                                                <a href="/foncier_gloV3/admin/proprietaires/show.php?id=<?php echo $pr['id']; ?>" class="btn btn-sm btn-light border text-primary shadow-sm"><span class="material-symbols-outlined fs-6 align-middle">visibility</span></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($litiges_trouves)): ?>
                <div class="col-12">
                    <div class="table-card shadow-sm bg-white border-0">
                        <div class="p-3 border-bottom d-flex align-items-center gap-2 bg-white">
                            <span class="material-symbols-outlined text-danger">gavel</span>
                            <h5 class="mb-0 fw-bold text-dark">Dossiers de Litiges (<?php echo count($litiges_trouves); ?>)</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Référence Litige</th>
                                        <th>Type de conflit</th>
                                        <th>Parcelle liée</th>
                                        <th>Statut</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($litiges_trouves as $l): ?>
                                        <tr>
                                            <td class="fw-bold font-monospace text-dark"><?php echo htmlspecialchars($l['reference']); ?></td>
                                            <td><span class="badge bg-light text-dark border"><?php echo ucfirst(str_replace('_', ' ', $l['type'])); ?></span></td>
                                            <td class="font-monospace text-primary fw-semibold"><?php echo htmlspecialchars($l['reference_cadastrale']); ?></td>
                                            <td>
                                                <?php $c = match($l['statut']) { 'ouvert' => 'bg-danger', 'en_cours' => 'bg-warning text-dark', 'resolu' => 'bg-success', default => 'bg-secondary' }; ?>
                                                <span class="badge <?php echo $c; ?> rounded-pill fw-normal px-2.5 py-1.5"><?php echo ucfirst($l['statut']); ?></span>
                                            </td>
                                            <td class="text-end">
                                                <a href="/foncier_gloV3/admin/litiges/show.php?id=<?php echo $l['id']; ?>" class="btn btn-sm btn-light border text-primary shadow-sm"><span class="material-symbols-outlined fs-6 align-middle">visibility</span></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    <?php endif; ?>

</div>

<?php require_once '../includes/footer.php'; ?>