<?php
/**
 * Template Name: Services Archive
 *
 * Displays all Service CPT posts in a grid matching the provided HTML structure.
 *
 * @package Youth_Logistic
 */

get_header();

// Query all services with pagination support.
$paged          = max( 1, get_query_var( 'paged' ) );
$services_query = new WP_Query(
    array(
        'post_type'      => 'service',
        'posts_per_page' => 12,
        'paged'          => $paged,
        'orderby'        => array(
            'menu_order' => 'ASC',
            'date'       => 'DESC',
        ),
    )
);
?>

<div class="page-header-banner bagels-overlay ">
    <div class="phb-bg"></div>
    <div class="container phb-container bagels-pos-relative">
        <div class="phb-content">
            <h1 class="phb-heading bagels-ff-gilroy-bold-alt"><?php esc_html_e( 'Our Services', 'youth-logistic' ); ?></h1>
        </div>
    </div>
</div>

<div class="container page-container pc-archive-services">
    <div class="pc-as-services h-p-ul-m-0">
        <div class="pc-as-s-1 bagels-flex-wrap bagels-flex">
            <?php if ( $services_query->have_posts() ) : ?>
                <?php
                while ( $services_query->have_posts() ) :
                    $services_query->the_post();

                    $service_link   = get_permalink();
                    $service_title  = get_the_title();
                    $service_copy   = get_the_excerpt() ?: wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 );
                    $service_icon   = get_field( 'service_icon_class', get_the_ID() ) ?: '';
                    $thumb_id       = get_post_thumbnail_id();
                    $thumb_url      = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : '';
                    $thumb_alt      = $thumb_id ? get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) : '';
                    ?>
                    <div class="service-single-box">
                        <a href="<?php echo esc_url( $service_link ); ?>"
                           title="<?php echo esc_attr( $service_title ); ?>"
                           class="pc-as-s-s-1 bagels-float-on-hover">
                            <div class="pc-as-s-s-top bagels-pos-relative bagels-overlay">
                                <?php if ( $thumb_url ) : ?>
                                    <img src="<?php echo esc_url( $thumb_url ); ?>"
                                         alt="<?php echo esc_attr( $thumb_alt ?: $service_title ); ?>"
                                         class="pc-as-s-s-t-img bagels-cover-img">
                                <?php endif; ?>
                            </div>
                            <div class="pc-as-s-s-bottom">
                                <div class="pc-as-s-s-b-image">
                                    <div class="pc-as-s-s-b-i-1 bagels-sprite bagels-filter-black-to-red <?php echo esc_attr( $service_icon ); ?>"></div>
                                </div>
                                <div class="pc-as-s-s-b-text">
                                    <h2 class="pc-as-s-s-b-t-title bagels-ff-gilroy-bold"><?php echo esc_html( $service_title ); ?></h2>
                                    <p class="pc-as-s-s-b-t-descr bagels-trans-p-2"><?php echo esc_html( $service_copy ); ?></p>
                                    <div class="pc-as-s-s-b-t-link">
                                        <span class="pc-as-s-s-b-t-1"><?php esc_html_e( 'View more', 'youth-logistic' ); ?></span>
                                        <span class="pc-as-s-s-b-t-icon"><i class="far fa-chevron-double-right"></i></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="pagination-wrapper">
        <?php
        $pagination = paginate_links(
            array(
                'total'   => $services_query->max_num_pages,
                'current' => $paged,
                'type'    => 'list',
            )
        );
        if ( $pagination ) {
            echo wp_kses_post( $pagination );
        }
        ?>
    </div>
</div>

<?php
get_footer();

