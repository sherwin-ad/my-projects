<?php
add_theme_support( 'title-tag' );
if ( ! isset( $content_width ) ) {
	$content_width = 604;
}

/**
 * Add support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

/**
 * Block Patterns.
 *
 * @since Twenty Thirteen 3.4
 */
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Twenty Thirteen setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentythirteen
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width. When fonts are
	 * self-hosted, the theme directory needs to be removed first.
	 */
	$font_stylesheet = str_replace(
		array( get_template_directory_uri() . '/', get_stylesheet_directory_uri() . '/' ),
		'',
		twentythirteen_fonts_url()
	);
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', $font_stylesheet ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for custom color scheme.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Dark Gray', 'twentythirteen' ),
				'slug'  => 'dark-gray',
				'color' => '#141412',
			),
			array(
				'name'  => __( 'Red', 'twentythirteen' ),
				'slug'  => 'red',
				'color' => '#bc360a',
			),
			array(
				'name'  => __( 'Medium Orange', 'twentythirteen' ),
				'slug'  => 'medium-orange',
				'color' => '#db572f',
			),
			array(
				'name'  => __( 'Light Orange', 'twentythirteen' ),
				'slug'  => 'light-orange',
				'color' => '#ea9629',
			),
			array(
				'name'  => __( 'Yellow', 'twentythirteen' ),
				'slug'  => 'yellow',
				'color' => '#fbca3c',
			),
			array(
				'name'  => __( 'White', 'twentythirteen' ),
				'slug'  => 'white',
				'color' => '#fff',
			),
			array(
				'name'  => __( 'Dark Brown', 'twentythirteen' ),
				'slug'  => 'dark-brown',
				'color' => '#220e10',
			),
			array(
				'name'  => __( 'Medium Brown', 'twentythirteen' ),
				'slug'  => 'medium-brown',
				'color' => '#722d19',
			),
			array(
				'name'  => __( 'Light Brown', 'twentythirteen' ),
				'slug'  => 'light-brown',
				'color' => '#eadaa6',
			),
			array(
				'name'  => __( 'Beige', 'twentythirteen' ),
				'slug'  => 'beige',
				'color' => '#e8e5ce',
			),
			array(
				'name'  => __( 'Off-white', 'twentythirteen' ),
				'slug'  => 'off-white',
				'color' => '#f7f5e7',
			),
		)
	);

	// Add support for block gradient colors.
	add_theme_support(
		'editor-gradient-presets',
		array(
			array(
				'name'     => __( 'Autumn Brown', 'twentythirteen' ),
				'gradient' => 'linear-gradient(135deg, rgba(226,45,15,1) 0%, rgba(158,25,13,1) 100%)',
				'slug'     => 'autumn-brown',
			),
			array(
				'name'     => __( 'Sunset Yellow', 'twentythirteen' ),
				'gradient' => 'linear-gradient(135deg, rgba(233,139,41,1) 0%, rgba(238,179,95,1) 100%)',
				'slug'     => 'sunset-yellow',
			),
			array(
				'name'     => __( 'Light Sky', 'twentythirteen' ),
				'gradient' => 'linear-gradient(135deg,rgba(228,228,228,1.0) 0%,rgba(208,225,252,1.0) 100%)',
				'slug'     => 'light-sky',
			),
			array(
				'name'     => __( 'Dark Sky', 'twentythirteen' ),
				'gradient' => 'linear-gradient(135deg,rgba(0,0,0,1.0) 0%,rgba(56,61,69,1.0) 100%)',
				'slug'     => 'dark-sky',
			),
		)
	);

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	/*
	 * This theme supports all available post formats by default.
	 * See https://wordpress.org/documentation/article/post-formats/
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video',
		)
	);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

if ( ! function_exists( 'twentythirteen_fonts_url' ) ) :
	/**
	 * Return the font stylesheet URL, if available.
	 *
	 * The use of Source Sans Pro and Bitter by default is localized. For languages
	 * that use characters not supported by the font, the font can be disabled.
	 *
	 * @since Twenty Thirteen 1.0
	 * @since Twenty Thirteen 3.8 Replaced Google URL with self-hosted fonts.
	 *
	 * @return string Font stylesheet or empty string if disabled.
	 */
	function twentythirteen_fonts_url() {
		$fonts_url = '';

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Source Sans Pro, translate this to 'off'. Do not translate into your own language.
		 */
		$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Bitter, translate this to 'off'. Do not translate into your own language.
		 */
		$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

		if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
			$font_families = array();

			if ( 'off' !== $source_sans_pro ) {
				$font_families[] = 'source-sans-pro';
			}

			if ( 'off' !== $bitter ) {
				$font_families[] = 'bitter';
			}

			$fonts_url = get_template_directory_uri() . '/fonts/' . implode( '-plus-', $font_families ) . '.css';
		}

		return $fonts_url;
	}
