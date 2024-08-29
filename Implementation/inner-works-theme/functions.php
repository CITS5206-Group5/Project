<?php
function iwc_theme_setup() {
    add_theme_support('post-thumbnails');
    add_image_size('medium', 300, 300, true);
}
add_action('after_setup_theme', 'iwc_theme_setup');

function inner_works_enqueue_styles() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
    wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/custom.css');
}

function inner_works_enqueue_scripts() {
    wp_enqueue_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js', array(), null, true);
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery', 'bootstrap-js'), null, true);
}

add_action('wp_enqueue_scripts', 'inner_works_enqueue_styles');
add_action('wp_enqueue_scripts', 'inner_works_enqueue_scripts');
