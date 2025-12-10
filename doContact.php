<?php
/**
 * Template Name: Do Contact page
 *
 * Contact page template that renders the hero banner plus the
 * in-page Contact Form 7 instance used across the marketing site.
 */

get_header();
?>

<!-- ============================================
     PAGE HEADER BANNER
     ============================================ -->
<?php
// Resolve the current page ID for ACF lookups.
$contact_page_id = get_queried_object_id();

// Header fields (ACF).
$header_title = $contact_page_id ? get_field( 'docontact_header_title', $contact_page_id ) : '';

// Section heading/subtitle (ACF).
$section_subtitle = $contact_page_id ? get_field( 'docontact_subtitle', $contact_page_id ) : '';
$section_title    = $contact_page_id ? get_field( 'docontact_title', $contact_page_id ) : '';

// Form shortcode (ACF).
$form_shortcode = $contact_page_id ? get_field( 'docontact_shortcode', $contact_page_id ) : '';
?>

<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
                <?php echo esc_html( $header_title ); ?>
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
                        <?php if ( $section_subtitle ) : ?>
                            <div class="vc-tt-st-1"><?php echo esc_html( $section_subtitle ); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php if ( $section_title ) : ?>
                        <h2 class="vc-tt-title"><?php echo esc_html( $section_title ); ?></h2>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="ptc-form">
                        <?php
                        // Render the configurable shortcode (defaults to [docontact_form]).
                        echo do_shortcode( $form_shortcode );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();

