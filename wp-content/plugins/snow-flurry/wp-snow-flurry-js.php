<?php

/**
 * Plugin Name: Snow Flurry
 * Plugin URI: https://wordpress.org/plugins/snow-flurry/changelog/
 * Description: Make it snow on your Wordpress site this Winter with Snow Flurry
 * Version: 2.03
 * Author: HTML5andBeyond
 * Author URI: http://www.html5andbeyond.com/
 * License: GPL2 or Higher
 */

	if ( ! defined( 'ABSPATH' ) ) exit;

	define( 'H5AB_SNOW_FLURRY_DIR', plugin_dir_path( __FILE__ ));
	define('H5AB_SNOW_FLURRY_URL', plugin_dir_url( __FILE__ ));
	include_once( H5AB_SNOW_FLURRY_DIR . 'includes/h5ab-snow-flurry-functions.php');

	if(!class_exists('H5AB_Snow_Flurry')) {

			class H5AB_Snow_Flurry {

				public function __construct() {

					add_action('wp_enqueue_scripts', array($this, 'load_scripts'), 1);
					add_action('init', array($this, 'validate_form_callback'), 2);

					add_action( 'admin_menu', array($this, 'add_menu') );
                    add_action( 'admin_enqueue_scripts', array($this, 'admin_init'), 1);

				}

				public function admin_init() {

					wp_enqueue_style('h5ab-snow-flurry-admin-css', H5AB_SNOW_FLURRY_URL . 'css/h5ab-snow-flurry-admin.css');

				}

				public function add_menu() {

					/*$page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position*/
					add_menu_page('Snow Flurry', 'Snow Flurry','administrator', 'Snow_Flurry_Settings',
					array($this, 'plugin_settings_page'), H5AB_SNOW_FLURRY_URL . 'images/icon.png');

				}

				public function plugin_settings_page() {

					if(!current_user_can('administrator')) {
						  wp_die('You do not have sufficient permissions to access this page.');
					}

					include_once(sprintf("%s/templates/h5ab-snow-flurry-settings.php", H5AB_SNOW_FLURRY_DIR));

				}

				public function load_scripts() {

					wp_enqueue_style('h5ab-snow-flurry-css', H5AB_SNOW_FLURRY_URL . 'css/h5ab-snow-flurry.css');

					wp_enqueue_script('h5ab-snow-flurry-script', H5AB_SNOW_FLURRY_URL . 'js/h5ab-snow-flurry.js', array('jquery'), '', true);

                    wp_enqueue_script('h5ab-snow-flurry-activate', H5AB_SNOW_FLURRY_URL . 'js/h5ab-snow-flurry-activate.js', array('h5ab-snow-flurry-script'), '', true);

                    $h5abSnowFlurryArray = get_option('h5abSnowFlurryV2Array');

                    $sf_translation_data = array(
                        'maxSize' => esc_attr($h5abSnowFlurryArray['h5abSnowFlurryMaxSize']),
                        'numberOfFlakes' => esc_attr($h5abSnowFlurryArray['h5abSnowFlurryNumberFlakes']),
                        'minSpeed' => esc_attr($h5abSnowFlurryArray['h5abSnowFlurryMinSpeed']),
                        'maxSpeed' => esc_attr($h5abSnowFlurryArray['h5abSnowFlurryMaxSpeed']),
                        'color' => esc_attr($h5abSnowFlurryArray['h5abSnowFlurryColor']),
                        'timeout' => esc_attr($h5abSnowFlurryArray['h5abSnowFlurryTimeout'])
                    );

                    wp_localize_script( 'h5ab-snow-flurry-activate', 'sf_variable', $sf_translation_data );

				}

                public function load_plugin_settings() {
                    include_once(sprintf("%s/h5ab-snow-flurry-load-settings.php", H5AB_SNOW_FLURRY_DIR));
                }

				public function validate_form_callback() {

                    if (isset($_POST['H5AB_Snow_Flurry_upload_n'])) {

							if(wp_verify_nonce( $_POST['H5AB_Snow_Flurry_upload_n'], 'H5AB_Snow_Flurry_upload_nonce' )) {
								h5ab_snow_flurry_update_settings();
							} else {
								wp_die("You do not have access to this page");
							}

					}

				}

                public static function activate() {
				$snowFlurryMaxSize = wp_strip_all_tags(5);
                $snowFlurryNumberFlakes = wp_strip_all_tags(25);
                $snowFlurryMinSpeed = wp_strip_all_tags(10);
                $snowFlurryMaxSpeed = wp_strip_all_tags(15);
                $snowFlurryColor = wp_strip_all_tags('#fff');
                $snowFlurryTimeout = wp_strip_all_tags(0);

                $snowFlurryMaxSize = sanitize_text_field($snowFlurryMaxSize);
                $snowFlurryNumberFlakes = sanitize_text_field($snowFlurryNumberFlakes);
                $snowFlurryMinSpeed = sanitize_text_field($snowFlurryMinSpeed);
                $snowFlurryMaxSpeed = sanitize_text_field($snowFlurryMaxSpeed);
                $snowFlurryColor = sanitize_text_field($snowFlurryColor);
                $snowFlurryTimeout = sanitize_text_field($snowFlurryTimeout);

                $h5abSnowFlurryArray = array(
                    'h5abSnowFlurryMaxSize' => $snowFlurryMaxSize,
                    'h5abSnowFlurryNumberFlakes' => $snowFlurryNumberFlakes,
                    'h5abSnowFlurryMinSpeed' => $snowFlurryMinSpeed,
                    'h5abSnowFlurryMaxSpeed' => $snowFlurryMaxSpeed,
                    'h5abSnowFlurryColor' => $snowFlurryColor,
                    'h5abSnowFlurryTimeout' => $snowFlurryTimeout
                );

                add_option('h5abSnowFlurryV2Array', $h5abSnowFlurryArray);

				}

                public static function deactivate() {
				    delete_option( 'h5abSnowFlurryV2Array' );
				}

			}

	}

	if(class_exists('H5AB_Snow_Flurry')) {
        register_activation_hook( __FILE__, array('H5AB_Snow_Flurry' , 'activate'));
        register_deactivation_hook( __FILE__, array('H5AB_Snow_Flurry' , 'deactivate'));
		$H5AB_Snow_Flurry = new H5AB_Snow_Flurry();
	}


?>
