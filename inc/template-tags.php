<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function yarbar_related_posts( $post_id, $limit = 3 ) {
    $categories = wp_get_post_categories( $post_id );

    return new WP_Query( array(
        'category__in'        => $categories,
        'post__not_in'        => array( $post_id ),
        'posts_per_page'      => $limit,
        'post_status'         => 'publish',
        'ignore_sticky_posts'  => true,
    ) );
}