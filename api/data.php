<?php
// Make sure framework is initialized
require_once __DIR__ . '/../src/init.php';

// Set proper content type header
header('Content-Type: application/json');

// Sample data endpoint
$data = [
    'appName' => 'MyPHPFramework',
    'version' => '1.0.0',
    'apiVersion' => '1.0',
    'environment' => 'development',
    'serverTime' => date('Y-m-d H:i:s'),
    'features' => [
        'fileBasedRouting' => true,
        'apiSupport' => true,
        'dynamicRoutes' => true,
        'middleware' => true
    ]
];

// Return data as JSON
echo json_encode($data);