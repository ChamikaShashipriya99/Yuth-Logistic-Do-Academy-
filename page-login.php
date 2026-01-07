<?php
/* Template Name: DoRegister – Login */
get_header();

// ACF-backed fields without fallbacks
$login_title     = get_field( 'login_title' );
$login_shortcode = get_field( 'login_shortcode' );
?>

<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
				<?php echo esc_html( $login_title ); ?>
			</h1>
        </div>
    </div>
</div>
<br>

<div class="doregister-page doregister-page-login">
    <?php
    // Custom AJAX login form (ACF-controlled shortcode)
    echo do_shortcode( $login_shortcode );
    ?>
</div>

<?php
get_footer();