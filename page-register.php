<?php
/* Template Name: DoRegister – Registration */
get_header();
?>
<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">Register Page</h1>
        </div>
    </div>
</div>

<div class="doregister-page doregister-page-register">
    <?php
    // Multi-step registration form
    echo do_shortcode( '[doregister_form]' );
    ?>
</div>

<?php
get_footer();