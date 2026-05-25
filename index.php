<?php
// Auto-create necessary directories on first access
$base_path = __DIR__;
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
    'assets/uploads/transferts'
];

foreach ($directories as $dir) {
    $path = $base_path . DIRECTORY_SEPARATOR . $dir;
    if (!is_dir($path)) {
        @mkdir($path, 0777, true);
    }
}

// Create admin/dashboard.php from template if needed
$admin_dashboard = $base_path . '/admin/dashboard.php';
$admin_template = $base_path . '/admin_dashboard.php.template';
if (!file_exists($admin_dashboard) && file_exists($admin_template)) {
    @copy($admin_template, $admin_dashboard);
}

// Create consultant/dashboard.php from template if needed
$consultant_dashboard = $base_path . '/consultant/dashboard.php';
$consultant_template = $base_path . '/consultant_dashboard.php.template';
if (!file_exists($consultant_dashboard) && file_exists($consultant_template)) {
    @copy($consultant_template, $consultant_dashboard);
}

// Create protection index.php files
$dirs_to_protect = [
    'admin', 'admin/parcelles', 'admin/proprietaires', 'admin/alertes', 
    'admin/litiges', 'admin/transferts', 'admin/users', 'consultant', 
    'consultant/parcelles', 'consultant/transferts', 'assets/uploads'
];
foreach ($dirs_to_protect as $dir) {
    $index = $base_path . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . 'index.php';
    if (!file_exists($index)) {
        @file_put_contents($index, '<?php header("Location: /foncier_gloV3/index.php"); exit(); ?>');
    }
}

 header('Location: /foncier_gloV3/dashboard.php');
 exit();
 ?>