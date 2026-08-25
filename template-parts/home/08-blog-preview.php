<?php
/**
 * Blog Preview Section Template Part
 * 
 * Dynamic query of latest 3 blog posts with featured images,
 * category badges, publication dates, and archive links.
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

$blog_page_id = get_option( 'page_for_posts' );
$blog_archive_url = $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/blog/' );
if ( empty( $blog_archive_url ) ) {
    $blog_archive_url = home_url( '/blog/' );
}
?>
<!-- سکشن مقالات و مجله آموزشی (پس‌زمینه سفید) -->
<section id="blog-section" class="blog-section" aria-labelledby="blog-section-title">
    <div class="container blog-container">

        <!-- هدر سکشن همراه با دکمه آرشیو -->
        <div class="blog-header-wrapper">
            <h2 id="blog-section-title" class="blog-title">آخرین مقالات و راهنماهای کاربردی اسباب‌کشی</h2>
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
                <?php
                while ( $yarbar_blog_query->have_posts() ) :
                    $yarbar_blog_query->the_post();
                    $categories = get_the_category();
                    $category_name = ! empty( $categories ) ? $categories[0]->name : 'وبلاگ یاربار';

                    if ( has_excerpt() ) {
                        $excerpt_text = get_the_excerpt();
                    } else {
                        $excerpt_text = wp_trim_words( wp_strip_all_tags( get_the_content() ), 22, '...' );
                    }
                    ?>
                    <article class="blog-card">
                        <a href="<?php the_permalink(); ?>" class="blog-card-link" aria-label="<?php the_title_attribute(); ?>">
                            <div class="blog-image-wrapper">
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
                                <span class="category-tag"><?php echo esc_html( $category_name ); ?></span>
                            </div>
                            <div class="blog-card-body">
                                <div class="blog-meta">
                                    <span class="meta-item">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <?php echo esc_html( get_the_date() ); ?>
                                    </span>
                                </div>
                                <h3 class="card-title"><?php the_title(); ?></h3>
                                <p class="card-excerpt">
                                    <?php echo esc_html( $excerpt_text ); ?>
                                </p>
                                <div class="card-footer">
                                    <span class="read-more-text">ادامه مطلب</span>
                                    <svg class="footer-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
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