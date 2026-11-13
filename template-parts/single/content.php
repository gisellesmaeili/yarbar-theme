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

    <!-- 1. Dark Hero Section -->
    <section class="post-hero-section<?php echo ! $has_thumb ? ' post-hero-section--no-thumb' : ''; ?>">
        <div class="container hero-container">

            <!-- Breadcrumbs Navigation -->
            <nav class="breadcrumbs-nav" aria-label="<?php esc_attr_e( 'مسیر صفحه', 'yarbar' ); ?>">
                <?php yarbar_breadcrumbs(); ?>
            </nav>

            <!-- Post Hero Header & Meta -->
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

                <!-- Main Post Title -->
                <h1 class="post-title"><?php echo esc_html( $title ); ?></h1>

                <!-- Post Excerpt / Subtitle -->
                <?php if ( ! empty( $post_excerpt ) ) : ?>
                    <p class="post-excerpt">
                        <?php echo esc_html( $post_excerpt ); ?>
                    </p>
                <?php endif; ?>
            </header>

        </div>
    </section>

    <!-- 2. Main Content Section -->
    <section class="post-content-section">
        <div class="container main-container">

            <!-- Overlapping Featured Hero Image -->
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

            <!-- Post Article Container Card -->
            <div class="post-card">
                <div class="post-body-layout">

                    <!-- Floating Social Share Sidebar -->
                    <aside class="share-sidebar" aria-label="<?php esc_attr_e( 'اشتراک‌گذاری نوشته', 'yarbar' ); ?>">
                        <span class="share-title"><?php esc_html_e( 'اشتراک', 'yarbar' ); ?></span>
                        <div class="share-buttons-list">
                            <a href="<?php echo esc_url( 'https://t.me/share/url?url=' . rawurlencode( $permalink ) . '&text=' . rawurlencode( $title ) ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn telegram" aria-label="<?php esc_attr_e( 'اشتراک در تلگرام', 'yarbar' ); ?>" title="<?php esc_attr_e( 'تلگرام', 'yarbar' ); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>
                            </a>
                            <a href="<?php echo esc_url( 'https://api.whatsapp.com/send?text=' . rawurlencode( $title . ' ' . $permalink ) ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn whatsapp" aria-label="<?php esc_attr_e( 'اشتراک در واتس اپ', 'yarbar' ); ?>" title="<?php esc_attr_e( 'واتس اپ', 'yarbar' ); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
                            </a>
                            <button type="button" class="share-btn copy-link" data-url="<?php echo esc_url( $permalink ); ?>" aria-label="<?php esc_attr_e( 'کپی لینک نوشته', 'yarbar' ); ?>" title="<?php esc_attr_e( 'کپی لینک', 'yarbar' ); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-copy" aria-hidden="true"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"/><path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="icon-check" aria-hidden="true"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10"/></svg>
                            </button>
                        </div>
                    </aside>

                    <!-- Article Body Content -->
                    <article class="post-content">
                        <?php the_content(); ?>
                    </article>

                </div>
            </div>

            <!-- 3. Comments Section -->
            <?php if ( comments_open() || get_comments_number() ) : ?>
                <div class="post-comments-wrapper">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

            <!-- 4. Dynamic Related Items Section -->
            <?php get_template_part( 'template-parts/single/related' ); ?>

        </div>
    </section>

</main>
