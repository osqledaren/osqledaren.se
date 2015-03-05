<?php


setlocale(LC_ALL, 'en_US.UTF8');

function getPodJson($podName) { //Gets all the .json for ONE podcast. Must be called several times and the returned .json concatenated.

	$feed = new DOMDocument();
	$feed->load($podName);
	$feed = $feed->getElementsByTagName('channel')->item(0);

	$json = array();

	//Hämtar kanalens huvudinformation.
	$json["url"] = $podName;
	$json['title'] = $feed->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
	$json['image'] = $feed->getElementsByTagName('image')->item(0)->getElementsByTagName('url')->item(0)->firstChild->nodeValue;
	$json['description'] = $feed->getElementsByTagName('description')->item(0)->firstChild->nodeValue;

	$items = $feed->getElementsByTagName('item');

	$json['item'] = array();
	$i = 0;

	foreach ($items as $item) { //Hämta data om varje avsnitt separat

	   //Extraherar den intressanta datan om varje avsnitt
	   $title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
	   $description = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
	   $pubDate = $item->getElementsByTagName('pubDate')->item(0)->firstChild->nodeValue;
	   $url = $item->getElementsByTagName('enclosure')->item(0)->getAttribute('url');
	   $length = $item->getElementsByTagName('enclosure')->item(0)->getAttribute('length');

	   //Under itunes: namespacet.
	   $image = $item->getElementsByTagNameNS('http://www.itunes.com/dtds/podcast-1.0.dtd','image')->item(0)->getAttribute('href');

	   $json['item'][$i]['title'] = $title;
	   $json['item'][$i]['description'] = $description;
	   $json['item'][$i]['pubdate'] = $pubDate;
	   $json['item'][$i]['url'] = $url;
	   $json['item'][$i]['length'] = $length;
	   $json['item'][$i++]['image'] = $image;
	     
	}

	return $json;
}

function processImage($oldUrl, $newUrl, $bigPicture, $blur) { //bigPicture true/false. true -> gör en större version av bilden

	if ( !file_exists(dirname($newUrl)) ) { //Kolla så att mappen finns, annars skapa.
    	mkdir(dirname($newUrl), 0777, true);
	}

	if( !file_exists($newUrl)) { //Kolla så att bilden inte redan finns. (Pga libsyn flera länkar till samma bild)
		try {
			$img = new abeautifulsite\SimpleImage($oldUrl);								//Läs in bild-storlek

			if ( $blur ) {
				//Fixa blurrad bild.
				$img->best_fit(570, 570)->blur('gaussian', 30);
			}
			if ( $bigPicture && !$blur ) {
				//Fixa stor bild
				$img->best_fit(255, 255);
			}
			if (!$bigPicture && !$blur ) {
				//Fixa liten episod-bild.
				$img->best_fit(65, 65);
			}
			
			$img->save($newUrl, 100);
		} catch(Exception $e) {
			error_log($e);
		}
	}


}




function processPodImages(&$podJson) { //Processerar en podcast (Skapar bilder samt länkar)

	$podName = $podJson["title"]; //Pod name
	$podName = toAscii($podName); // Url safe

	$img_info = pathinfo($podJson["image"]);

	$blurUrl = TMP_IMG_FOLDERNAME.$podName."/".$img_info["filename"]."_blur.".$img_info["extension"];
	processImage($podJson["image"],$blurUrl,true,true);
	$podJson["blurImage"] = "/wp-content/osqpod-output/images/" . $podName ."/". $img_info["filename"]."_blur.".$img_info["extension"];

	$newUrl = TMP_IMG_FOLDERNAME.$podName."/".$img_info["basename"];
	processImage( $podJson["image"],$newUrl,true,false);
	$podJson["image"] = "/wp-content/osqpod-ouput/images/".$podName."/".$img_info["basename"];


	foreach($podJson["item"] as &$episode){ //Loopar över varje episod med referens (pga "&")
		$img_info = pathinfo($episode["image"]);

		$newUrl = TMP_IMG_FOLDERNAME.$podName."/".$img_info["basename"]; //Basename = bildens namn utan mapp-struktur.

		processImage($episode["image"], $newUrl, false, false); //Processerar en bild.

		$episode["image"] = "/wp-content/osqpod-ouput/images/".$podName."/".$img_info["basename"];
	}

	return $podJson;
}
define("IMG_FOLDERNAME", __DIR__."/../../osqpod-output/images/");
define("TMP_IMG_FOLDERNAME",__DIR__."/../../osqpod-output/tmp_images/");

$podNames = explode("," , get_option("osqpod_podcasts") );
$data = array();
foreach ($podNames as $podName) {
	$data[] = getPodJson($podName);
}

foreach ($data as &$dat) {
	processPodImages($dat);
}

file_put_contents(__DIR__.'/../../osqpod-output/podcast.json', json_encode($data)); //Sparar datan som .json

rrmdir(IMG_FOLDERNAME); //Deletes destination folder
rename(TMP_IMG_FOLDERNAME, IMG_FOLDERNAME); //Moves _tmp pictures to destination folder
rrmdir(TMP_IMG_FOLDERNAME); //Make sure _tmp folder is deleted

