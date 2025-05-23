<?php layout('start', ['title' => 'URL Test Page']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h1>URL Handling Test</h1>
                            <a href="<?= route('') ?>" class="btn btn-secondary">Back Home</a>
                        </div>
                        
                        <div class="card-body">
                            <h3 class="mb-4">URL Functions Test</h3>
                            
                            <div class="alert alert-info">
                                <p>This page demonstrates how URLs are handled in the framework, especially for subdirectory installations.</p>
                            </div>
                            
                            <h4 class="mt-4">PHP URL Generation</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Function</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>route('about')</code></td>
                                            <td><?= route('about') ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>route('users/[id]', ['id' => 42])</code></td>
                                            <td><?= route('users/[id]', ['id' => 42]) ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>route('', [], true)</code> (absolute home URL)</td>
                                            <td><?= route('', [], true) ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>current_url()</code></td>
                                            <td><?= current_url() ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>full_url()</code></td>
                                            <td><?= full_url() ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>dirname($_SERVER['SCRIPT_NAME'])</code></td>
                                            <td><?= dirname($_SERVER['SCRIPT_NAME']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>APP['baseUrl']</code></td>
                                            <td><?= APP['baseUrl'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div id="js-url-test" class="mt-5">
                                <h4>JavaScript URL Generation</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Function</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>route('about')</code></td>
                                                <td>{{ routeAbout }}</td>
                                            </tr>
                                            <tr>
                                                <td><code>route('users/42')</code></td>
                                                <td>{{ routeUser }}</td>
                                            </tr>
                                            <tr>
                                                <td><code>route('products/[id]', {id: 99})</code></td>
                                                <td>{{ routeProduct }}</td>
                                            </tr>
                                            <tr>
                                                <td><code>window.location.pathname</code></td>
                                                <td>{{ locationPathname }}</td>
                                            </tr>
                                            <tr>
                                                <td><code>siteConfig.baseUrl</code></td>
                                                <td>{{ siteConfigBase }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="mt-4">
                                    <h5>Test Links</h5>
                                    <a :href="route('about')" class="btn btn-primary me-2">About Page</a>
                                    <a :href="route('users')" class="btn btn-info me-2">Users List</a>
                                    <a :href="route('products')" class="btn btn-success me-2">Products</a>
                                </div>
                                
                                <div class="mt-4">
                                    <h4>API URL Tests</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Function</th>
                                                    <th>Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><code>route('api/data')</code></td>
                                                    <td>{{ routeApi }}</td>
                                                </tr>
                                                <tr>
                                                    <td><code>route('api/users/all')</code></td>
                                                    <td>{{ routeApiUsers }}</td>
                                                </tr>
                                                <tr>
                                                    <td><code>route('api/users/[id]', {id: 5})</code></td>
                                                    <td>{{ routeApiUserParam }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <button @click="debugUrls" class="btn btn-danger me-2">Debug URL Generation</button>
                                        <a :href="route('api/test-url')" target="_blank" class="btn btn-warning">API URL Test Endpoint</a>
                                        <div v-if="debugInfo" class="mt-3 p-3 bg-light border rounded">
                                            <pre>{{ debugInfo }}</pre>
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
        createApp({
            data() {
                return {
                    routeAbout: route('about'),
                    routeUser: route('users/42'),
                    routeProduct: route('products/[id]', {id: 99}),
                    locationPathname: window.location.pathname,
                    siteConfigBase: siteConfig.baseUrl,
                    // API route tests
                    routeApi: route('api/data'),
                    routeApiUsers: route('api/users/all'),
                    routeApiUserParam: route('api/users/[id]', {id: 5}),
                    debugInfo: null
                }
            },
            methods: {
                debugUrls() {
                    // Test various URL patterns
                    const tests = [
                        debugRoute(''),
                        debugRoute('about'),
                        debugRoute('users/42'),
                        debugRoute('api/data'),
                        debugRoute('api/users/all'),
                        debugRoute('api/users/[id]', {id: 5})
                    ];
                    
                    // Add environment information
                    const info = {
                        baseUrl: siteConfig.baseUrl,
                        scriptPath: '<?= dirname($_SERVER["SCRIPT_NAME"]) ?>',
                        currentUrl: window.location.pathname,
                        tests
                    };
                    
                    this.debugInfo = JSON.stringify(info, null, 2);
                }
            }
        }).mount('#js-url-test')
    </script>
<?php layout('end') ?>
