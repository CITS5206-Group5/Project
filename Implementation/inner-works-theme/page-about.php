<?php
/* Template Name: About Page */
get_header();
?>

<main>
    <section class="iwc-section iwc-section-light-blue">
    <!-- Main section with a light blue background, defined by custom CSS classes. -->
        <div class="container pt-4 pb-4">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Links to the home page dynamically using WordPress's home_url() function. -->
                        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                        <!-- Marks the current page as "About". -->
                        <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                </nav>
                <div class="col-md-12 text-center">
                    <!-- Displays the page title dynamically, using WordPress's the_title() function. -->
                    <h1 class="mb-5 iwc-blue"><?php the_title(); ?></h1>                    
                </div>
            </div>
            <div class="row text-center g-4">
                <div class="col-lg-4">
                    <!-- Dynamically loads the 'about_image' field value using ACF (Advanced Custom Fields) plugin.
                         Displays Lita Oakes' profile image with Bootstrap's responsive image class. -->
                    <img src="<?php the_field('about_image'); ?>" alt="Lita Oakes" class="img-fluid mb-3">
                    <h5 class="text-center"><span class="fw-bold">Accredited Counsellor</span><br>Lita Oakes</h5>
                </div>
                <div class="col-lg-8">
                    <!-- Dynamically displays the main content of the About page, editable by the client via WordPress. -->
                    <?php the_content() ?>                    
                </div>
            </div>
            <div class="row mt-2 mb-2">
                <div class="col-md-12 mt-5 mb-5 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3 gap-lg-4">
                    <!-- Button that triggers a modal popup for getting free wellbeing tips. -->
                    <a class="iwc-btn bg-white" data-bs-toggle="modal" data-bs-target="#getFWT">Get Free Wellbeing Tips</a>
                    <!-- Button linking to an external booking page, opening in a new tab. -->
                    <a href="http://bensv.youcanbook.me" class="iwc-btn" target="_blank">Book Appointment Now</a>                    
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
