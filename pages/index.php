<?php layout('start', ['title' => 'My PHP Framework - Home']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <div class="jumbotron bg-light p-5 rounded">
                <div class="d-flex align-items-top gap-2">
                    <div class="flex-shrink-0">
                        <img src="./assets/img/logo.webp" alt="Logo" class="img-fluid" style="width: 100px;">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h1 class="display-4">Welcome to My PHP Framework</h1>
                        <p class="lead">A simple, file-based routing system for PHP applications.</p>
                        <hr class="my-4">
                        <p>Explore the features and examples below to get started.</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Standard Pages</h5>
                            <p class="card-text">Simple page routes without parameters</p>
                            <a href="<?= route('about') ?>" class="btn btn-primary">About Page</a>
                            <a href="<?= route('contact') ?>" class="btn btn-outline-primary">Contact Page</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Dynamic Routes</h5>
                            <p class="card-text">Routes with dynamic parameters</p>
                            <a href="<?= route('users') ?>" class="btn btn-primary">Users List</a>
                            <a href="<?= route('users/1') ?>" class="btn btn-outline-primary">User Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">API Routes</h5>
                            <p class="card-text">Direct links to API endpoints</p>
                            <a href="<?= route('api/data') ?>" class="btn btn-primary" target="_blank">API Info</a>
                            <a href="<?= route('api/users/all') ?>" class="btn btn-outline-primary" target="_blank">Users API</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>More Examples</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="<?= route('products') ?>" class="btn btn-success w-100">Product Catalog</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="<?= route('not-found-page') ?>" class="btn btn-warning w-100">404 Page Example</a>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-info w-100" onclick="showRoutingInfo()">Show Routing Info</button>
                                </div>
                                <div class="col-md-3">
                                    <a href="<?= route('state-demo') ?>" class="btn btn-primary w-100">Global State Demo</a>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?= route('url-test') ?>" class="btn btn-info w-100">URL Handling Test</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?= route('config') ?>" class="btn btn-warning w-100">Framework Configuration</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?= route('documentation') ?>" class="btn btn-success w-100">Documentation</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?= route('api-test') ?>" class="btn btn-danger w-100">API Testing Tool</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php layout('scripts') ?>
    <script>
        function showRoutingInfo() {
            // Get base path from script directory
            const scriptPath = '<?= dirname($_SERVER["SCRIPT_NAME"]) ?>';
            const basePath = (scriptPath === '/' || scriptPath === '\\') ? '' : scriptPath;
            
            // Define routes with the correct base path
            const routes = {
                [basePath + "/"]: "/pages/index.php",
                [basePath + "/about"]: "/pages/about.php",
                [basePath + "/contact"]: "/pages/contact.php",
                [basePath + "/users"]: "/pages/users/index.php",
                [basePath + "/users/:id"]: "/pages/users/[id].php",
                [basePath + "/products"]: "/pages/products/index.php",
                [basePath + "/products/:id"]: "/pages/products/[id].php",
                [basePath + "/404"]: "/pages/404.php",
                [basePath + "/api/data"]: "/api/data.php",
                [basePath + "/api/users/all"]: "/api/users/all.php",
                [basePath + "/api/users/single"]: "/api/users/single.php"
            };

            let routingInfo = "<table class='table table-bordered'><thead><tr><th>URL Path</th><th>File Path</th></tr></thead><tbody>";
            
            for (const [route, filePath] of Object.entries(routes)) {
                routingInfo += `<tr><td>${route}</td><td>${filePath}</td></tr>`;
            }
            
            routingInfo += "</tbody></table>";

            Swal.fire({
                title: 'File-Based Routing System',
                html: routingInfo,
                width: '800px',
                confirmButtonText: 'Cool!'
            });
        }

        // Add SweetAlert2 for the routing info popup
        document.addEventListener('DOMContentLoaded', function() {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            document.head.appendChild(script);
        });
    </script>
<?php layout('end') ?>