<?php
/**
 * Template Name: careers
 * Description: A custom template to display the About using an ACF relationship field.
 */
acf_form_head(); 
get_header();
include_once('inc/banner.php'); 
?>
<style>
    .acf-form-submit input.btn.btn-success  {
  display: flex;
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

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <div class="container">
            <div class="column-grp page-careers" style="display: flex; gap: 20px;">
                    <?php 
                    $officer_content = get_field('officer_content');
                    $staff_content = get_field('staff_content');
                    ?>

                    <div class="col-md-5 col-xl-5">
                    <?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>

					<div class="page-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
					</div>
	
			<?php endwhile; ?>

                        <div class="tab-container" style="display: flex; gap: 10px; margin-bottom: 20px;">
                            <button id="officerTab" class="tab active" onclick="showTab('officer')" style="flex: 1; padding: 10px; border: 1px solid #ccc;  border-radius: 8px; background: #00b14f; color: white;">Officer</button>
                            <button id="staffTab" class="tab" onclick="showTab('staff')" style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 8px; background: white; color: #555;">Staff</button>
                        </div>

                        <!-- Officer Content -->
                        <div id="officerContent" class="tab-content" style="display: block;">
                            <?php if ($officer_content) : ?>
                                <?php echo $officer_content; ?>
                            <?php else : ?>
                                <p>No officer job opportunities available at the moment.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Staff Content -->
                        <div id="staffContent" class="tab-content" style="display: none;">
                            <?php if ($staff_content) : ?>
                                <?php echo $staff_content; ?>
                            <?php else : ?>
                                <p>No staff job opportunities available at the moment.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <div class="col-md-5 col-xl-5">
                    <p>Are you interested in joining our team? Fill out the form below to contact us. Please fill out all required information noted with an asterisk.</p>
                <div class="contact-form">
				        <?php
        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            
            query_posts( array( 
                'post_type'      => 'careers', 
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );
            
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                   $postID = get_the_id();
                    $first_name = get_field('first_name' , $postID);
                    $last_name = get_field('last_name', $postID);
                    $email_address = get_field('email_address', $postID);
                    $contact_no= get_field('contact_no', $postID);
                    $subject = get_field('subject', $postID);
                    $message = get_field('message', $postID);
                   $resume = get_field('resume', $postID);
                    $title = get_the_title();
                    $emailtoSend = 'usbcareers@ucpbsavings.com';
                    $emailName = 'UCPBS';
                    $emailSubject = "UCPB Savings Careers Email Notification";
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
                                <div class="email-row"><span class="label">First Name:</span> ' . esc_html($first_name) . '</div>
                                <div class="email-row"><span class="label">Last Name:</span> ' . esc_html($last_name) . '</div>
                                <div class="email-row"><span class="label">Email Address:</span> ' . esc_html($email_address) . '</div>
                                <div class="email-row"><span class="label">Contact No:</span> ' . esc_html($contact_no) . '</div>
                                <div class="email-row"><span class="label">Subject:</span> ' . esc_html($subject) . '</div>
                                <div class="email-row"><span class="label">Message:</span><br>' . nl2br(esc_html($message)) . '</div>' .
                                (!empty($resume) ? '<div class="email-row"><span class="label">Resume:</span> <a href="' . $resume . '" target="_blank">Download Resume</a></div>' : '') . '
                            </div>
                        </body>
                    </html>
                        ';
                    
                   
                    // echo $emailtoSend;
                       include( get_stylesheet_directory() . '/email/email-notification.php' );
                    echo '<h1 style="color:var(--GREEN-100, #00984B); text-align:center; margin:4rem 0;">"We appreciate your business. Thank you for banking with us."</h1>';
                    echo '<style> #acf-form { display:none } </style>';
                    
                endwhile;
            endif;
            
            wp_reset_query(); // Always reset after using query_posts
        
            
            
        }else {
        ?>
        <!-- acf form -->
        <?php 
        acf_form(array(
            'post_id'		=> 'new_post',
            'post_title'	=> false,
            'post_content'	=> false,
            'uploader' => 'basic',
            'new_post'		=> array(
                'post_type'		=> 'careers',
                'post_status'	=> 'publish'
            ),
            'field_groups'  => array('group_67dce25fe9bf9'), // Use the group key
            'html_submit_button'  => '<input type="submit" class="btn btn-success" value="Send Inquiry" />',
            'return' => add_query_arg('success', 'true', get_permalink())
        )); 
    } ?>
					</div>
                <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post(); ?>
                            <div><?php the_content(); ?></div>

                        <?php endwhile; 
                    endif;
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showTab(tab) {
    const $officerTab = $('#officerTab');
    const $staffTab = $('#staffTab');

    $('#officerContent').toggle(tab === 'officer');
    $('#staffContent').toggle(tab === 'staff');

    if (tab === 'officer') {
        $officerTab.css({ background: '#00b14f', color: 'white' });
        $staffTab.css({ background: 'white', color: '#555' });
    } else {
        $staffTab.css({ background: '#00b14f', color: 'white' });
        $officerTab.css({ background: 'white', color: '#555' });
    }
}

</script>

<?php get_footer(); ?>