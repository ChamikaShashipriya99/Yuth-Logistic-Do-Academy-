<?php
/* Template Name: DoRegister – Profile */
get_header();

// ACF-backed fields without fallbacks
$profile_title     = get_field( 'profile_title' );
$profile_shortcode = get_field( 'profile_shortcode' );
?>
<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
				<?php echo esc_html( $profile_title ); ?>
			</h1>
        </div>
    </div>
</div>

<div class="doregister-page doregister-page-profile">
    <?php
    // Frontend profile view + logout (ACF-controlled shortcode)
    echo do_shortcode( $profile_shortcode );
    ?>
</div>

<?php
get_footer();