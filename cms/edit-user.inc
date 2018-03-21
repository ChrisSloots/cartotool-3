<?php
    $user_id = helper::FetchParam('user_id', -1);
    if ($user_id != -1)
    {
        $user = R::load(CC::USERS, $user_id);
    }
    else {
        $user = R::dispense(CC::USERS);
        // Default values
        $user->enabled = TRUE;
        $user->usertype = 1;
    }
?>
<section id="content">
    <div class="container">
       <form id="edit-user-form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST" enctype="multipart/form-data">
       <label class="slide-checkbox-big"><?php echo helper::GetText("VISIBILITY", TRUE); ?><input type="checkbox" name="enabled" value="1" id="enabled" class="custom-checkbox slide-checkbox" <?php echo ($user->enabled == 1)?'checked=""':''?>></label>
           <input type="hidden" id="page" name="page" value="gebruikers" />
           <input type="hidden" id="action" name="action" value="<?php echo ($user_id == -1)?"insert-user":"edit-user"; ?>" />
           <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" />
            <div class="table-header blue-border">
                <h3><?php echo ($user_id == -1)?helper::GetText("NEW_USER"):helper::GetText("EDIT_USER"); ?></h3>
            </div>
            <div class="block border-bottom">
                <div class="form-group">
                    <label for="last_name" class="control-label"><?php echo helper::GetText("SURNAME"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="last_name" name="last_name" value="<?php echo $user->last_name; ?>" placeholder="<?php echo helper::GetText("SURNAME"); ?>" aria-required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="first_name" class="control-label"><?php echo helper::GetText("NAME"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="first_name" name="first_name" value="<?php echo $user->first_name; ?>" placeholder="<?php echo helper::GetText("NAME"); ?>" aria-required="true">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputName" class="control-label"><?php echo helper::GetText("PROFILE_PICTURE"); ?>:</label>
                    <div class="input-fields" id="tegels-upload">
                        <div class="upload-image-wrapper <?php echo ($user_id != -1)?'uploaded':'x'?>" >
                            <input class="upload-image valid uploaded" name="avatar" type="file" aria-invalid="false">
                            <div class="uploadPreview">
                                <?php
                                    if ($user_id != -1) {
                                ?>
                                <img src="../<?php echo $user->image; ?>">
                                <span class="image-size"><?php printf('%.0fKB', filesize('../'.$user->image) / 1024);?></span>
                                <?php } ?>
                            </div>
                            <div class="upload-field">
                                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                <!--<input type="file" name="avatar" id="avatar">-->
                                <i class="fa fa-file"></i>
                                <span class="image-title"><?php echo helper::GetText("UPLOAD_FILE"); ?></span>
                                <button type="button" class="add btn btn-small btn-light-blue"><?php echo helper::GetText("ADD"); ?></button>
                                <button type="button" class="delete btn btn-small btn-red"><?php echo helper::GetText("DELETE"); ?></button>
                                <button type="button" class="change btn btn-small btn-light-grey"><?php echo helper::GetText("CHANGE"); ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo helper::GetText("USER_TYPE"); ?>:</label>
                    <div class="input-fields">
                        <label class="radio-inline">
                            <input type="radio" <?php echo ($user->usertype == 3)?'checked=""':''; ?> name="usertype" id="usertype-administrator" value="3"> <?php echo helper::GetText("ADMINISTRATOR"); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" <?php echo ($user->usertype == 2)?'checked=""':''; ?> name="usertype" id="usertype-manager" value="2"> <?php echo helper::GetText("MANAGER"); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" <?php echo ($user->usertype == 1)?'checked=""':''; ?> name="usertype" id="usertype-user" value="1"> <?php echo helper::GetText("USER"); ?>
                        </label>
                    </div>
                    <div class="field-description"></div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label"><?php echo helper::GetText("EMAIL"); ?>:</label>
                    <div class="input-fields">
                        <input type="email" class="form-control required name" id="email" name="email" value="<?php echo $user->email; ?>" placeholder="<?php echo helper::GetText("EMAIL"); ?>" aria-required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label"><?php echo helper::GetText("PASSWORD"); ?>:</label>
                    <div class="input-fields">
                        <input type="password" class="form-control <?php ($user_id == -1)?'required':''?>" id="password" name="password" placeholder="<?php echo helper::GetText("PASSWORD"); ?>" aria-required="false">
                    </div>
                </div>
                <!--
                <div class="form-group">
                    <label for="inputContactpersoon" class="control-label"><?php echo helper::GetText("CONTACT"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required" id="inputContactpersoon" name="inputContactpersoon" placeholder="<?php echo helper::GetText("CONTACT"); ?>" aria-required="true">
                    </div>
                </div>
                -->
                <div class="form-group">
                    <label for="phone_number" class="control-label"><?php echo helper::GetText("PHONE_NUMBER"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required" id="phone_number" name="phone_number" value="<?php echo $user->phone_number; ?>" placeholder="<?php echo helper::GetText("PHONE_NUMBER"); ?>" aria-required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment" class="control-label"><?php echo helper::GetText("REMARKS"); ?>:</label>
                    <div class="input-fields">
                        <textarea class="form-control" id="comment" name="comment"><?php echo $user->comment; ?></textarea>
                        <button type="submit" class="btn"><?php echo helper::GetText("SAVE"); ?></button>
                    </div>
                </div>

            </div>


<?php
    if (!helper::IsAdministrator($user))
    {
        $allProjects = helper::GetProjects();
?>
            <div class="table-header light-green-border">
                <h3><?php echo helper::GetText("PROJECTS"); ?></h3>
            </div>
            <div class="block border-bottom">
                <div class="form-group">
                    <label for="inputName" class="control-label"></label>
                    <div class="input-fields">
                        <span class="multi-select-title"><?php echo helper::GetText("INVISIBLE_PROJECTS"); ?></span>
                        <span class="multi-select-title"><?php echo helper::GetText("VISIBLE_PROJECTS"); ?></span>
                        <select multiple="multiple" class="multi-select" id="available_projects" name="available_projects[]">
                            <?php
                            foreach($allProjects as $key => $project)
                            {
                                $isAvailable = helper::IsAuthorized($user, $project->id);
                                printf('<option value="%2$d" %3$s>%1$s</option>' . PHP_EOL, $project->name, $project->id, ($isAvailable)?'selected':'');
                            }
                            ?>
                        </select>
                        <div class="space h40"></div>
                        <button type="submit" class="btn"><?php echo helper::GetText("SAVE"); ?></button>
                    </div>
                </div>
            </div>
<?php
    }
?>
        </form>
    </div>
</section>
