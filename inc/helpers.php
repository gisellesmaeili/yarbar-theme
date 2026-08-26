<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function yarbar_option( $key, $default = '' ) {
    $settings = get_option( 'yarbar_business_settings', array() );
    return $settings[ $key ] ?? $default;
}

function yarbar_phone_link( $type = 'phone_primary', $fallback = '' ) {
    $number = yarbar_option( $type, $fallback );
    if ( empty( $number ) ) {
        return '';
    }
    $clean = preg_replace( '/[^0-9+]/', '', $number );
    return esc_url( 'tel:' . $clean );
}

function yarbar_archive_url( $post_type, $fallback_path ) {
    $url = get_post_type_archive_link( $post_type );
    return $url ? $url : home_url( $fallback_path );
}