endif;

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20210122', true );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	$font_version = ( 0 === strpos( (string) twentythirteen_fonts_url(), get_template_directory_uri() . '/' ) ) ? '20230328' : null;
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), $font_version );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '20230328' );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentythirteen-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'twentythirteen-style' ), '20230122' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '20150214' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );

	// Enqueue specific CSS for the page.php template.
	if (is_page()) {
		wp_enqueue_style( 'twentythirteen-page-css', get_stylesheet_directory_uri() . '/css/page-template.css', array(), '20250124' );
	}
	   // Enqueue specific CSS for the about.php template.
	if (is_page_template('about.php')) {
        wp_enqueue_style('twentythirteen-directores-css', get_stylesheet_directory_uri() . '/css/directores.css', array(), '20250124');
         wp_enqueue_script(
        'about-page-js',
        get_stylesheet_directory_uri() . '/js/about.js',
        array('jquery'),
        '20250124',
        true
    );
    } 
	if (is_page_template('page-contact.php') || is_page_template('page-careers.php')) {
        wp_enqueue_style('twentythirteen-directores-css', get_stylesheet_directory_uri() . '/css/contact-style.css', array(), '20250124');
    } 
	  // Enqueue specific CSS for the archive-branches post type.
	  if (is_post_type_archive('branches')) {
        wp_enqueue_style('twentythirteen-archive-branches-css', get_stylesheet_directory_uri() . '/css/archive-branches.css', array(), '20250124');
    }
	if (is_post_type_archive('news-events')) {
        wp_enqueue_style('twentythirteen-archive-branches-css', get_stylesheet_directory_uri() . '/css/archive-newsevents.css', array(), '20250124');
    }
	if (is_singular()) {
        wp_enqueue_style('twentythirteen-singular-css', get_stylesheet_directory_uri() . '/css/single.css', array(), '20250124');
    }
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

