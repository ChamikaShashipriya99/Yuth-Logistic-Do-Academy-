<?php
/**
 * 404 Template
 *
 * Displays a custom "Page Not Found" message when a URL
 * does not match any post, page, or other content.
 *
 * This template:
 * - Uses the global header and footer (so navigation and branding stay consistent)
 * - Centers the error message using existing theme container styles
 * - Provides a clear call-to-action back to the homepage
 *
 * @package Youth_Logistic
 */

get_header();
?>

<main id="primary" class="site-main page-container page-404">
    <div class="container">
        <br><br>
        <br><br>
        <br><br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="error-404">
                    <?php esc_html_e( '404', 'youth-logistic' ); ?>
                </div>
                <p class="lead">
                    <?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'youth-logistic' ); ?>
                </p>
                <p>
                    <a class="vc-theme-button-pseudo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php esc_html_e( 'Back to Home', 'youth-logistic' ); ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();


