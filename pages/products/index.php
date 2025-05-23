<?php layout('start', ['title' => 'Products']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <div class="row">
                <div class="col-md-12">
                    <h1>Products</h1>
                    
                    <div id="products-app">
                        <div class="row">
                            <div class="col-md-3 mb-4" v-for="product in products" :key="product.id">
                                <div class="card h-100">
                                    <img :src="product.image" class="card-img-top" alt="Product image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ product.name }}</h5>
                                        <p class="card-text">{{ product.description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-primary fw-bold">${{ product.price.toFixed(2) }}</span>
                                            <a :href="route('products/' + product.id)" class="btn btn-sm btn-outline-primary">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="<?= route('') ?>" class="btn btn-secondary">Back to Home</a>
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
                    products: [
                        {
                            id: 1,
                            name: 'Smartphone XYZ',
                            description: 'Latest smartphone with amazing features!',
                            price: 699.99,
                            image: 'https://via.placeholder.com/300x200?text=Smartphone'
                        },
                        {
                            id: 2,
                            name: 'Laptop Pro',
                            description: 'Powerful laptop for professionals.',
                            price: 1299.99,
                            image: 'https://via.placeholder.com/300x200?text=Laptop'
                        },
                        {
                            id: 3,
                            name: 'Wireless Earbuds',
                            description: 'Amazing sound quality with noise cancellation.',
                            price: 149.99,
                            image: 'https://via.placeholder.com/300x200?text=Earbuds'
                        },
                        {
                            id: 4,
                            name: 'Smartwatch',
                            description: 'Track your fitness and stay connected.',
                            price: 249.99,
                            image: 'https://via.placeholder.com/300x200?text=Smartwatch'
                        }
                    ]
                }
            }
        }).mount('#products-app')
    </script>
<?php layout('end') ?>
