<?php
    $layer_id = helper::FetchParam('layer_id', -1);
    if ($layer_id != -1)
    {
        $layer = R::load(CC::LAYERS, $layer_id);
    }
    else {
        $layer = R::dispense(CC::LAYERS);
        // Default values
        $layer->baselayer = 0;
        $layer->layertype = 1;
    }
?>
<section id="content">
    <div class="container">
       <form id="edit-user-form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" id="page" name="page" value="layers" />
           <input type="hidden" id="action" name="action" value="<?php echo ($layer_id == -1)?"insert-layer":"edit-layer"; ?>" />
           <input type="hidden" id="user_id" name="layer_id" value="<?php echo $layer_id; ?>" />
            <div class="table-header blue-border">
                <h3><?php echo ($layer_id == -1)?helper::GetText("NEW_LAYER"):helper::GetText("EDIT_LAYER"); ?></h3>
            </div>
            <div class="block border-bottom">

                <!-- title -->
                <div class="form-group">
                    <label for="title" class="control-label"><?php echo helper::GetText("NAME"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="title" name="title" value="<?php echo $layer->title; ?>" placeholder="<?php echo helper::GetText("NAME"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- layertype -->
                <div class="form-group">
                    <label for="layertype" class="control-label"><?php echo helper::GetText("LAYER_TYPE"); ?>:</label>
                    <div class="input-fields">
                        <?php
                            $layertypes = helper::GetLayerTypes();
                            echo helper::GetSelect($layertypes, 'layertype', 'layertype', $layer->layertype);
                        ?>
                    </div>
                </div>

                <!-- source -->
                <div class="form-group">
                    <label for="source" class="control-label"><?php echo helper::GetText("SOURCE"); ?>:</label>
                    <div class="input-fields">
                        <?php
                            $sources = helper::GetSources();
                            echo helper::GetSelect($sources, 'source', 'name', $layer->source);
                        ?>
                    </div>
                </div>

                <!-- style -->
                <div class="form-group">
                    <label for="style" class="control-label"><?php echo helper::GetText("STYLING"); ?>:</label>
                    <div class="input-fields">
                        <?php
                            $styles = helper::GetStyles();
                            echo helper::GetSelect($styles, 'style', 'name', $layer->style);
                        ?>
                    </div>
                </div>

                <!-- legend -->
                <div class="form-group">
                    <label for="legend" class="control-label"><?php echo helper::GetText("LEGEND"); ?>:</label>
                    <div class="input-fields">
                        <?php
                            $legends = helper::GetLegends();
                            echo helper::GetSelect($legends, 'legend', 'name', $layer->legend);
                        ?>
                    </div>
                </div>

                <!-- baselayer -->
                <div class="form-group">
                    <label class="slide-checkbox checkbox-green"><?php echo helper::GetText("BASELAYER", TRUE); ?>
                    <input type="checkbox" class="custom-checkbox slide-checkbox checkbox-green" value="1" name="baselayer" id="baselayer" <?php echo ($layer->baselayer == 1)?'checked=""':''?>></label>
                </div>

                <!-- description -->
                <div class="form-group">
                    <label for="description" class="control-label"><?php echo helper::GetText("DESCRIPTION"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="description" name="description" value="<?php echo $layer->description; ?>" placeholder="<?php echo helper::GetText("DESCRIPTION"); ?>" aria-required="true">
                    </div>
                </div>


                <button type="submit" class="btn"><?php echo helper::GetText("SAVE"); ?></button>
            </div>
        </form>
    </div>
</section>
