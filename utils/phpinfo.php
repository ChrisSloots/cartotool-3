<?php
// toggle this to change the setting
define('DEBUG', true); 
// you want all errors to be triggered
error_reporting(E_ALL); 

if(DEBUG == true)
{
    // you're developing, so you want all errors to be shown
    //display_errors(true);
    // logging is usually overkill during dev
    //log_errors(false); 
}
else
{
    // you don't want to display errors on a prod environment
    display_errors(false); 
    // you definitely wanna log any occurring
    log_errors(true); 
}
phpinfo();