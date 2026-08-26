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
            'title_reply'   => __( 'دیدگاه خود را بنویسید', 'yarbar' ),
            'label_submit'  => __( 'ثبت دیدگاه', 'yarbar' ),
            'class_submit'  => 'btn btn--primary',
            'fields'        => array(
                    'author' => '<p class="comment-form-author"><label for="author">' . __( 'نام', 'yarbar' ) . ' <span class="required">*</span></label>'
                            . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" required></p>',
            ),
            'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __( 'متن دیدگاه', 'yarbar' ) . ' <span class="required">*</span></label>'
                    . '<textarea id="comment" name="comment" rows="5" required></textarea></p>'
                    . '<p class="yarbar-hp-field" aria-hidden="true">'
                    . '<label for="yarbar_website_hp">Website</label>'
                    . '<input type="text" id="yarbar_website_hp" name="yarbar_website_hp" tabindex="-1" autocomplete="off">'
                    . '</p>',
    ) );
    ?>

</div>