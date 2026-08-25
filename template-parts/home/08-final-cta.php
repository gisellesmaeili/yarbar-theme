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

$phone_primary = yarbar_option( 'phone_primary', '۰۲۱-۹۱۰۰۰۰۰۰' );
$phone_link    = yarbar_phone_link( 'phone_primary' );
if ( empty( $phone_link ) ) {
    $phone_link = 'tel:' . preg_replace( '/[^0-9+]/', '', $phone_primary );
}
$phone_display = ! empty( $phone_primary ) ? $phone_primary : '۰۲۱-۹۱۰۰۰۰۰۰';
?>
<!-- سکشن فراخوان نهایی تماس (Final Conversion Banner) -->
<section id="final-cta" class="final-cta-section" aria-labelledby="final-cta-title">
    <!-- بافت تزیینی نقطه-شبکه‌ای پس‌زمینه برای هویت بصری مدرن -->
    <div class="cta-pattern-overlay" aria-hidden="true"></div>

    <div class="container final-cta-container">

        <!-- متن و تایپوگرافی -->
        <div class="cta-content">
            <h2 id="final-cta-title" class="cta-title">همین حالا آماده جابه‌جایی هستید؟</h2>
            <p class="cta-subtitle">
                برای دریافت مشاوره رایگان یا ثبت فوری رزرو، کارشناسان یاربار منتظر تماس شما هستند.
            </p>
        </div>

        <!-- دکمه اقدام دایره‌ای / بیضی (CTA) -->
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