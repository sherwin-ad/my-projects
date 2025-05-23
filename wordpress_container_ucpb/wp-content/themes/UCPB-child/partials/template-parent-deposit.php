<?php //Template Name: Deposit?>
<?php get_header(); 
include_once('inc-partial/banner.php'); ?>
<style>
   .page-template-partialstemplate-parent-deposit-php .header_logo > img {
    padding: 0 00 0;
    width: 100%;
    max-width: 250px;
    object-fit: contain;
    height: auto;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/template.page.css">
        <div class="container">
            <div class="theTitle">
                <h1><?php echo get_the_title() ?></h1>
                <hr>
            </div>
            <div class="site-content">
                <?php the_content(); ?> 
                
                <!-- product menu goes here use get template parts -->
                <?php get_template_part( 'template-parts/content', 'products-default-menu' ); ?>

                <!-- loan calculator goes here use get template parts -->
                <? //php get_template_part( 'template-parts/content', 'products-loancalculator' ); ?>
        </div>
    </div>          

        

<?php get_footer(); ?>