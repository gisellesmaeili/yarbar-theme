<?php
/**
 * Archive Query Adjustments & AJAX Filtering / Pagination
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Adjust main query on search and archive pages
 */
function yarbar_adjust_archive_queries( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    // Search query should include all posts, services, locations
    if ( $query->is_search() ) {
        $query->set( 'post_type', array( 'post', 'service', 'location' ) );
        $query->set( 'posts_per_page', 9 );
        return;
    }

    // Set 9 posts per page on blog, category, taxonomy, CPT archives
    if ( $query->is_archive() || $query->is_home() ) {
        $query->set( 'posts_per_page', 9 );
    }
}
add_action( 'pre_get_posts', 'yarbar_adjust_archive_queries' );

/**
 * AJAX Handler for Archive Filtering, Sorting, and Pagination
 */
function yarbar_ajax_archive_filter() {
    check_ajax_referer( 'yarbar_archive_nonce', 'nonce' );

    $post_type = sanitize_key( $_POST['post_type'] ?? 'post' );
    $category  = sanitize_text_field( $_POST['category'] ?? 'all' );
    $sort      = sanitize_key( $_POST['sort'] ?? 'newest' );
    $paged     = max( 1, intval( $_POST['paged'] ?? 1 ) );
    $search    = sanitize_text_field( $_POST['s'] ?? '' );

    $args = array(
        'posts_per_page'      => 9,
        'paged'               => $paged,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
    );

    if ( ! empty( $search ) ) {
        $args['s']         = $search;
        $args['post_type'] = array( 'post', 'service', 'location' );
    } else {
        if ( in_array( $post_type, array( 'service', 'location', 'post' ), true ) ) {
            $args['post_type'] = $post_type;
        } else {
            $args['post_type'] = 'post';
        }
    }

    // Category filter applies to blog posts
    if ( 'post' === $args['post_type'] && 'all' !== $category && is_numeric( $category ) ) {
        $args['cat'] = intval( $category );
    }

    // Sorting
    switch ( $sort ) {
        case 'oldest':
            $args['orderby'] = 'date';
            $args['order']   = 'ASC';
            break;
        case 'title':
            $args['orderby'] = 'title';
            $args['order']   = 'ASC';
            break;
        case 'newest':
        default:
            $args['orderby'] = 'date';
            $args['order']   = 'DESC';
            break;
    }

    $query = new WP_Query( $args );

    ob_start();
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template-parts/blog/post-card' );
        }
        wp_reset_postdata();
    } else {
        echo '<div class="archive-empty"><p>' . esc_html__( 'موردی برای نمایش وجود ندارد.', 'yarbar' ) . '</p></div>';
    }
    $html = ob_get_clean();

    $pagination = yarbar_render_pagination( $query, $paged );

    $found_count = (int) $query->found_posts;
    $count_text  = sprintf( __( 'تعداد کل مطالب: %s مورد', 'yarbar' ), number_format_i18n( $found_count ) );
    if ( 'post' === $post_type ) {
        $count_text = sprintf( __( 'تعداد کل مطالب: %s مقاله', 'yarbar' ), number_format_i18n( $found_count ) );
    } elseif ( 'service' === $post_type ) {
        $count_text = sprintf( __( 'تعداد کل خدمات: %s خدمات', 'yarbar' ), number_format_i18n( $found_count ) );
    } elseif ( 'location' === $post_type ) {
        $count_text = sprintf( __( 'تعداد کل شعب: %s منطقه', 'yarbar' ), number_format_i18n( $found_count ) );
    }

    wp_send_json_success( array(
        'html'          => $html,
        'pagination'    => $pagination,
        'count_text'    => $count_text,
        'found_posts'   => $found_count,
        'max_num_pages' => (int) $query->max_num_pages,
    ) );
}
add_action( 'wp_ajax_yarbar_archive_filter', 'yarbar_ajax_archive_filter' );
add_action( 'wp_ajax_nopriv_yarbar_archive_filter', 'yarbar_ajax_archive_filter' );
