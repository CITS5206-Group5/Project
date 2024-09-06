<?php
/* Template Name: Contacts Page */
get_header();
?>

<main>
    <section class="iwc-section iwc-section-light-blue">
        <div class="container pt-4 pb-4">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Dynamically generates a link to the homepage using WordPress's home_url() function. -->
                        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                        <!-- Marks the current page as "Contacts". -->
                        <li class="breadcrumb-item active" aria-current="page">Contacts</li>
                    </ol>
                </nav>
                <div class="col-md-12 text-center">
                    <!-- Displays the dynamic page title (in this case, "Contacts") using WordPress's the_title() function. -->
                    <h1 class="mb-5 iwc-blue"><?php the_title(); ?></h1>            
                </div>
            </div>
            <!-- Contact Details Section -->
            <div class="row text-start mb-4">
                 <!-- Chatbot Information -->
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-chat-dots me-3 fs-1 iwc-blue"></i>
                        <div>
                            <h3 class="iwc-blue">Do you have questions?</h3>
                            <p class="mb-0 fs-4">Use the chatbot</p>
                        </div>
                    </div>
                </div>
                <!-- Contact Phone -->
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-telephone me-3 fs-1 iwc-blue"></i>
                        <div>
                            <h3 class="iwc-blue">Help is needed?</h3>
                            <!-- Displays the contact phone number dynamically using ACF field 'contact_phone'. -->
                            <p class="mb-0 fs-4"><?php the_field('contact_phone'); ?></p>
                        </div>
                    </div>
                </div>
                <!-- Contact Address -->
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-geo-alt me-3 fs-1 iwc-blue"></i>
                        <div>
                            <h3 class="iwc-blue">Address</h3>
                            <!-- Dynamically displays the address using ACF field 'contact_address'. -->
                            <p class="mb-0 fs-4"><?php the_field('contact_address'); ?></p>
                        </div>
                    </div>
                </div>
                <!-- Counselling Hours -->
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-clock me-3 fs-1 iwc-blue"></i>
                        <div>
                            <h3 class="iwc-blue">Counselling Hours</h3>
                            <!-- Dynamically displays the counselling hours using ACF field 'counselling_hours'. -->
                            <p class="mb-0 fs-4"><?php the_field('counselling_hours'); ?></p>
                        </div>
                    </div>
                </div>
                <!-- Contact Email -->
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-envelope me-3 fs-1 iwc-blue"></i>
                        <div>
                            <h3 class="iwc-blue">or write to us!</h3>
                            <!-- Dynamically displays the contact email using ACF field 'contact_email'. -->
                            <p class="mb-0 fs-4"><?php the_field('contact_email'); ?></p>
                        </div>
                    </div>
                </div>
                <!-- Social Media Links -->
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center">
                        <!--Pending add links to social media profiles (Facebook, TikTok, Instagram). -->
                        <a href="#" class="me-4"><i class="bi bi-facebook fs-1"></i></a>
                        <a href="#" class="me-4"><i class="bi bi-tiktok fs-1"></i></a>
                        <a href="#"><i class="bi bi-instagram fs-1"></i></a>
                    </div>
                </div>
            </div>
            <!-- Contact Form Section -->
            <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <form>
                        <!-- User information form fields (First Name, Last Name, Email, Phone) with required validation. -->
                        <div class="mb-3">
                            <input name="first_name" type="text" class="fs-3 form-control mb-3 transparent-input" placeholder="First name" required>
                        </div>
                        <div class="mb-3">
                            <input name="last_name" type="text" class="fs-3 form-control mb-3 transparent-input" placeholder="Last name" required>
                        </div>
                        <div class="mb-3">
                            <input name="email" type="email" class="fs-3 form-control mb-3 transparent-input" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input name="phone" type="text" class="fs-3 form-control mb-3 transparent-input" placeholder="Phone" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="fs-3 form-control mb-3 transparent-input" rows="4" placeholder="Message" required></textarea>
                        </div>
                        <!-- Submit form -->
                        <div class="text-start">
                            <button type="submit" class="iwc-btn">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
