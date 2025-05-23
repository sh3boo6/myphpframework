<?php
// Make sure framework is initialized
require_once __DIR__ . '/../../src/init.php';

// Set proper content type header
header('Content-Type: application/json');

// Sample user data (in a real app, this would come from a database)
$users = [
    [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=1',
        'createdAt' => '2024-05-10'
    ],
    [
        'id' => 2,
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=2',
        'createdAt' => '2024-05-12'
    ],
    [
        'id' => 3,
        'name' => 'Bob Johnson',
        'email' => 'bob@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=3',
        'createdAt' => '2024-05-15'
    ],
    [
        'id' => 4,
        'name' => 'Alice Williams',
        'email' => 'alice@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=4',
        'createdAt' => '2024-05-18'
    ],
    [
        'id' => 5,
        'name' => 'Michael Brown',
        'email' => 'michael@example.com',
        'avatar' => 'https://i.pravatar.cc/150?img=5',
        'createdAt' => '2024-05-20'
    ]
];

// Return user data as JSON
echo json_encode($users);