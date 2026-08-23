<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Remove unnecessary code WordPress adds to <head> by default.
 */
function yarbar_clean_head() {
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
}
add_action( 'init', 'yarbar_clean_head' );

/**
 * Remove jQuery Migrate. It exists only to support very old jQuery code.
 * This theme does not use it.
 */
function yarbar_remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            array( 'jquery-migrate' )
        );
    }
}
add_action( 'wp_default_scripts', 'yarbar_remove_jquery_migrate' );