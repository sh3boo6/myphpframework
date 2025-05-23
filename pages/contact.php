<?php layout('start', ['title' => 'Contact Us']) ?>
    <div id="main" class="container">
        <main class="py-4">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h1>Contact Us</h1>
                        </div>
                        <div class="card-body">
                            <div id="contact-app">
                                <div v-if="formSubmitted" class="alert alert-success">
                                    Thank you for your message! We'll get back to you soon.
                                </div>
                                
                                <form @submit.prevent="submitForm" v-else>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" v-model="form.name" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" v-model="form.email" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="subject" v-model="form.subject" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" id="message" rows="5" v-model="form.message" required></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </form>
                                
                                <div class="mt-4">
                                    <a href="<?= route('') ?>" class="btn btn-secondary">Back to Home</a>
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
                    formSubmitted: false,
                    form: {
                        name: '',
                        email: '',
                        subject: '',
                        message: ''
                    }
                }
            },
            methods: {
                submitForm() {
                    // In a real app, you would send this data to the server
                    console.log('Form submitted:', this.form);
                    
                    // Simulate form submission
                    setTimeout(() => {
                        this.formSubmitted = true;
                    }, 500);
                }
            }
        }).mount('#contact-app')
    </script>
<?php layout('end') ?>
