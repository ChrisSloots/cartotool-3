<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require './dbconnection.php';

$username = helper::FetchParam("u", "");
$password = helper::FetchParam("p", "");
$project = helper::FetchParam("i", "");

// Get user info
$user = helper::GetUser($username);

// Check password
if ($user === NULL)
{
        printf("Gebruikersnaam niet gevonden.<br/>Username: %s<br />", $username);
}
else
{
    if (helper::IsPasswordCorrect($user, $password))
    {
        session_start();
        $_SESSION["user"] = $user;
        header("Location: " . sprintf('cartotool.php?id=%d', $project));
    }
    else
    {
        printf("Gebruikersnaam/wachtwoord onjuist.<br/>Username: %s<br />Password: %s<br />", $username, $password);
    }
}
//print_r($user);

