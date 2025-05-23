<?php layout('start', ['title' => 'Documentation']) ?>
    <div id="main" class="container py-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>Framework Documentation</h1>
                        <a href="<?= route('') ?>" class="btn btn-secondary">Back Home</a>
                    </div>
                    
                    <div class="card-body">
                        <h2 class="mt-4">File-Based Routing System</h2>
                        <p class="lead">MyPHPFramework provides a Nuxt.js-inspired file-based routing system that automatically creates routes based on your file structure.</p>
                        
                        <div class="alert alert-info">
                            <strong>Note:</strong> This framework is designed to simplify PHP web development by making routing automatic and intuitive.
                        </div>
                        
                        <h3 class="mt-4">How Routes Work</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>File Path</th>
                                        <th>URL Route</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>/pages/index.php</code></td>
                                        <td><code>/</code></td>
                                        <td>Homepage</td>
                                    </tr>
                                    <tr>
                                        <td><code>/pages/about.php</code></td>
                                        <td><code>/about</code></td>
                                        <td>Static page</td>
                                    </tr>
                                    <tr>
                                        <td><code>/pages/users/index.php</code></td>
                                        <td><code>/users</code></td>
                                        <td>Index page for users section</td>
                                    </tr>
                                    <tr>
                                        <td><code>/pages/users/[id].php</code></td>
                                        <td><code>/users/:id</code></td>
                                        <td>Dynamic page with parameter</td>
                                    </tr>
                                    <tr>
                                        <td><code>/api/data.php</code></td>
                                        <td><code>/api/data</code></td>
                                        <td>API endpoint</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <h3 class="mt-4">Dynamic Routes</h3>
                        <p>Files with names like <code>[param].php</code> will create dynamic routes where <code>param</code> becomes a route parameter.</p>
                        <pre><code>// File: /pages/products/[id].php
// URL: /products/123
// Access the ID with: 
$productId = param('id'); // Returns "123"</code></pre>
                        
                        <h3 class="mt-4">API Routes</h3>
                        <p>Files placed in the <code>/api</code> directory will be handled as API endpoints with JSON responses automatically.</p>
                        
                        <h3 class="mt-4">Helper Functions</h3>
                        
                        <h4 class="mt-3"><code>route($path, $params = [], $absolute = false)</code></h4>
                        <p>Generates a URL to a route in your application with proper base path handling for subdirectory installations:</p>
                        <pre><code>// Basic usage (with subdirectory installation)
echo route('about'); // Outputs: "/myphpframework/about"

// With parameters
echo route('users/[id]', ['id' => 42]); // Outputs: "/myphpframework/users/42"

// Absolute URL
echo route('api/data', [], true); // Outputs: "http://localhost/myphpframework/api/data"</code></pre>
                        
                        <h4 class="mt-3"><code>param($name, $default = null)</code></h4>
                        <p>Get a parameter from the current route:</p>
                        <pre><code>// In /pages/users/[id].php accessed via /users/42
$userId = param('id'); // Returns: "42"
$optional = param('page', 1); // Returns: 1 (default)</code></pre>
                        
                        <h4 class="mt-3"><code>layout($name, $data = [])</code></h4>
                        <p>Include a layout file with optional data:</p>
                        <pre><code>// Include head.php with title data
layout('head', ['title' => 'My Page']);</code></pre>
                        
                        <h4 class="mt-3"><code>state($key = null, $default = null)</code></h4>
                        <p>Access global state variables:</p>
                        <pre><code>// Get specific state value
$currentUrl = state('currentUrl');

// Get all state values
$allState = state();</code></pre>
                        
                        <h3 class="mt-4">Client-Side Usage</h3>
                        <p>In JavaScript, the <code>route()</code> function is also available in Vue.js components and automatically handles subdirectory installations:</p>
                        <pre><code>// Basic Vue.js example (with subdirectory installation)
&lt;a :href="route('users/' + userId)"&gt;User Profile&lt;/a&gt;
// Outputs: href="/myphpframework/users/123"

// With parameters
&lt;a :href="route('products/[id]', {id: product.id})"&gt;Product Details&lt;/a&gt;
// Outputs: href="/myphpframework/products/456"</code></pre>
                        
                        <h3 class="mt-4">Advanced Routing Tips</h3>
                        <ul>
                            <li>Use <code>index.php</code> files for directory index routes</li>
                            <li>Nest directories to create hierarchical routes</li>
                            <li>For SEO-friendly URLs, always use the <code>route()</code> function instead of hardcoded paths</li>
                            <li>The router handles both regular pages and API endpoints differently</li>
                            <li>Custom 404 pages can be configured in the <code>config.php</code> file</li>
                            <li>For applications installed in subdirectories (like /myphpframework/), the <code>route()</code> function automatically includes the base path</li>
                            <li>When switching between local development and production, the base URL is automatically detected</li>
                        </ul>
                        
                        <h3 class="mt-4">Subdirectory Installation</h3>
                        <p>If you're installing this framework in a subdirectory (e.g., <code>/myphpframework/</code>), you need to update the <code>.htaccess</code> file:</p>
                        
                        <pre><code># Set the base directory
RewriteBase /myphpframework/

# Also update the API condition
RewriteCond %{REQUEST_URI} !^/myphpframework/api/</code></pre>
                        
                        <p>The framework will automatically detect the base URL and adjust all links accordingly.</p>
                        
                        <h3 class="mt-4">Testing Routes</h3>
                        <p>Visit the <a href="<?= route('url-test') ?>">URL Test</a> page to see how URLs are handled in both PHP and JavaScript contexts.</p>
                        
                        <h4 class="mt-3">Troubleshooting API URLs</h4>
                        <p>When using API endpoints, always use the <code>route()</code> function in JavaScript to ensure the correct base path is included:</p>
                        <pre><code>// CORRECT - Using route() function for API calls
fetch(route('api/users/all'))
    .then(response => response.json())
    .then(data => {
        this.users = data;
    });
    
// INCORRECT - Using hardcoded paths
fetch('/api/users/all')      // This will fail in subdirectory installs!
    .then(response => response.json());

// BEST PRACTICE - Using the fetchApi utility function
fetchApi('api/users/all')    // This will always work in any installation
    .then(data => {
        this.users = data;
    });
</code></pre>
                        
                        <h3 class="mt-4">API Testing Tools</h3>
                        <p>The framework provides specialized tools for testing and debugging API functionality:</p>
                        
                        <ol>
                            <li>
                                <strong>API Testing Page:</strong> Use the <a href="<?= route('api-test') ?>">API Test</a> page to test all API endpoints with proper URL handling.
                            </li>
                            <li>
                                <strong>Test Route Endpoint:</strong> Access <code><?= route('api/test-route') ?></code> directly to see detailed request and route information.
                            </li>
                            <li>
                                <strong>fetchApi Utility:</strong> Use the <code>fetchApi('api/endpoint')</code> JavaScript function instead of raw fetch for proper URL handling.
                            </li>
                        </ol>
                        
                        <p>If you're still having issues with API URLs, try using these additional debugging tools:</p>
                        <ol>
                            <li>Go to the <a href="<?= route('url-test') ?>">URL Test</a> page</li>
                            <li>Click the "Debug URL Generation" button</li>
                            <li>Check the console for detailed information</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php layout('scripts') ?>
<?php layout('end') ?>
