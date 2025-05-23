<?php //Template Name: Product and Services ?>
<?php get_header(); 
include_once('inc-partial/banner.php'); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/template.page.css">
        <div class="container">
            <div class="theTitle">
                <h1><?php echo get_the_title() ?></h1>
            </div>
            <div class="site-content">
                <?php the_content(); ?> 
                <hr>
                <div class="display-submenu">
                    <?php if (have_rows('sub_menu')): 
                   
                        ?>
                            <?php while (have_rows('sub_menu')): the_row(); ?>
                            <?php
                                  $page_link = get_sub_field('page_links');
                                   $image = get_sub_field('image');
                            ?>
                                <?php if($image) { ?>
                                 <div class="box-submenu" style="background-image: url('<?php echo esc_url($image); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                <?php } else { ?>
                                    <div class="box-submenu" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/deposits.png'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                <?php } ?>
                                        <a href="<?php the_sub_field('page_links')?>">
                                            <h3 class="sub-titlemenu"><?php the_sub_field('title')?></h3>
                                        </a>
                                </div>
                            <?php endwhile; ?>  
                        <?php else: ?>
                            p>No items found.</p>
                    <?php endif; ?> 
                </div>
        </div>
    </div>          

        

<?php get_footer(); ?>