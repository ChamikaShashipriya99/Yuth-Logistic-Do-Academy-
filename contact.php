<?php
/**
 * Template Name: Contact
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
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
                <?php echo esc_html( get_field( 'contact_page_heading' ) ?: 'Contact Us' ); ?>
            </h1>
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
                        <div class="vc-tt-st-1">
                            <?php echo esc_html( get_field( 'contact_page_subheading' ) ?: 'Get In Touch' ); ?>
                        </div>
                    </div>
                    <h2 class="vc-tt-title">
                        <?php echo esc_html( get_field( 'contact_page_title' ) ?: 'Book Your Logistics' ); ?>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="ptc-form">
                    <?php
                    $contact_form_shortcode = get_field( 'contact_form_shortcode' );
                    if ( empty( $contact_form_shortcode ) ) {
                        $contact_form_shortcode = '[contact-form-7 id="5" title="Contact form"]';
                    }

                    echo do_shortcode( $contact_form_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();

