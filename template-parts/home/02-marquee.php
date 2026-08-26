<?php
$yarbar_marquee_items = array(
    'حمل تخصصی اثاثیه منزل',
    'بیمه رایگان تمام بارها',
    'کامیون‌های مسقف و موکت‌شده',
    'پشتیبانی ۲۴ ساعته',
    'بدون هزینه‌های پنهان',
    'ارسال سریع به سراسر ایران',
);
?>
<section class="marquee" aria-label="ویژگی‌های یاربار" data-animate-when-visible>
    <div class="marquee__track">
        <div class="marquee__group">
            <?php foreach ( $yarbar_marquee_items as $item ) : ?>
                <span class="marquee__item"><?php echo esc_html( $item ); ?> <span class="marquee__dot">✦</span></span>
            <?php endforeach; ?>
        </div>
        <div class="marquee__group" aria-hidden="true">
            <?php foreach ( $yarbar_marquee_items as $item ) : ?>
                <span class="marquee__item"><?php echo esc_html( $item ); ?> <span class="marquee__dot">✦</span></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>