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
include('inc/banner-archive.php'); 
?>

<div id="primary" class="content-area">
    <div id="content" class="site-content branches-main" role="main">
        <div class="container ">
            <div class="column-grp"> <!-- Dito natin ilalagay ang row para maayos ang alignment -->
            <div class="col-md-4 col-xl-12">
                    <div class="search-arhive">
                        <div class="filter-sidebar">
                            <h2>Look for our nearest UCPB Savings Bank Branches and Lending Offices.</h2>
                            <?php echo do_shortcode('[searchandfilter id="145"]'); ?>
                        </div>
                    </div>
                </div>
               
                <!-- Content Section -->
                <div class="col-md-8 col-xl-12">
                    <?php if ( have_posts() ) : ?>
                        <header class="archive-header">
                            <h2 class="archive-title">Branches & Lending Offices</h2>
							<hr>
                        </header>

                        <section class="branches">
                            <div class="branches-wrapper">
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <?php get_template_part( 'template-parts/content', 'branches', array( 'format' => get_post_format() ) ); ?>
                                <?php endwhile; ?>
                            </div>
                        </section>

                    <?php else : ?>
                        <?php get_template_part( 'template-parts/content', 'none' ); ?>
                    <?php endif; ?>
                </div>
                <!-- Add Pagination Here -->
<div class="pagination-container">
    <?php custom_pagination(); ?>
</div>

				 <!-- Sidebar Section -->
				 <div class="col-md-4 col-xl-3">
                    
                </div>


            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
