<?php
// Sécurité : connexion obligatoire
require_once '../../config/session.php';
require_once '../../config/database.php';
requiertConnexion();

$titre = "Gestion des Alertes";
$conn  = getConnexion();

// ---- FILTRES ----
$where  = "WHERE 1=1";
$params = [];
$types  = "";

// Filtre par niveau
if (!empty($_GET['niveau'])) {
    $where   .= " AND a.niveau = ?";
    $params[] = $_GET['niveau'];
    $types   .= "s";
}

// Filtre par statut
if (!empty($_GET['statut'])) {
    $where   .= " AND a.statut = ?";
    $params[] = $_GET['statut'];
    $types   .= "s";
}

// Filtre par type
if (!empty($_GET['type'])) {
    $where   .= " AND a.type = ?";
    $params[] = $_GET['type'];
    $types   .= "s";
}

// ---- PAGINATION ----
$par_page    = 10;
$page_actuel = isset($_GET['page'])
               ? (int)$_GET['page'] : 1;
$debut       = ($page_actuel - 1) * $par_page;

// Compter le total
$sql_count = "SELECT COUNT(*) as total
              FROM alertes a $where";
$stmt = $conn->prepare($sql_count);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$total       = $stmt->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total / $par_page);

// ---- RÉCUPÉRER LES ALERTES ----
$sql = "SELECT a.*,
               p.reference_cadastrale
        FROM alertes a
        LEFT JOIN parcelles p
        ON a.parcelle_id = p.id
        $where
        ORDER BY a.created_at DESC
        LIMIT ? OFFSET ?";

$params[] = $par_page;
$params[] = $debut;
$types   .= "ii";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$alertes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<main>
<div class="container-fluid py-4">

    <!-- En-tête -->
    <div class="d-flex justify-content-between
                align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <span class="material-symbols-outlined me-2" style="vertical-align: middle;">notifications_active</span>
            Gestion des Alertes
        </h4>
        <span class="badge bg-danger fs-6">
            <?php echo $total; ?> alerte(s)
        </span>
    </div>

    <!-- ---- FILTRES ---- -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">

                <!-- Niveau -->
                <div class="col-md-3">
                    <label class="form-label">Niveau</label>
                    <select name="niveau" class="form-select">
                        <option value="">Tous les niveaux</option>
                        <option value="critique"
                            <?php echo ($_GET['niveau'] ?? '')
                                == 'critique' ? 'selected' : ''; ?>>
                            🔴 Critique
                        </option>
                        <option value="warning"
                            <?php echo ($_GET['niveau'] ?? '')
                                == 'warning' ? 'selected' : ''; ?>>
                            🟡 Warning
                        </option>
                        <option value="info"
                            <?php echo ($_GET['niveau'] ?? '')
                                == 'info' ? 'selected' : ''; ?>>
                            🔵 Info
                        </option>
                    </select>
                </div>

                <!-- Statut -->
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="nouvelle"
                            <?php echo ($_GET['statut'] ?? '')
                                == 'nouvelle' ? 'selected' : ''; ?>>
                            Nouvelle
                        </option>
                        <option value="en_cours"
                            <?php echo ($_GET['statut'] ?? '')
                                == 'en_cours' ? 'selected' : ''; ?>>
                            En cours
                        </option>
                        <option value="resolue"
                            <?php echo ($_GET['statut'] ?? '')
                                == 'resolue' ? 'selected' : ''; ?>>
                            Résolue
                        </option>
                    </select>
                </div>

                <!-- Type -->
                <div class="col-md-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="">Tous les types</option>
                        <option value="double_attribution">
                            Double attribution
                        </option>
                        <option value="superposition">
                            Superposition
                        </option>
                        <option value="titre_invalide">
                            Titre invalide
                        </option>
                        <option value="transaction_suspecte">
                            Transaction suspecte
                        </option>
                    </select>
                </div>

                <!-- Boutons -->
                <div class="col-md-3 d-flex
                            align-items-end gap-2">
                    <button type="submit"
                            class="btn btn-primary w-100">
                        <i class="fa-solid fa-magnifying-glass me-1"></i>
                        Filtrer
                    </button>
                    <a href="index.php"
                       class="btn btn-outline-secondary w-100">
                        <i class="fa-solid fa-xmark me-1"></i>
                        Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- ---- TABLEAU DES ALERTES ---- -->
    <div class="card">
        <div class="card-header">
            <i class="fa-solid fa-list me-2"></i>
            Liste des alertes
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Parcelle</th>
                            <th>Type</th>
                            <th>Niveau</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($alertes)): ?>
                        <tr>
                            <td colspan="8"
                                class="text-center
                                       text-muted py-4">
                                ✅ Aucune alerte trouvée
                            </td>
                        </tr>
                    <?php else: ?>
                    <?php foreach ($alertes as $i => $a): ?>
                        <tr class="alerte-<?php echo $a['niveau']; ?>">
                            <td class="text-muted">
                                <?php echo $debut + $i + 1; ?>
                            </td>
                            <td class="fw-semibold">
                                <?php echo $a['code']; ?>
                            </td>
                            <td>
                                <?php echo $a['reference_cadastrale']; ?>
                            </td>
                            <td>
                                <?php echo ucfirst(str_replace(
                                    '_', ' ', $a['type']
                                )); ?>
                            </td>
                            <td>
                                <?php
                                $c = match($a['niveau']) {
                                    'critique' => 'danger',
                                    'warning'  => 'warning',
                                    default    => 'info'
                                };
                                ?>
                                <span class="badge bg-<?php echo $c; ?>">
                                    <?php echo ucfirst($a['niveau']); ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                $cs = match($a['statut']) {
                                    'nouvelle'  => 'danger',
                                    'en_cours'  => 'warning',
                                    'resolue'   => 'success',
                                    default     => 'secondary'
                                };
                                ?>
                                <span class="badge bg-<?php echo $cs; ?>">
                                    <?php echo ucfirst($a['statut']); ?>
                                </span>
                            </td>
                            <td>
                                <?php echo date('d/m/Y H:i',
                                    strtotime($a['created_at'])
                                ); ?>
                            </td>
                            <td>
                                <a href="show.php?id=<?php echo $a['id']; ?>"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <div class="card-footer">
            <nav>
                <ul class="pagination pagination-sm
                           justify-content-center mb-0">
                    <li class="page-item
                        <?php echo $page_actuel == 1
                            ? 'disabled' : ''; ?>">
                        <a class="page-link"
                           href="?page=<?php echo $page_actuel - 1; ?>">
                            «
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item
                        <?php echo $i == $page_actuel
                            ? 'active' : ''; ?>">
                        <a class="page-link"
                           href="?page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item
                        <?php echo $page_actuel == $total_pages
                            ? 'disabled' : ''; ?>">
                        <a class="page-link"
                           href="?page=<?php echo $page_actuel + 1; ?>">
                            »
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>

    </div>

</div>
</main>

<?php require_once '../../includes/footer.php'; ?>