<?php
require '../dbconnection.php';
echo '<pre>';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

print_r($_REQUEST);

        $user_id = helper::FetchParam("user_id", -1);
        $user = helper::GetUserById($user_id);
        // Make changes
        $email = helper::FetchParam("email", null);
        $first_name = helper::FetchParam("first_name", null);
        $last_name = helper::FetchParam("last_name", null);
        $password = helper::FetchParam("password", null);
        $usertype = helper::FetchParam("usertype", 3);
        $phone_number = helper::FetchParam("phone_number", null);
        $comment = helper::FetchParam("comment", null);
        $enabled = helper::FetchParam("enabled", 0);
        //$avatar = helper::FetchParam("avatar", null, INPUT_POST);
        $result = helper::UpdateUser($user, $email, $first_name, $last_name, $password, $usertype, $phone_number, $comment, $enabled);
        $msg = ($result === TRUE)?'Update succesvol.':'Update mislukt: ' . $result;
        
        // User projects
        $availableProjects = $_REQUEST['available_projects'];
        if (isset($availableProjects))
        {
            helper::DeleteAllUserProjects($user);
            // Insert new userprojects
            foreach($availableProjects as $key => $project_id)
            {
                echo 'x';
                $project = helper::GetProject($project_id);
                $result = helper::InsertUserProject($user, $project);
            }
        }








