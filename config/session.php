<?php
// config/session.php

// Démarrer la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
function estConnecte() {
    return isset($_SESSION['user_id']);
}

// Rediriger si pas connecté
function requiertConnexion() {
    if (!estConnecte()) {
        header('Location: /foncier_gloV3/login.php');
        exit();
    }
}

// Vérifier le rôle de l'utilisateur (Adapté aux sous-dossiers admin/ et consultant/)
function requiertRole($roles) {
    requiertConnexion();
    if (!in_array($_SESSION['user_role'], (array)$roles)) {
        // En cas de refus, on redirige l'utilisateur vers sa zone légitime
        redirigerSelonRole();
    }
}

// 🆕 Fonction pour rediriger automatiquement l'utilisateur selon son rôle
function redirigerSelonRole() {
    requiertConnexion();
    $role = $_SESSION['user_role'] ?? '';
    
    switch ($role) {
        case 'administrateur':
        case 'agent_sade':
        case 'chef_service':
            header('Location: /foncier_gloV3/dashboard.php');
            break;
        case 'consultant':
            header('Location: /foncier_gloV3/consultant/dashboard.php');
            break;
        default:
            header('Location: /foncier_gloV3/login.php');
            break;
    }
    exit();
}

// Nettoyer les données saisies
function nettoyer($donnee) {
    return htmlspecialchars(
        strip_tags(trim($donnee)),
        ENT_QUOTES,
        'UTF-8'
    );
}

// Afficher un message flash
function flashMessage($type, $message) {
    $_SESSION['flash'] = [
        'type'    => $type, // 'success', 'danger', 'warning', 'info'
        'message' => $message
    ];
}

// 🆕 Fonction pour afficher et vider le message flash dans tes vues HTML
function afficherFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']); // Supprime le message après affichage
        
        echo '<div class="alert alert-' . htmlspecialchars($flash['type']) . ' alert-dismissible fade show" role="alert">
                ' . htmlspecialchars($flash['message']) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
?>