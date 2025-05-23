<?php
// API Route Test Script
// This script helps diagnose and verify API routing in subdirectory installations

// Include framework initialization
require_once __DIR__ . '/src/init.php';

// Set header for plain text output
header('Content-Type: text/plain');

echo "======================================\n";
echo "API ROUTE TEST SCRIPT\n";
echo "======================================\n\n";

// Environment Information
echo "ENVIRONMENT INFORMATION:\n";
echo "----------------------\n";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "Base Path: " . dirname($_SERVER['SCRIPT_NAME']) . "\n\n";

// Framework Configuration
echo "FRAMEWORK CONFIGURATION:\n";
echo "----------------------\n";
echo "App Base URL: " . APP['baseUrl'] . "\n";
echo "Router Base Path: " . (APP['router']['basePath'] ?? 'Not set') . "\n";
echo "API Directory: " . (APP['router']['apiDir'] ?? 'api') . "\n\n";

// URL Generation Tests
echo "URL GENERATION TESTS:\n";
echo "-------------------\n";
echo "Home URL: " . route('') . "\n";
echo "About URL: " . route('about') . "\n";
echo "API Data URL: " . route('api/data') . "\n";
echo "API Users URL: " . route('api/users/all') . "\n";
echo "API Test Route URL: " . route('api/test-route') . "\n\n";

// API Route Tests
echo "API ROUTE AVAILABILITY TESTS:\n";
echo "--------------------------\n";

// Function to test if a file exists
function testFilePath($path) {
    return file_exists($path) ? "EXISTS" : "MISSING";
}

// Test API files
$apiRoot = APP['root'] . '/' . (APP['router']['apiDir'] ?? 'api');
echo "API Root Directory: $apiRoot (" . (is_dir($apiRoot) ? "EXISTS" : "MISSING") . ")\n";
echo "API Data File: $apiRoot/data.php (" . testFilePath("$apiRoot/data.php") . ")\n";
echo "API Users Directory: $apiRoot/users (" . (is_dir("$apiRoot/users") ? "EXISTS" : "MISSING") . ")\n";
echo "API Users All File: $apiRoot/users/all.php (" . testFilePath("$apiRoot/users/all.php") . ")\n";
echo "API Test Route File: $apiRoot/test-route.php (" . testFilePath("$apiRoot/test-route.php") . ")\n\n";

// Router Tests
echo "ROUTER CONFIGURATION TEST:\n";
echo "------------------------\n";
$router = new Router();

// Use reflection to access private properties
$reflection = new ReflectionClass($router);

// Get routes
$routesProperty = $reflection->getProperty('routes');
$routesProperty->setAccessible(true);
$routes = $routesProperty->getValue($router);

// Filter for API routes
$apiRoutes = [];
foreach ($routes as $pattern => $route) {
    if ($route['type'] === 'API') {
        $apiRoutes[$pattern] = $route;
    }
}

echo "Total Routes: " . count($routes) . "\n";
echo "API Routes: " . count($apiRoutes) . "\n\n";

echo "API ROUTES DETAILS:\n";
echo "-----------------\n";
foreach ($apiRoutes as $pattern => $route) {
    $displayPattern = str_replace(['\/','(',')','\^','$'], ['/', '', '', '', ''], $pattern);
    echo "Route: $displayPattern\n";
    echo "  File: " . $route['file'] . " (" . (file_exists($route['file']) ? "EXISTS" : "MISSING") . ")\n";
    echo "  Params: " . (!empty($route['params']) ? implode(', ', $route['params']) : "none") . "\n";
    echo "\n";
}

echo "======================================\n";
echo "TEST COMPLETE\n";
echo "======================================\n";
