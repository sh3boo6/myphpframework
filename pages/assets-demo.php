<?php layout('start', ['title' => 'Assets Demo']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <h1>Assets Helper Demo</h1>
            <p class="lead">Demonstration of the assets() helper function and related asset helpers.</p>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>PHP Asset Functions</h5>
                        </div>
                        <div class="card-body">
                            <h6>General Assets:</h6>
                            <ul class="list-unstyled">
                                <li><strong>Logo:</strong> <code><?= assets('img/logo.webp') ?></code></li>
                                <li><strong>CSS:</strong> <code><?= assets('css/custom.css') ?></code></li>
                                <li><strong>JS:</strong> <code><?= assets('js/app.js') ?></code></li>
                                <li><strong>With version:</strong> <code><?= assets('css/style.css', false, '1.2.3') ?></code></li>
                                <li><strong>Absolute URL:</strong> <code><?= assets('img/logo.webp', true) ?></code></li>
                            </ul>
                            
                            <h6 class="mt-4">Specific Asset Helpers:</h6>
                            <ul class="list-unstyled">
                                <li><strong>CSS helper:</strong> <code><?= css('custom') ?></code></li>
                                <li><strong>JS helper:</strong> <code><?= js('app') ?></code></li>
                                <li><strong>Image helper:</strong> <code><?= img('logo.webp') ?></code></li>
                                <li><strong>Font helper:</strong> <code><?= font('custom.woff2') ?></code></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Live Asset Examples</h5>
                        </div>
                        <div class="card-body">
                            <h6>Logo Image:</h6>
                            <img src="<?= img('logo.webp') ?>" alt="Logo" class="img-fluid mb-3" style="max-height: 100px;">
                            
                            <h6>Sample Link Tags:</h6>
                            <pre class="bg-light p-2 small"><code>&lt;link rel="stylesheet" href="<?= css('custom') ?>"&gt;
&lt;script src="<?= js('app') ?>"&gt;&lt;/script&gt;
&lt;img src="<?= img('logo.webp') ?>" alt="Logo"&gt;</code></pre>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div id="vue-assets-demo">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Vue Asset Methods</h5>
                            </div>
                            <div class="card-body">
                                <h6>Vue Template Usage:</h6>
                                <ul class="list-unstyled">
                                    <li><strong>Logo:</strong> <code>{{ $img('logo.webp') }}</code></li>
                                    <li><strong>CSS:</strong> <code>{{ $css('custom') }}</code></li>
                                    <li><strong>JS:</strong> <code>{{ $js('app') }}</code></li>
                                    <li><strong>With version:</strong> <code>{{ $css('style', false, '1.2.3') }}</code></li>
                                </ul>
                                
                                <h6 class="mt-4">Generated URLs:</h6>
                                <ul class="list-unstyled small">
                                    <li><strong>Assets:</strong> {{ $assets('img/logo.webp') }}</li>
                                    <li><strong>CSS:</strong> {{ $css('custom') }}</li>
                                    <li><strong>JS:</strong> {{ $js('app') }}</li>
                                    <li><strong>Image:</strong> {{ $img('logo.webp') }}</li>
                                    <li><strong>Font:</strong> {{ $font('custom.woff2') }}</li>
                                </ul>
                                
                                <h6 class="mt-4">With Cache Busting:</h6>
                                <ul class="list-unstyled small">
                                    <li>{{ $css('style', false, appVersion) }}</li>
                                    <li>{{ $js('main', false, appVersion) }}</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header">
                                <h5>Dynamic Asset Loading</h5>
                            </div>
                            <div class="card-body">
                                <button @click="loadAsset" class="btn btn-primary mb-3">Load Dynamic CSS</button>
                                <div v-if="dynamicAsset" class="alert alert-info">
                                    Loaded: {{ dynamicAsset }}
                                </div>
                                
                                <h6>Image Gallery:</h6>
                                <div class="row">
                                    <div class="col-4" v-for="(image, index) in sampleImages" :key="index">
                                        <img :src="$img(image)" :alt="'Sample ' + (index + 1)" class="img-fluid rounded mb-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Usage Examples</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>PHP Usage:</h6>
                            <pre class="bg-light p-3"><code>&lt;!-- General assets --&gt;
&lt;link rel="stylesheet" href="&lt;?= assets('css/custom.css') ?&gt;"&gt;
&lt;script src="&lt;?= assets('js/app.js') ?&gt;"&gt;&lt;/script&gt;

&lt;!-- Specific helpers --&gt;
&lt;link rel="stylesheet" href="&lt;?= css('custom') ?&gt;"&gt;
&lt;script src="&lt;?= js('app') ?&gt;"&gt;&lt;/script&gt;
&lt;img src="&lt;?= img('logo.webp') ?&gt;" alt="Logo"&gt;

&lt;!-- With cache busting --&gt;
&lt;link rel="stylesheet" href="&lt;?= css('style', false, '1.2.3') ?&gt;"&gt;

&lt;!-- Absolute URLs --&gt;
&lt;img src="&lt;?= img('logo.webp', true) ?&gt;" alt="Logo"&gt;</code></pre>
                        </div>
                        <div class="col-md-6">
                            <h6>Vue Template Usage:</h6>
                            <pre class="bg-light p-3"><code>&lt;!-- In Vue templates --&gt;
&lt;img :src="$img('logo.webp')" alt="Logo"&gt;
&lt;link rel="stylesheet" :href="$css('custom')"&gt;

&lt;!-- Dynamic loading --&gt;
&lt;script :src="$js('module-' + moduleName)"&gt;&lt;/script&gt;

&lt;!-- With cache busting --&gt;
&lt;link :href="$css('style', false, appVersion)"&gt;

&lt;!-- In component methods --&gt;
methods: {
  loadDynamicAsset() {
    const url = this.$assets('css/theme.css');
    // Load asset dynamically
  }
}</code></pre>
                        </div>
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
                    dynamicAsset: null,
                    appVersion: '<?= APP['version'] ?>',
                    sampleImages: [
                        'logo.webp',
                        'logo.webp', // We only have one image, so repeat it for demo
                        'logo.webp'
                    ]
                }
            },
            methods: {
                loadAsset() {
                    // Example of dynamic asset loading
                    const cssUrl = this.$css('dynamic-theme', false, Date.now());
                    this.dynamicAsset = cssUrl;
                    
                    // You could actually load the CSS like this:
                    // const link = document.createElement('link');
                    // link.rel = 'stylesheet';
                    // link.href = cssUrl;
                    // document.head.appendChild(link);
                }
            }
        }).mount('#vue-assets-demo')
    </script>
<?php layout('end') ?>
