<?php

	// Start timer
	$start = microtime(true);
	

$images = array(
	'http://static.libsyn.com/p/assets/c/5/6/d/c56d00ecb0258081/Pojk_Drmmar_v4.jpg',
	'http://static.libsyn.com/p/assets/0/5/f/e/05fe834b027349c3/podiet.png',
	'http://static.libsyn.com/p/assets/7/a/4/6/7a461db55630d46d/Fyllepodden_ny_v2.jpg'
);

// Fallback om inte bild har hunnits cron jobbas -> ta bilden på cover för podden, när bilden har rezisas kommer denna automatiskt poppa upp.

foreach ( $images as $url ) {

	// Start timer
	$start_image = microtime(true);
	$c = 1;
	
	

	// File info
	$img_info = pathinfo($url);
	$name = $img_info['filename'];
	$ext = $img_info['extension'];
	
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
	imagejpeg($img_sharp, 'tmp/'.$name.'.'.$ext, 100); // Save sharp version
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
	imagejpeg($img_blurry, 'tmp/'.$name.'_blurry.'.$ext, 80);
	imagedestroy($img_blurry);
	imagedestroy($img);
	
	
	
	// Timer
	$end_image =  microtime(true);
	$howlong_image = $end_image - $start_image;
	echo 'image '.$c.') '.$howlong_image.' seconds<br><br>';
	$c++;

}



	// Timer
	$end =  microtime(true);
	$howlong = $end - $start;
	echo 'Total: '.$howlong.' seconds<br><br>';

?>

<div style="background:#000"><img style="opacity:0.3" width=1140 src="tmp/Pojk_Drmmar_v4_blurry.jpg" /></div>