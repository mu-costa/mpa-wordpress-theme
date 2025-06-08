<?php
if (!defined('ABSPATH')) exit;

// Theme Setup
function mpa_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register nav menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'mpa-theme'),
        'footer' => esc_html__('Footer Menu', 'mpa-theme'),
    ));
}
add_action('after_setup_theme', 'mpa_theme_setup');

// Enqueue scripts and styles
function mpa_theme_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap', array(), null);
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0');
    
    // Enqueue theme stylesheet
    wp_enqueue_style('mpa-theme-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue theme JavaScript
    wp_enqueue_script('mpa-theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'mpa_theme_scripts');

// Register Custom Post Types
function mpa_register_post_types() {
    // News/Articles Post Type
    register_post_type('noticias', array(
        'labels' => array(
            'name' => __('Notícias', 'mpa-theme'),
            'singular_name' => __('Notícia', 'mpa-theme'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-format-aside',
        'rewrite' => array('slug' => 'noticias'),
    ));

    // TV Shows Post Type
    register_post_type('tv-camponesa', array(
        'labels' => array(
            'name' => __('TV Camponesa', 'mpa-theme'),
            'singular_name' => __('TV Show', 'mpa-theme'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-video-alt3',
        'rewrite' => array('slug' => 'tv-camponesa'),
    ));

    // Radio Shows Post Type
    register_post_type('radio-camponesa', array(
        'labels' => array(
            'name' => __('Rádio Camponesa', 'mpa-theme'),
            'singular_name' => __('Radio Show', 'mpa-theme'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-audio',
        'rewrite' => array('slug' => 'radio-camponesa'),
    ));

    // Events Post Type
    register_post_type('eventos', array(
        'labels' => array(
            'name' => __('Eventos', 'mpa-theme'),
            'singular_name' => __('Evento', 'mpa-theme'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-calendar-alt',
        'rewrite' => array('slug' => 'eventos'),
    ));
}
add_action('init', 'mpa_register_post_types');

// Register Custom Taxonomies
function mpa_register_taxonomies() {
    // News Categories
    register_taxonomy('categoria-noticia', array('noticias'), array(
        'labels' => array(
            'name' => __('Categorias de Notícias', 'mpa-theme'),
            'singular_name' => __('Categoria', 'mpa-theme'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'categoria-noticia'),
    ));

    // Event Types
    register_taxonomy('tipo-evento', array('eventos'), array(
        'labels' => array(
            'name' => __('Tipos de Evento', 'mpa-theme'),
            'singular_name' => __('Tipo', 'mpa-theme'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'tipo-evento'),
    ));
}
add_action('init', 'mpa_register_taxonomies');

// Register widget areas
function mpa_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Principal', 'mpa-theme'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'mpa-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Rodapé', 'mpa-theme'),
        'id' => 'footer-1',
        'description' => __('Add widgets here to appear in your footer.', 'mpa-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'mpa_widgets_init');
