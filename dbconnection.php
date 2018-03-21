<?php
// Errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the RedBean framework
require 'redbean/rb.php';
// Setup database connection
if (stripos($_SERVER["SERVER_NAME"], 'cartotool.mppng.nl') !== FALSE)
{
    //echo 'bij mppng';
    R::setup( 'mysql:host=localhost;dbname=mppng_cartotool', 'mppng_root', '#iB0k#iB0k' ); 
}
else if (stripos($_SERVER["SERVER_NAME"], 'cartotool.nl') !== FALSE)
{
    //echo 'bij cartotool';
    R::setup( 'mysql:host=localhost;dbname=mppng_cartotool', 'mppng_cartotool', '#iB0k#iB0k' ); 
}
else
{
    //echo 'lokaal';
    R::setup( 'mysql:host=localhost;dbname=mppng_cartotool', 'root', '' );     
}

$isConnected = R::testConnection();
if ($isConnected)
{
    //echo "Verbonden";
}
else
{
    //echo "Mislukt";
}

// Toggle debug
//R::debug(TRUE);

// Freeze the model in production
R::freeze(TRUE);

// Autoload classes
function __autoload($class_name) {
    $class_name_lower = strtolower($class_name);
    $filename = sprintf('./classes/%s.php', $class_name_lower);
    $filename2 = sprintf('../classes/%s.php', $class_name_lower);
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

// Is the language set in a cookie
$language_id = helper::FetchParam('language_id', NULL, INPUT_COOKIE);
if ($language_id === NULL)
{
    $language_id = helper::FetchParam('lang', CC::DEFAULT_LANGUAGE_ID);
    // Store language in cookie
    setcookie('language_id', $language_id, time() + (86400 * 30), "/"); // 86400 = 1 day
}
else
{
    $language_id_from_get = helper::FetchParam('lang', NULL);
    if ($language_id_from_get === NULL)
    {
        $language_id = helper::FetchParam('language_id', CC::DEFAULT_LANGUAGE_ID, INPUT_COOKIE);
    }
    else
    {
        $language_id = $language_id_from_get;
        setcookie('language_id', $language_id, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
}


$_SESSION['msg'] = "";