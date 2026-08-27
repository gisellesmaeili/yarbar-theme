<?php
/**
 * FAQ Section Template Part (Frequently Asked Questions)
 * 
 * Clean, high-performance accordion component using native <details> and <summary>
 * with support callout box.
 * 
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$phone_link = yarbar_phone_link( 'phone_primary', '۰۲۱-۹۱۰۰۰۰۰۰' );
?>
<!-- سکشن سوالات متداول (FAQ) -->
<section id="faq" class="faq-section" aria-labelledby="faq-title">
    <div class="container faq-container">

        <!-- هدر سکشن -->
        <div class="faq-header">
            <div class="badge badge--orange">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="16" height="16" aria-hidden="true">
                    <circle cx="12" cy="12" stroke-width="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3m.08 4h.01"/>
                </svg>
                <span>سؤالات متداول</span>
            </div>
            <h2 id="faq-title" class="faq-title">پاسخ سؤالات خود را اینجا پیدا کنید</h2>
            <p class="faq-subtitle">
                پاسخ رایج‌ترین سؤالات درباره نحوه ثبت درخواست، انتخاب خودرو، هزینه حمل و خدمات یاربار را در این بخش ببینید.
            </p>
        </div>

        <!-- شبکه‌بندی دو ستونه سوالات -->
        <div class="faq-grid">

            <!-- ستون اول -->
            <div class="faq-column">

                <!-- سوال ۱ -->
                <details class="faq-card" open>
                    <summary class="faq-summary">
                        <span class="faq-question">۱. یاربار چه خدماتی در زمینه حمل بار ارائه می‌دهد؟</span>
                        <span class="faq-icon-wrapper" aria-hidden="true">
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-answer">
                        <p>
                            یاربار خدمات حمل و جابه‌جایی بار را برای نیازهای مختلف ارائه می‌دهد و بسته به نوع بار، مسیر و شرایط سرویس، گزینه مناسب حمل را پیشنهاد می‌کند. هدف یاربار ارائه خدمات سریع، مطمئن و متناسب با نیاز مشتری است.
                        </p>
                    </div>
                </details>

                <!-- سوال ۲ -->
                <details class="faq-card">
                    <summary class="faq-summary">
                        <span class="faq-question">۲. چگونه می‌توان از یاربار درخواست سرویس حمل بار کرد؟</span>
                        <span class="faq-icon-wrapper" aria-hidden="true">
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-answer">
                        <p>
                            برای ثبت درخواست سرویس می‌توانید با شماره تماس یاربار تماس بگیرید و اطلاعات مربوط به نوع بار، مبدأ، مقصد و زمان موردنظر را اعلام کنید. کارشناسان یاربار پس از بررسی اطلاعات، مراحل دریافت سرویس را راهنمایی می‌کنند.
                        </p>
                    </div>
                </details>

                <!-- سوال ۳ -->
                <details class="faq-card">
                    <summary class="faq-summary">
                        <span class="faq-question">۳. هزینه خدمات حمل بار یاربار چگونه محاسبه می‌شود؟</span>
                        <span class="faq-icon-wrapper" aria-hidden="true">
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-answer">
                        <p>
                            هزینه حمل بار بر اساس عواملی مانند مبدأ و مقصد، نوع بار، حجم یا شرایط بار و نوع سرویس موردنیاز تعیین می‌شود. برای برآورد هزینه می‌توانید از بخش <strong>محاسبه قیمت خدمات</strong> در سایت استفاده کنید یا با یاربار تماس بگیرید.
                        </p>
                    </div>
                </details>

                <!-- سوال ۴ -->
                <details class="faq-card">
                    <summary class="faq-summary">
                        <span class="faq-question">۴. یاربار در چه شهرها و مناطقی خدمات ارائه می‌دهد؟</span>
                        <span class="faq-icon-wrapper" aria-hidden="true">
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-answer">
                        <p>
                            محدوده پوشش خدمات یاربار به نوع سرویس و مسیر موردنظر بستگی دارد. برای اطلاع از امکان ارائه سرویس در شهر یا مسیر موردنظر، می‌توانید با یاربار تماس بگیرید یا محدوده خدمات را در بخش پوشش خدمات مشاهده کنید.
                        </p>
                    </div>
                </details>

            </div>

            <!-- ستون دوم -->
            <div class="faq-column">

                <!-- سوال ۵ -->
                <details class="faq-card">
                    <summary class="faq-summary">
                        <span class="faq-question">۵. آیا یاربار خدمات حمل بار شهری و بین‌شهری ارائه می‌دهد؟</span>
                        <span class="faq-icon-wrapper" aria-hidden="true">
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-answer">
                        <p>
                            بله، یاربار می‌تواند خدمات حمل بار را در مسیرهای شهری و بین‌شهری ارائه دهد. نوع سرویس بر اساس مسیر، مشخصات بار و نیاز مشتری تعیین می‌شود.
                        </p>
                    </div>
                </details>

                <!-- سوال ۶ -->
                <details class="faq-card">
                    <summary class="faq-summary">
                        <span class="faq-question">۶. برای دریافت قیمت حمل بار چه اطلاعاتی لازم است؟</span>
                        <span class="faq-icon-wrapper" aria-hidden="true">
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-answer">
                        <p>
                            برای برآورد دقیق‌تر هزینه، معمولاً اطلاعاتی مانند محل مبدأ، مقصد، نوع بار و مشخصات کلی آن مورد نیاز است. ارائه اطلاعات کامل‌تر به یاربار کمک می‌کند هزینه و شرایط سرویس را دقیق‌تر بررسی کند.
                        </p>
                    </div>
                </details>

                <!-- سوال ۷ -->
                <details class="faq-card">
                    <summary class="faq-summary">
                        <span class="faq-question">۷. مدت زمان پاسخگویی یاربار برای ثبت درخواست چقدر است؟</span>
                        <span class="faq-icon-wrapper" aria-hidden="true">
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-answer">
                        <p>
                            یاربار تلاش می‌کند درخواست‌های مشتریان را در سریع‌ترین زمان ممکن بررسی و پاسخگویی کند. زمان نهایی هماهنگی سرویس به نوع درخواست، مسیر و شرایط سرویس بستگی دارد.
                        </p>
                    </div>
                </details>

                <!-- سوال ۸ -->
                <details class="faq-card">
                    <summary class="faq-summary">
                        <span class="faq-question">۸. چرا برای حمل بار، یاربار را انتخاب کنیم؟</span>
                        <span class="faq-icon-wrapper" aria-hidden="true">
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m-7-7h14"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-answer">
                        <p>
                            یاربار با تمرکز بر <strong>سرعت پاسخگویی، ارائه خدمات مطمئن، دسترسی آسان و تجربه کاربری ساده</strong> تلاش می‌کند فرآیند درخواست حمل بار را برای مشتریان سریع‌تر و راحت‌تر کند. برای دریافت اطلاعات و هماهنگی سرویس نیز امکان تماس مستقیم با یاربار فراهم است.
                        </p>
                    </div>
                </details>

            </div>

        </div>

        <!-- باکس پشتیبانی و تعاملی پایین سکشن -->
        <div class="faq-callout-box">
            <div class="callout-info">
                <div class="callout-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12.4 2l.253 .005a6.34 6.34 0 0 1 5.235 3.166l.089 .163l.178 .039a6.33 6.33 0 0 1 4.254 3.406l.105 .228a6.334 6.334 0 0 1 -5.74 8.865l-.144 -.002l-.037 .052a5.26 5.26 0 0 1 -5.458 1.926l-.186 -.051l-3.435 2.06a1 1 0 0 1 -1.508 -.743l-.006 -.114v-2.435l-.055 -.026a3.67 3.67 0 0 1 -1.554 -1.498l-.102 -.199a3.67 3.67 0 0 1 -.312 -2.14l.038 -.21l-.116 -.092a5.8 5.8 0 0 1 -1.887 -6.025l.071 -.238a5.8 5.8 0 0 1 5.42 -4.004h.157l.15 -.165a6.33 6.33 0 0 1 4.33 -1.963zm1.6 11h-5a1 1 0 0 0 0 2h5a1 1 0 0 0 0 -2m3 -4h-10a1 1 0 1 0 0 2h10a1 1 0 0 0 0 -2" />
                    </svg>
                </div>
                <div class="callout-text">
                    <h4>هنوز پاسخ سوال خود را پیدا نکردید؟</h4>
                    <p>تیم پشتیبانی یاربار هم‌اکنون آماده پاسخگویی و مشاوره رایگان به شماست.</p>
                </div>
            </div>
            <a href="<?php echo esc_url( $phone_link ); ?>" class="callout-btn">
                <span>تماس مستقیم با کارشناسان</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
        </div>

    </div>
</section>
