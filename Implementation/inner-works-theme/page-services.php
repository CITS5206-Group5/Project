<?php
/* Template Name: Services Page */
get_header();
?>

<main>
    <section class="iwc-section iwc-section-light-blue">
        <div class="container pt-4 pb-4">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Services</li>
                    </ol>
                </nav>
                <div class="col-md-12 text-center">
                    <h1 class="mb-5 iwc-blue"><?php the_title(); ?></h1>
                </div>
            </div>
            <?php the_content() ?>
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
