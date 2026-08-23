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
            <div class="blog-preview__grid">
                <?php while ( $yarbar_blog_query->have_posts() ) : $yarbar_blog_query->the_post(); ?>
                    <article class="blog-card">
                        <a href="<?php the_permalink(); ?>" class="blog-card__link">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="blog-card__image">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </div>
                            <?php endif; ?>
                            <h3 class="blog-card__title"><?php the_title(); ?></h3>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="blog-preview__empty">به زودی مقالات آموزشی اینجا قرار می‌گیرند.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>