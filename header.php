<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<header class="header-container">
    <div class="header-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/header-logo.svg" alt="Book Catalog Logo" width="24px" />
        <h1 class="site-logo">Book Catalog</h1>
    </div>
    <nav class="header-navigation">
        <?php wp_nav_menu([ 'theme_location' => 'header_menu' ]); ?>
    </nav>
</header>
<body <?php body_class(); ?>>