<?php
include('detail_header.php');
//echo '<pre>';

// find all groups
$groups = array();
foreach($data as $value)
{
    if (!in_array($value->group, $groups))
    {
        $groups[] = $value->group;
    }
}
//print_r($data);
$first = array_pop(array_reverse($data));
reset($data);
printf('<table class="table table-striped table-hover">');
printf('<thead>');
// Group headers
//print_r($data);
printf('<th class="col-sm-6 text-left">%s</th>', $first->var_name);
foreach($groups as $group)
{
    printf('<th class="col-sm-4 text-right">%s</th>', $group);
}
printf('</thead>');


$count = 0;
$group_count = count($groups);
foreach($data as $value)
{
    if ($count % $group_count == 0)
    {
        $column_name = ($value->col_label == "")?$value->col_name:$value->col_label;
        printf('<tr>');
        printf('<td class="text-left">%s</td>', $column_name);
    }
    printf('<td class="text-right">%s</td>', $value->value);
    if (($count+1) % $group_count == 0)
    {
        printf('</tr>');
    }
    $count++;
}
printf('</table>');
include('detail_footer.php');
?>