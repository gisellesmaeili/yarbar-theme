<?php
/**
 * Blog Preview Section Template Part
 * 
 * Dynamic query of latest 3 blog posts using the standardized post-card component.
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$yarbar_blog_query = new WP_Query( array(
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
) );

$blog_archive_url = yarbar_blog_archive_url();
$blog_eyebrow     = yarbar_option( 'blog_eyebrow', '' );
$blog_title       = yarbar_option( 'blog_title', 'تازه‌ترین مطالب و نکات حمل بار' );
?>
<!-- Blog & Articles Showcase Section (White Background) -->
<section id="blog-section" class="blog-section" aria-labelledby="blog-section-title">
    <div class="container blog-container">

        <!-- Section Header with Archive CTA Button -->
        <div class="blog-header-wrapper">
            <div class="blog-header-title-wrap">
                <?php if ( ! empty( $blog_eyebrow ) ) : ?>
                    <span class="badge badge--orange" style="margin-bottom: 8px; display: inline-flex;"><?php echo esc_html( $blog_eyebrow ); ?></span>
                <?php endif; ?>
                <h2 id="blog-section-title" class="blog-title"><?php echo esc_html( $blog_title ); ?></h2>
            </div>
            <!-- Desktop Archive Navigation Button -->
            <a href="<?php echo esc_url( $blog_archive_url ); ?>" class="blog-archive-btn">
                <span>مشاهده همه مقالات</span>
                <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
        </div>

        <!-- 3-Column Blog Articles Grid -->
        <div class="blog-grid">
            <?php if ( $yarbar_blog_query->have_posts() ) : ?>
                <?php while ( $yarbar_blog_query->have_posts() ) : $yarbar_blog_query->the_post(); ?>
                    <?php get_template_part( 'template-parts/blog/post-card' ); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>

        <!-- Mobile Archive Button (shown only on small viewports) -->
        <div class="mobile-archive-wrapper">
            <a href="<?php echo esc_url( $blog_archive_url ); ?>" class="blog-archive-btn full-width">
                <span>مشاهده همه مقالات وبلاگ</span>
                <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
        </div>

    </div>
</section>