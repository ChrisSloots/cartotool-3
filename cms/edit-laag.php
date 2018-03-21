<?php
    require '../dbconnection.php';
    require '../session.php';
    $layer_id = helper::FetchParam('layer_id', -1);
    $project = $_SESSION['project'];
    if ($layer_id != -1)
    {
        $layer = helper::GetLayer($layer_id);
        $maplayer = helper::GetMapLayerByMapIdAndLayerId($project->map, $layer_id);
    }
    else {
        $layer = R::dispense(CC::LAYERS);
        // Default values
        $layer->layertype = 2; // default vector
        $layer->baselayer = 0; // no baselayer
    }
    //print_r($maplayer);
?>
<div class="tabs">
    <div>
            <form id="form" class="form-horizontal form-validate" novalidate="novalidate" action="process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit-map-layer">
                <input type="hidden" name="layer_id" value="<?php echo $maplayer->layer; ?>">
                <input type="hidden" name="map_id" value="<?php echo $maplayer->map; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project->id; ?>">

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#kaart-info" aria-controls="kaart-info" role="tab" data-toggle="tab"><i class="fa fa-clone"></i><?php echo helper::GetText("PROPERTIES", true); ?></a></li>
        <li role="presentation"><a href="#visibility" aria-controls="visibility" role="tab" data-toggle="tab"><i class="fa fa-eye"></i><?php echo helper::GetText("VISIBILITY", true); ?></a></li>
      </ul>
      <button type="submit" name="delete-maplayer" id="delete-maplayer" class="btn delete-validation btn-red outlined uppercase rounded pull-right" href="#">
          <i class="fa fa-trash fa-lg"></i>
          <?php echo helper::GetText("DELETE"); ?>
      </button>

      <label class="pull-right slide-checkbox-big checkbox-green"><?php echo helper::GetText("VISIBILITY", true); ?>
          <input type="checkbox" name="visible" id="visible" value="1" class="custom-checkbox slide-checkbox checkbox-green" <?php echo ($maplayer->visible == 1)?'checked':''; ?>></label>
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="kaart-info">
    <div class="table-header light-green-border">
        <h3><?php printf('<a href="?page=edit-layer&layer_id=%2$d">%1$s</a>', $layer->title, $layer->id); ?></h3>
    </div>
    <div class="block no-margin-bottom border-bottom">
        <!--
        <div class="form-group">
            <label for="title" class="control-label"><?php echo helper::GetText("NAME"); ?>:</label>
            <div class="input-fields">
                <input type="text" class="form-control required name" id="title" name="title" placeholder="" value="<?php echo $layer->title; ?>" aria-required="true">
            </div>
        </div>
        -->
        <!--
        <div class="form-group">
            <label class="control-label"><?php echo helper::GetText("LAYER_TYPE"); ?></label>
            <div class="input-fields">
                <label class="radio-inline">
                    <input type="radio" data-depends="" <?php echo ($layer->layertype == 2)?'checked=""':''; ?> name="layertype" id="vector" value="2"><?php echo helper::GetText("VECTOR"); ?>
                </label>
                <label class="radio-inline">
                    <input type="radio" data-depends="" <?php echo ($layer->layertype == 1)?'checked=""':''; ?>  name="layertype" id="tegels" value="1"><?php echo helper::GetText("TILE"); ?>
                </label>
                <label class="radio-inline">
                    <input type="radio" data-depends="" <?php echo ($layer->layertype == 4)?'checked=""':''; ?> name="layertype" id="heatmap" value="4"><?php echo helper::GetText("HEATMAP"); ?>
                </label>
            </div>
            <div class="field-description"></div>
        </div>
        -->
        <!-- base layer -->
        <!--
        <div class="form-group">
            <label class="control-label"><?php echo helper::GetText("BASELAYER"); ?></label>
            <div class="input-fields">
                <label class="radio-inline">
                    <input type="radio" <?php echo ($layer->baselayer == 1)?'checked=""':''; ?> data-depends="" name="baselayer" value="1"><?php echo helper::GetText("YES"); ?>
                </label>
                <label class="radio-inline">
                    <input type="radio" <?php echo ($layer->baselayer == 0)?'checked=""':''; ?> data-depends="" name="baselayer" value="0"><?php echo helper::GetText("NO"); ?>
                </label>
            </div>
            <div class="field-description"></div>
        </div>
        -->
        <!-- style -->
        <!--
        <div class="form-group">
            <label class="control-label"><?php echo helper::GetText("STYLING"); ?></label>
            <div class="input-fields">
                <?php
                    $styles = helper::GetStyles();
                    echo helper::GetSelect($styles, 'style', 'name', $layer->style);
                ?>
            </div>
            <div class="field-description"></div>
        </div>
        -->
        <!-- legend -->
        <!--
        <div class="form-group">
            <label class="control-label"><?php echo helper::GetText("LEGEND"); ?></label>
            <div class="input-fields">
                <?php
                    $legends = helper::GetLegends();
                    echo helper::GetSelect($legends, 'legend', 'name', $layer->legend);
                ?>
            </div>
            <div class="field-description"></div>
        </div>
        -->
        <!-- source -->
        <!--
        <div class="form-group">
            <label class="control-label"><?php echo helper::GetText("SOURCE"); ?></label>
            <div class="input-fields">
                <?php
                    $sources = helper::GetSources();
                    echo helper::GetSelect($sources, 'source', 'name', $layer->source);
                ?>
            </div>
            <div class="field-description"></div>
        </div>
        -->
        
        <!-- opacity slider -->
        <div class="form-group">
            <label class="control-label"><?php echo helper::GetText("SHOW_OPACITY_SLIDER"); ?></label>
            <div class="input-fields">
                <label class="radio-inline">
                    <input type="radio" <?php echo ($maplayer->show_opacity_slider == 1)?'checked=""':''; ?> name="show_opacity_slider" value="1"> <?php echo helper::GetText("YES"); ?>
                </label>
                <label class="radio-inline">
                    <input type="radio" <?php echo ($maplayer->show_opacity_slider == 0)?'checked=""':''; ?> name="show_opacity_slider" value="0"> <?php echo helper::GetText("NO"); ?>
                </label>
            </div>
            <div class="field-description"></div>
        </div>

        <!-- opacity -->
        <div class="form-group">
            <label class="control-label"><?php echo helper::GetText("OPACITY"); ?></label>
            <div class="input-fields">
                <input type="number" step="0.1" max="1" min="0" name="opacity" value="<?php echo $maplayer->opacity; ?>">
            </div>
            <div class="field-description"></div>
        </div>

        <!-- popup enabled -->
        <div class="form-group">
            <label class="control-label"><?php echo helper::GetText("POPUP_ENABLED"); ?></label>
            <div class="input-fields">
                <label class="radio-inline">
                    <input type="radio" <?php echo ($maplayer->popup_enabled == 1)?'checked=""':''; ?> name="popup_enabled" value="1"> <?php echo helper::GetText("YES"); ?>
                </label>
                <label class="radio-inline">
                    <input type="radio" <?php echo ($maplayer->popup_enabled == 0)?'checked=""':''; ?> name="popup_enabled" value="0"> <?php echo helper::GetText("NO"); ?>
                </label>
            </div>
            <div class="field-description"></div>
        </div>

        <!-- hidden -->
        <div class="form-group">
            <label class="control-label"><?php echo helper::GetText("HIDDEN"); ?></label>
            <div class="input-fields">
                <label class="radio-inline">
                    <input type="radio" <?php echo ($maplayer->hidden == 1)?'checked=""':''; ?> name="hidden" value="1"> <?php echo helper::GetText("YES"); ?>
                </label>
                <label class="radio-inline">
                    <input type="radio" <?php echo ($maplayer->hidden == 0)?'checked=""':''; ?> name="hidden" value="0"> <?php echo helper::GetText("NO"); ?>
                </label>
            </div>
            <div class="field-description"></div>
        </div>

        
        <!--
        <div class="form-group">
            <label for="inputName" class="control-label"><?php echo helper::GetText("STYLING"); ?></label>
            <div class="input-fields" id="styling">
                <span class="open-media-library">DrieHoekRood</span>
                <input type="hidden" value="DrieHoekRood"/>
                <a class="btn btn-light-grey open-media-library-btn">Change</a>
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="control-label">Tegels uploaden (Manyfold)</label>
            <div class="input-fields" id="tegels-upload">
                <div class="upload-image-wrapper" >
                    <input class="upload-image valid" type="file" aria-invalid="false">
                    <div class="uploadPreview">  </div>
                    <div class="upload-field">
                        <i class="fa fa-file"></i>
                        <span class="image-title">Upload file</span>
                        <button type="button" class="add btn btn-small btn-light-blue">Add</button>
                        <button type="button" class="delete btn btn-small btn-red">Delete</button>
                        <button type="button" class="change btn btn-small btn-light-grey">Change</button>
                    </div>
                </div>
            </div>
        </div>
        -->
    </div>

    <div class="block">
        <div class="form-group">
            <div class="input-fields">
                <button type="" class="btn btn-mini" href="#"><?php echo helper::GetText("SAVE"); ?></button>
            </div>
        </div>
    </div>

    
