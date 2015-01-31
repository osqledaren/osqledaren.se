<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package osqledaren
 */
?>

<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php //language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php //language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php //language_attributes(); ?>>
<![endif]-->
<!--[if lte IE 8]>
<meta http-equiv="refresh" content="0; url=<?php //bloginfo( 'template_url' ); ?>/ie.html" />
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Typekit fonts -->
<script src="//use.typekit.net/vtu5dlv.js"></script>
<script>try{Typekit.load();}catch(e){console.log(e);}</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="header" class="container">
		<div class="row">
			<div class="padding">
				<a class="go_home" href="<?php echo site_url(); ?>">
					<div id="logo">
						<div id="stripe"></div>
					</div>
				</a>
				
				<!-- Wordpress menu you can change under admin-settings -->
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				
				<!-- If it's a search page, search_field should be visible immediately -->
				<?php if ( isset($_GET['s']) ) : ?>
				<style type="text/css">.search_form .search_icon{right:13px}</style>
				<?php else : ?>
				<style type="text/css">.search_form .search_field{display:none}.search_form .search_icon{right:0}</style>
				<?php endif; ?>
				<form class="search_form" role="search" method="get" action="" >
					<div class="search_icon"></div>
					<input class="search_field" type="search" placeholder="Sök" value="<?php echo $_GET['s']; //echo esc_url( home_url( '/' ) ); ?>" name="s" >
					<!--<input class="search_field type="submit" class="search_submit" value="<?php //echo esc_attr( get_search_query() ); ?>" >-->
				</form>
			</div>
		</div>
	</header><!-- /#header -->

<div id="main">
