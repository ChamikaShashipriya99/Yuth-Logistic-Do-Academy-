<?php
/**
 * Template for displaying single Service CPT posts.
 *
 * This template is used for all service custom post type posts.
 * It dynamically loads ACF fields based on the service post slug.
 *
 * @package Youth_Logistic
 */

// Load WordPress header template (includes navigation, stylesheets, etc.)
get_header();

// Get theme directory URI for asset paths (images, CSS, JS)
$theme_uri = get_template_directory_uri();

// Get current service post
$service_slug = get_post_field( 'post_name', get_the_ID() );

// ==============================================================
// ACF FIELD RETRIEVAL
// ==============================================================
// Map service slugs to their ACF field prefixes
// This allows different services to use different ACF field groups
$field_prefix_map = array(
    'tailgate-haul-truck-with-forklift-service' => 'tailgate',
    'onsite-forklift-hire'                      => 'onsite_forklift',
    'metro-regional-same-day-delivery'          => 'metro_&_regional_same-day_delivery',
    'pallet-transport'                          => 'pallet_transport',
    // Add more service slugs and their field prefixes as needed
);

$field_prefix = $field_prefix_map[ $service_slug ] ?? 'service';

// Debug: Uncomment the line below to see what slug and prefix are being used
// echo '<!-- Debug: Service Slug: ' . esc_html( $service_slug ) . ' | Field Prefix: ' . esc_html( $field_prefix ) . ' -->';

// Page Header Banner Title
$header_title = get_field( $field_prefix . '_header_title' ) ?: get_the_title();

// Gallery Images - Repeater field
$gallery_images = get_field( $field_prefix . '_gallery_images' );

// Service Overview Section
$service_overview_heading = get_field( $field_prefix . '_service_overview_heading' );
$service_overview_content = get_field( $field_prefix . '_service_overview_content' );

// Our Services Section
$our_services_image = get_field( $field_prefix . '_our_services_image' );
$our_services_heading = get_field( $field_prefix . '_our_services_heading' );
$our_services_list = get_field( $field_prefix . '_our_services_list' );

// Why Work With Us Section
$why_work_with_us_image = get_field( $field_prefix . '_why_work_with_us_image' );
$why_work_with_us_heading = get_field( $field_prefix . '_why_work_with_us_heading' );
$why_work_with_us_list = get_field( $field_prefix . '_why_work_with_us_list' );

// Who Benefits Section
$who_benefits_image = get_field( $field_prefix . '_who_benefits_image' );
$who_benefits_heading = get_field( $field_prefix . '_who_benefits_heading' );
$who_benefits_list = get_field( $field_prefix . '_who_benefits_list' );

// Related Services Section
$related_services_subtitle = get_field( $field_prefix . '_related_services_subtitle' );
$related_services_title = get_field( $field_prefix . '_related_services_title' );
$related_services_items = get_field( $field_prefix . '_related_services_items' );
?>

