<?php
    require '../dbconnection.php';
    require '../session.php';
    $map_id = helper::FetchParam('map_id', -1);
    $project = $_SESSION['project'];
    
    
    print_r($map_id);
    
?>

<form id="form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST">
    <div class="table-header light-green-border">
        <h3><?php echo helper::GetText("ADD_LAYER"); ?></h3>
    </div>
    <div class="block no-margin-bottom border-bottom">
        <div class="form-group">
            <div class="input-fields">
                <?php
                    $layers = helper::GetLayers();
                    echo helper::GetSelect($layers, 'title', 'title', 2);
                ?>
                <div class="space h20"></div>
                <button type="submit" class="btn btn-mini" href="#"><?php echo helper::GetText("SAVE"); ?></button>
            </div>
        </div>
    </div>
</form>
