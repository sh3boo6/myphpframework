<?php layout('start', ['title' => 'API Test Page']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h1>API Test</h1>
                            <a href="<?= route('') ?>" class="btn btn-secondary">Back Home</a>
                        </div>
                        
                        <div class="card-body">
                            <div id="api-test-app">
                                <h3>API Route Testing</h3>
                                
                                <div class="alert alert-info">
                                    <p>This page tests API functionality specifically for subdirectory installations.</p>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Test API Routes</h5>
                                            </div>
                                            <div class="card-body">
                                                <button @click="testApiRoute" class="btn btn-primary mb-2 w-100">Test Route Info</button>
                                                <button @click="testApiUsers" class="btn btn-success mb-2 w-100">Test Users API</button>
                                                <button @click="testApiData" class="btn btn-info w-100">Test Data API</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>API Response</h5>
                                            </div>
                                            <div class="card-body">
                                                <div v-if="loading" class="text-center">
                                                    <div class="spinner-border" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                                <div v-else-if="error" class="alert alert-danger">
                                                    <h5>Error:</h5>
                                                    <p>{{ error }}</p>
                                                </div>
                                                <div v-else-if="response">
                                                    <h6>Response:</h6>
                                                    <pre class="bg-light p-3 border rounded">{{ JSON.stringify(response, null, 2) }}</pre>
                                                </div>
                                                <div v-else class="text-center text-muted">
                                                    <p>Click a button to test API functionality</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5>URL Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Current Script Path</td>
                                                    <td><code><?= dirname($_SERVER['SCRIPT_NAME']) ?></code></td>
                                                </tr>
                                                <tr>
                                                    <td>Base Path</td>
                                                    <td><code><?= ($scriptDir = dirname($_SERVER['SCRIPT_NAME'])) === '/' || $scriptDir === '\\' ? '/' : $scriptDir ?></code></td>
                                                </tr>
                                                <tr>
                                                    <td>API Route (JS)</td>
                                                    <td><code>{{ routeApiInfo }}</code></td>
                                                </tr>
                                                <tr>
                                                    <td>API Users Route (JS)</td>
                                                    <td><code>{{ routeApiUsers }}</code></td>
                                                </tr>
                                                <tr>
                                                    <td>API Data Route (JS)</td>
                                                    <td><code>{{ routeApiData }}</code></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5>Debug Utilities</h5>
                                    </div>
                                    <div class="card-body">
                                        <button @click="debugRoutes" class="btn btn-danger">Debug All Routes</button>
                                        <div v-if="debugInfo" class="mt-3">
                                            <pre class="bg-light p-3 border rounded">{{ debugInfo }}</pre>
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
                    response: null,
                    loading: false,
                    error: null,
                    debugInfo: null,
                    routeApiInfo: route('api/test-route'),
                    routeApiUsers: route('api/users/all'),
                    routeApiData: route('api/data')
                }
            },
            methods: {
                testApiRoute() {
                    this.loading = true;
                    this.error = null;
                    this.response = null;
                    
                    fetchApi('api/test-route')
                        .then(data => {
                            this.response = data;
                        })
                        .catch(err => {
                            this.error = err.message;
                            console.error('API Test Error:', err);
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },
                testApiUsers() {
                    this.loading = true;
                    this.error = null;
                    this.response = null;
                    
                    fetchApi('api/users/all')
                        .then(data => {
                            this.response = data;
                        })
                        .catch(err => {
                            this.error = err.message;
                            console.error('API Users Error:', err);
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },
                testApiData() {
                    this.loading = true;
                    this.error = null;
                    this.response = null;
                    
                    fetchApi('api/data')
                        .then(data => {
                            this.response = data;
                        })
                        .catch(err => {
                            this.error = err.message;
                            console.error('API Data Error:', err);
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },
                debugRoutes() {
                    const results = {
                        emptyRoute: debugRoute(''),
                        aboutRoute: debugRoute('about'),
                        apiTestRoute: debugRoute('api/test-route'),
                        apiUsersRoute: debugRoute('api/users/all'),
                        apiDataRoute: debugRoute('api/data'),
                        apiUserParamRoute: debugRoute('api/users/[id]', {id: 42})
                    };
                    
                    this.debugInfo = JSON.stringify(results, null, 2);
                }
            }
        }).mount('#api-test-app');
    </script>
<?php layout('end') ?>
