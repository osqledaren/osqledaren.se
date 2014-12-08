<?php

$url = "podiet";


header('Content-Type: application/json'); //Klienten vet att den ska förvänta sig JSON (ingen parsing i klient behövs)
$feed = new DOMDocument();

$feed->load('http://' . $url . '.libsyn.com/rss');
//$xpath = new DOMXpath( $feed);
$json = array();

$podName = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
$json[$podName] = array();

//Hämta kanalens huvudinformation.
$json['title'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
$json['image'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('image')->item(0)->getElementsByTagName('url')->item(0)->firstChild->nodeValue;
$json['description'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
$json['link'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('link')->item(0)->firstChild->nodeValue;

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

//file_put_contents('filename.json', json_encode($json));
//Koda om till JSON och skicka
echo json_encode($json);




?>