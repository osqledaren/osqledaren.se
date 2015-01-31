<?php
/*
Plugin Name: Libsyn-parser
Description: A plugin that parses RSS feeds from libsyn and saves a JSON-map of the data + images.
Version: 1.0
Author: Max Krog
Author URI: http://maxkrog.se
Prefix:libpar
 */

include('assets/SimpleImage.php');
include("assets/helper-functions.php");

DEFINE("LIBPAR_DIR",__DIR__."/../../libsyn-parser-output/");

//Responsible for the whole parsing process. Gets the entered podcasts from wp_options("libpar_podcasts");
function libpar_parse_rss(){

	include("parser.php");

}
//Options page, responsible for entering podcasts and reset
function libpar_admin() {

    include('admin_options_page.php');

}

//Clickable in the settings menu.
function libpar_admin_menu (){

    add_options_page("Libsyn-parser","Parse-libsyn","manage_options","libpar","libpar_admin");

}

add_action("admin_menu","libpar_admin_menu");
add_action("libpar_hourly_event_hook","libpar_parse_rss");


//Upon activation - set hourly timer for parsing and create ouput-folder.
register_activation_hook(__FILE__,"libpar_activation");
function libpar_activation(){ //Emits the "libpar_hourly_event_hook" once every hour
	mkdir(LIBPAR_DIR);
	update_option("libpar_podcasts","http://podiet.libsyn.com/rss");
	wp_schedule_event( time(), 'hourly', 'libpar_hourly_event_hook' );



}
//Clear hourly timer and get rid of output folder recursively.
register_deactivation_hook(__FILE__,"libpar_deactivation"); 
function libpar_deactivation(){ //Clears hourly event hook
	wp_clear_scheduled_hook('libpar_hourly_event_hook');
	rrmdir(LIBPAR_DIR);

}


