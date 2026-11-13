<?php
$default_hero_title = "یـــار \n<span class=\"hero__highlight\">\n    بار\n</span> <br>\nحمل مطمئن بار";
$hero_title         = yarbar_option( 'hero_h1', $default_hero_title );
$hero_tag           = yarbar_validate_heading_tag( yarbar_option( 'hero_tag', 'h1' ), 'h1' );
?>
<section class="hero" id="hero" data-animate-when-visible>
    <div class="hero__pattern" aria-hidden="true"></div>

    <div class="container hero__inner">
        <div class="hero__content">
            <<?php echo $hero_tag; ?> class="hero__title">
            <?php echo wp_kses_post( $hero_title ); ?>
        </<?php echo $hero_tag; ?>>

        <p class="hero__description">
            از جابه‌جایی‌های کوچک تا اسباب‌کشی کامل، بار شما را مطمئن و به‌موقع به مقصد می‌رسانیم.
        </p>

        <div class="hero__actions">
            <a href="<?php echo yarbar_phone_link(); ?>" class="btn btn--primary">
                    <span class="hero__cta-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
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

        <!-- Synchronized truck and 3D highway perspective stage -->
        <div class="hero__stage">
            <div class="hero__road-system" aria-hidden="true">
                <svg class="hero__road-svg" viewBox="0 0 1486 997" preserveAspectRatio="none">
                    <defs>
                        <!-- Highway asphalt gradient -->
                        <linearGradient id="yarbarAsphalt" x1="90%" y1="25%" x2="10%" y2="85%">
                            <stop offset="0%" stop-color="#0A1929" stop-opacity="0" />
                            <stop offset="25%" stop-color="#0D2238" stop-opacity="0.65" />
                            <stop offset="55%" stop-color="#132F4C" stop-opacity="0.9" />
                            <stop offset="85%" stop-color="#0E243A" stop-opacity="0.95" />
                            <stop offset="100%" stop-color="#0A1929" stop-opacity="0.4" />
                        </linearGradient>

                        <!-- Right highway shoulder glow (YarBar brand orange) -->
                        <linearGradient id="yarbarRoadEdgeOrange" x1="90%" y1="20%" x2="15%" y2="85%">
                            <stop offset="0%" stop-color="#FF6B1A" stop-opacity="0" />
                            <stop offset="35%" stop-color="#FF6B1A" stop-opacity="0.5" />
                            <stop offset="70%" stop-color="#FF8C42" stop-opacity="0.95" />
                            <stop offset="100%" stop-color="#FF6B1A" stop-opacity="0.3" />
                        </linearGradient>

                        <!-- Left highway shoulder edge (neon white) -->
                        <linearGradient id="yarbarRoadEdgeWhite" x1="85%" y1="25%" x2="10%" y2="85%">
                            <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0" />
                            <stop offset="35%" stop-color="#E2E8F0" stop-opacity="0.35" />
                            <stop offset="75%" stop-color="#FFFFFF" stop-opacity="0.8" />
                            <stop offset="100%" stop-color="#CBD5E1" stop-opacity="0.2" />
                        </linearGradient>

                        <!-- Center broken line dash gradient -->
                        <linearGradient id="yarbarCenterDash" x1="85%" y1="30%" x2="10%" y2="85%">
                            <stop offset="0%" stop-color="#FFA043" stop-opacity="0.2" />
                            <stop offset="20%" stop-color="#FFA043" stop-opacity="0.6" />
                            <stop offset="60%" stop-color="#FF6B1A" stop-opacity="1" />
                            <stop offset="100%" stop-color="#FFA043" stop-opacity="0.8" />
                        </linearGradient>

                        <!-- Headlight projection beam onto road surface -->
                        <radialGradient id="headlightBeam" cx="30%" cy="40%" r="70%">
                            <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.25" />
                            <stop offset="35%" stop-color="#FFE3D1" stop-opacity="0.12" />
                            <stop offset="70%" stop-color="#FF6B1A" stop-opacity="0.04" />
                            <stop offset="100%" stop-color="#FF6B1A" stop-opacity="0" />
                        </radialGradient>

                        <!-- Contact tire shadow blur filter -->
                        <filter id="roadTireBlur" x="-30%" y="-40%" width="160%" height="180%">
                            <feGaussianBlur stdDeviation="6" />
                        </filter>
                    </defs>

                    <!-- 1. Headlight beam projection on asphalt -->
                    <polygon class="road-headlight-projection" points="120,740 440,730 250,1320 -300,1250" fill="url(#headlightBeam)" opacity="0.9" />

                    <!-- 2. Road Bed Asphalt Polygon -->
                    <polygon class="road-bed" points="1150,720 1580,810 850,970 200,1320 -350,1280 -20,930" fill="url(#yarbarAsphalt)" />

                    <!-- 3. Pinpoint Tire Ground Contact Shadows -->
                    <g class="road-tire-shadows">
                        <!-- Trailer rear triple-axle wheels -->
                        <ellipse cx="1330" cy="850" rx="120" ry="14" fill="#040A12" opacity="0.85" filter="url(#roadTireBlur)" />
                        <!-- Center differential drive wheels -->
                        <ellipse cx="951" cy="907" rx="68" ry="13" fill="#040A12" opacity="0.9" filter="url(#roadTireBlur)" />
                        <!-- Front passenger contact point -->
                        <ellipse cx="653" cy="956" rx="52" ry="12" fill="#040A12" opacity="0.95" filter="url(#roadTireBlur)" />
                        <!-- Front driver side wheel -->
                        <ellipse cx="222" cy="924" rx="42" ry="10" fill="#040A12" opacity="0.9" filter="url(#roadTireBlur)" />
                        <!-- Chassis and underbody ambient shadow -->
                        <ellipse cx="520" cy="935" rx="320" ry="22" fill="#040A12" opacity="0.5" filter="url(#roadTireBlur)" />
                    </g>

                    <!-- 4. Highway Shoulder Lines -->
                    <path class="road-line road-line--edge-right" d="M 1580,810 C 1200,900 800,990 200,1320" stroke="url(#yarbarRoadEdgeOrange)" stroke-width="4.5" stroke-linecap="round" fill="none" />
                    <path class="road-line road-line--edge-left" d="M 1150,720 C 650,810 150,945 -350,1280" stroke="url(#yarbarRoadEdgeWhite)" stroke-width="3.5" stroke-linecap="round" fill="none" />

                    <!-- 5. Center Perspective Dashed Lane Lines -->
                    <path class="road-line road-line--center-dash" d="M 1360,765 C 950,870 500,980 -80,1300" stroke="url(#yarbarCenterDash)" stroke-width="6.5" stroke-linecap="round" fill="none" />

                    <!-- 6. Dynamic Speed Line for motion depth -->
                    <path class="road-line road-line--speed" d="M 1450,785 C 1050,885 620,1000 50,1310" stroke="#FFA043" stroke-width="2.5" stroke-linecap="round" fill="none" opacity="0.6" />
                </svg>
            </div>

            <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero/yarbar-truck.webp' ); ?>"
                    srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero/yarbar-truck-500w.webp' ); ?> 500w,
                                <?php echo esc_url( get_template_directory_uri() . '/assets/images/hero/yarbar-truck-800w.webp' ); ?> 800w,
                                <?php echo esc_url( get_template_directory_uri() . '/assets/images/hero/yarbar-truck-1200w.webp' ); ?> 1200w,
                                <?php echo esc_url( get_template_directory_uri() . '/assets/images/hero/yarbar-truck.webp' ); ?> 1486w"
                    sizes="(max-width: 640px) 480px, (max-width: 1024px) 700px, 600px"
                    alt="کامیون مسقف یاربار برای حمل و نقل و اسباب‌کشی"
                    width="1486"
                    height="997"
                    class="hero__truck"
                    fetchpriority="high"
                    decoding="async"
            >
        </div>
    </div>
    </div>
</section>