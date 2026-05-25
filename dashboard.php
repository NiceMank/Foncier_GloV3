<?php
require_once 'config/session.php';
require_once 'config/database.php';
requiertConnexion();

$titre = "Tableau de bord";
$conn  = getConnexion();

// -- Statistiques dynamiques --
$total_parcelles = $conn->query("SELECT COUNT(*) as total FROM parcelles")->fetch_assoc()['total'];
$total_alertes   = $conn->query("SELECT COUNT(*) as total FROM alertes WHERE statut = 'nouvelle'")->fetch_assoc()['total'];
$total_litiges   = $conn->query("SELECT COUNT(*) as total FROM litiges WHERE statut IN ('ouvert','en_cours')")->fetch_assoc()['total'];
$total_resolus   = $conn->query("SELECT COUNT(*) as total FROM litiges WHERE statut = 'resolu'")->fetch_assoc()['total'];
$total_proprietaires = $conn->query("SELECT COUNT(*) as total FROM proprietaires")->fetch_assoc()['total'];
$total_libres    = $conn->query("SELECT COUNT(*) as total FROM parcelles WHERE statut = 'libre'")->fetch_assoc()['total'];

// -- Données récentes --
$parcelles = $conn->query("SELECT p.*, pr.nom, pr.prenom FROM parcelles p LEFT JOIN proprietaires pr ON p.proprietaire_id = pr.id ORDER BY p.created_at DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);
$alertes   = $conn->query("SELECT a.*, p.reference_cadastrale FROM alertes a LEFT JOIN parcelles p ON a.parcelle_id = p.id WHERE a.statut = 'nouvelle' ORDER BY a.created_at DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);
$litiges   = $conn->query("SELECT l.*, p.reference_cadastrale FROM litiges l LEFT JOIN parcelles p ON l.parcelle_id = p.id ORDER BY l.created_at DESC LIMIT 4")->fetch_all(MYSQLI_ASSOC);

$conn->close();

require_once 'includes/header.php'; 
require_once 'includes/navbar.php'; 
?>

<main class="p-4 p-md-5 overflow-auto flex-grow-1">
    
    <section class="hero-banner mb-4">
        <h1 class="display-6 fw-bold mb-2">Espace Gestionnaire</h1>
        <p class="fs-5 opacity-75 mb-0">
            Session: <?php echo ucfirst(str_replace('_', ' ', $_SESSION['user_role'])); ?> | Système Foncier Glo
        </p>
    </section>

    <section class="row g-4 mb-5">
        
        <div class="col-12 col-md-4">
            <a href="/foncier_gloV3/pages/parcelles/index.php" class="text-decoration-none">
                <div class="bento-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">Total Parcelles</span>
                        <div class="icon-box" style="background-color: var(--md-secondary-container);">
                            <span class="material-symbols-outlined" style="color: var(--md-on-secondary-container);">map</span>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark"><?php echo number_format($total_parcelles, 0, ',', ' '); ?></h3>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-md-4">
            <a href="/foncier_gloV3/pages/alertes/index.php" class="text-decoration-none">
                <div class="bento-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">Alertes</span>
                        <div class="icon-box" style="background-color: var(--md-error-container);">
                            <span class="material-symbols-outlined" style="color: var(--md-on-error-container);">warning</span>
                        </div>
                    </div>
                    <h3 class="fw-bold text-danger mb-0"><?php echo $total_alertes; ?></h3>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-4">
            <a href="/foncier_gloV3/pages/litiges/index.php" class="text-decoration-none">
                <div class="bento-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">Litiges Actifs</span>
                        <div class="icon-box" style="background-color: var(--md-tertiary-container);">
                            <span class="material-symbols-outlined" style="color: var(--md-on-tertiary-container);">gavel</span>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark"><?php echo $total_litiges; ?></h3>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-4">
            <a href="/foncier_gloV3/pages/litiges/index.php?statut=resolu" class="text-decoration-none">
                <div class="bento-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">Litiges Résolus</span>
                        <div class="icon-box bg-success bg-opacity-10">
                            <span class="material-symbols-outlined text-success">task_alt</span>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark"><?php echo $total_resolus; ?></h3>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-4">
            <a href="/foncier_gloV3/pages/proprietaires/index.php" class="text-decoration-none">
                <div class="bento-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">Propriétaires</span>
                        <div class="icon-box bg-info bg-opacity-10">
                            <span class="material-symbols-outlined text-info">group</span>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark"><?php echo number_format($total_proprietaires, 0, ',', ' '); ?></h3>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-4">
            <a href="/foncier_gloV3/pages/parcelles/index.php?statut=libre" class="text-decoration-none">
                <div class="bento-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">Parcelles Libres</span>
                        <div class="icon-box bg-light border">
                            <span class="material-symbols-outlined text-secondary">park</span>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark"><?php echo number_format($total_libres, 0, ',', ' '); ?></h3>
                </div>
            </a>
        </div>
    </section>

    <div class="row g-4 mb-4">
        <div class="col-xl-8 col-lg-7">
            <div class="table-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Dernières Parcelles</span>
                    <a href="/foncier_gloV3/pages/parcelles/index.php" class="small">Voir tout</a>
                </div>
                </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="table-card h-100">
                </div>
        </div>
    </div>

</main>

<?php require_once 'includes/footer.php'; ?>