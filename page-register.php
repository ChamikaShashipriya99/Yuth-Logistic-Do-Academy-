<?php
/* Template Name: DoRegister – Registration */
get_header();

// ACF-backed fields without fallbacks
$register_title     = get_field( 'register_title' );
$register_shortcode = get_field( 'register_shortcode' );
?>
<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
				<?php echo esc_html( $register_title ); ?>
			</h1>
        </div>
    </div>
</div><br>

<div class="doregister-page doregister-page-register">
    <?php
    // Multi-step registration form (ACF-controlled shortcode)
    echo do_shortcode( $register_shortcode );
    ?>
</div>

<?php
get_footer();