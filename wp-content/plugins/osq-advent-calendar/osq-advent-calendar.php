<?php
/*
Plugin Name: Osqledaren Advent Calendar
Plugin URI: -
Description: A simple Advent Calendar Plugin
Version: 1.0
Author: Arvid Sätterkvist, Pontus Brink, William Perkola
Author URI: -
License: GPL2
Prefix: osq_cal_
*/


if(!class_exists('Osq_Advent_Calendar')) {
	class Osq_Advent_Calendar {
		public function __construct() {
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'add_menu'));
		}
		public static function activate() {
		}
		public static function deactivate() {
		}
		public function admin_init() {
			$this->init_settings();
		}
		public function init_settings() {
            register_setting('osq_advent_calendar-group', 'osq_cal_adv_1');
            register_setting('osq_advent_calendar-group', 'osq_cal_adv_2');
            register_setting('osq_advent_calendar-group', 'osq_cal_adv_3');
			register_setting('osq_advent_calendar-group', 'osq_cal_adv_4');
		}
		public function add_menu() {
			add_options_page('Osqledaren Advent Calendar Settings', 'Osqledaren Advent Calendar', 'publish_posts', 'osq_advent_calendar', array(&$this, 'plugin_settings_page'));
		}
		public function plugin_settings_page() {
			if(!current_user_can('publish_posts')) {
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
		}
	}
}
if(class_exists('Osq_Advent_Calendar'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Osq_Advent_Calendar', 'activate'));
	register_deactivation_hook(__FILE__, array('Osq_Advent_Calendar', 'deactivate'));
	// instantiate the plugin class
	$osq_advent_calendar = new Osq_Advent_Calendar();
	// Add a link to the settings page onto the plugin page
	if(isset($osq_advent_calendar))
	{
		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=wp_plugin_template">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}
		$plugin = plugin_basename(__FILE__);
		add_filter("plugin_action_links_$plugin", 'plugin_settings_link');
	}
}
