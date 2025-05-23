<?php layout('start', ['title' => 'About Us']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h1>About Our Framework</h1>
                        </div>
                        <div class="card-body">
                            <div id="about-app">
                                <h2>{{ appData.appName }} v{{ appData.version }}</h2>
                                
                                <div class="mt-4">
                                    <p>Welcome to our PHP framework with file-based routing!</p>
                                    <p>This framework provides a simple, Nuxt.js-like file-based routing system where:</p>
                                    
                                    <ul>
                                        <li><code>/pages/index.php</code> maps to <code>/</code></li>
                                        <li><code>/pages/about.php</code> maps to <code>/about</code></li>
                                        <li><code>/pages/users/index.php</code> maps to <code>/users</code></li>
                                        <li><code>/pages/users/[id].php</code> maps to <code>/users/:id</code></li>
                                    </ul>
                                    
                                    <h3>Features</h3>
                                    <ul class="list-group mb-3">
                                        <li v-for="(value, feature) in appData.features" 
                                            class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ feature }}
                                            <span class="badge bg-success rounded-pill" v-if="value">Enabled</span>
                                            <span class="badge bg-secondary rounded-pill" v-else>Disabled</span>
                                        </li>
                                    </ul>
                                    
                                    <div class="text-muted">
                                        Server time: {{ appData.serverTime }}
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <a href="<?= route('') ?>" class="btn btn-primary me-2">Home</a>
                                    <a href="<?= route('users') ?>" class="btn btn-secondary">Users</a>
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
                    appData: {}
                }
            },
            mounted() {
                // Fetch application data from API using the route function
                fetch(route('api/data'))
                    .then(response => response.json())
                    .then(data => {
                        this.appData = data;
                    })
                    .catch(error => {
                        console.error('Error fetching app data:', error);
                    });
            }
        }).mount('#about-app')
    </script>
<?php layout('end') ?>