function ensure_jquery() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'ensure_jquery');

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {
    // Check if the ACF function exists
    if (function_exists('acf_add_options_page')) {

        // Register the first options page
        $option_page = acf_add_options_page(array(
            'page_title'    => __('General Settings', 'text-domain'),
            'menu_title'    => __('General Settings', 'text-domain'),
            'menu_slug'     => 'general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false,
            'position'      => 80,
            'icon_url'      => 'dashicons-admin-settings',
        ));

    }
}
function custom_taxonomy_query( $query ) {
    // Check if it's the main query and a taxonomy archive
    if ( $query->is_main_query() && !is_admin() && is_tax('services') ) {
        // Modify the query, for example, ordering by date
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'custom_taxonomy_query');

// Ensure Classic Editor is used
add_filter('use_block_editor_for_post', '__return_false');

// Add custom classes to TinyMCE (links + tables)
function custom_tinymce_classes( $settings ) {
    // Custom link classes
    $settings['link_class_list'] = json_encode([
        ['title' => 'Button Link', 'value' => 'btn-link'],
        ['title' => 'Custom Link', 'value' => 'custom-link'],
        ['title' => 'Highlight Link', 'value' => 'highlight-link'],
    ]);

    // Custom table classes
    $settings['table_class_list'] = json_encode([
        ['title' => 'Default', 'value' => ''],
        ['title' => 'Custom Table', 'value' => 'custom-table'],
        ['title' => 'Striped Table', 'value' => 'striped-table'],
        ['title' => 'Bordered Table', 'value' => 'bordered-table'],
         ['title' => 'Full Width', 'value' => 'full-widht']
    ]);

    return $settings;
}

// Apply to TinyMCE on admin init
add_action('admin_init', function() {
    add_filter('tiny_mce_before_init', 'custom_tinymce_classes');
});

function acf_accordion_shortcode() {
    if (!function_exists('get_field')) {
        return 'ACF plugin is required for this feature.';
    }

    $accordion_items = get_field('accordion'); // Kunin ang repeater field
    if (!$accordion_items) {
        return 'No accordion data found.';
    }

    ob_start();
    ?>
    <style>
        .custom-accordion {
            width: 100%;
        }
        .accordion-item {
            border: 1px solid #ccc;
            margin-bottom: 5px;
        }
        .accordion-header {
            background: #ddd;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
        }
        .accordion-content {
            display: none;
            padding: 10px;
            background: #f9f9f9;
        }
    </style>

    <div class="custom-accordion">
        <?php foreach ($accordion_items as $item) : ?>
            <div class="accordion-item">
                <div class="accordion-header"><?php echo esc_html($item['title']); ?> (Click to Reveal)</div>
                <div class="accordion-content"><?php echo wp_kses_post($item['content']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('.accordion-header').click(function() {
                $(this).next('.accordion-content').slideToggle();
                $(this).parent().siblings().find('.accordion-content').slideUp();
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('acf_accordion', 'acf_accordion_shortcode');


function custom_pagination($query = null) {
    global $wp_query;
    $query = $query ? $query : $wp_query;

    $big = 999999999; // Need an unlikely integer

    $pagination_links = paginate_links( array(
        'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'  => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total'   => $query->max_num_pages,
        'prev_text' => __('« Previous'),
        'next_text' => __('Next »'),
        'type'    => 'array'
    ));

    if (!empty($pagination_links)) {
        echo '<nav class="pagination"><ul class="pagination-list">';
        foreach ($pagination_links as $link) {
            echo '<li>' . $link . '</li>';
        }
        echo '</ul></nav>';
    }
}

function custom_mce_buttons($buttons) {
    array_push($buttons, "gallery_button");
    return $buttons;
}

function custom_mce_plugin($plugin_array) {
    $plugin_array['gallery_button_script'] = get_template_directory_uri() . '/js/custom-tinymce.js';
    return $plugin_array;
}

function add_tinymce_gallery_button() {
    add_filter("mce_external_plugins", "custom_mce_plugin");
    add_filter("mce_buttons", "custom_mce_buttons");
}

add_action("admin_head", "add_tinymce_gallery_button");

function custom_gallery_output($output, $atts) {
    if (!empty($output)) {
        error_log("Gallery filter applied!");

        // Magdagdag ng custom classes sa gallery div
        $output = str_replace('class="gallery', 'class="gallery gallery-image owl-carousel owl-theme', $output);

        // Siguraduhin na hindi ma-strip ng security filter
        return wp_kses_post($output);
    }

    return $output;
}

add_filter('post_gallery', 'custom_gallery_output', 10, 2);


function display_branches_phone_dropdown() {
    $args = array(
        'post_type'      => 'branches',  
        'posts_per_page' => -1,          
        'orderby'        => 'title',
        'order'          => 'ASC'
    );

    $branches = new WP_Query($args);

    if ($branches->have_posts()) {
        $output = '<select name="branch_phone" id="branch_phone">';
        $output .= '<option value="">Select a Branch</option>';

        while ($branches->have_posts()) {
            $branches->the_post();
            $phone_number = get_field('phone_number');
            $phone_number2 = get_field('phone_number2'); // Correctly fetching phone_number2

            if ($phone_number || $phone_number2) {
                $combined_phone = trim($phone_number . ' ' . $phone_number2); // Ensuring no extra space

                $output .= '<option value="' . esc_attr($combined_phone) . '">' . get_the_title() . ' - ' . esc_html($combined_phone) . '</option>';
            }
        }

        $output .= '</select>';
        wp_reset_postdata();
    } else {
        $output = '<p>No branches found.</p>';
    }

    return $output;
}
add_shortcode('branches_phone_dropdown', 'display_branches_phone_dropdown');

// auto counter 
add_action('acf/save_post', 'set_yearly_counter_title_on_submit', 20);
function set_yearly_counter_title_on_submit($post_id) {
    // Only apply to 'deposit-opening' post type
    if (get_post_type($post_id) !== 'deposit-opening') {
        return;
    }

    // Prevent this from running on autosave or revisions
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check if title already exists to avoid overwriting existing ones
    $current_title = get_the_title($post_id);
    if (!empty($current_title)) {
        return;
    }

    $year = date('Y');
    $option_key = 'deposit_opening_counter_' . $year;

    // Get current counter value for the year
    $counter = get_option($option_key, 0);
    $counter++;

    // Save updated counter
    update_option($option_key, $counter);

    // Format counter with leading zeroes (e.g., 00001)
    $formatted_counter = str_pad($counter, 5, '0', STR_PAD_LEFT);

    // Build title: 2025-00001 Application Form
    $title = $year . '-' . $formatted_counter . ' Application Form';

    // Update post title
    wp_update_post(array(
        'ID'         => $post_id,
        'post_title' => $title,
    ));
}


function sort_news_events_by_date( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'news-events' ) ) {
        $query->set( 'orderby', 'date' );
        $query->set( 'order', 'DESC' );
    }
}
add_action( 'pre_get_posts', 'sort_news_events_by_date' );

