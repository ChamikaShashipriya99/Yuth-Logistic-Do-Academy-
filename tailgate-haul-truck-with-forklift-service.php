<?php
/**
 * Template Name: Tailgate Haul & Truck with Forklift Service
 *
 * Dynamic Tailgate Haul & Truck with Forklift Service page template powered by ACF fields.
 * All content sections are managed via ACF fields - no hardcoded content.
 *
 * @package Youth_Logistic
 */

// Load WordPress header template (includes navigation, stylesheets, etc.)
get_header();

// Get theme directory URI for asset paths (images, CSS, JS)
// This variable stores the URL path to the active theme directory
$theme_uri = get_template_directory_uri();

// ==============================================================
// ACF FIELD RETRIEVAL
// ==============================================================
// Retrieve all ACF fields for this page template.
// These fields are managed via an ACF field group assigned to the "Tailgate Haul & Truck with Forklift Service" page template.

// Page Header Banner Title - Text field for the main page heading
$tailgate_header_title = get_field( 'tailgate_header_title' );

// Gallery Images - Repeater field containing multiple gallery images
// Each repeater row contains: gallery_image (Image field) and gallery_image_alt (Text field)
$tailgate_gallery_images = get_field( 'tailgate_gallery_images' );

// Service Overview Section - Text field for heading and WYSIWYG for content
$tailgate_service_overview_heading = get_field( 'tailgate_service_overview_heading' );
$tailgate_service_overview_content = get_field( 'tailgate_service_overview_content' );

// Our Services Section - Image, heading, and repeater field for service list items
$tailgate_our_services_image = get_field( 'tailgate_our_services_image' );
$tailgate_our_services_heading = get_field( 'tailgate_our_services_heading' );
$tailgate_our_services_list = get_field( 'tailgate_our_services_list' ); // Repeater with service_item (Text)

// Why Work With Us Section - Image, heading, and repeater field for benefits list items
$tailgate_why_work_with_us_image = get_field( 'tailgate_why_work_with_us_image' );
$tailgate_why_work_with_us_heading = get_field( 'tailgate_why_work_with_us_heading' );
$tailgate_why_work_with_us_list = get_field( 'tailgate_why_work_with_us_list' ); // Repeater with benefit_item (Text)

// Who Benefits Section - Image, heading, and repeater field for beneficiaries list items
$tailgate_who_benefits_image = get_field( 'tailgate_who_benefits_image' );
$tailgate_who_benefits_heading = get_field( 'tailgate_who_benefits_heading' );
$tailgate_who_benefits_list = get_field( 'tailgate_who_benefits_list' ); // Repeater with beneficiary_item (Text)

// Related Services Section - Subtitle, title, and repeater field for service items
$tailgate_related_services_subtitle = get_field( 'tailgate_related_services_subtitle' );
$tailgate_related_services_title = get_field( 'tailgate_related_services_title' );
// Repeater field containing related service items for the carousel
// Each repeater row contains: service_image (Image), service_title (Text), service_description (Text), service_link (URL), service_icon_class (Text)
$tailgate_related_services_items = get_field( 'tailgate_related_services_items' );
?>

<!-- Sprite override for local assets -->
<!-- Inline CSS to set the sprite image path dynamically using PHP -->
<style>
    .bagels-sprite {
        /* Output the sprite image URL using esc_url() for security (prevents XSS attacks) */
        background-image: url('<?php echo esc_url( $theme_uri . '/images/icon-sprite.png' ); ?>') !important;
    }
</style>

<!-- ==============================================================
     PAGE HEADER BANNER
     ============================================================== -->
<div class="page-header-banner bagels-overlay ">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <!-- Output the header title from ACF field, escaped for HTML security -->
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
                <?php echo esc_html( $tailgate_header_title ); ?>
            </h1>
        </div>
    </div>
</div>

<!-- ==============================================================
     SERVICE PAGE CONTENT
     ============================================================== -->
