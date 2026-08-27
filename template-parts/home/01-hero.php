<section class="hero" id="hero" data-animate-when-visible>
    <div class="hero__pattern" aria-hidden="true"></div>

    <div class="container hero__inner">
        <div class="hero__content">
            <h1 class="hero__title">
                یـــار 
                <span class="hero__highlight">
                    بار
                </span> <br>
               حمل مطمئن بار
            </h1>

            <p class="hero__description">
               از جابه‌جایی‌های کوچک تا اسباب‌کشی کامل، بار شما را مطمئن و به‌موقع به مقصد می‌رسانیم.
            </p>

            <div class="hero__actions">
                <a href="<?php echo yarbar_phone_link(); ?>" class="btn btn--primary">
                    <span class="hero__cta-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    </span>
                   تماس با یاربار
                </a>
                <a href="#calculator" class="btn btn--secondary">محاسبه هوشمند هزینه بار</a>
            </div>

            <ul class="hero__trust">
                <li>
                    <svg class="hero__trust-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 2 3 6v6c0 5 3.8 9 9 10 5.2-1 9-5 9-10V6l-9-4Z"></path></svg>
                    حمل مطمئن و ایمن
                </li>
                <li>
                    <svg class="hero__trust-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 6 9 17l-5-5"></path></svg>
                    اعزام سریع و به‌موقع
                </li>
                <li>
                    <svg class="hero__trust-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 3"></path></svg>
                   مناسب‌ترین قیمت‌ها
                </li>
            </ul>
        </div>

        <div class="hero__visual">
            <div class="hero__glow" aria-hidden="true"></div>

            <!-- سیستم جاده و خطوط مسیر سه‌بعدی متناسب با زاویه و ابعاد واقعی کامیون -->
            <div class="hero__road-system" aria-hidden="true">
                <svg class="hero__road-svg" viewBox="-250 100 2000 1250" preserveAspectRatio="xMidYMid meet">
                    <defs>
                        <!-- شیب رنگ آسفالت بزرگراه -->
                        <linearGradient id="yarbarAsphalt" x1="85%" y1="30%" x2="15%" y2="85%">
                            <stop offset="0%" stop-color="#0E2338" stop-opacity="0" />
                            <stop offset="25%" stop-color="#0E243A" stop-opacity="0.5" />
                            <stop offset="55%" stop-color="#132F4C" stop-opacity="0.85" />
                            <stop offset="85%" stop-color="#0B1A2A" stop-opacity="0.95" />
                            <stop offset="100%" stop-color="#0A1929" stop-opacity="0.4" />
                        </linearGradient>

                        <!-- درخشش حاشیه جاده (نارنجی یاربار) -->
                        <linearGradient id="yarbarRoadEdgeOrange" x1="90%" y1="20%" x2="20%" y2="90%">
                            <stop offset="0%" stop-color="#FF6B1A" stop-opacity="0" />
                            <stop offset="35%" stop-color="#FF6B1A" stop-opacity="0.45" />
                            <stop offset="70%" stop-color="#FF8C42" stop-opacity="0.9" />
                            <stop offset="100%" stop-color="#FF6B1A" stop-opacity="0.2" />
                        </linearGradient>

                        <!-- خط حاشیه کناری (سفید نئونی) -->
                        <linearGradient id="yarbarRoadEdgeWhite" x1="85%" y1="25%" x2="15%" y2="85%">
                            <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0" />
                            <stop offset="40%" stop-color="#E2E8F0" stop-opacity="0.3" />
                            <stop offset="75%" stop-color="#FFFFFF" stop-opacity="0.75" />
                            <stop offset="100%" stop-color="#CBD5E1" stop-opacity="0.2" />
                        </linearGradient>

                        <!-- شیب خطوط مقطع میانی جاده -->
                        <linearGradient id="yarbarCenterDash" x1="85%" y1="30%" x2="15%" y2="85%">
                            <stop offset="0%" stop-color="#FFA043" stop-opacity="0" />
                            <stop offset="20%" stop-color="#FFA043" stop-opacity="0.5" />
                            <stop offset="60%" stop-color="#FF6B1A" stop-opacity="1" />
                            <stop offset="100%" stop-color="#FF8A3D" stop-opacity="0.8" />
                        </linearGradient>

                        <!-- تابش نور چراغ‌های جلو روی سطح جاده -->
                        <radialGradient id="headlightLeftBeam" cx="20%" cy="45%" r="70%">
                            <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.25" />
                            <stop offset="30%" stop-color="#FFE3D1" stop-opacity="0.12" />
                            <stop offset="70%" stop-color="#FF6B1A" stop-opacity="0.04" />
                            <stop offset="100%" stop-color="#FF6B1A" stop-opacity="0" />
                        </radialGradient>
                        <radialGradient id="headlightRightBeam" cx="35%" cy="45%" r="70%">
                            <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.3" />
                            <stop offset="35%" stop-color="#FFE3D1" stop-opacity="0.15" />
                            <stop offset="75%" stop-color="#FF6B1A" stop-opacity="0.05" />
                            <stop offset="100%" stop-color="#FF6B1A" stop-opacity="0" />
                        </radialGradient>

                        <!-- فیلتر محوشدگی سایه چرخ‌ها روی آسفالت -->
                        <filter id="roadTireBlur" x="-30%" y="-30%" width="160%" height="160%">
                            <feGaussianBlur stdDeviation="8" />
                        </filter>
                        <filter id="roadSoftGlow" x="-20%" y="-20%" width="140%" height="140%">
                            <feGaussianBlur stdDeviation="4" />
                        </filter>
                    </defs>

                    <!-- ۱. پرتو نور چراغ‌های جلو روی سطح جاده -->
                    <polygon class="road-headlight-projection" points="115,745 445,735 320,1260 -180,1200" fill="url(#headlightRightBeam)" opacity="0.85" />

                    <!-- ۲. بستر آسفالت بزرگراه (Road Bed Polygon) -->
                    <polygon class="road-bed" points="1100,680 1520,770 750,1030 360,1320 -230,1260 160,950" fill="url(#yarbarAsphalt)" />
                    <path class="road-sub-bed" d="M 1250,720 L 1480,765 L 680,1020 L 280,1300 L -120,1250 L 210,955 Z" fill="rgba(255, 255, 255, 0.02)" />

                    <!-- ۳. سایه‌های تماس لاستیک‌ها روی زمین (Grounded Contact Patches) -->
                    <g class="road-tire-shadows">
                        <!-- لاستیک‌های سه محور عقب تریلر -->
                        <ellipse cx="1330" cy="855" rx="140" ry="18" fill="rgba(5, 12, 22, 0.85)" filter="url(#roadTireBlur)" />
                        <!-- چرخ‌های محرک دیفرانسیل وسط -->
                        <ellipse cx="951" cy="912" rx="75" ry="16" fill="rgba(5, 12, 22, 0.9)" filter="url(#roadTireBlur)" />
                        <!-- چرخ جلو شاگرد (پایین‌ترین نقطه تماس) -->
                        <ellipse cx="653" cy="962" rx="65" ry="16" fill="rgba(5, 12, 22, 0.95)" filter="url(#roadTireBlur)" />
                        <!-- چرخ جلو راننده سمت چپ -->
                        <ellipse cx="222" cy="930" rx="55" ry="14" fill="rgba(5, 12, 22, 0.85)" filter="url(#roadTireBlur)" />
                        <!-- سایه کلی شاسی و بدنه زیرین -->
                        <ellipse cx="500" cy="940" rx="350" ry="24" fill="rgba(5, 12, 22, 0.45)" filter="url(#roadTireBlur)" />
                    </g>

                    <!-- ۴. خطوط مرزی کناره جاده (Shoulder Lines) -->
                    <path class="road-line road-line--edge-right" d="M 1510,772 C 1150,880 780,1030 350,1315" stroke="url(#yarbarRoadEdgeOrange)" stroke-width="4.5" stroke-linecap="round" fill="none" />
                    <path class="road-line road-line--edge-right-glow" d="M 1510,772 C 1150,880 780,1030 350,1315" stroke="#FF6B1A" stroke-width="2" stroke-opacity="0.8" stroke-linecap="round" fill="none" filter="url(#roadSoftGlow)" />
                    <path class="road-line road-line--edge-left" d="M 1120,685 C 650,800 180,955 -210,1255" stroke="url(#yarbarRoadEdgeWhite)" stroke-width="3.5" stroke-linecap="round" fill="none" />

                    <!-- ۵. خط‌چین‌های وسط جاده با پرسپکتیو و انیمیشن حرکت روان -->
                    <path class="road-line road-line--center-dash" d="M 1320,735 C 920,860 520,1010 60,1285" stroke="url(#yarbarCenterDash)" stroke-width="6.5" stroke-linecap="round" fill="none" />
                    <path class="road-line road-line--speed" d="M 1410,753 C 1030,870 650,1020 205,1300" stroke="#FF8A3D" stroke-width="2.5" stroke-dasharray="70 140" stroke-linecap="round" fill="none" opacity="0.6" />
                </svg>
            </div>

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