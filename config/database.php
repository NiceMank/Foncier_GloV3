<?php
// Informations de connexion
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'foncier_gloV2');

// Fonction de connexion
function getConnexion() {
    $conn = new mysqli(
        DB_HOST,
        DB_USER,
        DB_PASS,
        DB_NAME
    );

    // Vérifier si la connexion a échoué
    if ($conn->connect_error) {
        die("
            <div style='
                color: red;
                padding: 20px;
                font-family: Arial;
            '>
                Erreur de connexion : "
                . $conn->connect_error . "
            </div>
        ");
    }

    // Définir l'encodage
    $conn->set_charset('utf8mb4');

    return $conn;
}
?>