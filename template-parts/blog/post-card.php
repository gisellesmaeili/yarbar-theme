<?php
/**
 * Standard Post Card Template Part
 * 
 * Reusable card used on Homepage Blog Preview, Blog Archives, Category Pages, Search, Services, Locations, etc.
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post_id   = get_the_ID();
$post_type = get_post_type( $post_id );
$badge     = yarbar_get_single_badge( $post_id );
$show_date = ( 'post' === $post_type );

if ( has_excerpt() ) {
    $excerpt_text = get_the_excerpt();
} else {
    $excerpt_text = wp_trim_words( wp_strip_all_tags( get_the_content() ), 22, '...' );
}
?>
<article <?php post_class( 'blog-card' ); ?>>
    <div class="blog-image-wrapper">
        <a href="<?php the_permalink(); ?>" class="blog-image-link" aria-label="<?php the_title_attribute(); ?>" tabindex="-1">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'yarbar-card', array(
                    'class'    => 'blog-image',
                    'loading'  => 'lazy',
                    'decoding' => 'async',
                    'alt'      => esc_attr( get_the_title() ),
                ) ); ?>
            <?php else : ?>
                <img 
                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero/yarbar-truck.webp' ); ?>" 
                    alt="<?php the_title_attribute(); ?>" 
                    class="blog-image" 
                    width="400" 
                    height="220" 
                    loading="lazy" 
                    decoding="async"
                >
            <?php endif; ?>
        </a>

        <?php if ( $badge ) : ?>
            <a href="<?php echo esc_url( $badge['url'] ); ?>" class="category-tag">
                <?php echo esc_html( $badge['name'] ); ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="blog-card-body">
        <?php if ( $show_date ) : ?>
            <div class="blog-meta">
                <span class="meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <?php echo esc_html( get_the_date() ); ?>
                </span>
            </div>
        <?php endif; ?>

        <h3 class="card-title">
            <a href="<?php the_permalink(); ?>" class="card-title-link">
                <?php the_title(); ?>
            </a>
        </h3>

        <?php if ( ! empty( $excerpt_text ) ) : ?>
            <p class="card-excerpt">
                <?php echo esc_html( $excerpt_text ); ?>
            </p>
        <?php endif; ?>

        <div class="card-footer">
            <a href="<?php the_permalink(); ?>" class="read-more-link">
                <span class="read-more-text"><?php esc_html_e( 'ادامه مطلب', 'yarbar' ); ?></span>
                <svg class="footer-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
        </div>
    </div>
</article>