<?php
// Debug script to check if API endpoints are accessible directly

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>API Debug Script</h1>";

// Load the API endpoint file directly
$apiFile = __DIR__ . '/api/users/all.php';

echo "<p>Testing file: " . $apiFile . "</p>";
echo "<p>File exists: " . (file_exists($apiFile) ? 'Yes' : 'No') . "</p>";

if (file_exists($apiFile)) {
    echo "<h2>API Response:</h2>";
    echo "<pre>";
    
    // Capture output
    ob_start();
    // Ensure framework is initialized for the API file
    require_once __DIR__ . '/src/init.php';
    // Suppress duplicate header output
    if (!headers_sent()) {
        header_remove('Content-Type');
    }
    include $apiFile;
    $output = ob_get_clean();
    
    // Format JSON for display
    if (json_decode($output) !== null) {
        echo json_encode(json_decode($output), JSON_PRETTY_PRINT);
    } else {
        echo htmlspecialchars($output);
    }
    
    echo "</pre>";
}

// Show server info
echo "<h2>Server Information:</h2>";
echo "<pre>";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "</pre>";

// Show Router debug info
echo "<h2>Route Debugging:</h2>";
echo "<p>Loading router...</p>";

// Include required files
require_once __DIR__ . '/src/config.php';
require_once __DIR__ . '/src/State.php';
require_once __DIR__ . '/src/helpers.php';
require_once __DIR__ . '/src/Router.php';

// Initialize router
$router = new Router();

// Show available routes
echo "<h3>Available Routes:</h3>";
echo "<ul>";
$reflection = new ReflectionClass($router);
$property = $reflection->getProperty('routes');
$property->setAccessible(true);
$routes = $property->getValue($router);

foreach ($routes as $pattern => $route) {
    $displayPattern = str_replace(['\/','(',')','\^','$'], ['/', '', '', '', ''], $pattern);
    echo "<li><strong>" . $displayPattern . "</strong> => " . $route['file'] . " (Type: " . $route['type'] . ")</li>";
}
echo "</ul>";
