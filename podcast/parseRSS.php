<?php

function getPodJson($podName){

	$feed = new DOMDocument();
	$feed->load('http://' . $podName . '.libsyn.com/rss');

	$json = array();

	//Hämtar kanalens huvudinformation.
	$json['title'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
	$json['image'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('image')->item(0)->getElementsByTagName('url')->item(0)->firstChild->nodeValue;
	$json['description'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('description')->item(0)->firstChild->nodeValue;

	$items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item');

	$json['item'] = array();
	$i = 0;

	foreach($items as $item) { //Hämta data om varje avsnitt separat

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

function processImage($oldUrl,$newUrl,$bigPicture,$blur){ //bigPicture true/false. true -> gör en större version av bilden
	$newUrl = "1".$newUrl; //Vi vill bygga upp bild-mappen i en annan mapp innan vi skriver över.

	if ( !file_exists( dirname($newUrl) ) ) { //Kolla så att mappen finns, annars skapa.
    	mkdir(dirname($newUrl), 0777, true);
	}

	if( !file_exists($newUrl)){ //Kolla så att bilden inte redan finns. (Pga libsyn flera länkar till samma bild)
		
		$img = imagecreatefromstring(file_get_contents($url)); //Läs in bilden.
		$size = getimagesize($url);								//Läs in bild-storlek

		if($blur){
			//Fixa blurrad bild.

		}
		if( $bigPicture && !$blur){
			//Fixa stor bild

		}
		if(!$bigPicture && !$blur){
			//Fixa liten episod-bild.

		$img_episode = imagecreatetruecolor(100, 100);
		imagecopyresampled($img_episode, $img, 0, 0, 0, 0, 100, 100, $size[0], $size[1]);
		imagejpeg($img_episode, $newUrl); // Save sharp version
		file_put_contents($newUrl, $img_episode);
		imagedestroy($img_episode);
		}
	}


}

function processPodImages(&$podJson){ //Processerar en podcast (Skapar bilder samt länkar)
	$podName = $podJson["title"]; //Poddens namn.

	$img_info = pathinfo($podJson["image"]);

	$blurUrl = FOLDERNAME . $podName . "/" . $img_info["filename"] . "_blur." . $img_info["extension"];
	processImage($podJson["image"],$blurUrl,true,true);
	$podJson["blurImage"] = "podcast/".$blurUrl;

	$newUrl = FOLDERNAME . $podName . "/" . $img_info["basename"];
	processImage( $podJson["image"],$newUrl,true,false);
	$podJson["image"] = "podcast/".$newUrl;



	foreach($podJson["item"] as &$episode){ //Loopar över varje episod med referens (pga "&")
		$img_info = pathinfo($episode["image"]);

		$newUrl = FOLDERNAME . $podName . "/" . $img_info["basename"]; //Basename = bildens namn utan mapp-struktur.

		processImage($episode["image"] , $newUrl,false,false); //Processerar en bild.

		$episode["image"] = "podcast/".$newUrl;
	}

	return $podJson;
}
define("FOLDERNAME", "podImages/");

header('Content-Type: application/json'); //Klienten vet att den ska förvänta sig JSON (ingen parsing i klient behövs)

$podNames = ["podiet","pojkdrommar"];
$data = array();
foreach($podNames as $podName){
	$data[] = getPodJson($podName);
}
foreach($data as &$dat){
	processPodImages($dat);
}

file_put_contents('./podcast.json', json_encode($data)); //Sparar datan som .json

rename("./1".FOLDERNAME, "./".FOLDERNAME);




?>