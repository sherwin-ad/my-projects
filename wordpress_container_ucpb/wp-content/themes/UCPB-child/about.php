<?php
/**
 * Template Name: About
 * Description: A custom template to display the About using an ACF relationship field.
 */

get_header();
include_once('inc/banner.php'); 
?>

<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); 
include_once('inc/banner.php');
?>



	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
      <div class="container">


		<?php if (have_rows('tabs')): ?>
  <div class="tabs-container">
    <!-- Tabs Menu -->
    <ul class="tabs-menu">
      <?php
      $i = 0;
      while (have_rows('tabs')): the_row();
        $tab_name = get_sub_field('title');
        $true = get_sub_field('director_profiles');
        
        ?>
        <li class="tab <?php echo $i === 0 ? 'active' : ''; ?>" data-tab="tab<?php echo $i; ?>">
          <?php echo esc_html($tab_name); ?>
        </li>
        <?php $i++; ?>
      <?php endwhile; ?>
    </ul>

    <!-- Tabs Content -->
    <div class="tabs-content">
      <?php
      $i = 0; // Reset counter for content
      while (have_rows('tabs')): the_row();
        $tab_content = get_sub_field('content');
        $tab_title = get_sub_field('content');
         $chart_title = get_field('organization_chart_title');
        $chart_link = get_field('organization_chart_link');
        ?>
        <div id="tab<?php echo $i; ?>" class="tab-content <?php echo $i === 0 ? 'active' : ''; ?>">
          <?php echo $tab_content; ?>
          <?php if (get_sub_field('our_people') == "true"): ?>
            <div class="news_and_event_btn orc-btn">
                <a href="<?= $chart_link; ?>" target="_blank"><?= $chart_title; ?> <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_287_1506)">
                      <path d="M15 5L13.59 6.41L18.17 11H2V13H18.17L13.58 17.59L15 19L22 12L15 5Z" fill="white"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_287_1506">
                        <rect width="24" height="24" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
                  </a>
            </div>
          <!-- Board of Directors -->
           
          <?php
                
                $directors_board = get_field('board_of_directors'); // Fetch the directors from the ACF relationship field
                if ($directors_board): ?>
                <div class="board-directors">
                <h2 class="board-directors-title">Board of Directors</h2>
                <div class="column-grp">
                        <?php 
                        foreach ($directors_board as $index => $directors_boards): 
                            $thumbnail = get_the_post_thumbnail($directors_boards->ID, 'medium'); // Get the thumbnail
                            $title = get_the_title($directors_boards->ID); // Get the title
                            $position = get_field('postion', $directors_boards->ID); // Get the custom field 'position'
                            
                            // Determine column class for the first director
                            $colClass = $index === 0 ? 'col-md-4 col-xl-12' : 'col-md-4 col-xl-2'; 
                        ?>
                            <div class="<?php echo $colClass; ?>">
                                <div class="board-director-card">
                                    <?php if ($thumbnail): ?>
                                        <div class="director-thumbnail">
                                            <?php echo $thumbnail; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="board-director-card">
                                        <h3><?php echo esc_html($title); ?></h3>
                                        <p><?php echo esc_html($position); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
          
                <?php endif; ?>

              <!-- Board of Directors -->
               <hr style="margin:3rem 0;">
             <!-- Senior Management -->    
            <?php
             $senior = get_field('senior_management'); // Fetch the directors from the ACF relationship field
                if ($senior): ?>
                <div class="senior-management">
                <h2 class="senior-management-title">Senior Management</h2>
                <div class="column-grp">
                        <?php 
                        foreach ($senior as $index => $seniors): 
                            $thumbnail = get_the_post_thumbnail($seniors->ID, 'medium'); // Get the thumbnail
                            $title = get_the_title($seniors->ID); // Get the title
                            $position = get_field('postion', $seniors->ID); // Get the custom field 'position'
                            
                            // Determine column class for the first director
                            $colClass = $index === 0 ? 'col-md-4 col-xl-12' : 'col-md-4 col-xl-2'; 
                        ?>
                            <div class="<?php echo $colClass; ?>">
                                <div class="senior-management-thumbnail">
                                    <?php if ($thumbnail): ?>
                                        <div class="director-thumbnail">
                                            <?php echo $thumbnail; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="senior-management-card">
                                        <h3><?php echo esc_html($title); ?></h3>
                                        <p><?php echo esc_html($position); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
          
                <?php endif; ?>
                      
                <!-- Senior Management -->  
            <?php endif; ?>                       
          <?php if (get_sub_field('director_profiles') == "true"): ?>
          <!-- div.director-profile -->
          <?php 
          $directors = get_field('directors_profiles_list');
          if ($directors):
          ?>
          <div class="option-list">
              <div class="column-grp">
                  <?php 
               
                  foreach ($directors as $director): 
                    
                      $thumbnail = get_the_post_thumbnail($director->ID);
                      $title = get_the_title($director->ID);
                      $content = get_the_content(null, false, $director);
                      $position = get_field('postion', $director->ID); 
                     $citizenship = get_field('citizenship', $director->ID); 
                  ?>
                      <div class="col-md-4 col-xl-2">
                          <?php echo $thumbnail; // Display the thumbnail ?>
                      </div>
                      <div class="col-md-4 col-xl-7">
                        <h2><?php echo $title; // Display the content ?></h2>
                        <?php if ($position): ?>
                          <h3><?php echo $position; ?></h3> 
                        <?php endif; ?>
                        <?php if ($citizenship): ?>
                       <span><?php echo $citizenship; ?></span>
                       <?php endif; ?>
                       <p><?php echo $content; // Display the content ?></p> 
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>
          <?php endif;?>
          <?php endif; ?>

        </div>
        <?php $i++; ?>
      <?php endwhile; ?>
    </div>
  </div>
<?php endif; ?>



			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

				<?php //comments_template(); ?>
			<?php endwhile; ?>
      </div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>