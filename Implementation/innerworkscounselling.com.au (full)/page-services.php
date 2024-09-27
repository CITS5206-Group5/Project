<?php
/* Template Name: Services Page */

/* Rendering the header of the site */
get_header();
?>

<main>
    <!-- Section with light blue background for the services page content -->
    <section class="iwc-section iwc-section-light-blue">
        <div class="container pt-4 pb-4">
            <div class="row">
                <!-- Breadcrumb navigation to indicate the user's location within the site -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Link to the homepage -->
                        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                        <!-- Current page (Services) as active breadcrumb -->
                        <li class="breadcrumb-item active" aria-current="page">Services</li>
                    </ol>
                </nav>

                <!-- Title of the Services page displayed in blue color -->
                <div class="col-md-12 text-center">
                    <h1 class="mb-5 iwc-blue"><?php the_title(); ?></h1>
                </div>
            </div>
            
            <!-- Displays the content added via the WordPress editor for the Services page -->
            <?php the_content(); ?>

            <!-- Row containing two buttons: one for Free Wellbeing Tips and one for booking an appointment -->
            <div class="row mt-2 mb-2">
                <div class="col-md-12 mt-5 mb-5 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3 gap-lg-4">
                    <!-- Button to trigger the 'Get Free Wellbeing Tips' modal -->
                    <a class="iwc-btn bg-white" data-bs-toggle="modal" data-bs-target="#getFWT">Get Free Wellbeing Tips</a>
                    
                    <!-- Button to navigate to an external booking service -->
                    <a href="http://bensv.youcanbook.me" class="iwc-btn" target="_blank">Book Appointment Now</a>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Rendering the footer of the site -->
<?php get_footer(); ?>
