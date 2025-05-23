<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); 
include_once('inc/banner.php');
?>



	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="container">
			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="page-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<hr>
					</div>
					<div class="entry-content">
				
						<?php the_content(); ?>
						<?php
						wp_link_pages(
							array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							)
						);
						?>
					</div><!-- .entry-content -->
				</article><!-- #post -->

				<?php //comments_template(); ?>
			<?php endwhile; ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>