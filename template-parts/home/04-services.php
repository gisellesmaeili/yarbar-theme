<?php
/**
 * Services Section Template Part (Showcase with Featured Images)
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$yarbar_services = array(
    array(
        'title'       => 'اسباب‌کشی تخصصی منازل',
        'slug'        => 'home-moving',
        'image'       => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
        'alt'         => 'اسباب‌کشی تخصصی منازل',
        'tag'         => 'پرفروش‌ترین',
        'tag_accent'  => false,
        'features'    => array( 'کامیون موکت‌شده', 'کارگر حرفه‌ای' ),
        'description' => 'جابه‌جایی کامل وسایل منزل با ناوگان مجهز، چیدمان مبلمان و تضمین ۱۰۰٪ عدم آسیب به لوازم.',
    ),
    array(
        'title'       => 'حمل بار سنگین و حساس',
        'slug'        => 'heavy-goods',
        'image'       => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
        'alt'         => 'حمل بار سنگین و حساس',
        'tag'         => 'تجهیزات تخصصی',
        'tag_accent'  => true,
        'features'    => array( 'حمل پیانو و گاوصندوق', 'جک مهارکننده' ),
        'description' => 'انتقال تخصصی وسایل فوق‌سنگین مانند یخچال ساید، گاوصندوق و تجهیزات پزشکی با تسمه‌های هیدرولیک.',
    ),
    array(
        'title'       => 'بسته‌بندی با تجهیزات مدرن',
        'slug'        => 'packing',
        'image'       => 'https://images.unsplash.com/photo-1607227063002-677dc5fdf96f?auto=format&fit=crop&w=800&q=80',
        'alt'         => 'بسته‌بندی با تجهیزات مدرن',
        'tag'         => 'کارتن ۵ لایه',
        'tag_accent'  => false,
        'features'    => array( 'بابل‌رپ ضخیم', 'وکیوم ضدضربه' ),
        'description' => 'پوشش کامل وسایل با بابل‌رپ، سلفون‌های ۵۰ میکرون و کارتن‌های حجیم جهت جلوگیری از حتی یک خط و خش.',
    ),
    array(
        'title'       => 'باربری بین‌شهری',
        'slug'        => 'intercity-moving',
        'image'       => 'https://images.unsplash.com/photo-1519003722824-194d4455a60c?auto=format&fit=crop&w=800&q=80',
        'alt'         => 'حمل بار بین‌شهری',
        'tag'         => 'بیمه تا ۵۰۰ میلیون',
        'tag_accent'  => true,
        'features'    => array( 'بارنامه دولتی', 'ردیابی GPS' ),
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
            <?php foreach ( $yarbar_services as $service ) : ?>
                <a href="<?php echo esc_url( home_url( '/services/' . $service['slug'] . '/' ) ); ?>" class="service-card">
                    <!-- قاب تصویر شاخص -->
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

                    <!-- محتوای کارت -->
                    <div class="card-content">
                        <div class="card-meta">
                            <?php foreach ( $service['features'] as $feature ) : ?>
                                <span class="meta-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <?php echo esc_html( $feature ); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <h3 class="service-title"><?php echo esc_html( $service['title'] ); ?></h3>
                        <p class="service-desc">
                            <?php echo esc_html( $service['description'] ); ?>
                        </p>

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
        </div>

    </div>
</section>
