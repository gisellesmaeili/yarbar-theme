<header class="site-header">
    <div class="container site-header__inner">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo">
            یاربار
        </a>

        <nav class="site-header__nav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'site-header__menu',
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>

        <a href="tel:+98XXXXXXXXXX" class="site-header__phone">
            ۰۲۱-XXXXXXXX
        </a>
    </div>
</header>

<a href="tel:+98XXXXXXXXXX" class="mobile-call-bar">
    تماس با یاربار
</a>