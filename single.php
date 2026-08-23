<?php
get_header();
?>

    <main>
        <article <?php post_class( 'single-article container' ); ?>>
            <?php yarbar_breadcrumbs(); ?>

            <header class="single-article__header">
                <h1 class="single-article__title"><?php the_title(); ?></h1>
                <p class="single-article__meta">
                    <?php echo esc_html( get_the_date() ); ?> ・ <?php the_author(); ?>
                </p>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="single-article__image">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <div class="single-article__cta">
                <a href="tel:+98XXXXXXXXXX" class="btn btn--primary">تماس با یاربار</a>
            </div>
        </article>

        <div class="container">
            <?php get_template_part( 'template-parts/blog/related' ); ?>
        </div>
    </main>

<?php
get_footer();