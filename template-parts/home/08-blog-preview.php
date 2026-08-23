<?php
$yarbar_blog_query = new WP_Query( array(
        'posts_per_page' => 3,
        'post_status'     => 'publish',
) );
?>

<section class="blog-preview">
    <div class="container">
        <h2 class="section-heading">آخرین مقالات</h2>

        <?php if ( $yarbar_blog_query->have_posts() ) : ?>
            <div class="blog-grid">
                <?php while ( $yarbar_blog_query->have_posts() ) : $yarbar_blog_query->the_post(); ?>
                    <?php get_template_part( 'template-parts/blog/post-card' ); ?>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="blog-empty">به زودی مقالات آموزشی اینجا قرار می‌گیرند.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>