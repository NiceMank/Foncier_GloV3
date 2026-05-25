<?php
// Démarrer la session
session_start();

// Supprimer toutes les variables de session
$_SESSION = array();

// Détruire le cookie de session
if (isset($_COOKIE[session_name()])) {
    setcookie(
        session_name(),
        '',
        time() - 42000,
        '/'
    );
}

// Détruire complètement la session
session_destroy();

// Rediriger vers la page de connexion
header('Location: /foncier_gloV3/login.php');
exit();
?>