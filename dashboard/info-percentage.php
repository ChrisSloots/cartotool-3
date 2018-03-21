<?php

include('detail_header.php');

foreach($data as $value)
{
    $col_label = ($value->col_label == '')?$value->col_name:$value->col_label;
    printf("<h4>%s %.1f%%</h4>", $col_label, 100*$value->value);
}


include('detail_footer.php');

