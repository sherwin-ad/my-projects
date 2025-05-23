<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/taxonomy.custom.css">
<div class="container">
    <h1 class="archive-title"><?php single_term_title(); ?></h1>
    <hr>
    <div class="term-description"><?php echo term_description(); ?></div>

    <?php if (have_posts()) : ?>
        <div class="post-list">
				<div id="RealEstate" class="tabcontent" style="display:block;">
				    	<div class="col form-search-col">
				    	    <div class="link-tabs">
                                    <h1 class="link-name-r"><a href="<?php echo home_url('/assets-type/automobile/'); ?>">AutoMobile</a></h1>
                                    <h1 class="link-name-r"><?php single_term_title(); ?></h1>
                                </div>
				    	     <p>Choose your referred location and price range below.</p>
							<?php echo do_shortcode('[searchandfilter id="200"]'); ?>
						</div>
					<div class="row-sale">
					
						<div class="col-lg-12">
							<h1 class="search_result_title">Search Result: </h1>
							<hr class="little-span">
							<div class="result_item">
								<?php while ( have_posts() ) : the_post(); ?>
								<div class="result_content">
								<?php get_template_part( 'template-parts/content', 'assets-type-realestate', array( 'format' => get_post_format() ) ); ?>
								</div>
								<?php endwhile; ?>
								</div>
							
						</div>
					</div>
					<div class="row">
					       	<div class="col-lg-12">
						    <h3>FOR INQUIRIES PLEASE CALL:</h3>
						    <div class="details">
						        <p>(02) 8405-5118 from Mondays to Fridays at 8:30 AM to 5:30 PM<br>
                                    or call Mr. Red D. Tutanes Jr. at 0998-850-9042 • email: RDTutanes@ucpbsavings.com<br>
						            or Mr. Winston L. Barrias at 0918-811-9864 • email WLBarrias@ucpbsavings.com </p>
						        
						        <p>Sale is on an "As is, Where is" basis. Properties and prices are subject to change without prior notice</p>
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