<header id="banner" role="banner">
  <?php dynamic_sidebar( 'Ads Banner' );
  dynamic_sidebar( 'Ads Mobile Banner' );?>
  <div id="banner-top" class="container">
    <a class="brand" href="<?php echo home_url(); ?>/"><img src="/assets/img/banner/brand_r03.png" alt="<?php bloginfo('name'); ?>" width="574" height="147" class="retinafy"></a>
    <?php 
    $detect = new Mobile_Detect();
    if (!$detect->isMobile() || $detect->isTablet()){ 
      echo '<div id="sidebar-banner">';
        dynamic_sidebar('sidebar-banner');
      echo '</div>';
    }?>
  </div>
  <div id="banner-underline" class="container">
  	<img src="/assets/img/banner/banner_underline_r03.gif" class="retinafy" alt="">
  </div>
</header>
 
<nav id="nav-wrapper">
  <nav id="nav-main" role="navigation">
    <div class="container">
      <?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav nav-main', 'after' => '<span class="separator">/</span>')); ?>
    </div>
  </nav>

  <nav id="nav-secondary" role="navigation">
    <div class="container">
      <?php wp_nav_menu(array('menu' => 'Secondary Navigation', 'menu_class' => 'nav nav-secondary')); ?>
    </div>
  </nav>
</nav>