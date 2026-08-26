<?php
/**
 * The template for displaying all single blog posts
 *
 * @package YarBar
 */

get_header();

while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/single/content' );
endwhile;

get_footer();