<section id="content">
    <div class="container">
        <a class="btn outlined btn-small rounded btn-red uppercase" href="?page=edit-style"><i class="fa fa-pencil-square-o"></i><?php echo helper::GetText("NEW_STYLE"); ?></a>
        
        <?php
            // Fetch list of all users
            $styles = helper::GetStyles();
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
                    foreach ($styles as $style) {
                ?>
                    <tr>
                        <td><?php echo $style->id; ?></td>
                        <td>
                            <p>
                                <div class="project-meta">
                                <a href="?page=edit-style&style_id=<?php echo $style->id; ?>" class="fa fa-pencil"></a>
                                <a href="#" class="fa fa-copy"></a>
                                <?php
                                    if ($style->id != 0) {
                                ?>
                                <a onclick="return confirm_alert('<?php echo helper::GetText("ARE_YOU_SURE");?>')" href="process.php?action=delete-style&style_id=<?php echo $style->id; ?>" class="fa fa-trash"></a>
                                <?php
                                    }
                                ?>
                                <?php printf('%1$s', $style->name); ?>
                                </div>
                            </p>
                        </td>
                        <td><p><?php echo $style->description; ?></p></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>



    </div>
</section>
