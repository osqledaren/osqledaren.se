<?php
/*
Plugin Name: Osqledaren Advertising
Plugin URI: http://twitter.com/maxkrog
Description: Minimal advertising-plugin for osqledaren.se
Version: 1.0
Author: Max Krog
Author URI: http://twitter.com/maxkrog
Prefix: osq_adv_
*/

include("osq-advertising-functions.php"); //Functions like 'get_ad'

$uploaddir = wp_upload_dir();
global $osq_adv_uploaddir;
$osq_adv_uploaddir = $uploaddir['basedir'] . "/osq-adv-uploads/";
global $osq_adv_uploadurl;
$osq_adv_uploadurl = $uploaddir['baseurl'] . "/osq-adv-uploads/";



add_action("admin_menu","osq_adv_admin_menu");
function osq_adv_admin_menu (){
    add_menu_page("Osqledaren Advertising","Reklam","manage_options","osq_adv_","osq_adv_adminpage");
}
function osq_adv_adminpage() {
    include('osq-advertising-adminpage.php');
}

register_activation_hook(__FILE__, "osq_adv_activation" );
function osq_adv_activation(){
	global $osq_adv_uploaddir;
	add_option("osq_adv");

	if( ! file_exists($osq_adv_uploaddir)){
		mkdir($osq_adv_uploaddir);
	}
}

register_deactivation_hook(__FILE__, "osq_adv_deactivation");
function osq_adv_deactivation(){
	global $osq_adv_uploaddir;
	include("osq-advertising-helpers.php");
	delete_option("osq_adv");
	rrmdir($osq_adv_uploaddir); 
}

