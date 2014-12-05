<?php get_template_part('templates/head'); 

$detect = new Mobile_Detect();
if($detect->isMobile() && !$detect->isTablet())
  $extra_body_classes = array("mobile");
elseif($detect->isTablet())
  $extra_body_classes = array("tablet");
else
  $extra_body_classes = array("desktop");

if(is_404()){
  // 404 page should have the same styles as a regular page.
  array_push($extra_body_classes, "page");
}

?>
<body <?php body_class($extra_body_classes); ?>>

  <!--[if lt IE 8]>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>
    <p>Din webbläsare är <em>utdaterad.</em> <a href="http://browsehappy.com/">Uppgradera till en annan webbläsare</a> eller <a href="http://www.google.com/chromeframe/?redirect=true">installera Google Chrome Frame</a> för att få den bästa upplevelsen av webbplatsen.</p>
  </div><![endif]-->

  <?php
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>

  <div id="wrap" class="container" role="document">
    <div id="content" class="row">
      <div id="main" class="<?php roots_main_class(); ?>" role="main">
        <?php include roots_template_path(); ?>
      </div>
      <?php if (roots_sidebar() && (!$detect->isMobile() || $detect->isTablet())) : ?>
      <aside id="sidebar" class="<?php roots_sidebar_class(); ?>" role="complementary">
        <?php get_template_part('templates/sidebar'); ?>
      </aside>
      <?php endif; ?>
    </div><!-- /#content -->
  </div><!-- /#wrap -->

  <?php get_template_part('templates/footer'); ?>

</body>
</html>
