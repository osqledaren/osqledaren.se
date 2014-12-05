<?php
/**
 * Roots functions
 */

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/config.php');          // Configuration and constants
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/htaccess.php');        // Rewrites for assets, H5BP .htaccess
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/template-tags.php');   // Template tags
require_once locate_template('/lib/actions.php');         // Actions
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/post-types.php');      // Custom post types
require_once locate_template('/lib/metaboxes.php');       // Custom metaboxes
require_once locate_template('/lib/custom.php');          // Custom functions
require_once locate_template('/lib/Mobile_Detect.php');   // Mobile detect

function roots_setup() {

  // Make theme available for translation
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  // add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  // add_image_size('category-thumb', 300, 9999); // 300px wide (and unlimited height)

  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('assets/css/editor-style.css');

}

add_action('after_setup_theme', 'roots_setup');

//enable post thumbnail support for theme
if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size(740, 457, true); // default Post Thumbnail dimensions   
}

//add custom image size
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'post-thumbnail-small', 260, 155, true);
  add_image_size( 'post-thumbnail-small-portrait', 260, 155);
  add_image_size( 'issue-cover-small', 120, 140);
}

// Include custom widgets
include TEMPLATEPATH.'/fraga-fysikern.php';
include TEMPLATEPATH.'/widget-recent-in-category.php';

// Limit posts per page for mobile users
function limit_posts_per_page() {
  $detect = new Mobile_Detect();
  if ($detect->isMobile() && !$detect->isTablet()) {
    return 5;
  }
  else {
    $all_options = wp_load_alloptions();
    return $all_options["posts_per_page"];
  }
}
add_filter('pre_option_posts_per_page', 'limit_posts_per_page');

