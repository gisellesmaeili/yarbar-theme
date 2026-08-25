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

// Fallback services in case no CPT posts have been published yet
$yarbar_fallback_services = array(
    array(
        'title'       => 'اسباب‌کشی تخصصی منازل',
        'slug'        => 'home-moving',
        'image'       => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
        'alt'         => 'اسباب‌کشی تخصصی منازل',
        'tag'         => 'پرفروش‌ترین',
        'tag_accent'  => false,
        'description' => 'جابه‌جایی کامل وسایل منزل با ناوگان مجهز، چیدمان مبلمان و تضمین ۱۰۰٪ عدم آسیب به لوازم.',
    ),
    array(
        'title'       => 'حمل بار سنگین و حساس',
        'slug'        => 'heavy-goods',
        'image'       => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
        'alt'         => 'حمل بار سنگین و حساس',
        'tag'         => 'تجهیزات تخصصی',
        'tag_accent'  => true,
        'description' => 'انتقال تخصصی وسایل فوق‌سنگین مانند یخچال ساید، گاوصندوق و تجهیزات پزشکی با تسمه‌های هیدرولیک.',
    ),
    array(
        'title'       => 'بسته‌بندی با تجهیزات مدرن',
        'slug'        => 'packing',
        'image'       => 'https://images.unsplash.com/photo-1607227063002-677dc5fdf96f?auto=format&fit=crop&w=800&q=80',
        'alt'         => 'بسته‌بندی با تجهیزات مدرن',
        'tag'         => 'کارتن ۵ لایه',
        'tag_accent'  => false,
        'description' => 'پوشش کامل وسایل با بابل‌رپ، سلفون‌های ۵۰ میکرون و کارتن‌های حجیم جهت جلوگیری از حتی یک خط و خش.',
    ),
    array(
        'title'       => 'باربری بین‌شهری',
        'slug'        => 'intercity-moving',
        'image'       => 'https://images.unsplash.com/photo-1519003722824-194d4455a60c?auto=format&fit=crop&w=800&q=80',
        'alt'         => 'حمل بار بین‌شهری',
        'tag'         => 'بیمه تا ۵۰۰ میلیون',
        'tag_accent'  => true,
        'description' => 'ارسال ایمن بار به تمامی استان‌های کشور با ترانزیت‌های سرپوشیده، صدور بارنامه رسمی و بیمه‌نامه معتبر.',
    ),
);
?>
<!-- سکشن کارت‌های خدمات اختصاصی -->
<section id="services" class="services-section" aria-labelledby="services-title">
    <!-- افکت نوری پس‌زمینه -->
    <div class="services-ambient-glow" aria-hidden="true"></div>

    <div class="container services-container">

        <!-- هدر سکشن -->
        <div class="services-header">
            <div class="services-badge">
                <span class="services-badge-dot" aria-hidden="true"></span>
                <span>خدمات متای یاربار</span>
            </div>
            <h2 id="services-title" class="services-title">راهکارهای تخصصی باربری و اسباب‌کشی</h2>
            <p class="services-subtitle">
                ارائه خدمات هوشمندانه جابه‌جایی با ناوگان اختصاصی، بسته‌بندی استاندارد و بیمه معتبر بار.
            </p>
        </div>

        <!-- گرید ۲ ستونه کارت‌های اختصاصی -->
        <div class="services-grid">
            <?php if ( $yarbar_services_query->have_posts() ) : ?>
                <?php
                $service_index = 0;
                while ( $yarbar_services_query->have_posts() ) :
                    $yarbar_services_query->the_post();
                    $badge_meta = get_post_meta( get_the_ID(), '_yarbar_service_badge', true );
                    $badge_text = $badge_meta ? $badge_meta : ( isset( $yarbar_default_badges[ $service_index ] ) ? $yarbar_default_badges[ $service_index ]['text'] : 'خدمات تخصصی' );
                    $is_accent  = isset( $yarbar_default_badges[ $service_index ] ) ? $yarbar_default_badges[ $service_index ]['accent'] : false;

                    // Extract concise excerpt from excerpt or full content
                    if ( has_excerpt() ) {
                        $excerpt_text = get_the_excerpt();
                    } else {
                        $excerpt_text = wp_trim_words( wp_strip_all_tags( get_the_content() ), 24, '...' );
                    }
                    ?>
                    <a href="<?php the_permalink(); ?>" class="service-card">
                        <!-- قاب تصویر شاخص -->
                        <div class="card-image-wrap">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'yarbar-card', array(
                                    'class'    => 'service-featured-img',
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                    'alt'      => esc_attr( get_the_title() ),
                                ) ); ?>
                            <?php else : ?>
                                <img 
                                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero/yarbar-truck.webp' ); ?>" 
                                    alt="<?php the_title_attribute(); ?>" 
                                    class="service-featured-img" 
                                    width="400" 
                                    height="260" 
                                    loading="lazy" 
                                    decoding="async"
                                >
                            <?php endif; ?>
                            <div class="image-overlay" aria-hidden="true"></div>
                            <?php if ( ! empty( $badge_text ) ) : ?>
                                <span class="card-tag<?php echo $is_accent ? ' tag-accent' : ''; ?>">
                                    <?php echo esc_html( $badge_text ); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- محتوای کارت -->
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
            <?php else : ?>
                <?php foreach ( $yarbar_fallback_services as $service ) : ?>
                    <a href="<?php echo esc_url( home_url( '/services/' . $service['slug'] . '/' ) ); ?>" class="service-card">
                        <div class="card-image-wrap">
                            <img 
                                src="<?php echo esc_url( $service['image'] ); ?>" 
                                alt="<?php echo esc_attr( $service['alt'] ); ?>" 
                                class="service-featured-img" 
                                width="400" 
                                height="260" 
                                loading="lazy" 
                                decoding="async"
                            >
                            <div class="image-overlay" aria-hidden="true"></div>
                            <span class="card-tag<?php echo $service['tag_accent'] ? ' tag-accent' : ''; ?>">
                                <?php echo esc_html( $service['tag'] ); ?>
                            </span>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <h3 class="service-title"><?php echo esc_html( $service['title'] ); ?></h3>
                                <p class="service-desc">
                                    <?php echo esc_html( $service['description'] ); ?>
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
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>
