<?php
/**
 * Related Items Section for Single Templates
 * 
 * Works dynamically across posts, services, and locations.
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post_id         = get_the_ID();
$post_type       = get_post_type( $post_id );
$related_query   = yarbar_get_related_query( $post_id, 3 );
$heading_data    = yarbar_get_related_heading( $post_type );

if ( $related_query && $related_query->have_posts() ) :
?>
<section class="related-posts-section" aria-labelledby="related-heading">
    <div class="related-header">
        <h3 id="related-heading" class="related-title"><?php echo esc_html( $heading_data['title'] ); ?></h3>
        <a href="<?php echo esc_url( $heading_data['url'] ); ?>" class="related-more-link">
            <?php echo esc_html( $heading_data['label'] ); ?>
        </a>
    </div>

    <div class="blog-grid">
        <?php
        while ( $related_query->have_posts() ) :
            $related_query->the_post();
            get_template_part( 'template-parts/blog/post-card' );
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</section>
<?php endif; ?>
