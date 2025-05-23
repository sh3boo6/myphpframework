# MyPHPFramework - PHP with File-Based Routing

A lightweight PHP framework inspired by Nuxt.js that uses file-based routing to automatically create application routes based on your project structure.

## Features

- **File-based Routing:** Create pages in the `/pages` directory and they're automatically available as routes
- **Dynamic Routes:** Support for dynamic parameters with `[param].php` filename pattern
- **API Support:** Dedicated `/api` directory for JSON endpoints
- **Helper Functions:** Convenient functions like `route()`, `param()`, and more for easy development
- **Layouts System:** Reusable layout components
- **Global State:** Application-wide state management

## Directory Structure

```
/
├── api/                 # API endpoints
│   ├── data.php         # /api/data
│   └── users/           # /api/users/*
│       ├── all.php      # /api/users/all
│       ├── single.php   # /api/users/single
│       └── [id].php     # /api/users/:id
├── layouts/             # Layout components
│   ├── end.php
│   ├── head.php
│   ├── scripts.php
│   └── start.php
├── pages/               # Page routes
│   ├── 404.php          # Custom 404 page
│   ├── about.php        # /about
│   ├── contact.php      # /contact
│   ├── index.php        # /
│   ├── state-demo.php   # /state-demo
│   ├── documentation.php # /documentation
│   ├── products/        # /products/*
│   │   ├── index.php    # /products
│   │   └── [id].php     # /products/:id
│   └── users/           # /users/*
│       ├── index.php    # /users
│       └── [id].php     # /users/:id
└── src/                 # Framework core
    ├── config.php       # Configuration
    ├── helpers.php      # Helper functions
    ├── init.php         # Bootstrap code
    ├── Router.php       # Routing system
    └── State.php        # Global state management
```

## Routing System

### Basic Routes

- `/pages/about.php` → `/about`
- `/pages/contact.php` → `/contact`

### Dynamic Routes

- `/pages/products/[id].php` → `/products/:id`
- Access parameters using `param('id')`

### Nested Routes

- `/pages/users/index.php` → `/users`
- `/pages/users/[id].php` → `/users/:id`

## Helper Functions

- `route('users/1')` - Generate URL to a route
- `param('id')` - Get route parameter
- `layout('head', ['title' => 'Page'])` - Include layout component
- `state('key')` - Access global state

## Setup Instructions for XAMPP

1. Clone the repository into your XAMPP htdocs folder
2. Make sure mod_rewrite is enabled in your Apache configuration
3. Access the application at `http://localhost/myphpframework`

## Using the route() Function

The `route()` function is a powerful tool for generating URLs with proper subdirectory handling:

```php
// Basic usage (with subdirectory installation)
echo route('about'); // Outputs: "/myphpframework/about"

// With parameters
echo route('users/[id]', ['id' => 42]); // Outputs: "/myphpframework/users/42"

// Absolute URL
echo route('api/data', [], true); // Outputs: "http://localhost/myphpframework/api/data"
```

In JavaScript:
```javascript
// Basic usage (with subdirectory handling)
const aboutUrl = route('about'); // "/myphpframework/about"

// With parameters
const userProfileUrl = route('users/[id]', {id: 42}); // "/myphpframework/users/42"
```

## Subdirectory Installation

If you're installing the framework in a subdirectory (e.g., `/myphpframework/`):

1. Make sure the `.htaccess` file has the correct `RewriteBase` setting:
   ```apache
   # Set the base directory
   RewriteBase /myphpframework/

   # Also update the API condition
   RewriteCond %{REQUEST_URI} !^/myphpframework/api/
   ```

2. Use the `route()` function for all URLs to ensure they include the base path

3. Check your configuration using the built-in framework configuration page: `/myphpframework/config`
```

## Configuration Options

Edit the configuration in `src/config.php`:

```php
define('APP', [
    'name' => 'MyPHPFramework',
    'root' => dirname(dirname(__FILE__)),
    'debug' => true,  // Enable debug mode for development
    'version' => '1.0.0',
    'router' => [
        'basePath' => '',  // Set this if the app is in a subdirectory
        'pagesDir' => 'pages',  // Directory for page routes
        'apiDir' => 'api',  // Directory for API routes
        'notFoundPage' => '/pages/404.php',  // Custom 404 page
    ]
]);
```

## License

MIT
