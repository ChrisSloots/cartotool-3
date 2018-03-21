<section id="content">
    <div class="container">
        <a class="btn outlined btn-small rounded btn-red uppercase" href="?page=edit-symbol"><i class="fa fa-pencil-square-o"></i><?php echo helper::GetText("NEW_SYMBOL"); ?></a>
        
        <?php
            // Fetch list of all users
            $symbols = helper::GetSymbols();
        ?>
        <table id="example" class="display user-list" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="col-md-1"><?php echo helper::GetText("NR"); ?></th>
                    <th class="col-md-1"><?php echo helper::GetText("SYMBOL"); ?></th>
                    <th class="col-md-8"><?php echo helper::GetText("NAME"); ?></th>
                    <th class="col-md-2"><?php echo helper::GetText("STATUS"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Create all rows
                    foreach ($symbols as $symbol) {
                ?>
                    <tr>
                        <td><?php echo $symbol->id; ?></td>
                        <td>
                            <?php
                                if ($symbol->image == '') {
                                    '';
                                }
                                else {
                            ?>
                            <img src="../<?php echo $symbol->image; ?>" width="25px">
                            <?php
                                }
                            ?>
                        </td>
                        <td>
                            <p>
                                
                                <div class="project-meta">
                                <?php
                                    if ($symbol->id != 0) {
                                ?>
                                <a href="?page=edit-symbol&symbol_id=<?php echo $symbol->id; ?>" class="fa fa-pencil"></a>
                                <a href="#" class="fa fa-copy"></a>
                                <a onclick="return confirm_alert('<?php echo helper::GetText("ARE_YOU_SURE");?>')" href="process.php?action=delete-symbol&symbol_id=<?php echo $symbol->id; ?>" class="fa fa-trash"></a>
                                <?php
                                    }
                                ?>
                                <?php printf('%1$s', $symbol->name); ?>
                                </div>
                            </p>
                        </td>
                        <td>
                            <?php
                                $fileExist = file_exists('../' . $symbol->image);
                                echo ($fileExist)?helper::GetText("OK"):helper::GetText("NOT_FOUND");
                            ?>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>



    </div>
</section>
