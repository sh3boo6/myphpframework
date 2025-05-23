<?php layout('start', ['title' => 'Users List']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <h1>Users Directory</h1>
            
            <div id="users-app">
                <div class="row" v-if="users.length">
                    <div class="col-md-4 mb-3" v-for="user in users" :key="user.id">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ user.name }}</h5>
                                <p class="card-text">{{ user.email }}</p>
                                <p class="text-muted small">{{ $truncate(user.bio || 'No bio available', 50) }}</p>
                                <a :href="$route('users/' + user.id)" class="btn btn-primary">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="alert alert-info">Loading users...</div>
            </div>
        </main>
    </div>
    
    <?php layout('scripts') ?>
    <script>
        createAppWithGlobals({
            data() {
                return {
                    users: []
                }
            },
            mounted() {
                // Use the global $api method instead of fetchApi
                this.$api('api/users/all')
                    .then(data => {
                        console.log('Fetched users:', data);
                        // Add some demo bio data to show truncation
                        this.users = data.map(user => ({
                            ...user,
                            bio: user.bio || `${user.name} is a dedicated professional with extensive experience in their field. They are passionate about innovation and excellence.`
                        }));
                    })
                    .catch(error => {
                        console.error('Error fetching users:', error);
                        // For demo, we'll add some sample users if API fails
                        this.users = [
                            { id: 1, name: 'John Doe', email: 'john@example.com', bio: 'Experienced software developer with a passion for clean code and innovative solutions.' },
                            { id: 2, name: 'Jane Smith', email: 'jane@example.com', bio: 'Creative designer focused on user experience and modern design principles.' },
                            { id: 3, name: 'Bob Johnson', email: 'bob@example.com', bio: 'Project manager with expertise in agile methodologies and team leadership.' }
                        ];
                    });
            }
        }).mount('#users-app')
    </script>
<?php layout('end') ?>