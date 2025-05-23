<?php layout('start', ['title' => 'Global State Demo']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h1>Global State & URL Demo</h1>
                            <a href="<?= route('') ?>" class="btn btn-secondary">Back Home</a>
                        </div>
                        
                        <div class="card-body">
                            <div class="alert alert-info">
                                <p>This page demonstrates how to access the current URL through different methods.</p>
                                <p><strong>Note:</strong> After our fixes, all methods should show the same value!</p>
                            </div>
                            
                            <h3>PHP Global State Values</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Variable/Function</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>$currentUrl</code></td>
                                            <td><?= get_current_url() ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>$fullUrl</code></td>
                                            <td><?= get_full_url() ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>get_current_url()</code></td>
                                            <td><?= get_current_url() ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>get_full_url()</code></td>
                                            <td><?= get_full_url() ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>APP['baseUrl']</code></td>
                                            <td><?= APP['baseUrl'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>state('currentUrl')</code></td>
                                            <td><?= state('currentUrl') ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>state('requestTime')</code></td>
                                            <td><?= date('Y-m-d H:i:s', state('requestTime')) ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>state('requestMethod')</code></td>
                                            <td><?= state('requestMethod') ?></td>
                                        </tr>
                                        <tr>
                                            <td><code>state('isAjax')</code></td>
                                            <td><?= state('isAjax') ? 'true' : 'false' ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <hr>
                            
                            <div id="js-demo">
                                <h3>JavaScript Global Variables</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Variable</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>currentUrl</code></td>
                                                <td>{{ jsCurrentUrl }}</td>
                                            </tr>
                                            <tr>
                                                <td><code>fullUrl</code></td>
                                                <td>{{ jsFullUrl }}</td>
                                            </tr>
                                            <tr>
                                                <td><code>siteConfig.baseUrl</code></td>
                                                <td>{{ jsBaseUrl }}</td>
                                            </tr>
                                            <tr>
                                                <td><code>appState</code></td>
                                                <td><pre>{{ JSON.stringify(jsAppState, null, 2) }}</pre></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="mt-4">
                                    <button @click="testUrlFunctions" class="btn btn-primary">Test URL Functions</button>
                                </div>
                                
                                <div v-if="urlTestResult" class="alert alert-info mt-3">
                                    <pre>{{ urlTestResult }}</pre>
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
        // Client-side version of route() function
        function route(path = '', params = {}, absolute = false) {
            // Clean up the path
            path = path.replace(/^\/+/, '');
            
            // Handle empty path (home page)
            if (path === '') {
                return absolute ? siteConfig.baseUrl : '/';
            }
            
            // Replace parameter placeholders for dynamic routes
            if (params) {
                for (const [key, value] of Object.entries(params)) {
                    // Replace both [param] and :param formats
                    path = path.replace(`[${key}]`, value);
                    path = path.replace(`:${key}`, value);
                }
            }
            
            // Return either absolute or relative URL
            return absolute ? siteConfig.baseUrl + '/' + path : '/' + path;
        }
        
        createApp({
            data() {
                return {
                    jsCurrentUrl: currentUrl,
                    jsFullUrl: fullUrl,
                    jsBaseUrl: siteConfig.baseUrl,
                    jsAppState: appState,
                    urlTestResult: null
                }
            },
            methods: {
                testUrlFunctions() {
                    const result = {
                        currentUrl: currentUrl,
                        baseUrl: siteConfig.baseUrl,
                        combinedUrl: siteConfig.baseUrl + (currentUrl === '/' ? '' : currentUrl),
                        windowLocation: window.location.href,
                        pathname: window.location.pathname,
                        host: window.location.host,
                        // Test route function
                        routeHome: route(''),
                        routeAbout: route('about'),
                        routeUserWithId: route('users/1'),
                        routeUserWithParams: route('users/[id]', {id: 42}),
                        routeAbsoluteUrl: route('api/data', {}, true)
                    };
                    
                    this.urlTestResult = JSON.stringify(result, null, 2);
                }
            }
        }).mount('#js-demo')
    </script>
<?php layout('end') ?>
