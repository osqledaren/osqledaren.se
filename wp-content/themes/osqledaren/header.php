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
<meta name="description" content="Osqledaren">
<meta name="keywords" content="osqledaren, newspaper">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1, minimum-scale=1, maximum-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Typekit fonts -->
<script src="//use.typekit.net/vpf0mhg.js"></script>
<script>try{Typekit.load();}catch(e){}</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php if ( is_admin_bar_showing() ) : ?>
	<style type="text/css">
		@media screen and (min-width: 783px) {
			header#header {
				top: 32px !important;
			}
		}
		@media screen and (max-width: 782px) {
			header#header {
				top: 46px !important;
			}
		}
	</style>
	<?php endif; ?>
	<header id="header" class="container"<?php echo is_admin_bar_showing()?'style="top:32px"':'';?>>
		<div class="row">
			<div class="padding">
				<a class="go_home" href="<?php echo site_url(); ?>">
					<div id="logo">
						<div id="stripe"></div>
					</div>
				</a>
				
				<!-- Wordpress menu you can change under admin-settings -->
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu unstyled' ) ); ?>

				<form class="search_form <?php echo isset($_GET['s']) ? 'selected' : ''; ?>" role="search" method="get" action="<?php echo get_site_url() ?>" >
					<div class="search_icon"></div>
					<input class="search_field" type="search" placeholder="Sök" value="<?php if ( isset($_GET['s']) ){echo $_GET['s'];}?>" name="s" >
				</form>
				
				<div class="collapse-icon">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
		</div>

		<!-- Dropdown menu for small viewports -->
		<section class="dropdown-menu">
			<?php
			$wrap = '<ul class="dropdown-menu-list unstyled">%3$s';
			$wrap .= '<form role="search" method="get" action="' . get_site_url() . '"><li class="search"><input id="mobileSearch" class="dropdown-search" type="search" placeholder="Sök" value="';
			if ( isset($_GET['s']) ){$wrap .= $_GET['s'];}
				$wrap.= '"name = "s"></form></li>';

			wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'items_wrap' => $wrap)); ?>
		</section>
	</header><!-- /#header -->
	
<div id="main">
