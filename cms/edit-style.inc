<?php
    $style_id = helper::FetchParam('style_id', -1);
    if ($style_id != -1)
    {
        $style = R::load(CC::STYLES, $style_id);
    }
    else {
        $style = R::dispense(CC::STYLES);
    }
?>
<section id="content">
    <div class="container">
       <form id="edit-user-form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" id="page" name="page" value="styles" />
           <input type="hidden" id="action" name="action" value="<?php echo ($style_id == -1)?"insert-style":"edit-style"; ?>" />
           <input type="hidden" id="style_id" name="style_id" value="<?php echo $style_id; ?>" />
            <div class="table-header blue-border">
                <h3><?php echo ($style_id == -1)?helper::GetText("NEW_STYLE"):helper::GetText("EDIT_STYLE"); ?></h3>
            </div>
            <div class="block border-bottom">

                <!-- title -->
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo helper::GetText("NAME"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="name" name="name" value="<?php echo $style->name; ?>" placeholder="<?php echo helper::GetText("NAME"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- description -->
                <div class="form-group">
                    <label for="description" class="control-label"><?php echo helper::GetText("DESCRIPTION"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="description" name="description" value="<?php echo $style->description; ?>" placeholder="<?php echo helper::GetText("DESCRIPTION"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- style -->
                <div class="form-group">
                    <label for="style" class="control-label"><?php echo helper::GetText("STYLING"); ?>:</label>
                    <div class="input-fields">
                        <textarea class="form-control input-code" id="style" name="style"><?php echo ($style_id == -1)?CC::STYLE_TEMPLATE:$style->style; ?></textarea>
                    </div>
                </div>



                <button type="submit" class="btn"><?php echo helper::GetText("SAVE"); ?></button>
            </div>
        </form>
    </div>
</section>
