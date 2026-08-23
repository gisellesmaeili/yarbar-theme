<?php
/**
 * YarBar Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Block direct access to this file.
}

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
}
add_action( 'after_setup_theme', 'yarbar_theme_setup' );

function yarbar_enqueue_assets() {
    wp_enqueue_style(
        'yarbar-style',
        get_stylesheet_uri(),
        array(),
        '1.0.4'
    );

    wp_enqueue_style(
        'yarbar-base',
        get_template_directory_uri() . '/assets/css/base.css',
        array(),
        '1.0.4'
    );
}
add_action( 'wp_enqueue_scripts', 'yarbar_enqueue_assets' );

require get_template_directory() . '/inc/breadcrumbs.php';
require get_template_directory() . '/inc/template-tags.php';