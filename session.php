<?php

    session_start();
    if (!isset($_SESSION["user"]) || empty($_SESSION["user"]))
    {
        header('Location: index.php');
    }
    else
    {
        // Pick up user(bean) from session
        $user = $_SESSION["user"];
        $customer = helper::GetCustomer();
        $application_settings = helper::GetApplicationSettings();
    }


