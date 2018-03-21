<?php
// Make connection to db
require 'dbconnection.php';

// Fetch parameters from AJAX request
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

// Get user info
$user = helper::GetUser($username);

// Check password
if (helper::IsPasswordCorrect($user, $password))
{
    session_start();
    $_SESSION["user"] = $user;
    $result = 1;
}
else
{
    $result = 0;
}

echo $result;

