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

	// This is the javascript used on ALL pages.
	wp_enqueue_script('standardJS', get_template_directory_uri().'/assets/js/compiled/standard.js', array(), '1', true);

	// This JS is only for the podcast-page.
	if ( is_page_template('podcast.php') ) {
		wp_enqueue_script('osqledaren-podcast', get_template_directory_uri().'/assets/js/compiled/podcast.js', array(), '1', true);
	};

	// This JS is only for the podcast-page.
	if ( is_page_template('advent-calendar.php') ) {
		wp_enqueue_script('snow', get_template_directory_uri().'/assets/js/compiled/jquery.snow.min.1.0.js', array(), '1', true);
		wp_enqueue_script('osqledaren-calendar', get_template_directory_uri().'/assets/js/compiled/adv_cal.js', array(), '1', true);
	};

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
 * Login
 */
add_filter('login_headerurl', create_function(false, "return '".get_site_url()."';"));
add_filter('login_headertitle', create_function(false, "return 'To Osqledaren';"));
add_action("login_head", "my_login_head");
function my_login_head() { ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>">
	<style type="text/css">
		body.login {
			background-color: #f05022;
			font-family: "jaf-bernina-sans", sans-serif;
		}
		body.login * {
			font-size: 16px !important;
			line-height: 25px;
		}
		body.login #login h1 a {
	    	width: 90px;
			height: 50px;
			margin-bottom: 0;
			background: url('<?php echo get_bloginfo('template_url'); ?>/assets/img/logo.png') no-repeat top center;
	    }
		@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
			body.login #login h1 a {
				background: url('<?php echo get_bloginfo('template_url'); ?>/assets/img/logo@2x.png') no-repeat top center;
				background-size: 90px 50px;
			}
		}
		body.login form {
			margin: 0;
			padding: 0;
	    	background: transparent;
			border: none;
			-webkit-box-shadow: none;
			   -moz-box-shadow: none;
			        box-shadow: none;
		}
		body.login form p {
			margin-top: 20px;
		}
		body.login form label {
			color: #fff;
		}
		body.login form input.input {
			height: 50px;
			margin: 0 !important;
			padding: 15px 20px !important;
			border: none;
		}
		body.login form input:focus {
			background-color: #f0f0f0;
			-webkit-box-shadow: none;
			   -moz-box-shadow: none;
			        box-shadow: none;
		}
		body.login form .forgetmenot {
			margin-bottom: 5px !important;
		}
	    body.login form .forgetmenot input[type="checkbox"] {
		    border: none !important;
	    }
	    body.login form .forgetmenot input[type="checkbox"]:checked::before {
		    color: #f05022;
	    }
	    body.login form #wp-submit {
		    height: 50px;
		    padding: 0;
		    background-color: #fff;
		    color: #4f4f4f;
	    }
	    body.login form #wp-submit:hover {
		    background-color: #d3461e;
		    color: #fff;
	    }

		body.login .message,
		body.login #login_error {
			margin-top: 20px;
			-webkit-box-shadow: none;
			   -moz-box-shadow: none;
			        box-shadow: none;
		}
		body.login #nav,
		body.login #backtoblog {
	    	text-shadow: none;
	    	margin: 0;
			padding: 0;
		}
		body.login #nav {
			color: #fff;
			margin-top: 20px;
		}
		body.login #backtoblog {
			display: none;
		}
		body.login #nav a,
		body.login #backtoblog a {
			color: #fff;
			text-decoration: none;
			text-shadow: none;
		}
		body.login #nav a:hover,
		body.login #backtoblog a:hover {
			color: #a83718;
		}
		body.login #wp-submit {
			border: none;
			background-color: #6085aa;
			-webkit-border-radius: 0;
			   -moz-border-radius: 0;
					 border-radius: 0;
			-webkit-box-shadow: none;
			   -moz-box-shadow: none;
			        box-shadow: none;
		}
		body.login #wp-submit:hover {
			background-color: #333333;
		}
	</style>
<?php }

/**
 * Remove WordPress logo from admin bar
 */
function annointed_admin_bar_remove() {
	global $wp_admin_bar;

	/* Remove their stuff */
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('comments');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

/*Returns an array that shows which advent has been*/
	function which_to_show(){
	// Set timezone to UTC
	date_default_timezone_set('UTC');
	$array = array();
    $day = date("z");
	$adv = fst_adv();

	for($i=1;$i<=4;$i++){
		if($day >= $adv)
		   $array[$i] = 1;
		else
		   $array[$i] = 0;
		$adv += 7;
		}

	return $array;
}
/*Help function for whichToShow*/
	function fst_adv(){
	$christmas = 344 + date("L");
        $daysTillSunday = date('w', $christmas);
        $adv = $christmas -$daysTillSunday - 21;
        return $adv;
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
