<?php
/**
 * FAQ Section Template Part (Frequently Asked Questions)
 * 
 * Clean, high-performance accordion component using native <details> and <summary>
 * with support callout box and dynamic content from WordPress settings.
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$faq_eyebrow = yarbar_option( 'faq_eyebrow', 'سؤالات متداول' );
$faq_title   = yarbar_option( 'faq_title', 'پاسخ سؤالات خود را اینجا پیدا کنید' );
$faq_desc    = yarbar_option( 'faq_desc', 'پاسخ رایج‌ترین سؤالات درباره نحوه ثبت درخواست، انتخاب خودرو، هزینه حمل و خدمات یاربار را در این بخش ببینید.' );
$faq_tag     = yarbar_validate_heading_tag( yarbar_option( 'faq_tag', 'h2' ), 'h2' );

$faqs_data   = yarbar_get_faqs();
$col1_items  = ! empty( $faqs_data['col1'] ) ? $faqs_data['col1'] : array();
$col2_items  = ! empty( $faqs_data['col2'] ) ? $faqs_data['col2'] : array();

$phone_link  = yarbar_phone_link( 'support_phone', '۰۲۱-۹۱۰۰۰۰۰۰' );
?>
<!-- Frequently Asked Questions (FAQ) Section -->
<section id="faq" class="faq-section" aria-labelledby="faq-title">
    <div class="container faq-container">

        <!-- Section Header -->
        <div class="faq-header">
            <?php if ( ! empty( $faq_eyebrow ) ) : ?>
                <div class="badge badge--orange">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="16" height="16" aria-hidden="true">
                        <circle cx="12" cy="12" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3m.08 4h.01"/>
                    </svg>
                    <span><?php echo wp_kses_post( $faq_eyebrow ); ?></span>
                </div>
            <?php endif; ?>
            <<?php echo $faq_tag; ?> id="faq-title" class="faq-title"><?php echo wp_kses_post( $faq_title ); ?></<?php echo $faq_tag; ?>>
            <?php if ( ! empty( $faq_desc ) ) : ?>
                <p class="faq-subtitle">
                    <?php echo wp_kses_post( $faq_desc ); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Two-Column Accordion Grid -->
        <div class="faq-grid">

            <!-- Column 1 -->
            <div class="faq-column">
                <?php foreach ( $col1_items as $index => $item ) : ?>
                    <details class="faq-card"<?php echo ( 0 === $index ) ? ' open' : ''; ?>>
                        <summary class="faq-summary">
                            <span class="faq-question"><?php echo esc_html( $item['q'] ); ?></span>
                            <span class="faq-icon-wrapper" aria-hidden="true">
                                <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                                </svg>
                            </span>
                        </summary>
                        <div class="faq-answer">
                            <?php echo wpautop( esc_html( $item['a'] ) ); ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>

            <!-- Column 2 -->
            <div class="faq-column">
                <?php foreach ( $col2_items as $index => $item ) : ?>
                    <details class="faq-card">
                        <summary class="faq-summary">
                            <span class="faq-question"><?php echo esc_html( $item['q'] ); ?></span>
                            <span class="faq-icon-wrapper" aria-hidden="true">
                                <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                                </svg>
                            </span>
                        </summary>
                        <div class="faq-answer">
                            <?php echo wpautop( esc_html( $item['a'] ) ); ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Bottom Interactive Support Callout Card -->
        <div class="faq-callout-box">
            <div class="callout-info">
                <div class="callout-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12.4 2l.253 .005a6.34 6.34 0 0 1 5.235 3.166l.089 .163l.178 .039a6.33 6.33 0 0 1 4.254 3.406l.105 .228a6.334 6.334 0 0 1 -5.74 8.865l-.144 -.002l-.037 .052a5.26 5.26 0 0 1 -5.458 1.926l-.186 -.051l-3.435 2.06a1 1 0 0 1 -1.508 -.743l-.006 -.114v-2.435l-.055 -.026a3.67 3.67 0 0 1 -1.554 -1.498l-.102 -.199a3.67 3.67 0 0 1 -.312 -2.14l.038 -.21l-.116 -.092a5.8 5.8 0 0 1 -1.887 -6.025l.071 -.238a5.8 5.8 0 0 1 5.42 -4.004h.157l.15 -.165a6.33 6.33 0 0 1 4.33 -1.963zm1.6 11h-5a1 1 0 0 0 0 2h5a1 1 0 0 0 0 -2m3 -4h-10a1 1 0 1 0 0 2h10a1 1 0 0 0 0 -2" />
                    </svg>
                </div>
                <div class="callout-text">
                    <h4>هنوز پاسخ سوال خود را پیدا نکردید؟</h4>
                    <p>تیم پشتیبانی یاربار هم‌اکنون آماده پاسخگویی و مشاوره رایگان به شماست.</p>
                </div>
            </div>
            <a href="<?php echo esc_url( $phone_link ); ?>" class="callout-btn">
                <span>تماس مستقیم با کارشناسان</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
        </div>

    </div>
</section>
