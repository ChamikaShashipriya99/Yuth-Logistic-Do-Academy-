<?php
/**
 * Template Name: Service Footer Page
 *
 * Full-file overview:
 * - Acts both as a standalone page template (so editors can input footer data via ACF)
 *   and as the footer partial included with get_footer('service') for service pages.
 * - Pulls all footer content (CTA, contact block, footer bottom) from ACF fields stored
 *   on either a special "Service Footer Page" or, if absent, the static front page. This keeps
 *   management centralized inside WP admin and avoids hard-coded strings.
 */

/**
 * SECTION: Determine which page stores the footer fields.
 *
 * 1. Look for a published page whose template equals this file (footer-service.php). Editors can
 *    create such a page purely to house footer content for service pages.
 * 2. If none exists, fall back to the page marked as "Front Page" in Settings → Reading.
 *    That ensures existing setups still work without additional configuration.
 */
$cta_page_id = 0;
$cta_template_pages = get_posts(
    array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'footer-service.php',
        'posts_per_page' => 1,
        'fields'         => 'ids',
        'no_found_rows'  => true,
    )
);
if ( ! empty( $cta_template_pages ) ) {
    $cta_page_id = (int) $cta_template_pages[0];
}
if ( ! $cta_page_id ) {
    $cta_page_id = (int) get_option( 'page_on_front' );
}

/**
 * SECTION: CTA banner fields with contact form.
 *
 * Supports responsive background images and contact form integration.
 * Editors control the banner background images (desktop and mobile), form title/subtitle, and Contact Form 7 form ID.
 */
$cta_bg         = $cta_page_id ? get_field( 'cta_background_image', $cta_page_id ) : null;
$cta_bg_url     = $cta_bg['url'] ?? '';
$cta_bg_alt     = $cta_bg['alt'] ?? '';
$cta_bg_mobile  = $cta_page_id ? get_field( 'cta_background_image_mobile', $cta_page_id ) : null;
$cta_bg_mobile_url = $cta_bg_mobile['url'] ?? $cta_bg_url; // Fallback to desktop image if mobile not set

// Form title fields
$form_subtitle  = $cta_page_id ? get_field( 'form_subtitle', $cta_page_id ) : 'Get In Touch';
$form_title     = $cta_page_id ? get_field( 'form_title', $cta_page_id ) : 'Book Your Logistics';
$form_id        = $cta_page_id ? get_field( 'contact_form_id', $cta_page_id ) : '';

/**
 * SECTION: Contact info widget (middle column).
 *
 * Labels, numbers, and links are fully editable. For phone/email we store both the
 * display text and the link target so editors can change formats without touching code.
 */
$contact_heading        = $cta_page_id ? get_field( 'contact_info_heading', $cta_page_id ) : '';
$contact_hotline_label  = $cta_page_id ? get_field( 'contact_hotline_label', $cta_page_id ) : '';
$contact_hotline_text   = $cta_page_id ? get_field( 'contact_hotline_text', $cta_page_id ) : '';
$contact_hotline_link   = $cta_page_id ? get_field( 'contact_hotline_link', $cta_page_id ) : '';
$contact_email_label    = $cta_page_id ? get_field( 'contact_email_label', $cta_page_id ) : '';
$contact_email_address  = $cta_page_id ? get_field( 'contact_email_address', $cta_page_id ) : '';
$contact_address_label  = $cta_page_id ? get_field( 'contact_address_label', $cta_page_id ) : '';
$contact_address_text   = $cta_page_id ? get_field( 'contact_address_text', $cta_page_id ) : '';

/**
 * SECTION: Footer contact info icon classes.
 *
 * Allows admins to customize icon classes for contact info icons in the footer.
 * Icons can be changed to any Font Awesome or custom icon class.
 */
$contact_phone_icon_class   = $cta_page_id ? trim( (string) ( get_field( 'contact_phone_icon_class', $cta_page_id ) ?: '' ) ) : ''; // Get phone icon class from ACF field
$contact_email_icon_class   = $cta_page_id ? trim( (string) ( get_field( 'contact_email_icon_class', $cta_page_id ) ?: '' ) ) : ''; // Get email icon class from ACF field
$contact_address_icon_class = $cta_page_id ? trim( (string) ( get_field( 'contact_address_icon_class', $cta_page_id ) ?: '' ) ) : ''; // Get address icon class from ACF field

/**
 * SECTION: Footer bottom strip.
 *
 * Allows admins to adjust copyright text (year appended automatically), the "solution by"
 * label, partner name/link, and optional partner logo.
 */
