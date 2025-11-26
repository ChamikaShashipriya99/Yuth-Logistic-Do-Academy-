<?php
/**
 * Template Name: Header (Navigation)
 *
 * Full-file overview:
 * - Acts both as a standalone page template (so editors can input header data via ACF)
 *   and as the header partial included with get_header().
 * - Pulls all header content (contact info, social media links) from ACF fields stored
 *   on either a special "Header (Navigation)" page or, if absent, the static front page.
 *   This keeps management centralized inside WP admin and avoids hard-coded strings.
 */

/**
 * SECTION: Determine which page stores the header fields.
 *
 * 1. Look for a published page whose template equals this file (header.php). Editors can
 *    create such a page purely to house header content.
 * 2. If none exists, fall back to the page marked as "Front Page" in Settings → Reading.
 *    That ensures existing setups still work without additional configuration.
 */
$header_page_id = 0; // Initialize variable to store the page ID that contains header ACF fields (default: 0 means not found yet)
$header_template_pages = get_posts( // Query WordPress database to find pages using this header template
    array(
        'post_type'      => 'page', // Only search for pages (not posts or custom post types)
        'post_status'    => 'publish', // Only get published pages (exclude drafts, private, etc.)
        'meta_key'       => '_wp_page_template', // Search in post meta for the template field
        'meta_value'     => 'header.php', // Find pages where template equals 'header.php'
        'posts_per_page' => 1, // Only need one result (the first matching page)
        'fields'         => 'ids', // Return only post IDs (not full post objects) for better performance
        'no_found_rows'  => true, // Skip counting total found rows (performance optimization)
    )
);
if ( ! empty( $header_template_pages ) ) { // Check if any pages with header template were found
    $header_page_id = (int) $header_template_pages[0]; // Get the first page ID and convert to integer (cast for security)
}
if ( ! $header_page_id ) { // If no header template page found (still 0), use fallback
    $header_page_id = (int) get_option( 'page_on_front' ); // Get the ID of the page set as Front Page in Settings → Reading
}

/**
 * SECTION: Contact info fields.
 *
 * Labels, numbers, and links are fully editable. For phone/email we store both the
 * display text and the link target so editors can change formats without touching code.
 */
$header_hotline_label = $header_page_id ? get_field( 'header_hotline_label', $header_page_id ) : 'Hotline'; // Get hotline label from ACF field, or use 'Hotline' as default if no page ID or field empty
$header_hotline_text  = $header_page_id ? get_field( 'header_hotline_text', $header_page_id ) : '+042 30 30 433'; // Get hotline display text from ACF, or use default phone number
$header_hotline_link  = $header_page_id ? get_field( 'header_hotline_link', $header_page_id ) : 'tel:+0423030433'; // Get hotline clickable link (tel: protocol) from ACF, or use default
$header_email_label   = $header_page_id ? get_field( 'header_email_label', $header_page_id ) : 'Email'; // Get email label from ACF field, or use 'Email' as default
$header_email_address = $header_page_id ? get_field( 'header_email_address', $header_page_id ) : 'admin@yuthlogistics.com.au'; // Get email address from ACF field, or use default email

/**
 * SECTION: Social media links.
 *
 * Allows admins to adjust social media URLs and the "Follow us on" text.
 */
$header_social_follow_text = $header_page_id ? ( get_field( 'header_social_follow_text', $header_page_id ) ?: 'Follow us on' ) : 'Follow us on'; // Get "Follow us on" text from ACF, using null coalescing operator (?:) to provide fallback if field is empty, default to 'Follow us on'
$header_facebook_url       = $header_page_id ? ( get_field( 'header_facebook_url', $header_page_id ) ?: '#' ) : '#'; // Get Facebook URL from ACF field, or use '#' as default link (empty link)
$header_instagram_url       = $header_page_id ? ( get_field( 'header_instagram_url', $header_page_id ) ?: '#' ) : '#'; // Get Instagram URL from ACF field, or use '#' as default link
$header_tiktok_url         = $header_page_id ? ( get_field( 'header_tiktok_url', $header_page_id ) ?: '#' ) : '#'; // Get TikTok URL from ACF field, or use '#' as default link
?>
<!DOCTYPE html>
<html <?php language_attributes(); /* Output HTML lang attribute (e.g., lang="en-US") based on WordPress settings */ ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); /* Output the site's character encoding (usually UTF-8) from WordPress settings */ ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/images/titelIcon.png' ); /* Get theme directory URL, append favicon path, and escape URL for security */ ?>">
    <?php wp_head(); /* WordPress hook that outputs scripts, styles, and meta tags from plugins/themes - required for proper functionality */ ?>
