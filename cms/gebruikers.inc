<section id="content">
    <div class="container">
        <a class="btn outlined btn-small rounded btn-red uppercase" href="?page=edit-user"><i class="fa fa-pencil-square-o"></i><?php echo helper::GetText("NEW_USER"); ?></a>
        
        <?php
            // Fetch list of all users
            $users = helper::GetUsers();
        ?>
        <table id="example" class="display user-list" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo helper::GetText("NR"); ?></th>
                    <th><?php echo helper::GetText("NAME"); ?></th>
                    <th class="col-md-3"><?php echo helper::GetText("SURNAME"); ?></th>
                    <th class="col-md-3"><?php echo helper::GetText("PROJECTS"); ?></th>
                    <th><?php echo helper::GetText("REMARKS"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Create all rows
                    foreach ($users as $user) {
                ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td>
                            <a class="zoom-image bordered" href="?page=edit-user&user_id=<?php echo $user->id; ?>">
                                <?php
                                    $image = '../' . $user->image;
                                    if (!file_exists($image) || $user->image == '')
                                    {
                                        $user->image = 'user_avatars/missing.jpg';
                                    }
                                ?>
                                <img src="../<?php echo $user->image; ?>" width="100px" height="100px" alt=""/>
                                <span class="fa fa-search"></span>
                            </a>
                            <h3><a href="?page=edit-user&user_id=<?php echo $user->id; ?>"><?php printf('%2$s %1$s', $user->last_name, $user->first_name); ?></a></h3>

                            <div class="project-meta">
                                <a href="?page=edit-user&user_id=<?php echo $user->id; ?>" class="fa fa-pencil"></a>
                                <a href="process.php?action=copy-user&user_id=<?php echo $user->id; ?>" class="fa fa-copy"></a>
                                <a onclick="return confirm_alert('<?php echo helper::GetText("ARE_YOU_SURE");?>')" href="process.php?action=delete-user&user_id=<?php echo $user->id; ?>" class="fa fa-trash"></a>
                            </div>
                        </td>
                        <td><p><?php printf('%1$s', $user->last_name); ?></p></td>
                        <td><p>
                            <?php
                                if (helper::IsAdministrator($user))
                                {
                                    echo helper::GetText('ALL_PROJECTS');
                                }
                                else
                                {
                                    $projects = helper::GetAvailableProjects($user);
                                    echo helper::ArrayToSeparatedList($projects, 'name');
                                }
                            ?>
                            </p></td>
                        <td><p><?php echo $user->comment; ?></p></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>



    </div>
</section>
