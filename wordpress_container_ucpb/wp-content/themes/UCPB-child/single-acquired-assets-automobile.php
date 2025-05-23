<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<style>
.full-banner {
    position: relative;
    width: 100%;
    height: 400px;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.banner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(270deg, rgba(23, 163, 81, 0.00) 0%, var(--GREEN-100, rgba(0, 152, 75, 0.42)) 100%);
}

.banner-content {
    position: relative;
    text-align: center;
    z-index: 2;
}

.post-content {
    max-width: 800px;
    margin: 40px auto;
    padding: 0 20px;
}
header.entry-header h1 {
    color: var(--GREEN-100, #00984B);
    text-align: center;
    font-family: "Work Sans";
    font-size: 36px;
    font-style: normal;
    font-weight: 700;
    line-height: 125%;
    letter-spacing: 0.36px;
}
header p.date {
    color: var(--DARK-BLUE-80, #444058);
    text-align: center;
    font-family: "Work Sans";
    font-size: 21px;
    font-style: normal;
    font-weight: 400;
    line-height: 125%;
}
.entry-content {
    margin-top: 3rem;
}
header hr {
    background: linear-gradient(90deg, #00de6c 0%, #06984b 100%), var(--GREEN-100, #00984b);
    width: 216px;
    height: 18px;
    border: unset;
    margin: 0 auto;
    text-align: center;
}
.entry-content img {
    margin: 2rem 0;
}
</style>


<div class="full-banner" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
    <div class="banner-overlay">
        <div class="banner-content">
            <p></p>
        </div>
    </div>
</div>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<section class="branches pt-2">
    <div class="container">
        <header class="page-header mt-5">
            <h2 class="service_title">Related Article test</h2>
        </header>
        <div class="branches-wrapper">
            <?php
            $post_type = get_post_type();
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
    </div>
</section>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
