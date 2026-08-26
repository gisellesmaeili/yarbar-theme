<?php
/**
 * Unified Single Content Template Part
 * 
 * Shared template for standard posts, services, and locations.
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post_id        = get_the_ID();
$post_type      = get_post_type( $post_id );
$category_badge = yarbar_get_single_badge( $post_id );
$post_excerpt   = yarbar_get_single_excerpt( $post_id );
$show_date      = ( 'post' === $post_type );
$has_thumb      = has_post_thumbnail( $post_id );
$permalink      = get_permalink( $post_id );
$title          = get_the_title( $post_id );
?>
<main class="single-post-page">

    <!-- ۱. هدر تیره بالای صفحه -->
    <section class="post-hero-section<?php echo ! $has_thumb ? ' post-hero-section--no-thumb' : ''; ?>">
        <div class="container hero-container">

            <!-- مسیر صفحه (Breadcrumbs) -->
            <nav class="breadcrumbs-nav" aria-label="<?php esc_attr_e( 'مسیر صفحه', 'yarbar' ); ?>">
                <?php yarbar_breadcrumbs(); ?>
            </nav>

            <!-- هدر و متاداده نوشته -->
            <header class="post-hero-header">
                <?php if ( $category_badge || $show_date ) : ?>
                    <div class="post-meta-top">
                        <?php if ( $category_badge ) : ?>
                            <a href="<?php echo esc_url( $category_badge['url'] ); ?>" class="post-category-tag">
                                <?php echo esc_html( $category_badge['name'] ); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ( $show_date ) : ?>
                            <span class="meta-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="16" height="16" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <?php echo esc_html( get_the_date() ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- عنوان اصلی -->
                <h1 class="post-title"><?php echo esc_html( $title ); ?></h1>

                <!-- خلاصه یا متای توضیحات -->
                <?php if ( ! empty( $post_excerpt ) ) : ?>
                    <p class="post-excerpt">
                        <?php echo esc_html( $post_excerpt ); ?>
                    </p>
                <?php endif; ?>
            </header>

        </div>
    </section>

    <!-- ۲. بخش محتوای اصلی -->
    <section class="post-content-section">
        <div class="container main-container">

            <!-- تصویر شاخص (با همپوشانی شیک) -->
            <?php if ( $has_thumb ) : ?>
                <figure class="featured-image-wrapper">
                    <?php the_post_thumbnail( 'yarbar-hero', array(
                        'class'    => 'featured-image',
                        'loading'  => 'eager',
                        'alt'      => esc_attr( $title ),
                    ) ); ?>
                    <?php if ( get_the_post_thumbnail_caption() ) : ?>
                        <figcaption class="image-caption"><?php echo esc_html( get_the_post_thumbnail_caption() ); ?></figcaption>
                    <?php endif; ?>
                </figure>
            <?php endif; ?>

            <!-- باکس سفید محتوای نوشته -->
            <div class="post-card">
                <div class="post-body-layout">

                    <!-- سایدبار اشتراک‌گذاری شناور -->
                    <aside class="share-sidebar" aria-label="<?php esc_attr_e( 'اشتراک‌گذاری نوشته', 'yarbar' ); ?>">
                        <span class="share-title"><?php esc_html_e( 'اشتراک', 'yarbar' ); ?></span>
                        <div class="share-buttons-list">
                            <a href="<?php echo esc_url( 'https://t.me/share/url?url=' . rawurlencode( $permalink ) . '&text=' . rawurlencode( $title ) ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn telegram" aria-label="<?php esc_attr_e( 'اشتراک در تلگرام', 'yarbar' ); ?>" title="<?php esc_attr_e( 'تلگرام', 'yarbar' ); ?>">
                                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.07-.2-.08-.06-.19-.04-.27-.02-.12.02-1.96 1.25-5.54 3.69-.52.36-1 .53-1.42.52-.47-.01-1.37-.26-2.03-.48-.82-.27-1.47-.42-1.42-.88.03-.25.38-.51 1.07-.78 4.18-1.82 6.97-3.02 8.37-3.61 3.98-1.66 4.81-1.95 5.35-1.96.12 0 .38.03.55.17.14.12.18.28.2.45-.02.07-.02.16-.04.25z"/></svg>
                            </a>
                            <a href="<?php echo esc_url( 'https://api.whatsapp.com/send?text=' . rawurlencode( $title . ' ' . $permalink ) ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn whatsapp" aria-label="<?php esc_attr_e( 'اشتراک در واتساپ', 'yarbar' ); ?>" title="<?php esc_attr_e( 'واتساپ', 'yarbar' ); ?>">
                                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20" aria-hidden="true"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            </a>
                            <button type="button" class="share-btn copy-link" data-url="<?php echo esc_url( $permalink ); ?>" aria-label="<?php esc_attr_e( 'کپی لینک نوشته', 'yarbar' ); ?>" title="<?php esc_attr_e( 'کپی لینک', 'yarbar' ); ?>">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="20" height="20" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </div>
                    </aside>

                    <!-- متن اصلی -->
                    <article class="post-content">
                        <?php the_content(); ?>
                    </article>

                </div>
            </div>

            <!-- ۳. بخش آیتم‌های مرتبط -->
            <?php get_template_part( 'template-parts/single/related' ); ?>

        </div>
    </section>

</main>
