<?php /* Template Name: Home */ 
get_header();
//include_once('inc/banner.php');
?>

<?php if (have_rows('carousel_setup')): ?>
    <section id="home-banner" class="owl-carousel banner_carousel owl-theme">
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
<?php else: ?>
    <p>No hero slides found.</p>
<?php endif; ?>
<section class="service-section"> 
       <div class="container">
        <header class="page-header mt-5">
        <h2 class="service_title">Explore Our Services</h2>
        <p class="p-21">UCPB Savings Bank offers a comprehensive range of financial products and services designed to cater to individuals, businesses, and institutions.</p>
		<hr>
        </header>
        
        <div class="owl-carousel services owl-theme">
                <?php if (have_rows('services_settings')): ?>
                    <?php while (have_rows('services_settings')): the_row(); ?>
                        <div class="item">
                            <img src="<?= get_sub_field("image") ?>" alt="">
                                <div class="banner_textoutput">
                                    <a href="#" target="_blank">
                                    <h3><?= get_sub_field("title") ?></h3>
                                    </a>
                                </div>
                        </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <p>No items found.</p>
                <?php endif; ?> 
            </div>
        </div>
    </div></section>


    <section class="branches  ">
    <div class="container">
        <header class="page-header mt-2">
            <h2 class="service_title">News & Events</h2>
            <p class="p-21">Read about UCPB Savings Bank latest News and Events</p>
            <hr>
        </header>
        <div class="branches-wrapper">
            <?php 
                $args = array(
                    'post_type'      => 'news-events',  
                    'posts_per_page' => 3,    
                    'orderby'        => 'date',       
                    'order'          => 'DESC'        
                );
                
                $query = new WP_Query( $args );
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post();
                       $image_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                    $default_image = get_site_url() . '/wp-content/uploads/2025/01/image-12.png';
            ?>
                        <div class="branche item">
                            <div class="wrapper">
                                <a href="<?php the_permalink(); ?>" class="programimg">
                                     <img src="<?php echo esc_url( $image_url ? $image_url : $default_image ); ?>" alt="<?php the_title(); ?>">
                                    <span>
                                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1_180)">
                                                <path d="M1.6875 12C1.6875 12 5.6875 4 12.6875 4C19.6875 4 23.6875 12 23.6875 12C23.6875 12 19.6875 20 12.6875 20C5.6875 20 1.6875 12 1.6875 12Z" 
                                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12.6875 15C14.3444 15 15.6875 13.6569 15.6875 12C15.6875 10.3431 14.3444 9 12.6875 9C11.0306 9 9.6875 10.3431 9.6875 12C9.6875 13.6569 11.0306 15 12.6875 15Z" 
                                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1_180">
                                                    <rect width="24" height="24" fill="white" transform="translate(0.6875)"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        Read More
                                    </span>
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
            <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No posts found.</p>';
                endif; 
            ?>
                    
        </div>
        <div class="news_and_event_btn">
                        <a href="<?php echo get_site_url(); ?>/news-events">Visit the News & Events 
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_748_11765)">
                            <path d="M15 5L13.59 6.41L18.17 11H2V13H18.17L13.58 17.59L15 19L22 12L15 5Z" fill="white"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_748_11765">
                            <rect width="24" height="24" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>


                        </a>
                    </div>
    </div>
</section>

<section class="service-section"> 
       <div class="container">
        <header class="page-header mt-2">
        <h2 class="service_title">Explore Our Careers</h2>
        <p class="p-21">Join us in delivering exceptional experiences - where your passion for customer drives our sucess!</p>
		<hr>
        </header>
        
        <div class="owl-carousel services owl-theme">
                <?php if (have_rows('careers_setup')): ?>
                    <?php while (have_rows('careers_setup')): the_row(); ?>
                        <div class="item">
                            <img src="<?= get_sub_field("image") ?>" alt="">
                                <div class="banner_textoutput">
                                    <a href="<?= get_sub_field("link") ?>" >
                                    <h3><?= get_sub_field("title") ?></h3>
                                    </a>
                                </div>
                        </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <p>No items found.</p>
                <?php endif; ?> 
            </div>
        </div>
    </div></section>
    
    
    <section class="front_page_our_awards_background pt-2">
        <div class="container">
        <header class="page-header mt-2">
            <h2 class="service_title">Our Awards</h2>
            <p class="p-21">UCPB Savings Bank is recognized by some of the mos prestigious <br> national award giving bodies</p>
            <hr>
        </header>
            <div class="space_created-md"></div>
                <?php 
                    $args = array(
                        'post_type' => 'awards',  
                        'posts_per_page' => 6,    
                        'orderby' => 'date',       
                        'order' => 'DESC'        
                    );
                    $query = new WP_Query( $args );
                    if ( $query->have_posts() ) :
                    echo '<ul class="custom-post-list">';
                    while ( $query->have_posts() ) : $query->the_post();
                        ?>
                        <li>
                            <div class="awardscontainer">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                    <h2 class="awards_title"><?php the_title(); ?></h2>
                                    <span class="highlights-md"></span>
                                </a>
                            </div>
                            
                        </li>
                        <?php
                    endwhile;
                    echo '</ul>';
                    wp_reset_postdata();
                else :
                    echo '<p>No posts found.</p>';
                endif; ?>
                    <div class="awards_btn">
                        <a href="<?php echo get_site_url(); ?>/awards/">Visit our Awards 
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_748_11765)">
                        <path d="M15 5L13.59 6.41L18.17 11H2V13H18.17L13.58 17.59L15 19L22 12L15 5Z" fill="white"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_748_11765">
                        <rect width="24" height="24" fill="white"/>
                        </clipPath>
                        </defs>
                        </svg>

                        </a>
                    </div>
        </div>
    </section>


    <div class="container pt-2">
    <header class="page-header mt-2">
            <h2 class="service_title">Need more help?</h2>
            <p class="p-21">Let us assist with all your banking needs-reach out today!</p>
            <hr>
        </header>
        <div class="help_links">
            <?php if (have_rows('help_settings')): ?>
                    <ul class="help-list">
                        <?php while (have_rows('help_settings')): the_row(); ?>
                                <li>
                                    <a class="help_flex" href="<?= get_sub_field("links") ?>">
                                        <h2><?= get_sub_field("title") ?></h2>
                                        <i class="fa-solid fa-arrow-right"></i>  
                                    </a>
                                    <span class="highlights-descriptions"></span>
                                </li>       
                        <?php endwhile; ?>
                    </ul>
                        <?php else: ?>
                        <p>No items found.</p>
                    <?php endif; ?> 
        </div>
    </div>
    <div class="space_created"></div>
    <script>
        document.querySelectorAll('.awards_title').forEach(function (element) {
        const textLength = element.textContent.trim().length; // Get the length of the text content
        
        // Display the count of letters in the console
        console.log(`Text: "${element.textContent.trim()}" has ${textLength} letters`);
        // Add padding if the text length is less than 20testest
        if (textLength <= 40) {
            element.classList.add('added-padding'); // Add a class for additional padding
        }
        });
    </script>
<?php get_footer(); ?>
