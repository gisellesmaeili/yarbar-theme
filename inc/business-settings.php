<?php
/**
 * YarBar Theme Settings (تنظیمات یاربار)
 * Modern, AJAX-powered Persian RTL settings panel.
 *
 * @package YarBar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Admin Menu Page
 */
function yarbar_register_theme_settings_page() {
    add_menu_page(
            __( 'تنظیمات یاربار', 'yarbar' ),
            __( 'تنظیمات یاربار', 'yarbar' ),
            'manage_options',
            'yarbar-settings',
            'yarbar_render_theme_settings_page',
            'dashicons-feedback',
            59
    );

    // Keep alias for backwards compatibility if needed
    add_submenu_page(
            null,
            __( 'تنظیمات یاربار', 'yarbar' ),
            __( 'تنظیمات یاربار', 'yarbar' ),
            'manage_options',
            'yarbar-business-settings',
            'yarbar_render_theme_settings_page'
    );
}
add_action( 'admin_menu', 'yarbar_register_theme_settings_page' );

/**
 * Enqueue Admin Assets
 */
function yarbar_admin_enqueue_assets( $hook ) {
    if ( 'toplevel_page_yarbar-settings' !== $hook && 'admin_page_yarbar-business-settings' !== $hook ) {
        return;
    }

    $theme_ver = wp_get_theme()->get( 'Version' );

    wp_enqueue_style(
            'yarbar-admin-settings',
            get_template_directory_uri() . '/assets/css/admin-settings.css',
            array(),
            $theme_ver
    );

    wp_enqueue_script(
            'yarbar-admin-settings',
            get_template_directory_uri() . '/assets/js/admin-settings.js',
            array(),
            $theme_ver,
            true
    );

    wp_localize_script(
            'yarbar-admin-settings',
            'yarbarAdminData',
            array(
                    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                    'nonce'   => wp_create_nonce( 'yarbar_settings_nonce' ),
            )
    );
}
add_action( 'admin_enqueue_scripts', 'yarbar_admin_enqueue_assets' );

/**
 * Helper to render dual Visual/Code editor field with optional heading tag selector
 *
 * @param string $field_name
 * @param string $label
 * @param string $value
 * @param array  $args
 */
function yarbar_render_editor_field( $field_name, $label, $value, $args = array() ) {
    $is_textarea = ! empty( $args['is_textarea'] );
    $help_text   = $args['help_text'] ?? '';
    $sub_label   = $args['sub_label'] ?? '';
    $tag_name    = $args['tag_name'] ?? '';
    $tag_val     = $args['tag_value'] ?? 'h2';
    ?>
    <div class="yarbar-form-group">
        <div class="yarbar-field-header">
            <label class="yarbar-label">
                <?php echo esc_html( $label ); ?>
                <?php if ( ! empty( $sub_label ) ) : ?>
                    <span class="sub-label"><?php echo esc_html( $sub_label ); ?></span>
                <?php endif; ?>
            </label>

            <div class="yarbar-field-toolbar">
                <?php if ( ! empty( $tag_name ) ) : ?>
                    <div class="yarbar-tag-selector">
                        <span class="yarbar-tag-label">تگ HTML:</span>
                        <select class="yarbar-tag-select" data-name="<?php echo esc_attr( $tag_name ); ?>">
                            <option value="h1" <?php selected( $tag_val, 'h1' ); ?>>H1</option>
                            <option value="h2" <?php selected( $tag_val, 'h2' ); ?>>H2</option>
                            <option value="h3" <?php selected( $tag_val, 'h3' ); ?>>H3</option>
                            <option value="h4" <?php selected( $tag_val, 'h4' ); ?>>H4</option>
                            <option value="h5" <?php selected( $tag_val, 'h5' ); ?>>H5</option>
                            <option value="h6" <?php selected( $tag_val, 'h6' ); ?>>H6</option>
                            <option value="p" <?php selected( $tag_val, 'p' ); ?>>P (پاراگراف)</option>
                            <option value="div" <?php selected( $tag_val, 'div' ); ?>>DIV</option>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="yarbar-mode-toggle" role="tablist">
                    <button type="button" class="yarbar-mode-tab is-active" data-mode="visual" title="حالت ظاهری">ظاهری</button>
                    <button type="button" class="yarbar-mode-tab" data-mode="code" title="حالت کد HTML">کد &lt;/&gt;</button>
                </div>
            </div>
        </div>

        <div class="yarbar-editor-container" data-field="<?php echo esc_attr( $field_name ); ?>">
            <input type="hidden" class="yarbar-editor-data" data-name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $value ); ?>">
            <div class="yarbar-editor-view is-visual" contenteditable="true" spellcheck="false" placeholder="متن را وارد کنید..."><?php echo wp_kses_post( $value ); ?></div>
            <textarea class="yarbar-editor-view is-code" rows="<?php echo $is_textarea ? '5' : '2'; ?>" spellcheck="false" dir="ltr" placeholder="کد HTML را وارد کنید..."><?php echo esc_textarea( $value ); ?></textarea>
        </div>

        <?php if ( ! empty( $help_text ) ) : ?>
            <p class="yarbar-help-text"><?php echo esc_html( $help_text ); ?></p>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Handle AJAX Save Request
 */