<!-- Sprite override for local assets -->
<style>
    .bagels-sprite {
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
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
                <?php echo esc_html( $header_title ); ?>
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
        <div class="pc-ss-mc-gallery">
            <div class="gallery-grid-style-1 box-count-4 mob-box-count-3 box-count-over-4 box-count-over-3">
                <div class="ggs1-1">
                    <?php if ( $gallery_images ) : ?>
                        <?php foreach ( $gallery_images as $gallery_item ) : ?>
                            <?php
                            // Get image data from repeater row
                            $image = $gallery_item['gallery_image'];
                            $image_id = is_array( $image ) ? $image['ID'] : $image;
                            
                            // Get image URL
                            $image_url = is_array( $image ) ? $image['url'] : wp_get_attachment_image_url( $image_id, 'full' );
                            
                            // Get alt text
                            $image_alt = is_array( $image ) 
                                ? ( $image['alt'] ?? '' ) 
                                : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                            
                            // Use custom alt text from repeater if provided
                            $custom_alt = $gallery_item['gallery_image_alt'] ?: $image_alt;
                            ?>
                            <div class="ggs1-single">
                                <a href="<?php echo esc_url( $image_url ); ?>"
                                   data-fancybox="media-grid"
                                   class="ggs1-s-1">
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
            <?php if ( $service_overview_heading || $service_overview_content ) : ?>
                <div class="bg-two-col-sect">
                    <div class="tcs-1 bagels-flex bagels-align-center">
                        <div class="tcs-text-col bagels-wysiwyg-content">
                            <?php if ( $service_overview_heading ) : ?>
                                <h2><?php echo esc_html( $service_overview_heading ); ?></h2>
                            <?php endif; ?>
                            <?php if ( $service_overview_content ) : ?>
                                <p style="text-align: left;">
                                    <?php echo wp_kses_post( $service_overview_content ); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Our Services Section -->
            <?php if ( $our_services_image || $our_services_heading || $our_services_list ) : ?>
                <div class="bg-two-col-sect">
                    <div class="tcs-1 bagels-flex bagels-align-center">
                        <div class="tcs-img-col has-text">
                            <div class="tcs-ic-img-wrapper has-border-rad img-normal">
                                <?php
                                if ( $our_services_image ) {
                                    $image_id = is_array( $our_services_image ) 
                                        ? $our_services_image['ID'] 
                                        : $our_services_image;
                                    
                                    $image_alt = is_array( $our_services_image )
                                        ? ( $our_services_image['alt'] ?? '' )
                                        : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                                    
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
                            <?php if ( $our_services_heading ) : ?>
                                <h2><?php echo esc_html( $our_services_heading ); ?></h2>
                            <?php endif; ?>
                            <?php if ( $our_services_list ) : ?>
                                <ul>
                                    <?php foreach ( $our_services_list as $service_item ) : ?>
                                        <li><?php echo esc_html( $service_item['service_item'] ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Why Work With Us Section -->
            <?php if ( $why_work_with_us_image || $why_work_with_us_heading || $why_work_with_us_list ) : ?>
                <div class="bg-two-col-sect switch-cols">
                    <div class="tcs-1 bagels-flex bagels-align-top">
                        <div class="tcs-img-col has-text">
                            <div class="tcs-ic-img-wrapper has-border-rad img-normal">
                                <?php
                                if ( $why_work_with_us_image ) {
                                    $image_id = is_array( $why_work_with_us_image ) 
                                        ? $why_work_with_us_image['ID'] 
                                        : $why_work_with_us_image;
                                    
                                    $image_alt = is_array( $why_work_with_us_image )
                                        ? ( $why_work_with_us_image['alt'] ?? '' )
                                        : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                                    
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
                            <?php if ( $why_work_with_us_heading ) : ?>
                                <h2><?php echo esc_html( $why_work_with_us_heading ); ?></h2>
                            <?php endif; ?>
                            <?php if ( $why_work_with_us_list ) : ?>
                                <ul>
                                    <?php foreach ( $why_work_with_us_list as $benefit_item ) : ?>
                                        <li><?php echo esc_html( $benefit_item['benefit_item'] ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Who Benefits Section -->
            <?php if ( $who_benefits_image || $who_benefits_heading || $who_benefits_list ) : ?>
                <div class="bg-two-col-sect">
                    <div class="tcs-1 bagels-flex bagels-align-center">
                        <div class="tcs-img-col has-text">
                            <div class="tcs-ic-img-wrapper has-border-rad img-normal">
                                <?php
                                if ( $who_benefits_image ) {
                                    $image_id = is_array( $who_benefits_image ) 
                                        ? $who_benefits_image['ID'] 
                                        : $who_benefits_image;
                                    
                                    $image_alt = is_array( $who_benefits_image )
                                        ? ( $who_benefits_image['alt'] ?? '' )
                                        : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                                    
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
                            <?php if ( $who_benefits_heading ) : ?>
                                <h2><?php echo esc_html( $who_benefits_heading ); ?></h2>
                            <?php endif; ?>
                            <?php if ( $who_benefits_list ) : ?>
                                <ul>
                                    <?php foreach ( $who_benefits_list as $beneficiary_item ) : ?>
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
    <?php if ( $related_services_subtitle || $related_services_title || $related_services_items ) : ?>
        <div class="pc-ss-ms-related-services dark-owl-dots">
            <div class="pc-ss-main-sect pc-ss-related-projects h-p-ul-m-0">
                <div class="vc-theme-title vc-tt-align-center vc-tt-dark">
                    <?php if ( $related_services_subtitle ) : ?>
                        <div class="vc-tt-sub-title">
                            <div class="vc-tt-st-1"><?php echo esc_html( $related_services_subtitle ); ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if ( $related_services_title ) : ?>
                        <h2 class="vc-tt-title"><?php echo esc_html( $related_services_title ); ?></h2>
                    <?php endif; ?>
                </div>
                <?php if ( $related_services_items ) : ?>
                    <div class="pc-ss-rp-list owl-carousel">
                        <?php foreach ( $related_services_items as $service_item ) : ?>
                            <?php
                            $service_image = $service_item['service_image'];
                            $service_title = $service_item['service_title'];
                            $service_description = $service_item['service_description'];
                            $service_link = $service_item['service_link'];
                            $service_icon_class = $service_item['service_icon_class'];
                            
                            $image_id = is_array( $service_image ) ? $service_image['ID'] : $service_image;
                            $image_url = is_array( $service_image ) 
                                ? $service_image['url'] 
                                : wp_get_attachment_image_url( $image_id, 'full' );
                            
                            $image_alt = is_array( $service_image )
                                ? ( $service_image['alt'] ?? '' )
                                : get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                            
                            $final_alt = $image_alt ?: $service_title;
                            $icon_class = $service_icon_class ?: 'lorry-with-cargo';
                            $final_link = $service_link ?: '#';
                            ?>
                            <div class="service-single-box">
                                <a href="<?php echo esc_url( $final_link ); ?>"
                                   title="<?php echo esc_attr( $service_title ); ?>"
                                   class="pc-as-s-s-1 bagels-float-on-hover"
                                   style="height: 563.482px;">
                                    <div class="pc-as-s-s-top bagels-pos-relative bagels-overlay">
                                        <?php if ( $image_url ) : ?>
                                            <img src="<?php echo esc_url( $image_url ); ?>"
                                                 alt="<?php echo esc_attr( $final_alt ); ?>"
                                                 class="pc-as-s-s-t-img bagels-cover-img">
                                        <?php endif; ?>
                                    </div>
                                    <div class="pc-as-s-s-bottom">
                                        <div class="pc-as-s-s-b-image">
                                            <div class="pc-as-s-s-b-i-1 bagels-sprite bagels-filter-black-to-red <?php echo esc_attr( $icon_class ); ?>"></div>
                                        </div>
                                        <div class="pc-as-s-s-b-text">
                                            <h2 class="pc-as-s-s-b-t-title bagels-ff-gilroy-bold">
                                                <?php echo esc_html( $service_title ); ?>
                                            </h2>
                                            <p class="pc-as-s-s-b-t-descr bagels-trans-p-2">
                                                <?php echo esc_html( $service_description ); ?>
                                            </p>
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
    <?php endif; ?>
</div>

<!-- ==============================================================
     OWL CAROUSEL INITIALIZATION SCRIPT
     ============================================================== -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof jQuery === "undefined" || typeof jQuery.fn.owlCarousel === "undefined") {
            return;
        }
        
        var $ = jQuery;
        var $carousel = $(".pc-ss-rp-list.owl-carousel");
        
        if (!$carousel.length) {
            return;
        }
        
        if (!$carousel.hasClass("owl-loaded") && $carousel.children().length > 0) {
            $carousel.owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots: true,
                navText: [
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>'
                ],
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    1200: { items: 3 }
                }
            });
        }
    });
</script>

<?php
// Load WordPress footer template
get_footer();
?>

