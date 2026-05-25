<?php
require_once 'config/database.php';
require_once 'config/session.php';

// Redirection si l'utilisateur est déjà connecté
if (estConnecte()) {
    header('Location: /foncier_gloV3/dashboard.php');
    exit();
}

$erreur = '';
$email  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Utilisation de la fonction globale de nettoyage
    $email    = nettoyer($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $erreur = 'Veuillez remplir tous les champs.';
    } else {
        $conn = getConnexion();

        // Récupération de l'utilisateur actif
        $sql  = "SELECT * FROM users WHERE email = ? AND statut = 'actif' LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user   = $result->fetch_assoc();

        // Vérification du mot de passe crypté
        if ($user && password_verify($password, $user['password'])) {
            
            $_SESSION['user_id']     = $user['id'];
            $_SESSION['user_nom']    = $user['nom'];
            $_SESSION['user_prenom'] = $user['prenom'];
            $_SESSION['user_email']  = $user['email'];
            $_SESSION['user_role']   = $user['role'];

            // Enregistrement du timestamp de connexion
            $sql2  = "UPDATE users SET derniere_connexion = NOW() WHERE id = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param('i', $user['id']);
            $stmt2->execute();
            $stmt2->close();

            $stmt->close();
            $conn->close();

            header('Location: /foncier_gloV3/dashboard.php');
            exit();
        } else {
            $erreur = 'Email ou mot de passe incorrect.';
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Système Foncier Glo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz@24" rel="stylesheet">
    
    <style>
        :root {
            --brand-blue-dark: #1e4b75;
            --brand-blue-light: #eff4ff;
            --brand-blue-accent: #2e75b6;
            --text-dark: #0b1c30;
            --text-muted: #42474f;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #ffffff;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Panneau de Gauche (Visuel de marque) */
        .brand-panel {
            background-color: var(--brand-blue-dark);
            background-image: radial-gradient(circle at 20% 50%, rgba(46, 117, 182, 0.3) 0%, transparent 70%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem;
        }

        .brand-content h1 {
            font-size: 2.75rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .brand-content p {
            font-size: 1.125rem;
            color: #d3e4fe;
            line-height: 1.6;
        }

        /* Panneau de Droite (Formulaire) */
        .form-panel {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem;
            background-color: #ffffff;
        }

        .form-container {
            width: 100%;
            max-width: 440px;
        }

        /* Logo de l'application */
        .app-logo-box {
            width: 56px;
            height: 56px;
            border: 1px solid #c2c7d0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--brand-blue-dark);
            background-color: #ffffff;
        }

        /* Personnalisation des inputs flottants pour correspondre au design épuré */
        .form-floating > .form-control {
            border: 1px solid #c2c7d0;
            border-radius: 8px;
            height: 54px;
        }

        .form-floating > .form-control:focus {
            border-color: var(--brand-blue-accent);
            box-shadow: 0 0 0 4px rgba(46, 117, 182, 0.15);
        }

        /* Bouton d'action principal */
        .btn-connect {
            background-color: var(--brand-blue-accent);
            border: none;
            border-radius: 8px;
            height: 50px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-connect:hover {
            background-color: var(--brand-blue-dark);
        }

        /* Badge de sécurité inférieur */
        .security-badge {
            background-color: var(--brand-blue-light);
            border: 1px solid #d3e4fe;
            border-radius: 8px;
            padding: 1rem;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .security-badge i {
            color: var(--brand-blue-accent);
            font-size: 1.25rem;
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        
        <div class="col-lg-6 d-none d-lg-flex brand-panel text-white">
            <div class="brand-content data-content-wrapper" style="max-width: 520px;">
                <h1>Simplifiez vos démarches foncières</h1>
                <p>
                    La plateforme officielle pour la gestion et la sécurisation du cadastre. 
                    Un système moderne, transparent et centralisé pour tous les acteurs du foncier au Bénin.
                </p>
            </div>
        </div>

        <div class="col-lg-6 form-panel">
            <div class="form-container">
                
                <div class="d-flex align-items-center gap-3 mb-5">
                    <div class="app-logo-box">
                        <span class="material-symbols-outlined">layers</span>
                    </div>
                    <div>
                        <h4 class="m-0 fw-bold text-dark tracking-tight" style="color: var(--brand-blue-dark);">Système Foncier Glo</h4>
                        <small class="text-uppercase fw-semibold tracking-wider text-muted" style="font-size: 0.75rem;">SADE — Direction du Foncier</small>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="fw-bold text-dark m-0">Connexion à votre espace</h3>
                    <p class="text-muted mt-1">Veuillez vous identifier pour accéder au registre foncier.</p>
                </div>

                <?php if (!empty($erreur)): ?>
                <div class="alert alert-danger d-flex align-items-center gap-2 py-3 border-0 rounded-3" style="background-color: #ffdad6; color: #410002;">
                    <span class="material-symbols-outlined text-danger">error</span>
                    <div class="fw-medium small"><?php echo htmlspecialchars($erreur); ?></div>
                </div>
                <?php endif; ?>

                <form method="POST" action="" class="needs-validation">
                    
                    <div class="form-floating mb-3">
                        <input type="email" 
                               name="email" 
                               class="form-control" 
                               id="emailInput" 
                               placeholder="nom@exemple.com"
                               value="<?php echo htmlspecialchars($email); ?>" 
                               required autofocus>
                        <label for="emailInput" class="text-muted">Adresse Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" 
                               name="password" 
                               class="form-control" 
                               id="passwordInput" 
                               placeholder="••••••••" 
                               required>
                        <label for="passwordInput" class="text-muted">Mot de passe</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label small text-muted fw-medium" for="rememberMe">
                                Se souvenir de moi
                            </label>
                        </div>
                        <a href="#" class="small fw-semibold text-decoration-none" style="color: var(--brand-blue-accent);">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-primary btn-connect text-white w-100 d-flex align-items-center justify-content-center gap-2">
                        <span>Se connecter</span>
                        <span class="material-symbols-outlined small">login</span>
                    </button>

                </form>

                <div class="security-badge d-flex gap-3 align-items-start mt-5">
                    <span class="material-symbols-outlined mt-1">verified_user</span>
                    <p class="m-0 small lh-base">
                        Accès sécurisé — Redirection automatique selon votre profil (Agent, Chef, Propriétaire).
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>