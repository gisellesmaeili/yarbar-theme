<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the main container and all content after.
 *
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$phone_display = yarbar_option( 'phone_primary', '۰۲۱-۹۱۰۰۰۰۰۰' );
$phone_link    = yarbar_phone_link( 'phone_primary', '۰۲۱-۹۱۰۰۰۰۰۰' );

$business_address = yarbar_option( 'address', 'تهران، خیابان شریعتی، بالاتر از میرداماد، پلاک ۱۲۴، واحد ۳' );

$services_archive_url  = yarbar_archive_url( 'service', '/services/' );
$locations_archive_url = yarbar_archive_url( 'location', '/locations/' );

$blog_archive_url = yarbar_blog_archive_url();

// Fetch real blog categories (excluding uncategorized)
$default_cat_id = (int) get_option( 'default_category' );
$exclude_cats   = array();
if ( $default_cat_id ) {
    $exclude_cats[] = $default_cat_id;
}
$uncat_obj = get_category_by_slug( 'uncategorized' );
if ( $uncat_obj && ! in_array( $uncat_obj->term_id, $exclude_cats, true ) ) {
    $exclude_cats[] = $uncat_obj->term_id;
}

$footer_categories = get_categories( array(
    'orderby'    => 'count',
    'order'      => 'DESC',
    'number'     => 5,
    'hide_empty' => false,
    'exclude'    => $exclude_cats,
) );

$map_img_path = get_template_directory_uri() . '/assets/images/footer/map-location.webp';
$map_link_url = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $business_address );
?>
<!-- فوتر اصلی سایت (Footer & SEO Links) -->
<footer id="main-footer" class="site-footer">
    <div class="container footer-container">

        <!-- شبکه‌بندی اصلی فوتر (۴ ستون) -->
        <div class="footer-grid">

            <!-- ستون ۱: درباره شرکت و لوگو -->
            <div class="footer-col col-about">
                <div class="footer-logo">
                    <span class="logo-text">یار<span>بار</span></span>
                </div>
                <p class="about-text">
                    سامانه هوشمند باربری و حمل اثاثیه منزل در سراسر ایران. ارائه خدمات تخصصی با کامیون‌های موکت‌شده، کارگران آموزش‌دیده، بارنامه دولتی و بیمه‌نامه معتبر.
                </p>

                <div class="footer-trust-badges">
                    <span class="badge-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        تضمین سلامت کالا
                    </span>
                    <span class="badge-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        پشتیبانی ۲۴ ساعته
                    </span>
                </div>
            </div>

            <!-- ستون ۲: لینک‌های سریع -->
            <div class="footer-col">
                <h4 class="footer-heading">لینک‌های سریع</h4>
                <ul class="footer-links">
                    <li>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            صفحه اصلی
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( $services_archive_url ); ?>">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            خدمات باربری
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( $locations_archive_url ); ?>">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            مناطق تحت پوشش
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( $blog_archive_url ); ?>">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            مقالات وبلاگ
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ستون ۳: دسته‌بندی نوشته‌ها -->
            <div class="footer-col">
                <h4 class="footer-heading">دسته‌بندی نوشته‌ها</h4>
                <ul class="footer-links">
                    <?php if ( ! empty( $footer_categories ) ) : ?>
                        <?php foreach ( $footer_categories as $fcat ) : ?>
                            <li>
                                <a href="<?php echo esc_url( get_category_link( $fcat->term_id ) ); ?>">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    <?php echo esc_html( $fcat->name ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>
                            <a href="<?php echo esc_url( $blog_archive_url ); ?>">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                مقالات و راهنماهای اسباب‌کشی
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- ستون ۴: لوکیشن و شماره تماس -->
            <div class="footer-col col-contact">
                <h4 class="footer-heading">ارتباط با مرکز تماس</h4>

                <!-- شماره تماس برجسته -->
                <a href="<?php echo esc_url( $phone_link ); ?>" class="phone-box">
                    <div class="phone-icon-wrapper" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div class="phone-info">
                        <span class="phone-label">تلفن پشتیبانی و مشاوره:</span>
                        <strong class="phone-number"><?php echo esc_html( $phone_display ); ?></strong>
                    </div>
                </a>

                <!-- آدرس متنی -->
                <div class="address-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span><?php echo esc_html( $business_address ); ?></span>
                </div>

                <!-- تصویر نقشه لوکیشن -->
                <a href="<?php echo esc_url( $map_link_url ); ?>" target="_blank" rel="noopener noreferrer" class="map-preview-card" aria-label="<?php esc_attr_e( 'مسیریابی دفتر مرکزی روی نقشه', 'yarbar' ); ?>">
                    <img 
                        src="<?php echo esc_url( $map_img_path ); ?>" 
                        alt="<?php esc_attr_e( 'نقشه لوکیشن دفتر مرکزی یاربار', 'yarbar' ); ?>" 
                        width="500"
                        height="100"
                        class="map-img" 
                        loading="lazy" 
                        decoding="async"
                    >
                    <span class="map-overlay-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        مسیریابی با گوگل مپ
                    </span>
                </a>

            </div>

        </div>

        <!-- خط جداکننده انتهایی -->
        <div class="footer-divider"></div>

        <!-- بخش حقوق و کپی‌رایت -->
        <div class="footer-bottom">
            <span><a href="https://github.com/gisellesmaeili" target="_blank" rel="nofollow noopener">Designed and Developed by Qazal Esmaeili</a></span>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
