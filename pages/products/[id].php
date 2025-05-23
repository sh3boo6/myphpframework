<?php layout('start', ['title' => 'Product Details']) ?>
<?php
// Get the product ID from the route parameter
$productId = param('id');
?>

    <div id="main" class="container">
        <main class="py-4">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h1>Product Details</h1>
                            <a href="<?= route('products') ?>" class="btn btn-secondary">Back to Products</a>
                        </div>
                        
                        <div class="card-body" id="product-detail-app">
                            <div v-if="product" class="row">
                                <div class="col-md-5">
                                    <img :src="product.image" class="img-fluid rounded" alt="Product image">
                                </div>
                                <div class="col-md-7">
                                    <h2>{{ product.name }}</h2>
                                    <p class="lead">{{ product.description }}</p>
                                    
                                    <div class="my-4">
                                        <h3 class="text-primary">${{ product.price.toFixed(2) }}</h3>
                                        
                                        <div class="mb-3">
                                            <div class="text-warning">
                                                <i class="fas fa-star" v-for="i in product.rating"></i>
                                                <i class="far fa-star" v-for="i in (5 - product.rating)"></i>
                                            </div>
                                            <small>{{ product.reviews }} reviews</small>
                                        </div>
                                        
                                        <div class="mb-3" v-if="product.stock > 0">
                                            <span class="badge bg-success">In Stock</span>
                                        </div>
                                        <div class="mb-3" v-else>
                                            <span class="badge bg-danger">Out of Stock</span>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" :disabled="product.stock <= 0">
                                            Add to Cart
                                        </button>
                                        <button class="btn btn-outline-secondary">
                                            Add to Wishlist
                                        </button>
                                    </div>
                                    
                                    <hr>
                                    
                                    <div class="mt-4">
                                        <h4>Product Features</h4>
                                        <ul>
                                            <li v-for="feature in product.features">{{ feature }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-3">Loading product details...</p>
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
                    productId: <?php echo json_encode($productId); ?>,
                    product: null
                }
            },
            mounted() {
                // In a real app, this would fetch from an API
                // For this demo, we'll use sample data
                const productId = parseInt(this.productId);
                
                // Sample product data
                const products = {
                    1: {
                        id: 1,
                        name: 'Smartphone XYZ',
                        description: 'The latest smartphone with amazing features and incredible performance. This device comes with a high-resolution display, powerful processor, and all-day battery life.',
                        price: 699.99,
                        image: 'https://via.placeholder.com/600x400?text=Smartphone',
                        rating: 4,
                        reviews: 127,
                        stock: 15,
                        features: [
                            '6.5-inch Super AMOLED display',
                            '128GB storage, expandable to 512GB',
                            'Triple camera system with 48MP main camera',
                            'All-day battery with fast charging',
                            'Water and dust resistant'
                        ]
                    },
                    2: {
                        id: 2,
                        name: 'Laptop Pro',
                        description: 'A powerful laptop designed for professionals who need performance and portability. Features the latest processor and graphics for demanding tasks.',
                        price: 1299.99,
                        image: 'https://via.placeholder.com/600x400?text=Laptop',
                        rating: 5,
                        reviews: 84,
                        stock: 8,
                        features: [
                            '15.6-inch 4K display',
                            '16GB RAM, 512GB SSD',
                            'Latest generation processor',
                            'Dedicated graphics card',
                            'Backlit keyboard and precision touchpad',
                            'All-day battery life'
                        ]
                    },
                    3: {
                        id: 3,
                        name: 'Wireless Earbuds',
                        description: 'Experience amazing sound quality with active noise cancellation. These earbuds provide a comfortable fit and long-lasting battery life.',
                        price: 149.99,
                        image: 'https://via.placeholder.com/600x400?text=Earbuds',
                        rating: 4,
                        reviews: 213,
                        stock: 22,
                        features: [
                            'Active noise cancellation',
                            'Up to 24 hours of battery life with charging case',
                            'Water and sweat resistant',
                            'Touch controls',
                            'Voice assistant support'
                        ]
                    },
                    4: {
                        id: 4,
                        name: 'Smartwatch',
                        description: 'Track your fitness and stay connected with this smartwatch. Features health monitoring, notifications, and customizable watch faces.',
                        price: 249.99,
                        image: 'https://via.placeholder.com/600x400?text=Smartwatch',
                        rating: 3,
                        reviews: 58,
                        stock: 0,
                        features: [
                            'Heart rate and sleep tracking',
                            'GPS and fitness tracking',
                            'Water resistant up to 50 meters',
                            'Customizable watch faces',
                            'Notification support',
                            'Up to 7 days battery life'
                        ]
                    }
                };
                
                // Set product data or handle not found
                if (products[productId]) {
                    setTimeout(() => {
                        this.product = products[productId];
                    }, 500);
                } else {
                    // Redirect to products page if not found
                    window.location.href = '/products';
                }
            }
        }).mount('#product-detail-app')
    </script>
<?php layout('end') ?>
