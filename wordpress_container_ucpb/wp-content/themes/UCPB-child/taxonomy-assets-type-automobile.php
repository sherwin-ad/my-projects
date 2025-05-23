<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/taxonomy.custom.css">
<div class="container">
    <h1 class="archive-title"><?php single_term_title(); ?></h1>
    <hr>
    <div class="term-description"><?php echo term_description(); ?></div>

    <?php if (have_posts()) : ?>
        <div class="post-list">
				<div id="AutoMobile" class="tabcontent" style="display:block;">
			
				    <div class="col form-search-col">
                                <div class="link-tabs">
                                    <h1 class="link-name"><?php single_term_title(); ?></h1>
                                    <h1 class="link-name"><a href="<?php echo home_url('/assets-type/real-estate/'); ?>">Real Estate</a></h1>
                                </div>
				        	    <p>Choose your referred location and price range below.</p>
							<?php echo do_shortcode('[searchandfilter id="203"]'); ?>
						</div>
					<div class="row-sale">
						
						<div class="col-lg-12">
							<h1 class="search_result_title">Search Result: </h1>
							<hr class="little-span">
							<div class="result_item">
								<?php while ( have_posts() ) : the_post(); ?>
								<div class="result_content">
								<?php get_template_part( 'template-parts/content', 'assets-type-automobile', array( 'format' => get_post_format() ) ); ?>
								</div>
								<?php endwhile; ?>
							</div>
							
						</div>
					
					</div>
					<div class="row">
					       	<div class="col-lg-12">
						    <p>Feel free to visit our Automobile Warehouse.</p>
						    <h3>FOR INQUIRIES PLEASE CALL:</h3>
						    <div class="details">
						        <p>(02) 8405-5118 from Mondays to Fridays at 8:30 AM to 5:30 PM<br> 
                                    or call Mr. Red D. Tutanes Jr. at 0998-850-9042 • email: rdtutanes@ucpbsavings.com</p>
                                    
                                <p>Sale is on an "As is, Where is" basis. Properties and prices are subject to change without prior notice</p>
						    </div>
                            <div style="padding-bottom:21px;"></div>
                            <div class="embedded-maps">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d494712.5065027764!2d121.1450286982352!3d14.372799318379144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sunited%20coconut%20planter%20bank!5e0!3m2!1sen!2sph!4v1742450341158!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>


						</div>
					</div>
				</div>
        </div>
    <?php else : ?>
        <p>No posts found under this service.</p>
    <?php endif; ?>
</div>
<?php get_footer(); ?>