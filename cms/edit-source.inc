<?php
    $source_id = helper::FetchParam('source_id', -1);
    if ($source_id != -1)
    {
        $source = R::load(CC::SOURCES, $source_id);
    }
    else {
        $source = R::dispense(CC::SOURCES);
        $source->sourcetype = 2;
    }
?>
<section id="content">
    <div class="container">
       <form id="edit-user-form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" id="page" name="page" value="sources" />
           <input type="hidden" id="action" name="action" value="<?php echo ($source_id == -1)?"insert-source":"edit-source"; ?>" />
           <input type="hidden" id="source_id" name="source_id" value="<?php echo $source_id; ?>" />
            <div class="table-header blue-border">
                <h3><?php echo ($source_id == -1)?helper::GetText("NEW_SOURCE"):helper::GetText("EDIT_SOURCE"); ?></h3>
            </div>
            <div class="block border-bottom">

                <!-- title -->
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo helper::GetText("NAME"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="name" name="name" value="<?php echo $source->name; ?>" placeholder="<?php echo helper::GetText("NAME"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- sourcetype -->
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo helper::GetText("LAYER_TYPE"); ?>:</label>
                    <div class="input-fields">
                        <?php
                            $source_types = helper::GetLayerTypes();
                            echo helper::GetSelect($source_types, 'sourcetype', 'layertype', $source->sourcetype);
                        ?>
                    </div>
                </div>
                
                <!-- code -->
                <div class="form-group">
                    <label for="code" class="control-label"><?php echo helper::GetText("CODE"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control name" id="code" name="code" value="<?php echo $source->code; ?>" placeholder="<?php echo helper::GetText("CODE"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- attribution -->
                <div class="form-group">
                    <label for="attribution" class="control-label"><?php echo helper::GetText("ATTRIBUTION"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control name" id="attribution" name="attribution" value="<?php echo htmlentities($source->attribution); ?>" placeholder="<?php echo helper::GetText("ATTRIBUTION"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- maxzoom -->
                <div class="form-group">
                    <label for="maxzoom" class="control-label"><?php echo helper::GetText("MAX_ZOOM"); ?>:</label>
                    <div class="input-fields">
                        <input type="number" max="26" min="1"  step="1" class="form-control name" id="attribution" name="maxzoom" value="<?php echo $source->maxzoom; ?>" placeholder="<?php echo helper::GetText("MAX_ZOOM"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- upload -->
                
                <!-- url -->
                <div class="form-group">
                    <label for="url" class="control-label"><?php echo helper::GetText("URL"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control name" id="url" name="url" value="<?php echo htmlentities($source->url); ?>" placeholder="<?php echo helper::GetText("URL"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- url -->
                <div class="form-group">
                    <label for="path" class="control-label"><?php echo helper::GetText('FILENAME'); ?>:</label>
                    <div class="input-fields">
                    <div class="upload-image-wrapper">
                        <input class="upload-image valid uploaded" name="filename" type="file" aria-invalid="false">
                        <div class="uploadPreview">
                            <?php
                                if ($source->url != '') {
                            ?>
                            <span class="image-size"><?php echo $source->url; ?></span>
                            <?php } ?>
                        </div>
                        <div class="upload-field">
                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                            <i class="fa fa-file"></i>
                            <span class="image-title"><?php echo helper::GetText("UPLOAD_FILE"); ?></span>
                            <button type="button" class="add btn btn-small btn-light-blue"><?php echo helper::GetText("ADD"); ?></button>
                            <button type="button" class="delete btn btn-small btn-red"><?php echo helper::GetText("DELETE"); ?></button>
                            <button type="button" class="change btn btn-small btn-light-grey"><?php echo helper::GetText("CHANGE"); ?></button>
                        </div>
                    </div>
                    </div>
                </div>



                <button type="submit" class="btn"><?php echo helper::GetText("SAVE"); ?></button>
            </div>
        </form>
    </div>
</section>


