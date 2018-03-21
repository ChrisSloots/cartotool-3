<section id="content">
    <div class="container">
        <a class="btn outlined btn-small rounded btn-red uppercase" href="?page=edit-layer"><i class="fa fa-pencil-square-o"></i><?php echo helper::GetText("NEW_LAYER"); ?></a>
        
        <?php
            // Fetch list of all users
            $layers = helper::GetLayers();
        ?>
        <table id="example" class="display user-list" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo helper::GetText("NR"); ?></th>
                    <th><?php echo helper::GetText("NAME"); ?></th>
                    <th><?php echo helper::GetText("LAYER_TYPE"); ?></th>
                    <th><?php echo helper::GetText("DESCRIPTION"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Create all rows
                    foreach ($layers as $layer) {
                ?>
                    <tr>
                        <td><?php echo $layer->id; ?></td>
                        <td>
                            <p>
                                <div class="project-meta">
                                <a href="?page=edit-layer&layer_id=<?php echo $layer->id; ?>" class="fa fa-pencil"></a>
                                <a href="#" class="fa fa-copy"></a>
                                <a onclick="return confirm_alert('<?php echo helper::GetText("ARE_YOU_SURE");?>')" href="process.php?action=delete-layer&layer_id=<?php echo $layer->id; ?>" class="fa fa-trash"></a>
                                <?php printf('%1$s', $layer->title); ?>
                                </div>
                            </p>
                        </td>
                        <td><p><?php printf('%1$s', helper::TranslateLayerType($layer->layertype)); ?></p></td>
                        <td><?php echo $layer->description; ?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>



    </div>
</section>
