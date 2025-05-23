<?php //Template Name: Loan Application ?>
<?php acf_form_head(); ?>
<?php get_header(); 
?>
<style>
.list-pdf {
    padding: 0;
}
.list-pdf li {
    display:block;
    list-style: none;
    margin-bottom: 10px;
}
.list-pdf li a{
    text-decoration: none;
    color: #000;
}
.list-pdf li i {
    color: var(--GREEN-100, #00984B);
    font-size: 2rem;
}
form {
    margin: 0 auto;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #ebfef2;
}
form select, form input {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}
form label {
    margin-top: 10px;
    font-weight: bold;
}
form input[readonly] {
    background-color: #e9ecef;
}
.acf-field.acf-field-text.acf-field-67d279af73fc2 ,
.acf-field-67f8b7c8e7b47{
    display: none;
}
.btn {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    cursor: pointer;
}
.btn-success {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
}
form input[type="text"],
form select {
    padding: .375rem .75rem !important;
    font-size: 1rem !important;
    line-height: 1.5 !important;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
}
.acf-form-submit {
    margin: 0 15px;
}

<?php 
include_once('inc-partial/banner.php'); 
?>
</style>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/template.page.css">
<div class="container">
    <div class="theTitle">
        <h1><?php echo get_the_title() ?></h1>
        <hr>
    </div>
    <div class="site-content">
      
        <?php the_content(); ?>

        <?php if( have_rows('deposit_pdf') ): ?>
            <h2 style="color:var(--GREEN-100, #00984B);">List of PDF</h2>
            <hr>
            <ul class="list-pdf">
                <?php while( have_rows('deposit_pdf') ): the_row(); 
                  $pdfurl = get_sub_field('file');
                  $pdftitle = get_sub_field('title');
                ?>
                   <li>
                        <a href="<?php echo $pdfurl; ?>" target="_blank" download>
                        <i class="fas fa-file-pdf"></i>
                        <span><?php echo $pdftitle; ?></span>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No branches found.</p>
        <?php endif; ?>
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            
            query_posts( array( 
                'post_type'      => 'deposit-opening', 
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );
            
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                   $postID = get_the_id();
                //   $emailtoSend = get_field('email_address', $postID);
                    $applicationType = 'LOAN'; // or 'APPRAISAL', 'WITHDRAWAL', etc. (make this dynamic)
                    $referenceNumber = $applicationType . '-' . date('mdy-His');
                    $emailsacf =  get_field('email_address', $postID);
                    $emailname = get_field('name', $postID);
                    $branchName = get_field('selected_branch', $postID);
                    $title = get_the_title();
                   $emailtoSend = $emailsacf;
                    $emailName = $emailname;
                    $emailSubject = "UCPB Savings Email Notification";
                   $emailContent = '
                        <html>
                        <head>
                          <style>
                            body { font-family: Arial, sans-serif; color: #333; }
                            .container { padding: 20px; }
                            .header { font-size: 20px; font-weight: bold; margin-bottom: 20px; }
                            .content { margin-bottom: 20px; }
                            .box { border: 1px solid #ccc; padding: 15px; background-color: #f9f9f9; }
                            .footer { font-size: 12px; color: #777; margin-top: 30px; }
                          </style>
                        </head>
                        <body>
                          <div class="container">
                            <div class="header">Website Loan Application</div>
                        
                            <div class="content">
                              Dear ' . htmlspecialchars($branchName) . ',<br><br>
                              Client is interested for deposit opening here in ' . htmlspecialchars($branchName) . '.<br>
                              Please see attached application form.<br><br>
                              See below for details.
                            </div>
                        
                            <div class="box">
                              <strong>Deposit Application</strong><br>
                              Transaction Reference Number: ' . htmlspecialchars($referenceNumber) . '<br>
                              Account Name: ' . htmlspecialchars($emailname) . '
                            </div>
                        
                            <div class="footer">
                              *** This is an automatically generated email. Please do not reply. ***<br><br>
                              <strong>Website Deposit Application</strong><br>
                              UCPB Savings Bank<br>
                              7F Robinsons Cybergate Magnolia, Aurora Blvd.,<br>
                              corner Do単a Hemady St., New Manila, Quezon City<br>
                              (02) 811-0278<br>
                              <a href="mailto:ucpbsavings@ucpbsavings.com">ucpbsavings@ucpbsavings.com</a>
                            </div>
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
                'post_type'		=> 'deposit-opening',
                'post_status'	=> 'publish'
            ),
            'field_groups'  => array('group_67d268601556d'), // Use the group key
            'html_submit_button'  => '<input type="submit" class="btn btn-success" value="Submit" />',
            'return' => add_query_arg('success', 'true', get_permalink())
        )); 
         } ?>
        
<script>
    jQuery(document).ready(function($) {
    $('.acf-field').each(function() {
        console.log($(this)); // Check if fields are loaded
    });
});
</script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            // Fetch branch data from API
            fetch('<?php echo get_stylesheet_directory_uri(); ?>/api/branches.json')
            .then(response => response.json())
            .then(data => {
                 let nameInput = document.getElementById("acf-field_67f46980ed628");
                let dropdown = document.getElementById("acf-field_67d26882a70d1");
                let regionInput = document.getElementById("acf-field_67d268b7a70d2");
                let emailInput = document.getElementById("acf-field_67d268d7a70d3");
                let addressInput = document.getElementById("acf-field_67d268e2a70d4");
                let branchIdInput = document.getElementById("acf-field_67d279af73fc2");

                data.forEach(branch => {
                let option = document.createElement("option");
                option.value = branch.Branch;
                option.textContent = branch.Branch;
                dropdown.appendChild(option);
                });

                dropdown.addEventListener("change", function() {
                let selectedBranch = dropdown.value;
                let branchData = data.find(branch => branch.Branch === selectedBranch);

                if (branchData) {
                    // nameInput.value = branchData.name;
                    regionInput.value = branchData.Region;
                    emailInput.value = branchData.emailAddress;
                    addressInput.value = branchData.Address;
                    branchIdInput.value = branchData.Branch; // Assuming BranchID is the field in your JSON
                } else {
                     regionInput.value = "";
                    regionInput.value = "";
                    emailInput.value = "";
                    addressInput.value = "";
                    branchIdInput.value = "";
                }
                });
            })
            .catch(error => console.error("Error fetching data:", error));
            });
        </script>
    </div>
</div>          

<?php get_footer(); ?>