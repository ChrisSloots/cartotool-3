<?php
    $map_id = helper::FetchParam('map_id', -1);
    if ($map_id != -1)
    {
        $map = R::load(CC::MAPS, $map_id);
    }
    else {
        $map = R::dispense(CC::MAPS);
    }
?>
<section id="content">
    <div class="container">
       <form id="edit-user-form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" id="page" name="page" value="maps" />
           <input type="hidden" id="action" name="action" value="<?php echo ($map_id == -1)?"insert-map":"edit-map"; ?>" />
           <input type="hidden" id="map_id" name="map_id" value="<?php echo $map_id; ?>" />
            <div class="table-header blue-border">
                <h3><?php echo ($map_id == -1)?helper::GetText("NEW_MAP"):helper::GetText("EDIT_MAP"); ?></h3>
            </div>
            <div class="block border-bottom">

                <!-- title -->
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo helper::GetText("NAME"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="name" name="name" value="<?php echo $map->name; ?>" placeholder="<?php echo helper::GetText("NAME"); ?>" aria-required="true">
                    </div>
                </div>


                <!-- description -->
                <div class="form-group">
                    <label for="description" class="control-label"><?php echo helper::GetText("DESCRIPTION"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="description" name="description" value="<?php echo $map->description; ?>" placeholder="<?php echo helper::GetText("DESCRIPTION"); ?>" aria-required="true">
                    </div>
                </div>
            </div>
                <?php
                          $allLayers = helper::GetLayers();
                ?>
                 <div class="table-header light-green-border">
                     <h3><?php echo helper::GetText("LAYERS"); ?></h3>
                 </div>
                 <div class="block border-bottom">
                     <div class="form-group">
                         <label for="inputName" class="control-label"></label>
                         <div class="input-fields">
                             <span class="multi-select-title"><?php echo helper::GetText("AVAILABLE_LAYERS"); ?></span>
                             <span class="multi-select-title"><?php echo helper::GetText("SELECTED_LAYERS"); ?></span>
                             <select multiple="multiple" class="multi-select" id="available_projects" name="selected_layers[]">
                                 <?php
                                 foreach($allLayers as $key => $layer)
                                 {
                                     $isAvailable = helper::IsSelectedLayer($layer, $map->id);
                                     printf('<option value="%2$d" %3$s>%1$s</option>' . PHP_EOL, sprintf('%s [%s] (%s)', $layer->title, helper::TranslateLayerType($layer->layertype), $layer->description), $layer->id, ($isAvailable)?'selected':'');
                                 }
                                 ?>
                             </select>
                         </div>
                     </div>
                 </div>

                <div class="space h40"></div>
                <button type="submit" class="btn"><?php echo helper::GetText("SAVE"); ?></button>
            
           
        </form>
    </div>
</section>


