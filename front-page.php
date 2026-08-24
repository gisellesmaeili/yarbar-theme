<?php
/**
 * The homepage template
 */

get_header();
?>

    <main>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>

        <?php get_template_part( 'template-parts/home/02-trust-strip' ); ?>
        <?php get_template_part( 'template-parts/home/03-services' ); ?>
        <?php get_template_part( 'template-parts/home/04-why-yarbar' ); ?>
        <?php get_template_part( 'template-parts/home/05-how-it-works' ); ?>
        <?php get_template_part( 'template-parts/home/06-coverage' ); ?>
        <?php get_template_part( 'template-parts/home/07-quote-placeholder' ); ?>
        <?php get_template_part( 'template-parts/home/08-blog-preview' ); ?>
        <?php get_template_part( 'template-parts/home/09-final-cta' ); ?>
    </main>

<?php
get_footer();