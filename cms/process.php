<?php
$debug = false;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../dbconnection.php';
require '../session.php';
$action = helper::FetchParam("action", "nothing");
$nexturl = '';
$result = TRUE;
$msg = "";

if ($debug)
{
    echo '<pre>';
    print_r($_REQUEST);
    print_r($_FILES);
}

//if (!isset($project_id))
//{
    $project_id = helper::FetchParam('project_id', -1);
//}

// take some action
switch ($action) {
    case "delete-source":
        // Delete source
        $source_id = helper::FetchParam("source_id", -1);
        $source = helper::GetSource($source_id);
        $result = helper::DeleteSource($source);
        $msg = ($result === TRUE)?'Bron verwijderd.':'Kan bron niet verwijderen.';
        $nexturl = sprintf('index.php?page=sources');
        break;        
    case "delete-map":
        // Delete map
        $map_id = helper::FetchParam("map_id", -1);
        $map = helper::GetMap($map_id);
        $result = helper::DeleteMap($map);
        $msg = ($result === TRUE)?'Map verwijderd.':'Kan map niet verwijderen.';
        $nexturl = sprintf('index.php?page=maps');
        break;        
    case "insert-map":
        // Insert map
        $name = helper::FetchParam('name', '');
        $description = helper::FetchParam('description', '');

        $result = helper::InsertMap($name, $description);
        $map = helper::GetMap($result);
        // Insert maplayers
        $selected_layers = $_REQUEST['selected_layers'];
        
        if (isset($selected_layers))
        {
            helper::UpdateMapLayers($map, $selected_layers);
        }
        
        $msg = (is_numeric($result))?'Nieuwe map aangemaakt.':'Kan geen nieuwe map aanmaken: ' . $result;
        $nexturl = sprintf('index.php?page=edit-map&map_id=%d', $result);
        break;
    case "edit-map":
        // Update map
        $map_id = helper::FetchParam("map_id", -1);
        $map = helper::GetMap($map_id);
        $name = helper::FetchParam('name', '');
        $description = helper::FetchParam('description', '');
        $map->name = $name;
        $map->description = $description;
        helper::UpdateMap($map, $name, $description);

        // Insert maplayers
        $selected_layers = $_REQUEST['selected_layers'];
        
        if (isset($selected_layers))
        {
            helper::UpdateMapLayers($map, $selected_layers);
        }
        
        $msg = ($result === TRUE)?'Map gewijzigd.':'Kan map niet wijzigen: ' . $result;
        $nexturl = sprintf('index.php?page=edit-map&map_id=%d', $map->id);
        break;
    case "insert-source":
        // Update source
        $name = helper::FetchParam('name', '');
        $sourcetype = helper::FetchParam('sourcetype', '');
        $code = helper::FetchParam('code', '');
        $attribution = helper::FetchParam('attribution', '');
        $url = helper::FetchParam('url', '');
        $maxzoom = helper::FetchParam('maxzoom', 16);

        // Upload file
        $fileinfo = $_FILES['filename'];
        if (helper::HasUploadInfo($fileinfo))
        {
            helper::Upload($fileinfo, '../' . CC::PATH_TO_FILES);
            $url = CC::PATH_TO_FILES . $fileinfo['name'];
        }
        
        $result = helper::InsertSource($name, $sourcetype, $code, $attribution, $url, $maxzoom);
        
        $msg = (is_numeric($result))?'Nieuwe bron aangemaakt.':'Kan geen nieuwe bron aanmaken: ' . $result;
        $nexturl = sprintf('index.php?page=edit-source&source_id=%d', $result);
        break;
    case "edit-source":
        $source_id = helper::FetchParam('source_id', -1);
        $source = helper::GetSource($source_id);
        // Update source
        $name = helper::FetchParam('name', '');
        $sourcetype = helper::FetchParam('sourcetype', '');
        $code = helper::FetchParam('code', '');
        $attribution = helper::FetchParam('attribution', '');
        $url = helper::FetchParam('url', '');
        $maxzoom = helper::FetchParam('maxzoom', 16);
        $currentfilename = helper::FetchParam('currentfilename', '');

        // Upload file
        $fileinfo = $_FILES['filename'];
        if (helper::HasUploadInfo($fileinfo))
        {
            helper::Upload($fileinfo, '../' . CC::PATH_TO_FILES);
            $url = CC::PATH_TO_FILES . $fileinfo['name'];
        }
        //$filename = (helper::HasUploadInfo($fileinfo))? CC::PATH_TO_FILES . $fileinfo['name'] : $currentfilename;
        
        $result = helper::UpdateSource($source, $name, $sourcetype, $code, $attribution, $url, $maxzoom);
        
        
        $msg = ($result === TRUE)?'Update succesvol.':'Update mislukt: ' . $result;
        $nexturl = sprintf('index.php?page=edit-source&source_id=%d', $source_id);
        break;
    case "delete-symbol":
        // Delete symbol
        $symbol_id = helper::FetchParam("symbol_id", -1);
        $symbol = helper::GetSymbol($symbol_id);
        $result = helper::DeleteSymbol($symbol);
        $msg = ($result === TRUE)?'Symbool verwijderd.':'Kan symbool niet verwijderen.';
        $nexturl = sprintf('index.php?page=symbols');
        break;        
    case "insert-symbol":
        // Update symbol
        $name = helper::FetchParam('name', '');
        $fileinfo = $_FILES['image'];
        helper::Upload($fileinfo, '../'.CC::PATH_TO_SYMBOLS);
        $image = CC::PATH_TO_SYMBOLS . $fileinfo['name'];
        //echo $image;
        $result = helper::InsertSymbol($name, $image);
        
        $msg = (is_numeric($result))?'Nieuw symbool aangemaakt.':'Kan geen nieuw symbool aanmaken: ' . $result;
        $nexturl = sprintf('index.php?page=edit-symbol&symbol_id=%d', $result);
        break;
    case "edit-symbol":
        $symbol_id = helper::FetchParam('symbol_id', -1);
        $symbol = helper::GetSymbol($symbol_id);
        $fileinfo = $_FILES['image'];
        // Update symbol
        $name = helper::FetchParam('name', '');
        $image = (helper::HasUploadInfo($fileinfo))? CC::PATH_TO_SYMBOLS . $fileinfo['name'] : $symbol->image;

        $result = helper::UpdateSymbol($symbol, $name, $image);
        $msg = ($result === TRUE)?'Update succesvol.':'Update mislukt: ' . $result;
        $nexturl = sprintf('index.php?page=edit-symbol&symbol_id=%d', $symbol_id);
        
        // Upload symbol
        if (helper::HasUploadInfo($fileinfo))
        {
            helper::Upload($fileinfo, '../' . CC::PATH_TO_SYMBOLS);
        }
        break;
    case "delete-legend":
        // Delete legend
        $legend_id = helper::FetchParam("legend_id", -1);
        $legend = helper::GetLegend($legend_id);
        $result = helper::DeleteLegend($legend);
        $msg = ($result === TRUE)?'Legenda verwijderd.':'Kan legenda niet verwijderen.';
        $nexturl = sprintf('index.php?page=legends');
        break;        
    case "insert-legend":
        // Update legend
        $name = helper::FetchParam('name', '');
        $description = helper::FetchParam('description', '');
        $result = helper::InsertLegend($name, $description);
        
        $msg = (is_numeric($result))?'Nieuwe legenda aangemaakt.':'Kan geen nieuwe legenda aanmaken: ' . $result;
        $nexturl = sprintf('index.php?page=edit-legend&legend_id=%d', $result);
        break;
    case "edit-legend":
        $legend_id = helper::FetchParam('legend_id', -1);
        $legend = helper::GetLegend($legend_id);
        // Update style
        $name = helper::FetchParam('name', '');
        $description = helper::FetchParam('description', '');
        $result = helper::UpdateLegend($legend, $name, $description);
        $msg = ($result === TRUE)?'Update succesvol.':'Update mislukt: ' . $result;
        $nexturl = sprintf('index.php?page=edit-legend&legend_id=%d', $legend_id);
        break;
    case "delete-style":
        // Deleta layer
        $style_id = helper::FetchParam("style_id", -1);
        $style = helper::GetStyle($style_id);
        $result = helper::DeleteStyle($style);
        $msg = ($result === TRUE)?'Stijl verwijderd.':'Kan stijl niet verwijderen.';
        $nexturl = sprintf('index.php?page=styles');
        break;        
    case "insert-style":
        // Update layer
        $name = helper::FetchParam('name', '');
        $description = helper::FetchParam('description', '');
        $stylecode = helper::FetchParam('style', '');
        $result = helper::InsertStyle($name, $description, $stylecode);
        
        $msg = (is_numeric($result))?'Nieuwe stijl aangemaakt.':'Kan geen nieuwe stijl aanmaken: ' . $result;
        $nexturl = sprintf('index.php?page=edit-style&style_id=%d', $result);
        break;
    case "edit-style":
        $style_id = helper::FetchParam('style_id', -1);
        $style = helper::GetStyle($style_id);
        // Update style
        $name = helper::FetchParam('name', '');
        $description = helper::FetchParam('description', '');
        $stylecode = helper::FetchParam('style', '');
        $result = helper::UpdateStyle($style, $name, $description, $stylecode);
        $msg = ($result === TRUE)?'Update succesvol.':'Update mislukt: ' . $result;
        $nexturl = sprintf('index.php?page=edit-style&style_id=%d', $style_id);
        break;
    case "delete-layer":
        // Deleta layer
        $layer_id = helper::FetchParam("layer_id", -1);
        $layer = helper::GetLayer($layer_id);
        $result = helper::DeleteLayer($layer);
        $msg = ($result === TRUE)?'Laag verwijderd.':'Kan laag niet verwijderen.';
        $nexturl = sprintf('index.php?page=layers');
        break;        
    case "insert-layer":
        // Update layer
        $title = helper::FetchParam('title', '');
        $layertype = helper::FetchParam('layertype', 1);
        $source = helper::FetchParam('source', null);
        $style = helper::FetchParam('style', null);
        $legend = helper::FetchParam('legend', null);
        $baselayer = helper::FetchParam('baselayer', 0);        
        $description = helper::FetchParam('description', '');        
        $result = helper::InsertLayer($title, $layertype, $source, $style, $legend, $baselayer, $description);
        
        $msg = (is_numeric($result))?'Nieuwe laag aangemaakt.':'Kan geen nieuwe laag aanmaken: ' . $result;
        $nexturl = sprintf('index.php?page=edit-layer&layer_id=%d', $result);
        break;
    case "edit-layer":
        $layer_id = helper::FetchParam('layer_id', -1);
        $layer = helper::GetLayer($layer_id);
        // Update layer
        $title = helper::FetchParam('title', '');
        $layertype = helper::FetchParam('layertype', 1);
        $source = helper::FetchParam('source', null);
        $style = helper::FetchParam('style', null);
        $legend = helper::FetchParam('legend', null);
        $baselayer = helper::FetchParam('baselayer', 0);        
        $description = helper::FetchParam('description', '');        
        $result = helper::UpdateLayer($layer, $title, $layertype, $source, $style, $legend, $baselayer, $description);
        $msg = ($result === TRUE)?'Update succesvol.':'Update mislukt: ' . $result;
        $nexturl = sprintf('index.php?page=edit-layer&layer_id=%d', $layer_id);
        break;
    case "edit-map-layer":
        $layer_id = helper::FetchParam('layer_id', -1);
        $layer = helper::GetLayer($layer_id);
        $map_id = helper::FetchParam('map_id', -1);
        $maplayer = helper::GetMapLayerByMapIdAndLayerId($map_id, $layer_id);
        
        if (isset($_REQUEST['delete-maplayer']))
        {
            $result = helper::DeleteMapLayer($maplayer);
            $msg = ($result === TRUE)?'Laag verwijderd.':'Kan laag niet verwijderen.';
            $nexturl = sprintf('index.php?page=edit-project-lagen&project_id=%d', $project_id);
        }
        else
        {
            // Update layer
            //$title = helper::FetchParam('title', '');
            //$layertype = helper::FetchParam('layertype', 1);
            //$source = helper::FetchParam('source', null);
            //$style = helper::FetchParam('style', null);
            //$legend = helper::FetchParam('legend', null);
            //$baselayer = helper::FetchParam('baselayer', 0);        
            //$result1 = helper::UpdateLayer($layer, $title, $layertype, $source, $style, $legend, $baselayer);

            // Update maplayer
            $opacity = helper::FetchParam('opacity', 1);
            $visible = helper::FetchParam('visible', 0);
            $show_opacity_slider = helper::FetchParam('show_opacity_slider', 1);
            $popup_enabled = helper::FetchParam('popup_enabled', 1);
            $hidden = helper::FetchParam('hidden', 0);
            $result2 = helper::UpdateMapLayer($maplayer, $opacity, $visible, $show_opacity_slider, $popup_enabled, $hidden);

            $msg = ($result2 === TRUE)?'Update succesvol.':'Update mislukt: ' . $result2;
            $nexturl = sprintf('index.php?page=edit-project-lagen&project_id=%d', $project_id);
        }
        break;
    case "edit-group":
        $layer_id = helper::FetchParam('layer_id', -1);
        $layer = helper::GetLayer($layer_id);
        if (isset($_REQUEST['delete-group']))
        {
            $result = helper::DeleteLayer($layer);
            $msg = ($result === TRUE)?'Groep verwijderd.':'Kan groep niet verwijderen.';
            $nexturl = sprintf('index.php?page=edit-project-lagen&project_id=%d', $project_id);
        }
        else
        {
            $title = helper::FetchParam('title', null);

            $result = helper::UpdateGroup($layer, $title);
            $msg = ($result === TRUE)?'Update succesvol.':'Update mislukt: ' . $result;
            $nexturl = sprintf('index.php?page=edit-project-lagen&project_id=%d', $project_id);
        }
        break;
    case "insert-group":
        $title = helper::FetchParam("title", "");
        $layer_id = helper::InsertGroup($title);
        
        // Always insert it into maplayers as well
        $layer = helper::GetLayer($layer_id);
        $project = helper::GetProject($project_id);
        $map = helper::GetMap($project->map);
        helper::InsertMapLayer($map, $layer);
        
        $nexturl = sprintf('index.php?page=edit-project-lagen&project_id=%d', $project_id);
        $msg = (is_numeric($layer_id)?'Nieuwe groep aangemaakt.':'Kan geen nieuwe groep aanmaken: ' . $layer_id);
        break;
    case "insert-project-algemeen":
        $project_id = helper::FetchParam("project_id", -1);
        $project = helper::GetProject($project_id);
        // Make changes
        $name = helper::FetchParam('name', null);
        $enabled = helper::FetchParam('enabled', null);
        $location = helper::FetchParam('location', null);
        $remarks = helper::FetchParam('remarks', null);
        $latitude = helper::FetchParam('latitude', null);
        $longitude = helper::FetchParam('longitude', null);
        $zoom = helper::FetchParam('zoom', null);
        $show_scalebar = helper::FetchParam('show_scalebar', null);
        $show_overview = helper::FetchParam('show_overview', null);
        $show_attribution = helper::FetchParam('show_attribution', null);
        $description = helper::FetchParam('description', null);
        $category = helper::FetchParam('category', null);
        $catorder = helper::FetchParam('catorder', null);
        $map = helper::FetchParam('map', null);
        $overviewmap = helper::FetchParam('overviewmap', null);
        // Upload thumbnail
        $fileinfo = $_FILES['thumbnail'];
        if (helper::HasUploadInfo($fileinfo))
        {
            helper::Upload($fileinfo, '../' . CC::PATH_TO_THUMBNAILS);
        }
        $thumbnail = (helper::HasUploadInfo($fileinfo))? CC::PATH_TO_THUMBNAILS . $fileinfo['name'] : $project->thumbnail;
        
        $project_id = helper::InsertProject($name, $enabled, $location, $remarks, $latitude, $longitude, $zoom, $show_scalebar, $show_overview, $show_attribution, $description, $category, $catorder, $map, $overviewmap, $thumbnail);
        $msg = (is_numeric($project_id)?'Nieuw project aangemaakt.':'Kan geen nieuw project aanmaken: ' . $project_id);
        echo $msg;
        $nexturl = sprintf('index.php?page=edit-project-algemeen&project_id=%d', $project_id);
        break;
    case "edit-project-algemeen":
        $project_id = helper::FetchParam("project_id", -1);
        $project = helper::GetProject($project_id);
        $fileinfo = $_FILES['thumbnail'];

        // Make changes
        $name = helper::FetchParam('name', null);
        $enabled = helper::FetchParam('enabled', null);
        $location = helper::FetchParam('location', null);
        $remarks = helper::FetchParam('remarks', null);
        $latitude = helper::FetchParam('latitude', null);
        $longitude = helper::FetchParam('longitude', null);
        $zoom = helper::FetchParam('zoom', null);
        $show_scalebar = helper::FetchParam('show_scalebar', null);
        $show_overview = helper::FetchParam('show_overview', null);
        $show_attribution = helper::FetchParam('show_attribution', null);
        $description = helper::FetchParam('description', null);
        $category = helper::FetchParam('category', null);
        $catorder = helper::FetchParam('catorder', null);
        $map = helper::FetchParam('map', null);
        $overviewmap = helper::FetchParam('overviewmap', null);
        // Upload thumbnail
        if (helper::HasUploadInfo($fileinfo))
        {
            helper::Upload($fileinfo, '../' . CC::PATH_TO_THUMBNAILS);
        }
        $thumbnail = (helper::HasUploadInfo($fileinfo))? CC::PATH_TO_THUMBNAILS . $fileinfo['name'] : $project->thumbnail;

        
        $result = helper::UpdateProject($project, $name, $enabled, $location, $remarks, $latitude, $longitude, $zoom, $show_scalebar, $show_overview, $show_attribution, $description, $category, $catorder, $map, $overviewmap, $thumbnail);
        $msg = ($result === TRUE)?'Update succesvol.':'Update mislukt: ' . $result;
        $nexturl = sprintf('index.php?page=edit-project-algemeen&project_id=%d', $project_id);
        break;
    case "delete-project":
        $user_id = helper::FetchParam("project_id", -1);
        $result = helper::DeleteProject($project_id);
        $msg = ($result === TRUE)?'Project verwijderd.':'Kan project niet verwijderen.';
        $nexturl = sprintf('index.php?page=project-overview');
        break;
    case "delete-user":
        $user_id = helper::FetchParam("user_id", -1);
        $result = helper::DeleteUser($user_id);
        $msg = ($result === TRUE)?'Gebruiker verwijderd.':'Kan gebruiker niet verwijderen.';
        $nexturl = sprintf('index.php?page=gebruikers');
        break;
    case "edit-user":
        $user_id = helper::FetchParam("user_id", -1);
        $user = helper::GetUserById($user_id);
        $fileinfo = $_FILES['avatar'];
        // Make changes
        $email = helper::FetchParam("email", null);
        $first_name = helper::FetchParam("first_name", null);
        $last_name = helper::FetchParam("last_name", null);
        $password = helper::FetchParam("password", null);
        $usertype = helper::FetchParam("usertype", 3);
        $phone_number = helper::FetchParam("phone_number", null);
        $comment = helper::FetchParam("comment", null);
        $enabled = helper::FetchParam("enabled", 0);
        $image = (helper::HasUploadInfo($fileinfo))? CC::PATH_TO_AVATARS . $fileinfo['name'] : $user->image;
        $result = helper::UpdateUser($user, $email, $first_name, $last_name, $password, $usertype, $phone_number, $comment, $enabled, $image);
        $msg = ($result === TRUE)?'Update succesvol.':'Update mislukt: ' . $result;
                
        // User projects
        $availableProjects = $_REQUEST['available_projects'];
        if (isset($availableProjects))
        {
            helper::UpdateUserProjects($user, $availableProjects);
        }
        // Upload avatar
        if (helper::HasUploadInfo($fileinfo))
        {
            helper::Upload($fileinfo, '../' . CC::PATH_TO_AVATARS);
        }
        $nexturl = sprintf('index.php?page=edit-user&user_id=%d', $user_id);
        break;
    case "insert-user":
        $fileinfo = $_FILES['avatar'];
        $email = helper::FetchParam("email", null);
        $first_name = helper::FetchParam("first_name", null);
        $last_name = helper::FetchParam("last_name", null);
        $password = helper::FetchParam("password", null);
        $usertype = helper::FetchParam("usertype", 3);
        $phone_number = helper::FetchParam("phone_number", null);
        $comment = helper::FetchParam("comment", null);
        $enabled = helper::FetchParam("enabled", 0);
        $image = (helper::HasUploadInfo($fileinfo))? CC::PATH_TO_AVATARS . $fileinfo['name'] : 'missing.jpg';
        $user_id = helper::InsertUser($email, $first_name, $last_name, $password, $usertype, $phone_number, $comment, $enabled, $image);
        $nexturl = sprintf('index.php?page=edit-user&user_id=%d', $user_id);
        $msg = (is_numeric($user_id)?'Nieuwe gebruiker aangemaakt.':'Kan geen nieuwe gebruiker aanmaken: ' . $user_id);
        // User projects
        $user = helper::GetUserById($user_id);
        $availableProjects = $_REQUEST['available_projects'];
        if (isset($availableProjects))
        {
            helper::UpdateUserProjects($user, $availableProjects);
        }
        break;
    case "copy-user":
        $user_id = helper::FetchParam("user_id", -1);
        $user = helper::GetUserById($user_id);
        $copy = helper::GetCopy($user);
        $copy->last_name .= ' (copy)';
        $copy->email .= ' (copy)';
        $new_id = helper::Save($copy);
        $msg = (is_numeric($new_id))?'Update succesvol.':'Update mislukt: ' . $result;
        $nexturl = sprintf('index.php?page=edit-user&user_id=%d', $new_id);
        break;
    case "update-layerorder":
        $json = helper::FetchParam('layer_order', '');
        $layerorder = json_decode($json);
        $result = helper::UpdateLayerOrder($layerorder);
        $nexturl = sprintf('index.php?page=edit-project-lagenvolgorde&project_id=%d', $project_id);
        $msg = (is_numeric($result)?'Kaartvolgorde aangepast.':'Kan kaartvolgorde niet aanpassen: ' . $result);
        break;
}

// Add msg to url
if ($msg != '')
{
    $nexturl .= '&msg=' . urlencode($msg);
}

//echo $nexturl;
if (!$debug)
{
    header("Location: {$nexturl}");
}
exit;