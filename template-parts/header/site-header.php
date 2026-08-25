<div id="yarbar-scroll-sentinel"></div>

<header class="site-header">
    <div class="container site-header__inner">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo">
            <span class="site-header__logo-white">یار</span><span class="site-header__logo-orange">بار</span><span class="site-header__logo-dot" aria-hidden="true"></span>
        </a>

        <nav class="site-header__nav" aria-label="<?php esc_attr_e( 'منوی اصلی', 'yarbar' ); ?>">
            <ul class="site-header__menu">
                <li><a href="#calculator">محاسبه هزینه</a></li>
                <li><a href="#services">خدمات</a></li>
                <li><a href="#about">تعهد یاربار</a></li>
                <li><a href="#locations">مناطق پوشش</a></li>
                <li><a href="#faq">سوالات متداول</a></li>
                <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">وبلاگ</a></li>
            </ul>
        </nav>

        <a href="<?php echo yarbar_phone_link(); ?>" class="site-header__cta">
            <span class="site-header__cta-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            </span>
            <span class="site-header__cta-number" dir="ltr"><?php echo esc_html( yarbar_option( 'phone_primary' ) ); ?></span>
        </a>

        <button type="button" class="site-header__hamburger" aria-expanded="false" aria-controls="yarbar-mobile-drawer" aria-label="<?php esc_attr_e( 'باز کردن منو', 'yarbar' ); ?>">
            <span></span><span></span><span></span>
        </button>

        <a href="<?php echo yarbar_phone_link(); ?>" class="site-header__mobile-call" aria-label="<?php esc_attr_e( 'تماس تلفنی', 'yarbar' ); ?>">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
        </a>
    </div>
</header>

<div id="yarbar-mobile-drawer" class="mobile-drawer" aria-hidden="true">
    <button type="button" class="mobile-drawer__close" aria-label="<?php esc_attr_e( 'بستن منو', 'yarbar' ); ?>">✕</button>
    <ul class="mobile-drawer__menu">
        <li><a href="#calculator">محاسبه هزینه</a></li>
        <li><a href="#services">خدمات</a></li>
        <li><a href="#about">تعهد یاربار</a></li>
        <li><a href="#locations">مناطق پوشش</a></li>
        <li><a href="#faq">سوالات متداول</a></li>
        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">وبلاگ</a></li>
    </ul>
</div>

<div class="mobile-call-bar">
    <a href="<?php echo yarbar_phone_link(); ?>" class="mobile-call-bar__btn">
        <span class="mobile-call-bar__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
        </span>
        تماس مستقیم با یاربار (پاسخگویی فوری)
    </a>
</div>