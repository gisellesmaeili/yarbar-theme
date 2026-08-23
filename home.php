<?php
get_header();
?>

    <main>
        <div class="container">
            <?php yarbar_breadcrumbs(); ?>
            <h1 class="page-title">وبلاگ یاربار</h1>
            <p class="page-intro">آخرین مقالات آموزشی درباره اسباب‌کشی و حمل و نقل.</p>
        </div>

        <div class="container">
            <?php get_template_part( 'template-parts/blog/loop' ); ?>
        </div>
    </main>

<?php
get_footer();