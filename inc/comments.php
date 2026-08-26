<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function yarbar_validate_comment_submission( $commentdata ) {
    // Honeypot: a real visitor never sees or fills this field. A bot usually does.
    if ( ! empty( $_POST['yarbar_website_hp'] ) ) {
        wp_die( esc_html__( 'درخواست شما به عنوان اسپم شناسایی شد.', 'yarbar' ) );
    }

    if ( '' === trim( $commentdata['comment_author'] ) || '' === trim( $commentdata['comment_content'] ) ) {
        wp_die( esc_html__( 'لطفاً نام و متن دیدگاه را وارد کنید.', 'yarbar' ) );
    }

    return $commentdata;
}
add_filter( 'preprocess_comment', 'yarbar_validate_comment_submission' );