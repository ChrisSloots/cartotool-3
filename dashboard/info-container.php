<?php

//echo "<pre>";
//print_r($dashboard_id . PHP_EOL);
//print_r($shape_id);

//echo "Fetch data directly under " . $id . PHP_EOL;

$vars = dashboard::GetVarLevel($dashboard_id, $id);
$total_items = count($vars);
$current_item = 0;
foreach ($vars as $value) {
    $current_item++;
    $vartype = dashboard::GetVarType($value->var_type);
    //print_r($value->var_name . PHP_EOL);
    //print_r($value->id . PHP_EOL);
    $data = dashboard::GetData($value->id, $shape_id);
    //print_r($data);
    $var = $value;
    include \sprintf('info-%s.php', \strtolower($vartype->var_type));
}

//print_r($id);
$var = dashboard::GetVar($id);
include('detail_footer.php');
