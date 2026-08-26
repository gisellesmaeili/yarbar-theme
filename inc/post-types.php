<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function yarbar_register_post_types() {

    register_post_type( 'service', array(
        'labels' => array(
            'name'          => __( 'خدمات', 'yarbar' ),
            'singular_name' => __( 'خدمت', 'yarbar' ),
            'add_new_item'  => __( 'افزودن خدمت جدید', 'yarbar' ),
            'edit_item'     => __( 'ویرایش خدمت', 'yarbar' ),
            'all_items'     => __( 'همه خدمات', 'yarbar' ),
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
            'name'          => __( 'مناطق تحت پوشش', 'yarbar' ),
            'singular_name' => __( 'منطقه', 'yarbar' ),
            'add_new_item'  => __( 'افزودن منطقه جدید', 'yarbar' ),
            'edit_item'     => __( 'ویرایش منطقه', 'yarbar' ),
            'all_items'     => __( 'همه مناطق', 'yarbar' ),
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

/**
 * Filter archive titles to remove prefixes and set clean Persian titles
 */
function yarbar_clean_archive_title( $title ) {
    if ( is_post_type_archive( 'location' ) ) {
        return __( 'مناطق تحت پوشش', 'yarbar' );
    }
    if ( is_post_type_archive( 'service' ) ) {
        return __( 'خدمات', 'yarbar' );
    }
    if ( is_category() ) {
        return single_cat_title( '', false );
    }
    if ( is_search() ) {
        return sprintf( __( 'نتایج جستجو برای: %s', 'yarbar' ), get_search_query() );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'yarbar_clean_archive_title' );
add_filter( 'post_type_archive_title', 'yarbar_clean_archive_title' );