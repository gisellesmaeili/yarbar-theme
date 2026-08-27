<?php
/**
 * Final Conversion Banner Template Part
 * 
 * High-energy orange banner with dynamic phone link from business settings.
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$phone_display = yarbar_option( 'support_phone', '۰۲۱-۹۱۰۰۰۰۰۰' );
$phone_link    = yarbar_phone_link( 'support_phone', '۰۲۱-۹۱۰۰۰۰۰۰' );

$cta_eyebrow   = yarbar_option( 'cta_eyebrow', '' );
$cta_title     = yarbar_option( 'cta_title', 'آماده جابه‌جایی هستید؟' );
$cta_desc      = yarbar_option( 'cta_desc', 'کافی است با ما تماس بگیرید تا مناسب‌ترین راهکار حمل را برای شما پیدا کنیم.' );
$cta_tag       = yarbar_validate_heading_tag( yarbar_option( 'cta_tag', 'h2' ), 'h2' );
?>
<!-- Final Conversion Banner Section -->
<section id="final-cta" class="final-cta-section" aria-labelledby="final-cta-title">
    <!-- Decorative Dot-Grid Pattern Overlay for Modern Tech Feel -->
    <div class="cta-pattern-overlay" aria-hidden="true"></div>

    <div class="container final-cta-container">

        <!-- Typography & Heading -->
        <div class="cta-content">
            <?php if ( ! empty( $cta_eyebrow ) ) : ?>
                <span class="badge badge--navy" style="background: rgba(10, 25, 41, 0.2); color: #fff; border: 1px solid rgba(255, 255, 255, 0.2); margin-bottom: 8px; display: inline-flex; font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 20px;"><?php echo wp_kses_post( $cta_eyebrow ); ?></span>
            <?php endif; ?>
            <<?php echo $cta_tag; ?> id="final-cta-title" class="cta-title"><?php echo wp_kses_post( $cta_title ); ?></<?php echo $cta_tag; ?>>
            <?php if ( ! empty( $cta_desc ) ) : ?>
                <p class="cta-subtitle">
                    <?php echo wp_kses_post( $cta_desc ); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Prominent Pill CTA Button -->
        <div class="cta-action">
            <a href="<?php echo esc_url( $phone_link ); ?>" class="cta-navy-btn">
                <div class="phone-icon-wrapper" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <span>تماس مستقیم: <?php echo esc_html( $phone_display ); ?></span>
            </a>
        </div>

    </div>
</section>