<?php
include('detail_header.php');
reset($data);
printf('<table class="table table-striped table-hover">');
printf('<thead>');
printf('<tr><th class="col-sm-4">%s</th><th class="col-sm-4">%s</th></tr>', $var->var_name, $var->var_value_description);
printf('</thead>');
foreach($data as $value)
{
    $label_text = ($value->col_label == '')?$value->col_name:$value->col_label;
    printf('<tr>');
    printf('<td>%s</td><td>%s</td>', $label_text, $value->value);
    printf('</tr>');
}
printf('</table>');
include('detail_footer.php');
?>