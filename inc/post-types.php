<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function yarbar_register_post_types() {

    register_post_type( 'service', array(
        'labels' => array(
            'name'          => __( 'Services', 'yarbar' ),
            'singular_name' => __( 'Service', 'yarbar' ),
            'add_new_item'  => __( 'Add New Service', 'yarbar' ),
            'edit_item'     => __( 'Edit Service', 'yarbar' ),
            'all_items'     => __( 'Services', 'yarbar' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-car',
        'rewrite'      => array(
            'slug'       => 'services',
            'with_front' => false,
        ),
        'supports' => array( 'title', 'editor', 'thumbnail' ),
    ) );

    register_post_type( 'location', array(
        'labels' => array(
            'name'          => __( 'Locations', 'yarbar' ),
            'singular_name' => __( 'Location', 'yarbar' ),
            'add_new_item'  => __( 'Add New Location', 'yarbar' ),
            'edit_item'     => __( 'Edit Location', 'yarbar' ),
            'all_items'     => __( 'Locations', 'yarbar' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-location',
        'rewrite'      => array(
            'slug'       => 'locations',
            'with_front' => false,
        ),
        'supports' => array( 'title', 'editor', 'thumbnail' ),
    ) );
}
add_action( 'init', 'yarbar_register_post_types' );