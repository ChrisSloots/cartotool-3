<section id="content">
    <div class="container">
        <a class="btn outlined btn-small rounded btn-red uppercase" href="?page=edit-legend"><i class="fa fa-pencil-square-o"></i><?php echo helper::GetText("NEW_LEGEND"); ?></a>
        
        <?php
            // Fetch list of all users
            $legends = helper::GetLegends();
        ?>
        <table id="example" class="display user-list" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="col-md-1"><?php echo helper::GetText("NR"); ?></th>
                    <th class="col-md-3"><?php echo helper::GetText("NAME"); ?></th>
                    <th class="col-md-8"><?php echo helper::GetText("DESCRIPTION"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Create all rows
                    foreach ($legends as $legend) {
                ?>
                    <tr>
                        <td><?php echo $legend->id; ?></td>
                        <td>
                            <p>
                                <div class="project-meta">
                                <a href="?page=edit-legend&legend_id=<?php echo $legend->id; ?>" class="fa fa-pencil"></a>
                                <a href="#" class="fa fa-copy"></a>
                                <?php
                                    if ($legend->id != 0) {
                                ?>
                                <a onclick="return confirm_alert('<?php echo helper::GetText("ARE_YOU_SURE");?>')" href="process.php?action=delete-legend&legend_id=<?php echo $legend->id; ?>" class="fa fa-trash"></a>
                                <?php
                                    }
                                ?>
                                <?php printf('%1$s', $legend->name); ?>
                                </div>
                            </p>
                        </td>
                        <td><p><?php echo $legend->description; ?></p></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>



    </div>
</section>