//change excerpt length
function custom_excerpt_length( $length ) {
  if(get_field('storysize', $post_id)==1 && get_field('portrait', $post_id))
    return 80;

  return 55;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// modify read-more link
function new_excerpt_more($more) {
       global $post;
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Add classes to first and last menu items
function nav_menu_first_last( $items ) {
 $pos = strrpos($items, 'class="menu-', -1);
 $items=substr_replace($items, 'menu-item-last ', $pos+7, 0);
 $pos = strpos($items, 'class="menu-');
 $items=substr_replace($items, 'menu-item-first ', $pos+7, 0);
 return $items;
}
add_filter( 'wp_nav_menu_items', 'nav_menu_first_last' );


// add search to primary navigation
function add_search_to_wp_menu ( $items, $args ) {
  $search_default_value = "Sök";
  if( 'primary_navigation' === $args -> theme_location) {
    $items .= '<li class="menu-item menu-item-search-displayer" onclick="searchDisplayerOnBlur();"></li>';
    $items .= '<li class="menu-item menu-item-search">';
    $items .= '<form method="get" id="menu-search-form" class="menu-search-form" action="' . get_bloginfo('home') . '/">';
    $items .= '<label for="s">S&ouml;k</label><input class="text_input" type="text" value="' . (get_search_query()? get_search_query() : $search_default_value) . '" name="s" id="s" onfocus="searchInputOnFocus(this, \''.$search_default_value.'\');" onblur="searchInputOnBlur(this, \''.$search_default_value.'\');"/>';
    $items .= '<span class="search-icon" onclick="$(\'#menu-search-form\').submit();"></span>';
    $items .= '</form>';
    $items .= '</li>';
  }
return $items;
}
add_filter('wp_nav_menu_items','add_search_to_wp_menu',10,2);


// gör så att vissa kateogirier får annan template för single post
function get_custom_template($single_template) {
    global $post;
    $category = get_the_category();
    $cat_name = $category[0]->cat_name;

     if ($cat_name == 'Fråga fysikern') {
          $single_template = TEMPLATEPATH.'/templates/content-single-fraga-fysikern.php';
     }
     return $single_template;
}
add_filter( "single_template", "get_custom_template" ) ;

// wrappar bilder i divar så att de slipper wrappas av paragraf-taggar.
// function my_image_tag($html, $id , $alt, $title){
//   $html = "<div>" . $html . "</div>";
//   return $html;
// }
// add_filter('get_image_tag','my_image_tag',10,4);

// Lägger till klasser till TinyMCE (redigeraren).
function my_formatTinyMCE($init) {
   $init['theme_advanced_buttons2_add'] = 'styleselect';
   $init['theme_advanced_styles'] = 'Drop Caps=drop-caps,Space Under Bild=space-under-img';
   return $init;
}
add_filter('tiny_mce_before_init', 'my_formatTinyMCE');

// Shortcode for issue display
function osqledaren_issue_shortcode($atts, $content = null) {

  extract(shortcode_atts(array(
    'title' => '1',
    'year' => '',
    'number' => '',
    'date' => '',
    'pdf' => '',
    'image' => '',
    'flat' => '',
    'last' => false,
  ), $atts));

  $short = ($year ? $year.'-' : '') . $number;
  $content = preg_replace('~^<br /?>\s?|<br /?>\s?$~i', '', $content);
  if ($flat) $title = '';
  $ret = '';
  if (!$flat) $ret .= "\t<div class=\"issue clearfix\">\n";
  if ($image) $ret .= "\t\t".($pdf ? "<a href=\"$pdf\">" :'')."<img src=\"{$image}\" alt=\"{$short}\" class=\"issue-image alignleft retinafy-photo\" height=\"328\"/>".($pdf ? "</a>" :'')."\n";
  $ret .= "<div class=\"issue-header\">";
  if ($title) $ret .= "\t\t<h3 class=\"issue-title\">Nummer {$number}".($date ? ', '.$date : '')."</h3>\n";
  if ($pdf) $ret .= "\t\t<button class=\"btn icon download\" onclick=\"location.href='{$pdf}'\">Ladda ned PDF</button>\n";
  $ret .= "</div>";
  if (strlen($content) > 0) $ret .= "\t\t<p>$content</p>\n";
  if (!$last) $ret .= "<hr>";
  if (!$flat) $ret .= "\t</div>\n";
  return $ret;

}
add_shortcode('issue', 'osqledaren_issue_shortcode');

// Shortcode for vcard
function osqledaren_vcard_shortcode($atts, $content){
  extract( shortcode_atts( array(
      'name' => '',
      'title' => '',
      'photo' => '',
      'email' => '',
      'tel' => '',
      'twitter' => '',
      ), $atts ) );

    if($name) {
      $id = no_strange_letters(strtolower($name));
      $id = str_replace(' ', '-', $id);
      $hcard_id = ' id="hcard-' . $id . '"';
    } else {
      $id = '';
      $hcard_id = '';
    }

    $ret = "<a id=\"".$id."\"></a>";
    $ret .= "<div".$hcard_id." class=\"vcard\">";
      if ($photo) $ret .= "<img class=\"photo retinafy-photo\" src=\"".$photo."\" alt=\"\"/>";
      if ($name) $ret .= "<span class=\"fn\">".$name."</span>";
      if ($title) $ret .= "<span class=\"title\">".$title."</span>";
      if ($content) $ret .= "<span class=\"bio\">".$content."</span>";
      $ret .= "<div class=\"contact\">";
        if ($email) $ret .= "<a class=\"email\" href=\"mailto:".$email."\">".$email."</a>";
        if ($twitter) $ret .= "<span>, </span><a class=\"twitter\" href=\"http://twitter.com/".$twitter."\">@".$twitter."</a>";
        if ($tel) $ret .= "<span>, </span><span class=\"tel\">".$tel."</span>";
        $ret .= "<span class=\"org\">Osqledaren</span>";
      $ret .= "</div>";
    $ret .= "</div>";

    return $ret;
}
add_shortcode('vcard','osqledaren_vcard_shortcode');

// Shortcode for Fråga Fysikern - Question
function osqledaren_ff_question($atts, $content){
    $ret = "<div class=\"ff-question\">";
    $ret .= $content;
    $ret .= "</div>";
    
    return $ret;
}
add_shortcode('ff-question','osqledaren_ff_question');

// Shortcode for Fråga Fysikern - Answer
function osqledaren_ff_answer($atts, $content){
    $ret = "<div class=\"ff-answer\">";
    $ret .= $content;
    $ret .= "</div>";

    return $ret;
}
add_shortcode('ff-answer','osqledaren_ff_answer');

// Shortcode for Fråga Fysikern - Signature
function osqledaren_ff_signature($atts, $content){
    $ret = "<p class=\"ff-signature\">";
    $ret .= $content;
    $ret .= "</p>";

    return $ret;
}
add_shortcode('ff-signature','osqledaren_ff_signature');

// Shortcode for Fråga Fysikern - Signature Göran Manneberg
function osqledaren_ff_goran($atts, $content){
    $ret = "<p class=\"ff-goran\">";
    $ret .= $content;
    $ret .= "</p>";

    return $ret;
}
add_shortcode('ff-goran','osqledaren_ff_goran');


function osqledaren_cred($post_id){
  $cred_data = get_field('cred', $post_id);

  if(trim($cred_data)!=""){
    $cred_lines = explode("\n", $cred_data);

    $content = "<div class=\"cred-row\">";
    $content .= "\t<div class=\"cred\">";

    foreach ($cred_lines as $cred_line) {
      $relations = explode("=", $cred_line);
      $label = ucfirst(trim($relations[0]));
      $names = explode(",", $relations[1]);

      $name_string = "";
      $n = count($names);

      for($i=0; $i < $n; $i++){
        if($i==$n-1 && $n>2)
          $name_string .= " och ";
        elseif($i==$n-1 && $n>1)
          $name_string .= " & ";
        elseif($i>0)
          $name_string .= ", ";

        $id = no_strange_letters(strtolower(trim($names[$i])));
        $id = str_replace(' ', '-', $id);

        $name_string .= "<a href=\"/om/#" . $id . "\">". ucwords(trim($names[$i])) . "</a>";
      }

      $content .= "\t\t<span class=\"cred-line ".strtolower($label)."-cred\">".$label."<span class=\"cred-separator\">//</span>" . $name_string . "</span>";
    }

    $content .= "\t</div>";
    $content .= "</div>";

    echo $content;
  }
}


function social_buttons(){
  $content = '<div class="social-buttons">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/sv_SE/all.js#xfbml=1&appId=118551344886831";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, \'script\', \'facebook-jssdk\'));</script>
        <div class="fb-like" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true" data-action="recommend"></div>
        <a href="https://twitter.com/share" class="twitter-share-button" data-via="osqledaren" data-related="THS_KTH" data-lang="en">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      </div>';

  echo $content;
}

 function no_strange_letters($s)
{
   $pattern = array('é','è','ë','ê','É','È','Ë','Ê','á','à','ä','â','å','Á','À','Ä','Â','Å','ó','ò','ö','ô','Ó','Ò','Ö','Ô','í','ì','ï','î','Í','Ì','Ï','Î','ú','ù','ü','û','Ú','Ù','Ü','Û','ý','ÿ','Ý','ø','Ø','œ','Œ','Æ','ç','Ç');
   $replace = array('e','e','e','e','E','E','E','E','a','a','a','a','a','A','A','A','A','A','o','o','o','o','O','O','O','O','i','i','i','I','I','I','I','I','u','u','u','u','U','U','U','U','y','y','Y','o','O','a','A','A','c','C');
   return str_replace($pattern, $replace, $s);
} 

// Load more posts via AJAX

// Initialization. Add our script if needed on this page.
function alp_init() {
  global $wp_query;
  $detect = new Mobile_Detect();

  // Add code to index pages.
  if( !is_singular() && ($detect->isMobile() || $detect->isTablet())) {      
    // Queue JS
    wp_enqueue_script(
      'alp-load-posts',
      get_template_directory_uri() . '/assets/js/load-posts.min.js',
      array('jquery'),
      '1.0',
      true
    );

    // What page are we on? And what is the pages limit?
    $max = $wp_query->max_num_pages;
    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
    
    // Add some parameters for the JS.
    wp_localize_script(
      'alp-load-posts',
      'alp',
      array(
        'startPage' => $paged,
        'maxPages' => $max,
        'nextLink' => next_posts($max, false)
      )
    );
  }
}
add_action('template_redirect', 'alp_init');


// Custom WordPress Login Logo
function login_css() {
  wp_enqueue_style( 'login_css', get_template_directory_uri() . '/assets/css/custom_login.css' );
}
add_action('login_head', 'login_css');