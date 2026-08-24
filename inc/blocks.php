<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add one dedicated category, so YarBar's own blocks group together
 * in the block inserter, separate from WordPress's default blocks.
 */
function yarbar_block_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'yarbar-components',
                'title' => __( 'اجزای یاربار', 'yarbar' ),
                'icon'  => 'admin-site',
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'yarbar_block_category' );

/**
 * Load the JavaScript file that draws the block's editing screen.
 * This file loads ONLY inside wp-admin, never on the public site.
 */
function yarbar_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'yarbar-blocks-cta',
        get_template_directory_uri() . '/assets/js/blocks/cta.js',
        array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n' ),
        '1.0',
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'yarbar_enqueue_block_editor_assets' );

/**
 * Register the block's data fields, and tell WordPress which PHP
 * function builds its real, public-facing HTML.
 */
function yarbar_register_cta_block() {
    register_block_type( 'yarbar/cta', array(
        'attributes' => array(
            'text' => array(
                'type'    => 'string',
                'default' => 'تماس با یاربار',
            ),
            'url' => array(
                'type'    => 'string',
                'default' => 'tel:',
            ),
            'style' => array(
                'type'    => 'string',
                'default' => 'primary',
            ),
        ),
        'render_callback' => 'yarbar_render_cta_block',
    ) );
}
add_action( 'init', 'yarbar_register_cta_block' );

/**
 * Build the real HTML that visitors see on the public site.
 */
function yarbar_render_cta_block( $attributes ) {
    $text  = isset( $attributes['text'] ) ? $attributes['text'] : '';
    $url   = isset( $attributes['url'] ) ? $attributes['url'] : '#';
    $style = ( isset( $attributes['style'] ) && 'secondary' === $attributes['style'] ) ? 'secondary' : 'primary';

    if ( empty( $text ) ) {
        return '';
    }

    return sprintf(
        '<a href="%s" class="btn btn--%s">%s</a>',
        esc_url( $url ),
        esc_attr( $style ),
        esc_html( $text )
    );
}