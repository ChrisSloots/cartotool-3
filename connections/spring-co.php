<?php
// Errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//phpinfo();
//print_r(PDO::getAvailableDrivers());

// Include the RedBean framework
require '../redbean/rb.php';


// Setup database connection
R::setup( 'pgsql:host=geodata.cnd2zbyqxfff.us-west-2.rds.amazonaws.com;port=5432;dbname=geodata;', 'springco', '%>%oprt23' ); 

// Toggle debug
R::debug(TRUE);

$isConnected = R::testConnection();
//if ($isConnected)
//{
//    echo "Verbonden";
//}
//else
//{
//    echo "Mislukt";
//}


// Freeze the model in production
R::freeze(TRUE);

$results = R::findAll("Vlakken");
//$results = R::findAll("Gemeenten_2015", ' WHERE "GM_NAAM" LIKE \'%erm%\'');

print_r($results);

