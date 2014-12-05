<?php

set_time_limit(0);


	// Start timer
	$start = microtime(true);
	$c = 1;
	

$images = array(
	'tmp/pojkdrommar/Pojk_Drmmar_v4.jpg',
	'http://static.libsyn.com/p/assets/5/3/e/5/53e59533b1565a63/Pojk_Drmmar_v4.jpg',
	'http://static.libsyn.com/p/assets/0/5/f/e/05fe834b027349c3/podiet.png',
	'http://static.libsyn.com/p/assets/f/5/e/0/f5e081892011064f/Fyllepodden_ny_v2.jpg',
	'http://static.libsyn.com/p/assets/7/c/a/4/7ca49344fbdff51f/Fyllepodden_ny_v2.jpg',
	'http://static.libsyn.com/p/assets/b/5/5/f/b55f6dc7a3a921a7/Bild_fyllepodden.jpg'
);

$done = array(); // Create an array with the processed images

$dest = 'tmp/'; // Destination folder


// Clear directory
$files = glob($dest.'*');
foreach ($files as $file) {
	if (is_file($file))
	unlink($file);
}


foreach ( $images as $url ) {

	// Start timer
	$start_image = microtime(true);

	// File info
	$img_info = pathinfo($url);
	$name = $img_info['filename'];
	$ext = $img_info['extension'];
	
	if ( !in_array($img_info['basename'], $done) ) {
		
		$size = getimagesize($url);
		$ratio = $size[0] / $size[1]; // width/height
		
		$w_small = 255;
		$h_small = $w_small;
		if ( $ratio > 1 ) { // Sätt max-längd till 255px
			$width_small = $w_small;
			$height_small = $h_small/$ratio;
		} else {
			$width_small = $w_small*$ratio;
			$height_small = $h_small;
		}
		
		$img = imagecreatefromstring(file_get_contents($url)); // Download the image
	
		
		// Resize and save small sharp version
		$img_sharp = imagecreatetruecolor($width_small, $height_small);
		imagecopyresampled($img_sharp, $img, 0, 0, 0, 0, $width_small, $height_small, $size[0], $size[1]);
		imagejpeg($img_sharp, $dest.$name.'.'.$ext, 100); // Save sharp version
		imagedestroy($img_sharp);
		
		// Blur that shit out of the bigger version
		$w_big = 570;
		$h_big = $w_big;
		if ( $size[0] > $w_big || $size[1] > $h_big ) { // But first, do stuff if it's too big (that's what she said)
			if ( $ratio > 1 ) {
				$width_big = $w_big;
				$height_big = $h_big/$ratio;
			} else {
				$width_big = $w_big*$ratio;
				$height_big = $h_big;
			}
			$img_blurry = imagecreatetruecolor($width_big, $height_big);
			imagecopyresampled($img_blurry, $img, 0, 0, 0, 0, $width_big, $height_big, $size[0], $size[1]);
		}
		$blur = 40;
		for ( $i=0; $i<=$blur; $i++ ) {
			imagefilter($img_blurry, IMG_FILTER_GAUSSIAN_BLUR);
		}
		// Save blurred version and destroy stuff
		imagejpeg($img_blurry, $dest.$name.'_blurry.'.$ext, 80);
		imagedestroy($img_blurry);
		imagedestroy($img);
		
		// Add image to array of done images.
		$done[] = $img_info['basename'];
	
	}
	
	
	// Timer
	$end_image =  microtime(true);
	$howlong_image = date('s:u', $end_image - $start_image);
	echo 'image '.$c.') '.$howlong_image.' seconds<br><br>';
	$c++;

}



	// Timer
	$end =  microtime(true);
	$howlong = date('s:u', $end - $start);
	echo 'Total: '.$howlong.' seconds<br><br>';

?>

<!--<div style="background:#000"><img style="opacity:0.3" width=1140 src="tmp/Pojk_Drmmar_v4_blurry.jpg" /></div>-->