<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="site-branding">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
            ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                    <img src="https://mpabrasil.org.br/wp-content/themes/mpa/images/logo-2.png" 
                         alt="<?php bloginfo('name'); ?>" 
                         class="custom-logo">
                </a>
            <?php
            }
            ?>
            
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="screen-reader-text"><?php esc_html_e('Menu', 'mpa-theme'); ?></span>
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
                'menu_class' => 'menu',
                'container' => false,
                'fallback_cb' => false,
            ));
            ?>
        </nav>
    </div>

    <?php if (is_front_page()) : ?>
    <div class="newsletter-banner">
        <div class="container">
            <a href="https://mpabrasil.substack.com/" target="_blank" rel="noopener noreferrer">
                <img src="https://mpabrasil.org.br/wp-content/uploads/2023/02/ASSINE-NOSSA-NEWSLETTER.gif" 
                     alt="Assine nossa newsletter" 
                     class="newsletter-image">
            </a>
        </div>
    </div>
    <?php endif; ?>
</header>

<div id="content" class="site-content">
    <div class="container">
