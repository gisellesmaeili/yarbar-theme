<?php
/**
 * Services Section Template Part (Showcase with Featured Images)
 * 
 * Dynamic query of 'service' Custom Post Type with featured images,
 * auto-extracted excerpts, permalinks, and badges.
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$yarbar_services_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
) );

$yarbar_default_badges = array(
    array( 'text' => 'پرفروش‌ترین', 'accent' => false ),
    array( 'text' => 'تجهیزات تخصصی', 'accent' => true ),
    array( 'text' => 'کارتن ۵ لایه', 'accent' => false ),
    array( 'text' => 'بیمه تا ۵۰۰ میلیون', 'accent' => true ),
);
?>
<!-- Dedicated Services Showcase Section -->
<section id="services" class="services-section" aria-labelledby="services-title">
    <!-- Ambient Background Glow Effect -->
    <div class="services-ambient-glow" aria-hidden="true"></div>

    <div class="container services-container">

<?php
$services_eyebrow = yarbar_option( 'services_eyebrow', 'خدمات یاربار' );
$services_title   = yarbar_option( 'services_title', 'برای هر نوع جابه‌جایی، یک راهکار مطمئن' );
$services_desc    = yarbar_option( 'services_desc', 'از اسباب‌کشی منزل و دفتر تا حمل بارهای سنگین و بین‌شهری، یاربار خدمات حمل‌ونقل را متناسب با نیاز شما ارائه می‌دهد.' );
?>
        <!-- Section Header -->
        <div class="services-header">
            <?php if ( ! empty( $services_eyebrow ) ) : ?>
                <div class="badge badge--orange">
                    <span class="badge-dot" aria-hidden="true"></span>
                    <span><?php echo esc_html( $services_eyebrow ); ?></span>
                </div>
            <?php endif; ?>
            <h2 id="services-title" class="services-title"><?php echo esc_html( $services_title ); ?></h2>
            <?php if ( ! empty( $services_desc ) ) : ?>
                <p class="services-subtitle">
                    <?php echo esc_html( $services_desc ); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- 2-Column Dedicated Service Cards Grid -->
        <div class="services-grid">
            <?php if ( $yarbar_services_query->have_posts() ) : ?>
                <?php
                $service_index = 0;
                while ( $yarbar_services_query->have_posts() ) :
                    $yarbar_services_query->the_post();
                    $badge_meta = get_post_meta( get_the_ID(), '_yarbar_service_badge', true );
                    $badge_text = $badge_meta ? $badge_meta : ( isset( $yarbar_default_badges[ $service_index ] ) ? $yarbar_default_badges[ $service_index ]['text'] : '' );
                    $is_accent  = isset( $yarbar_default_badges[ $service_index ] ) ? $yarbar_default_badges[ $service_index ]['accent'] : false;

                    // Extract concise excerpt from excerpt or full content
                    if ( has_excerpt() ) {
                        $excerpt_text = get_the_excerpt();
                    } else {
                        $excerpt_text = wp_trim_words( wp_strip_all_tags( get_the_content() ), 24, '...' );
                    }
                    ?>
                    <a href="<?php the_permalink(); ?>" class="service-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <!-- Featured Image Frame -->
                            <div class="card-image-wrap">
                                <?php the_post_thumbnail( 'yarbar-card', array(
                                    'class'    => 'service-featured-img',
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                    'alt'      => esc_attr( get_the_title() ),
                                ) ); ?>
                                <div class="image-overlay" aria-hidden="true"></div>
                                <?php if ( ! empty( $badge_text ) ) : ?>
                                    <span class="card-tag<?php echo $is_accent ? ' tag-accent' : ''; ?>">
                                        <?php echo esc_html( $badge_text ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Card Content -->
                        <div class="card-content">
                            <div class="card-body">
                                <h3 class="service-title"><?php the_title(); ?></h3>
                                <p class="service-desc">
                                    <?php echo esc_html( $excerpt_text ); ?>
                                </p>
                            </div>

                            <div class="card-footer">
                                <span class="action-btn">
                                    مشاهده جزئیات و تعرفه
                                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                    <?php
                    $service_index++;
                endwhile;
                wp_reset_postdata();
                ?>
            <?php endif; ?>
        </div>

        <!-- Archive CTA Button for All Services -->
        <div class="services-cta">
            <a href="<?php echo esc_url( yarbar_archive_url( 'service', '/services/' ) ); ?>" class="btn btn--secondary">
                <span>مشاهده همه خدمات</span>
                <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
        </div>

    </div>
</section>
