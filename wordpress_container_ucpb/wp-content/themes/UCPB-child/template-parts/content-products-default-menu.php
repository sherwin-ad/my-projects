<div class="display-submenu">
                    <?php if (have_rows('sub_menu')): 
                        ?>
                            <?php while (have_rows('sub_menu')): the_row(); 
                               $page_link = get_sub_field('page_links');
                            $url_link = get_sub_field('link_url');
                                   $image = get_sub_field('image');
                                // Piliin ang final link
                                $final_link = $url_link ? $url_link : $page_link;
                                
                                // I-set ang target attribute kung external (url_link)
                                $target = $url_link ? ' target="_blank" rel="noopener noreferrer"' : '';
                            ?>
                                <?php if($image) { ?>
                                    <div class="box-submenu" style="background-image: url('<?php echo $image ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                <?php } else { ?>
                                    <div class="box-submenu" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/deposits.png'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                <?php } ?>
                                     <a href="<?php echo esc_url($final_link); ?>"<?php echo $target; ?>>
                                            <h3 class="sub-titlemenu"><?php the_sub_field('title')?></h3>
                                        </a>
                                </div>
                            <?php endwhile; ?>  
                        <?php else: ?>
                            <p>No items found.</p>
                    <?php endif; ?> 
                </div>