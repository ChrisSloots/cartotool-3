<section id="content">
    <div class="container">
        <a href="?page=edit-project-algemeen" class="btn outlined btn-small rounded btn-red uppercase"><i class="fa fa-pencil-square-o"></i><?php echo helper::GetText("NEW_PROJECT"); ?></a>
        <?php
            // Fetch all available projects
            $projects = helper::GetAvailableProjects($user);
        ?>
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo helper::GetText("NR"); ?></th>
                    <th><?php echo helper::GetText("PROJECT"); ?></th>
                    <th><?php echo helper::GetText("LOCATION"); ?></th>
                    <th><?php echo helper::GetText("USERS"); ?></th>
                    <th><?php echo helper::GetText("REMARKS"); ?></th>
                </tr>
            </thead>

            <tbody>
            <?php
                // Create all rows
                foreach ($projects as $project) {
            ?>
                <tr>
                    <td><?php echo $project->id; ?></td>
                    <td>
                        <a class="zoom-image" href="<?php echo helper::GetProjectURL($project->id); ?>">
                            <?php
                                    $image = '../' . $user->image;
                                    if (!file_exists($image) || $user->image == '')
                                    {
                                        $project->thumbnail = 'user_avatars/missing.jpg';
                                    }
                            ?>
                            <img src="../<?php echo $project->thumbnail; ?>" width="107px" height="84px" alt=""/>
                            <span class="fa fa-search"></span>
                        </a>
                        <h3><a href="?page=edit-project-algemeen&project_id=<?php echo $project->id; ?>"><?php echo $project->name; ?></a></h3>
                        <span><?php echo $project->description; ?></span>
                        <div class="project-meta">
                            <a href="?page=edit-project-algemeen&project_id=<?php echo $project->id; ?>" class="fa fa-pencil"></a>
                            <a href="#" class="fa fa-copy"></a>
                            <a onclick="return confirm_alert('<?php echo helper::GetText("ARE_YOU_SURE");?>')" href="process.php?action=delete-project&project_id=<?php echo $project->id; ?>" class="fa fa-trash"></a>
                        </div>
                    </td>
                    <td><p><?php echo $project->category; ?></p></td>
                    <td><p><?php $users = helper::GetAvailableUsers($project); echo helper::ArrayToSeparatedList($users, 'last_name'); ?></p></td>
                    <td><p><?php echo $project->remarks; ?></p></td>
                </tr>
            <?php
                }
            ?>


            </tbody>
        </table>



    </div>
</section>


