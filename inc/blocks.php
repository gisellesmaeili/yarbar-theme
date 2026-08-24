<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add one dedicated category, so YarBar's own blocks group together
 * in the block inserter, separate from WordPress's default blocks.
 */
function yarbar_block_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'yarbar-components',
                'title' => __( 'اجزای یاربار', 'yarbar' ),
                'icon'  => 'admin-site',
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'yarbar_block_category' );

/**
 * Load the JavaScript file that draws the block's editing screen.
 * This file loads ONLY inside wp-admin, never on the public site.
 */
function yarbar_enqueue_block_editor_assets() {
    wp_enqueue_script(
            'yarbar-blocks-cta',
            get_template_directory_uri() . '/assets/js/blocks/cta.js',
            array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n' ),
            '1.0.10',
            true
    );

    wp_enqueue_script(
            'yarbar-blocks-hero',
            get_template_directory_uri() . '/assets/js/blocks/hero.js',
            array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-i18n', 'yarbar-blocks-cta' ),
            '1.0.10',
            true
    );

    wp_enqueue_script(
            'yarbar-blocks-faq-item',
            get_template_directory_uri() . '/assets/js/blocks/faq-item.js',
            array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-i18n' ),
            '1.0.10',
            true
    );

    wp_enqueue_script(
            'yarbar-blocks-faq',
            get_template_directory_uri() . '/assets/js/blocks/faq.js',
            array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-i18n', 'wp-data', 'wp-components', 'yarbar-blocks-faq-item' ),
            '1.0.10',
            true
    );
}
add_action( 'enqueue_block_editor_assets', 'yarbar_enqueue_block_editor_assets' );

/**
 * Register the block's data fields, and tell WordPress which PHP
 * function builds its real, public-facing HTML.
 */
function yarbar_register_cta_block() {
    register_block_type( 'yarbar/cta', array(
        'attributes' => array(
            'text' => array(
                'type'    => 'string',
                'default' => 'تماس با یاربار',
            ),
            'url' => array(
                'type'    => 'string',
                'default' => 'tel:',
            ),
            'style' => array(
                'type'    => 'string',
                'default' => 'primary',
            ),
        ),
        'render_callback' => 'yarbar_render_cta_block',
    ) );
}
add_action( 'init', 'yarbar_register_cta_block' );

/**
 * Build the real HTML that visitors see on the public site.
 */
function yarbar_render_cta_block( $attributes ) {
    $text  = isset( $attributes['text'] ) ? $attributes['text'] : '';
    $url   = isset( $attributes['url'] ) ? $attributes['url'] : '#';
    $style = ( isset( $attributes['style'] ) && 'secondary' === $attributes['style'] ) ? 'secondary' : 'primary';

    if ( 'tel:' === trim( $url ) ) {
        $url = yarbar_phone_link();
    }

    if ( empty( $text ) ) {
        return '';
    }

    return sprintf(
        '<a href="%s" class="btn btn--%s">%s</a>',
        esc_url( $url ),
        esc_attr( $style ),
        esc_html( $text )
    );
}

/**
 * Register the Hero block's data fields, and its PHP render function.
 */
function yarbar_register_hero_block() {
    register_block_type( 'yarbar/hero', array(
        'attributes' => array(
            'eyebrow'     => array( 'type' => 'string', 'default' => '' ),
            'title'       => array( 'type' => 'string', 'default' => '' ),
            'description' => array( 'type' => 'string', 'default' => '' ),
        ),
        'render_callback' => 'yarbar_render_hero_block',
    ) );
}
add_action( 'init', 'yarbar_register_hero_block' );

function yarbar_render_hero_block( $attributes, $content ) {
    $eyebrow     = isset( $attributes['eyebrow'] ) ? $attributes['eyebrow'] : '';
    $title       = isset( $attributes['title'] ) ? $attributes['title'] : '';
    $description = isset( $attributes['description'] ) ? $attributes['description'] : '';

    ob_start();
    ?>
    <section class="hero">
        <div class="container hero__inner">
            <?php if ( ! empty( $eyebrow ) ) : ?>
                <span class="hero__eyebrow"><?php echo wp_kses_post( $eyebrow ); ?></span>
            <?php endif; ?>

            <h1 class="hero__title"><?php echo wp_kses_post( $title ); ?></h1>

            <?php if ( ! empty( $description ) ) : ?>
                <p class="hero__description"><?php echo wp_kses_post( $description ); ?></p>
            <?php endif; ?>

            <div class="hero__actions">
                <?php echo $content; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Restrict the homepage's block editor to the Hero block only.
 * This is the guardrail from your visual editor document, Section 4:
 * the SEO specialist can add predefined components, never arbitrary layout blocks.
 */
function yarbar_restrict_homepage_blocks( $allowed_blocks, $block_editor_context ) {
    if (
        isset( $block_editor_context->post )
        && (int) $block_editor_context->post->ID === (int) get_option( 'page_on_front' )
    ) {
        return array( 'yarbar/hero' );
    }
    return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'yarbar_restrict_homepage_blocks', 10, 2 );

/**
 * Register the FAQ Item block. It has no render_callback of its own —
 * the parent FAQ block reads its data directly and builds the full markup.
 */
function yarbar_register_faq_item_block() {
    register_block_type( 'yarbar/faq-item', array(
            'attributes' => array(
                    'question' => array( 'type' => 'string', 'default' => '' ),
                    'answer'   => array( 'type' => 'string', 'default' => '' ),
            ),
    ) );
}
add_action( 'init', 'yarbar_register_faq_item_block' );

/**
 * Register the FAQ block and its PHP render function.
 */
function yarbar_register_faq_block() {
    register_block_type( 'yarbar/faq', array(
            'render_callback' => 'yarbar_render_faq_block',
    ) );
}
add_action( 'init', 'yarbar_register_faq_block' );

function yarbar_render_faq_block( $attributes, $content, $block ) {
    $items = array();

    foreach ( $block->parsed_block['innerBlocks'] as $inner_block ) {
        if ( 'yarbar/faq-item' !== $inner_block['blockName'] ) {
            continue;
        }
        $question = isset( $inner_block['attrs']['question'] ) ? $inner_block['attrs']['question'] : '';
        $answer   = isset( $inner_block['attrs']['answer'] ) ? $inner_block['attrs']['answer'] : '';

        if ( empty( $question ) || empty( $answer ) ) {
            continue;
        }

        $items[] = array(
                'question' => $question,
                'answer'   => $answer,
        );
    }

    if ( empty( $items ) ) {
        return '';
    }

    ob_start();
    ?>
    <section class="faq">
        <div class="container">
            <h2 class="section-heading">سوالات متداول</h2>
            <div class="faq__list">
                <?php foreach ( $items as $item ) : ?>
                    <details class="faq__item">
                        <summary class="faq__question"><?php echo wp_kses_post( $item['question'] ); ?></summary>
                        <div class="faq__answer"><?php echo wp_kses_post( $item['answer'] ); ?></div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}