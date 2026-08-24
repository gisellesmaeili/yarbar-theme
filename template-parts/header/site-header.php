<header class="site-header">
    <div class="container site-header__inner">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo">
            <span class="site-header__logo-white">یار</span><span class="site-header__logo-orange">بار.</span>
        </a>

        <nav class="site-header__nav" aria-label="<?php esc_attr_e( 'منوی اصلی', 'yarbar' ); ?>">
            <ul class="site-header__menu">
                <li><a href="#calculator">محاسبه هزینه</a></li>
                <li><a href="#services">خدمات</a></li>
                <li><a href="#about">درباره یاربار</a></li>
                <li><a href="#locations">پوشش مناطق</a></li>
                <li><a href="#faq">سوالات متداول</a></li>
                <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">وبلاگ</a></li>
            </ul>
        </nav>
        <a href="<?php echo yarbar_phone_link(); ?>" class="btn btn--primary btn--small"><?php echo esc_html( yarbar_option( 'phone_primary' ) ); ?>تماس فوری: </a>
    </div>
</header>

<a href="<?php echo yarbar_phone_link(); ?>" class="mobile-call-bar">
    <span class="mobile-call-bar__icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
        </svg>
    </span>
    تماس مستقیم با یاربار
</a>