<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/template.page.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/archive-assets.css">
<div class="background-image" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/time-deposits-background.png'); background-repeat: no-repeat; background-size: cover;"></div>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title">
                    <?php $archive_title = get_the_archive_title();
                    $archive_title = str_replace( 'Type of Assets: ', '', $archive_title );
                    echo $archive_title; ?>
				</h1>
			</header><!-- .archive-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>


		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
