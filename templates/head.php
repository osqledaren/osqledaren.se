<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie10 lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php wp_title('|', true, 'right'); bloginfo('name'); if(is_home()){ echo ' – '; echo bloginfo('description'); }?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script type="text/javascript" src="//use.typekit.net/dor7mfg.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
  
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/modernizr.custom.js"></script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery-1.8.1.min.js"><\/script>')</script>

<!-- TOUCH ICONS -->
<!— iOS —>
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch_icon_152.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch_icon_144.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch_icon_120.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch_icon_114.png">
	<link rel="apple-touch-icon" sizes="76x76" href=“<?php echo get_template_directory_uri(); ?>/assets/img/touch_icon_76.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch_icon_72.png">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch_icon_57.png”>
<!— Android —>
	<link rel="shortcut icon" sizes="196x196" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch_icon_196x196.png">

  <?php wp_head(); ?>
</head>