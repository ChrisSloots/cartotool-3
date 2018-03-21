<?php
    $symbol_id = helper::FetchParam('symbol_id', -1);
    if ($symbol_id != -1)
    {
        $symbol = R::load(CC::SYMBOLS, $symbol_id);
    }
    else {
        $symbol = R::dispense(CC::SYMBOLS);
    }
?>
<section id="content">
    <div class="container">
       <form id="edit-user-form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" id="page" name="page" value="symbols" />
           <input type="hidden" id="action" name="action" value="<?php echo ($symbol_id == -1)?"insert-symbol":"edit-symbol"; ?>" />
           <input type="hidden" id="symbol_id" name="symbol_id" value="<?php echo $symbol_id; ?>" />
            <div class="table-header blue-border">
                <h3><?php echo ($symbol_id == -1)?helper::GetText("NEW_SYMBOL"):helper::GetText("EDIT_SYMBOL"); ?></h3>
            </div>
            <div class="block border-bottom">

                <!-- title -->
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo helper::GetText("NAME"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="name" name="name" value="<?php echo $symbol->name; ?>" placeholder="<?php echo helper::GetText("NAME"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- afbeelding -->
                <!--
                <div class="form-group">
                    <label for="image" class="control-label"><?php echo helper::GetText("SYMBOL"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control name" id="image" name="image" value="<?php echo $symbol->image; ?>" placeholder="<?php echo helper::GetText("SYMBOL"); ?>" aria-required="true">
                    </div>
                </div>
                -->
                
                <!-- image -->
                <div class="form-group">
                    <label for="inputName" class="control-label"><?php echo helper::GetText("SYMBOL"); ?>:</label>
                    <div class="input-fields" id="tegels-upload">
                        <div class="upload-image-wrapper uploaded" >
                            <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                            <input class="upload-image valid uploaded" name="image" type="file" aria-invalid="false">
                            <div class="uploadPreview">  
                                <img src="../<?php echo $symbol->image; ?>">
                                <span class="image-size">
                                    <?php
                                        if (file_exists('../'.$symbol->image))
                                        {
                                            printf('%.0fKB', filesize('../'.$symbol->image) / 1024);
                                        }                                        
                                    ?>
                                </span>
                            </div>
                            <div class="upload-field">
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


