<?php
/**
 * Template Name: Contact page
 *
 * Contact page template that renders the hero banner plus the
 * in-page Contact Form 7 instance used across the marketing site.
 */

get_header();
?>

<!-- ============================================
     PAGE HEADER BANNER
     ============================================ -->
<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">Contact Us</h1>
        </div>
    </div>
</div>

<!-- ============================================
     CONTACT FORM SECTION
     ============================================ -->
<div class="contact-form-section page-container pg-temp-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="vc-theme-title vc-tt-align-center vc-tt-dark">
                    <div class="vc-tt-sub-title">
                        <div class="vc-tt-st-1">Get In Touch</div>
                    </div>
                    <h2 class="vc-tt-title">Book Your Logistics</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="ptc-form">
                    <?php
                    echo do_shortcode( '[contact-form-7 id="c88e8e7" title="C1"]' ); // CF7 short code for contact form 1
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();