<div class="container page-container pc-sin-service">
    <div class="pc-ss-main-sect pc-ss-main-content">
        <!-- Gallery Section -->
        <!-- Display gallery images from ACF repeater field -->
        <div class="pc-ss-mc-gallery">
            <div class="gallery-grid-style-1 box-count-4 mob-box-count-3 box-count-over-4 box-count-over-3">
                <div class="ggs1-1">
                    <?php if ( $tailgate_gallery_images ) : ?>
                        <?php foreach ( $tailgate_gallery_images as $gallery_item ) : ?>
                            <?php
                            // Get image data from repeater row
                            // Support both "Image ID" and "Image Array" return formats from ACF
                            $image = $gallery_item['gallery_image'];
                            $image_id = is_array( $image ) ? $image['ID'] : $image;
                            
                            // Get image URL - if array format, use 'url' key; otherwise get URL from attachment ID
                            $image_url = is_array( $image ) ? $image['url'] : wp_get_attachment_image_url( $image_id, 'full' );
                            
                            // Get alt text - from array if available, otherwise from post meta
                            $image_alt = is_array( $image ) 
                                ? ( $image['alt'] ?? '' ) 
                                : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                            
                            // Use custom alt text from repeater if provided, otherwise fall back to image alt
                            $custom_alt = $gallery_item['gallery_image_alt'] ?: $image_alt;
                            ?>
                            <div class="ggs1-single">
                                <!-- Gallery image link - opens in Fancybox lightbox -->
                                <a href="<?php echo esc_url( $image_url ); ?>"
                                   data-fancybox="media-grid"
                                   class="ggs1-s-1">
                                    <!-- Display gallery image with proper alt text for accessibility -->
                                    <img src="<?php echo esc_url( $image_url ); ?>"
                                         alt="<?php echo esc_attr( $custom_alt ); ?>">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <!-- Gallery slider trigger button -->
                <div class="ggs1-slider-trigger">
                    <a class="ggs1-st-1" data-trigger-slider="">
                        <div class="ggs1-st-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="ggs1-st-text">View all</div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Columns Section -->
        <div class="pc-ss-columns">
            <!-- Service Overview Section -->
            <?php if ( $tailgate_service_overview_heading || $tailgate_service_overview_content ) : ?>
                <div class="bg-two-col-sect">
                    <div class="tcs-1 bagels-flex bagels-align-center">
                        <div class="tcs-text-col bagels-wysiwyg-content">
                            <!-- Output heading from ACF text field, escaped for HTML -->
                            <h2><?php echo esc_html( $tailgate_service_overview_heading ); ?></h2>
                            <!-- Output content from ACF WYSIWYG field, allows HTML formatting -->
                            <p style="text-align: left;">
                                <?php echo wp_kses_post( $tailgate_service_overview_content ); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Our Services Section -->
            <?php if ( $tailgate_our_services_image || $tailgate_our_services_heading || $tailgate_our_services_list ) : ?>
                <div class="bg-two-col-sect">
                    <div class="tcs-1 bagels-flex bagels-align-center">
                        <div class="tcs-img-col has-text">
                            <div class="tcs-ic-img-wrapper has-border-rad img-normal">
                                <?php
                                if ( $tailgate_our_services_image ) {
                                    // Support both "Image ID" and "Image Array" return formats from ACF
                                    $image_id = is_array( $tailgate_our_services_image ) 
                                        ? $tailgate_our_services_image['ID'] 
                                        : $tailgate_our_services_image;
                                    
                                    // Get alt text from array or post meta
                                    $image_alt = is_array( $tailgate_our_services_image )
                                        ? ( $tailgate_our_services_image['alt'] ?? '' )
                                        : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                                    
                                    // Output WordPress image with proper attributes
                                    echo wp_get_attachment_image(
                                        $image_id,
                                        'large',
                                        false,
                                        array(
                                            'class' => 'tcs-ic-iw-img',
                                            'width' => '574',
                                            'height' => '371',
                                            'alt'   => esc_attr( $image_alt ),
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tcs-text-col bagels-wysiwyg-content">
                            <!-- Output heading from ACF text field -->
                            <h2><?php echo esc_html( $tailgate_our_services_heading ); ?></h2>
                            <!-- Output service list items from ACF repeater field -->
                            <?php if ( $tailgate_our_services_list ) : ?>
                                <ul>
                                    <?php foreach ( $tailgate_our_services_list as $service_item ) : ?>
                                        <li><?php echo esc_html( $service_item['service_item'] ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Why Work With Us Section -->
            <?php if ( $tailgate_why_work_with_us_image || $tailgate_why_work_with_us_heading || $tailgate_why_work_with_us_list ) : ?>
                <div class="bg-two-col-sect switch-cols">
                    <div class="tcs-1 bagels-flex bagels-align-top">
                        <div class="tcs-img-col has-text">
                            <div class="tcs-ic-img-wrapper has-border-rad img-normal">
                                <?php
                                if ( $tailgate_why_work_with_us_image ) {
                                    // Support both "Image ID" and "Image Array" return formats from ACF
                                    $image_id = is_array( $tailgate_why_work_with_us_image ) 
                                        ? $tailgate_why_work_with_us_image['ID'] 
                                        : $tailgate_why_work_with_us_image;
                                    
                                    // Get alt text from array or post meta
                                    $image_alt = is_array( $tailgate_why_work_with_us_image )
                                        ? ( $tailgate_why_work_with_us_image['alt'] ?? '' )
                                        : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                                    
                                    // Output WordPress image with proper attributes
                                    echo wp_get_attachment_image(
                                        $image_id,
                                        'large',
                                        false,
                                        array(
                                            'class' => 'tcs-ic-iw-img',
                                            'width' => '574',
                                            'height' => '371',
                                            'alt'   => esc_attr( $image_alt ),
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tcs-text-col bagels-wysiwyg-content">
                            <!-- Output heading from ACF text field -->
                            <h2><?php echo esc_html( $tailgate_why_work_with_us_heading ); ?></h2>
                            <!-- Output benefits list items from ACF repeater field -->
                            <?php if ( $tailgate_why_work_with_us_list ) : ?>
                                <ul>
                                    <?php foreach ( $tailgate_why_work_with_us_list as $benefit_item ) : ?>
                                        <li><?php echo esc_html( $benefit_item['benefit_item'] ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Who Benefits Section -->
            <?php if ( $tailgate_who_benefits_image || $tailgate_who_benefits_heading || $tailgate_who_benefits_list ) : ?>
                <div class="bg-two-col-sect">
                    <div class="tcs-1 bagels-flex bagels-align-center">
                        <div class="tcs-img-col has-text">
                            <div class="tcs-ic-img-wrapper has-border-rad img-normal">
                                <?php
                                if ( $tailgate_who_benefits_image ) {
                                    // Support both "Image ID" and "Image Array" return formats from ACF
                                    $image_id = is_array( $tailgate_who_benefits_image ) 
                                        ? $tailgate_who_benefits_image['ID'] 
                                        : $tailgate_who_benefits_image;
                                    
                                    // Get alt text from array or post meta
                                    $image_alt = is_array( $tailgate_who_benefits_image )
                                        ? ( $tailgate_who_benefits_image['alt'] ?? '' )
                                        : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                                    
                                    // Output WordPress image with proper attributes
                                    echo wp_get_attachment_image(
                                        $image_id,
                                        'large',
                                        false,
                                        array(
                                            'class' => 'tcs-ic-iw-img',
                                            'width' => '574',
                                            'height' => '371',
                                            'alt'   => esc_attr( $image_alt ),
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tcs-text-col bagels-wysiwyg-content">
                            <!-- Output heading from ACF text field -->
                            <h2><?php echo esc_html( $tailgate_who_benefits_heading ); ?></h2>
                            <!-- Output beneficiaries list items from ACF repeater field -->
                            <?php if ( $tailgate_who_benefits_list ) : ?>
                                <ul>
                                    <?php foreach ( $tailgate_who_benefits_list as $beneficiary_item ) : ?>
                                        <li><?php echo esc_html( $beneficiary_item['beneficiary_item'] ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Related Services Section -->
    <div class="pc-ss-ms-related-services dark-owl-dots">
        <div class="pc-ss-main-sect pc-ss-related-projects h-p-ul-m-0">
            <div class="vc-theme-title vc-tt-align-center vc-tt-dark">
                <div class="vc-tt-sub-title">
                    <!-- Output subtitle from ACF text field -->
                    <div class="vc-tt-st-1"><?php echo esc_html( $tailgate_related_services_subtitle ); ?></div>
                </div>
                <!-- Output title from ACF text field -->
                <h2 class="vc-tt-title"><?php echo esc_html( $tailgate_related_services_title ); ?></h2>
            </div>
            <!-- Owl Carousel container for related services -->
            <!-- Dynamic carousel items loaded from ACF repeater field -->
            <!-- Note: Owl Carousel automatically creates owl-stage-outer and owl-stage divs on initialization -->
            <?php if ( $tailgate_related_services_items ) : ?>
                <div class="pc-ss-rp-list owl-carousel">
                    <?php foreach ( $tailgate_related_services_items as $service_item ) : ?>
                        <?php
                        // Get service item data from repeater row
                        $service_image = $service_item['service_image'];
                        $service_title = $service_item['service_title'];
                        $service_description = $service_item['service_description'];
                        $service_link = $service_item['service_link'];
                        $service_icon_class = $service_item['service_icon_class'];
                        
                        // Process image - support both "Image ID" and "Image Array" return formats from ACF
                        $image_id = is_array( $service_image ) ? $service_image['ID'] : $service_image;
                        $image_url = is_array( $service_image ) 
                            ? $service_image['url'] 
                            : wp_get_attachment_image_url( $image_id, 'full' );
                        
                        // Get alt text from image array or post meta
                        $image_alt = is_array( $service_image )
                            ? ( $service_image['alt'] ?? '' )
                            : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        
                        // Use service title as alt text fallback if image alt is empty
                        $final_alt = $image_alt ?: $service_title;
                        
                        // Default icon class if not provided
                        $icon_class = $service_icon_class ?: 'lorry-with-cargo';
                        
                        // Default link if not provided
                        $final_link = $service_link ?: '#';
                        ?>
                        <!-- Single service card item in carousel -->
                        <!-- Owl Carousel will automatically wrap this in owl-item div and add inline styles -->
                        <div class="service-single-box">
                            <!-- Service card link - wraps entire card for clickable area -->
                            <a href="<?php echo esc_url( $final_link ); ?>"
                               title="<?php echo esc_attr( $service_title ); ?>"
                               class="pc-as-s-s-1 bagels-float-on-hover"
                               style="height: 563.482px;">
                                <!-- Service image at top of card -->
                                <div class="pc-as-s-s-top bagels-pos-relative bagels-overlay">
                                    <?php if ( $image_url ) : ?>
                                        <img src="<?php echo esc_url( $image_url ); ?>"
                                             alt="<?php echo esc_attr( $final_alt ); ?>"
                                             class="pc-as-s-s-t-img bagels-cover-img">
                                    <?php endif; ?>
                                </div>
                                <!-- Service content at bottom of card -->
                                <div class="pc-as-s-s-bottom">
                                    <!-- Service icon sprite -->
                                    <div class="pc-as-s-s-b-image">
                                        <div class="pc-as-s-s-b-i-1 bagels-sprite bagels-filter-black-to-red <?php echo esc_attr( $icon_class ); ?>"></div>
                                    </div>
                                    <!-- Service text content -->
                                    <div class="pc-as-s-s-b-text">
                                        <!-- Service title from ACF field -->
                                        <h2 class="pc-as-s-s-b-t-title bagels-ff-gilroy-bold">
                                            <?php echo esc_html( $service_title ); ?>
                                        </h2>
                                        <!-- Service description from ACF field -->
                                        <p class="pc-as-s-s-b-t-descr bagels-trans-p-2">
                                            <?php echo esc_html( $service_description ); ?>
                                        </p>
                                        <!-- View more link -->
                                        <div class="pc-as-s-s-b-t-link">
                                            <span class="pc-as-s-s-b-t-1">View more</span>
                                            <span class="pc-as-s-s-b-t-icon"><i class="fas fa-angle-double-right"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- ==============================================================
     OWL CAROUSEL INITIALIZATION SCRIPT
     ============================================================== -->
<script>
    // Wait for DOM to be fully loaded before initializing carousel
    document.addEventListener("DOMContentLoaded", function () {
        // Check if jQuery is loaded (required for Owl Carousel)
        if (typeof jQuery === "undefined" || typeof jQuery.fn.owlCarousel === "undefined") {
            return; // Exit if jQuery or Owl Carousel is not available
        }
        
        // Use jQuery shorthand
        var $ = jQuery;
        
        // Select the carousel element using jQuery
        var $carousel = $(".pc-ss-rp-list.owl-carousel");
        
        // Exit if carousel element doesn't exist
        if (!$carousel.length) {
            return;
        }
        
        // Only initialize if carousel hasn't been initialized yet
        // Check if carousel exists and has child items before initializing
        if (!$carousel.hasClass("owl-loaded") && $carousel.children().length > 0) {
            // Initialize Owl Carousel with configuration options
            $carousel.owlCarousel({
                loop: true,        // Enable infinite loop
                margin: 30,        // Space between items (30px)
                nav: true,         // Show navigation arrows
                dots: true,        // Show pagination dots
                navText: [         // Custom navigation arrow icons
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>'
                ],
                responsive: {      // Responsive breakpoints
                    0: { items: 1 },      // Mobile: 1 item per slide
                    768: { items: 2 },    // Tablet: 2 items per slide
                    1200: { items: 3 }   // Desktop: 3 items per slide
                }
            });
        }
    });
</script>

<?php
// Load WordPress footer template (includes closing HTML tags, scripts, etc.)
get_footer();
?>
