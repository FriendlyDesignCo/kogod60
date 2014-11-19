<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php wp_title(' | ', true, 'right'); ?></title>
		
		<link href="//cloud.webtype.com/css/14f03714-0492-43a1-b347-c229c03a169d.css" rel="stylesheet" type="text/css" /> <!-- Interstate -->
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

		<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.2.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/conditionizr.min.js"></script>
		<?php wp_head(); ?>
	</head>
	
	<body <?php
	global $post;
	$slug = get_post( $post )->post_name;
	body_class($slug);
	?>>
		
		<div id="wrapper" class="hfeed grid-container">

			<div class="auBar">
				<div class="container">
					<a href="http://www.american.edu/kogod/"></a>
				</div>
			</div>
		
			<header id="page-header" role="banner">
		
				<?php if (is_home()) { ?>
				<section id="branding">
					<div id="branding__title">
						<h1>Kogod</h1>
						<h2>60 Years of Business in DC</h2>
					</div>
				</section>
				<?php } ?>
				
				<nav id="main-nav" role="navigation">
					<!-- <a class="handle icon"></a> -->
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
				</nav>
		
			</header> <!-- header#page-header -->