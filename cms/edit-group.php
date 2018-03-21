<?php
    require '../dbconnection.php';
    require '../session.php';
    $layer_id = helper::FetchParam('layer_id', -1);
    if ($layer_id != -1)
    {
        $layer = helper::GetLayer($layer_id);
    }
    else {
        $layer = R::dispense(CC::LAYERS);
        // Default values
        $layer->layertype = 3; // default vector
        $layer->baselayer = 0; // no baselayer
    }
    
    $project = $_SESSION['project'];
    
?>
<form id="form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST">
    <div class="table-header light-green-border">
        <h3><?php echo $layer->title; ?></h3>
    </div>
    <div class="block no-margin-bottom border-bottom">
        <div class="form-group">
            <label for="title" class="control-label"><?php echo helper::GetText("NAME"); ?>:</label>
            <div class="input-fields">
                <input type="hidden" id="action" name="action" value="<?php echo ($layer_id == -1)?'insert-group':'edit-group'; ?>">
                <input type="hidden" id="project_id" name="project_id" value="<?php echo $project->id; ?>">
                <input type="hidden" id="layer_id" name="layer_id" value="<?php echo $layer_id; ?>">
                <input type="text" class="form-control required name" id="title" name="title" value="<?php echo $layer->title; ?>" placeholder="<?php echo helper::GetText("NAME"); ?>" aria-required="true">
                <div class="space h20"></div>
                <button type="submit" class="btn btn-mini" href="#"><?php echo helper::GetText("SAVE"); ?></button>
                <button type="submit" name="delete-group" id="delete-group" class="btn btn-mini" href="#"><?php echo helper::GetText("DELETE"); ?></button>
            </div>
        </div>
    </div>
</form>