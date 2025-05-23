<?php
// API Debug endpoint
header('Content-Type: application/json');

// Include required files so we can access the Router directly
if (!function_exists('state')) {
    require_once __DIR__ . '/src/init.php';
}

// Create a special debug array with:
// 1. Request Information
// 2. Route Matching attempts
// 3. Server Variables 
$debug = [
    'request' => [
        'uri' => $_SERVER['REQUEST_URI'],
        'method' => $_SERVER['REQUEST_METHOD'],
        'time' => date('Y-m-d H:i:s'),
        'query' => $_GET,
    ],
    'routing' => [
        'currentUrl' => current_url(),
        'normalizedUrl' => isset($router) ? $router->getCurrentUrl() : null,
        'routeMatchAttempts' => State::get('routeMatching', []),
        'matchedRoute' => State::get('matchedRoute', []),
        'noMatchFound' => State::get('noMatchFound', false),
        'requestedUrl' => State::get('requestedUrl', '')
    ],
    'server' => [
        'script_name' => $_SERVER['SCRIPT_NAME'],
        'script_dir' => dirname($_SERVER['SCRIPT_NAME']),
        'documentRoot' => $_SERVER['DOCUMENT_ROOT'],
        'phpSelf' => $_SERVER['PHP_SELF'],
        'requestUri' => $_SERVER['REQUEST_URI']
    ],
    'routes' => [],
    'apiRoutes' => []
];

// Get routes from the router using reflection (if available)
if (isset($router)) {
    $reflection = new ReflectionClass($router);
    
    // Get routes property
    $routesProperty = $reflection->getProperty('routes');
    $routesProperty->setAccessible(true);
    $routes = $routesProperty->getValue($router);
    
    // Process routes for display
    foreach ($routes as $pattern => $route) {
        $displayPattern = str_replace(['\/','(',')','\^','$'], ['/', '', '', '', ''], $pattern);
        
        if ($route['type'] === 'API') {
            $debug['apiRoutes'][$displayPattern] = [
                'file' => $route['file'],
                'params' => $route['params'],
                'fileExists' => file_exists($route['file'])
            ];
        } else {
            $debug['routes'][$displayPattern] = [
                'file' => $route['file'],
                'params' => $route['params'],
                'fileExists' => file_exists($route['file'])
            ];
        }
    }
}

// Output the debug information
echo json_encode($debug, JSON_PRETTY_PRINT);
