<?php if ( have_posts() ) : ?>
    <div class="blog-grid">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/blog/post-card' ); ?>
        <?php endwhile; ?>
    </div>

    <?php
    the_posts_pagination( array(
        'prev_text' => __( 'قبلی', 'yarbar' ),
        'next_text' => __( 'بعدی', 'yarbar' ),
    ) );
    ?>
<?php else : ?>
    <p class="blog-empty">مقاله‌ای برای نمایش وجود ندارد.</p>
<?php endif; ?>