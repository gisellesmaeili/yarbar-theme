<?php
/**
 * The homepage template
 */

get_header();
?>

    <main>
        <?php get_template_part( 'template-parts/home/01-hero' ); ?>
        <?php get_template_part( 'template-parts/home/02-trust-strip' ); ?>
        <?php get_template_part( 'template-parts/home/03-services' ); ?>
        <?php get_template_part( 'template-parts/home/04-why-yarbar' ); ?>
        <?php get_template_part( 'template-parts/home/05-how-it-works' ); ?>
    </main>

<?php
get_footer();