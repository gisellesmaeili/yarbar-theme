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

function yarbar_blog_archive_url() {
    $blog_page_id = get_option( 'page_for_posts' );
    $url          = $blog_page_id ? get_permalink( $blog_page_id ) : '';
    return $url ? $url : home_url( '/blog/' );
}

/**
 * Get category or taxonomy badge for single templates
 */
function yarbar_get_single_badge( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $post_type = get_post_type( $post_id );

    if ( 'post' === $post_type ) {
        $categories = get_the_category( $post_id );
        if ( ! empty( $categories ) ) {
            $default_cat_id = (int) get_option( 'default_category' );
            foreach ( $categories as $cat ) {
                if ( $cat->term_id !== $default_cat_id && 'uncategorized' !== $cat->slug ) {
                    return array(
                        'name' => $cat->name,
                        'url'  => get_category_link( $cat->term_id ),
                    );
                }
            }
            // If only default category exists
            return array(
                'name' => $categories[0]->name,
                'url'  => get_category_link( $categories[0]->term_id ),
            );
        }
    } else {
        // Custom taxonomy check for CPTs (if defined in future)
        $taxonomies = get_object_taxonomies( $post_type, 'objects' );
        foreach ( $taxonomies as $tax ) {
            if ( $tax->public ) {
                $terms = get_the_terms( $post_id, $tax->name );
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    return array(
                        'name' => $terms[0]->name,
                        'url'  => get_term_link( $terms[0] ),
                    );
                }
            }
        }
    }

    return null;
}

/**
 * Get excerpt or trimmed summary for single post hero
 */
function yarbar_get_single_excerpt( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    if ( has_excerpt( $post_id ) ) {
        return get_the_excerpt( $post_id );
    }
    $content = get_post_field( 'post_content', $post_id );
    if ( ! empty( $content ) ) {
        return wp_trim_words( wp_strip_all_tags( $content ), 26, '...' );
    }
    return '';
}

/**
 * Get related posts query for any post type
 */
function yarbar_get_related_query( $post_id = null, $limit = 3 ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $post_type = get_post_type( $post_id );

    if ( 'post' === $post_type ) {
        $categories = wp_get_post_categories( $post_id );
        $args = array(
            'post_type'           => 'post',
            'post__not_in'        => array( $post_id ),
            'posts_per_page'      => $limit,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        );
        if ( ! empty( $categories ) ) {
            $args['category__in'] = $categories;
        }
        return new WP_Query( $args );
    }

    return new WP_Query( array(
        'post_type'           => $post_type,
        'post__not_in'        => array( $post_id ),
        'posts_per_page'      => $limit,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'orderby'             => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
    ) );
}

/**
 * Get related section headings and archive links based on post type
 */
function yarbar_get_related_heading( $post_type = 'post' ) {
    switch ( $post_type ) {
        case 'service':
            return array(
                'title' => __( 'سایر خدمات یاربار', 'yarbar' ),
                'label' => __( 'مشاهده همه خدمات ←', 'yarbar' ),
                'url'   => yarbar_archive_url( 'service', '/services/' ),
            );
        case 'location':
            return array(
                'title' => __( 'سایر مناطق تحت پوشش', 'yarbar' ),
                'label' => __( 'مشاهده همه مناطق ←', 'yarbar' ),
                'url'   => yarbar_archive_url( 'location', '/locations/' ),
            );
        case 'post':
        default:
            return array(
                'title' => __( 'نوشته‌های مرتبط', 'yarbar' ),
                'label' => __( 'مشاهده همه مقالات ←', 'yarbar' ),
                'url'   => yarbar_blog_archive_url(),
            );
    }
}

/**
 * Get active blog categories excluding uncategorized
 */
function yarbar_get_blog_categories() {
    $default_cat_id = (int) get_option( 'default_category' );
    return get_categories( array(
        'taxonomy'   => 'category',
        'hide_empty' => true,
        'exclude'    => array( $default_cat_id ),
    ) );
}