function yarbar_ajax_save_settings() {
    check_ajax_referer( 'yarbar_settings_nonce', 'nonce' );

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'شما مجوز کافی برای تغییر تنظیمات را ندارید.' ) );
    }

    $post_data = isset( $_POST['settings'] ) && is_array( $_POST['settings'] ) ? wp_unslash( $_POST['settings'] ) : array();

    // 1. Column item count validation (Min 1, Max 10 per column)
    $faqs_col1 = isset( $post_data['faqs']['col1'] ) && is_array( $post_data['faqs']['col1'] ) ? $post_data['faqs']['col1'] : array();
    $faqs_col2 = isset( $post_data['faqs']['col2'] ) && is_array( $post_data['faqs']['col2'] ) ? $post_data['faqs']['col2'] : array();

    $col1_count = count( $faqs_col1 );
    $col2_count = count( $faqs_col2 );

    if ( $col1_count < 1 || $col1_count > 10 ) {
        wp_send_json_error( array(
                'message' => sprintf( 'خطا: ستون اول باید بین ۱ تا ۱۰ سوال داشته باشد. (تعداد فعلی: %d)', $col1_count )
        ) );
    }

    if ( $col2_count < 1 || $col2_count > 10 ) {
        wp_send_json_error( array(
                'message' => sprintf( 'خطا: ستون دوم باید بین ۱ تا ۱۰ سوال داشته باشد. (تعداد فعلی: %d)', $col2_count )
        ) );
    }

    // 2. Sanitize fields
    $sanitized = array();

    // Tab 1: Headings & Descriptions & Tags
    $sanitized['hero_h1']            = wp_kses_post( $post_data['hero_h1'] ?? '' );
    $sanitized['hero_tag']           = yarbar_validate_heading_tag( $post_data['hero_tag'] ?? 'h1', 'h1' );

    $sanitized['about_eyebrow']      = wp_kses_post( $post_data['about_eyebrow'] ?? '' );
    $sanitized['about_title']        = wp_kses_post( $post_data['about_title'] ?? '' );
    $sanitized['about_desc']         = wp_kses_post( $post_data['about_desc'] ?? '' );
    $sanitized['about_tag']          = yarbar_validate_heading_tag( $post_data['about_tag'] ?? 'h2', 'h2' );

    $sanitized['services_eyebrow']   = wp_kses_post( $post_data['services_eyebrow'] ?? '' );
    $sanitized['services_title']     = wp_kses_post( $post_data['services_title'] ?? '' );
    $sanitized['services_desc']      = wp_kses_post( $post_data['services_desc'] ?? '' );
    $sanitized['services_tag']       = yarbar_validate_heading_tag( $post_data['services_tag'] ?? 'h2', 'h2' );

    $sanitized['calculator_eyebrow'] = wp_kses_post( $post_data['calculator_eyebrow'] ?? '' );
    $sanitized['calculator_title']   = wp_kses_post( $post_data['calculator_title'] ?? '' );
    $sanitized['calculator_tag']     = yarbar_validate_heading_tag( $post_data['calculator_tag'] ?? 'h2', 'h2' );

    $sanitized['coverage_eyebrow']   = wp_kses_post( $post_data['coverage_eyebrow'] ?? '' );
    $sanitized['coverage_title']     = wp_kses_post( $post_data['coverage_title'] ?? '' );
    $sanitized['coverage_desc']      = wp_kses_post( $post_data['coverage_desc'] ?? '' );
    $sanitized['coverage_tag']       = yarbar_validate_heading_tag( $post_data['coverage_tag'] ?? 'h2', 'h2' );

    $sanitized['faq_eyebrow']        = wp_kses_post( $post_data['faq_eyebrow'] ?? '' );
    $sanitized['faq_title']          = wp_kses_post( $post_data['faq_title'] ?? '' );
    $sanitized['faq_desc']           = wp_kses_post( $post_data['faq_desc'] ?? '' );
    $sanitized['faq_tag']            = yarbar_validate_heading_tag( $post_data['faq_tag'] ?? 'h2', 'h2' );

    $sanitized['blog_title']         = wp_kses_post( $post_data['blog_title'] ?? '' );
    $sanitized['blog_tag']           = yarbar_validate_heading_tag( $post_data['blog_tag'] ?? 'h2', 'h2' );

    $sanitized['cta_title']          = wp_kses_post( $post_data['cta_title'] ?? '' );
    $sanitized['cta_desc']           = wp_kses_post( $post_data['cta_desc'] ?? '' );
    $sanitized['cta_tag']            = yarbar_validate_heading_tag( $post_data['cta_tag'] ?? 'h2', 'h2' );

    // Tab 2: FAQs
    $sanitized['faqs'] = array(
            'col1' => array(),
            'col2' => array(),
    );

    foreach ( $faqs_col1 as $item ) {
        $q = sanitize_text_field( $item['q'] ?? '' );
        $a = sanitize_textarea_field( $item['a'] ?? '' );
        if ( ! empty( $q ) || ! empty( $a ) ) {
            $sanitized['faqs']['col1'][] = array( 'q' => $q, 'a' => $a );
        }
    }

    foreach ( $faqs_col2 as $item ) {
        $q = sanitize_text_field( $item['q'] ?? '' );
        $a = sanitize_textarea_field( $item['a'] ?? '' );
        if ( ! empty( $q ) || ! empty( $a ) ) {
            $sanitized['faqs']['col2'][] = array( 'q' => $q, 'a' => $a );
        }
    }

    // Re-verify after filtering empty values
    if ( count( $sanitized['faqs']['col1'] ) < 1 || count( $sanitized['faqs']['col1'] ) > 10 ) {
        wp_send_json_error( array( 'message' => 'ستون اول باید بین ۱ تا ۱۰ سوال معتبر داشته باشد.' ) );
    }
    if ( count( $sanitized['faqs']['col2'] ) < 1 || count( $sanitized['faqs']['col2'] ) > 10 ) {
        wp_send_json_error( array( 'message' => 'ستون دوم باید بین ۱ تا ۱۰ سوال معتبر داشته باشد.' ) );
    }

    // Tab 3: Information
    $sanitized['support_phone'] = sanitize_text_field( $post_data['support_phone'] ?? '' );
    $sanitized['whatsapp_url']  = esc_url_raw( $post_data['whatsapp_url'] ?? '' );
    $sanitized['telegram_url']  = esc_url_raw( $post_data['telegram_url'] ?? '' );
    $sanitized['instagram_url'] = esc_url_raw( $post_data['instagram_url'] ?? '' );

    // Update primary theme settings
    update_option( 'yarbar_theme_settings', $sanitized );

    // Keep legacy settings synced and remove address
    $legacy = get_option( 'yarbar_business_settings', array() );
    if ( ! empty( $sanitized['support_phone'] ) ) {
        $legacy['phone_primary'] = $sanitized['support_phone'];
    }
    if ( ! empty( $sanitized['whatsapp_url'] ) ) {
        $legacy['whatsapp'] = $sanitized['whatsapp_url'];
    }
    unset( $legacy['address'] );
    update_option( 'yarbar_business_settings', $legacy );

    wp_send_json_success( array(
            'message' => 'تنظیمات یاربار با موفقیت ذخیره شد.',
    ) );
}
add_action( 'wp_ajax_yarbar_save_settings', 'yarbar_ajax_save_settings' );

