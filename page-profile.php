<?php
/* Template Name: DoRegister – Profile */
get_header();
?>
<div class="page-header-banner bagels-overlay">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">Profile Page</h1>
        </div>
    </div>
</div>

<div class="doregister-page doregister-page-profile">
    <?php
    // Frontend profile view + logout
    echo do_shortcode( '[doregister_profile]' );
    ?>
</div>

<?php
get_footer();