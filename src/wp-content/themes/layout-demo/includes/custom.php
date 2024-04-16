<?php
add_action('wp_enqueue_scripts', 'namtech_scripts');
function namtech_scripts() {
    $version = '1.0.0';

    // Load CSS
    wp_enqueue_style('custom-style-css', THEME_URL . '/assets/main/main.css', array(), $version, 'all');
    wp_enqueue_style('splide-css', THEME_URL . '/assets/lib/splide/splide.min.css', array(), $version, 'all');
    wp_enqueue_style('custom-css', THEME_URL . '/assets/css/style.css', array(), $version, 'all');

    // Load JS
    wp_enqueue_script('main-scripts-js', THEME_URL . '/assets/main/main.js', array('jquery'), $version, true);  
    wp_enqueue_script('bootstrap-js', THEME_URL . '/assets/lib/bootstrap/bootstrap.bundle.min.js', array('jquery'), $version, true);  
    wp_enqueue_script('splide-js', THEME_URL . '/assets/lib/splide/splide.min.js', array('jquery'), $version, true);  
    wp_enqueue_script('splide-autoscroll-js', THEME_URL . '/assets/lib/splide-extension-auto-scroll/splide-extension-auto-scroll.min.js', array('jquery'), $version, true);  
    wp_enqueue_script('custom-scripts-js', THEME_URL . '/assets/main/script.js', array('jquery'), $version, true);  
    wp_enqueue_script('header-js', THEME_URL . '/assets/main/header.js', array('jquery'), $version, true);  
    wp_enqueue_script('vocab-js', THEME_URL . '/assets/main/vocab.js', array('jquery'), $version, true);  
}


/**
 * Menu Register
 */
register_nav_menus(
    array(
        "primary"    => __( "Primary Menu"),
        "footer"     => __( "Footer Menu")
    )
);


/*
 * Add Image Size for Wordpress
 */
if (function_exists('add_image_size')) {
    // add_image_size('nameImage', 392, 245, true);    
}