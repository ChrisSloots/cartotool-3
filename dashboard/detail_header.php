<?php
    $rank = filter_input(INPUT_GET, 'rank', FILTER_SANITIZE_URL);
?>
<div class="col-sm-12">
    <?php 
        if (isset($current_item))
        {
            printf('<h1>%s <small>(%d van %d)</small></h1>', $var->var_name, $current_item, $total_items); 
        }
        else
        {
            printf('<h1>%s</h1>', $var->var_name); 
        }
    ?>
</div>
<div class="col-sm-12">
  <p><?php echo $var->var_description; ?></p>
</div>
<div class="col-sm-12">
  <div id="info" min-height="400px" class="tab-pane" role="tabpanel">