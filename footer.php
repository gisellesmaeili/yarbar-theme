<footer class="site-footer">
    <div class="container site-footer__inner">
        <div class="site-footer__col">
            <span class="site-footer__logo">یاربار</span>
            <p class="site-footer__text">
                حمل و نقل و اسباب‌کشی حرفه‌ای در سراسر ایران.
            </p>
        </div>

        <div class="site-footer__col">
            <h4>دسترسی سریع</h4>
            <ul class="site-footer__links">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">صفحه اصلی</a></li>
                <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">وبلاگ</a></li>
            </ul>
        </div>

        <div class="site-footer__col">
            <h4>تماس با ما</h4>
            <p class="site-footer__text">
                <a href="<?php echo yarbar_phone_link(); ?>"><?php echo esc_html( yarbar_option( 'phone_primary' ) ); ?></a>
            </p>
        </div>
    </div>

    <div class="site-footer__bottom">
        <div class="container">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> یاربار. تمام حقوق محفوظ است.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>