<?php
/**
 * The homepage template
 */

get_header();
?>

    <main>
        <?php get_template_part( 'template-parts/home/01-hero' ); ?>
        <?php get_template_part( 'template-parts/home/02-marquee' ); ?>
        <?php get_template_part( 'template-parts/home/03-calculator' ); ?>
        <?php get_template_part( 'template-parts/home/04-services' ); ?>
        <?php get_template_part( 'template-parts/home/04-why-yarbar' ); ?>
        <?php get_template_part( 'template-parts/home/05-how-it-works' ); ?>
        <?php get_template_part( 'template-parts/home/06-coverage' ); ?>
        <?php get_template_part( 'template-parts/home/07-quote-placeholder' ); ?>
        <?php get_template_part( 'template-parts/home/08-blog-preview' ); ?>
        <?php get_template_part( 'template-parts/home/09-final-cta' ); ?>
    </main>

<?php
get_footer();