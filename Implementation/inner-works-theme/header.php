<?php
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php wp_title('', true, 'right'); ?></title>
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
	<div id="alertMessage" class="alert d-none" role="alert" style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); z-index: 9999;"></div>
    <div class="container">
        <nav class="navbar navbar-expand-lg iwc-navbar">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="iwc" class="d-inline-block align-text-top iwc-brand-logo">
                    <span class="iwc-brand-text"></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#iwcnavbar" aria-controls="iwcnavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="iwcnavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 flex-lg-row gap-3 gap-lg-4 gap-xl-5">
                        <li class="nav-item">
                            <a class="nav-link iwc-nav-link <?php echo is_page('about') ? 'active' : ''; ?>" href="<?php echo home_url('/about'); ?>">about</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link iwc-nav-link <?php echo is_page('services') ? 'active' : ''; ?>" href="<?php echo home_url('/services'); ?>">services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link iwc-nav-link <?php echo is_page('resources') ? 'active' : ''; ?>" href="<?php echo home_url('/resources'); ?>">resources</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link iwc-nav-link <?php echo is_page('contacts') ? 'active' : ''; ?>" href="<?php echo home_url('/contacts'); ?>">contacts</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link iwc-nav-link iwc-btn" href="http://bensv.youcanbook.me" target="_blank">Book Now</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="modal fade iwc-modal" id="getFWT" tabindex="-1" aria-labelledby="getFWTLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="iwc">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <h1 class="mb-3 text-center fw-bold">Get Free Wellbeing Tips<br>To Your Email</h1>
                            </div>
                        </div>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <input type="hidden" name="action" value="submit_wellbeing_tips_form">
                                    <input type="text" name="first_name" class="fs-4 form-control mb-3 transparent-input" placeholder="First Name" aria-label="First Name" required>
                                    <input type="text" name="last_name" class="fs-4 form-control mb-3 transparent-input" placeholder="Last Name" aria-label="Last Name" required>
                                    <input type="email" name="email" class="fs-4 form-control mb-3 transparent-input" placeholder="Email" aria-label="Email" required>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="iwc-btn bg-white" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="iwc-btn">Get</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

