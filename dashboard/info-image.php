<?php

include('detail_header.php');
//print_r($data);
foreach($data as $value)
{
    if ($value->value <> "") {
        printf("<img src='%s' width='550px'>", $value->value);
    }
    else
    {
        printf("Geen afbeelding beschikbaar.");
    }
}

include('detail_footer.php');
?>

