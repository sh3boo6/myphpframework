<?php 
require_once __DIR__ . '/src/init.php';

// Make sure URL variables are in the global scope
$GLOBALS['currentUrl'] = get_current_url();  
$GLOBALS['fullUrl'] = get_full_url();

// Initialize the router
$router = new Router();

// Dispatch the current request to the appropriate route
$router->dispatch();
?>