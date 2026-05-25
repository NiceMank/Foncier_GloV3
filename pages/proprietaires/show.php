<?php
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id   = (int)$_GET['id'];
$conn = getConnexion();

$sql  = "SELECT * FROM proprietaires WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$proprietaire = $stmt->get_result()->fetch_assoc();

if (!$proprietaire) {
    header('Location: index.php');
    exit();
}

$titre = "Détails Propriétaire";
$conn->close();
?>
<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<main>
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between
                align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <i class="fa-solid fa-user me-2"></i>
            Détails du Propriétaire
        </h4>
        <a href="index.php"
           class="btn btn-outline-secondary">
            <span class="material-symbols-outlined me-2">arrow_back</span>
            Retour
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fa-solid fa-user me-2"></i>
            Informations personnelles
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <td class="fw-bold text-muted w-25">
                        Nom complet
                    </td>
                    <td class="fw-bold">
                        <?php echo $proprietaire['prenom']
                            . ' ' . $proprietaire['nom']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted">NPI</td>
                    <td><?php echo $proprietaire['npi']; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted">
                        Téléphone
                    </td>
                    <td>
                        <?php echo $proprietaire['telephone']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted">Email</td>
                    <td>
                        <?php echo $proprietaire['email'] ?: '—'; ?>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted">Adresse</td>
                    <td>
                        <?php echo $proprietaire['adresse']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted">Type</td>
                    <td>
                        <?php echo $proprietaire['type']
                            == 'personne_physique'
                            ? '👤 Personne Physique'
                            : '🏢 Personne Morale'; ?>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted">
                        Pièce identité
                    </td>
                    <td>
                        <?php echo $proprietaire['piece_identite']
                            ?: '—'; ?>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-muted">
                        Enregistré le
                    </td>
                    <td>
                        <?php echo date('d/m/Y H:i',
                            strtotime($proprietaire['created_at'])
                        ); ?>
                    </td>
                </tr>
            </table>

            <div class="d-flex gap-2 mt-3">
                <a href="edit.php?id=<?php echo $id; ?>"
                   class="btn btn-warning">
                    <span class="material-symbols-outlined me-2">edit</span>
                    Modifier
                </a>
                <a href="index.php"
                   class="btn btn-outline-secondary">
                    <span class="material-symbols-outlined me-2">arrow_back</span>
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>

</div>
</main>

<?php require_once '../../includes/footer.php'; ?>