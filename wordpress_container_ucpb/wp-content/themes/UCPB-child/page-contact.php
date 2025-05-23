<?php
/**
 * Template Name: Contact
 * Description: A custom template to display the About using an ACF relationship field.
 */
acf_form_head();
get_header();

include_once('inc/banner.php'); 
?>
<style>
 .contact    ul.acf-radio-list.acf-bl li {
    margin: 0 10px 0 0;
}
  .contact .acf-bl:before {
    display:none !important;
}
.acf-form-submit input {
    display: flex
;
    padding: 15px 59px;
    align-items: center;
    gap: 16px;
    border-radius: 16px;
    background: linear-gradient(90deg, #06984b 0%, #00de6c 100%);
    color: #eee;
    text-align: center;
    font-family: "Work Sans";
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    border: unset;
}
</style>
<div id="primary" class="content-area ">
		<div id="content" class="site-content" role="main">
        <div class="container contact">
            <div class="column-grp">
                <div class="col-md-5 col-xl-5">
                <?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">

						<h2 class="entry-title"><?php the_title(); ?></h2>
					</header><!-- .entry-header -->


					<div class="entry-content">
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
					</div><!-- .entry-content -->


				</article><!-- #post -->
				<div class="social-icon">
				<h3>Follow Us</h3>
				<span>UCPBS.KASAMAMO</span>	
				<h3>Contact Number</h3>
			<?php echo do_shortcode('[branches_phone_dropdown]'); ?>
				</div>
		
			<?php endwhile; ?>

                </div>
                <div class="col-md-5 col-xl-5">
					<div class="contact-form">
		<?php
		 if (isset($_GET['success']) && $_GET['success'] == 'true') {
            
            query_posts( array( 
                'post_type'      => 'contact-form', 
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );
            
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                   $postID = get_the_id();
                     $concern = get_field('type_of_concern' , $postID);
                    $first_name = get_field('first_name' , $postID);
                    $last_name = get_field('last_name', $postID);
                    $email_address = get_field('email_address', $postID);
                    $contact_no= get_field('contact_no', $postID);
                    $subject = get_field('subject', $postID);
                    $message = get_field('message', $postID);
                    $title = get_the_title();
                   $emailtoSend = 'USB-CAMU@ucpbsavings.com';
                    $emailName = 'UCPS';
                    $emailSubject = "UCPB Savings Contact Us Email Notification";
                  $emailContent = '
                    <html>
                        <head>
                            <style>
                                body { font-family: Arial, sans-serif; color: #333; }
                                .email-container { padding: 20px; border: 1px solid #ddd; background: #f9f9f9; }
                                .email-header { font-size: 18px; font-weight: bold; margin-bottom: 20px; }
                                .email-row { margin-bottom: 10px; }
                                .label { font-weight: bold; display: inline-block; width: 150px; }
                            </style>
                        </head>
                        <body>
                            <div class="email-container">
                                <div class="email-header">' . $emailSubject . '</div>
                                <div class="email-row"><span class="label">Type of Concern:</span> ' . esc_html($concern) . '</div>
                                <div class="email-row"><span class="label">First Name:</span> ' . esc_html($first_name) . '</div>
                                <div class="email-row"><span class="label">Last Name:</span> ' . esc_html($last_name) . '</div>
                                <div class="email-row"><span class="label">Email Address:</span> ' . esc_html($email_address) . '</div>
                                <div class="email-row"><span class="label">Contact No:</span> ' . esc_html($contact_no) . '</div>
                                <div class="email-row"><span class="label">Subject:</span> ' . esc_html($subject) . '</div>
                                <div class="email-row"><span class="label">Message:</span><br>' . nl2br(esc_html($message)) . '</div>
                            </div>
                        </body>
                    </html>
                ';
                                    
                   
                    // echo $emailtoSend;
                      include( get_stylesheet_directory() . '/email/branch-notification.php' );
                    echo '<h1 style="color:var(--GREEN-100, #00984B); text-align:center; margin:4rem 0;">"We appreciate your business. Thank you for banking with us."</h1>';
                    echo '<style> #acf-form { display:none } </style>';
                    
                endwhile;
            endif;
            
            wp_reset_query(); // Always reset after using query_posts
        ?>
            
            
<?php } else { ?>
					<?php
					   
					   $date=date('M-d-Y');
					   acf_form(array(
						   'post_id' => 'new_post',
						   'field_groups' => array(
							   'group_67c68fd176e3b', 
						   ),
						   'new_post' => array(
							   'post_type' => 'contact-form', 
							   'post_title' => 'Subscriber as of '.$date.'', 
							   'post_status' => 'publish',
						   ),
						   'return' => add_query_arg('success', 'true', get_permalink()),
						   'submit_value' => __('Send Inquiry', 'acf'),
					   ));
					   } ?>
					</div>
						
						
                </div>
            </div>
        </div>
<div>
</div>
<script>
    jQuery(document).ready(function ($) {
    $('.acf-radio-list input[type="radio"]').on('change', function () {
        $('.acf-radio-list label').removeClass('selected');
        $(this).parent().addClass('selected');
    });
});

</script>

<?php get_footer(); ?>
