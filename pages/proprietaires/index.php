<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

$titre = "Gestion des Propriétaires";
$conn  = getConnexion();

// Récupérer tous les propriétaires
$sql    = "SELECT * FROM proprietaires ORDER BY id DESC";
$result = $conn->query($sql);

$proprietaires = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $proprietaires[] = $row;
    }
}
$total = count($proprietaires);
$conn->close();
?>
<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<main>
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between
                align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <span class="material-symbols-outlined me-2" style="vertical-align: middle;">group</span>
            Gestion des Propriétaires
        </h4>
        <a href="create.php" class="btn btn-primary">
            <span class="material-symbols-outlined me-2" style="vertical-align: middle;">add</span>
            Nouveau Propriétaire
        </a>
    </div>

    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <span class="material-symbols-outlined me-2" style="vertical-align: middle;">check_circle</span>
        Propriétaire enregistré avec succès !
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header d-flex
                    justify-content-between">
            <span>
                <span class="material-symbols-outlined me-2" style="vertical-align: middle;">view_list</span>
                Liste des propriétaires
            </span>
            <span class="badge bg-primary">
                <?php echo $total; ?> propriétaire(s)
            </span>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom complet</th>
                        <th>NPI</th>
                        <th>Téléphone</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($proprietaires)): ?>
                    <tr>
                        <td colspan="6"
                            class="text-center
                                   text-muted py-4">
                            Aucun propriétaire trouvé
                        </td>
                    </tr>
                <?php else: ?>
                <?php foreach ($proprietaires as $i => $p): ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td class="fw-semibold">
                            <?php echo $p['prenom']
                                . ' ' . $p['nom']; ?>
                        </td>
                        <td><?php echo $p['npi']; ?></td>
                        <td><?php echo $p['telephone']; ?></td>
                        <td>
                            <?php echo $p['type'] ==
                                'personne_physique'
                                ? '👤 Physique'
                                : '🏢 Morale'; ?>
                        </td>
                        <td>
    <a href="/foncier_gloV3/pages/proprietaires/show.php?id=<?php echo $p['id']; ?>"
       class="btn btn-sm btn-outline-info">
         <span class="material-symbols-outlined" style="vertical-align: middle;">visibility</span>
        Voir
    </a>
    <a href="/foncier_gloV3/pages/proprietaires/edit.php?id=<?php echo $p['id']; ?>"
       class="btn btn-sm btn-outline-warning">
         <span class="material-symbols-outlined" style="vertical-align: middle;">edit</span>
        Modifier
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
</main>

<?php require_once '../../includes/footer.php'; ?>