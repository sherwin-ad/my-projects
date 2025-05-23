<?php
/**
 * Template Name: Branches
 * Description: A custom template to display the About using an ACF relationship field.
 */

get_header();
include_once('inc/banner.php'); 
?>


<style>
    a.view-more-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #114a85;
        color: #fff;
        margin-top: 15px;
    }
    
    hr {
        margin: 30px 0;
    }
    
    h2.registry-title {
        font-size: 20px;
        margin-bottom: 15px;
    }
    
    .archive-header-page h1 {
        padding-top: 40px;
        margin-bottom: 50px;
    }
</style>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

        <header class="archive-header-page">
            <h1>Branches</h1>
        </header><!-- .archive-header -->

        <div class="three_fourth">
            <?php
            // WP_Query for the custom post type 'branches'
            $branches_query = new WP_Query([
                'post_type' => 'branches',
                'posts_per_page' => 10, // Number of posts to display per page
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
            ]);

            if ( $branches_query->have_posts() ) :
                while ( $branches_query->have_posts() ) :
                    $branches_query->the_post(); ?>
                    <div class="one_third">
                        <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
                            <div class="entry-thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php else : ?>
                            <div class="entry-thumbnail"></div>
                        <?php endif; ?>
                    </div>
                    <div class="two_third last">
                        <h2 class="registry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h2>
                        <a class="view-more-btn" href="<?php the_permalink(); ?>" rel="bookmark">View More</a>
                    </div>
                    <div class="clear"></div>
                    <hr />
                <?php endwhile; ?>

                <div class="pagination">
                    <?php
                    echo paginate_links([
                        'total' => $branches_query->max_num_pages,
                        'current' => max( 1, get_query_var( 'paged' ) ),
                        'format' => '?paged=%#%',
                        'show_all' => false,
                        'prev_text' => __('&laquo; Previous'),
                        'next_text' => __('Next &raquo;'),
                    ]);
                    ?>
                </div>
            <?php else : ?>
                <p><?php esc_html_e( 'No branches found.', 'your-theme-text-domain' ); ?></p>
            <?php endif;

            // Reset post data
            wp_reset_postdata();
            ?>
        </div>

        <div class="one_fourth last">
            <div class="filter-sidebar">
                <?php echo do_shortcode('[searchandfilter id="145"]'); ?>
            </div>
        </div>

        <div class="clear"></div>
    </div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
