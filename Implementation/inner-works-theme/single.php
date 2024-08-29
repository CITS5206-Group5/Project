<?php
get_header();
?>

<main>
    <section class="iwc-section iwc-section-light-blue">
        <div class="container pt-4 pb-4">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="/resources/">Resources</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
                        </ol>
                    </nav>
                    <span class="text-muted"><?php echo get_the_date('d/m/Y'); ?></span>
                </div>
                <div class="col-md-12 text-center">
                    <h1 class="mb-4 mt-4 iwc-blue"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 order-md-1 order-2">
                    <?php the_content(); ?>
                    <div class="text-start pt-3">
                        <?php echo do_shortcode('[shared_counts]'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12 mt-5 mb-5 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3 gap-lg-4">
                    <a class="iwc-btn bg-white" data-bs-toggle="modal" data-bs-target="#getFWT">Get Free Wellbeing Tips</a>
                    <a href="http://bensv.youcanbook.me" class="iwc-btn" target="_blank">Book Appointment Now</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
