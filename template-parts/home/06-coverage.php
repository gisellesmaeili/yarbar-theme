<?php
/**
 * Nationwide Coverage & Interactive Map Section
 *
 * Dynamic query of 'location' Custom Post Type (up to 6 items)
 * combined with an interactive vector map of Iran and archive CTA.
 *
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$yarbar_locations_query = new WP_Query( array(
        'post_type'      => 'location',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
) );

$yarbar_locations_archive_url = yarbar_archive_url( 'location', '/locations/' );
?>
<!-- Nationwide Coverage Section (Interactive Map + Location CPT) -->
<section id="locations" class="locations-map-section" aria-labelledby="locations-title" data-animate-when-visible>
    <div class="container locations-map-container">

        <?php
        $coverage_eyebrow = yarbar_option( 'coverage_eyebrow', 'مناطق تحت پوشش' );
        $coverage_title   = yarbar_option( 'coverage_title', 'هرجا بار دارید، یاربار کنار شماست' );
        $coverage_desc    = yarbar_option( 'coverage_desc', 'یاربار خدمات حمل بار را در شهرها و مناطق مختلف ارائه می‌دهد. مبدأ و مقصدتان را انتخاب کنید و با خیال راحت، جابه‌جایی بار را به ما بسپارید.' );
        $coverage_tag     = yarbar_validate_heading_tag( yarbar_option( 'coverage_tag', 'h2' ), 'h2' );
        ?>
        <!-- Section Header -->
        <div class="locations-map-header">
            <?php if ( ! empty( $coverage_eyebrow ) ) : ?>
                <div class="badge badge--orange">
                    <span class="badge-dot" aria-hidden="true"></span>
                    <span><?php echo wp_kses_post( $coverage_eyebrow ); ?></span>
                </div>
            <?php endif; ?>
            <<?php echo $coverage_tag; ?> id="locations-title" class="locations-title"><?php echo wp_kses_post( $coverage_title ); ?></<?php echo $coverage_tag; ?>>
        <?php if ( ! empty( $coverage_desc ) ) : ?>
            <p class="locations-subtitle">
                <?php echo wp_kses_post( $coverage_desc ); ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- Split-Screen Layout -->
    <div class="locations-split-wrapper">

        <!-- Right Column: Interactive Vector Map & Live Pins -->
        <div class="map-column">
            <div class="map-card-wrapper">
                <div class="map-graphic-container">
                    <!-- Lightweight Simplified Iran Map Vector -->
                    <svg class="iran-map-svg" viewBox="0 0 600 500" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path class="map-border" d="M120,80 L200,50 L280,60 L380,100 L480,90 L540,160 L510,260 L450,320 L380,420 L280,450 L180,410 L100,320 L60,220 L70,140 Z" fill="rgba(255, 255, 255, 0.03)" stroke="rgba(229, 234, 240, 0.15)" stroke-width="2"/>
                        <!-- Subtle Grid Lines -->
                        <path class="map-grid-line" d="M100,100 L500,400" stroke="rgba(255, 107, 26, 0.08)" stroke-width="1" stroke-dasharray="4 4"/>
                        <path class="map-grid-line" d="M100,350 L500,150" stroke="rgba(255, 107, 26, 0.08)" stroke-width="1" stroke-dasharray="4 4"/>
                    </svg>

                    <!-- Interactive Location Pins with Pulse Animation -->
                    <!-- North -->
                    <div class="map-pin-item pin-north" style="top: 18%; right: 40%;" tabindex="0" role="button" aria-label="پوشش استان‌های شمال: ۴۰+ خودروی آماده">
                        <span class="pin-pulse" aria-hidden="true"></span>
                        <span class="pin-point" aria-hidden="true"></span>
                        <div class="pin-tooltip">
                            <strong>استان‌های شمال</strong>
                            <span>۴۰+ خودروی آماده</span>
                        </div>
                    </div>

                    <!-- Karaj & Alborz -->
                    <div class="map-pin-item pin-karaj" style="top: 27%; right: 44%;" tabindex="0" role="button" aria-label="پوشش استان البرز: ۴۵+ خودروی آماده">
                        <span class="pin-pulse" aria-hidden="true"></span>
                        <span class="pin-point" aria-hidden="true"></span>
                        <div class="pin-tooltip">
                            <strong>استان البرز (کرج)</strong>
                            <span>۴۵+ خودروی آماده</span>
                        </div>
                    </div>

                    <!-- Tehran & Suburbs -->
                    <div class="map-pin-item pin-tehran" style="top: 28%; right: 38%;" tabindex="0" role="button" aria-label="پوشش تهران و حومه: ۱۵۰+ خودروی آماده">
                        <span class="pin-pulse" aria-hidden="true"></span>
                        <span class="pin-point" aria-hidden="true"></span>
                        <div class="pin-tooltip">
                            <strong>تهران و حومه</strong>
                            <span>۱۵۰+ خودروی آماده</span>
                        </div>
                    </div>

                    <!-- Tabriz & Northwest -->
                    <div class="map-pin-item pin-tabriz" style="top: 16%; right: 20%;" tabindex="0" role="button" aria-label="پوشش آذربایجان و تبریز: ۳۵+ خودروی آماده">
                        <span class="pin-pulse" aria-hidden="true"></span>
                        <span class="pin-point" aria-hidden="true"></span>
                        <div class="pin-tooltip">
                            <strong>تبریز و شمال غرب</strong>
                            <span>۳۵+ خودروی آماده</span>
                        </div>
                    </div>

                    <!-- Isfahan -->
                    <div class="map-pin-item pin-isfahan" style="top: 52%; right: 42%;" tabindex="0" role="button" aria-label="پوشش اصفهان: ۳۰+ خودروی آماده">
                        <span class="pin-pulse" aria-hidden="true"></span>
                        <span class="pin-point" aria-hidden="true"></span>
                        <div class="pin-tooltip">
                            <strong>اصفهان</strong>
                            <span>۳۰+ خودروی آماده</span>
                        </div>
                    </div>

                    <!-- Shiraz -->
                    <div class="map-pin-item pin-shiraz" style="top: 70%; right: 46%;" tabindex="0" role="button" aria-label="پوشش شیراز: ۲۵+ خودروی آماده">
                        <span class="pin-pulse" aria-hidden="true"></span>
                        <span class="pin-point" aria-hidden="true"></span>
                        <div class="pin-tooltip">
                            <strong>شیراز</strong>
                            <span>۲۵+ خودروی آماده</span>
                        </div>
                    </div>

                </div>

                <div class="map-footer-info">
                        <span class="info-tag">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            میانگین زمان تخصیص ماشین: زیر ۲۰ دقیقه
                        </span>
                </div>
            </div>
        </div>

        <!-- Left Column: Location CPT Cards Feed -->
        <div class="locations-feed-column">
            <div class="locations-grid">
                <?php if ( $yarbar_locations_query->have_posts() ) : ?>
                    <?php
                    while ( $yarbar_locations_query->have_posts() ) :
                        $yarbar_locations_query->the_post();
                        if ( has_excerpt() ) {
                            $loc_excerpt = get_the_excerpt();
                        } else {
                            $loc_excerpt = wp_trim_words( wp_strip_all_tags( get_the_content() ), 18, '...' );
                        }
                        ?>
                        <a href="<?php the_permalink(); ?>" class="location-post-card">
                            <h3 class="location-post-title"><?php the_title(); ?></h3>
                            <p class="location-post-excerpt">
                                <?php echo esc_html( $loc_excerpt ); ?>
                            </p>
                            <div class="post-card-footer">
                                <span class="read-more">مشاهده جزئیات و تعرفه</span>
                                <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                                </svg>
                            </div>
                        </a>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                <?php endif; ?>
            </div>

            <!-- Archive CTA for All Covered Locations -->
            <div class="locations-cta">
                <a href="<?php echo esc_url( $yarbar_locations_archive_url ); ?>" class="btn btn--secondary">
                    <span>نمایش تمامی مناطق تحت پوشش</span>
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                    </svg>
                </a>
            </div>
        </div>

    </div>

    </div>
</section>