<?php 
$image_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
$default_image = get_site_url() . '/wp-content/uploads/2025/01/image-12.png';
$map = get_field('map'); // Kunin ang ACF map field
?>
<div class="branche item">
    <div class="wrapper">
        <a href="<?php the_permalink(); ?>" class="programimg">
            <?php if( $map ): ?>
                <!-- Kung may laman ang map field, ipakita ang iframe -->
                <div class="map-container">
                    <?php echo $map; ?>
                </div>
            <?php else: ?>
                <!-- Kung walang laman ang map field, ipakita ang image -->
                <img src="<?php echo esc_url( $image_url ? $image_url : $default_image ); ?>" alt="<?php the_title(); ?>">
                <span>
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_180)">
                            <path d="M1.6875 12C1.6875 12 5.6875 4 12.6875 4C19.6875 4 23.6875 12 23.6875 12C23.6875 12 19.6875 20 12.6875 20C5.6875 20 1.6875 12 1.6875 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M12.6875 15C14.3444 15 15.6875 13.6569 15.6875 12C15.6875 10.3431 14.3444 9 12.6875 9C11.0306 9 9.6875 10.3431 9.6875 12C9.6875 13.6569 11.0306 15 12.6875 15Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_1_180">
                                <rect width="24" height="24" fill="white" transform="translate(0.6875)"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                    Learn More
                </span>
            <?php endif; ?>
        </a>
        <div class="wrap">
            <div>
                <h3><?php the_title(); ?></h3>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
            </div>
        </div>
    </div>
</div>
