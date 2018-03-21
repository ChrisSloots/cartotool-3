<section id="content">
    <div class="container">
        <a class="btn outlined btn-small rounded btn-red uppercase" href="?page=edit-source"><i class="fa fa-pencil-square-o"></i><?php echo helper::GetText("NEW_SOURCE"); ?></a>
        
        <?php
            // Fetch list of all users
            $sources = helper::GetSources();
        ?>
        <table id="example" class="display user-list" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo helper::GetText("NR"); ?></th>
                    <th class="col-md-6"><?php echo helper::GetText("NAME"); ?></th>
                    <th><?php echo helper::GetText("LAYER_TYPE"); ?></th>
                    <th><?php echo helper::GetText("ATTRIBUTION"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Create all rows
                    foreach ($sources as $source) {
                ?>
                    <tr>
                        <td><?php echo $source->id; ?></td>
                        <td>
                            <p>
                                <div class="project-meta">
                                <a href="?page=edit-source&source_id=<?php echo $source->id; ?>" class="fa fa-pencil"></a>
                                <a href="#" class="fa fa-copy"></a>
                                <?php
                                    if ($source->id != 0) {
                                ?>

                                <a onclick="return confirm_alert('<?php echo helper::GetText("ARE_YOU_SURE");?>')" href="process.php?action=delete-source&source_id=<?php echo $source->id; ?>" class="fa fa-trash"></a>
                                <?php
                                    }
                                ?>
                                <?php printf('%1$s', $source->name); ?>
                                </div>
                            </p>
                        </td>
                        <td><p><?php echo helper::TranslateLayerType($source->sourcetype); ?></p></td>
                        <td><p><?php echo strip_tags($source->attribution); ?></p></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>



    </div>
</section>
