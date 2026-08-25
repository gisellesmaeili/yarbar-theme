<?php
/**
 * YarBar Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Block direct access to this file.
}

define( 'YARBAR_VERSION', '1.0.15' );

function yarbar_theme_setup() {
    // Let WordPress manage the page <title> tag.
    add_theme_support( 'title-tag' );

    // Allow featured images (used for blog posts).
    add_theme_support( 'post-thumbnails' );

    // Let WordPress handle the RSS feed link automatically.
    add_theme_support( 'automatic-feed-links' );

    // Register a menu location for the main navigation.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'yarbar' ),
    ) );

    // Custom image sizes matching real card and hero dimensions.
    add_image_size( 'yarbar-card', 500, 320, true );
    add_image_size( 'yarbar-hero', 1600, 900, true );
}
add_action( 'after_setup_theme', 'yarbar_theme_setup' );

function yarbar_enqueue_assets() {
    wp_enqueue_style(
        'yarbar-fonts',
        get_template_directory_uri() . '/assets/css/fonts.css',
        array(),
        YARBAR_VERSION
    );

    wp_enqueue_style(
        'yarbar-style',
        get_stylesheet_uri(),
        array(),
        YARBAR_VERSION
    );

    wp_enqueue_style(
        'yarbar-base',
        get_template_directory_uri() . '/assets/css/base.css',
        array( 'yarbar-fonts' ),
        YARBAR_VERSION
    );

    wp_enqueue_script(
        'yarbar-header',
        get_template_directory_uri() . '/assets/js/header.js',
        array(),
        YARBAR_VERSION,
        true
    );

    wp_enqueue_script(
        'yarbar-calculator',
        get_template_directory_uri() . '/assets/js/calculator.js',
        array(),
        YARBAR_VERSION,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'yarbar_enqueue_assets' );

require get_template_directory() . '/inc/breadcrumbs.php';
require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/performance.php';

function yarbar_script_loading_strategy( $strategy, $handle, $src ) {
    if ( strpos( $handle, 'yarbar-' ) === 0 ) {
        return 'defer';
    }
    return $strategy;
}
add_filter( 'wp_script_attributes', function( $attributes ) {
    return $attributes;
} );
add_filter( 'script_loader_tag', function( $tag, $handle ) {
    if ( strpos( $handle, 'yarbar-' ) === 0 && strpos( $tag, 'defer' ) === false ) {
        $tag = str_replace( ' src=', ' defer src=', $tag );
    }
    return $tag;
}, 10, 2 );

require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/business-settings.php';
require get_template_directory() . '/inc/post-types.php';