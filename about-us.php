<?php
/**
 * Template Name: About Us
 *
 * Dynamic About Us page template powered by ACF fields.
 */

get_header();

// ACF fields for the About Us page.
// These fields are managed via an ACF field group assigned to the "About Us" page template.
$about_header_title           = get_field( 'about_header_title' );
$about_intro_title            = get_field( 'about_intro_title' );
$about_intro_text             = get_field( 'about_intro_text' );
$about_intro_paragraph        = get_field( 'about_intro_paragraph' );
$about_intro_paragraph1       = get_field( 'about_intro_paragraph1' );
$about_intro_image            = get_field( 'about_intro_image' );
$about_what_we_offer_heading  = get_field( 'about_what_we_offer_heading' );
$about_services               = get_field( 'about_services' );
$about_vision_heading         = get_field( 'about_vision_heading' );
$about_vision_text            = get_field( 'about_vision_text' );
$about_mission_heading        = get_field( 'about_mission_heading' );
$about_mission_text           = get_field( 'about_mission_text' );
$about_related_subtitle       = get_field( 'about_related_services_subtitle' );
$about_related_title          = get_field( 'about_related_services_title' );
?>

<!-- ====== PAGE HEADER BANNER ====== -->
<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
                <?php echo esc_html( $about_header_title ); ?>
            </h1>
        </div>
    </div>
</div>

<!-- ============================================
     ABOUT US PAGE CONTENT
     ============================================ -->
