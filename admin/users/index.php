<?php
// admin/users/index.php
require_once '../../config/session.php';
require_once '../../config/database.php';

// NOUVELLE RÈGLE : L'Admin et le Chef de service ont accès à ce module
requiertRole(['administrateur', 'chef_service']);

$titre = "Gestion du Personnel";
$role_user = $_SESSION['user_role'];
$conn  = getConnexion();

// ---- TRAITEMENT DES ACTIONS RAPIDES (Changement de statut actif/inactif) ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['toggle_status'])) {
    $user_id = (int)$_POST['user_id'];
    // Sécurité : Impossible de désactiver son propre compte connecté
    if ($user_id === (int)$_SESSION['user_id']) {
        flashMessage('danger', "Action refusée : Vous ne pouvez pas désactiver votre propre compte.");
    } else {
        $nouveau_statut = (int)$_POST['toggle_status'];
        $stmt = $conn->prepare("UPDATE users SET actif = ? WHERE id = ?");
        $stmt->bind_param('ii', $nouveau_statut, $user_id);
        if ($stmt->execute()) {
            flashMessage('success', "Le statut de l'employé a été mis à jour.");
        }
        $stmt->close();
    }
    header('Location: index.php');
    exit();
}

// 1. Récupération des comptes selon les NOUVELLES RÈGLES DE RÔLES
if ($role_user === 'administrateur') {
    // L'administrateur ne voit et ne gère QUE les Chefs de Service
    $query_users = "SELECT id, matricule, nom, prenom, email, role, actif, created_at FROM users WHERE role = 'chef_service' ORDER BY created_at DESC";
    $titre_page = "Gestion des Chefs de Service";
    $label_bouton = "Nouveau Chef de Service";
} else {
    // Le Chef de service ne voit et ne gère QUE les Agents SADE
    $query_users = "SELECT id, matricule, nom, prenom, email, role, actif, created_at FROM users WHERE role = 'agent_sade' ORDER BY created_at DESC";
    $titre_page = "Gestion des Agents SADE";
    $label_bouton = "Nouvel Agent SADE";
}

$users = $conn->query($query_users)->fetch_all(MYSQLI_ASSOC);

// 2. Récupération des logs d'audit récents (Simulé ou branché sur une table system_logs)
$audit_logs = [
    ['date' => date('d/m/Y H:i'), 'icon' => 'login', 'color' => 'text-success', 'msg' => 'Connexion réussie - ' . ucfirst(str_replace('_', ' ', $role_user)) . ' ('.$_SESSION['user_prenom'].')'],
    ['date' => date('d/m/Y H:i', strtotime('-1 hour')), 'icon' => 'edit', 'color' => 'text-primary', 'msg' => 'Mise à jour des accès système effectuée'],
    ['date' => date('d/m/Y H:i', strtotime('-1 day')), 'icon' => 'gavel', 'color' => 'text-danger', 'msg' => 'Vérification de sécurité hebdomadaire']
];

$conn->close();

require_once '../../includes/header.php'; 
require_once '../../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: var(--md-primary);"><?php echo $titre_page; ?></h1>
            <p class="text-muted small mb-0">
                <?php echo $role_user === 'administrateur' ? 'Supervisez l\'activité et les accès des Chefs de Service.' : 'Gérez les habilitations de vos Agents sur le terrain.'; ?>
            </p>
        </div>
        <a href="/foncier_gloV3/admin/users/create.php" class="btn text-white fw-semibold d-flex align-items-center gap-2 shadow-sm" style="background-color: var(--md-primary); border-radius: 8px;">
            <span class="material-symbols-outlined fs-5">add</span>
            <?php echo $label_bouton; ?>
        </a>
    </div>

    <?php afficherFlash(); ?>

    <div class="row g-4">
        
        <div class="col-12 col-xl-8">
            <div class="table-card shadow-sm bg-white overflow-hidden flex-column d-flex" style="min-height: 520px;">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-primary">group</span>
                        Personnel sous votre supervision
                    </h5>
                    <span class="badge rounded-pill px-3 py-2 fw-normal" style="background-color: var(--md-primary-fixed-dim); color: var(--md-on-primary-fixed);">
                        <?php echo count($users); ?> employé(s)
                    </span>
                </div>

                <div class="table-responsive flex-grow-1">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Agent / Chef</th>
                                <th>Matricule & Contact</th>
                                <th>Date d'inscription</th>
                                <th class="text-end">Statut Accès</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($users)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        Aucun employé n'est encore enregistré sous votre supervision.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-mini bg-light text-primary fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                    <?php echo strtoupper(substr($user['prenom'], 0, 1) . substr($user['nom'], 0, 1)); ?>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold text-dark"><?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?></span>
                                                    <span class="small fw-medium text-muted">
                                                        <?php echo $user['role'] === 'chef_service' ? '💼 Chef de Service' : '🔍 Agent SADE'; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold font-monospace text-primary small"><?php echo htmlspecialchars($user['matricule'] ?? 'N/A'); ?></span>
                                                <span class="text-muted small font-monospace"><?php echo htmlspecialchars($user['email']); ?></span>
                                            </div>
                                        </td>
                                        <td class="text-muted small"><?php echo date('d M Y', strtotime($user['created_at'])); ?></td>
                                        <td class="text-end">
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                <input type="hidden" name="toggle_status" value="<?php echo $user['actif'] == 1 ? '0' : '1'; ?>">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input cursor-pointer" type="checkbox" role="switch" 
                                                           <?php echo $user['actif'] == 1 ? 'checked' : ''; ?> 
                                                           <?php echo $user['id'] === (int)$_SESSION['user_id'] ? 'disabled' : ''; ?>
                                                           onchange="this.form.submit();">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="bento-card text-white border-0 overflow-hidden flex-column d-flex h-100" style="background-color: #1A2636; min-height: 520px;">
                <div class="p-3 border-bottom border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold d-flex align-items-center gap-2" style="color: var(--md-tertiary-fixed-dim);">
                        <span class="material-symbols-outlined">history</span>
                        Journal d'Audit
                    </h5>
                    <span class="position-relative d-flex h-2 w-2">
                        <span class="animate-ping position-absolute inline-flex h-full w-full rounded-circle bg-success opacity-75"></span>
                        <span class="position-relative inline-flex rounded-circle h-2 w-2 bg-success"></span>
                    </span>
                </div>
                
                <div class="p-4 flex-grow-1 overflow-auto" style="max-height: 420px;">
                    <div class="position-relative ps-3 border-start border-secondary border-opacity-25 space-y-4">
                        <?php foreach($audit_logs as $log): ?>
                            <div class="position-relative mb-4">
                                <div class="position-absolute bg-success rounded-circle border border-dark" style="width: 10px; height: 10px; left: -21px; top: 6px; background-color: #10B981 !important;"></div>
                                <div class="d-flex flex-column">
                                    <small class="text-muted font-monospace mb-1" style="font-size: 0.75rem;"><?php echo $log['date']; ?></small>
                                    <p class="small m-0 text-white-50 lh-sm"><strong class="text-white"><?php echo $log['msg']; ?></strong></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>