<!doctype html>
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
<html <?php //language_attributes(); ?>>
<!--<![endif]-->
<head>

<meta charset="UTF-8">
<title>Osqledaren</title>

<script src="//use.typekit.net/vtu5dlv.js"></script>
<script>try{Typekit.load();}catch(e){}</script>

<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>

<div id="main">

	<header id="header" class="container">
		<div class="row">
			<div class="padding">
				<a class="go_home" href="articles.php">
					<div id="logo">
						<div id="stripe"></div>
					</div>
				</a>
				
				<ul class="menu">
					<li><a href="articles.php">Articles</a></li>
					<li><a href="article.php">Article Single</a></li>
					<li><a href="pods.php">Pods</a></li>
					<li><a href="#">Lorem</a></li>
					<li><a href="#">Ipsum</a></li>
				</ul>
				
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
