<?php

include('detail_header.php');

foreach($data as $value)
{
    printf("%s", $value->value);
}

include('detail_footer.php');
?>



