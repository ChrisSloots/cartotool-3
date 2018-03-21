<?php
    require '../dbconnection.php';
    require '../session.php';
    
    $entity = helper::FetchParam('entity', '');

    // Create the new entity
    $item = R::dispense( $entity );
    
    print_r($item);

    // Set the properties
    helper::SetProperties($item, $_REQUEST);
    
    print_r($item);
    
    // Store the new entity
    $id = R::store( $item );

//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//fwrite($myfile, $txt);
//fclose($myfile);