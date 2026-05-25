<?php
require_once '../config/session.php';
require_once '../config/database.php';
requiertConnexion();

// Vérifier que c'est bien un consultant
if ($_SESSION['user_role'] !== 'consultant') {
    header('Location: /foncier_gloV3/login.php');
    exit();
}

$titre = "Tableau de bord - Espace Consultant";
$conn  = getConnexion();

// Récupérer les parcelles du consultant (propriétaire)
$user_id = $_SESSION['user_id'];
$sql = "SELECT COUNT(*) as total FROM parcelles WHERE proprietaire_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$mes_parcelles = $stmt->get_result()->fetch_assoc()['total'];

$conn->close();

require_once '../includes/header.php';
require_once '../includes/navbar_consultant.php';
?>

<main class="p-4 p-md-5 overflow-auto flex-grow-1">
    
    <section class="hero-banner mb-4">
        <h1 class="display-6 fw-bold mb-2">Espace Consultant</h1>
        <p class="fs-5 opacity-75 mb-0">
            Bienvenue <?php echo htmlspecialchars($_SESSION['user_prenom'] ?? 'Utilisateur'); ?> | Gérez vos parcelles
        </p>
    </section>

    <section class="row g-4 mb-5">
        
        <div class="col-12 col-md-6">
            <a href="/foncier_gloV3/consultant/parcelles/index.php" class="text-decoration-none">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-2">Mes Parcelles</p>
                                <h3 class="fw-bold mb-0"><?php echo $mes_parcelles; ?></h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <span class="material-symbols-outlined text-primary">map</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6">
            <a href="/foncier_gloV3/consultant/transferts/index.php" class="text-decoration-none">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-2">Demandes de Vente</p>
                                <h3 class="fw-bold text-info mb-0">0</h3>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <span class="material-symbols-outlined text-info">shopping_cart</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </section>

    <div class="alert alert-info">
        <span class="material-symbols-outlined me-2">info</span>
        <strong>Espace Consultant</strong> - Vous pouvez consulter vos parcelles et soumettre des demandes de vente.
    </div>

</main>

<?php require_once '../includes/footer.php'; ?>
