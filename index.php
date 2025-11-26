<?php
get_header();
?>
<main id="primary" class="site-main container">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
    else :
        ?>
        <p><?php esc_html_e( 'Content will appear here once you add posts or pages.', 'youth-logistic' ); ?></p>
        <?php
    endif;
    ?>
</main>
<?php
get_footer();

