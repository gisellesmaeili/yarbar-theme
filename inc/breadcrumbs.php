<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function yarbar_breadcrumbs() {
    if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
        ob_start();
        rank_math_the_breadcrumbs();
        $output = ob_get_clean();
        if ( trim( $output ) !== '' ) {
            echo $output;
            return;
        }
    }

    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'مسیر صفحه', 'yarbar' ) . '">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'خانه', 'yarbar' ) . '</a>';
    if ( is_single() || is_page() ) {
        echo ' / <span>' . esc_html( get_the_title() ) . '</span>';
    }
    echo '</nav>';
}