/**
 * Retrieve metadata (title, description, count, placeholder, etc.) for archive pages
 */
function yarbar_get_archive_meta() {
    global $wp_query;

    $found_count = (int) ( $wp_query->found_posts ?? 0 );

    if ( is_search() ) {
        $search_query = get_search_query();
        return array(
            'title'              => sprintf( __( 'نتایج جستجو برای: %s', 'yarbar' ), '&ldquo;' . esc_html( $search_query ) . '&rdquo;' ),
            'description'        => sprintf( __( '%s نتیجه مطابق با عبارت جستجوی شما یافت شد.', 'yarbar' ), number_format_i18n( $found_count ) ),
            'count_text'         => sprintf( __( '%s نتیجه', 'yarbar' ), number_format_i18n( $found_count ) ),
            'search_placeholder' => __( 'جستجوی مجدد در سایت...', 'yarbar' ),
            'empty_text'         => __( 'هیچ موردی مطابق با عبارت جستجوی شما یافت نشد.', 'yarbar' ),
            'show_filters'       => false,
            'post_type'          => 'any',
            'categories'         => array(),
        );
    }

    if ( is_post_type_archive( 'service' ) ) {
        return array(
            'title'              => __( 'خدمات باربری', 'yarbar' ),
            'description'        => __( 'مجموعه کامل خدمات باربری، حمل اثاثیه منزل، بسته‌بندی حرفه‌ای و اعزام کارگر متخصص یاربار.', 'yarbar' ),
            'count_text'         => sprintf( __( '%s خدمات', 'yarbar' ), number_format_i18n( $found_count ) ),
            'search_placeholder' => __( 'جستجو در خدمات یاربار...', 'yarbar' ),
            'empty_text'         => __( 'خدماتی برای نمایش وجود ندارد.', 'yarbar' ),
            'show_filters'       => false,
            'post_type'          => 'service',
            'categories'         => array(),
        );
    }

    if ( is_post_type_archive( 'location' ) ) {
        return array(
            'title'              => __( 'مناطق تحت پوشش', 'yarbar' ),
            'description'        => __( 'ارائه خدمات سریع و ۲۴ ساعته باربری در تمامی مناطق تهران، کرج و مسیرهای بین‌شهری سراسر کشور.', 'yarbar' ),
            'count_text'         => sprintf( __( '%s منطقه', 'yarbar' ), number_format_i18n( $found_count ) ),
            'search_placeholder' => __( 'جستجو در مناطق تحت پوشش...', 'yarbar' ),
            'empty_text'         => __( 'منطقه‌ای برای نمایش وجود ندارد.', 'yarbar' ),
            'show_filters'       => false,
            'post_type'          => 'location',
            'categories'         => array(),
        );
    }

    if ( is_category() ) {
        $cat_title = single_cat_title( '', false );
        $cat_desc  = category_description();
        return array(
            'title'              => $cat_title,
            'description'        => $cat_desc ? wp_strip_all_tags( $cat_desc ) : __( 'مجموعه مقالات و راهنماهای این دسته‌بندی در وبلاگ یاربار.', 'yarbar' ),
            'count_text'         => sprintf( __( '%s مقاله', 'yarbar' ), number_format_i18n( $found_count ) ),
            'search_placeholder' => __( 'جستجو در بین مقالات و راهنماها...', 'yarbar' ),
            'empty_text'         => __( 'مقاله‌ای در این دسته‌بندی یافت نشد.', 'yarbar' ),
            'show_filters'       => true,
            'post_type'          => 'post',
            'categories'         => yarbar_get_blog_categories(),
        );
    }

    // Default: Blog / Posts archive
    $blog_page_id = get_option( 'page_for_posts' );
    $blog_title   = $blog_page_id ? get_the_title( $blog_page_id ) : __( 'آرشیو مقالات و راهنمای اسباب‌کشی', 'yarbar' );
    return array(
        'title'              => $blog_title ? $blog_title : __( 'آرشیو مقالات و راهنمای اسباب‌کشی', 'yarbar' ),
        'description'        => __( 'آخرین اخبار، آموزش‌های تخصصی بسته‌بندی، نکات حمل بار و راهنمای جامع تکنیک‌های اسباب‌کشی آسان.', 'yarbar' ),
        'count_text'         => sprintf( __( '%s مقاله', 'yarbar' ), number_format_i18n( $found_count ) ),
        'search_placeholder' => __( 'جستجو در بین مقالات و راهنماها...', 'yarbar' ),
        'empty_text'         => __( 'مقاله‌ای برای نمایش وجود ندارد.', 'yarbar' ),
        'show_filters'       => true,
        'post_type'          => 'post',
        'categories'         => yarbar_get_blog_categories(),
    );
}

