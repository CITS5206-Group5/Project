<?php
$latest_posts = new WP_Query(array(
    'posts_per_page' => 5,
    'post_status' => 'publish'
));
?>

<footer class="iwc-section iwc-footer">
    <div class="container pt-5 pb-5">
        <div class="row mb-4 g-5">
            <div class="col-md-5">
                <h1 class="mt-3 mb-3">Contacts</h1>
                <div class="row g-3">
                    <div class="col-lg-12">
                        <p class="fs-5"><i class="bi bi-geo-alt iwc-light-blue"></i> <a class="iwc-dot-link" href="#" target="_blank">15 Silkeborg Crescent, Joondalup, 6027</a></p>
                        <p class="fs-5" style="word-wrap: break-word;"><i class="bi bi-envelope iwc-light-blue"></i><a class="iwc-dot-link" href="mailto:admin@innerworkscounselling.com.au" target="_blank">&nbsp;admin@innerworkscounselling.com.au</a></p>
                        <p class="fs-5"><i class="bi bi-telephone iwc-light-blue"></i> 0432 778 490</p>
                        <p class="fs-5"><i class="bi bi-file-earmark-text"></i><a class="iwc-dot-link" href="<?php echo get_template_directory_uri(); ?>/assets/Privacy Policy.pdf" target="_blank"> <span>Privacy Policy</span></a></p>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <a href="https://www.facebook.com/profile.php?id=61557157315550" target="_blank"><i class="bi bi-facebook h2 me-4"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-tiktok h2 me-4"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-instagram h2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row g-5">
                    <div class="col-lg-12">
                        <h1 class="mt-3 mb-3">Latest publications</h1>
                        <?php if ($latest_posts->have_posts()) : ?>
                            <?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                                <p class="fs-5">
                                    <a class="iwc-dot-link" href="<?php the_permalink(); ?>" target="_blank">
                                        <span><?php the_title(); ?></span>
                                    </a>
                                </p>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No recent publications found.</p>
                        <?php endif; ?>
                        <?php wp_reset_postdata();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<footer class="iwc-section iwc-footer-basement">
    <div class="container-fluid pt-4 pb-4">
        <div class="row text-center">
            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                <img class="me-1" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="iwc"> <span><span id="currentYear"></span> by Lita Oakes, Dip.Couns.</span>
            </div>
        </div>
    </div>
</footer>
<style>
    .wp-chatbot-ball {
        box-shadow: none !important;
        background: transparent !important;
    }
    .wp-chatbot-ball:hover, .wp-chatbot-ball:focus {
        background: #0c49a42e !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<?php wp_footer(); ?>
</body>
</html>