$footer_copyright_text = $cta_page_id ? get_field( 'footer_copyright_text', $cta_page_id ) : '';
$footer_solution_label = $cta_page_id ? get_field( 'footer_solution_label', $cta_page_id ) : '';
$footer_solution_name  = $cta_page_id ? get_field( 'footer_solution_name', $cta_page_id ) : '';
$footer_solution_link  = $cta_page_id ? get_field( 'footer_solution_link', $cta_page_id ) : '';
$footer_solution_logo  = $cta_page_id ? get_field( 'footer_solution_logo', $cta_page_id ) : null;
$footer_solution_logo_url = $footer_solution_logo['url'] ?? '';
$footer_solution_logo_alt = $footer_solution_logo['alt'] ?? ( $footer_solution_name ?: '' );
?>
    <!-- CTA banner with contact form: editable background images and Contact Form 7 integration -->
    <div class="footer-cta-banner h-p-ul-m-0 has-form">
        <picture>
            <?php if ( $cta_bg_mobile_url ) : ?>
                <source srcset="<?php echo esc_url( $cta_bg_mobile_url ); ?>" media="(max-width: 991px)">
            <?php endif; ?>
            <?php if ( $cta_bg_url ) : ?>
                <source srcset="<?php echo esc_url( $cta_bg_url ); ?>">
            <?php endif; ?>
            <?php if ( $cta_bg_url ) : ?>
                <img src="<?php echo esc_url( $cta_bg_url ); ?>" alt="<?php echo esc_attr( $cta_bg_alt ); ?>" class="cta-banner cta-banner-img bagels-cover-img">
            <?php endif; ?>
        </picture>
        <div class="container cta-1">
            <div class="cta-2">
                <div class="h-p-ul-m-0 bagels-contact-form">
                    <div class="bcp-1 bagels-pos-relative bagels-flex">
                        <div class="bcp-left">
                            <div class="bcp-l-top">
                                <div class="vc-theme-title vc-tt-align-center vc-tt-light">
                                    <?php if ( $form_subtitle ) : ?>
                                        <div class="vc-tt-sub-title">
                                            <div class="vc-tt-st-1"><?php echo esc_html( $form_subtitle ); ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( $form_title ) : ?>
                                        <h2 class="vc-tt-title"><?php echo esc_html( $form_title ); ?></h2>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="bcp-l-bottom">
                                <div class="ptc-form">
                                    <?php if ( $form_id ) : ?>
                                        <?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( $form_id ) . '"]' ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Widget area containing the brands strip, contact info, and footer menu -->
    <div id="footer-widget-area" class=" h-p-ul-m-0">
        <div class="container">
            <div class="footer-widget-box fwb-brands h-p-ul-m-0">
                <div class="fwb-ci-1"></div>
            </div>
            <!-- Dynamic contact info column -->
            <div class="footer-widget-box fwb-contact-info h-p-ul-m-0">
                <div class="fwb-ci-1">
                    <h2 class="fwb-ci-title"><?php echo esc_html( $contact_heading ); ?></h2>
                    <div class="contact-info-bar style-3">
                        <div class="cib-1 cib-has-whatsapp">
                            <div class="contact-group cg-two-nums">
                                <h4 class="cg-heading">
                                    <span class="cg-h-icon">
                                        <i class="<?php echo esc_attr( $contact_phone_icon_class ); /* Output phone icon class, escaped for HTML attribute */ ?>"></i>
                                    </span>
                                    <span class="cg-h-text"><?php echo esc_html( $contact_hotline_label ); ?></span>
                                </h4>
                                <p class="cg-text ">
                                    <a class="cg-t-link cg-t-l-phone" href="<?php echo esc_url( $contact_hotline_link ); ?>">
                                        <?php echo esc_html( $contact_hotline_text ); ?>
                                    </a>
                                </p>
                            </div>
                            <div class="contact-group">
                                <h4 class="cg-heading">
                                    <span class="cg-h-icon">
                                        <i class="<?php echo esc_attr( $contact_email_icon_class ); /* Output email icon class, escaped for HTML attribute */ ?>"></i>
                                    </span>
                                    <span class="cg-h-text"><?php echo esc_html( $contact_email_label ); ?></span>
                                </h4>
                                <p class="cg-text">
                                    <a href="<?php echo esc_attr( $contact_email_address ? 'mailto:' . $contact_email_address : '' ); ?>">
                                        <?php echo esc_html( $contact_email_address ); ?>
                                    </a>
                                </p>
                            </div>
                            <div class="contact-group cg-address">
                                <h4 class="cg-heading">
                                    <span class="cg-h-icon">
                                        <i class="<?php echo esc_attr( $contact_address_icon_class ); /* Output address icon class, escaped for HTML attribute */ ?>"></i>
                                    </span>
                                    <span class="cg-h-text"><?php echo esc_html( $contact_address_label ); ?></span>
                                </h4>
                                <p class="cg-text"><?php echo esc_html( $contact_address_text ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer menu uses WP menus + fallback -->
            <div class="footer-widget-box fwb-menu">
                <div id="footer-menu">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'menu-footer-menu',
                            'menu_class'     => 'nav widget-nav-list',
                            'container'      => false,
                            'fallback_cb'    => 'youth_logistic_menu_fallback',
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom strip with copyright and partner attribution -->
    <div id="footer-bottom">
        <div class="container">
            <div class="fb-1">
                <div class="copyright-note">
                    <?php
                    if ( $footer_copyright_text ) {
                        echo wp_kses_post( $footer_copyright_text );
                        echo ' ' . esc_html( gmdate( 'Y' ) ); // Append current year so the copyright stays up to date.
                    }
                    ?>
                </div>
                <div class="fb-site-creater">
                    <div class="fb-sc-text"><?php echo esc_html( $footer_solution_label ); ?></div>
                    <?php if ( $footer_solution_name ) : ?>
                        <a href="<?php echo esc_url( $footer_solution_link ?: '#' ); ?>" target="_blank" title="<?php echo esc_attr( $footer_solution_name ); ?>" class="fb-sc-link">
                            <?php if ( $footer_solution_logo_url ) : ?>
                                <div class="fb-sc-l-img">
                                    <img src="<?php echo esc_url( $footer_solution_logo_url ); ?>" alt="<?php echo esc_attr( $footer_solution_logo_alt ); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="fb-sc-l-name"><?php echo esc_html( $footer_solution_name ); ?></div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>

