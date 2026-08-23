<article <?php post_class( 'blog-card' ); ?>>
    <a href="<?php the_permalink(); ?>" class="blog-card__link">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="blog-card__image">
                <?php the_post_thumbnail( 'medium' ); ?>
            </div>
        <?php endif; ?>
        <h3 class="blog-card__title"><?php the_title(); ?></h3>
    </a>
</article>