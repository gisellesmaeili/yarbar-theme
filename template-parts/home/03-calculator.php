<section class="calculator" id="calculator">
    <div class="container">
        <div class="calculator-card">
            <div class="calculator-card__header">
                <h2 class="calculator-card__title">محاسبه دقیق هزینه اسباب‌کشی</h2>
                <p class="calculator-card__subtitle">بدون هزینه‌های پنهان؛ فاکتور شفاف پیش از ثبت سفارش.</p>
            </div>

            <ol class="calc-steps" aria-hidden="true">
                <li class="calc-steps__item" data-step="1">
                    <span class="calc-steps__circle">۱</span>
                    <span class="calc-steps__label">مسیر</span>
                </li>
                <li class="calc-steps__line" data-line="1"></li>
                <li class="calc-steps__item" data-step="2">
                    <span class="calc-steps__circle">۲</span>
                    <span class="calc-steps__label">وسیله نقلیه</span>
                </li>
                <li class="calc-steps__line" data-line="2"></li>
                <li class="calc-steps__item" data-step="3">
                    <span class="calc-steps__circle">۳</span>
                    <span class="calc-steps__label">خدمات اضافه</span>
                </li>
            </ol>

            <form class="calc-form" id="yarbar-calc-form">

                <div class="calc-row calc-row--route">
                    <div class="calc-select-wrap">
                        <label class="calc-label" for="calc-origin">مبدأ</label>
                        <svg class="calc-select-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11Z"></path><circle cx="12" cy="10" r="2.5"></circle></svg>
                        <select id="calc-origin" class="calc-select" data-calc="origin">
                            <option value="">انتخاب مبدأ</option>
                            <option value="sari">ساری</option>
                            <option value="babol">بابل</option>
                            <option value="amol">آمل</option>
                            <option value="ghaemshahr">قائم‌شهر</option>
                            <option value="babolsar">بابلسر</option>
                            <option value="nowshahr">نوشهر</option>
                            <option value="chalus">چالوس</option>
                            <option value="nur">نور</option>
                            <option value="mahmudabad">محمودآباد</option>
                            <option value="fereydunkenar">فریدونکنار</option>
                            <option value="other">سایر شهرها</option>
                        </select>
                    </div>

                    <span class="calc-route-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"></path></svg>
                    </span>

                    <div class="calc-select-wrap">
                        <label class="calc-label" for="calc-destination">مقصد</label>
                        <svg class="calc-select-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11Z"></path><circle cx="12" cy="10" r="2.5"></circle></svg>
                        <select id="calc-destination" class="calc-select" data-calc="destination">
                            <option value="">انتخاب مقصد</option>
                            <option value="sari">ساری</option>
                            <option value="babol">بابل</option>
                            <option value="amol">آمل</option>
                            <option value="ghaemshahr">قائم‌شهر</option>
                            <option value="babolsar">بابلسر</option>
                            <option value="nowshahr">نوشهر</option>
                            <option value="chalus">چالوس</option>
                            <option value="nur">نور</option>
                            <option value="mahmudabad">محمودآباد</option>
                            <option value="fereydunkenar">فریدونکنار</option>
                            <option value="other">سایر شهرها</option>
                        </select>
                    </div>
                </div>

                <div class="calc-row">
                    <span class="calc-label calc-label--block">وسیله نقلیه</span>
                    <div class="calc-vehicles" role="radiogroup" aria-label="انتخاب وسیله نقلیه">

                        <label class="calc-vehicle">
                            <input type="radio" name="calc-vehicle" value="havar" data-calc="vehicle">
                            <span class="calc-vehicle__badge">پیشنهاد یاربار / پرفروش</span>
                            <svg class="calc-vehicle__icon" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M3 16V7a1 1 0 0 1 1-1h9v10"></path><path d="M13 10h5l3 3v3h-3"></path><circle cx="7.5" cy="17.5" r="1.7"></circle><circle cx="17.5" cy="17.5" r="1.7"></circle></svg>
                            <span class="calc-vehicle__name">خاور مسقف</span>
                        </label>

                        <label class="calc-vehicle">
                            <input type="radio" name="calc-vehicle" value="kamyonet" data-calc="vehicle">
                            <svg class="calc-vehicle__icon" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M3 16V9a1 1 0 0 1 1-1h8v8"></path><path d="M12 12h5l3 3v1h-3"></path><circle cx="7.5" cy="17.5" r="1.7"></circle><circle cx="17.5" cy="17.5" r="1.7"></circle></svg>
                            <span class="calc-vehicle__name">کامیونت</span>
                        </label>

                        <label class="calc-vehicle">
                            <input type="radio" name="calc-vehicle" value="nissan" data-calc="vehicle">
                            <svg class="calc-vehicle__icon" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M3 16v-3l2-4h9l3 4h2v3"></path><circle cx="7.5" cy="17" r="1.6"></circle><circle cx="16.5" cy="17" r="1.6"></circle></svg>
                            <span class="calc-vehicle__name">نیسان</span>
                        </label>

                        <label class="calc-vehicle">
                            <input type="radio" name="calc-vehicle" value="vanet" data-calc="vehicle">
                            <svg class="calc-vehicle__icon" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M3 16v-2l2-4h6v6"></path><path d="M11 10h4l3 3v3h-2"></path><circle cx="7" cy="17" r="1.6"></circle><circle cx="16" cy="17" r="1.6"></circle></svg>
                            <span class="calc-vehicle__name">وانت</span>
                        </label>

                    </div>
                </div>

                <div class="calc-row calc-row--extras">
                    <div class="calc-stepper">
                        <span class="calc-label">طبقات مبدأ</span>
                        <div class="calc-stepper__control">
                            <button type="button" class="calc-stepper__btn" data-stepper="origin-floors" data-dir="-1" aria-label="کاهش">−</button>
                            <span class="calc-stepper__value" data-value="origin-floors">۰</span>
                            <button type="button" class="calc-stepper__btn" data-stepper="origin-floors" data-dir="1" aria-label="افزایش">+</button>
                        </div>
                    </div>

                    <div class="calc-stepper">
                        <span class="calc-label">طبقات مقصد</span>
                        <div class="calc-stepper__control">
                            <button type="button" class="calc-stepper__btn" data-stepper="dest-floors" data-dir="-1" aria-label="کاهش">−</button>
                            <span class="calc-stepper__value" data-value="dest-floors">۰</span>
                            <button type="button" class="calc-stepper__btn" data-stepper="dest-floors" data-dir="1" aria-label="افزایش">+</button>
                        </div>
                    </div>

                    <div class="calc-stepper">
                        <span class="calc-label">تعداد کارگر</span>
                        <div class="calc-stepper__control">
                            <button type="button" class="calc-stepper__btn" data-stepper="workers" data-dir="-1" aria-label="کاهش">−</button>
                            <span class="calc-stepper__value" data-value="workers">۰</span>
                            <button type="button" class="calc-stepper__btn" data-stepper="workers" data-dir="1" aria-label="افزایش">+</button>
                        </div>
                    </div>
                </div>

                <div class="calc-row calc-row--toggle">
                    <label class="calc-toggle">
                        <input type="checkbox" id="calc-packaging" data-calc="packaging">
                        <span class="calc-toggle__track"><span class="calc-toggle__thumb"></span></span>
                        <span class="calc-toggle__text">
                            خدمات بسته‌بندی
                            <small>شامل فوم، کارتن ۵ لایه و سلفون</small>
                        </span>
                    </label>
                </div>

                <p class="calc-notice" id="calc-notice" role="status" aria-live="polite"></p>

                <div class="calc-result">
                    <div class="calc-result__price-side">
                        <button type="submit" class="btn btn--primary calc-result__calc-btn" id="calc-submit">
                            <span class="calc-result__btn-text">محاسبه هزینه تخمینی</span>
                            <span class="calc-result__spinner" aria-hidden="true"></span>
                        </button>

                        <div class="calc-result__price-box" aria-live="polite">
                            <span class="calc-result__price" id="calc-price">—</span>
                            <span class="calc-result__price-unit">تومان (فاکتور تخمینی)</span>
                        </div>
                    </div>

                    <div class="calc-result__booking-side">
                        <a href="<?php echo yarbar_phone_link(); ?>" class="btn calc-result__booking-btn" id="calc-booking-btn" aria-disabled="true" tabindex="-1">
                            ثبت این فاکتور با تماس فوری
                        </a>
                        <p class="calc-result__stability">رزرو تلفنی ۲۴ ساعته با تضمین ثبات قیمت</p>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>