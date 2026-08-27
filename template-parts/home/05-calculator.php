<?php
/**
 * Calculator Section Template Part
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!-- Interactive Cost Estimator Section -->
<section id="calculator" class="calculator-section" aria-labelledby="calc-title">
    <div class="container calculator-container">

<?php
$calc_eyebrow = yarbar_option( 'calculator_eyebrow', 'محاسبه هوشمند هزینه' );
$calc_title   = yarbar_option( 'calculator_title', 'هزینه حمل بارتان را همین حالا محاسبه کنید' );
$calc_tag     = yarbar_validate_heading_tag( yarbar_option( 'calculator_tag', 'h2' ), 'h2' );
?>
        <!-- Section Header -->
        <div class="calculator-header">
            <?php if ( ! empty( $calc_eyebrow ) ) : ?>
                <span class="badge badge--orange"><?php echo wp_kses_post( $calc_eyebrow ); ?></span>
            <?php endif; ?>
            <<?php echo $calc_tag; ?> id="calc-title" class="calc-title"><?php echo wp_kses_post( $calc_title ); ?></<?php echo $calc_tag; ?>>
        </div>

        <!-- Main Calculator Card -->
        <div class="calc-card">

            <!-- Step 1: Origin & Destination Route Selection -->
            <div class="calc-step">
                <label class="step-label" for="origin">
                    <span class="step-num" aria-hidden="true">۱</span>
                    مبدأ و مقصد بار را مشخص کنید
                </label>

                <div class="grid-2-cols">
                    <div class="select-wrapper">
                        <svg class="select-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <circle cx="12" cy="11" r="3" stroke-width="2"/>
                        </svg>
                        <select class="custom-select" id="origin" aria-label="شهر یا منطقه مبدأ">
                            <option value="" disabled selected>مبدأ را انتخاب کنید</option>
                            <option value="tehran-north">تهران (شمال و غرب)</option>
                            <option value="tehran-center">تهران (مرکز و جنوب)</option>
                            <option value="karaj">کرج و حومه</option>
                            <option value="intercity">حمل بار بین‌شهری</option>
                        </select>
                    </div>

                    <div class="select-wrapper">
                        <svg class="select-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <circle cx="12" cy="11" r="3" stroke-width="2"/>
                        </svg>
                        <select class="custom-select" id="destination" aria-label="شهر یا منطقه مقصد">
                            <option value="" disabled selected>مقصد را انتخاب کنید</option>
                            <option value="tehran-north">تهران (شمال و غرب)</option>
                            <option value="tehran-center">تهران (مرکز و جنوب)</option>
                            <option value="karaj">کرج و حومه</option>
                            <option value="intercity">حمل بار بین‌شهری</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Step 2: Vehicle Type Selection -->
            <div class="calc-step">
                <span class="step-label" id="vehicle-label">
                    <span class="step-num" aria-hidden="true">۲</span>
                    چه خودرویی برای حمل بار نیاز دارید؟
                </span>

                <div class="vehicle-grid" role="radiogroup" aria-labelledby="vehicle-label">
                    <label class="vehicle-card">
                        <input type="radio" name="vehicle" value="truck" checked>
                        <div class="vehicle-content">
                            <svg class="vehicle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M1 3h15v13H1zM16 8h4l3 3v5h-7V8zM5.5 18.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM18.5 18.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/>
                            </svg>
                            <span class="vehicle-name">خاور مسقف</span>
                            <span class="vehicle-desc">مناسب برای بارهای حجیم و اسباب‌کشی کامل</span>
                        </div>
                    </label>

                    <label class="vehicle-card">
                        <input type="radio" name="vehicle" value="khavar">
                        <div class="vehicle-content">
                            <svg class="vehicle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M1 5h14v11H1zM15 9h5l3 3v3h-8V9zM4.5 18a2 2 0 100-4 2 2 0 000 4zM17.5 18a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                            <span class="vehicle-name">خاور روباز</span>
                            <span class="vehicle-desc">مناسب برای بارهای حجیم و کالاهای بزرگ</span>
                        </div>
                    </label>

                    <label class="vehicle-card">
                        <input type="radio" name="vehicle" value="nissan">
                        <div class="vehicle-content">
                            <svg class="vehicle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7h11v9H3zM14 10h4l3 2v4h-7v-6zM6 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM17 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                            </svg>
                            <span class="vehicle-name">نیسان</span>
                            <span class="vehicle-desc">مناسب برای بارهای متوسط و جابه‌جایی‌های روزمره</span>
                        </div>
                    </label>

                    <label class="vehicle-card">
                        <input type="radio" name="vehicle" value="pickup">
                        <div class="vehicle-content">
                            <svg class="vehicle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9h9v7H3zM12 12h4l3 2v3h-7v-5zM5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM15 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                            </svg>
                            <span class="vehicle-name">وانت</span>
                            <span class="vehicle-desc">مناسب برای بارهای سبک و کم‌حجم</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Step 3: Additional Services & Helpers -->
            <div class="calc-step">
                <span class="step-label">
                    <span class="step-num" aria-hidden="true">۳</span>
                    خدمات مورد نیازتان را انتخاب کنید
                </span>

                <div class="options-grid">
                    <!-- Worker Count Stepper -->
                    <div class="option-box">
                        <span class="option-title">تعداد کارگر تخصصی</span>
                        <div class="stepper">
                            <button type="button" class="step-btn" data-stepper="workers" data-dir="-1" aria-label="کاهش تعداد کارگر">−</button>
                            <span class="step-value" data-value="workers">۳ نفر</span>
                            <button type="button" class="step-btn" data-stepper="workers" data-dir="1" aria-label="افزایش تعداد کارگر">+</button>
                        </div>
                    </div>

                    <!-- Floor Count Stepper -->
                    <div class="option-box">
                        <span class="option-title">تعداد طبقات (مجموع)</span>
                        <div class="stepper">
                            <button type="button" class="step-btn" data-stepper="floors" data-dir="-1" aria-label="کاهش تعداد طبقات">−</button>
                            <span class="step-value" data-value="floors">۲ طبقه</span>
                            <button type="button" class="step-btn" data-stepper="floors" data-dir="1" aria-label="افزایش تعداد طبقات">+</button>
                        </div>
                    </div>

                    <!-- Professional Packaging Toggle Switch -->
                    <div class="option-box">
                        <span class="option-title">خدمات کامل بسته‌بندی</span>
                        <label class="toggle-switch" for="calc-packaging">
                            <input type="checkbox" id="calc-packaging" aria-label="خدمات کامل بسته‌بندی">
                            <span class="slider" aria-hidden="true"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Price Output Bar & Action Buttons -->
            <div class="calc-result-bar">
                <div class="result-price-area">
                    <span class="price-label">هزینه تقریبی حمل بار :</span>
                    <div class="price-display" aria-live="polite">
                        <span class="price-number" id="finalPrice">۲,۴۵۰,۰۰۰</span>
                        <span class="price-unit">تومان</span>
                    </div>
                </div>

                <div class="result-actions">
                    <button type="button" class="btn btn-calc" id="calculateBtn">
                        محاسبه مجدد
                    </button>

                    <a href="<?php echo yarbar_phone_link(); ?>" class="btn btn-submit-order">
                        <svg class="phone-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>ثبت فاکتور و تماس</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>