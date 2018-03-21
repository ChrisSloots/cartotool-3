<?php
    $project_id = helper::FetchParam('project_id', -1);
    if ($project_id != -1)
    {
        $project = R::load(CC::PROJECTS, $project_id);
    }
    else {
        $project = R::dispense(CC::PROJECTS);
        // Default values
        $project->enabled = TRUE;
        $project->zoom = 14;
        $project->latitude = 52.1;
        $project->longitude = 4.7;
        $project->map = 0;
        $project->overviewmap = 0;
        $project->catorder = 1;
        $project->show_scalebar = 1;
        $project->show_overview = 1;
        $project->show_attribution = 1;
    }
    
?>
<section id="content">
    <div class="container">
        <form id="form" class="form-horizontal form-validate" action="process.php" method="POST" enctype="multipart/form-data">
            
            <!-- enable -->
            <label class="slide-checkbox-big checkbox-green"><?php echo helper::GetText("VISIBILITY", TRUE); ?>
            <input type="checkbox" class="custom-checkbox slide-checkbox checkbox-green" value="1" name="enabled" id="enabled" <?php echo ($project->enabled == 1)?'checked=""':''?>></label>
            
        <div class="space h10"></div>
               <input type="hidden" id="page" name="page" value="gebruikers" />
               <input type="hidden" id="action" name="action" value="<?php echo ($project_id == -1)?"insert-project-algemeen":"edit-project-algemeen"; ?>" />
               <input type="hidden" id="project_id" name="project_id" value="<?php echo $project_id; ?>" />
                                    <div class="table-header blue-border">
                                            <h3><?php echo $project->name; ?></h3>
                                    </div>
                                    <div class="block">
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo helper::GetText("NAME"); ?></label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="name" name="name" value="<?php echo $project->name; ?>" placeholder="<?php echo helper::GetText("NAME"); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="location" class="control-label"><?php echo helper::GetText("LOCATION"); ?>:</label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="location" name="location" value="<?php echo $project->location; ?>"  placeholder="<?php echo helper::GetText("LOCATION"); ?>">
                    </div>
                </div>
                                            <div class="form-group">
                                                <label for="inputName" class="control-label"><?php echo helper::GetText("THUMBNAIL"); ?>:</label>
                                                <div class="input-fields">
                        <div class="upload-image-wrapper <?php echo ($project_id != -1)?'uploaded':''?>">
                            <input class="upload-image valid" name="thumbnail" type="file" aria-invalid="false">
                            <div class="uploadPreview">  
                                <?php
                                    if ($project_id != -1) {
                                ?>
                                <img src="../<?php echo $project->thumbnail; ?>">
                                <span class="image-size"><?php printf('%.0fKB', filesize('../'.$project->thumbnail) / 1024);?></span>
                                <?php } ?>
                            </div>
                            <div class="upload-field">
                                <i class="fa fa-file"></i>
                                <span class="image-title"><?php echo helper::GetText("NAME"); ?></span>
                                <button type="button" class="add btn btn-small btn-light-blue"><?php echo helper::GetText("ADD"); ?></button>
                                <button type="button" class="delete btn btn-small btn-red"><?php echo helper::GetText("DELETE"); ?></button>
                                <button type="button" class="change btn btn-small btn-light-grey"><?php echo helper::GetText("CHANGE"); ?></button>
                            </div>
                        </div>
                                                </div>
                                            </div>
                <!-- Remarks -->
                <div class="form-group">
                    <label for="remarks" class="control-label"><?php echo helper::GetText("REMARKS"); ?>:</label>
                    <div class="input-fields">
                        <textarea class="form-control" id="remarks" name="remarks"><?php echo $project->remarks; ?></textarea>
                    </div>
                </div>

                <!-- map -->
                <div class="form-group">
                    <label for="map" class="control-label"><?php echo helper::GetText("MAP"); ?>:</label>
                    <div class="input-fields">
                        <?php
                            $maps = helper::GetAvailableMaps($user);
                            echo helper::GetSelect($maps, 'map', 'name', $project->map); 
                        ?>
                    </div>
                </div>

                <!-- overviewmap -->
                <div class="form-group">
                    <label for="map" class="control-label"><?php echo helper::GetText("OVERVIEW"); ?>:</label>
                    <div class="input-fields">
                        <?php
                            echo helper::GetSelect($maps, 'overviewmap', 'name', $project->overviewmap); 
                        ?>
                    </div>
                </div>

                <!-- Latitude -->
                <div class="form-group hidden">
                    <label for="latitude" class="control-label"><?php echo helper::GetText("LATITUDE"); ?>:</label>
                    <div class="input-fields">
                        <input type="number" step="0.1" class="form-control required name setmap" id="latitude" name="latitude" value="<?php echo $project->latitude; ?>"  placeholder="<?php echo helper::GetText("LATITUDE"); ?>">
                    </div>
                </div>

                <!-- Longitude -->
                <div class="form-group hidden">
                    <label for="longitude" class="control-label"><?php echo helper::GetText("LONGITUDE"); ?>:</label>
                    <div class="input-fields">
                        <input type="number" step="0.1" class="form-control required name setmap" id="longitude" name="longitude" value="<?php echo $project->longitude; ?>"  placeholder="<?php echo helper::GetText("LONGITUDE"); ?>">
                    </div>
                </div>

                <!-- Zoom -->
                <div class="form-group hidden">
                    <label for="zoom" class="control-label"><?php echo helper::GetText("ZOOM"); ?>:</label>
                    <div class="input-fields">
                        <input type="number" step="1" min="0" max="28" class="form-control required name setmap" id="zoom" name="zoom" value="<?php echo $project->zoom; ?>"  placeholder="<?php echo helper::GetText("ZOOM"); ?>">
                    </div>
                </div>

                <!-- lat/lon/zoom via map -->
                <div class="form-group">
                    <label for="zoom" class="control-label"><?php echo helper::GetText("INITIAL_VIEW"); ?>:</label>
                    <div class="input-fields">
                        <div id="ol3map" class="ol3map"></div>
                        <script type="text/javascript">
                            var map = new ol.Map({
                              target: 'ol3map',
                              layers: [
                                new ol.layer.Tile({
                                  source: new ol.source.OSM()
                                })
                              ],
                              view: new ol.View({
                                projection: 'EPSG:3857',
                                center: ol.proj.fromLonLat([<?php echo $project->longitude; ?>, <?php echo $project->latitude; ?>]),
                                zoom: <?php echo $project->zoom; ?>
                              })
                            });

                            map.getView().on('propertychange', function(e) {
                               UpdateViewParameters(map.getView());
                            });
                            
                            function UpdateViewParameters(view)
                            {
                                $('#zoom').val(view.getZoom());
                                var center = ol.proj.transform(view.getCenter(), 'EPSG:3857', 'EPSG:4326');
                                $('#latitude').val(center[1]);
                                $('#longitude').val(center[0]);
                                // $('#rotation').val(view.getRotation());
                            }
                            
                        </script>
                    </div>
                </div>

                <!-- Show_scalebar -->
                <label class="slide-checkbox checkbox-green"><?php echo helper::GetText("SCALEBAR", TRUE); ?>
                <input type="checkbox" class="custom-checkbox slide-checkbox checkbox-green" value="1" name="show_scalebar" id="show_scalebar" <?php echo ($project->show_scalebar == 1)?'checked=""':''?>></label>

                <!-- Show_overview -->
                <label class="slide-checkbox checkbox-green"><?php echo helper::GetText("OVERVIEW", TRUE); ?>
                <input type="checkbox" class="custom-checkbox slide-checkbox checkbox-green" value="1" name="show_overview" id="show_overview" <?php echo ($project->show_overview == 1)?'checked=""':''?>></label>

                <!-- Show_attribution -->
                <label class="slide-checkbox checkbox-green"><?php echo helper::GetText("ATTRIBUTION", TRUE); ?>
                <input type="checkbox" class="custom-checkbox slide-checkbox checkbox-green" value="1" name="show_attribution" id="show_attribution" <?php echo ($project->show_attribution == 1)?'checked=""':''?>></label>

                <!-- Remarks -->
                <div class="form-group">
                    <label for="description" class="control-label"><?php echo helper::GetText("DESCRIPTION"); ?>:</label>
                    <div class="input-fields">
                        <textarea class="form-control" id="description" name="description"><?php echo $project->description; ?></textarea>
                    </div>
                </div>
                
                <!-- category -->
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo helper::GetText("CATEGORY"); ?></label>
                    <div class="input-fields">
                        <input type="text" class="form-control required name" id="category" name="category" value="<?php echo $project->category; ?>" placeholder="<?php echo helper::GetText("CATEGORY"); ?>">
                    </div>
                </div>
                
                <!-- category order -->
                <div class="form-group">
                    <label for="catorder" class="control-label"><?php echo helper::GetText("CATORDER"); ?>:</label>
                    <div class="input-fields">
                        <input type="number" step="1" min="0" max="999" class="form-control required name" id="catorder" name="catorder" value="<?php echo $project->catorder; ?>"  placeholder="<?php echo helper::GetText("CATORDER"); ?>">
                    </div>
                </div>


                <!-- Save button -->
                <div>
                    <button type="submit" class="btn" href="#"><?php echo helper::GetText("SAVE"); ?></button>
                </div>
            </div>

                            </form>
    </div>
</section>
