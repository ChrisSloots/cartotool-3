<?php
    // Connect to db
    require 'dbconnection.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        if ($username != '' && $password != '')
        {
            if (helper::AddUser($username, $password))
            {
                printf("Nieuwe user aangemaakt (%s - %s)", $username, $password);
            }
            else
            {
                echo "Mislukt: user bestaat al??";
            }
        }
        else
        {
            echo 'Geef username en password op!';
        }
    }
?>
<html>
    <body>
        <form method="post">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="password"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Send"></td>
            </tr>
        </table>
        </form>
    </body>
</html>

