<?php
/**
 * Template Name: Front Page
 */

get_header();
?>
<div class="page-container pg-home bagels-pos-relative">

<!-- ============================================
HERO SECTION
============================================ -->
<?php 
$hero_bg = get_field('hero_background'); // Retrieve hero background image (ACF image field returns array).
$hero_bg_url = $hero_bg['url'] ?? ''; // Extract the image URL for <img src>.
$hero_bg_alt = $hero_bg['alt'] ?? ''; // Extract alt text for accessibility.
?>

<div class="ph-header-section h-p-ul-m-0 text-no-max-height">
    <div class="ph-hs-banner bagels-pos-relative">
        <picture>
            <img src="<?php echo esc_url($hero_bg_url); // Output sanitized background image URL for hero ?> " 
                 alt="<?php echo esc_attr($hero_bg_alt); // Output sanitized alt text for accessibility ?>" 
                 class="hs-b-bg-img bagels-cover-img">
        </picture>

        <div class="container bagels-pos-relative bagels-vp-height ph-hs-b-container bagels-align-center bagels-flex">
            <div class="ph-hs-b-text">
                <div class="ph-hs-b-t-2 bagels-flex bagels-align-center">
                    <div class="ph-hs-b-t-1">

                        <h1 class="ph-hs-b-t-title bagels-ff-gilroy-bold">
                            <span><?php the_field('hero_title'); // Output hero main title (ACF text field) ?></span>
                        </h1>

                        <p class="ph-hs-b-t-descr">
                            <span><?php the_field('hero_description'); // Output supporting description below title ?></span>
                        </p>

                        <p class="ph-hs-b-t-tagline">
                            <?php the_field('hero_tagline'); // Output tagline line ?>
                        </p>

                        <div class="vc-theme-button">
                            <a href="<?php the_field('hero_button_link'); // Output CTA link URL ?>" target="_self">
                                <?php the_field('hero_btn_text'); // Output CTA button label ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
