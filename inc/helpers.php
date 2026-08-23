<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function yarbar_option( $key, $default = '' ) {
    $settings = get_option( 'yarbar_business_settings', array() );
    return $settings[ $key ] ?? $default;
}

function yarbar_phone_link( $type = 'phone_primary' ) {
    $number = yarbar_option( $type );
    if ( empty( $number ) ) {
        return '';
    }
    $clean = preg_replace( '/[^0-9+]/', '', $number );
    return esc_url( 'tel:' . $clean );
}