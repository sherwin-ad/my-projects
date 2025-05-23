<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<!-- font style -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<!-- Owl Carousel CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Font  awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js?ver=3.7.0"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<style>
	    #primary-menu li {
	        position:relative;
	    }
		/* Style for sub-menu */
		.nav-menu .sub-menu {
			display: none;
			position: absolute;
			top:94%;
			background-color: #00984b;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			z-index: 1000;
		}
		.nav-menu .sub-menu .sub-menu {
			display: none;
			position: absolute;
			top:0;
			left:100%;
			background-color: #00984b;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			z-index: 1001;
			width: 100%;
		}


		.nav-menu li:hover > .sub-menu {
			display: block;
			padding:0;
		}

		.nav-menu .sub-menu li {
			position: relative;
			display: block; /* Ensure each sub-menu item is on a new line */
			padding:0;
		}

		.nav-menu .sub-menu a {
			padding: 10px 20px;
			color: #fff;
			text-decoration: none;
			display: block;
		}

		.nav-menu .sub-menu a:hover {
			background-color: #f0f0f0;
			padding: 10px 20px;
			width: -webkit-fill-available;
			color: #000;
		}
		/*ola helper*/
		.olaHelper {
            position: relative;
        }
        .ola {
            position: fixed;
            right: 50px;
            top: 80%;
            transform: translateX(10px);
            z-index: 10;
        }
        .ola img {
            cursor:pointer;
        }
        .olaBtns {
            position: fixed;
            right: 190px;
            top: 82%;
            transform: translateX(0px);
            z-index: 10;
        }
        .olaList {
            display:block;
            list-style:none;
            margin-bottom:2rem;
            text-align:right;
        }
        a.ola_btn {
            background: linear-gradient(45deg, #00984B, #00ED75);
            padding: 10px 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            border-bottom-left-radius: 8px;
            color: #fff;
            text-decoration: none;
            font-size: 21px;
            font-weight: 700;
            line-height: 125%;
            letter-spacing: 0%;
        }
        
        /*Search*/
        .search-wrapper {
              position: relative;
              display: inline-block;
              margin-top:17px;
              padding:0 1rem;
            }
            
            .search-box {
              display: none;
              position: absolute;
              top: 100%;
              right: 0;
              background: white;
              padding: 1rem;
              box-shadow: 0 4px 8px rgba(0,0,0,0.1);
              z-index: 100;
              width: 300px; /* adjust width as needed */
            }
            
            .search-wrapper:hover .search-box {
              display: block;
            }
            
            /* Optional: style input and button */
            .search-box input[type="search"] {
              width: 100%;
              padding: 8px;
              border: 1px solid #ccc;
            }
          .search-wrapper   form.search-form {
            display: flex;
        }
.search-wrapper  input.search-submit {
    /* background: #00DB6B; */
    border: unset;
    color: #fff;
    font-size: 15px;
    font-weight: 400;
    background: linear-gradient(90deg, #00de6c 0%, #06984b 100%), var(--GREEN-100, #00984b) !important;
}
.search-box input[type="search"] {
  border: 1px solid #ccc;
  outline: none;
  padding: 8px 10px;
  font-size: 14px;
  width: 200px;
  background-color: #fff;
  color: #000;
  box-shadow: none;
}

.search-box input[type="search"]::placeholder {
  color: #999;
}
	</style>
	<div id="page" class="hfeed site">
	<header id="masthead" class="site-header">
	<div id="navbars" class="navbars">
		<div class="timestamp">
			<div class="container">
			    <p id="time"><?php echo date('l, F j, Y g:i:s A'); ?></p>
			<p class="advisory"></p>
			
			</div>
			
		</div>

		<!-- Hamburger Menu Button -->
		<button id="hamburger-menu" class="hamburger-menu" aria-label="Open navigation">
			<span>&#9776;</span>
		</button>

		<nav id="site-navigation" class="navigation mobile-menu main-navigation">
			<!-- Back Button (Close Menu) icon -->
			<button id="back-button" class="back-button" aria-label="Close navigation">
				&larr; 
			</button>

			<a class="header_logo" href="<?php echo home_url(); ?>">
			    <img src="<?php echo esc_url( get_field('header_logo', 'option') ); ?>" alt="">
			</a>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'nav-menu',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		<div class="search-wrapper">
                <div class="search-icon">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 19L14.65 14.65M17 9C17 13.4183 13.4183 17 9 17C4.58172 17 1 13.4183 1 9C1 4.58172 4.58172 1 9 1C13.4183 1 17 4.58172 17 9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </div>
                <div class="search-box">
                    <?php get_search_form(); ?>
                </div>
            </div>

		</nav><!-- #site-navigation -->
	</div><!-- #navbar -->
	<div class="olaHelper">
	    <div class="ola">
	        <img id="toggleButton" src="<?php echo esc_url( site_url('/wp-content/uploads/2025/03/Ola.png') ); ?>">
	    </div>
	    <ul id="helpertools" class="olaBtns" style="display:none;">
	        <li class="olaList"><a class="ola_btn" href="https://www.facebook.com/UCPBS.KASAMAMO" target="_blank"><span><i class="fab fa-facebook-messenger"></i></span> Chat us on Facebook</a></li>
	        <li class="olaList"><a class="ola_btn" href="<?php echo site_url('/contact-us'); ?>"><span><i class="fas fa-envelope"></i></span> Contact us via Email</a></li>
	    </ul>
	</div>
</header><!-- #masthead -->



		<div id="main" class="site-main">

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/headerscript.js"></script>
