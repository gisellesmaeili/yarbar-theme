<?php
/**
 * Unified Archive & Search Content Template Part
 * 
 * Shared template for Blog Archive, Category Pages, Service Archive, Location Archive, and Search Results.
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$meta         = yarbar_get_archive_meta();
$show_filters = $meta['show_filters'];
$categories   = $meta['categories'];
$current_cat  = is_category() ? get_queried_object_id() : 'all';
?>
<main class="archive-page">

    <!-- ۱. هدر تیره بالای صفحه (#0A1929) -->
    <section class="archive-hero-section">
        <div class="container hero-container">

            <!-- مسیر صفحه (Breadcrumbs) و شمارش مطالب -->
            <nav class="breadcrumbs-nav" aria-label="<?php esc_attr_e( 'مسیر صفحه', 'yarbar' ); ?>">
                <div class="breadcrumbs-wrapper">
                    <div class="breadcrumbs-right">
                        <?php yarbar_breadcrumbs(); ?>
                    </div>
                    <span class="post-count" id="archive-post-count"><?php echo esc_html( $meta['count_text'] ); ?></span>
                </div>
            </nav>

            <!-- عنوان و فرم جستجو -->
            <header class="archive-hero-header">
                <h1 class="archive-title"><?php echo wp_kses_post( $meta['title'] ); ?></h1>
                <?php if ( ! empty( $meta['description'] ) ) : ?>
                    <p class="archive-subtitle"><?php echo esc_html( $meta['description'] ); ?></p>
                <?php endif; ?>

                <!-- فرم جستجو -->
                <form class="archive-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET" role="search">
                    <div class="search-input-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="20" height="20" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( $meta['search_placeholder'] ); ?>" required autocomplete="off" />
                    </div>
                    <button type="submit" class="search-submit-btn"><?php esc_html_e( 'جستجو', 'yarbar' ); ?></button>
                </form>
            </header>

        </div>
    </section>

    <!-- ۲. بخش اصلی مطالب -->
    <section class="archive-content-section">
        <div class="container main-container" id="archive-main-container">

            <!-- فیلتر دسته‌بندی و مرتب‌سازی: ONLY ON POSTS ARCHIVE (blog) -->
            <?php if ( $show_filters ) : ?>
                <div class="archive-filter-bar">
                    <nav class="categories-tabs" aria-label="<?php esc_attr_e( 'دسته‌بندی مقالات', 'yarbar' ); ?>">
                        <button type="button" class="category-tab<?php echo 'all' === $current_cat ? ' active' : ''; ?>" data-category="all">
                            <?php esc_html_e( 'همه مقالات', 'yarbar' ); ?>
                        </button>
                        <?php foreach ( $categories as $cat ) : ?>
                            <button type="button" class="category-tab<?php echo (int) $current_cat === (int) $cat->term_id ? ' active' : ''; ?>" data-category="<?php echo esc_attr( $cat->term_id ); ?>">
                                <?php echo esc_html( $cat->name ); ?>
                            </button>
                        <?php endforeach; ?>
                    </nav>

                    <div class="sort-wrapper">
                        <label for="sort-select" class="sort-label"><?php esc_html_e( 'مرتب‌سازی:', 'yarbar' ); ?></label>
                        <select id="sort-select" class="sort-select" aria-label="<?php esc_attr_e( 'مرتب‌سازی بر اساس', 'yarbar' ); ?>">
                            <option value="newest"><?php esc_html_e( 'جدیدترین', 'yarbar' ); ?></option>
                            <option value="oldest"><?php esc_html_e( 'قدیمی‌ترین', 'yarbar' ); ?></option>
                            <option value="title"><?php esc_html_e( 'عنوان', 'yarbar' ); ?></option>
                        </select>
                    </div>
                </div>
            <?php endif; ?>

            <!-- محتوای گرید مقالات و صفحه بندی -->
            <div id="archive-grid-container" class="archive-grid-container" data-post-type="<?php echo esc_attr( $meta['post_type'] ); ?>" data-search="<?php echo esc_attr( get_search_query() ); ?>">
                <div class="blog-grid" id="archive-blog-grid">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/blog/post-card' );
                        endwhile;
                    else :
                        ?>
                        <div class="archive-empty">
                            <p><?php echo esc_html( $meta['empty_text'] ); ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- صفحه‌بندی -->
                <div id="archive-pagination-wrapper">
                    <?php echo yarbar_render_pagination(); ?>
                </div>
            </div>

        </div>
    </section>

</main>
