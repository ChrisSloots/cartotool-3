<section id="content">
    <div class="container">
        <a class="btn outlined btn-small rounded btn-red uppercase" href="?page=edit-map"><i class="fa fa-pencil-square-o"></i><?php echo helper::GetText("NEW_MAP"); ?></a>
        
        <?php
            // Fetch list of all users
            $maps = helper::GetMaps();
        ?>
        <table id="example" class="display user-list" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo helper::GetText("NR"); ?></th>
                    <th class="col-md-6"><?php echo helper::GetText("NAME"); ?></th>
                    <th><?php echo helper::GetText("DESCRIPTION"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Create all rows
                    foreach ($maps as $map) {
                ?>
                    <tr>
                        <td><?php echo $map->id; ?></td>
                        <td>
                            <p>
                                <div class="project-meta">
                                <?php
                                    if ($map->id != 0) {
                                ?>
                                <a href="?page=edit-map&map_id=<?php echo $map->id; ?>" class="fa fa-pencil"></a>
                                <a href="#" class="fa fa-copy"></a>
                                <a onclick="return confirm_alert('<?php echo helper::GetText("ARE_YOU_SURE");?>')" href="process.php?action=delete-map&map_id=<?php echo $map->id; ?>" class="fa fa-trash"></a>
                                <?php
                                    }
                                ?>
                                <?php printf('%1$s', $map->name); ?>
                                </div>
                            </p>
                        </td>
                        <td><p><?php echo strip_tags($map->description); ?></p></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>



    </div>
</section>
