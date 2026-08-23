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

        <a href="<?php echo yarbar_phone_link(); ?>" class="site-header__phone">
            <?php echo esc_html( yarbar_option( 'phone_primary' ) ); ?>
        </a>
    </div>
</header>

<a href="<?php echo yarbar_phone_link(); ?>" class="mobile-call-bar">
    تماس با یاربار
</a>