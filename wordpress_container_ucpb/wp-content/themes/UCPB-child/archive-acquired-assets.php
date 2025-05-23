<?php
get_header(); 
include('inc/banner-archive.php'); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/template.page.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/archive-assets.css">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
                <div class="theTitle">
                    <h1>
                        <?php $archive_title = get_the_archive_title();
                        $archive_title = str_replace( 'Archives: ', '', $archive_title );
                        echo $archive_title; ?>
                    </h1>
                </div>
				
                <p>Read about UCPB Savings Bank latest news and events.</p>
                <hr>
			</header><!-- .archive-header -->
			<section class="branches">
        		<div class="branches-wrapper">
                </div>
            </section>
                    <div class="category_container">
                        <?php 
                            $args = array(
                                'taxonomy' => 'assets-type',
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => false,
                                'parent' => 0,
                            );
                            $categories = get_terms($args);                          
                            if (!empty($categories)) {
                                echo '<ul class="category-list">';
                                
                                foreach ($categories as $category) {
                                  
                                    echo '<li>';
                                    
                                    echo ' <a href="' . get_term_link($category) . '">' . $category->name . '</a>';  
                                    
                                    echo '</li>';
                                }
                                
                                echo '</ul>';
                            } else {
                                echo '<p>No Categories found.</p>';
                            } ?>   
                    </div>
                .
			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>
				<?php //get_template_part( 'template-parts/content', 'branches', array( 'format' => get_post_format() ) ); ?>
			<?php endwhile; ?>


		<?php else : ?>
            no product at the moment.
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
          
		
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

