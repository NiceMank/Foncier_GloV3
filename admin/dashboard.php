<?php
// This file will be installed to admin/dashboard.php
require_once '../config/session.php';
require_once '../config/database.php';
requiertConnexion();

// Vérifier que c'est bien un administrateur, agent ou chef
if (!in_array($_SESSION['user_role'], ['administrateur', 'agent_sade', 'chef_service'])) {
    header('Location: /foncier_gloV3/login.php');
    exit();
}

$titre = "Tableau de bord - Espace Admin";
$conn  = getConnexion();

$total_parcelles = $conn->query("SELECT COUNT(*) as total FROM parcelles")->fetch_assoc()['total'];
$total_alertes   = $conn->query("SELECT COUNT(*) as total FROM alertes WHERE statut = 'nouvelle'")->fetch_assoc()['total'];
$total_litiges   = $conn->query("SELECT COUNT(*) as total FROM litiges WHERE statut IN ('ouvert','en_cours')")->fetch_assoc()['total'];
$total_proprietaires = $conn->query("SELECT COUNT(*) as total FROM proprietaires")->fetch_assoc()['total'];

$conn->close();

require_once '../includes/header.php';
require_once '../includes/navbar_admin.php';
?>

<main class="p-4 p-md-5 overflow-auto flex-grow-1">
    
    <section class="hero-banner mb-4">
        <h1 class="display-6 fw-bold mb-2">Espace Admin/Gestionnaire</h1>
        <p class="fs-5 opacity-75 mb-0">
            Rôle: <?php echo ucfirst(str_replace('_', ' ', $_SESSION['user_role'])); ?> | Tableau de bord
        </p>
    </section>

    <section class="row g-4 mb-5">
        
        <div class="col-12 col-md-6 col-lg-3">
            <a href="/foncier_gloV3/pages/parcelles/index.php" class="text-decoration-none">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-2">Total Parcelles</p>
                                <h3 class="fw-bold mb-0"><?php echo number_format($total_parcelles, 0, ',', ' '); ?></h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <span class="material-symbols-outlined text-primary">map</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <a href="/foncier_gloV3/pages/alertes/index.php" class="text-decoration-none">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-2">Alertes Nouvelles</p>
                                <h3 class="fw-bold text-danger mb-0"><?php echo $total_alertes; ?></h3>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded">
                                <span class="material-symbols-outlined text-danger">warning</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <a href="/foncier_gloV3/pages/litiges/index.php" class="text-decoration-none">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-2">Litiges Actifs</p>
                                <h3 class="fw-bold text-warning mb-0"><?php echo $total_litiges; ?></h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <span class="material-symbols-outlined text-warning">gavel</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <a href="/foncier_gloV3/pages/proprietaires/index.php" class="text-decoration-none">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-2">Propriétaires</p>
                                <h3 class="fw-bold text-info mb-0"><?php echo number_format($total_proprietaires, 0, ',', ' '); ?></h3>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <span class="material-symbols-outlined text-info">group</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </section>

    <div class="alert alert-info">
        <span class="material-symbols-outlined me-2">info</span>
        <strong>Bienvenue!</strong> Vous êtes connecté en tant que <strong><?php echo ucfirst(str_replace('_', ' ', $_SESSION['user_role'])); ?></strong>.
        <br>
        Utilisez la navigation latérale pour accéder aux différentes sections du système.
    </div>

</main>

<?php require_once '../includes/footer.php'; ?>
