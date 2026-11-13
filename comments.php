<?php
/**
 * The template for displaying comments
 *
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( post_password_required() ) {
    return;
}

$commenter = wp_get_current_commenter();
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="22" height="22" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <span>
                <?php
                $comment_count = get_comments_number();
                if ( 1 === (int) $comment_count ) {
                    esc_html_e( 'دیدگاه‌های کاربران (۱)', 'yarbar' );
                } else {
                    printf(
                    /* translators: %s: number of comments */
                            esc_html__( 'دیدگاه‌های کاربران (%s)', 'yarbar' ),
                            esc_html( number_format_i18n( $comment_count ) )
                    );
                }
                ?>
            </span>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 48,
            ) );
            ?>
        </ol>

        <?php
        the_comments_pagination( array(
                'prev_text' => __( 'قبلی', 'yarbar' ),
                'next_text' => __( 'بعدی', 'yarbar' ),
        ) );
        ?>

    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="comments-closed"><?php esc_html_e( 'امکان ثبت دیدگاه جدید برای این نوشته بسته شده است.', 'yarbar' ); ?></p>
    <?php endif; ?>

    <?php
    comment_form( array(
            'title_reply'          => __( 'دیدگاه خود را بنویسید', 'yarbar' ),
            'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after'    => '</h3>',
            'cancel_reply_before'  => ' <small>',
            'cancel_reply_after'   => '</small>',
            'cancel_reply_link'    => __( 'لغو پاسخ', 'yarbar' ),
            'label_submit'         => __( 'ثبت دیدگاه', 'yarbar' ),
            'class_submit'         => 'btn btn--primary comment-submit-btn',
            'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'دیدگاه شما پس از بررسی نمایش داده خواهد شد.', 'yarbar' ) . '</span></p>',
            'fields'               => array(
                    'author' => '<p class="comment-form-author"><label for="author">' . __( 'نام شما', 'yarbar' ) . ' <span class="required">*</span></label>'
                            . '<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'نام و نام خانوادگی خود را وارد کنید', 'yarbar' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" required></p>',
            ),
            'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . __( 'متن دیدگاه', 'yarbar' ) . ' <span class="required">*</span></label>'
                    . '<textarea id="comment" name="comment" rows="5" placeholder="' . esc_attr__( 'دیدگاه، پرسش یا تجربه خود را بنویسید...', 'yarbar' ) . '" required></textarea></p>'
                    . '<p class="yarbar-hp-field" aria-hidden="true">'
                    . '<label for="yarbar_website_hp">Website</label>'
                    . '<input type="text" id="yarbar_website_hp" name="yarbar_website_hp" tabindex="-1" autocomplete="off">'
                    . '</p>',
    ) );
    ?>

</div>