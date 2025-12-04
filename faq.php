<?php
/**
 * Template Name: FAQs
 *
 * Dynamic Frequently Asked Questions page template.
 * Renders the FAQ header banner title and FAQ items from ACF fields.
 *
 * @package Youth_Logistic
 */

get_header();

// ACF fields for this page.
$faq_header_title = get_field( 'faq_header_title' );
$faq_items        = get_field( 'faq_items' );
?>

<!-- ==============================================================
     PAGE HEADER BANNER
     ============================================================== -->
<div class="page-header-banner bagels-overlay ">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
                <?php echo esc_html( $faq_header_title ); ?>
            </h1>
        </div>
    </div>
    </div>

<!-- ==============================================================
     FAQ CONTENT
     ============================================================== -->
<div class="container page-container pc-archive-faqs h-p-ul-m-0">
    <div class="pc-af-faqs">
        <div class="pc-af-t-1 bagels-flex-wrap bagels-flex">
            <?php if ( $faq_items ) : ?>
                <?php foreach ( $faq_items as $faq_item ) : ?>
                    <div class="single-faq">
                        <h3 class="sfaq-question bagels-before-pos-absolute bagels-pos-relative">
                            <?php echo esc_html( $faq_item['faq_question'] ); ?>
                        </h3>
                        <p class="sfaq-answer">
                            <?php echo esc_html( $faq_item['faq_answer'] ); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
