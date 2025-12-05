<?php
/**
 * Template Name: Privacy Policy
 *
 * Dynamic Privacy Policy page template powered by ACF fields.
 *
 * @package Youth_Logistic
 */

get_header();

// ACF fields for the Privacy Policy page.
// These fields are managed via an ACF field group assigned to the "Privacy Policy" page template.
$privacy_header_title              = get_field( 'privacy_header_title' );
$privacy_who_we_are_heading       = get_field( 'privacy_who_we_are_heading' );
$privacy_who_we_are_content       = get_field( 'privacy_who_we_are_content' );
$privacy_comments_heading          = get_field( 'privacy_comments_heading' );
$privacy_comments_content          = get_field( 'privacy_comments_content' );
$privacy_media_heading             = get_field( 'privacy_media_heading' );
$privacy_media_content             = get_field( 'privacy_media_content' );
$privacy_cookies_heading           = get_field( 'privacy_cookies_heading' );
$privacy_cookies_content           = get_field( 'privacy_cookies_content' );
$privacy_embedded_content_heading  = get_field( 'privacy_embedded_content_heading' );
$privacy_embedded_content_content  = get_field( 'privacy_embedded_content_content' );
$privacy_share_data_heading        = get_field( 'privacy_share_data_heading' );
$privacy_share_data_content        = get_field( 'privacy_share_data_content' );
$privacy_retain_data_heading       = get_field( 'privacy_retain_data_heading' );
$privacy_retain_data_content       = get_field( 'privacy_retain_data_content' );
$privacy_rights_heading            = get_field( 'privacy_rights_heading' );
$privacy_rights_content            = get_field( 'privacy_rights_content' );
$privacy_data_sent_heading         = get_field( 'privacy_data_sent_heading' );
$privacy_data_sent_content         = get_field( 'privacy_data_sent_content' );
?>

<!-- Privacy Policy Content Styles -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Heebo:wght@300;500&display=swap');
    .privacy-policy-content h2 {
        font-family: 'Heebo', sans-serif;
        font-size: 30px;
        font-weight: 500;
    }
    .privacy-policy-content p {
        font-family: 'Heebo', sans-serif;
        font-size: 20px;
        font-weight: 300;
    }
</style>

<!-- ==============================================================
     PAGE HEADER BANNER
     ============================================================== -->
<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
                <?php echo esc_html( $privacy_header_title ); ?>
            </h1>
        </div>
    </div>
</div>

<!-- ==============================================================
     PRIVACY POLICY CONTENT
     ============================================================== -->
<div class="container page-container pc-default privacy-policy-content">
    <?php if ( $privacy_who_we_are_heading || $privacy_who_we_are_content ) : ?>
        <h2 class="wp-block-heading"><?php echo esc_html( $privacy_who_we_are_heading ); ?></h2>
        <div class="privacy-section-content">
            <?php echo wp_kses_post( $privacy_who_we_are_content ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $privacy_comments_heading || $privacy_comments_content ) : ?>
        <h2 class="wp-block-heading"><?php echo esc_html( $privacy_comments_heading ); ?></h2>
        <div class="privacy-section-content">
            <?php echo wp_kses_post( $privacy_comments_content ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $privacy_media_heading || $privacy_media_content ) : ?>
        <h2 class="wp-block-heading"><?php echo esc_html( $privacy_media_heading ); ?></h2>
        <div class="privacy-section-content">
            <?php echo wp_kses_post( $privacy_media_content ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $privacy_cookies_heading || $privacy_cookies_content ) : ?>
        <h2 class="wp-block-heading"><?php echo esc_html( $privacy_cookies_heading ); ?></h2>
        <div class="privacy-section-content">
            <?php echo wp_kses_post( $privacy_cookies_content ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $privacy_embedded_content_heading || $privacy_embedded_content_content ) : ?>
        <h2 class="wp-block-heading"><?php echo esc_html( $privacy_embedded_content_heading ); ?></h2>
        <div class="privacy-section-content">
            <?php echo wp_kses_post( $privacy_embedded_content_content ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $privacy_share_data_heading || $privacy_share_data_content ) : ?>
        <h2 class="wp-block-heading"><?php echo esc_html( $privacy_share_data_heading ); ?></h2>
        <div class="privacy-section-content">
            <?php echo wp_kses_post( $privacy_share_data_content ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $privacy_retain_data_heading || $privacy_retain_data_content ) : ?>
        <h2 class="wp-block-heading"><?php echo esc_html( $privacy_retain_data_heading ); ?></h2>
        <div class="privacy-section-content">
            <?php echo wp_kses_post( $privacy_retain_data_content ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $privacy_rights_heading || $privacy_rights_content ) : ?>
        <h2 class="wp-block-heading"><?php echo esc_html( $privacy_rights_heading ); ?></h2>
        <div class="privacy-section-content">
            <?php echo wp_kses_post( $privacy_rights_content ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $privacy_data_sent_heading || $privacy_data_sent_content ) : ?>
        <h2 class="wp-block-heading"><?php echo esc_html( $privacy_data_sent_heading ); ?></h2>
        <div class="privacy-section-content">
            <?php echo wp_kses_post( $privacy_data_sent_content ); ?>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
?>

