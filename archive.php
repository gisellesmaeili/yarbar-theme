<?php
get_header();
?>

    <main>
        <div class="container">
            <?php yarbar_breadcrumbs(); ?>
            <h1 class="page-title"><?php echo esc_html( get_the_archive_title() ); ?></h1>
        </div>

        <div class="container">
            <?php get_template_part( 'template-parts/blog/loop' ); ?>
        </div>
    </main>

<?php
get_footer();