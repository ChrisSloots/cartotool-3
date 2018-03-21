
      <?php
require_once '../dbconnection.php';

$dashboard_id = filter_input(INPUT_GET, 'dashboard_id', FILTER_SANITIZE_URL);
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
$shape_id = filter_input(INPUT_GET, 'shape_id', FILTER_SANITIZE_URL);
//echo '<pre>';
$data = dashboard::GetData($id, $shape_id);
$var = dashboard::GetVar($id);
//echo "<pre>";

$all_zero = dashboard::AllValuesZero($data);

?>
<div class="row">
<?php 
  $vartype = dashboard::GetVarType($var->var_type);
  if ($all_zero)
  {
    include sprintf('info-empty.php');
  }
  else
  {
    include sprintf('info-%s.php', strtolower($vartype->var_type));
  }
?>
</div>

