<?php
/**
 * Template Name: Contact Page
 *
 * Static Contact page template mirroring the About Us template structure.
 * Content is hardcoded for simple editing; adjust markup as needed.
 */

get_header();
?>

<!-- ====== PAGE HEADER BANNER ====== -->
<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">Contact Us</h1>
        </div>
    </div>
</div>

<!-- ============================================
     CONTACT PAGE CONTENT
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
                            <h2>Get In Touch</h2>
                            <p style="text-align: left;">At Yuth Logistics, we’re always ready to help with fast, secure, and professional transport solutions across Melbourne’s Southeast. Whether you need pallet transport, forklift deliveries, tail lift services, or time-critical freight, our local team is here to support your next delivery.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ====== CONTACT PAGE CONTENT ====== -->
            <div class="pg-au-content bagels-wysiwyg-content">

                <!-- Intro Paragraph -->
                <div class="wp-block-spacer" style="height: 40px;" aria-hidden="true"></div>
                <p class="full-length">
                    Use the form below or reach us directly via phone or email to discuss your logistics needs.
                    <br><br>
                    We specialise in moving building supplies, machinery, and bulk goods across metro and regional areas, ensuring safe handling from pickup to delivery.
                </p>

                <!-- What We Offer Section -->
                <div class="wp-block-spacer" style="height: 65px;" aria-hidden="true"></div>
                <h2 class="wp-block-heading has-text-align-center">How We Can Help</h2>
                <div class="wp-block-spacer" style="height: 1px;" aria-hidden="true"></div>

                <!-- Service: Point A to B Transport -->
                <h4 class="wp-block-heading has-text-align-center">Point A to B Transport</h4>
                <p class="has-text-align-center">
                    Straightforward pickup and delivery services with experienced local drivers.
                </p>
                <div class="wp-block-spacer" style="height: 20px;" aria-hidden="true"></div>

                <!-- Service: Onsite Forklift Hire -->
                <h4 class="wp-block-heading has-text-align-center">Onsite Forklift Hire</h4>
                <p class="has-text-align-center">
                    Skilled operators and reliable equipment to tackle heavy loads safely.
                </p>
                <div class="wp-block-spacer" style="height: 20px;" aria-hidden="true"></div>

                <!-- Service: Metro & Regional SAME-DAY Deliveries -->
                <h4 class="wp-block-heading has-text-align-center">Metro &amp; Regional SAME-DAY Deliveries</h4>
                <p class="has-text-align-center">
                    Same-day delivery coverage across metro Melbourne and regional corridors.
                </p>
                <div class="wp-block-spacer" style="height: 20px;" aria-hidden="true"></div>

                <!-- Service: Pallet Transport -->
                <h4 class="wp-block-heading has-text-align-center">Pallet Transport</h4>
                <p class="has-text-align-center">
                    Palletised freight handled with care to keep your supply chain moving.
                </p>
                <div class="wp-block-spacer" style="height: 20px;" aria-hidden="true"></div>

                <!-- Service: Tailgate, Forklift & Truck Deliveries -->
                <h4 class="wp-block-heading has-text-align-center">Tailgate, Forklift &amp; Truck Deliveries</h4>
                <p class="has-text-align-center">
                    Tailgate trucks, forklifts, and experienced crews for oversized or fragile shipments.
                </p>

                <!-- Separator -->
                <div class="wp-block-spacer" style="height: 28px;" aria-hidden="true"></div>
                <hr class="wp-block-separator has-text-color has-cyan-bluish-gray-color has-alpha-channel-opacity has-cyan-bluish-gray-background-color has-background bagels-hr is-style-default hr-thin hr-pale">
                <div class="wp-block-spacer" style="height: 28px;" aria-hidden="true"></div>

                <!-- Contact Information -->
                <h2 class="wp-block-heading has-text-align-center">Contact Information</h2>
                <p class="has-text-align-center">
                    Phone: <a href="tel:+0423030433">+042 30 30 433</a><br>
                    Email: <a href="mailto:admin@yuthlogistics.com.au">admin@yuthlogistics.com.au</a><br>
                    Location: Beaconsfield, Victoria 3807
                </p>
                <div class="wp-block-spacer" style="height: 15px;" aria-hidden="true"></div>

                <!-- Placeholder for Form Shortcode if needed -->
                <div class="wp-block-spacer" style="height: 30px;" aria-hidden="true"></div>
                <div class="contact-form-placeholder bagels-wysiwyg-content" style="text-align: center;">
                    <!-- Replace with CF7 shortcode if desired -->
                    <p>Embed your Contact Form 7 shortcode here.</p>
                </div>

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


