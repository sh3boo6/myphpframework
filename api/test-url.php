<?php
// Set proper content type header
header('Content-Type: application/json');

// Create a response with details about the request and environment
$response = [
    'success' => true,
    'message' => 'URL test endpoint working correctly',
    'timestamp' => date('Y-m-d H:i:s'),
    'request' => [
        'method' => $_SERVER['REQUEST_METHOD'],
        'uri' => $_SERVER['REQUEST_URI'],
        'queryString' => $_SERVER['QUERY_STRING'] ?? '',
        'scriptName' => $_SERVER['SCRIPT_NAME'],
        'scriptFilename' => $_SERVER['SCRIPT_FILENAME'],
        'pathInfo' => $_SERVER['PATH_INFO'] ?? '',
        'documentRoot' => $_SERVER['DOCUMENT_ROOT']
    ],
    'server' => [
        'serverName' => $_SERVER['SERVER_NAME'],
        'serverSoftware' => $_SERVER['SERVER_SOFTWARE'],
        'httpHost' => $_SERVER['HTTP_HOST'],
        'remoteAddr' => $_SERVER['REMOTE_ADDR']
    ],
    'php' => [
        'version' => PHP_VERSION,
        'os' => PHP_OS
    ],
    'app' => [
        'baseUrl' => APP['baseUrl'],
        'scriptDir' => dirname($_SERVER['SCRIPT_NAME']),
        'currentUrl' => current_url(),
        'fullUrl' => full_url()
    ]
];

// Output the JSON response
echo json_encode($response, JSON_PRETTY_PRINT);
