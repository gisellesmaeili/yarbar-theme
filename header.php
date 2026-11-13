<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/assets/fonts/arad/Arad-Regular.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/header/site-header' ); ?>