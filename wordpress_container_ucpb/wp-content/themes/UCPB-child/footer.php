<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<style>
    /* You can place your custom footer styles here if needed */
</style>

</div><!-- #main -->

<footer id="sitefooter">
    <div class="container">
        <div class="footer-wrap">
            <div class="footer-links column-grp">
                <div class="col-md-4 col-xl-2">
                    <h4>SEE ALSO</h4>
                    <?php
                        $menu_name = get_field('see_also', 'option');
                        if ($menu_name) {
                            echo wp_kses_post($menu_name);
                        }
                    ?>
                    <h4>Security & Privacy</h4>
                    <?php
                        $security_privacy = get_field('security_privacy', 'option');
                        if ($security_privacy) {
                            echo wp_kses_post($security_privacy);
                        }
                    ?>
                </div>

                <div class="col-md-4 col-xl-2">
                    <h4>Quick Links</h4>
                    <?php
                        $quick_links = get_field('quick_links', 'option');
                        if ($quick_links) {
                            echo wp_kses_post($quick_links);
                        }
                    ?>
                </div>

                <div class="col-md-4 col-xl-2">
                    <h4>Disclosures</h4>
                    <?php
                        $disclosures = get_field('disclosures', 'option');
                        if ($disclosures) {
                            echo wp_kses_post($disclosures);
                        }
                    ?>
                </div>

                <div class="col-md-12 col-xl-3 customer-service-col">
                    <h4>24/7 Customer Service</h4>
                    <?php
                        $customer_service = get_field('customer_service', 'option');
                        if ($customer_service) {
                            echo wp_kses_post($customer_service);
                        }
                    ?>
                </div>

                <div class="col-md-12 col-xl-12">
                    <?php
                    if (have_rows('image_list', 'option')) :
                        echo '<ul class="image-list-wrapper">';
                        while (have_rows('image_list', 'option')) : the_row();
                            $image_url = get_sub_field('image');
                            if ($image_url) {
                                echo '<li class="image-item">';
                                echo '<img src="' . esc_url($image_url) . '" alt="" class="image-class">';
                                echo '</li>';
                            }
                        endwhile;
                        echo '</ul>';
                    else :
                        echo '<p class="no-images">' . esc_html__('No images found.', 'your-text-domain') . '</p>';
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <?php echo esc_html__('UCPB. All Rights Reserved. 2024 Made by Mybusybee Inc.', 'your-text-domain'); ?>
    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
jQuery(document).ready(function($) {
    // Gallery Carousel
    $(".gallery").each(function() {
        $(this).addClass("gallery-image owl-carousel owl-theme");
        $('figure.gallery-item a').removeAttr('href');
    });

    $(".gallery.owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        navText: [
            `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M733.5,990L251.2,500L733.5,10l15.3,15.3L274.1,500l474.7,474.7L733.5,990z"/></svg>`,
            `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M751.7,499.9l-13.2-13.2l-0.1,0.1L261.6,10l-13.2,13.2L725.1,500L248.3,976.8l13.2,13.2l476.8-476.8l0.1,0.1l13.2-13.2L751.7,499.9z"/></svg>`
        ],
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: 1 }
        }
    });

    // Banner Carousel
    $('.banner_carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        animateOut: 'fadeOut',
        dots: false,
        autoplay: true,
        autoplayTimeout: 7000,
        autoplayHoverPause: true,
        mouseDrag: false,
        navText: [
            `<svg width="54" height="96" viewBox="0 0 54 96" xmlns="http://www.w3.org/2000/svg"><path d="M51 3L6 48L51 93" stroke="#00984B" stroke-width="8"/></svg>`,
            `<svg width="54" height="96" viewBox="0 0 54 96" xmlns="http://www.w3.org/2000/svg"><path d="M3 93L48 48L3 3" stroke="#00984B" stroke-width="8"/></svg>`
        ],
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: 1 }
        }
    });

    // Services Carousel
    $('.services').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        navText: [
            `<svg width="54" height="96" viewBox="0 0 54 96" xmlns="http://www.w3.org/2000/svg"><path d="M51 3L6 48L51 93" stroke="#00984B" stroke-width="8"/></svg>`,
            `<svg width="54" height="96" viewBox="0 0 54 96" xmlns="http://www.w3.org/2000/svg"><path d="M3 93L48 48L3 3" stroke="#00984B" stroke-width="8"/></svg>`
        ],
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: 3 }
        }
    });

    // Tabs
    $(".tabs-menu .tab").on("click", function() {
        var tabId = $(this).data("tab");
        $(".tabs-menu .tab").removeClass("active");
        $(".tabs-content .tab-content").removeClass("active");
        $(this).addClass("active");
        $("#" + tabId).addClass("active");
    });
});
</script>

</body>
</html>