</form>
    <div class="block">
        <div class="form-group">
            <div class="input-fields">
                <?php
                    // Fetch needed info
                    $layer = helper::GetLayer($maplayer->layer);
                    //print_r($layer);
                ?>
                <a class="btn btn-mini btn-link" href="?page=edit-layer&layer_id=<?php echo $maplayer->layer; ?>"><?php echo helper::GetText("EDIT_LAYER"); ?></a>
                <a class="btn btn-mini btn-link" href="?page=edit-source&source_id=<?php echo $layer->source; ?>"><?php echo helper::GetText("EDIT_SOURCE"); ?></a>
                <a class="btn btn-mini btn-link" href="?page=edit-legend&legend_id=<?php echo $layer->legend; ?>"><?php echo helper::GetText("EDIT_LEGEND"); ?></a>
                <a class="btn btn-mini btn-link" href="?page=edit-style&style_id=<?php echo $layer->style; ?>"><?php echo helper::GetText("EDIT_STYLE"); ?></a>
                <br>Renato, nieuwe functionaliteit maakt het werken met het CMS een stuk makkelijker.
            </div>
        </div>
    </div>


</div>
        <div role="tabpanel" class="tab-pane fade" id="visibility">
            <div class="table-header light-green-border">
                <h3>Layer-1 alphen opgebouwd uit vijf opeenvolgende groepen.</h3>
            </div>
            <div class="block">
                <div class="form-group">
                    <label for="inputName" class="control-label"></label>
                    <div class="input-fields">
                        <span class="multi-select-title">Zichtbaar voor:</span>
                        <span class="multi-select-title">Niet zichtbaar voor:</span>
                        <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
                            <option>Gebruiker 1</option>
                            <option>Gebruiker 2</option>
                            <option>Gebruiker 3</option>
                            <option>Gebruiker 4</option>
                            <option>Gebruiker 5</option>
                        </select>
                        <div class="space h40"></div>
                        <a class="btn">Opslaan</a>
                    </div>
                </div>
            </div>

        </div>
      </div>

    </div>
</div>