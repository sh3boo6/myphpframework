<?php
// API route test endpoint

// Make sure framework is initialized
require_once __DIR__ . '/../src/init.php';

// Set proper content type header
header('Content-Type: application/json');

// Get request information
$requestInfo = [
    'url' => [
        'request_uri' => $_SERVER['REQUEST_URI'],
        'script_name' => $_SERVER['SCRIPT_NAME'],
        'path_info' => $_SERVER['PATH_INFO'] ?? null,
        'query_string' => $_SERVER['QUERY_STRING'] ?? null,
        'http_host' => $_SERVER['HTTP_HOST'],
        'php_self' => $_SERVER['PHP_SELF'],
    ],
    'route' => [
        'current_url' => current_url(),
        'full_url' => full_url(),
        'route_to_self' => route('api/test-route'),
        'route_to_api_data' => route('api/data'),
        'route_to_api_users' => route('api/users/all'),
    ],
    'server' => [
        'server_software' => $_SERVER['SERVER_SOFTWARE'],
        'document_root' => $_SERVER['DOCUMENT_ROOT'],
        'script_filename' => $_SERVER['SCRIPT_FILENAME'],
    ],
    'framework' => [
        'base_url' => APP['baseUrl'],
        'base_path' => dirname($_SERVER['SCRIPT_NAME']),
        'api_dir' => APP['router']['apiDir'] ?? 'api',
    ]
];

// Return as JSON
echo json_encode($requestInfo, JSON_PRETTY_PRINT);
