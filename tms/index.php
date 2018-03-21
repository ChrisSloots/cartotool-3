<?php

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Services />');

// Version 1.0.0
$tms1 = $xml->addChild('TileMapService');
$tms1->addAttribute('title', 'Cartotool TMS (1.0.0)');
$tms1->addAttribute('version', '1.0.0');
$tms1->addAttribute('href', 'https://www.cartotool.nl/v2/tms/1.0.0/');

// Version 1.1.0
$tms2 = $xml->addChild('TileMapService');
$tms2->addAttribute('title', 'Cartotool TMS (1.1.0)');
$tms2->addAttribute('version', '1.1.0');
$tms2->addAttribute('href', 'https://www.cartotool.nl/v2/tms/1.1.0/');

Header('Content-type: text/xml');
print($xml->asXML());

