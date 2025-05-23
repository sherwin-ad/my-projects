<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); 
include_once('inc/banner-archive.php'); 
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="container">
            
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h2 class="archive-title">
                News & Events
				</h2>
                <p>Read about UCPB Savings Bank latest news and events.</p>
                <hr>
			</header><!-- .archive-header class -->
			<section class="branches">
        				<div class="branches-wrapper">
			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', 'branches', array( 'format' => get_post_format() ) ); ?>
			<?php endwhile; ?>


		<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
		<div class="pagination-container">
    <?php custom_pagination(); ?>
</div>
		</section>
		                <!-- Add Pagination Here -->

		</div>
		</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
