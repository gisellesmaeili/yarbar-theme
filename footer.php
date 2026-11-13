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

$services_archive_url  = yarbar_archive_url( 'service', '/services/' );
$locations_archive_url = yarbar_archive_url( 'location', '/locations/' );

$blog_archive_url = yarbar_blog_archive_url();

$whatsapp_url  = yarbar_option( 'whatsapp_url', '' );
$telegram_url  = yarbar_option( 'telegram_url', '' );
$instagram_url = yarbar_option( 'instagram_url', '' );

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
?>
<!-- Main Site Footer (Footer & SEO Links) -->
<footer id="main-footer" class="site-footer">
    <div class="container footer-container">

        <!-- Main 4-Column Footer Grid -->
        <div class="footer-grid">

            <!-- Column 1: Brand & About -->
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

            <!-- Column 2: Quick Links -->
            <div class="footer-col">
                <h3 class="footer-heading">لینک‌های سریع</h3>
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

            <!-- Column 3: Post Categories -->
            <div class="footer-col">
                <h3 class="footer-heading">دسته‌بندی نوشته‌ها</h3>
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

            <!-- Column 4: Location & Contact Box -->
            <div class="footer-col col-contact">
                <h3 class="footer-heading">ارتباط با مرکز تماس</h3>

                <!-- Prominent Phone Call Box -->
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

                <?php if ( ! empty( $whatsapp_url ) || ! empty( $telegram_url ) || ! empty( $instagram_url ) ) : ?>
                    <!-- Social Channels -->
                    <div class="footer-social-wrapper">
                        <span class="footer-social-label">ما را در شبکه‌های اجتماعی دنبال کنید:</span>
                        <div class="footer-social-links">
                            <?php if ( ! empty( $whatsapp_url ) ) : ?>
                                <a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-btn whatsapp" aria-label="<?php esc_attr_e( 'ارتباط در واتس‌اپ', 'yarbar' ); ?>" title="واتس‌اپ">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"/>
                                        <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                            <?php if ( ! empty( $telegram_url ) ) : ?>
                                <a href="<?php echo esc_url( $telegram_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-btn telegram" aria-label="<?php esc_attr_e( 'کانال تلگرام', 'yarbar' ); ?>" title="تلگرام">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                            <?php if ( ! empty( $instagram_url ) ) : ?>
                                <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-btn instagram" aria-label="<?php esc_attr_e( 'صفحه اینستاگرام', 'yarbar' ); ?>" title="اینستاگرام">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>

        <!-- Footer Bottom Divider -->
        <div class="footer-divider"></div>

        <!-- Copyright & Credits Bar -->
        <div class="footer-bottom">
            <span><a href="https://github.com/gisellesmaeili" target="_blank" rel="nofollow noopener">Designed and Developed by Qazal Esmaeili</a></span>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
