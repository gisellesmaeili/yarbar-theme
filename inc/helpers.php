<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function yarbar_option( $key, $default = '' ) {
    $settings = get_option( 'yarbar_business_settings', array() );
    return $settings[ $key ] ?? $default;
}

function yarbar_phone_link( $type = 'phone_primary', $fallback = '' ) {
    $number = yarbar_option( $type, $fallback );
    if ( empty( $number ) ) {
        return '';
    }
    $clean = preg_replace( '/[^0-9+]/', '', $number );
    return esc_url( 'tel:' . $clean );
}

function yarbar_archive_url( $post_type, $fallback_path ) {
    $url = get_post_type_archive_link( $post_type );
    return $url ? $url : home_url( $fallback_path );
}

function yarbar_blog_archive_url() {
    $blog_page_id = get_option( 'page_for_posts' );
    $url          = $blog_page_id ? get_permalink( $blog_page_id ) : '';
    return $url ? $url : home_url( '/blog/' );
}

/**
 * Get category or taxonomy badge for single templates
 */
function yarbar_get_single_badge( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $post_type = get_post_type( $post_id );

    if ( 'post' === $post_type ) {
        $categories = get_the_category( $post_id );
        if ( ! empty( $categories ) ) {
            $default_cat_id = (int) get_option( 'default_category' );
            foreach ( $categories as $cat ) {
                if ( $cat->term_id !== $default_cat_id && 'uncategorized' !== $cat->slug ) {
                    return array(
                        'name' => $cat->name,
                        'url'  => get_category_link( $cat->term_id ),
                    );
                }
            }
            // If only default category exists
            return array(
                'name' => $categories[0]->name,
                'url'  => get_category_link( $categories[0]->term_id ),
            );
        }
    } else {
        // Custom taxonomy check for CPTs (if defined in future)
        $taxonomies = get_object_taxonomies( $post_type, 'objects' );
        foreach ( $taxonomies as $tax ) {
            if ( $tax->public ) {
                $terms = get_the_terms( $post_id, $tax->name );
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    return array(
                        'name' => $terms[0]->name,
                        'url'  => get_term_link( $terms[0] ),
                    );
                }
            }
        }
    }

    return null;
}

/**
 * Get excerpt or trimmed summary for single post hero
 */
function yarbar_get_single_excerpt( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    if ( has_excerpt( $post_id ) ) {
        return get_the_excerpt( $post_id );
    }
    $content = get_post_field( 'post_content', $post_id );
    if ( ! empty( $content ) ) {
        return wp_trim_words( wp_strip_all_tags( $content ), 26, '...' );
    }
    return '';
}

/**
 * Get related posts query for any post type
 */
function yarbar_get_related_query( $post_id = null, $limit = 3 ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $post_type = get_post_type( $post_id );

    if ( 'post' === $post_type ) {
        $categories = wp_get_post_categories( $post_id );
        $args = array(
            'post_type'           => 'post',
            'post__not_in'        => array( $post_id ),
            'posts_per_page'      => $limit,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        );
        if ( ! empty( $categories ) ) {
            $args['category__in'] = $categories;
        }
        return new WP_Query( $args );
    }

    return new WP_Query( array(
        'post_type'           => $post_type,
        'post__not_in'        => array( $post_id ),
        'posts_per_page'      => $limit,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'orderby'             => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
    ) );
}

/**
 * Get related section headings and archive links based on post type
 */
function yarbar_get_related_heading( $post_type = 'post' ) {
    switch ( $post_type ) {
        case 'service':
            return array(
                'title' => __( 'سایر خدمات یاربار', 'yarbar' ),
                'label' => __( 'مشاهده همه خدمات ←', 'yarbar' ),
                'url'   => yarbar_archive_url( 'service', '/services/' ),
            );
        case 'location':
            return array(
                'title' => __( 'سایر مناطق تحت پوشش', 'yarbar' ),
                'label' => __( 'مشاهده همه مناطق ←', 'yarbar' ),
                'url'   => yarbar_archive_url( 'location', '/locations/' ),
            );
        case 'post':
        default:
            return array(
                'title' => __( 'نوشته‌های مرتبط', 'yarbar' ),
                'label' => __( 'مشاهده همه مقالات ←', 'yarbar' ),
                'url'   => yarbar_blog_archive_url(),
            );
    }
}
