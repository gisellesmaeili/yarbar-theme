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
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'صفحه اصلی', 'yarbar' ) . '</a>';

    if ( is_front_page() ) {
        // Nothing more needed on front page
    } elseif ( is_post_type_archive( 'location' ) ) {
        echo '<span class="separator">/</span><span>' . esc_html__( 'مناطق تحت پوشش', 'yarbar' ) . '</span>';
    } elseif ( is_post_type_archive( 'service' ) ) {
        echo '<span class="separator">/</span><span>' . esc_html__( 'خدمات باربری', 'yarbar' ) . '</span>';
    } elseif ( is_category() ) {
        $blog_url = yarbar_blog_archive_url();
        echo '<span class="separator">/</span><a href="' . esc_url( $blog_url ) . '">' . esc_html__( 'وبلاگ و مقالات', 'yarbar' ) . '</a>';
        echo '<span class="separator">/</span><span>' . esc_html( single_cat_title( '', false ) ) . '</span>';
    } elseif ( is_home() || ( is_archive() && ! is_post_type_archive() ) ) {
        echo '<span class="separator">/</span><span>' . esc_html__( 'وبلاگ و مقالات', 'yarbar' ) . '</span>';
    } elseif ( is_search() ) {
        echo '<span class="separator">/</span><span>' . esc_html__( 'نتایج جستجو', 'yarbar' ) . '</span>';
    } elseif ( is_single() ) {
        $post_type = get_post_type();
        if ( 'service' === $post_type ) {
            $services_url = yarbar_archive_url( 'service', '/services/' );
            echo '<span class="separator">/</span><a href="' . esc_url( $services_url ) . '">' . esc_html__( 'خدمات باربری', 'yarbar' ) . '</a>';
        } elseif ( 'location' === $post_type ) {
            $locations_url = yarbar_archive_url( 'location', '/locations/' );
            echo '<span class="separator">/</span><a href="' . esc_url( $locations_url ) . '">' . esc_html__( 'مناطق تحت پوشش', 'yarbar' ) . '</a>';
        } else {
            $badge = yarbar_get_single_badge();
            $blog_url = yarbar_blog_archive_url();
            echo '<span class="separator">/</span><a href="' . esc_url( $blog_url ) . '">' . esc_html__( 'وبلاگ', 'yarbar' ) . '</a>';
            if ( $badge ) {
                echo '<span class="separator">/</span><a href="' . esc_url( $badge['url'] ) . '">' . esc_html( $badge['name'] ) . '</a>';
            }
        }
        echo '<span class="separator">/</span><span>' . esc_html( get_the_title() ) . '</span>';
    } elseif ( is_page() ) {
        echo '<span class="separator">/</span><span>' . esc_html( get_the_title() ) . '</span>';
    }
    echo '</nav>';
}