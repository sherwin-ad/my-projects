<?php if (have_rows('carousel_setup')): ?>
    <section id="home-banner" class=" owl-carousel banner_carousel owl-theme">
        <?php while (have_rows('carousel_setup')): the_row(); 
            $hero_bg = get_sub_field('carousel_image') ?: ''; 
            $hero_mobile_bg = get_sub_field('carousel_image') ?: '';
            $hero_title = get_sub_field('title') ?: '';
            $hero_description = get_sub_field('description') ?: '';
            $hero_link = get_sub_field('button_link') ?: '';

        ?>
        <div class="heroshot-item" style="background-image:url(<?= esc_url($hero_bg); ?>)" data-mobilebg="<?= esc_url($hero_mobile_bg); ?>">
            <div class="container">
                <div class="heroshot-wrap">
                    <h1><?= $hero_title; ?></h1>
                    <div class="heroshot-content">
                        <p><?= $hero_description; ?></p>
                    </div>
                   <?php if($hero_link) {  ?> <a href="<?= esc_url($hero_link); ?>" class="inquire-now">Inquire Now</a> <?php } ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>