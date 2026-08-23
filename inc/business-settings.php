<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function yarbar_register_business_settings_page() {
    add_menu_page(
        __( 'Business Settings', 'yarbar' ),
        __( 'Business Settings', 'yarbar' ),
        'manage_options',
        'yarbar-business-settings',
        'yarbar_render_business_settings_page',
        'dashicons-admin-generic',
        60
    );
}
add_action( 'admin_menu', 'yarbar_register_business_settings_page' );

function yarbar_register_business_settings() {
    register_setting(
        'yarbar_business_settings_group',
        'yarbar_business_settings',
        'yarbar_sanitize_business_settings'
    );
}
add_action( 'admin_init', 'yarbar_register_business_settings' );

function yarbar_sanitize_business_settings( $input ) {
    $output = array();
    $output['phone_primary']   = sanitize_text_field( $input['phone_primary'] ?? '' );
    $output['phone_secondary'] = sanitize_text_field( $input['phone_secondary'] ?? '' );
    $output['whatsapp']        = sanitize_text_field( $input['whatsapp'] ?? '' );
    $output['address']         = sanitize_textarea_field( $input['address'] ?? '' );
    $output['hours']           = sanitize_text_field( $input['hours'] ?? '' );
    return $output;
}

function yarbar_render_business_settings_page() {
    $settings = get_option( 'yarbar_business_settings', array() );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Business Settings', 'yarbar' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'yarbar_business_settings_group' ); ?>
            <table class="form-table">
                <tr>
                    <th><label for="phone_primary"><?php esc_html_e( 'Primary Phone', 'yarbar' ); ?></label></th>
                    <td>
                        <input type="text" id="phone_primary" dir="ltr" class="regular-text"
                               name="yarbar_business_settings[phone_primary]"
                               value="<?php echo esc_attr( $settings['phone_primary'] ?? '' ); ?>">
                        <p class="description"><?php esc_html_e( 'Example: +989120000000', 'yarbar' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="phone_secondary"><?php esc_html_e( 'Secondary Phone', 'yarbar' ); ?></label></th>
                    <td>
                        <input type="text" id="phone_secondary" dir="ltr" class="regular-text"
                               name="yarbar_business_settings[phone_secondary]"
                               value="<?php echo esc_attr( $settings['phone_secondary'] ?? '' ); ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="whatsapp"><?php esc_html_e( 'WhatsApp Number', 'yarbar' ); ?></label></th>
                    <td>
                        <input type="text" id="whatsapp" dir="ltr" class="regular-text"
                               name="yarbar_business_settings[whatsapp]"
                               value="<?php echo esc_attr( $settings['whatsapp'] ?? '' ); ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="address"><?php esc_html_e( 'Address', 'yarbar' ); ?></label></th>
                    <td>
                        <textarea id="address" class="large-text" rows="3"
                                  name="yarbar_business_settings[address]"><?php echo esc_textarea( $settings['address'] ?? '' ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><label for="hours"><?php esc_html_e( 'Working Hours', 'yarbar' ); ?></label></th>
                    <td>
                        <input type="text" id="hours" class="regular-text"
                               name="yarbar_business_settings[hours]"
                               value="<?php echo esc_attr( $settings['hours'] ?? '' ); ?>"
                               placeholder="<?php esc_attr_e( 'e.g. 24 hours a day', 'yarbar' ); ?>">
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}