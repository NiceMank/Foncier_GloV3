<?php
// admin/proprietaires/show.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// Accessible aux Admins, Agents SADE et Chefs de Service pour la consultation
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /foncier_gloV3/admin/proprietaires/index.php');
    exit();
}

$id   = (int)$_GET['id'];
$conn = getConnexion();
$role_user = $_SESSION['user_role'] ?? '';

// 1. Récupération des informations du propriétaire
$sql_prop = "SELECT * FROM proprietaires WHERE id = ?";
$stmt_prop = $conn->prepare($sql_prop);
$stmt_prop->bind_param('i', $id);
$stmt_prop->execute();
$proprietaire = $stmt_prop->get_result()->fetch_assoc();
$stmt_prop->close();

if (!$proprietaire) {
    header('Location: /foncier_gloV3/admin/proprietaires/index.php');
    exit();
}

// 2. Récupération des parcelles appartenant à ce propriétaire
$sql_parcelles = "SELECT * FROM parcelles WHERE proprietaire_id = ? ORDER BY created_at DESC";
$stmt_parcelles = $conn->prepare($sql_parcelles);
$stmt_parcelles->bind_param('i', $id);
$stmt_parcelles->execute();
$parcelles = $stmt_parcelles->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_parcelles->close();

$titre = "Fiche Propriétaire — " . htmlspecialchars($proprietaire['nom'] . ' ' . $proprietaire['prenom']);
$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 bento-card border-0 shadow-sm p-4">
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-large bg-primary text-white fw-bold rounded-circle d-flex align-items-center justify-content-center fs-3 shadow-sm" style="width: 56px; height: 56px;">
                <?php echo strtoupper(substr($proprietaire['prenom'], 0, 1) . substr($proprietaire['nom'], 0, 1)); ?>
            </div>
            <div>
                <h2 class="h4 m-0 fw-bold" style="color: var(--md-primary);">
                    <?php echo htmlspecialchars($proprietaire['prenom'] . ' ' . $proprietaire['nom']); ?>
                </h2>
                <p class="m-0 text-muted small">
                    Type : <?php echo ($proprietaire['type'] === 'personne_physique') ? '👤 Personne Physique' : '🏢 Personne Morale'; ?>
                </p>
            </div>
        </div>
        
        <div class="d-flex gap-2">
            <a href="/foncier_gloV3/admin/proprietaires/index.php" class="btn btn-light border text-muted fw-semibold d-flex align-items-center gap-2 px-3 shadow-sm" style="border-radius: 8px;">
                <span class="material-symbols-outlined fs-5">arrow_back</span> Retour
            </a>
            <?php if ($role_user === 'agent_sade'): ?>
                <a href="/foncier_gloV3/admin/proprietaires/edit.php?id=<?php echo $id; ?>" class="btn text-white fw-semibold d-flex align-items-center gap-2 px-4 shadow-sm" style="background-color: var(--md-primary-container); border-radius: 8px;">
                    <span class="material-symbols-outlined fs-5">edit</span> Modifier le profil
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php afficherFlash(); ?>

    <div class="row g-4">
        
        <div class="col-12 col-lg-4 d-flex flex-column gap-4">
            
            <div class="bento-card border-0 shadow-sm">
                <h3 class="h5 fw-bold mb-4 d-flex align-items-center gap-2" style="color: var(--md-primary);">
                    <span class="material-symbols-outlined">badge</span> Informations d'identité
                </h3>
                
                <div class="mb-3">
                    <small class="text-muted fw-semibold d-block mb-1">Identifiant Unique (NPI / IFU)</small>
                    <span class="text-dark font-monospace fw-bold fs-6"><?php echo htmlspecialchars($proprietaire['npi'] ?? 'Non renseigné'); ?></span>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted fw-semibold d-block mb-1">Téléphone de contact</small>
                    <span class="text-dark fw-medium"><?php echo htmlspecialchars($proprietaire['telephone']); ?></span>
                </div>

                <div class="mb-0">
                    <small class="text-muted fw-semibold d-block mb-1">Date d'inscription au registre</small>
                    <span class="text-muted small"><?php echo date('d/m/Y à H:i', strtotime($proprietaire['created_at'])); ?></span>
                </div>
            </div>

            <div class="bento-card border-0 shadow-sm">
                <h3 class="h5 fw-bold mb-3 d-flex align-items-center gap-2" style="color: var(--md-primary);">
                    <span class="material-symbols-outlined">lock_person</span> Accès Consultant foncier
                </h3>
                
                <div class="alert bg-light border p-3 rounded-3 mb-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <small class="fw-semibold text-muted">Statut du compte</small>
                        <?php if ($proprietaire['compte_actif'] === 'oui'): ?>
                            <span class="badge bg-success px-3 py-1.5 rounded-pill fw-medium">Actif (Connectable)</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-medium">Désactivé</span>
                        <?php endif; ?>
                    </div>

                    <small class="text-muted fw-semibold d-block mb-1">Email de connexion (Identifiant)</small>
                    <span class="text-dark fw-bold font-monospace text-wrap d-block mb-2" style="word-break: break-all;"><?php echo htmlspecialchars($proprietaire['email_connexion'] ?? 'Aucun email configuré'); ?></span>
                    
                    <small class="text-muted mt-2 d-block small">Le propriétaire peut utiliser cet email sur la page d'accueil du site pour vendre ses biens en ligne ou suivre ses titres fonciers.</small>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-8">
            <div class="table-card border-0 shadow-sm bg-white h-100">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">map</span> 
                        Patrimoine Foncier (<?php echo count($parcelles); ?> parcelle(s))
                    </h5>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Référence Cadastrale</th>
                                <th>Localisation / Quartier</th>
                                <th>Superficie</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($parcelles)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <span class="material-symbols-outlined fs-1 opacity-25 mb-2 d-block">Leak_Add</span>
                                        Aucune parcelle n'est actuellement enregistrée sous le nom de ce propriétaire.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($parcelles as $parcelle): ?>
                                    <tr>
                                        <td class="fw-bold text-dark font-monospace"><?php echo htmlspecialchars($parcelle['reference_cadastrale']); ?></td>
                                        <td>
                                            <small class="text-dark d-block fw-medium"><?php echo htmlspecialchars($parcelle['arrondissement']); ?></small>
                                            <small class="text-muted"><?php echo htmlspecialchars($parcelle['village_quartier']); ?></small>
                                        </td>
                                        <td><?php echo number_format($parcelle['superficie'], 2, ',', ' '); ?> m²</td>
                                        <td><span class="small text-secondary fw-medium"><?php echo ucfirst(htmlspecialchars($parcelle['type_terrain'])); ?></span></td>
                                        <td>
                                            <?php 
                                                $badge = match($parcelle['statut']) {
                                                    'attribue' => 'bg-primary',
                                                    'litige'   => 'bg-danger',
                                                    'reserve'  => 'bg-warning text-dark',
                                                    default    => 'bg-secondary'
                                                };
                                            ?>
                                            <span class="badge <?php echo $badge; ?> rounded-pill fw-normal px-2.5 py-1.5">
                                                <?php echo ($parcelle['statut'] === 'attribue') ? 'Attribuée' : (($parcelle['statut'] === 'litige') ? 'En litige' : 'Réservée'); ?>
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="/foncier_gloV3/admin/parcelles/show.php?id=<?php echo $parcelle['id']; ?>" class="btn btn-sm btn-light text-primary border shadow-sm">
                                                <span class="material-symbols-outlined fs-6 align-middle">visibility</span>
                                            </a>
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

<?php require_once '../../includes/footer.php'; ?>