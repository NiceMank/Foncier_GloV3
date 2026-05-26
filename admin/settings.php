<?php
// admin/settings.php
require_once '../config/session.php';
require_once '../config/database.php';
requiertRole(['administrateur', 'agent_sade', 'chef_service']);

$titre = "Paramètres du Système";
$role_user = $_SESSION['user_role'] ?? '';
require_once '../includes/header.php'; 
require_once '../includes/navbar_admin.php'; 
?>

<div class="container-fluid p-4 p-md-5">
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1" style="color: var(--md-primary);">Paramètres Généraux</h1>
        <p class="text-muted small">Configurez vos options de sécurité de profil et accédez aux outils d'administration du cadastre.</p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="bento-card bg-white shadow-sm p-4 h-100 border-0">
                <h5 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-primary">lock_reset</span>Sécurité du profil
                </h5>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Adresse Email Professionnelle</label>
                        <input type="email" class="form-control text-muted" value="<?php echo htmlspecialchars($_SESSION['user_email'] ?? ''); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Nouveau mot de passe</label>
                        <input type="password" class="form-control" placeholder="Minimum 6 caractères">
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-muted">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" placeholder="Répéter le mot de passe">
                    </div>
                    <button type="submit" class="btn text-white fw-semibold px-4" style="background-color: var(--md-primary); border-radius: 8px;">Mettre à jour mes accès</button>
                </form>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <?php if ($role_user === 'administrateur'): ?>
                <div class="bento-card bg-white shadow-sm p-4 h-100 border-0">
                    <h5 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-danger">shield_person</span>Maintenance Cadastrale
                    </h5>
                    <p class="small text-muted mb-4">Outils système réservés aux administrateurs généraux.</p>
                    <div class="d-flex flex-column gap-3">
                        <div class="p-3 bg-light border rounded-3 d-flex justify-content-between align-items-center">
                            <div>
                                <strong class="text-dark d-block small">Sauvegarde de sécurité automatisée (Backup)</strong>
                                <small class="text-muted font-monospace" style="font-size: 0.7rem;">Dernier export SQL : Aujourd'hui à 04:00</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary fw-semibold" style="border-radius: 6px;">Exporter la BDD</button>
                        </div>
                        <div class="p-3 bg-light border rounded-3 d-flex justify-content-between align-items-center">
                            <div>
                                <strong class="text-dark d-block small">Journal de Sécurité (Audit Logs)</strong>
                                <small class="text-muted" style="font-size: 0.7rem;">Consultez les tentatives d'authentification et les verrous de parcelles.</small>
                            </div>
                            <a href="/foncier_gloV3/admin/users/index.php" class="btn btn-sm btn-light border fw-semibold" style="border-radius: 6px;">Ouvrir l'audit</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="bento-card border-0 shadow-sm p-4 bg-light text-center d-flex flex-column align-items-center justify-content-center h-100">
                    <span class="material-symbols-outlined fs-1 text-muted opacity-50 mb-2">info</span>
                    <h6 class="fw-bold text-dark mb-1">Menu Restreint</h6>
                    <p class="small text-muted m-0" style="max-width: 250px;">Les outils de maintenance globale et d'exports SQL de la commune de Glo-Djigbé sont réservés à l'administrateur système principal.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>