SERVICES SECTION
============================================ -->
<?php
// Fetch the background image array (ACF image field returns url/alt/etc.).
$services_bg_image         = get_field( 'services_background_image' );
// Read the background URL (empty string if field missing so we can skip rendering).
$services_bg_url           = $services_bg_image['url'] ?? '';
// Alt text for accessibility; falls back to empty if not provided.
$services_bg_alt           = $services_bg_image['alt'] ?? '';
// Section subtitle (small line above main heading).
$services_section_subtitle = get_field( 'services_section_subtitle' ) ?: '';
// Main heading text for the services block.
$services_section_title    = get_field( 'services_section_title' ) ?: '';
// CTA button label shown on mobile.
$services_button_text      = get_field( 'services_section_button_text' ) ?: '';
// CTA button link; required along with text before rendering the button.
$services_button_link      = get_field( 'services_section_button_link' ) ?: '';
?>
    <div class="ph-main-sec ph-services h-p-ul-m-0 bagels-pos-relative bagels-flex-center-xy">
        <?php if ( $services_bg_url ) : // Only render background <picture> when an image is supplied ?>
        <picture class="hidden-xs1 hidden-sm1">
            <source media="(max-width: 991px)"/>
            <img src="<?php echo esc_url( $services_bg_url ); // Output sanitized services background URL ?>" alt="<?php echo esc_attr( $services_bg_alt ); // Output sanitized alt text ?>" class="ph-svs-bg-img bagels-cover-img"/>
        </picture>
        <?php endif; ?>
        <div class="container">
            <div class="ph-svs-heading" data-aos="fade-up">
                <div class="vc-theme-title vc-tt-align-center vc-tt-light">
                    <?php if ( $services_section_subtitle ) : // Subheading renders only when text exists ?>
                    <div class="vc-tt-sub-title">
                        <div class="vc-tt-st-1"><?php echo esc_html( $services_section_subtitle ); // Output subtitle text ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ( $services_section_title ) : // Main heading renders only when text exists ?>
                    <h2 class="vc-tt-title"><?php echo esc_html( $services_section_title ); // Output main heading ?></h2>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ph-svs-services" data-aos="fade-up">
                <div class="ph-svs-s-1 owl-carousel">
                    <?php echo services(); // Output dynamic service cards (CPT powered helper) ?>
                </div>
            </div>
            <?php if ( $services_button_text && $services_button_link ) : // CTA button appears only when both text + link exist ?>
            <div class="ph-svs-read-more visible-xs txt-center" data-aos="fade-up">
                <div class="vc-theme-button vc-tb-center">
                    <a title="<?php echo esc_attr( $services_button_text ); // Output CTA title attribute ?>" target="_self" href="<?php echo esc_url( $services_button_link ); // Output CTA link ?>">
                        <?php echo esc_html( $services_button_text ); // Output CTA label ?><i class="fas fa-angle-double-right"></i>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ============================================
    ABOUT US SECTION
    ============================================ -->
    <?php 
    // About Us Section - Dynamic Fields (same pattern as Hero section)
    $about_us_image = get_field('about_us_image'); // Retrieve About Us image array.
    $about_us_img_url = $about_us_image['url'] ?? ''; // Extract About Us image URL.
    $about_us_img_alt = $about_us_image['alt'] ?? ''; // Extract About Us image alt text.
    $about_us_vertical_text = trim(get_field('about_us_vertical_text') ?? ''); // Vertical text string split into letters later.
    ?>
    <div class="container ph-about-us ph-main-sec h-p-ul-m-0 ph-white-bg">
        <div class="ph-au-1">
                    <div class="ph-au-title visible-xs visible-sm" data-aos="fade-up">
                <div class="vc-theme-title vc-tt-align-left vc-tt-dark vc-tt-align-center-sm">
                    <div class="vc-tt-sub-title">
                                <div class="vc-tt-st-1"><?php the_field('about_us_subtitle'); // Output About Us subtitle ?></div>
                    </div>
                            <h2 class="vc-tt-title"><?php the_field('about_us_title'); // Output About Us title ?></h2>
                </div>
            </div>
            <div class="ph-au-left bagels-overlay-hover-elem" data-aos="fade-up" data-aos-delay="0">
                <div class="ph-au-l-1">
                    <div class="ph-au-l-image bagels-overlay">
                                <img src="<?php echo esc_url($about_us_img_url); // Output About Us image URL ?>" alt="<?php echo esc_attr($about_us_img_alt); // Output About Us image alt ?>" class="ph-au-l-i-1 bagels-cover-img">
                    </div>
                    <div class="ph-au-l-text-box bagels-pos-relative">
                        <div class="ph-au-l-tb-vertical-strip bagels-flex bagels-flex-dir-col-rev bagels-justify-center">
                            <?php
                            if ($about_us_vertical_text !== '') {
                                // Display vertical text character by character
                                $word_groups = preg_split('/\s+/', trim($about_us_vertical_text)); // Split into words by whitespace.
                                foreach ($word_groups as $word) { // Loop each word block.
                                    if ($word === '') {
                                        continue;
                                    }
                                    echo '<div class="ph-au-l-tb-vs-word bagels-flex bagels-flex-dir-col-rev">';
                                    $chars = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY); // Split word into UTF-8 characters.
                                    foreach ($chars as $char) {
                                        $class = ($char === 'i') ? 'ph-au-l-tb-vs-1 thin-letter' : 'ph-au-l-tb-vs-1'; // Apply special class for thin letters.
                                        echo '<div class="' . esc_attr($class) . '">' . esc_html($char) . '</div>'; // Output each character with styling.
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                        <div class="ph-au-l-tb-title bagels-flex bagels-flex-dir-col bagels-justify-center">
                            <div class="ph-au-l-tb-t-line-2 bagels-ff-gilroy-bold">
                                        <?php the_field('about_us_main_title'); // Output bold stacked text next to image ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ph-au-right">
                <div class="ph-au-r-1">
                    <div class="ph-au-r-title hidden-xs hidden-sm" data-aos="fade-up" data-aos-delay="50">
                        <div class="vc-theme-title vc-tt-align-left vc-tt-dark vc-tt-align-center-sm">
                            <div class="vc-tt-sub-title">
                                <div class="vc-tt-st-1"><?php the_field('about_us_subtitle'); // Repeat subtitle for desktop layout ?></div>
                            </div>
                            <h2 class="vc-tt-title"><?php the_field('about_us_title'); // Repeat title for desktop layout ?></h2>
                        </div>
                    </div>
                    <div class="ph-au-r-descr" data-aos="fade-up" data-aos-delay="100">
                        <p><?php the_field('about_us_description'); // Output About Us body copy ?></p>
                    </div>
                    <div class="ph-au-r-button" data-aos="fade-up" data-aos-delay="150">
                        <div class="vc-theme-button">
                            <a href="<?php the_field('about_us_button_link'); // About Us CTA URL ?>" target="_self">
                                <?php the_field('about_us_button_text'); // About Us CTA text ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============================================
    STATS SECTION
    ============================================ -->
    <?php
    $stats_bg_image = get_field( 'stats_background_image' ); // Retrieve stats background image (ACF image field returns array).
    $stats_bg_url   = $stats_bg_image['url'] ?? ''; // Extract URL; empty string means no background rendered.
    $stats_bg_alt   = $stats_bg_image['alt'] ?? ''; // Extract alt text for accessibility.
    ?>
    <div class="ph-main-sec ph-stats h-p-ul-m-0 bagels-pos-relative bagels-vp-height bagels-flex-center-xy">
        <picture class="visible-lg">
            <source media="(max-width: 1199px)">
            <source>
            <?php if ( $stats_bg_url ) : // Render image only when background provided ?>
            <img src="<?php echo esc_url( $stats_bg_url ); ?>" alt="<?php echo esc_attr( $stats_bg_alt ); ?>" class="ph-sts-bg-image bagels-cover-img">
            <?php endif; ?>
        </picture>
        <picture class="visible-sm visible-md">
            <source media="(min-width: 1200px)">
            <source media="(max-width: 767px)">
            <source>
            <?php if ( $stats_bg_url ) : // Same conditional for tablet breakpoint ?>
            <img src="<?php echo esc_url( $stats_bg_url ); ?>" alt="<?php echo esc_attr( $stats_bg_alt ); ?>" class="ph-sts-bg-image bagels-cover-img">
            <?php endif; ?>
        </picture>
        <picture class="visible-xs">
            <source media="(min-width: 768px)">
            <source>
            <?php if ( $stats_bg_url ) : // Same conditional for mobile breakpoint ?>
            <img src="<?php echo esc_url( $stats_bg_url ); ?>" alt="<?php echo esc_attr( $stats_bg_alt ); ?>" class="ph-sts-bg-image bagels-cover-img">
            <?php endif; ?>
        </picture>
        <div class="container ph-sts-container">
            <div class="ph-sts-1">
                <div class="ph-sts-heading" data-aos="fade-up">
                    <div class="vc-theme-title vc-tt-align-left vc-tt-light">
                        <?php
                        $stats_section_subtitle = get_field( 'stats_section_subtitle' ) ?: ''; // ACF subtitle text (optional).
                        $stats_section_title    = get_field( 'stats_section_title' ) ?: ''; // ACF title text (optional).
                        ?>
                        <?php if ( $stats_section_subtitle ) : // Render subtitle only if provided ?>
                        <div class="vc-tt-sub-title">
                            <div class="vc-tt-st-1"><?php echo esc_html( $stats_section_subtitle ); ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if ( $stats_section_title ) : // Render main heading only if provided ?>
                        <h2 class="vc-tt-title"><?php echo esc_html( $stats_section_title ); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ph-sts-stats">
                    <?php echo why_choose_us(); // Output dynamic Why Choose Us cards ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================
    BLOG SECTION
    ============================================ -->
    <div class="container ph-main-sec ph-blogs h-p-ul-m-0 ph-white-bg">
        <div class="ph-bl-1">
            <div class="ph-bl-heading" data-aos="fade-up">
                <div class="vc-theme-title vc-tt-align-center vc-tt-dark">
                    <?php
                    $blog_section_subtitle = get_field( 'blog_section_subtitle' ) ?: ''; // ACF subtitle for blog section heading.
                    $blog_section_title    = get_field( 'blog_section_title' ) ?: ''; // ACF title for blog section heading.
                    ?>
                    <?php if ( $blog_section_subtitle ) : // Render subtitle only if provided ?>
                    <div class="vc-tt-sub-title">
                        <div class="vc-tt-st-1"><?php echo esc_html( $blog_section_subtitle ); ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ( $blog_section_title ) : // Render title only if provided ?>
                    <h2 class="vc-tt-title"><?php echo esc_html( $blog_section_title ); ?></h2>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ph-bl-blog-boxes">
                <div class="ph-bl-bb-1 owl-carousel dark-owl-dots">
                    <?php
                    // Query the latest posts to populate the blog carousel cards.
                    $blog_posts = new WP_Query(
                        array(
                            'post_type'           => 'post', // Pull standard posts.
                            'posts_per_page'      => 3, // Controls how many cards render; adjust to show fewer/more posts.
                            'ignore_sticky_posts' => true, // Don't prioritize sticky posts.
                        )
                    );

                    if ( $blog_posts->have_posts() ) :
                        $delay = 0; // Track AOS delay increments (0, 100, 200).
                        while ( $blog_posts->have_posts() ) :
                            $blog_posts->the_post(); // Setup global post data.
                            $card_title = get_the_title(); // Grab post title for card copy.
                            $card_link  = get_permalink(); // Link to full post.
                            $image_html = get_the_post_thumbnail(
                                get_the_ID(),
                                'large',
                                array(
                                    'class' => 'ph-bl-bb-b-t-img bagels-cover-img', // Match existing image class for styling.
                                )
                            );
                            ?>
                            <div class="ph-bl-bb-box" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                                <a href="<?php echo esc_url( $card_link ); ?>" title="<?php echo esc_attr( $card_title ); ?>" class="ph-bl-bb-b-1 bagels-overlay-hover-elem bagels-float-on-hover">
                                    <div class="ph-bl-bb-b-top bagels-overlay">
                                        <?php echo $image_html; // Output featured image HTML (already sanitized by WP) ?>
                                    </div>
                                    <div class="ph-bl-bb-b-bottom bagels-before-pos-absolute bagels-before-cont-blank">
                                        <div class="ph-bl-bb-b-b-1">
                                            <h3 class="ph-bl-bb-b-b-title bagels-ff-gilroy-bold" title="<?php echo esc_attr( $card_title ); ?>">
                                                <?php echo esc_html( $card_title ); // Output post title ?>
                                            </h3>
                                            <h3 class="ph-bl-bb-b-b-read-more">
                                                <span class="ph-bl-bb-b-b-rm-1"><?php esc_html_e( 'Read more', 'youth-logistic' ); // Localized button text ?></span>
                                                <span class="ph-bl-bb-b-b-rm-icon">
                                                    <i class="fas fa-angle-double-right"></i>
                                                </span>
                                            </h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                            $delay += 100; // Increase delay for next card (0, 100, 200...).
                        endwhile;
                        wp_reset_postdata(); // Reset global post data after custom loop.
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="speculationrules">
    {
        "prefetch": [
            {
                "source": "document",
                "where": {
                    "and": [
                        {
                            "href_matches": "\/*"
                        },
                        {
                            "not": {
                                "href_matches": [
                                    "\/wp-*.php",
                                    "\/wp-admin\/*",
                                    "\/wp-content\/uploads\/*",
                                    "\/wp-content\/*",
                                    "\/wp-content\/plugins\/*",
                                    "\/wp-content\/themes\/YuthLogistics\/*",
                                    "\/*\\?(.+)"
                                ]
                            }
                        },
                        {
                            "not": {
                                "selector_matches": "a[rel~=\"nofollow\"]"
                            }
                        },
                        {
                            "not": {
                                "selector_matches": ".no-prefetch, .no-prefetch a"
                            }
                        }
                    ]
                },
                "eagerness": "conservative"
            }
        ]
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof jQuery === "undefined") {
            return;
        }
        var $ = jQuery;
        if (typeof $.fn.owlCarousel === "undefined") {
            return;
        }
        var $carousel = $(".ph-svs-s-1.owl-carousel");
        if (!$carousel.length) {
            return;
        }
        var $nav = $(".ph-svs-nav");
        if (!$nav.length) {
            return;
        }
        var bindNavEvents = function () {
            $nav.find(".ph-svs-prev").off("click.phNav").on("click.phNav", function (event) {
                event.preventDefault();
                $carousel.trigger("prev.owl.carousel");
            });
            $nav.find(".ph-svs-next").off("click.phNav").on("click.phNav", function (event) {
                event.preventDefault();
                $carousel.trigger("next.owl.carousel");
            });
        };
        if ($carousel.hasClass("owl-loaded")) {
            bindNavEvents();
        } else {
            $carousel.on("initialized.owl.carousel", function () {
                bindNavEvents();
            });
        }
    });
</script>
<?php
get_footer();

