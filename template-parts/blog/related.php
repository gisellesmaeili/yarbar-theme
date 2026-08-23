<?php
$yarbar_related = yarbar_related_posts( get_the_ID(), 3 );

if ( $yarbar_related->have_posts() ) :
    ?>
    <section class="related-articles">
        <h2 class="section-heading">مقالات مرتبط</h2>
        <div class="blog-grid">
            <?php while ( $yarbar_related->have_posts() ) : $yarbar_related->the_post(); ?>
                <?php get_template_part( 'template-parts/blog/post-card' ); ?>
            <?php endwhile; ?>
        </div>
    </section>
<?php
endif;
wp_reset_postdata();