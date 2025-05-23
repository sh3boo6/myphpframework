<?php layout('start', ['title' => 'Vue Global Methods Demo']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <h1>Vue Global Methods Demo</h1>
            <p class="lead">Demonstration of all available Vue global methods in your framework.</p>
            
            <div id="demo-app">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Routing & API Methods</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Current Route:</strong> {{ $route('vue-globals-demo') }}</p>
                                <p><strong>User Route:</strong> {{ $route('users/123') }}</p>
                                <p><strong>Absolute Route:</strong> {{ $route('api/users/all', {}, true) }}</p>
                                
                                <button @click="testApi" class="btn btn-primary">Test API Call</button>
                                <div v-if="apiResult" class="mt-2">
                                    <strong>API Result:</strong> {{ apiResult.length }} users loaded
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Text & Formatting Methods</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Text Truncation:</strong><br>
                                {{ $truncate(longText, 50) }}</p>
                                
                                <p><strong>Currency Formatting:</strong><br>
                                {{ $currency(1234.56) }}</p>
                                
                                <p><strong>Date Formatting:</strong><br>
                                {{ $date(new Date()) }}</p>
                                
                                <p><strong>Custom Date:</strong><br>
                                {{ $date(new Date(), { month: 'short', day: 'numeric' }) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Configuration & State</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>App Name:</strong> {{ $config('appName') }}</p>
                                <p><strong>Debug Mode:</strong> {{ $config('debug') ? 'Enabled' : 'Disabled' }}</p>
                                <p><strong>Base URL:</strong> {{ $config('baseUrl') }}</p>
                                <p><strong>Version:</strong> {{ $config('version') }}</p>
                                
                                <h6 class="mt-3">Full Config:</h6>
                                <pre class="bg-light p-2 small">{{ JSON.stringify($config(), null, 2) }}</pre>
                                
                                <h6 class="mt-3">App State:</h6>
                                <pre class="bg-light p-2 small">{{ JSON.stringify($state(), null, 2) }}</pre>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Debug Methods</h5>
                            </div>
                            <div class="card-body">
                                <button @click="testDebug" class="btn btn-secondary">Test Debug Output</button>
                                <p class="mt-2 small text-muted">Check browser console for debug output</p>
                                
                                <div class="mt-3">
                                    <h6>Sample Data Processing:</h6>
                                    <p>{{ $debug(sampleData, 'Sample Data') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5>Usage Examples</h5>
                    </div>
                    <div class="card-body">
                        <h6>In Vue Templates:</h6>
                        <pre class="bg-light p-3"><code>&lt;!-- Routing --&gt;
&lt;a :href="$route('users/' + user.id)"&gt;View User&lt;/a&gt;

&lt;!-- API Calls --&gt;
this.$api('api/users/all').then(data =&gt; { ... })

&lt;!-- Text Formatting --&gt;
{{ $truncate(description, 100) }}
{{ $currency(price) }}
{{ $date(createdAt) }}

&lt;!-- Configuration --&gt;
&lt;span v-if="$config('debug')"&gt;Debug Mode&lt;/span&gt;

&lt;!-- Debugging --&gt;
{{ $debug(userData, 'User Data') }}</code></pre>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <?php layout('scripts') ?>
    <script>
        createAppWithGlobals({
            data() {
                return {
                    longText: 'This is a very long text that demonstrates the truncation functionality. It contains more than 50 characters and will be cut off with an ellipsis.',
                    apiResult: null,
                    sampleData: {
                        name: 'Sample User',
                        email: 'sample@example.com',
                        timestamp: new Date().toISOString()
                    }
                }
            },
            methods: {
                testApi() {
                    this.$api('api/users/all')
                        .then(data => {
                            this.apiResult = data;
                            console.log('API test successful:', data);
                        })
                        .catch(error => {
                            console.error('API test failed:', error);
                            this.apiResult = [];
                        });
                },
                testDebug() {
                    this.$debug({
                        message: 'This is a debug test',
                        timestamp: new Date(),
                        data: { test: true, value: 42 }
                    }, 'Debug Test');
                }
            }
        }).mount('#demo-app')
    </script>
<?php layout('end') ?>
