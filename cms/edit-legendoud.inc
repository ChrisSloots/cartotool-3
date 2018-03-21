<?php
    $legend_id = helper::FetchParam('legend_id', -1);
    if ($legend_id != -1)
    {
        $legend = R::load(CC::LEGENDS, $legend_id);
    }
    else {
        $legend = R::dispense(CC::LEGENDS);
    }
?>
<section id="content">
    <div class="container">
       <form id="edit-user-form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" id="page" name="page" value="legends" />
           <input type="hidden" id="action" name="action" value="<?php echo ($legend_id == -1)?"insert-legend":"edit-legend"; ?>" />
           <input type="hidden" id="legend_id" name="legend_id" value="<?php echo $legend_id; ?>" />
            <div class="table-header blue-border">
                <h3><?php echo ($legend_id == -1)?helper::GetText("NEW_LEGEND"):helper::GetText("EDIT_LEGEND"); ?></h3>
            </div>
            <div class="block border-bottom">

                <!-- title -->
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo helper::GetText("NAME"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="name" name="name" value="<?php echo addslashes($legend->name); ?>" placeholder="<?php echo helper::GetText("NAME"); ?>" aria-required="true">
                    </div>
                </div>

                <!-- description -->
                <div class="form-group">
                    <label for="description" class="control-label"><?php echo helper::GetText("DESCRIPTION"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="description" name="description" value="<?php echo $legend->description; ?>" placeholder="<?php echo helper::GetText("DESCRIPTION"); ?>" aria-required="true">
                    </div>
                </div>


                <button type="submit" class="btn"><?php echo helper::GetText("SAVE"); ?></button>
            </div>
        </form>
    </div>
</section>


