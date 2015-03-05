<?php

/*
Functions in file:
get_ad
update_ad (also creates)
remove_ad

*/

function osq_adv_get_ad($ad_location){
	$ad_object = get_option("osq_adv");
	if( isset($ad_object[$ad_location])){
		$ad_object = $ad_object[$ad_location];
		$output = '<div class="padding"><div class="ad"><a target="_blank" href="';
		$output .= $ad_object["target"];
		$output .= '"><img src="';
		$output .= $ad_object["url"];
		$output .= '"></a></div></div>';
		echo $output;
	}
}

function osq_adv_remove_ad($request_data){
	$ad_location = $request_data["location"];
	$osq_adv_options = get_option("osq_adv");
	if(isset($osq_adv_options[$ad_location]["local_path"])){
		unlink($osq_adv_options[$ad_location]["local_path"]);
	}
	unset($osq_adv_options[$ad_location]);
	update_option("osq_adv",$osq_adv_options);
}

function osq_update_ad($request_data , $file){ //Can also create an ad.

	$ad_location = $request_data["location"];

	if( $file["size"] > 0 && $file["error"] == 0){
			global $osq_adv_uploaddir;
			global $osq_adv_uploadurl;
		    $file_info = $file["type"];
            $file_info = explode("/",$file_info);
            $file_type = $file_info[0];
            $file_ext = $file_info[1];

            $file_dir = $osq_adv_uploaddir . $ad_location . "." . $file_ext;
            move_uploaded_file( $file["tmp_name"] , $file_dir );

            $file_url = $osq_adv_uploadurl . $ad_location . "." . $file_ext;
	}

	$ad_options = get_option("osq_adv");
	if (isset($file_info)){
			$ad_options[$ad_location]["type"] = $file_type;
			$ad_options[$ad_location]["url"] = $file_url;
			$ad_options[$ad_location]["local_path"] = $file_dir;
	}
	$ad_options[$ad_location]["target"] = $request_data["target"];

	update_option("osq_adv",$ad_options);

}