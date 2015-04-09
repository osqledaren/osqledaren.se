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
//Easy debugging. Just write_log(whatever);
if (!function_exists('write_log')) {
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
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

	// Minimized jQuery,Underscore,Handlebars,Backbone javascript libraries
	wp_enqueue_script('osqledaren-dependencies', get_template_directory_uri().'/assets/js/everything-min.js', array(), '1', true);

	// Header and footer javascript
	wp_enqueue_script('osqledaren-header_footer', get_template_directory_uri().'/assets/js/header_footer.js', array(), '1', true);

	// Podcast javascript
	if ( is_page_template('podcast.php') ) {
		wp_enqueue_script('osqledaren-podcast', get_template_directory_uri().'/assets/js/podcast.js', array(), '1', true);
	};
	
	// Advertising page
	if ( is_page_template('advertise.php') ) {
		wp_enqueue_script('osqledaren-advertise', get_template_directory_uri().'/assets/js/advertise.js', array(), '1', true);
	};

	// Article javascript
	if ( is_single() || is_home() || is_front_page() || is_category() || is_tag() || is_archive() || is_search() ) {
		wp_enqueue_script('osqledaren-article', get_template_directory_uri().'/assets/js/article.js', array(), '1', true);
	};

	//wp_enqueue_script( 'osqledaren-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	//wp_enqueue_script( 'osqledaren-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script('comment-reply');
	}
}

add_action( 'wp_enqueue_scripts', 'osqledaren_scripts' );

/**
 * Enables post-thumbnail support.
 */
add_theme_support('post-thumbnails');

/**
 * Changes default image sizes to match theme.
 */
update_option( 'thumbnail_size_w', 150 );
update_option( 'thumbnail_size_h', 150 );
update_option( 'medium_size_w', 800 );
update_option( 'medium_size_h', 800 );
update_option( 'large_size_w', 1140 );
update_option( 'large_size_h', 1140 );
/*add_action('after_setup_theme', 'osqledaren_small_size');
function osqledaren_small_size() {
	add_image_size( 'small', 570, 570, false );
}*/

/**
 * Blurred image variant on media upload.
 */
add_action('after_setup_theme', 'osqledaren_blurred_size');
function osqledaren_blurred_size() {
	add_image_size( 'large-blurred-effect', 800, 800, false );
	add_image_size( 'medium-blurred-effect', 600, 600, false );
	add_image_size( 'small-blurred-effect', 400, 400, false );
	add_image_size( 'tiny-blurred-effect', 100, 100, false );
}
add_filter('wp_generate_attachment_metadata', 'osqledaren_blurred_filter');
function osqledaren_blurred_filter($meta) {
    $path = preg_replace('/(.*)\/(.*)/', '$1/', $meta['file']);
    
	$file = $meta['sizes']['large-blurred-effect']['file'];
	if ( !empty($file) ) {
		$meta['sizes']['large-blurred-effect']['file'] = do_blurred_filter($file, $path);
	}
	
	$file = $meta['sizes']['medium-blurred-effect']['file'];
	if ( !empty($file) ) {
		$meta['sizes']['medium-blurred-effect']['file'] = do_blurred_filter($file, $path);
	}
	
	$file = $meta['sizes']['small-blurred-effect']['file'];
	if ( !empty($file) ) {
		$meta['sizes']['small-blurred-effect']['file'] = do_blurred_filter($file, $path);
	}
	
	$file = $meta['sizes']['tiny-blurred-effect']['file'];
	if ( !empty($file) ) {
		$meta['sizes']['tiny-blurred-effect']['file'] = do_blurred_filter($file, $path);
	}
	
	return $meta;
}
function do_blurred_filter($file, $path) {
	$dir = wp_upload_dir();
	$image = wp_load_image(trailingslashit($dir['basedir']).$path.$file);
	for ($x=1; $x<=15; $x++) {
		imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
	}
	return save_modified_image_blurred($image, $file, $path, '-blurred');
}
function save_modified_image_blurred($image, $filename, $path, $suffix) {
	$dir = wp_upload_dir();
	$dest = trailingslashit($dir['basedir']).$path.$filename;

	list($orig_w, $orig_h, $orig_type) = @getimagesize($dest);

	$filename = str_ireplace(array('.jpg', '.jpeg', '.gif', '.png'), array($suffix.'.jpg', $suffix.'.jpeg', $suffix.'.gif', $suffix.'.png'), $filename);
	$dest = trailingslashit($dir['basedir']).$path.$filename;
    
	switch ($orig_type) {
		case IMAGETYPE_GIF:
			imagegif( $image, $dest );
			break;
		case IMAGETYPE_PNG:
		    imagealphablending($image, false);
            imagesavealpha($image, true);
			imagepng( $image, $dest );
			break;
		case IMAGETYPE_JPEG:
			imagejpeg( $image, $dest );
			break;
	}

	return $filename;
}


/**
 * Custom excerpt lengths
 */
function custom_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}


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
