<?php

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><TileMap version="1.0.0" tilemapservice="https://www.cartotool.nl/v2/tms/1.0.0"></TileMap>');


$xml->addChild('Title', 'Alle gemeenten in 2016');
$xml->addChild('Abstract');
$xml->addChild('SRS', 'EPSG:4326');
$bbox = $xml->addChild('BoundingBox');
    $bbox->addAttribute('minx', -180);
    $bbox->addAttribute('miny', -90);
    $bbox->addAttribute('maxx', 180);
    $bbox->addAttribute('maxy', 90);
$origin = $xml->addChild('Origin');
    $origin->addAttribute('x', -180);
    $origin->addAttribute('y', -90);
$tileFormat = $xml->addChild('TileFormat');
    $tileFormat->addAttribute('width', 256);
    $tileFormat->addAttribute('height', 256);
    $tileFormat->addAttribute('mime-type', 'image/png');
    $tileFormat->addAttribute('extension', 'png');
$tileSets = $xml->addChild('TileSets');
    $tileSets->addAttribute('profile', 'global-geodetic');
    
    $unit = 0.703125;
    for ($order = 0; $order < 10; $order++)
    {
$tileSet = $tileSets->addChild('TileSet');
    $tileSet->addAttribute('href', 'https://www.cartotool.nl/v2/tms/1.0.0/gemeenten_2016/' . $order);
    $tileSet->addAttribute('units-per-pixel', $unit);
    $tileSet->addAttribute('order', $order);
    
    $unit /= 2;
    }
Header('Content-type: text/xml');
print($xml->asXML());