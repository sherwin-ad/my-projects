<?php if (have_rows('carousel_setup', 'option')): ?>
    <section id="home-banner"  class="owl-carousel banner_carousel owl-theme">
        <?php while (have_rows('carousel_setup', 'option')): the_row(); 
            $hero_bg = get_sub_field('carousel_image') ?: get_home_url() . '/wp-content/uploads/2025/01/HOMELOAN-SAMPLE.png'; 
            $hero_mobile_bg = get_sub_field('carousel_image') ?: get_home_url() . '/2025/01/HOMELOAN-SAMPLE.png';
            $hero_title = get_sub_field('title', 'option') ?: '';
            $hero_description = get_sub_field('description', 'option') ?: '';
            $hero_button_text = get_sub_field('button_text', 'option') ?: 'Learn More';
            $hero_button_link = get_sub_field('button_link', 'option') ?: '#';
        ?>
        <div class="heroshot-item" style="background-image:url(<?= esc_url($hero_bg); ?>)" data-mobilebg="<?= esc_url($hero_mobile_bg); ?>">
            <div class="container">
                <div class="heroshot-wrap">
                    <h1><?= esc_html($hero_title); ?></h1>
                    <div class="heroshot-content">
                        <p><?= esc_html($hero_description); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>
