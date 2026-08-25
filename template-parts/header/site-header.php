<?php
/**
 * Site Header Template Part
 * 
 * Luxury, modern glassmorphic header with center navigation,
 * ringing phone CTA, mobile drawer, and bottom mobile call bar.
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

// Build anchor URLs (direct anchor on front page, full URL with hash on other pages)
$is_home = is_front_page();
$nav_items = array(
    array(
        'label' => 'صفحه اصلی',
        'href'  => $is_home ? '#hero' : home_url( '/#hero' ),
        'id'    => 'hero',
    ),
    array(
        'label' => 'تعهد یاربار',
        'href'  => $is_home ? '#about' : home_url( '/#about' ),
        'id'    => 'about',
    ),
    array(
        'label' => 'خدمات باربری',
        'href'  => $is_home ? '#services' : home_url( '/#services' ),
        'id'    => 'services',
    ),
    array(
        'label' => 'محاسبه هزینه',
        'href'  => $is_home ? '#calculator' : home_url( '/#calculator' ),
        'id'    => 'calculator',
    ),
    array(
        'label' => 'مناطق تحت پوشش',
        'href'  => $is_home ? '#locations' : home_url( '/#locations' ),
        'id'    => 'locations',
    ),
    array(
        'label' => 'مقالات وبلاگ',
        'href'  => $is_home ? '#blog-section' : home_url( '/#blog-section' ),
        'id'    => 'blog-section',
    ),
);
?>
<div id="yarbar-scroll-sentinel"></div>

<header class="site-header" id="site-header">
    <div class="container site-header__inner">

        <!-- سمت راست: لوگوتایپ یاربار همراه با نقطه تکنولوژیک -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo" aria-label="<?php esc_attr_e( 'یاربار - بازگشت به صفحه اصلی', 'yarbar' ); ?>">
            <span class="site-header__logo-text">
                <span class="logo-white">یار</span><span class="logo-orange">بار</span><span class="logo-dot" aria-hidden="true"></span>
            </span>
        </a>

        <!-- وسط: منوی دسترسی و ناوبری انکرها -->
        <nav class="site-header__nav" aria-label="<?php esc_attr_e( 'منوی اصلی', 'yarbar' ); ?>">
            <ul class="site-header__menu">
                <?php foreach ( $nav_items as $item ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $item['href'] ); ?>" data-section="<?php echo esc_attr( $item['id'] ); ?>">
                            <?php echo esc_html( $item['label'] ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <!-- سمت چپ: دکمه فراخوان تماس فوری (CTA) -->
        <div class="site-header__actions">
            <a href="<?php echo esc_url( $phone_link ); ?>" class="site-header__cta">
                <span class="site-header__cta-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </span>
                <span class="site-header__cta-label">تماس فوری:</span>
                <span class="site-header__cta-number" dir="ltr"><?php echo esc_html( $phone_display ); ?></span>
            </a>

            <!-- دکمه تماس موبایل (آیکون کوچک نارنجی) -->
            <a href="<?php echo esc_url( $phone_link ); ?>" class="site-header__mobile-call" aria-label="<?php esc_attr_e( 'تماس تلفنی سریع', 'yarbar' ); ?>">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
            </a>

            <!-- دکمه همبرگری موبایل -->
            <button type="button" class="site-header__hamburger" aria-expanded="false" aria-controls="yarbar-mobile-drawer" aria-label="<?php esc_attr_e( 'باز کردن منو', 'yarbar' ); ?>">
                <span></span><span></span><span></span>
            </button>
        </div>

    </div>
</header>

<!-- منوی کشویی تمام صفحه موبایل (Drawer) -->
<div id="yarbar-mobile-drawer" class="mobile-drawer" aria-hidden="true">
    <div class="mobile-drawer__header">
        <div class="mobile-drawer__logo">
            <span class="logo-white">یار</span><span class="logo-orange">بار</span><span class="logo-dot"></span>
        </div>
        <button type="button" class="mobile-drawer__close" aria-label="<?php esc_attr_e( 'بستن منو', 'yarbar' ); ?>">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <ul class="mobile-drawer__menu">
        <?php foreach ( $nav_items as $item ) : ?>
            <li>
                <a href="<?php echo esc_url( $item['href'] ); ?>" data-section="<?php echo esc_attr( $item['id'] ); ?>">
                    <?php echo esc_html( $item['label'] ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="mobile-drawer__footer">
        <a href="<?php echo esc_url( $phone_link ); ?>" class="mobile-drawer__cta">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <span dir="ltr"><?php echo esc_html( $phone_display ); ?></span>
        </a>
    </div>
</div>

<!-- نوار شناور پایین موبایل برای تماس سریع -->
<div class="mobile-call-bar">
    <a href="<?php echo esc_url( $phone_link ); ?>" class="mobile-call-bar__btn">
        <span class="mobile-call-bar__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
        </span>
        <span class="mobile-call-bar__text">تماس فوری:</span>
        <strong class="mobile-call-bar__num" dir="ltr"><?php echo esc_html( $phone_display ); ?></strong>
    </a>
</div>