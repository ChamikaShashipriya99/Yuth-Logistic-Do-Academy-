<?php
/**
 * Template Name: About Us
 *
 * Static About Us page template without ACF fields.
 * All content is hardcoded for simple editing.
 */

get_header();
?>

<!-- ====== PAGE HEADER BANNER ====== -->
<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">About Us</h1>
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
                        <div class="tcs-img-col has-text">
                            <div class="tcs-ic-img-wrapper img-large">
                                <img class="tcs-ic-iw-img" src="<?php echo esc_url( get_template_directory_uri() . '/images/About-page.jpg' ); ?>" width="645" height="351" alt="yuth-logistics-HQ">
                            </div>
                        </div>
                        <div class="tcs-text-col bagels-wysiwyg-content">
                            <h2>Know Us Better</h2>
                            <p style="text-align: left;">At Yuth Logistics, we're a family-owned business proudly delivering fast, secure, and professional transport solutions across Melbourne's Southeast. Since starting out in 2016, we've built 9 years of experience helping businesses of all sizes keep their operations running smoothly. Whether you need pallet transport, forklift deliveries, tail lift services, or commercial freight, we've got the right team and equipment to get the job done safely and on time.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ====== ABOUT US PAGE CONTENT ====== -->
            <div class="pg-au-content bagels-wysiwyg-content">

                <!-- Intro Paragraph -->
                <div class="wp-block-spacer" style="height: 40px;" aria-hidden="true"></div>
                <p class="full-length">
                    From job sites and warehouses to small businesses and major corporations, we provide reliable services tailored to your needs. We specialize in moving building supplies, machinery, and bulk goods, always ensuring secure handling from pickup to delivery.
                    <br><br>
                    At Yuth Logistics, we genuinely care about delivering hassle-free, cost-effective solutions you can count on. Our goal is simple—help you move what matters most, without delays or stress. When you work with us, you're choosing a team committed to professionalism, safety, and exceptional service every step of the way.
                </p>

                <!-- What We Offer Section -->
                <div class="wp-block-spacer" style="height: 65px;" aria-hidden="true"></div>
                <h2 class="wp-block-heading has-text-align-center">What We Offer</h2>
                <div class="wp-block-spacer" style="height: 1px;" aria-hidden="true"></div>

                <!-- Service: Point A to B Transport -->
                <h4 class="wp-block-heading has-text-align-center">Point A to B Transport</h4>
                <p class="has-text-align-center">
                    Our drivers efficiently load and transport goods, ensuring safe, on-time, and reliable deliveries from Point A to Point B.
                </p>
                <div class="wp-block-spacer" style="height: 20px;" aria-hidden="true"></div>

                <!-- Service: Onsite Forklift Hire -->
                <h4 class="wp-block-heading has-text-align-center">Onsite Forklift Hire</h4>
                <p class="has-text-align-center">
                    We provide onsite forklift hire with skilled operators and high-performance equipment to handle heavy loads at job sites, warehouses, or business locations.
                </p>
                <div class="wp-block-spacer" style="height: 20px;" aria-hidden="true"></div>

                <!-- Service: Metro & Regional SAME-DAY Deliveries -->
                <h4 class="wp-block-heading has-text-align-center">Metro &amp; Regional SAME-DAY Deliveries</h4>
                <p class="has-text-align-center">
                    We offer same-day delivery services across metro and regional areas, ensuring your shipments arrive quickly and without delays.
                </p>
                <div class="wp-block-spacer" style="height: 20px;" aria-hidden="true"></div>

                <!-- Service: Pallet Transport -->
                <h4 class="wp-block-heading has-text-align-center">Pallet Transport</h4>
                <p class="has-text-align-center">
                    From warehouses to job sites, our palletised freight transport ensures safe, efficient, and streamlined logistics to keep your supply chain moving.
                </p>
                <div class="wp-block-spacer" style="height: 20px;" aria-hidden="true"></div>

                <!-- Service: Tailgate, Forklift & Truck Deliveries -->
                <h4 class="wp-block-heading has-text-align-center">Tailgate, Forklift &amp; Truck Deliveries</h4>
                <p class="has-text-align-center">
                    Our tailgate, Truck and forklift delivery services are designed for oversized, fragile, or heavy shipments, ensuring secure and efficient handling.
                </p>

                <!-- Separator -->
                <div class="wp-block-spacer" style="height: 28px;" aria-hidden="true"></div>
                <hr class="wp-block-separator has-text-color has-cyan-bluish-gray-color has-alpha-channel-opacity has-cyan-bluish-gray-background-color has-background bagels-hr is-style-default hr-thin hr-pale">
                <div class="wp-block-spacer" style="height: 28px;" aria-hidden="true"></div>

                <!-- Our Vision -->
                <h2 class="wp-block-heading has-text-align-center">Our Vision</h2>
                <p class="has-text-align-center">
                    To be the trusted transport provider, recognised for exceptional service,
                    <br>
                    experienced operators, and dependable solutions that keep businesses moving.
                </p>
                <div class="wp-block-spacer" style="height: 15px;" aria-hidden="true"></div>

                <!-- Our Mission -->
                <h2 class="wp-block-heading has-text-align-center">Our Mission</h2>
                <p class="has-text-align-center">
                    To deliver fast, reliable, and efficient transport services, focusing on exceptional service, skilled operators, and dependable solutions. We ensure safe handling and on-time deliveries, helping businesses streamline operations and confidently move forward.
                </p>

            </div>

            <!-- ====== RELATED SERVICES CAROUSEL ====== -->
            <div class="pg-au-related-services dark-owl-dots h-p-ul-m-0">
                <div class="vc-theme-title vc-tt-align-center vc-tt-dark">
                    <div class="vc-tt-sub-title">
                        <div class="vc-tt-st-1">Our Services</div>
                    </div>
                    <h2 class="vc-tt-title">Expert Logistics Services</h2>
                </div>
                <div class="pg-au-services ph-svs-services">
                    <div class="pg-au-rs-list ph-svs-s-1 owl-carousel">
                        <?php echo services(); ?>
                    </div>
                </div>
                <!-- View All Services Button -->
                <div class="ph-svs-read-more txt-center" style="margin-top: 30px;">
                    <div class="vc-theme-button vc-tb-center">
                        <a title="View All Services" target="_self" href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>">
                            View All Services <i class="fas fa-angle-double-right"></i>
                        </a>
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

