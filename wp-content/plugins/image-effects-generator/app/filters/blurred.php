<?php

$my_options = get_option('blurred');
if ( $my_options === yes_please ) {

add_image_size( 'image-effects-large-blurred', 1140, 1140, false );
add_image_size( 'image-effects-medium-blurred', 1000, 600, false );
add_image_size( 'image-effects-small-blurred', 500, 500, false );
add_image_size( 'image-effects-tiny-blurred', 100, 100, false );

add_filter('wp_generate_attachment_metadata','image_effects_blurred_filter');
function image_effects_blurred_filter($meta) {
	$file = $meta['sizes']['image-effects-large-blurred']['file'];
	$meta['sizes']['image-effects-large-blurred']['file'] = do_blurred_filter($file);
	
	$file = $meta['sizes']['image-effects-medium-blurred']['file'];
	$meta['sizes']['image-effects-medium-blurred']['file'] = do_blurred_filter($file);
	
	$file = $meta['sizes']['image-effects-small-blurred']['file'];
	$meta['sizes']['image-effects-small-blurred']['file'] = do_blurred_filter($file);
	
	$file = $meta['sizes']['image-effects-tiny-blurred']['file'];
	$meta['sizes']['image-effects-tiny-blurred']['file'] = do_blurred_filter($file);
	
	return $meta;
}

function do_blurred_filter($file) {
	$dir = wp_upload_dir();
	$image = wp_load_image(trailingslashit($dir['path']).$file);
	for ($x=1; $x<=15; $x++) {
		imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
	}
	return save_modified_image_blurred($image, $file, '-blurred');
}

function save_modified_image_blurred($image, $filename, $suffix) {
	$dir = wp_upload_dir();
	$dest = trailingslashit($dir['path']).$filename;

	list($orig_w, $orig_h, $orig_type) = @getimagesize($dest);

	$filename = str_ireplace(array('.jpg', '.jpeg', '.gif', '.png'), array($suffix.'.jpg', $suffix.'.jpeg', $suffix.'.gif', $suffix.'.png'), $filename);
	$dest = trailingslashit($dir['path']).$filename;

	switch ($orig_type) {
		case IMAGETYPE_GIF:
			imagegif( $image, $dest );
			break;
		case IMAGETYPE_PNG:
			imagepng( $image, $dest );
			break;
		case IMAGETYPE_JPEG:
			imagejpeg( $image, $dest );
			break;
	}

	return $filename;
}

}

?>