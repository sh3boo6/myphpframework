<?php
// Make sure framework is initialized
require_once __DIR__ . '/../../src/init.php';

// Set proper content type header
header('Content-Type: application/json');

// Get the user ID from the route parameter
$userId = (int)$id;

// Sample user data (in a real app, this would be fetched from a database)
$users = [
    1 => [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=1',
        'createdAt' => '2024-05-10'
    ],
    2 => [
        'id' => 2,
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=2',
        'createdAt' => '2024-05-12'
    ],
    3 => [
        'id' => 3,
        'name' => 'Bob Johnson',
        'email' => 'bob@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=3',
        'createdAt' => '2024-05-15'
    ],
    4 => [
        'id' => 4,
        'name' => 'Alice Williams',
        'email' => 'alice@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=4',
        'createdAt' => '2024-05-18'
    ],
    5 => [
        'id' => 5,
        'name' => 'Michael Brown',
        'email' => 'michael@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=5',
        'createdAt' => '2024-05-20'
    ]
];

// Check if the user exists
if ($userId && isset($users[$userId])) {
    // Return the specified user
    echo json_encode($users[$userId]);
} else {
    // Return error if user not found
    http_response_code(404);
    echo json_encode([
        'error' => 'Not Found',
        'message' => 'User not found',
        'status' => 404
    ]);
}
