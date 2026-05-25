<?php
/**
 * Structure Creator
 * Execute once via browser to create necessary directories and files
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

$base_path = __DIR__;
$created_dirs = [];
$created_files = [];
$errors = [];

// Create directories
$directories = [
    'admin',
    'admin/parcelles',
    'admin/proprietaires',
    'admin/alertes',
    'admin/litiges',
    'admin/transferts',
    'admin/users',
    'consultant',
    'consultant/parcelles',
    'consultant/transferts',
    'assets/uploads',
    'assets/uploads/transferts'
];

// HTML Header
echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Structure Creator - Foncier GloV3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Création de la structure du projet</h3>
        </div>
        <div class="card-body">
            <pre style="background: #f8f9fa; padding: 15px; border-radius: 5px;">';

// Try to create directories
foreach ($directories as $dir) {
    $full_path = $base_path . DIRECTORY_SEPARATOR . $dir;
    
    if (is_dir($full_path)) {
        echo "✅ Existe: <strong>$dir</strong>\n";
        $created_dirs[] = $dir;
    } else {
        // Try to create
        if (@mkdir($full_path, 0777, true)) {
            echo "✅ Créé: <strong>$dir</strong>\n";
            $created_dirs[] = $dir;
        } else {
            echo "❌ Erreur création: <strong>$dir</strong>\n";
            $errors[] = $dir;
        }
    }
}

echo "\n" . str_repeat("=", 60) . "\n";
echo "📊 RÉSUMÉ\n";
echo str_repeat("=", 60) . "\n";
echo "✅ Répertoires créés/existants: " . count($created_dirs) . "\n";
echo "❌ Erreurs: " . count($errors) . "\n";

// Create .htaccess for uploads
$htaccess_path = $base_path . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . '.htaccess';
if (!file_exists($htaccess_path)) {
    $htaccess_content = 'AddType application/octet-stream .pdf .doc .docx .xls .xlsx .png .jpg .jpeg .txt';
    if (@file_put_contents($htaccess_path, $htaccess_content)) {
        echo "✅ Fichier .htaccess créé\n";
    }
}

// Create index.php files to protect directories
$dirs_to_protect = [
    'admin',
    'admin/parcelles',
    'admin/proprietaires',
    'admin/alertes',
    'admin/litiges',
    'admin/transferts',
    'admin/users',
    'consultant',
    'consultant/parcelles',
    'consultant/transferts',
    'assets/uploads'
];

foreach ($dirs_to_protect as $dir) {
    $index_path = $base_path . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . 'index.php';
    if (!file_exists($index_path)) {
        $content = '<?php header("Location: /foncier_gloV3/index.php"); exit(); ?>';
        if (@file_put_contents($index_path, $content)) {
            echo "✅ Protection: <strong>$dir/index.php</strong>\n";
            $created_files[] = "$dir/index.php";
        }
    }
}

echo "\n" . str_repeat("=", 60) . "\n";
echo "📁 Fichiers de protection créés: " . count($created_files) . "\n";
echo str_repeat("=", 60) . "\n\n";

echo "✨ Structure créée avec succès!\n";
echo "Vous pouvez maintenant commencer à développer.\n\n";

echo '</pre>
            <div class="mt-3">
                <a href="index.php" class="btn btn-primary">Retour à l\'accueil</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>';
?>
