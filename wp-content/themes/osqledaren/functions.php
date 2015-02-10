<?php
/**
 * osqledaren functions and definitions
 *
 * @package osqledaren
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
}

if ( ! function_exists( 'osqledaren_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function osqledaren_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on osqledaren, use a find and replace
	 * to change 'osqledaren' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'osqledaren', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'osqledaren' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'video'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'osqledaren_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // osqledaren_setup
add_action( 'after_setup_theme', 'osqledaren_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function osqledaren_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'osqledaren' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'osqledaren_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function osqledaren_scripts() {
	wp_enqueue_style( 'osqledaren-style', get_stylesheet_uri() );

	//Minimized jQuery,Underscore,Handlebars,Backbone javascript libraries
	wp_enqueue_script('osqledaren-dependencies', get_template_directory_uri() . '/assets/js/everything-min.js', array(),'1',true);

	//Header and footer javascript
	wp_enqueue_script('osqledaren-header_footer', get_template_directory_uri() . '/assets/js/header_footer.js', array(),'1',true);

	//Podcast javascript
	if( is_page_template('podcast-template.php')){
		wp_enqueue_script('osqledaren-podcast', get_template_directory_uri() . '/assets/js/podcast.js',array(),'1',true);
	};

	//Article javascript
	if( is_single() ){
		wp_enqueue_script('osqledaren-article', get_template_directory_uri() . '/assets/js/article.js',array(),'1',true);
	};

	//wp_enqueue_script( 'osqledaren-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	//wp_enqueue_script( 'osqledaren-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'osqledaren_scripts' );

/**
 * Enables post-thumbnail support.
 */
add_theme_support('post-thumbnails');

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
