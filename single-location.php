<?php
/**
 * The template for displaying single location posts
 *
 * @package YarBar
 */

get_header();

while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/single/content' );
endwhile;

get_footer();