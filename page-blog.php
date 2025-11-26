<?php
/**
 * Template Name: Blog Landing
 *
 * Displays the blog listing page that mirrors the static blog.html layout.
 *
 * @package Youth_Logistic
 */

get_header();
?>

    <div class="page-header-banner bagels-overlay">
        <div class="phb-bg"></div>
        <div class="container phb-container bagels-pos-relative">
            <div class="phb-content">
                <h1 class="phb-heading bagels-ff-gilroy-bold-alt">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
    </div>

    <div class="container blog-wrapper page-container">
        <div class="row bagels-justify-center bagels-flex">
            <div class="col-md-10 col-sm-12 col-xs-12">
                <?php
                $paged      = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
                $blog_query = new WP_Query(
                    array(
                        'post_type'      => 'post',
                        'posts_per_page' => 6,
                        'paged'          => $paged,
                    )
                );

                if ( $blog_query->have_posts() ) :
                    while ( $blog_query->have_posts() ) :
                        $blog_query->the_post();
                        ?>
                        <div class="blog-posts">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pre-post-wrapper">
                                <article <?php post_class( 'post-wrapper clearfix' ); ?>>
                                    <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                                        <div class="post-header">
                                            <div class="post-thumb bagels-overlay">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail( 'medium_large', array( 'class' => 'image-responsive' ) );
                                                    } else {
                                                        ?>
                                                        <img class="image-responsive" src="<?php echo esc_url( get_template_directory_uri() . '/images/ourBlog1.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-12 p-0">
                                        <div class="post-content">
                                            <h5 class="post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h5>
                                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 40, '…' ) ); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="post-link">
                                                <?php esc_html_e( 'Read more', 'youth-logistic' ); ?> <i class="fas fa-angle-double-right"></i>
                                            </a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>
                    <div class="pagination-wrapper">
                        <?php
                        echo wp_kses_post(
                            paginate_links(
                                array(
                                    'total'   => $blog_query->max_num_pages,
                                    'current' => $paged,
                                )
                            )
                        );
                        ?>
                    </div>
                    <?php
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="blog-posts">
                        <p><?php esc_html_e( 'No blog posts found.', 'youth-logistic' ); ?></p>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>

<?php
get_footer();

