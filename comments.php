<?php
/**
 * The template for displaying comments
 *
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't show anything on a password-protected post until the password is entered.
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( 1 === (int) $comment_count ) {
                esc_html_e( 'یک دیدگاه', 'yarbar' );
            } else {
                printf(
                    /* translators: %s: number of comments */
                    esc_html__( '%s دیدگاه', 'yarbar' ),
                    esc_html( number_format_i18n( $comment_count ) )
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
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
        'title_reply'        => __( 'دیدگاه خود را بنویسید', 'yarbar' ),
        'label_submit'       => __( 'ثبت دیدگاه', 'yarbar' ),
        'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . __( 'متن دیدگاه', 'yarbar' ) . '</label><textarea id="comment" name="comment" rows="5" required></textarea></p>',
        'class_submit'       => 'btn btn--primary',
    ) );
    ?>

</div>