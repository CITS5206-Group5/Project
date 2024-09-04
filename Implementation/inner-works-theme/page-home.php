<?php
/*
Template Name: Home
*/
get_header();
?>

<main>
    <section>
        <div class="d-flex flex-column align-items-center iwc-header">
            <div class="container mt-lg-5 mt-md-3">
                <h1 class="text-white mt-lg-5 mt-md-3"><?php the_field('header_title'); ?></h1>
                <h4 class="text-white mb-3 mb-lg-4" style="font-weight: 400;"><?php the_field('header_subtitle_1'); ?></h4>
                <h4 class="text-white mb-3 mb-lg-4" style="font-weight: 400;"><?php the_field('header_subtitle_2'); ?></h4>
                <div class="iwc-header-buttons d-flex flex-column flex-sm-row gap-3 gap-lg-4">
                    <a class="iwc-btn bg-white" data-bs-toggle="modal" data-bs-target="#getFWT">Get Free Wellbeing Tips</a>
                    <a href="http://bensv.youcanbook.me" class="iwc-btn" target="_blank">Book Now</a>
                </div>
            </div>
        </div>
    </section>
    <section class="iwc-section iwc-section-light-blue">
        <div class="container pt-4 pb-4">
            <div class="row text-center g-4 mt-4">
                <div class="col-md-12 text-center">
                    <h1 class="mb-4 iwc-blue"><?php the_title(); ?></h1>
                </div>
                <div class="col-lg-12">
                    <?php the_content() ?>
                </div>
            </div>
            <div class="row mt-2 mb-2">
                <div class="col-md-12 mt-5 mb-5 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3 gap-lg-4">
                    <a class="iwc-btn bg-white" data-bs-toggle="modal" data-bs-target="#getFWT">Get Free Wellbeing Tips</a>
                    <a href="http://bensv.youcanbook.me" class="iwc-btn" target="_blank">Book Appointment Now</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
