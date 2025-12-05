<?php

/**
 * Youth Logistic theme setup.
 */
function youth_logistic_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 80,
            'width'       => 200,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'youth-logistic' ),
            'mobile'  => __( 'Mobile Menu', 'youth-logistic' ),
            'footer'  => __( 'Footer Menu', 'youth-logistic' ),
        )
    );
}
add_action( 'after_setup_theme', 'youth_logistic_setup' );

/**
 * Enqueue theme assets.
 */
function youth_logistic_assets() {
    wp_enqueue_style(
        'youth-logistic-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css',
        array(),
        '5.15.0'
    );

    wp_enqueue_style(
        'youth-logistic-main',
        get_template_directory_uri() . '/styles.css',
        array(),
        filemtime( get_template_directory() . '/styles.css' )
    );

    wp_enqueue_script( 'jquery' );

    wp_enqueue_script(
        'youth-logistic-main',
        get_template_directory_uri() . '/javascript.js',
        array( 'jquery' ),
        filemtime( get_template_directory() . '/javascript.js' ),
        true
    );

    // Add inline CSS to fix sprite path dynamically
    $sprite_url = get_template_directory_uri() . '/images/icon-sprite.png';
    $custom_css = ".bagels-sprite { background-image: url('{$sprite_url}') !important; }";
    wp_add_inline_style( 'youth-logistic-main', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'youth_logistic_assets' );

/**
 * Fallback for menus if no menu is assigned.
 *
 * @param array $args Menu arguments from wp_nav_menu.
 */
function youth_logistic_menu_fallback( $args ) {
    $pages = wp_list_pages(
        array(
            'title_li' => '',
            'echo'     => 0,
        )
    );

    if ( empty( $pages ) ) {
        return;
    }

    $menu  = '<ul class="' . esc_attr( $args['menu_class'] ?? '' ) . '">';
    $menu .= $pages;
    $menu .= '</ul>';

    echo $menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Add Bootstrap-style classes so dropdowns inherit original styles/JS.
 */
function youth_logistic_nav_item_classes( $classes, $item ) {
    if ( in_array( 'menu-item-has-children', $classes, true ) ) {
        $classes[] = 'dropdown';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'youth_logistic_nav_item_classes', 10, 2 );

/**
 * Add attributes for dropdown toggles in navigation menus.
 */
function youth_logistic_nav_link_attributes( $atts, $item, $args, $depth ) {
    if ( in_array( 'menu-item-has-children', $item->classes, true ) && 0 === $depth ) {
        $existing_class   = isset( $atts['class'] ) ? $atts['class'] . ' ' : '';
        $atts['class']    = trim( $existing_class . 'dropdown-toggle' );
        $atts['aria-haspopup'] = 'true';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'youth_logistic_nav_link_attributes', 10, 4 );

/**
 * Add classes to submenu lists.
 */
function youth_logistic_submenu_classes( $classes ) {
    $classes[] = 'dropdown-menu';
    return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'youth_logistic_submenu_classes' );

/**
 * Append caret icon to parent menu items for consistency with original markup.
 *
 * @param string   $item_output Menu item HTML output.
 * @param WP_Post  $item        Menu item object.
 * @param int      $depth       Menu depth.
 * @param stdClass $args        Menu arguments.
 */
function youth_logistic_add_dropdown_icon( $item_output, $item, $depth, $args ) {
    if (
        0 === $depth
        && in_array( $args->theme_location, array( 'primary', 'mobile' ), true )
        && in_array( 'menu-item-has-children', (array) $item->classes, true )
    ) {
        $item_output = str_replace(
            '</a>',
            ' <i class="fas fa-angle-down" aria-hidden="true"></i></a>',
            $item_output
        );
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'youth_logistic_add_dropdown_icon', 10, 4 );

/**
 * Register the "Service" custom post type so editors can manage service cards like posts.
 */
function youth_logistic_register_service_post_type() {
    $labels = array(
        'name'               => __( 'Services', 'youth-logistic' ),
        'singular_name'      => __( 'Service', 'youth-logistic' ),
        'menu_name'          => __( 'Services', 'youth-logistic' ),
        'add_new'            => __( 'Add New Service', 'youth-logistic' ),
        'add_new_item'       => __( 'Add New Service', 'youth-logistic' ),
        'edit_item'          => __( 'Edit Service', 'youth-logistic' ),
        'new_item'           => __( 'New Service', 'youth-logistic' ),
        'view_item'          => __( 'View Service', 'youth-logistic' ),
        'view_items'         => __( 'View Services', 'youth-logistic' ),
        'search_items'       => __( 'Search Services', 'youth-logistic' ),
        'not_found'          => __( 'No services found', 'youth-logistic' ),
        'not_found_in_trash' => __( 'No services found in Trash', 'youthl-logistic' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'services' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'service', $args );
}
add_action( 'init', 'youth_logistic_register_service_post_type' );

/**
 * Render all service cards for the owl carousel.
 *
 * Each card renders:
 * - Sprite icon (from ACF field service_icon_class)
 * - Title
 * - Excerpt
 * - Read more link to the single service post
 *
 * @return string
 */
function services() {
    // Map service slugs to their corresponding sprite icon classes.
    $service_icon_map = array(
        'tailgate-haul-truck-with-forklift-service' => 'three-trucks-parallel',
        'onsite-forklift-hire'                      => 'forklift',
        'metro-regional-same-day-delivery'          => 'lorry-with-cargo',
        'pallet-transport'                          => 'forklift-two-boxes',
        'point-a-to-b-transport'                    => 'two-location-markers',
    );

    $service_query = new WP_Query(
        array(
            'post_type'      => 'service',
            'posts_per_page' => -1,
            'orderby'        => array(
                'menu_order' => 'ASC',
                'date'       => 'DESC',
            ),
        )
    );

    ob_start();

    if ( $service_query->have_posts() ) {
        while ( $service_query->have_posts() ) {
            $service_query->the_post();
            $service_link  = get_permalink();
            $service_title = get_the_title();
            $service_copy  = get_the_excerpt() ?: wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 );
            $service_slug  = get_post_field( 'post_name', get_the_ID() );
            // Use mapped icon or fall back to ACF field, then default.
            $icon_class    = $service_icon_map[ $service_slug ] ?? ( get_field( 'service_icon_class', get_the_ID() ) ?: 'three-trucks-parallel' );
            ?>
            <div class="ph-svs-s-s-0">
                <a href="<?php echo esc_url( $service_link ); ?>" title="<?php echo esc_attr( $service_title ); ?>" class="ph-svs-s-single bagels-pos-relative">
                    <div class="ph-svs-s-s-icon bagels-filter-black-to-red bagels-sprite <?php echo esc_attr( $icon_class ); ?>"></div>
                    <div class="ph-svs-s-s-icon-large bagels-filter-black-to-red bagels-sprite bagels-pos-absolute <?php echo esc_attr( $icon_class ); ?>"></div>
                    <h4 class="ph-svs-s-s-title bagels-trans-p-2 bagels-block-title bagels-ff-gilroy-bold"><?php echo esc_html( $service_title ); ?></h4>
                    <p class="ph-svs-s-s-dscr bagels-trans-p-2"><?php echo esc_html( $service_copy ); ?></p>
                    <div class="ph-svs-s-s-link">
                        <span class="ph-svs-s-s-l-1"><?php esc_html_e( 'Read more', 'youth-logistic' ); ?></span>
                        <span class="ph-svs-s-s-l-icon"><i class="fas fa-angle-double-right"></i></span>
                    </div>
                </a>
            </div>
            <?php
        }
        wp_reset_postdata();
    }

    return ob_get_clean();
}

/**
 * Register the "Why Choose Us" custom post type for the stats cards.
 */
function youth_logistic_register_why_choose_us_post_type() {
    $labels = array(
        'name'               => __( 'Why Choose Us Cards', 'youth-logistic' ),
        'singular_name'      => __( 'Why Choose Us Card', 'youth-logistic' ),
        'menu_name'          => __( 'Why Choose Us', 'youth-logistic' ),
        'add_new'            => __( 'Add New Card', 'youth-logistic' ),
        'add_new_item'       => __( 'Add New Card', 'youth-logistic' ),
        'edit_item'          => __( 'Edit Card', 'youth-logistic' ),
        'new_item'           => __( 'New Card', 'youth-logistic' ),
        'view_item'          => __( 'View Card', 'youth-logistic' ),
        'view_items'         => __( 'View Cards', 'youth-logistic' ),
        'search_items'       => __( 'Search Cards', 'youth-logistic' ),
        'not_found'          => __( 'No cards found', 'youth-logistic' ),
        'not_found_in_trash' => __( 'No cards found in Trash', 'youth-logistic' ),
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'menu_position' => 21,
        'menu_icon'     => 'dashicons-chart-pie',
        'supports'      => array( 'title', 'editor', 'excerpt', 'page-attributes' ),
        'has_archive'   => false,
        'rewrite'       => array( 'slug' => 'why-choose-us' ),
        'show_in_rest'  => true,
    );

    register_post_type( 'why_choose_us_stat', $args );
}
add_action( 'init', 'youth_logistic_register_why_choose_us_post_type' );

/**
 * Output the four "Why Choose Us" stat cards while preserving original markup/classes.
 *
 * Each card expects:
 * - Title (stat headline)
 * - Excerpt/content (stat description)
 * - Optional ACF field `stat_icon_class` to control the icon sprite class
 *
 * @return string
 */
function why_choose_us() {
    $stats_query = new WP_Query(
        array(
            'post_type'      => 'why_choose_us_stat',
            'posts_per_page' => 4,
            'orderby'        => array(
                'menu_order' => 'ASC',
                'date'       => 'DESC',
            ),
        )
    );

    if ( ! $stats_query->have_posts() ) {
        return '';
    }

    $delay        = 0;
    $icon_classes = array( 'certificate', 'mansion', 'flatbet-with-hook', 'clipboard-with-shield' );
    $counter      = 0;
    ob_start();

    while ( $stats_query->have_posts() ) {
        $stats_query->the_post();
        $icon_class = get_field( 'stat_icon_class', get_the_ID() );
        if ( ! $icon_class ) {
            $icon_class = $icon_classes[ $counter % count( $icon_classes ) ];
        }
        $stat_title = get_the_title();
        $stat_copy  = get_the_excerpt() ?: wp_trim_words( wp_strip_all_tags( get_the_content() ), 20 );
        ?>
        <div class="ph-sts-s-single" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
            <div class="ph-sts-s-s-i-0 bagels-pos-relative">
                <div class="ph-sts-s-s-icon bagels-sprite bagels-pos-relative bagels-filter-black-to-white <?php echo esc_attr( $icon_class ); ?>"></div>
                <div class="ph-sts-s-s-i-stroke bagels-pos-absolute bagels-center-x"></div>
            </div>
            <div class="ph-sts-s-s-title bagels-ff-gilroy-bold"><?php echo esc_html( $stat_title ); ?></div>
            <div class="ph-sts-s-s-stat"><?php echo esc_html( $stat_copy ); ?></div>
        </div>
        <?php
        $delay += 100;
        $counter++;
    }

    wp_reset_postdata();

    return ob_get_clean();
}

/**
 * Add a drag-and-drop ordering screen for services.
 */
function youth_logistic_register_service_order_page() {
    add_submenu_page(
        'edit.php?post_type=service',
        __( 'Order Services', 'youth-logistic' ),
        __( 'Order Services', 'youth-logistic' ),
        'edit_pages',
        'order-services',
        'youth_logistic_render_service_order_page'
    );
}
add_action( 'admin_menu', 'youth_logistic_register_service_order_page' );

/**
 * Enqueue admin assets for the order page.
 *
 * @param string $hook Current admin hook.
 */
function youth_logistic_enqueue_service_order_assets( $hook ) {
    if ( 'service_page_order-services' !== $hook ) {
        return;
    }

    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script(
        'youth-logistic-service-order',
        get_template_directory_uri() . '/admin/service-order.js',
        array( 'jquery', 'jquery-ui-sortable' ),
        filemtime( get_template_directory() . '/admin/service-order.js' ),
        true
    );
    wp_localize_script(
        'youth-logistic-service-order',
        'YouthLogisticServiceOrder',
        array(
            'nonce'   => wp_create_nonce( 'youth_logistic_service_order' ),
            'success' => __( 'Service order saved.', 'youth-logistic' ),
            'failure' => __( 'Unable to save order. Please try again.', 'youth-logistic' ),
        )
    );
}
add_action( 'admin_enqueue_scripts', 'youth_logistic_enqueue_service_order_assets' );

/**
 * Render the drag-and-drop order page markup.
 */
function youth_logistic_render_service_order_page() {
    $services = get_posts(
        array(
            'post_type'      => 'service',
            'posts_per_page' => -1,
            'orderby'        => array(
                'menu_order' => 'ASC',
                'date'       => 'DESC',
            ),
        )
    );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Order Services', 'youth-logistic' ); ?></h1>
        <p><?php esc_html_e( 'Drag and drop to change the display order. Changes save automatically.', 'youth-logistic' ); ?></p>
        <ul id="youth-logistic-service-order" class="widefat">
            <?php foreach ( $services as $service ) : ?>
                <li class="service-order-item" data-id="<?php echo esc_attr( $service->ID ); ?>">
                    <span class="dashicons dashicons-move"></span>
                    <?php echo esc_html( $service->post_title ?: __( '(no title)', 'youth-logistic' ) ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div id="youth-logistic-service-order-feedback" role="status" aria-live="polite"></div>
    </div>
    <?php
}

/**
 * AJAX handler to persist service order.
 */
function youth_logistic_handle_service_order_ajax() {
    check_ajax_referer( 'youth_logistic_service_order', 'nonce' );

    if ( empty( $_POST['order'] ) || ! is_array( $_POST['order'] ) ) {
        wp_send_json_error();
    }

    foreach ( $_POST['order'] as $position => $service_id ) {
        wp_update_post(
            array(
                'ID'         => (int) $service_id,
                'menu_order' => (int) $position,
            )
        );
    }

    wp_send_json_success();
}
add_action( 'wp_ajax_youth_logistic_update_service_order', 'youth_logistic_handle_service_order_ajax' );

/**
 * Add a drag-and-drop ordering screen for Why Choose Us cards.
 */
function youth_logistic_register_stats_order_page() {
    add_submenu_page(
        'edit.php?post_type=why_choose_us_stat',
        __( 'Order Stats', 'youth-logistic' ),
        __( 'Order Stats', 'youth-logistic' ),
        'edit_pages',
        'order-why-choose-us',
        'youth_logistic_render_stats_order_page'
    );
}
add_action( 'admin_menu', 'youth_logistic_register_stats_order_page' );

/**
 * Enqueue ordering assets for Why Choose Us screen.
 *
 * @param string $hook Current admin hook.
 */
function youth_logistic_enqueue_stats_order_assets( $hook ) {
    if ( 'why_choose_us_stat_page_order-why-choose-us' !== $hook ) {
        return;
    }

    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script(
        'youth-logistic-stats-order',
        get_template_directory_uri() . '/admin/stat-order.js',
        array( 'jquery', 'jquery-ui-sortable' ),
        filemtime( get_template_directory() . '/admin/stat-order.js' ),
        true
    );
    wp_localize_script(
        'youth-logistic-stats-order',
        'YouthLogisticStatsOrder',
        array(
            'nonce'   => wp_create_nonce( 'youth_logistic_stats_order' ),
            'success' => __( 'Card order saved.', 'youth-logistic' ),
            'failure' => __( 'Unable to save order. Please try again.', 'youth-logistic' ),
        )
    );
}
add_action( 'admin_enqueue_scripts', 'youth_logistic_enqueue_stats_order_assets' );

/**
 * Render the ordering UI for Why Choose Us cards.
 */
function youth_logistic_render_stats_order_page() {
    $cards = get_posts(
        array(
            'post_type'      => 'why_choose_us_stat',
            'posts_per_page' => -1,
            'orderby'        => array(
                'menu_order' => 'ASC',
                'date'       => 'DESC',
            ),
        )
    );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Order Why Choose Us Cards', 'youth-logistic' ); ?></h1>
        <p><?php esc_html_e( 'Drag and drop the cards below to change their display order. Changes save automatically.', 'youth-logistic' ); ?></p>
        <ul id="youth-logistic-stats-order" class="widefat">
            <?php foreach ( $cards as $card ) : ?>
                <li class="stats-order-item" data-id="<?php echo esc_attr( $card->ID ); ?>">
                    <span class="dashicons dashicons-move"></span>
                    <?php echo esc_html( $card->post_title ?: __( '(no title)', 'youth-logistic' ) ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div id="youth-logistic-stats-order-feedback" role="status" aria-live="polite"></div>
    </div>
    <?php
}

/**
 * AJAX handler to save Why Choose Us ordering.
 */
function youth_logistic_handle_stats_order_ajax() {
    check_ajax_referer( 'youth_logistic_stats_order', 'nonce' );

    if ( empty( $_POST['order'] ) || ! is_array( $_POST['order'] ) ) {
        wp_send_json_error();
    }

    foreach ( $_POST['order'] as $position => $card_id ) {
        wp_update_post(
            array(
                'ID'         => (int) $card_id,
                'menu_order' => (int) $position,
            )
        );
    }

    wp_send_json_success();
}
add_action( 'wp_ajax_youth_logistic_update_stats_order', 'youth_logistic_handle_stats_order_ajax' );

/**
 * Automatically add Service CPT items as sub-menu items under "Services" menu item.
 *
 * Hooks into wp_nav_menu_objects to dynamically inject service posts as children
 * of any menu item with title "Services" in primary and mobile menus.
 *
 * @param array    $sorted_menu_items The menu items, sorted by each menu item's menu order.
 * @param stdClass $args              An object containing wp_nav_menu() arguments.
 * @return array Modified menu items with services injected.
 */
function youth_logistic_add_services_to_menu( $sorted_menu_items, $args ) {
    // Disabled: keep services menu fully manual (no auto-injected CPT links).
    return $sorted_menu_items;

    // Only apply to primary and mobile menus.
    if ( ! in_array( $args->theme_location, array( 'primary', 'mobile' ), true ) ) {
        return $sorted_menu_items;
    }

    // Find the "Services" menu item.
    $services_parent_id = 0;
    foreach ( $sorted_menu_items as $menu_item ) {
        if ( strtolower( trim( $menu_item->title ) ) === 'services' && $menu_item->menu_item_parent == 0 ) {
            $services_parent_id = $menu_item->ID;
            // Add class to indicate it has children.
            if ( ! in_array( 'menu-item-has-children', $menu_item->classes, true ) ) {
                $menu_item->classes[] = 'menu-item-has-children';
            }
            break;
        }
    }

    // If no "Services" menu item found, return unchanged.
    if ( ! $services_parent_id ) {
        return $sorted_menu_items;
    }

    // Query all services.
    $services = get_posts(
        array(
            'post_type'      => 'service',
            'posts_per_page' => -1,
            'orderby'        => array(
                'menu_order' => 'ASC',
                'date'       => 'DESC',
            ),
        )
    );

    if ( empty( $services ) ) {
        return $sorted_menu_items;
    }

    // Generate unique menu item IDs starting after existing items.
    $menu_order = 1000;

    foreach ( $services as $service ) {
        $menu_item                   = new stdClass();
        $menu_item->ID               = $service->ID + 100000; // Unique ID to avoid conflicts.
        $menu_item->db_id            = $menu_item->ID;
        $menu_item->title            = $service->post_title;
        $menu_item->url              = get_permalink( $service->ID );
        $menu_item->menu_order       = $menu_order++;
        $menu_item->menu_item_parent = $services_parent_id;
        $menu_item->type             = 'post_type';
        $menu_item->object           = 'service';
        $menu_item->object_id        = $service->ID;
        $menu_item->classes          = array( 'menu-item', 'menu-item-type-post_type', 'menu-item-object-service' );
        $menu_item->target           = '';
        $menu_item->attr_title       = '';
        $menu_item->description      = '';
        $menu_item->xfn              = '';
        $menu_item->current          = is_singular( 'service' ) && get_queried_object_id() === $service->ID;
        $menu_item->current_item_ancestor = false;
        $menu_item->current_item_parent   = false;

        if ( $menu_item->current ) {
            $menu_item->classes[] = 'current-menu-item';
        }

        $sorted_menu_items[] = $menu_item;
    }

    return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'youth_logistic_add_services_to_menu', 10, 2 );

