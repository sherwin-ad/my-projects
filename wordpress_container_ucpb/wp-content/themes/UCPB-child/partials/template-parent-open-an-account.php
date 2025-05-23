<?php //Template Name: Open an Account?>
<?php get_header(); 
include_once('inc-partial/banner.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/template.page.css">
        <div class="container">
            <div class="theTitle">
                <h1><?php echo get_the_title() ?></h1>
            </div>
          <hr>
            <div class="site-content">
                <?php the_content(); ?>   	
            </div>
        </div>
    </div>
<style>
    .site-content {
        text-align:center;
    }
    .table-center {
        display: flex;
        justify-content: center;
    }
    td,table,th {
    border: none;
    background: none;
    }
</style>             
                   

        

<?php get_footer(); ?>