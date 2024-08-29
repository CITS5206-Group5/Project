<?php
/* Template Name: Resources Page */
get_header();
?>

<main>
    <section class="iwc-section iwc-section-light-blue">
        <div class="container pt-4 pb-4">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Resources</li>
                    </ol>
                </nav>
                <div class="col-md-12 text-center">
                    <h1 class="mb-5 iwc-blue"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row text-center g-4 mb-4">
                <div class="col-lg-12">
                    <?php the_content() ?>
                    <div class="pt-4 pb-1">
                        <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                    </div>
                </div>
            </div>

            <?php

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'paged'          => $paged,
            );


            $resources_query = new WP_Query($args);


            if ($resources_query->have_posts()) :
                while ($resources_query->have_posts()) : $resources_query->the_post(); ?>
                    <div class="row align-items-center pt-3 pb-5">
                        <div class="col-md-4 text-center order-md-2 order-1">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="img-fluid mb-3 mb-md-0">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image.webp" alt="Placeholder Image" class="img-fluid mb-3 mb-md-0">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8 order-md-1 order-2">
                            <p class="text-muted mb-1"><?php echo get_the_date(); ?></p>
                            <h3 class="iwc-blue">
                                <a href="<?php the_permalink(); ?>" class="iwc-resource-link"><?php the_title(); ?></a>
                            </h3>
                            <div class="fs-5"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="iwc-btn">Read</a>
                        </div>
                    </div>
                <?php endwhile;
                ?>


                <nav class="mt-4" aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                        echo paginate_links(array(
                            'total'   => $resources_query->max_num_pages,
                            'current' => $paged,
                            'format'  => '?paged=%#%',
                            'prev_text' => __('&lt;', 'textdomain'),
                            'next_text' => __('&gt;', 'textdomain'),
                        ));
                        ?>
                    </ul>
                </nav>

            <?php else : ?>
                <p class="text-center">No resources found.</p>
            <?php endif; ?>

            <?php
            wp_reset_postdata();
            ?>

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