</head>
<body <?php body_class( 'home wp-singular page-template-default page' ); /* Output CSS classes for body tag based on page type and WordPress context */ ?>>
<?php wp_body_open(); /* WordPress hook that allows plugins/themes to add content right after opening body tag (WP 5.2+) */ ?>
<div class="body-wrap">
    <nav class="navbar navbar-fixed-top navbar-default" id="site-header">
        <div class="container">
            <div class="flex-parent bagels-trans-p-2">
                <div class="navbar-header">
                    <a class="navbar-brand header-logo" href="<?php echo esc_url( home_url( '/' ) ); /* Get site home URL and escape it for security (prevents XSS attacks) */ ?>">
                        <?php
                        if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) { // Check if WordPress custom logo function exists (WP 4.5+) and if a logo is set in Appearance → Customize
                            the_custom_logo(); // Output the WordPress custom logo (includes proper img tag with all attributes)
                        } else { // If no WordPress custom logo is set, use fallback
                            ?>
                            <img class="bagels-trans-p-2" src="<?php echo esc_url( get_template_directory_uri() . '/images/Logo.svg' ); /* Get theme directory URL, append logo path, escape URL */ ?>" alt="<?php bloginfo( 'name' ); /* Output site name as image alt text for accessibility */ ?>">
                            <?php
                        }
                        ?>
                    </a>
                    <div class="nh-1">
                        <div class="contact-info-bar style-2 visible-sm">
                            <div class="cib-1">
                                <div class="contact-group">
                                    <h4 class="cg-heading">
                                        <span class="cg-h-icon">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <span class="cg-h-text"><?php echo esc_html( $header_hotline_label ); /* Output hotline label, escaped for HTML (prevents XSS) */ ?></span>
                                    </h4>
                                    <p class="cg-text">
                                        <a href="<?php echo esc_url( $header_hotline_link ); /* Output phone link (tel: protocol), escaped for URL security */ ?>"><?php echo esc_html( $header_hotline_text ); /* Output phone number text, escaped for HTML */ ?></a>
                                    </p>
                                </div>
                                <div class="contact-group">
                                    <h4 class="cg-heading">
                                        <span class="cg-h-icon">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <span class="cg-h-text"><?php echo esc_html( $header_email_label ); /* Output email label, escaped for HTML */ ?></span>
                                    </h4>
                                    <p class="cg-text">
                                        <a href="<?php echo esc_attr( $header_email_address ? 'mailto:' . $header_email_address : '' ); /* Build mailto: link if email exists, escape for HTML attribute */ ?>"><?php echo esc_html( $header_email_address ); /* Output email address text, escaped for HTML */ ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="contact-info-bar style-3 visible-xs">
                            <div class="cib-1">
                                <div class="contact-group">
                                    <h4 class="cg-heading">
                                        <a href="<?php echo esc_url( $header_hotline_link ); /* Output phone link for mobile click-to-call, escaped for URL */ ?>" title="Phone">
                                            <span class="cg-h-icon">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <a href="#" data-sidebar="left-sidebar" class="sidebar-toggler header-ham-icon visible-xs visible-sm" title="Toggle menu">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <div class="contact-info-bar style-1 bagels-trans-p-2">
                        <div class="cib-1">
                            <div class="contact-group">
                                <h4 class="cg-heading">
                                    <span class="cg-h-icon">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <span class="cg-h-text"><?php echo esc_html( $header_hotline_label ); /* Output hotline label for desktop navbar, escaped for HTML */ ?></span>
                                </h4>
                                <p class="cg-text">
                                    <a href="<?php echo esc_url( $header_hotline_link ); /* Output phone link, escaped for URL */ ?>"><?php echo esc_html( $header_hotline_text ); /* Output phone number, escaped for HTML */ ?></a>
                                </p>
                            </div>
                            <div class="contact-group">
                                <h4 class="cg-heading">
                                    <span class="cg-h-icon">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <span class="cg-h-text"><?php echo esc_html( $header_email_label ); /* Output email label for desktop navbar, escaped for HTML */ ?></span>
                                </h4>
                                <p class="cg-text">
                                    <a href="<?php echo esc_attr( $header_email_address ? 'mailto:' . $header_email_address : '' ); /* Build mailto: link, escape for HTML attribute */ ?>"><?php echo esc_html( $header_email_address ); /* Output email address, escaped for HTML */ ?></a>
                                </p>
                            </div>
                            <div class="contact-group">
                                <h4 class="cg-heading">
                                    <span class="cg-h-text"><?php echo esc_html( $header_social_follow_text ); /* Output "Follow us on" text, escaped for HTML */ ?></span>
                                </h4>
                                <ul class="cg-socials">
                                    <li>
                                        <a class="cg-s-icon" href="<?php echo esc_url( $header_facebook_url ); /* Output Facebook URL, escaped for URL security */ ?>" target="_blank" title="Facebook" rel="noopener">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="cg-s-icon" href="<?php echo esc_url( $header_instagram_url ); /* Output Instagram URL, escaped for URL security */ ?>" target="_blank" title="Instagram" rel="noopener">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="cg-s-icon" href="<?php echo esc_url( $header_tiktok_url ); /* Output TikTok URL, escaped for URL security */ ?>" target="_blank" title="Tiktok" rel="noopener">
                                            <i class="fab fa-tiktok"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                    wp_nav_menu( // Display WordPress navigation menu
                        array(
                            'theme_location' => 'primary', // Use menu assigned to 'primary' location (registered in functions.php)
                            'menu_class'     => 'nav navbar-nav navbar-right', // CSS classes to apply to the <ul> menu element
                            'container'      => false, // Don't wrap menu in a container div (set to false)
                            'fallback_cb'    => 'youth_logistic_menu_fallback', // Custom function to call if no menu is assigned to this location
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="sidebar-nav visible-xs visible-sm" id="left-sidebar">
        <?php
        wp_nav_menu( // Display mobile navigation menu (shown on small screens)
            array(
                'theme_location' => 'mobile', // Use menu assigned to 'mobile' location (registered in functions.php)
                'menu_id'        => 'menu-mobile-menu', // HTML ID attribute for the <ul> menu element
                'menu_class'     => 'nav navbar-nav navbar-right', // CSS classes to apply to the <ul> menu element
                'container'      => false, // Don't wrap menu in a container div (set to false)
                'fallback_cb'    => 'youth_logistic_menu_fallback', // Custom function to call if no menu is assigned to this location
            )
        );
        ?>
    </div>
    <div class="sidebar-overlay"></div>

