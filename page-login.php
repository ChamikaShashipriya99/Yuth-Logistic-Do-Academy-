<?php
/* Template Name: DoRegister – Login */
get_header();
?>

<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">Login Page</h1>
        </div>
    </div>
</div>

<div class="doregister-page doregister-page-login">
    <?php
    // Custom AJAX login form
    echo do_shortcode( '[doregister_login]' );
    ?>
</div>

<?php
get_footer();