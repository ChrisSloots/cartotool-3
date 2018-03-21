<?php
    $map = helper::GetMap($project->map);
?>
<br />
<section id="content">
    <div class="layer-menu">
        <!--
        <a class="btn btn-light-green rounded outlined" data-url="edit-laag.php?layer_id=-1"><i class="fa fa-file-text"></i><?php echo helper::GetText("NEW_LAYER", true); ?></a>
        <a class="btn btn-light-green rounded outlined" data-url="add-existing-layer.php?map_id=<?php echo $map->id; ?>"><i class="fa fa-file-text"></i><?php echo helper::GetText("EXISTING_LAYER", true); ?></a>
        -->
        <a class="btn btn-light-purple rounded outlined" data-url="edit-group.php?layer_id=-1"><i class="fa fa-folder-o"></i><?php echo helper::GetText("NEW_GROUP", true); ?></a>
        <!--
        <a class="btn btn-light-purple rounded outlined" data-url="edit-group.php?layer_id=-1"><i class="fa fa-folder-o"></i><?php echo helper::GetText("EXISTING_GROUP", true); ?></a>
        -->

        <div class="portlet light">
            <div class="portlet-body">
                <div id="tree_1" class="tree-demo">
                <?php
                    $tree = '';
                    helper::GetHierarchicalLayersForLayerEdit($map, null, $tree, 3);
                    echo $tree;
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    </div>
</section>

