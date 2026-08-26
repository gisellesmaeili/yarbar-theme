<section class="hero" id="hero" data-animate-when-visible>
    <div class="hero__pattern" aria-hidden="true"></div>

    <div class="container hero__inner">
        <div class="hero__content">
            <h1 class="hero__title">
                اسباب‌کشی و باربری تخصصی
                <span class="hero__highlight hero__highlight--brand">
                    یاربار
                    <svg class="hero__accent-line" viewBox="0 0 100 10" preserveAspectRatio="none" aria-hidden="true">
                        <path d="M2 7 C 25 2, 50 9, 75 4 S 98 7, 98 7" stroke="#FF6B1A" stroke-width="3" fill="none" stroke-linecap="round"></path>
                    </svg>
                </span>
                ؛ جابه‌جایی <span class="hero__highlight">بی‌دردسر</span> در سراسر کشور
            </h1>

            <p class="hero__description">
                محاسبه دقیق هزینه پیش از سفارش + اعزام سریع کامیون‌های مجهز و نیروهای آموزش‌دیده.
            </p>

            <div class="hero__actions">
                <a href="<?php echo yarbar_phone_link(); ?>" class="btn btn--primary">
                    <span class="hero__cta-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    </span>
                    تماس و درخواست فوری
                </a>
                <a href="#calculator" class="btn btn--secondary">محاسبه آنلاین هزینه</a>
            </div>

            <ul class="hero__trust">
                <li>
                    <svg class="hero__trust-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 2 3 6v6c0 5 3.8 9 9 10 5.2-1 9-5 9-10V6l-9-4Z"></path></svg>
                    بیمه معتبر بار
                </li>
                <li>
                    <svg class="hero__trust-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 6 9 17l-5-5"></path></svg>
                    ضمانت سلامت کالا
                </li>
                <li>
                    <svg class="hero__trust-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 3"></path></svg>
                    پشتیبانی ۲۴/۷
                </li>
            </ul>
        </div>

        <div class="hero__visual">
            <div class="hero__glow" aria-hidden="true"></div>

            <svg class="hero__road" viewBox="0 0 400 500" preserveAspectRatio="none" aria-hidden="true">
                <defs>
                    <linearGradient id="yarbarRoadFade" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#132F4C" stop-opacity="0"></stop>
                        <stop offset="100%" stop-color="#132F4C" stop-opacity="0.55"></stop>
                    </linearGradient>
                </defs>
                <polygon points="330,0 400,0 260,420 180,420" fill="url(#yarbarRoadFade)"></polygon>
                <line x1="300" y1="60" x2="215" y2="400" stroke="#FF6B1A" stroke-opacity="0.4" stroke-width="4" stroke-dasharray="18 16"></line>
            </svg>

            <span class="hero__dust hero__dust--1" aria-hidden="true"></span>
            <span class="hero__dust hero__dust--2" aria-hidden="true"></span>
            <span class="hero__dust hero__dust--3" aria-hidden="true"></span>

            <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero/yarbar-truck.webp' ); ?>"
                    alt="کامیون مسقف یاربار برای حمل و نقل و اسباب‌کشی"
                    width="1486"
                    height="997"
                    class="hero__truck"
                    fetchpriority="high"
            >
        </div>
    </div>
</section>