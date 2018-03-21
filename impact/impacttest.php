<?php
error_reporting( E_ALL ); 

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

echo "<pre>";
echo date("h:i:s") . PHP_EOL;
echo "Impact Test" . PHP_EOL;

echo impacthelper::Test();

print_r(impacthelper::GetProjects());
//print_r(impacthelper::GetScenarios(278));

// Fetch scenario
//$scenario = impacthelper::GetScenario(982);

//print_r($scenario);
echo "Hier";
//$scenarioqualities = impacthelper::GetScenarioQualities(982, 90433);
echo "Ook hier!";
//print_r($scenarioqualities);

// Fetch geojson
 //$json = file_get_contents("./maps/haarlemmermeer impactgebieden.geojson");
 //$jsonobj = json_decode($json);

 $photos = impacthelper::GetPhotos(90433, "./photos");

 // Merge scenario data into geojson
 //$geojson = impacthelper::MergeScenarioQualities($jsonobj, $scenarioqualities, $photos);
 
// if(impacthelper::SetAttribute($jsonobj, "areaid", "1118", "nieuw", "99"))
// {
//     //echo "Iets";
// }
// else
// {
//     echo "Niets";
// }
 
// $newjson = json_encode($jsonobj);
 
// print_r($newjson);
//print_r($geojson);

print_r($photos);

//echo method_exists( 'impacthelper', 'GetPhotos' ) ? 'yes' : 'no';

//echo impacthelper::KEY;
echo "The End!";