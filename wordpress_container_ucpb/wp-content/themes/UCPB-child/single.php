<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<?php if (have_rows('carousel_setup')): ?>
    <section class="owl-carousel banner_carousel owl-theme">
        <?php while (have_rows('carousel_setup')): the_row(); 
            $hero_bg = get_sub_field('carousel_image') ?: get_home_url() . '/wp-content/uploads/2025/01/HOMELOAN-SAMPLE.png'; 
            $hero_mobile_bg = get_sub_field('carousel_image') ?: get_home_url() . '/2025/01/HOMELOAN-SAMPLE.png';
            $hero_title = get_sub_field('title') ?: '';
            $hero_description = get_sub_field('description') ?: '';

        ?>
        <div class="heroshot-item" style="background-image:url(<?= esc_url($hero_bg); ?>)" data-mobilebg="<?= esc_url($hero_mobile_bg); ?>">
            <div class="container">
                <div class="heroshot-wrap">
                    <h1><?= $hero_title; ?></h1>
                    <div class="heroshot-content">
                        <p><?= $hero_description; ?></p>
                    </div>
                    <a href="<?= esc_url($hero_button_link); ?>" class="btn-schedule-a-visit"><?= esc_html($hero_button_text); ?></a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
                <div class="container">


        <?php 
            $post_type = get_post_type(); 
            $post_slug = get_post_field('post_name', get_post());
            $taxonomy = get_the_terms(get_the_ID(), 'assets-type');
            if ($taxonomy && !is_wp_error($taxonomy)) {
            foreach ($taxonomy as $term) {
            }
            }
        ?>

			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>
                <div class="sinlge-content">
                <?php get_template_part( 'content', get_post_format() ); ?>
                </div>
			

                <?php if($post_type == 'acquired-assets' && $term->slug == 'automobile') {
                    $getID = get_the_id();
                     $type_vehicle = get_field('type_of_vehicle');
                     $brand = get_field('brand');
                     $plate = get_field('plate_no');
                     $modelYear = get_field('model_year');
                     $transmission = get_field('transmission');
                     $fuelType = get_field('fuel_type');
                     $color = get_field('color');
                     $price = get_field('price_range');
                     ?>
                     <div class="container">
                        <div class="row" style="background-color: #ebfef2; border-radius:10px;">
                            <div class="col-5 my-5">
                                <div class="p-3" style="font-size:20px;font-weight:bold;color:#fff;padding:10px;background-color:green;border-top-left-radius: 20px;
    border-top-right-radius: 20px;">Details:</div>
                                <div class="card" style="border-radius:0!important">
                                    <div class="card-body">
                                      <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Type:</strong> <?php echo $type_vehicle; ?></li>
                                        <li class="list-group-item"><strong>Brand:</strong> <?php echo $brand; ?></li>
                                        <li class="list-group-item"><strong>Plate No:</strong> <?php echo $plate; ?></li>
                                        <li class="list-group-item"><strong>Model Year:</strong> <?php echo $modelYear; ?></li>
                                        <li class="list-group-item"><strong>Transmission:</strong> <?php echo $transmission; ?></li>
                                        <li class="list-group-item"><strong>Fuel Type:</strong> <?php echo $fuelType; ?></li>
                                        <li class="list-group-item"><strong>Color:</strong> <?php echo $color; ?></li>
                                        <li class="list-group-item"><strong>Price:</strong> <?php echo $price; ?></li>
                                      </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                
                                <?php 
                                    $images = get_field('image_of_vehicle');
                                    if( $images ): ?>
                                        <div id="carouselExample" class="carousel slide my-5" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php 
                                                $is_first = true; // To set the first image as active
                                                foreach( $images as $image ): ?>
                                                    <div class="carousel-item <?php echo ($is_first) ? 'active' : ''; ?>" style="border-radius:10px;">
                                                        <a href="<?php echo esc_url($image['url']); ?>" data-toggle="lightbox" data-gallery="example-gallery">
                                                            <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="d-block w-100" style="border-radius:10px;">
                                                        </a>
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <p><?php echo esc_html($image['caption']); ?></p>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                    $is_first = false;
                                                endforeach; ?>
                                            </div>
                                            
                                            <!-- Controls -->
                                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                     
                    <?php get_template_part( 'template-parts/content', 'carloan' ); 
                } elseif($post_type == 'acquired-assets' && $term->slug == 'real-estate') { 
                    $lotNo = get_field('lot_no');
                    $Address = get_field('address');
                    $region = get_field('regions');
                    $province = get_field('provices');
                    $propertyType = get_field('property_type');
                    $price = get_field('price_range');
                    $floorSize = get_field('floor_size');
                    $lotSize = get_field('lot_size');
                    $latitude = get_field('latitude');
                    $longtitude = get_field('longitude');
                    ?>
                     <div class="container">
                        <div class="row" style="background-color: #ebfef2; border-radius:10px;">
                            <div class="col-5 my-5">
                                <div class="p-3" style="font-size:20px;font-weight:bold;color:#fff;padding:10px;background-color:green;border-top-left-radius: 20px;
    border-top-right-radius: 20px;">Details:</div>
                                <div class="card" style="border-radius:0!important">
                                    <div class="card-body">
                                      <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Lot No:</strong> <?php echo $lotNo; ?></li>
                                        <li class="list-group-item"><strong>Address:</strong> <?php echo $Address; ?></li>
                                        <li class="list-group-item"><strong>Region:</strong> <?php echo $region; ?></li>
                                        <li class="list-group-item"><strong>Province:</strong> <?php echo $province; ?></li>
                                        <li class="list-group-item"><strong>Property Type:</strong> <?php echo $propertyType; ?></li>
                                        <li class="list-group-item"><strong>Price:</strong> <?php echo $price; ?></li>
                                        <li class="list-group-item"><strong>Floor Size:</strong> <?php echo $floorSize; ?> m²</li>
                                        <li class="list-group-item"><strong>Lot Size:</strong> <?php echo $lotSize; ?> m²</li>
                                        <li class="list-group-item"><strong>Latitude:</strong> <?php echo $latitude; ?></li>
                                        <li class="list-group-item"><strong>Longitude:</strong> <?php echo $longtitude; ?></li>
                                      </ul>
                                    </div>
                                    
                                 </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                
                                <?php 
                                    $images = get_field('image_of_property');
                                    if( $images ): ?>
                                        <div id="carouselExample" class="carousel slide my-5" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php 
                                                $is_first = true; // To set the first image as active
                                                foreach( $images as $image ): ?>
                                                    <div class="carousel-item <?php echo ($is_first) ? 'active' : ''; ?>">
                                                        <a href="<?php echo esc_url($image['url']); ?>" data-toggle="lightbox" data-gallery="example-gallery">
                                                            <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="d-block w-100" style="border-radius:10px;">
                                                        </a>
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <p><?php echo esc_html($image['caption']); ?></p>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                    $is_first = false;
                                                endforeach; ?>
                                            </div>
                                            
                                            <!-- Controls -->
                                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
    
                    <?php get_template_part( 'template-parts/content', 'housingloan' ); 
                } ?>

			<?php endwhile; ?>
<?php if ($post_type === 'news-events') : ?>
<section class="branches pt-2">
        <header class="page-header mt-5">
            <h2 class="service_title">Related Article</h2>
        </header>
        <div class="branches-wrapper">
            <?php
            $related_args = array(
                'post_type'      => $post_type,
                'posts_per_page' => 3,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => 'date',
                'order'          => 'DESC'
            );

            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()) :
                while ($related_query->have_posts()) : $related_query->the_post(); ?>
                    <div class="branche item">
                        <div class="wrapper">
                            <a href="<?php the_permalink(); ?>" class="programimg">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php else : ?>
                                    <img src="image-placeholder.jpg" alt="Sample News">
                                <?php endif; ?>
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
                            </a>
                            <div class="wrap">
                                <div>
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo get_the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p>No related articles found.</p>
            <?php endif; ?>
        </div>
</section>
<?php endif; ?>
</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
