<?php

require_once '../classes/geo.php';


//echo "Geo versie: " . geo::Version() . "<br>";
geo::ConnectDB('pgsql:host=geodata.cnd2zbyqxfff.us-west-2.rds.amazonaws.com;port=5432;dbname=geodata;', 'springco', '%>%oprt23');
if (geo::IsConnected())
{
    //echo "OK<br>";
}
else
{
    //echo "Houston, we've got a problem...<br>";
}

//$obj = geo::GetObject('Vlakken', 5);

//print_r($obj);

$geojson = geo::GetGeoJSON('Vlakken-wgs', 5);

print_r($geojson);

