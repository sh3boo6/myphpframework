<?php layout('start', ['title' => 'User Profile']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1>User Profile</h1>
                                <a href="<?= route('users') ?>" class="btn btn-secondary">Back to Users</a>
                            </div>
                        </div>
                        <div class="card-body" id="user-profile">
                            <?php
                            // Get the user ID from the route parameter
                            $userId = param('id');
                            ?>
                            <div v-if="user">
                                <div class="text-center mb-4">
                                    <img :src="user.avatar || 'https://via.placeholder.com/150'" class="rounded-circle" alt="User Avatar" width="150">
                                </div>
                                
                                <h2 class="text-center">{{ user.name }}</h2>
                                
                                <div class="mt-4">
                                    <p><strong>ID:</strong> {{ user.id }}</p>
                                    <p><strong>Email:</strong> {{ user.email }}</p>
                                    <p><strong>Member Since:</strong> {{ user.createdAt }}</p>
                                </div>
                            </div>
                            <div v-else class="text-center">
                                <p>Loading user information...</p>
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
                    user: null,
                    userId: <?php echo json_encode($userId); ?>
                }
            },
            mounted() {
                // Fetch user from API using route function
                fetch(`${route('api/users/single')}?id=${this.userId}`)
                    .then(response => response.json())
                    .then(data => {
                        this.user = data;
                    })
                    .catch(error => {
                        console.error('Error fetching user data:', error);
                        // For demo, create sample user if API fails
                        this.user = {
                            id: this.userId,
                            name: 'User ' + this.userId,
                            email: `user${this.userId}@example.com`,
                            avatar: 'https://via.placeholder.com/150',
                            createdAt: '2025-01-01'
                        };
                    });
            }
        }).mount('#user-profile')
    </script>
<?php layout('end') ?>