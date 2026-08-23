<?php
get_header();
?>

    <main>
        <article <?php post_class( 'single-article container' ); ?>>
            <?php yarbar_breadcrumbs(); ?>

            <header class="single-article__header">
                <h1 class="single-article__title"><?php the_title(); ?></h1>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="single-article__image">
                    <?php the_post_thumbnail( 'yarbar-hero' ); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <div class="single-article__cta">
                <a href="<?php echo yarbar_phone_link(); ?>" class="btn btn--primary">تماس با یاربار</a>
            </div>
        </article>
    </main>

<?php
get_footer();