<?php
/*
Plugin Name: Osqledaren Podcast
Description: A plugin that parses RSS feeds from libsyn and saves a JSON-map of the data + images.
Version: 1.0
Author: Max Krog
Author URI: http://maxkrog.se
Prefix:osqpod
 */

include('assets/SimpleImage.php');
include("assets/helper-functions.php");

DEFINE("OSQPOD_DIR",__DIR__."/../../osqpod-output/");

//Responsible for the whole parsing process. Gets the entered podcasts from wp_options("osqpod_podcasts");
function osqpod_parse_rss(){

	include("parser.php");

}
//Options page, responsible for entering podcasts and reset
function osqpod_admin() {

    include('admin_options_page.php');

}

//Clickable in the settings menu.
function osqpod_admin_menu (){

    add_menu_page("Osqledaren Podcast","Podcasts","manage_options","osqpod","osqpod_admin");

}

add_action("admin_menu","osqpod_admin_menu");
add_action("osqpod_hourly_event_hook","osqpod_parse_rss");


//Upon activation - set hourly timer for parsing and create ouput-folder.
register_activation_hook(__FILE__,"osqpod_activation");
function osqpod_activation(){ //Emits the "osqpod_hourly_event_hook" once every hour
	mkdir(OSQPOD_DIR);
	update_option("osqpod_podcasts","http://podiet.libsyn.com/rss");
	wp_schedule_event( time(), 'hourly', 'osqpod_hourly_event_hook' );



}
//Clear hourly timer and get rid of output folder recursively.
register_deactivation_hook(__FILE__,"osqpod_deactivation"); 
function osqpod_deactivation(){ //Clears hourly event hook
	wp_clear_scheduled_hook('osqpod_hourly_event_hook');
	rrmdir(OSQPOD_DIR);

}


