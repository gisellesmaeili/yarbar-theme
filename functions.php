<?php
/**
 * YarBar Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Block direct access to this file.
}

define( 'YARBAR_VERSION', '1.1.0' );

function yarbar_theme_setup() {
    // Let WordPress manage the page <title> tag.
    add_theme_support( 'title-tag' );

    // Allow featured images (used for blog posts, services, locations).
    add_theme_support( 'post-thumbnails' );

    // Let WordPress handle the RSS feed link automatically.
    add_theme_support( 'automatic-feed-links' );

    // Custom image sizes matching real card and hero dimensions.
    add_image_size( 'yarbar-card', 500, 320, true );
    add_image_size( 'yarbar-hero', 1600, 900, true );
}
add_action( 'after_setup_theme', 'yarbar_theme_setup' );

function yarbar_enqueue_assets() {
    // 1. Core typography and design tokens
    wp_enqueue_style(
        'yarbar-fonts',
        get_template_directory_uri() . '/assets/css/fonts.css',
        array(),
        YARBAR_VERSION
    );

    // 2. Base layout, header, footer, and shared components
    wp_enqueue_style(
        'yarbar-base',
        get_template_directory_uri() . '/assets/css/base.css',
        array( 'yarbar-fonts' ),
        YARBAR_VERSION
    );

    // 3. Conditional stylesheet for Homepage
    if ( is_front_page() ) {
        wp_enqueue_style(
            'yarbar-homepage',
            get_template_directory_uri() . '/assets/css/homepage.css',
            array( 'yarbar-base' ),
            YARBAR_VERSION
        );
    }

    // 4. Conditional stylesheet for Single Posts / Services / Locations
    if ( is_singular() ) {
        wp_enqueue_style(
            'yarbar-single',
            get_template_directory_uri() . '/assets/css/single.css',
            array( 'yarbar-base' ),
            YARBAR_VERSION
        );
    }

    // 5. Conditional stylesheet for Archive / Category / Search pages
    if ( is_archive() || is_home() || is_search() ) {
        wp_enqueue_style(
            'yarbar-archive',
            get_template_directory_uri() . '/assets/css/archive.css',
            array( 'yarbar-base' ),
            YARBAR_VERSION
        );
    }

    // 6. Global Header navigation and interactions
    wp_enqueue_script(
        'yarbar-header',
        get_template_directory_uri() . '/assets/js/header.js',
        array(),
        YARBAR_VERSION,
        true
    );

    // 7. Interactive cost calculator on Homepage
    if ( is_front_page() ) {
        wp_enqueue_script(
            'yarbar-calculator',
            get_template_directory_uri() . '/assets/js/calculator.js',
            array(),
            YARBAR_VERSION,
            true
        );
    }

    // 8. Single post sharing and clipboard interactions
    if ( is_singular() ) {
        wp_enqueue_script(
            'yarbar-single',
            get_template_directory_uri() . '/assets/js/single.js',
            array(),
            YARBAR_VERSION,
            true
        );
    }

    // 9. WordPress threaded comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // 10. Archive AJAX filtering, sorting, and pagination script
    if ( is_archive() || is_home() || is_search() ) {
        wp_enqueue_script(
            'yarbar-archive',
            get_template_directory_uri() . '/assets/js/archive.js',
            array(),
            YARBAR_VERSION,
            true
        );
        wp_localize_script(
            'yarbar-archive',
            'yarbar_archive_ajax',
            array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'yarbar_archive_nonce' ),
            )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'yarbar_enqueue_assets' );

require get_template_directory() . '/inc/breadcrumbs.php';
require get_template_directory() . '/inc/performance.php';

// Add defer attribute to all custom theme scripts
add_filter( 'script_loader_tag', function( $tag, $handle ) {
    if ( strpos( $handle, 'yarbar-' ) === 0 && strpos( $tag, 'defer' ) === false ) {
        $tag = str_replace( ' src=', ' defer src=', $tag );
    }
    return $tag;
}, 10, 2 );

require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/business-settings.php';
require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/comments.php';
require get_template_directory() . '/inc/archive-ajax.php';