<?php //Template Name: OLAP ?>
<?php get_header(); ?>
<?php include('inc/banner-archive.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/template.page.css">
    <div class="background-image" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/time-deposits-background.png'); background-repeat: no-repeat; background-size: cover;"></div>
        <div class="container">
            <div class="theTitle">
                <h1><?php echo get_the_title() ?></h1>
                <hr>
            </div>
            <div class="site-content">
                <?php the_content(); ?> 
                
                <!-- product menu goes here use include -->
                <?php //get_template_part( 'template-parts/content', 'products-default-menu' ); ?>
        </div>
    </div>          

        

<?php get_footer(); ?>