/**
 * Render semantic, accessible pagination links with data-page attributes for AJAX
 */
function yarbar_render_pagination( $query = null, $current_page = 1 ) {
    if ( ! $query ) {
        global $wp_query;
        $query = $wp_query;
    }

    $total_pages = (int) ( $query->max_num_pages ?? 1 );
    if ( $total_pages <= 1 ) {
        return '';
    }

    $paged = max( 1, (int) $current_page );
    if ( is_front_page() || is_home() || is_archive() || is_search() ) {
        $paged = max( 1, get_query_var( 'paged', 1 ) );
    }

    $pagination_links = paginate_links( array(
        'base'      => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'total'     => $total_pages,
        'prev_text' => __( 'قبلی', 'yarbar' ),
        'next_text' => __( 'بعدی', 'yarbar' ),
        'type'      => 'array',
        'mid_size'  => 2,
        'end_size'  => 1,
    ) );

    if ( empty( $pagination_links ) ) {
        return '';
    }

    ob_start();
    ?>
    <nav class="pagination-nav" aria-label="<?php esc_attr_e( 'صفحه‌بندی مطالب', 'yarbar' ); ?>">
        <?php
        foreach ( $pagination_links as $link ) {
            if ( strpos( $link, 'current' ) !== false ) {
                preg_match( '/>([^<]+)</', $link, $matches );
                $num = $matches[1] ?? $paged;
                echo '<span class="page-link active" aria-current="page" data-page="' . esc_attr( $num ) . '">' . esc_html( $num ) . '</span>';
            } elseif ( strpos( $link, 'dots' ) !== false ) {
                echo '<span class="page-dots" aria-hidden="true">...</span>';
            } elseif ( strpos( $link, 'prev' ) !== false ) {
                $target_page = max( 1, $paged - 1 );
                preg_match( '/href=[\'"]([^\'"]+)[\'"]/', $link, $matches );
                $href = $matches[1] ?? '#';
                echo '<a href="' . esc_url( $href ) . '" class="page-link prev" data-page="' . esc_attr( $target_page ) . '">' . esc_html__( 'قبلی', 'yarbar' ) . '</a>';
            } elseif ( strpos( $link, 'next' ) !== false ) {
                $target_page = min( $total_pages, $paged + 1 );
                preg_match( '/href=[\'"]([^\'"]+)[\'"]/', $link, $matches );
                $href = $matches[1] ?? '#';
                echo '<a href="' . esc_url( $href ) . '" class="page-link next" data-page="' . esc_attr( $target_page ) . '">' . esc_html__( 'بعدی', 'yarbar' ) . '</a>';
            } else {
                preg_match( '/>([^<]+)</', $link, $matches_num );
                preg_match( '/href=[\'"]([^\'"]+)[\'"]/', $link, $matches_href );
                $num  = $matches_num[1] ?? '';
                $href = $matches_href[1] ?? '#';
                echo '<a href="' . esc_url( $href ) . '" class="page-link" data-page="' . esc_attr( $num ) . '">' . esc_html( $num ) . '</a>';
            }
        }
        ?>
    </nav>
    <?php
    return ob_get_clean();
}

