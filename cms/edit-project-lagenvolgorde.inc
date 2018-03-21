<section id="content">
    <div class="container">
        <form id="form" class="form-horizontal form-validate" action="process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="action" name="action" value="update-layerorder">
            <input type="hidden" id="project_id" name="project_id" value="<?php echo $project_id; ?>">
        <div class="block bordered border-blue project-info">
            <div>
                <span><?php echo helper::GetText("NAME"); ?>:</span>
                <span><?php echo $project->name; ?></span>
            </div>
            <div>
                <span><?php echo helper::GetText("LOCATION"); ?>:</span>
                <span><?php echo $project->location; ?></span>
            </div>
            <div>
                <span>
                    <?php 
                        echo helper::GetText("USERS"); 
                    ?>:
                </span>
                <span><?php 
                        $userprojects = helper::GetUserProjectsByProject($project);
                        $users = '';
                        foreach($userprojects as $key => $up)
                        {
                            $user = helper::GetUserById($up->user_id);
                            $users .= sprintf('%s (%s),', $user->last_name, $user->first_name);
                        }
                        // Remove last ,
                        $users = substr($users, 0, -1);
                        echo $users; ?>
                </span>
            </div>
            <div>
                <span><?php echo helper::GetText("REMARKS"); ?>:</span>
                <span><?php echo $project->remarks; ?></span>
            </div>
        </div>
        <div class="block">
            <div class="space h10"></div>
            <button type="submit" class="btn" href="#"><?php echo helper::GetText("SAVE"); ?></button>


            <div id="tree_nestable" class="tree-nestable">
                <ul>
                    <li data-id="0" data-jstree='{ "icon" : "fa fa-folder","opened" : true }'>ROOT
                        <?php
                            $map = helper::GetMap($project->map);
                            $tree = '';
                            helper::GetHierarchicalLayersForCMS($map, null, $tree);
                            echo $tree;
                        ?>
                    </li>
                </ul>
            </div>
          
            <h5>Serialised Output (per list)</h5>
            <textarea id="layer_order" name="layer_order" class="form-control serialized-output"></textarea>
            <button type="submit" class="btn" href="#"><?php echo helper::GetText("SAVE"); ?></button>
        </div>

        </form>
    </div>
</section>

