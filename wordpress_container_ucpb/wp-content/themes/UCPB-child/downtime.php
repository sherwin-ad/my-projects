<?php
/**
 * Template Name: downtime
 * Description: A custom template to display the About using an ACF relationship field.
 */

get_header();
include_once('inc/banner.php');
?>

<style>
    .downtime {
    width: 100%;
    max-width: 900px;
    margin: auto;
    padding: 1rem;
    border: 4px solid #39DF1D;

    
}
.downtime p {
    width: 100%;
    max-width: 542px;
    margin: 1.5rem auto;
}
</style>

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
				<div class="downtime" >
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
					</div>
					</div><!-- .entry-content -->
				</article><!-- #post -->

				<?php //comments_template(); ?>
			<?php endwhile; ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>