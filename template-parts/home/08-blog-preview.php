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
?>
<!-- سکشن مقالات و مجله آموزشی (پس‌زمینه سفید) -->
<section id="blog-section" class="blog-section" aria-labelledby="blog-section-title">
    <div class="container blog-container">

        <!-- هدر سکشن همراه با دکمه آرشیو -->
        <div class="blog-header-wrapper">
            <h2 id="blog-section-title" class="blog-title">تازه‌ترین مطالب و نکات حمل بار</h2>
            <!-- دکمه هدایت به آرشیو وبلاگ (دسکتاپ) -->
            <a href="<?php echo esc_url( $blog_archive_url ); ?>" class="blog-archive-btn">
                <span>مشاهده همه مقالات</span>
                <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
        </div>

        <!-- شبکه‌بندی مقالات (۳ ستونه) -->
        <div class="blog-grid">
            <?php if ( $yarbar_blog_query->have_posts() ) : ?>
                <?php while ( $yarbar_blog_query->have_posts() ) : $yarbar_blog_query->the_post(); ?>
                    <?php get_template_part( 'template-parts/blog/post-card' ); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>

        <!-- دکمه آرشیو در حالت موبایل (نمایش فقط در صفحه کوچک) -->
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