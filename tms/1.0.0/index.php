<?php

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><TileMapService version="1.0.0" services="https://www.cartotool.nl/v2/tms/"></TileMapService>');

$xml->addChild('Title', 'Mijn titel');
$xml->addChild('Abstract', 'Samenvatting');
$xml->addChild('KeywordList', 'Kernwoorden');
$contactInformation = $xml->addChild('ContactInformation');

$contactPersonPrimary = $contactInformation->addChild('ContactPersonPrimary');
    $contactPersonPrimary->addChild('ContactPerson', 'Chris Sloots');
    $contactPersonPrimary->addChild('ContactOrganization', 'SpringCo');
    $contactInformation->addChild('ContactPosition', 'GIS Engineer');

$contactAddress = $contactInformation->addChild('ContactAddress');
    $contactAddress->addChild('AddressType', 'postal');
    $contactAddress->addChild('Address', '');
    $contactAddress->addChild('City', 'Rotterdam');
    $contactAddress->addChild('StateOrProvince', 'Zuid-Holland');
    $contactAddress->addChild('PostCode', '');
    $contactAddress->addChild('Country', 'The Netherlands');

$contactInformation->addChild('ContactVoiceTelephone', '+31(0)6-54637516');
$contactInformation->addChild('ContactFacsimileTelephone', 'N/A');
$contactInformation->addChild('ContactElectronicMailAddress', 'chris.sloots@gmail.com');

$tileMaps = $xml->addChild('TileMaps');
    $tileMap = $tileMaps->addChild('TileMap');
        $tileMap->addAttribute('title', 'Gemeenten 2016');
        $tileMap->addAttribute('srs', 'EPSG:4326');
        $tileMap->addAttribute('profile', 'local');
        $tileMap->addAttribute('href', 'https://www.cartotool.nl/v2/tms/1.0.0/gemeenten_2016');
Header('Content-type: text/xml');
print($xml->asXML());

