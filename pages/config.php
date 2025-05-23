<?php layout('start', ['title' => 'Framework Configuration']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h1>Framework Configuration</h1>
                            <a href="<?= route('') ?>" class="btn btn-secondary">Back Home</a>
                        </div>
                        
                        <div class="card-body">
                            <div class="alert alert-info">
                                <strong>Info:</strong> This page shows the current configuration of your MyPHPFramework installation.
                            </div>
                            
                            <h3>Installation Information</h3>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Framework Version</th>
                                            <td><?= APP['version'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Application Name</th>
                                            <td><?= APP['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Debug Mode</th>
                                            <td><?= APP['debug'] ? 'Enabled' : 'Disabled' ?></td>
                                        </tr>
                                        <tr>
                                            <th>Base URL</th>
                                            <td><?= APP['baseUrl'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Root Directory</th>
                                            <td><?= APP['root'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <h3 class="mt-4">Router Configuration</h3>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Base Path</th>
                                            <td><?= APP['router']['basePath'] ?: '<em>auto-detected</em>' ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pages Directory</th>
                                            <td><?= APP['router']['pagesDir'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>API Directory</th>
                                            <td><?= APP['router']['apiDir'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>404 Page</th>
                                            <td><?= APP['router']['notFoundPage'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Script Name</th>
                                            <td><?= $_SERVER['SCRIPT_NAME'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Script Directory</th>
                                            <td><?= dirname($_SERVER['SCRIPT_NAME']) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <h3 class="mt-4">URL Configuration Check</h3>
                            <p>These tests verify that your URL handling is working correctly:</p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%;">Test</th>
                                            <th>Status</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Base URL Detection</td>
                                            <td>
                                                <?php if (strpos(APP['baseUrl'], $_SERVER['HTTP_HOST']) !== false): ?>
                                                    <span class="badge bg-success">OK</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning">Warning</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= APP['baseUrl'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Subdirectory Detection</td>
                                            <td>
                                                <?php 
                                                $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
                                                $basePath = ($scriptDir === '/' || $scriptDir === '\\') ? '' : $scriptDir;
                                                if ($basePath && strpos(route('about'), $basePath) === 0): 
                                                ?>
                                                    <span class="badge bg-success">OK</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Failed</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $basePath ?: '/' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Home URL</td>
                                            <td>
                                                <span class="badge bg-success">OK</span>
                                            </td>
                                            <td><?= route('') ?></td>
                                        </tr>
                                        <tr>
                                            <td>About URL</td>
                                            <td>
                                                <span class="badge bg-success">OK</span>
                                            </td>
                                            <td><?= route('about') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Dynamic URL</td>
                                            <td>
                                                <span class="badge bg-success">OK</span>
                                            </td>
                                            <td><?= route('users/[id]', ['id' => 42]) ?></td>
                                        </tr>
                                        <tr>
                                            <td>API URL</td>
                                            <td>
                                                <span class="badge bg-success">OK</span>
                                            </td>
                                            <td><?= route('api/data') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <h3 class="mt-4">Troubleshooting</h3>
                            <div class="alert alert-warning">
                                <h5>If URLs are not working correctly:</h5>
                                <ol>
                                    <li>Make sure your <code>.htaccess</code> file has the correct <code>RewriteBase</code> setting. Currently it's set to: <code><?= file_exists(APP['root'] . '/.htaccess') ? '/myphpframework/' : 'not found' ?></code></li>
                                    <li>Check that <code>mod_rewrite</code> is enabled in your Apache configuration.</li>
                                    <li>Verify that the base URL is being detected correctly.</li>
                                    <li>Ensure all links in your templates use the <code>route()</code> function.</li>
                                    <li>For API calls, use <code>fetch(route('api/endpoint'))</code> instead of hardcoded paths.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<?php layout('scripts') ?>
<?php layout('end') ?>