/**
 * Render Settings Page
 */
function yarbar_render_theme_settings_page() {
    $settings = get_option( 'yarbar_theme_settings', array() );
    $faqs     = yarbar_get_faqs();

    // Default values for Headings
    $default_hero_h1 = "یـــار \n<span class=\"hero__highlight\">بار</span> <br>\nحمل مطمئن بار";

    $hero_h1  = ! empty( $settings['hero_h1'] ) ? $settings['hero_h1'] : $default_hero_h1;
    $hero_tag = yarbar_validate_heading_tag( $settings['hero_tag'] ?? 'h1', 'h1' );

    $about_eyebrow = $settings['about_eyebrow'] ?? 'درباره یاربار';
    $about_title   = $settings['about_title'] ?? 'بار شما، با خیال راحت به مقصد می‌رسد';
    $about_desc    = $settings['about_desc'] ?? "یاربار با هدف ساده‌تر کردن فرآیند حمل‌ونقل بار شکل گرفته است؛ تا پیدا کردن وسیله مناسب، هماهنگی با راننده و جابه‌جایی بار، سریع‌تر و مطمئن‌تر انجام شود.\n\nما تلاش می‌کنیم از اولین تماس تا لحظه تحویل بار، تجربه‌ای شفاف، منظم و قابل اعتماد برای شما فراهم کنیم.";
    $about_tag     = yarbar_validate_heading_tag( $settings['about_tag'] ?? 'h2', 'h2' );

    $services_eyebrow = $settings['services_eyebrow'] ?? 'خدمات یاربار';
    $services_title   = $settings['services_title'] ?? 'برای هر نوع جابه‌جایی، یک راهکار مطمئن';
    $services_desc    = $settings['services_desc'] ?? 'از اسباب‌کشی منزل و دفتر تا حمل بارهای سنگین و بین‌شهری، یاربار خدمات حمل‌ونقل را متناسب با نیاز شما ارائه می‌دهد.';
    $services_tag     = yarbar_validate_heading_tag( $settings['services_tag'] ?? 'h2', 'h2' );

    $calc_eyebrow = $settings['calculator_eyebrow'] ?? 'محاسبه هوشمند هزینه';
    $calc_title   = $settings['calculator_title'] ?? 'هزینه حمل بارتان را همین حالا محاسبه کنید';
    $calc_tag     = yarbar_validate_heading_tag( $settings['calculator_tag'] ?? 'h2', 'h2' );

    $coverage_eyebrow = $settings['coverage_eyebrow'] ?? 'مناطق تحت پوشش';
    $coverage_title   = $settings['coverage_title'] ?? 'هرجا بار دارید، یاربار کنار شماست';
    $coverage_desc    = $settings['coverage_desc'] ?? 'یاربار خدمات حمل بار را در شهرها و مناطق مختلف ارائه می‌دهد. مبدأ و مقصدتان را انتخاب کنید و با خیال راحت، جابه‌جایی بار را به ما بسپارید.';
    $coverage_tag     = yarbar_validate_heading_tag( $settings['coverage_tag'] ?? 'h2', 'h2' );

    $faq_eyebrow = $settings['faq_eyebrow'] ?? 'سؤالات متداول';
    $faq_title   = $settings['faq_title'] ?? 'پاسخ سؤالات خود را اینجا پیدا کنید';
    $faq_desc    = $settings['faq_desc'] ?? 'پاسخ رایج‌ترین سؤالات درباره نحوه ثبت درخواست، انتخاب خودرو، هزینه حمل و خدمات یاربار را در این بخش ببینید.';
    $faq_tag     = yarbar_validate_heading_tag( $settings['faq_tag'] ?? 'h2', 'h2' );

    $blog_title   = $settings['blog_title'] ?? 'تازه‌ترین مطالب و نکات حمل بار';
    $blog_tag     = yarbar_validate_heading_tag( $settings['blog_tag'] ?? 'h2', 'h2' );

    $cta_title   = $settings['cta_title'] ?? 'آماده جابه‌جایی هستید؟';
    $cta_desc    = $settings['cta_desc'] ?? 'کافی است با ما تماس بگیرید تا مناسب‌ترین راهکار حمل را برای شما پیدا کنیم.';
    $cta_tag     = yarbar_validate_heading_tag( $settings['cta_tag'] ?? 'h2', 'h2' );

    // Contact info
    $support_phone = yarbar_option( 'support_phone', '۰۲۱-۹۱۰۰۰۰۰۰' );
    $whatsapp_url  = yarbar_option( 'whatsapp_url', '' );
    $telegram_url  = yarbar_option( 'telegram_url', '' );
    $instagram_url = yarbar_option( 'instagram_url', '' );
    ?>
    <div class="yarbar-admin-wrap">

        <!-- Header Banner -->
        <header class="yarbar-admin-header">
            <div class="yarbar-header-brand">
                <div class="yarbar-brand-logo" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="3" width="15" height="13" rx="2"/>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 8"/>
                        <circle cx="5.5" cy="18.5" r="2.5"/>
                        <circle cx="18.5" cy="18.5" r="2.5"/>
                    </svg>
                </div>
                <div>
                    <h1 class="yarbar-header-title">تنظیمات یاربار</h1>
                    <p class="yarbar-header-desc">مدیریت تیترهای صفحه اصلی، سوالات متداول و اطلاعات ارتباطی و شبکه‌های اجتماعی</p>
                </div>
            </div>
            <button type="button" class="yarbar-btn-save">
                <span class="yarbar-spinner" aria-hidden="true"></span>
                <span>ذخیره تغییرات</span>
            </button>
        </header>

        <!-- Tabs Navigation -->
        <nav class="yarbar-tabs-nav" role="tablist" aria-label="تنظیمات بخش‌های مختلف">
            <button type="button" class="yarbar-tab-btn is-active" data-tab="headings" role="tab" aria-selected="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 12h16M4 6h16M4 18h10"/>
                </svg>
                <span>تیترها — Headings</span>
            </button>
            <button type="button" class="yarbar-tab-btn" data-tab="faq" role="tab" aria-selected="false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3m.08 4h.01"/>
                </svg>
                <span>سؤالات متداول — FAQ</span>
            </button>
            <button type="button" class="yarbar-tab-btn" data-tab="info" role="tab" aria-selected="false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                </svg>
                <span>اطلاعات — Information</span>
            </button>
        </nav>

        <!-- Tab 1: تیترها (Headings) -->
        <div id="tab-pane-headings" class="yarbar-tab-pane is-active" role="tabpanel">

            <!-- Hero Section -->
            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">
                        <span>۱. بخش هیرو (Hero H1)</span>
                    </h3>
                    <span class="yarbar-card-badge">بالای صفحه</span>
                </div>
                <?php
                yarbar_render_editor_field(
                        'hero_h1',
                        'تیتر اصلی هیرو (hero__title):',
                        $hero_h1,
                        array(
                                'is_textarea' => true,
                                'tag_name'    => 'hero_tag',
                                'tag_value'   => $hero_tag,
                                'sub_label'   => 'امکان انتخاب تگ HTML و ویرایش در حالت ظاهری یا کد',
                                'help_text'   => 'این تیتر در صفحه اصلی داخل المان hero__title نمایش داده می‌شود.',
                        )
                );
                ?>
            </div>

            <!-- About Section -->
            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">
                        <span>۲. بخش درباره یاربار (Why YarBar / About)</span>
                    </h3>
                    <span class="yarbar-card-badge">بخش اول</span>
                </div>
                <?php
                yarbar_render_editor_field( 'about_eyebrow', 'نشان بالای تیتر (Eyebrow):', $about_eyebrow );
                yarbar_render_editor_field( 'about_title', 'عنوان اصلی (Title):', $about_title, array(
                        'tag_name'  => 'about_tag',
                        'tag_value' => $about_tag,
                ) );
                yarbar_render_editor_field( 'about_desc', 'توضیحات (Description):', $about_desc, array( 'is_textarea' => true ) );
                ?>
            </div>

            <!-- Services Section -->
            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">
                        <span>۳. بخش خدمات یاربار (Services)</span>
                    </h3>
                    <span class="yarbar-card-badge">بخش دوم</span>
                </div>
                <?php
                yarbar_render_editor_field( 'services_eyebrow', 'نشان بالای تیتر (Eyebrow):', $services_eyebrow );
                yarbar_render_editor_field( 'services_title', 'عنوان اصلی (Title):', $services_title, array(
                        'tag_name'  => 'services_tag',
                        'tag_value' => $services_tag,
                ) );
                yarbar_render_editor_field( 'services_desc', 'توضیحات (Description):', $services_desc, array( 'is_textarea' => true ) );
                ?>
            </div>

            <!-- Calculator Section -->
            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">
                        <span>۴. بخش محاسبه هزینه بار (Calculator)</span>
                    </h3>
                    <span class="yarbar-card-badge">بخش سوم</span>
                </div>
                <?php
                yarbar_render_editor_field( 'calculator_eyebrow', 'نشان بالای تیتر (Eyebrow):', $calc_eyebrow );
                yarbar_render_editor_field( 'calculator_title', 'عنوان اصلی (Title):', $calc_title, array(
                        'tag_name'  => 'calculator_tag',
                        'tag_value' => $calc_tag,
                ) );
                ?>
            </div>

            <!-- Coverage Section -->
            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">
                        <span>۵. بخش مناطق تحت پوشش (Coverage)</span>
                    </h3>
                    <span class="yarbar-card-badge">بخش چهارم</span>
                </div>
                <?php
                yarbar_render_editor_field( 'coverage_eyebrow', 'نشان بالای تیتر (Eyebrow):', $coverage_eyebrow );
                yarbar_render_editor_field( 'coverage_title', 'عنوان اصلی (Title):', $coverage_title, array(
                        'tag_name'  => 'coverage_tag',
                        'tag_value' => $coverage_tag,
                ) );
                yarbar_render_editor_field( 'coverage_desc', 'توضیحات (Description):', $coverage_desc, array( 'is_textarea' => true ) );
                ?>
            </div>

            <!-- FAQ Section -->
            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">
                        <span>۶. بخش سؤالات متداول (FAQ Headings)</span>
                    </h3>
                    <span class="yarbar-card-badge">بخش پنجم</span>
                </div>
                <?php
                yarbar_render_editor_field( 'faq_eyebrow', 'نشان بالای تیتر (Eyebrow):', $faq_eyebrow );
                yarbar_render_editor_field( 'faq_title', 'عنوان اصلی (Title):', $faq_title, array(
                        'tag_name'  => 'faq_tag',
                        'tag_value' => $faq_tag,
                ) );
                yarbar_render_editor_field( 'faq_desc', 'توضیحات (Description):', $faq_desc, array( 'is_textarea' => true ) );
                ?>
            </div>

            <!-- Blog Preview Section -->
            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">
                        <span>۷. بخش مقالات وبلاگ (Blog Preview)</span>
                    </h3>
                    <span class="yarbar-card-badge">بخش ششم</span>
                </div>
                <?php
                yarbar_render_editor_field( 'blog_title', 'عنوان اصلی (Title):', $blog_title, array(
                        'tag_name'  => 'blog_tag',
                        'tag_value' => $blog_tag,
                ) );
                ?>
            </div>

            <!-- Final CTA Section -->
            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">
                        <span>۸. بخش دعوت به اقدام پایانی (Final CTA)</span>
                    </h3>
                    <span class="yarbar-card-badge">بخش پایانی</span>
                </div>
                <?php
                yarbar_render_editor_field( 'cta_title', 'عنوان اصلی (Title):', $cta_title, array(
                        'tag_name'  => 'cta_tag',
                        'tag_value' => $cta_tag,
                ) );
                yarbar_render_editor_field( 'cta_desc', 'توضیحات (Description):', $cta_desc, array( 'is_textarea' => true ) );
                ?>
            </div>

        </div>

        <!-- Tab 2: سؤالات متداول (FAQ) -->
        <div id="tab-pane-faq" class="yarbar-tab-pane" role="tabpanel">

            <!-- 2-Column FAQ Items Manager (Sole Card in Tab 2) -->
            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">مدیریت آیتم‌های سؤال و جواب دو ستونه</h3>
                    <span class="yarbar-card-badge">حداقل ۱ و حداکثر ۱۰ سوال در هر ستون</span>
                </div>
                <p class="yarbar-help-text" style="margin-bottom: 20px;">
                    می‌توانید سوالات را با کشیدن و رها کردن (Drag & Drop) در داخل ستون یا بین دو ستون جابه‌جا کنید، یا از دکمه «انتقال» استفاده فرمایید. تیتر و توضیحات بخش سوالات متداول را در تب «تیترها» می‌توانید ویرایش کنید.
                </p>

                <div class="yarbar-faq-board">

                    <!-- Column 1 (Right Column) -->
                    <div class="yarbar-faq-col">
                        <div class="yarbar-faq-col-header">
                            <h4 class="yarbar-faq-col-title">ستون اول (راست)</h4>
                            <span class="yarbar-count-badge is-valid" data-column="col1">
                                <?php echo count( $faqs['col1'] ); ?> سوال (مجاز: ۱ تا ۱۰)
                            </span>
                        </div>
                        <div class="yarbar-faq-items-list" data-column="col1">
                            <?php foreach ( $faqs['col1'] as $item ) : ?>
                                <div class="yarbar-faq-item">
                                    <div class="yarbar-faq-item-top">
                                        <span class="yarbar-faq-handle">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/>
                                                <circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/>
                                            </svg>
                                            جابه‌جایی
                                        </span>
                                        <div class="yarbar-faq-actions">
                                            <button type="button" class="yarbar-btn-switch-col" data-target-col="col2">⇄ انتقال به ستون ۲</button>
                                            <button type="button" class="yarbar-btn-delete-faq" title="حذف سوال">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M3 6h18m-2 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="yarbar-form-group">
                                        <label class="yarbar-label">عنوان سوال:</label>
                                        <input type="text" class="yarbar-input faq-q-input" value="<?php echo esc_attr( $item['q'] ); ?>" placeholder="متن سوال را وارد کنید...">
                                    </div>
                                    <div class="yarbar-form-group">
                                        <label class="yarbar-label">پاسخ سوال:</label>
                                        <textarea class="yarbar-textarea faq-a-input" rows="3" placeholder="پاسخ کامل سوال را بنویسید..."><?php echo esc_textarea( $item['a'] ); ?></textarea>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="yarbar-btn-add-faq" data-column="col1">
                            <span>+ افزودن سؤال جدید به ستون اول</span>
                        </button>
                    </div>

                    <!-- Column 2 (Left Column) -->
                    <div class="yarbar-faq-col">
                        <div class="yarbar-faq-col-header">
                            <h4 class="yarbar-faq-col-title">ستون دوم (چپ)</h4>
                            <span class="yarbar-count-badge is-valid" data-column="col2">
                                <?php echo count( $faqs['col2'] ); ?> سوال (مجاز: ۱ تا ۱۰)
                            </span>
                        </div>
                        <div class="yarbar-faq-items-list" data-column="col2">
                            <?php foreach ( $faqs['col2'] as $item ) : ?>
                                <div class="yarbar-faq-item">
                                    <div class="yarbar-faq-item-top">
                                        <span class="yarbar-faq-handle">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/>
                                                <circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/>
                                            </svg>
                                            جابه‌جایی
                                        </span>
                                        <div class="yarbar-faq-actions">
                                            <button type="button" class="yarbar-btn-switch-col" data-target-col="col1">⇄ انتقال به ستون ۱</button>
                                            <button type="button" class="yarbar-btn-delete-faq" title="حذف سوال">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M3 6h18m-2 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="yarbar-form-group">
                                        <label class="yarbar-label">عنوان سوال:</label>
                                        <input type="text" class="yarbar-input faq-q-input" value="<?php echo esc_attr( $item['q'] ); ?>" placeholder="متن سوال را وارد کنید...">
                                    </div>
                                    <div class="yarbar-form-group">
                                        <label class="yarbar-label">پاسخ سوال:</label>
                                        <textarea class="yarbar-textarea faq-a-input" rows="3" placeholder="پاسخ کامل سوال را بنویسید..."><?php echo esc_textarea( $item['a'] ); ?></textarea>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="yarbar-btn-add-faq" data-column="col2">
                            <span>+ افزودن سؤال جدید به ستون دوم</span>
                        </button>
                    </div>

                </div>
            </div>

        </div>

        <!-- Tab 3: اطلاعات (Information) -->
        <div id="tab-pane-info" class="yarbar-tab-pane" role="tabpanel">

            <div class="yarbar-card">
                <div class="yarbar-card-header">
                    <h3 class="yarbar-card-title">راه‌های ارتباطی و شبکه‌های اجتماعی</h3>
                    <span class="yarbar-card-badge">سراسری در سایت</span>
                </div>

                <div class="yarbar-form-group">
                    <label class="yarbar-label">شماره پشتیبانی (Support Phone):</label>
                    <input type="text" class="yarbar-input" dir="ltr" data-name="support_phone" value="<?php echo esc_attr( $support_phone ); ?>" placeholder="۰۲۱-۹۱۰۰۰۰۰۰ یا +989120000000">
                    <p class="yarbar-help-text">این شماره در هدر، فوتر، دکمه‌های تماس سریع و بخش‌های تبدیل کاربر نمایش داده می‌شود.</p>
                </div>

                <div class="yarbar-form-group">
                    <label class="yarbar-label">لینک واتس‌اپ (WhatsApp URL):</label>
                    <input type="url" class="yarbar-input" dir="ltr" data-name="whatsapp_url" value="<?php echo esc_attr( $whatsapp_url ); ?>" placeholder="https://wa.me/989120000000">
                    <p class="yarbar-help-text">لینک مستقیم چت واتس‌اپ همراه با پیش‌شماره بین‌المللی بدون صفر</p>
                </div>

                <div class="yarbar-form-group">
                    <label class="yarbar-label">لینک تلگرام (Telegram URL):</label>
                    <input type="url" class="yarbar-input" dir="ltr" data-name="telegram_url" value="<?php echo esc_attr( $telegram_url ); ?>" placeholder="https://t.me/yarbar_ir">
                    <p class="yarbar-help-text">آدرس کانال یا پشتیبانی تلگرام یاربار</p>
                </div>

                <div class="yarbar-form-group">
                    <label class="yarbar-label">لینک اینستاگرام (Instagram URL):</label>
                    <input type="url" class="yarbar-input" dir="ltr" data-name="instagram_url" value="<?php echo esc_attr( $instagram_url ); ?>" placeholder="https://instagram.com/yarbar.ir">
                    <p class="yarbar-help-text">آدرس صفحه رسمی اینستاگرام یاربار</p>
                </div>
            </div>

        </div>

        <!-- Floating Toast Alert -->
        <div id="yarbar-toast" class="yarbar-toast" role="alert" aria-live="polite"></div>

    </div>
    <?php
}