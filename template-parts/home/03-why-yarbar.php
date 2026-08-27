<?php
/**
 * Personal Branding & Trust Statement Section Template Part
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
$about_eyebrow = yarbar_option( 'about_eyebrow', 'درباره یاربار' );
$about_title   = yarbar_option( 'about_title', 'بار شما، با خیال راحت به مقصد می‌رسد' );
$about_desc    = yarbar_option( 'about_desc', "یاربار با هدف ساده‌تر کردن فرآیند حمل‌ونقل بار شکل گرفته است؛ تا پیدا کردن وسیله مناسب، هماهنگی با راننده و جابه‌جایی بار، سریع‌تر و مطمئن‌تر انجام شود.\n\nما تلاش می‌کنیم از اولین تماس تا لحظه تحویل بار، تجربه‌ای شفاف، منظم و قابل اعتماد برای شما فراهم کنیم." );
$about_tag     = yarbar_validate_heading_tag( yarbar_option( 'about_tag', 'h2' ), 'h2' );
?>
<!-- Personal Branding & Trust Statement Section -->
<section id="about" class="trust-section" aria-labelledby="trust-title">
    <div class="container trust-container">

        <!-- Right Column: Statement, Principles & Statistics -->
        <div class="trust-content">
            <?php if ( ! empty( $about_eyebrow ) ) : ?>
                <div class="badge badge--light">
                    <svg class="badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span><?php echo wp_kses_post( $about_eyebrow ); ?></span>
                </div>
            <?php endif; ?>

            <<?php echo $about_tag; ?> id="trust-title" class="trust-title">
                <?php echo wp_kses_post( $about_title ); ?>
            </<?php echo $about_tag; ?>>

            <?php if ( ! empty( $about_desc ) ) : ?>
                <div class="trust-text">
                    <?php echo wp_kses_post( wpautop( $about_desc ) ); ?>
                </div>
            <?php endif; ?>

            <!-- 3 Key Statistics Metric Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number">+۱۲,۰۰۰</span>
                    <span class="stat-label">سفارش موفق حمل بار</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">+۵٬۰۰۰</span>
                    <span class="stat-label">راننده و ناوگان فعال</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">+۳۵۰</span>
                    <span class="stat-label">شهر تحت پوشش</span>
                </div>
            </div>
        </div>

        <!-- Left Column: Guarantee Card & Founder Signature -->
        <div class="trust-card-wrapper">
            <div class="guarantee-card">

                <div class="card-header-seal">
                    <div class="seal-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <span class="seal-text">تعهد ما به شما</span>
                </div>

                <blockquote class="guarantee-quote">
                    «در یاربار، مسئولیت ما فقط رساندن بار از مبدأ به مقصد نیست؛ اعتماد شماست که برای ما اهمیت دارد. تلاش می‌کنیم هر بار، با انتخاب درست خودرو، هماهنگی دقیق و پیگیری مستمر، با اطمینان خاطر جابه‌جا شود. این تعهدی است که از طرف یاربار، شخصاً پای آن می‌ایستم.»
                </blockquote>

                <div class="signature-block">
                    <div class="author-info">
                        <h4 class="author-name">رضا شاکری</h4>
                        <span class="author-title">موسس و مدیرعامل مجموعه یاربار</span>
                    </div>
                    <!-- Symbolic Digital Signature SVG -->
                    <div class="signature-svg" aria-label="امضای رضا شاکری">
                        <svg viewBox="0 0 150 50" fill="none" stroke="#FF6B1A" aria-hidden="true">
                            <path d="M10 35 C30 10, 40 45, 60 15 C75 5, 85 40, 110 20 C125 10, 130 35, 140 25" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                        </svg>
                    </div>
                </div>

                <div class="card-stamp" aria-hidden="true">
                    <span>تضمین قیمت و کیفیت</span>
                </div>

            </div>
        </div>

    </div>
</section>
