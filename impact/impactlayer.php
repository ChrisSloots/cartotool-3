<?php

// Autoload classes
function __autoload($class_name) {
    $class_name_lower = strtolower($class_name);
    $filename = sprintf('./%s.php', $class_name_lower);
    $filename2 = sprintf('../%s.php', $class_name_lower);
    if (file_exists($filename))
    {
        //echo $filename . PHP_EOL;
        include $filename;
    } elseif (file_exists($filename2)) {
        //echo $filename2 . PHP_EOL;
        include $filename2;
    } else
    {
        //echo 'error: ' . $filename2 . PHP_EOL;
    }
}

$scenarioid = $_REQUEST['scenarioid'];
$categoryid = $_REQUEST['categoryid'];

$scenarioqualities = impacthelper::GetScenarioQualities($scenarioid, $categoryid);

// Fetch geojson
$json = file_get_contents("./maps/haarlemmermeer impactgebieden.geojson");
$jsonobj = json_decode($json);

// Get list of photos for this category
$photos = impacthelper::GetPhotos($categoryid, './impact/photos');
 
// Merge scenario data into geojson
$geojson = impacthelper::MergeScenarioQualities($jsonobj, $scenarioqualities, $photos);

echo $geojson;