<div class="page-container pg-about-us">
    <div class="ph-services">
        <div class="container">
            <div class="pg-au-columns">
                <div class="bg-two-col-sect">
                    <div class="tcs-1 bagels-flex bagels-align-center">
                        <!-- Intro image column (driven by ACF image field "about_intro_image") -->
                        <div class="tcs-img-col has-text">
                            <div class="tcs-ic-img-wrapper img-large">
                                <?php
                                if ( $about_intro_image ) {
                                    // Support both "Image ID" and "Image Array" return formats from ACF.
                                    $image_id = is_array( $about_intro_image ) ? $about_intro_image['ID'] : $about_intro_image;
                                    $image_alt = is_array( $about_intro_image )
                                        ? ( $about_intro_image['alt'] ?? '' )
                                        : get_post_meta( $image_id, '_wp_attachment_image_alt', true );

                                    echo wp_get_attachment_image(
                                        $image_id,
                                        'large',
                                        false,
                                        array(
                                            'class' => 'tcs-ic-iw-img',
                                            'alt'   => esc_attr( $image_alt ),
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <!-- Intro text column (title + short description from ACF) -->
                        <div class="tcs-text-col bagels-wysiwyg-content">
                            <h2><?php echo esc_html( $about_intro_title ); ?></h2>
                            <p style="text-align: left;"><?php echo wp_kses_post( $about_intro_text ); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ====== ABOUT US PAGE CONTENT ====== -->
            <div class="pg-au-content bagels-wysiwyg-content">

                <!-- Intro Paragraph -->
                <div class="wp-block-spacer" style="height: 40px;" aria-hidden="true"></div>
                <p class="full-length">
                    <?php echo wp_kses_post( $about_intro_paragraph ); ?>
                </p>
                <p class="full-length">
                    <?php echo wp_kses_post( $about_intro_paragraph1 ); ?>
                </p>

                <!-- What We Offer Section -->
                <div class="wp-block-spacer" style="height: 65px;" aria-hidden="true"></div>
                <h2 class="wp-block-heading has-text-align-center">
                    <?php echo esc_html( $about_what_we_offer_heading ); ?>
                </h2>
                <div class="wp-block-spacer" style="height: 1px;" aria-hidden="true"></div>

                <?php if ( $about_services ) : ?>
                    <?php foreach ( $about_services as $about_service ) : ?>
                        <h4 class="wp-block-heading has-text-align-center">
                            <?php echo esc_html( $about_service['about_service_title'] ); ?>
                        </h4>
                        <p class="has-text-align-center">
                            <?php echo wp_kses_post( $about_service['about_service_text'] ); ?>
                        </p>
                        <div class="wp-block-spacer" style="height: 20px;" aria-hidden="true"></div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Separator -->
                <div class="wp-block-spacer" style="height: 28px;" aria-hidden="true"></div>
                <hr class="wp-block-separator has-text-color has-cyan-bluish-gray-color has-alpha-channel-opacity has-cyan-bluish-gray-background-color has-background bagels-hr is-style-default hr-thin hr-pale">
                <div class="wp-block-spacer" style="height: 28px;" aria-hidden="true"></div>

                <!-- Our Vision -->
                <h2 class="wp-block-heading has-text-align-center">
                    <?php echo esc_html( $about_vision_heading ); ?>
                </h2>
                <p class="has-text-align-center">
                    <?php echo wp_kses_post( $about_vision_text ); ?>
                </p>
                <div class="wp-block-spacer" style="height: 15px;" aria-hidden="true"></div>

                <!-- Our Mission -->
                <h2 class="wp-block-heading has-text-align-center">
                    <?php echo esc_html( $about_mission_heading ); ?>
                </h2>
                <p class="has-text-align-center">
                    <?php echo wp_kses_post( $about_mission_text ); ?>
                </p>

            </div>

            <!-- ====== RELATED SERVICES CAROUSEL ====== -->
            <div class="pg-au-related-services dark-owl-dots h-p-ul-m-0">
                <div class="vc-theme-title vc-tt-align-center vc-tt-dark">
                    <div class="vc-tt-sub-title">
                        <div class="vc-tt-st-1">
                            <?php echo esc_html( $about_related_subtitle ); ?>
                        </div>
                    </div>
                    <h2 class="vc-tt-title">
                        <?php echo esc_html( $about_related_title ); ?>
                    </h2>
                </div>
                <div class="pg-au-services ph-svs-services">
                    <div class="pg-au-rs-list ph-svs-s-1 owl-carousel">
                        <?php echo services(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="speculationrules">
    {
        "prefetch": [
            {
                "source": "document",
                "where": {
                    "and": [
                        {
                            "href_matches": "\/*"
                        },
                        {
                            "not": {
                                "href_matches": [
                                    "\/wp-*.php",
                                    "\/wp-admin\/*",
                                    "\/wp-content\/uploads\/*",
                                    "\/wp-content\/*",
                                    "\/wp-content\/plugins\/*",
                                    "\/wp-content\/themes\/YuthLogistics\/*",
                                    "\/*\\?(.+)"
                                ]
                            }
                        },
                        {
                            "not": {
                                "selector_matches": "a[rel~=\"nofollow\"]"
                            }
                        },
                        {
                            "not": {
                                "selector_matches": ".no-prefetch, .no-prefetch a"
                            }
                        }
                    ]
                },
                "eagerness": "conservative"
            }
        ]
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof jQuery === "undefined") {
            return;
        }
        var $ = jQuery;
        if (typeof $.fn.owlCarousel === "undefined") {
            return;
        }
        var $carousel = $(".ph-svs-s-1.owl-carousel");
        if (!$carousel.length) {
            return;
        }
        var $nav = $(".ph-svs-nav");
        if (!$nav.length) {
            return;
        }
        var bindNavEvents = function () {
            $nav.find(".ph-svs-prev").off("click.phNav").on("click.phNav", function (event) {
                event.preventDefault();
                $carousel.trigger("prev.owl.carousel");
            });
            $nav.find(".ph-svs-next").off("click.phNav").on("click.phNav", function (event) {
                event.preventDefault();
                $carousel.trigger("next.owl.carousel");
            });
        };
        if ($carousel.hasClass("owl-loaded")) {
            bindNavEvents();
        } else {
            $carousel.on("initialized.owl.carousel", function () {
                bindNavEvents();
            });
        }
    });
</script>
<?php
get_footer();

