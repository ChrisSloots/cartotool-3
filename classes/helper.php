<?php
if(!function_exists('hash_equals')) {
  function hash_equals($str1, $str2) {
    if(strlen($str1) != strlen($str2)) {
      return false;
    } else {
      $res = $str1 ^ $str2;
      $ret = 0;
      for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      return !$ret;
    }
  }
}

class helper {
    
   /**
    * Return TRUE if the user is allowed to see this project, false otherwise
    * @param type $user_id
    * @param type $project_id
    * @return boolean
    */
   public static function IsAuthorized($user, $project_id)
   {
      if ($user->usertype == 3)
      {
          // Admin is always authorized
          return  TRUE;
      }
      
      $result = R::findOne(CC::USERPROJECTS, 'user_id = ? AND project_id = ?', array($user->id, $project_id));
      if ($result === NULL)
      {
          return FALSE;
      }
      else
      {
          return TRUE;
      }
   }
   
   public static function IsSelectedLayer($layer, $map_id)
   {
       $result = R::findOne(CC::MAPLAYERS, 'layer = ? AND map = ?', array($layer->id, $map_id));
       if ($result === NULL)
       {
           return FALSE;
       }
       else
       {
           return TRUE;
       }
   }

   public static function IsManager($user)
   {
       return $user->usertype >= 2;
   }
   
   public static function IsAdministrator($user)
   {
       return $user->usertype == 3;
   }
   
   public static function DeleteUser($user_id)
   {
       $user = helper::GetUserById($user_id);
       try {
            R::trash( $user );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function DeleteProject($project_id)
   {
       $project = helper::GetProject($project_id);
       try {
            R::trash( $project );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function DeleteLayer($layer)
   {
       try {
            R::trash( $layer );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function DeleteStyle($style)
   {
       try {
            R::trash( $style );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function DeleteLegend($legend)
   {
       try {
            R::trash( $legend );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function DeleteSymbol($symbol)
   {
       try {
           try {
               echo "Verwijderen: " . $symbol->image;
               unlink("../".$symbol->image);
           } catch (Exception $ex) {

           }
            R::trash( $symbol );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function isLibraryElement($page)
   {
       $libraryElements = array(
           'bibliotheek',
           'maps',
           'layers',
           'sources',
           'styles',
           'legends',
           'symbols',
           'edit-map',
           'edit-layer',
           'edit-source',
           'edit-style',
           'edit-legend',
           'edit-symbol'
       );
       if (in_array($page, $libraryElements))
       {
           return TRUE;
       }
       else
       {
           return FALSE;
       }
   }

   public static function DeleteSource($source)
   {
       try {
           try {
               unlink("../".$source->url);
           } catch (Exception $ex) {

           }
            R::trash( $source );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function DeleteMap($map)
   {
       try {
            R::trash( $map );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function DeleteMapLayer($maplayer)
   {
       try {
            R::trash( $maplayer );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function DeleteUserProject($userproject)
   {
       try {
            R::trash( $userproject );
            return TRUE;
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
   }
   
   public static function GetProjectURL($project_id)
   {
       return sprintf('http://%s/cartotool.php?id=%d',  $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/..", $project_id);
   }

   public static function DeleteUserProjects($user, $availableProjects)
   {
       $userprojects = helper::GetUserProjectsByUser($user);
        
        foreach ($userprojects as $up)
       {
           if (!in_array($up->project_id, $availableProjects))
           {
               helper::DeleteUserProject($up);
           }
       }
   }
   
   public static function DeleteAllUserProjects($user)
   {
       $userprojects = helper::GetUserProjectsByUser($user);
       foreach ($userprojects as $up)
       {
           helper::DeleteUserProject($up);           
       }
   }

   public static function EncryptPassword($password)
   {
       // A higher "cost" is more secure but consumes more processing power
       $cost = 10;

       // Create a random salt
       $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

       // Prefix information about the hash so PHP knows how to verify it later.
       // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
        $salt = sprintf("$2a$%02d$", $cost) . $salt;

        // Value:
        // $2a$10$eImiTXuWVxfM37uY4JANjQ==

        // Hash the password with the salt
        $hash = crypt($password, $salt);
        
        
        return $hash;
   }
   
   public static function FetchParam($paramname, $default, $source = INPUT_REQUEST)
   {
       if ($source == INPUT_REQUEST)
       {
            $var = filter_input(INPUT_POST, $paramname);
            if (isset($var))
            {
                return $var;
            }
            else
           {
                $var = filter_input(INPUT_GET, $paramname);
                if (isset($var))
                {
                    return $var;
                }
                else
               {
                    return $default;
               }
           }
       }
       else 
       {    
            $var = filter_input($source, $paramname);
            if (isset($var))
            {
                return $var;
            }
            else
           {
               return $default;
           }
       }
   }
   
   public static function ModifyURL($params)
   {
        $parseRes = \parse_url($_SERVER['REQUEST_URI']);
        return $parseRes['path'].'?'.http_build_query(array_merge($_GET, $params));
   }

   public static function GetUser($email)
   {
       $user = R::findOne(CC::USERS, 'email = ?', array($email));
       if ($user === NULL)
       {
           return NULL;
       }
       else
       {
           return $user;
       }       
   }
   
   public static function GetCopy($bean)
   {
       return R::duplicate($bean);
   }
   
   public static function Save($bean)
   {
       return R::store($bean);
   }

   public static function GetUserById($user_id)
   {
       $user = R::findOne(CC::USERS, 'id = ?', array($user_id));
       if ($user === NULL)
       {
           return NULL;
       }
       else
       {
           return $user;
       }       
   }
   
   public static function GetCustomerId()
   {
       // This should return a valid customer id based on user
       if (isset($_SESSION["user"]))
       {
           $user = $_SESSION["user"];
           return $user->customer;
       }
       else
       {
           return 0;
       }
   }
   
   public static function GetApplicationSettings()
   {
       $customer_id = helper::GetCustomerId();
       $application_settings = R::findOne(CC::APPLICATION_SETTINGS, 'application_customer = ?', array($customer_id));
       return $application_settings;
   }

   public static function GetLanguages()
   {
       $languages = R::findAll(CC::LANGUAGES, '  WHERE enabled ORDER BY `order`');
       return $languages;
   }
   
   public static function GetUsers()
   {
       $users = R::findAll(CC::USERS, ' ORDER BY `last_name`, `first_name`');
       return $users;
   }
   
   public static function SetProperties(&$item, &$request)
   {
       $properties = array(
           CC::USERS => array("first_name", "last_name", "email", "enabled", "image", "comment", "contact", "phone_number")
       );
       foreach ($request as $key => $value) {
           if (in_array($key, $properties[$item->getMeta('type')]))
           {
               $item->{$key} = $value;
           }
       }
   }

   public static function GetCMSTables($user)
   {
       $objects = R::findAll(CC::CMS_TABLES, ' WHERE not hidden ORDER BY table_order');
       return $objects;
   }
   
   public static function TranslateLayerType($layertype_id)
   {
       switch ($layertype_id)
       {
           case 1:
               return helper::GetText('TILE');
           case 2:
               return helper::GetText('VECTOR');
           case 3:
               return helper::GetText('GROUP');
           case 4:
               return helper::GetText('HEATMAP');
       }
   }

   public static function GetText($code, $make_upper = FALSE)
   {
       global $language_id;

       $text = R::findOne(CC::TEXT, 'code = ? AND language = ?', array($code, $language_id));
       // If text element does not exist, fall back to nl
       if ($text === NULL)
       {
           $text = R::findOne(CC::TEXT, 'code = ? AND language = ?', array($code, CC::DEFAULT_LANGUAGE_ID));
       }
       if ($text === NULL)
       {
           return "???";
       }
       else
       {
           if ($make_upper)
           {
               return strtoupper($text->text);
           }
           else
           {
               return $text->text;
           }
       }
   }

   public static function GetLanguageLinks($language_id)
   {
       $languages = helper::GetLanguages();
       $html = '';
       $isFirst = TRUE;
       foreach ($languages as $language) {
           if (!$isFirst)
           {
               $html .= sprintf(' <span>/</span>');
           }
           else
           {
               $isFirst = FALSE;
           }
           $params = array();
           $params['lang'] = $language->id;
           $new_url = helper::ModifyURL($params);
           $html .= sprintf('<a href="%3$s" class="%1$s" title="%4$s">%2$s</a>', ($language->id == $language_id)?'active':'', strtoupper($language->id), $new_url, $language->name);
       }
       return $html;
   }

   public static function GetCustomer()
   {
       $customer_id = helper::GetCustomerId();
       $customer = R::findOne(CC::CUSTOMERS, 'id = ?', array($customer_id));
       return $customer;
   }
   
   public static function GetMap($map_id)
   {
       $map = R::findOne(CC::MAPS, 'id = ?', array($map_id));
       return $map;
   }

   public static function GetLayer($layer_id)
   {
       $layer = R::findOne(CC::LAYERS, 'id = ?', array($layer_id));
       return $layer;
   }

   public static function IsPasswordCorrect($user, $password)
   {
       // to do
       if ($user->enabled && hash_equals($user->password_hash, crypt($password, $user->password_hash)))
       //if (TRUE)
       {
           return TRUE;
       }
       else
       {
           return FALSE;
       }
   }
   
   /**
    * Returns an array of users that belong to the given project
    * @param type $project
    */
   public static function GetAvailableUsers($project)
   {
       $sql = sprintf('
        SELECT
            u.*
        FROM 
            mppng_cartotool.userprojects up
        JOIN
            mppng_cartotool.users u
        ON u.id = up.user_id
        WHERE 
            up.project_id = %d
        ORDER BY
            u.last_name, u.first_name
        ', $project->id);
       $rows = R::getAll($sql);
       $users = R::convertToBeans(CC::PROJECTS, $rows);
       return $users;
   }
   
   public static function ArrayToSeparatedList(&$elements, $item)
   {
       if (count($elements) > 0)
       {
            foreach($elements as $element)
            {
                $new_arr[] = $element->{$item};
            }
            $result = implode('<br/>', $new_arr);
            return $result;
       }
       else
       {
            return '';
       }
   }
   
   public static function GetMapLayersByMap($map)
   {
       return R::findAll(CC::MAPLAYERS, ' map = ?', array($map->id));
   }
   
   public static function GetUserProjectsByUser($user)
   {
       return R::findAll(CC::USERPROJECTS, ' user_id = ?', array($user->id));
   }
   
   public static function GetUserProjectsByProject($project)
   {
       return R::findAll(CC::USERPROJECTS, ' project_id = ?', array($project->id));
   }



   public static function GetAvailableMaps($user)
   {
       // Admin can see all projects
       if (helper::IsAdministrator($user))
       {
        $sql = sprintf('
            SELECT
                m.*
            FROM 
                maps m
            ORDER BY 
                m.name');
       }
       else
       {
        $sql = sprintf('
            select
                m.*
            from
                maps m
            where
                m.id in
                (
                    select p.map
                    from projects p
                    join userprojects up on up.project_id = p.id
                    and up.user_id = %1$d
                    union
                    select p.overviewmap
                    from projects p
                    join userprojects up on up.project_id = p.id
                    and up.user_id = %1$d
                 )
            order by m.name
', $user->id);
       }
       $rows = R::getAll($sql);
       $maps = R::convertToBeans(CC::MAPS, $rows);
       return $maps;
   }
   

   
   public static function GetAvailableProjects($user)
   {
       // Admin can see all projects
       if ($user->usertype == 3)
       {
        $sql = sprintf('
            SELECT
            p.*
            FROM projects p
            WHERE p.enabled = 1
            ORDER BY p.category, p.catorder');
       }
       else
       {
        $sql = sprintf('
            SELECT
            p.*
            FROM userprojects up
            JOIN projects p ON p.id = up.project_id
            WHERE (up.user_id = %1$d
            AND p.enabled = 1)
            ORDER BY p.catorder', $user->id);
       }
       $rows = R::getAll($sql);
       $projects = R::convertToBeans(CC::PROJECTS, $rows);
       return $projects;
   }
   
   public static function GetProjects()
   {
       $projects = R::findAll(CC::PROJECTS);
       return $projects;
   }
   
   public static function GetMaps()
   {
       $styles = R::findAll(CC::MAPS, 'ORDER BY name');
       return $styles;
   }
   
   public static function GetStyles()
   {
       $styles = R::findAll(CC::STYLES, 'ORDER BY name');
       return $styles;
   }
   
   public static function GetSymbols()
   {
       $symbols = R::findAll(CC::SYMBOLS, 'ORDER BY name');
       return $symbols;
   }
   
   public static function GetLegends()
   {
       $styles = R::findAll(CC::LEGENDS, 'ORDER BY name');
       return $styles;
   }
   
   public static function GetSources()
   {
       $styles = R::findAll(CC::SOURCES, 'ORDER BY name');
       return $styles;
   }
   
   public static function GetUserType($usertype_id)
   {
       $usertype = R::findOne(CC::USERTYPES, 'id = ?', array($usertype_id));
       return $usertype;
   }

   public static function GetUserTooltip($user)
   {
       $usertype = helper::GetUserType($user->usertype);
       $html = '';
       $html .= sprintf('%s' . PHP_EOL, $user->email);
       $html .= sprintf('%s' . PHP_EOL, $usertype->usertype);
       return $html;
   }

   public static function GetProjectsInCategory($user, $category)
   {
       if ($user->usertype == 3)
       {
        $sql = sprintf('
            SELECT
            p.*
            FROM projects p
            WHERE p.enabled = 1
            AND p.category = "%1$s"
            ORDER BY p.catorder', $category);
       }
       else
       {
        $sql = sprintf('
            SELECT
            p.*
            FROM userprojects up
            JOIN projects p ON p.id = up.project_id
            WHERE up.user_id = %1$d
            AND p.enabled = 1
            AND p.category = "%2$s"
            ORDER BY p.catorder', $user->id, $category);
       }
       $rows = R::getAll($sql);
       $projects = R::convertToBeans(CC::PROJECTS, $rows);
       return $projects;
   }
   
   public static function InsertUser($email, $first_name, $last_name, $password, $usertype = 3, $phone_number, $comment, $enabled, $image)
   {
       $user = R::dispense(CC::USERS);
       $user->email = $email;
       $user->first_name = $first_name;
       $user->last_name = $last_name;
       $user->phone_number = $phone_number;
       $user->comment = $comment;
       $user->enabled = $enabled == 1;
       $user->image = $image;
       $hash = helper::EncryptPassword($password);
       $user->password_hash = $hash;
       $user->usertype = $usertype;
       try {
            $user_id = R::store($user);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $user_id;
   }
   
   public static function InsertGroup($title)
   {
       $layer = R::dispense(CC::LAYERS);
       $layer->title = $title;
       $layer->layertype = 3;
       
       try {
            $layer_id = R::store($layer);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $layer_id;
   }
   
   public static function InsertLayer($title, $layertype, $source, $style, $legend, $baselayer, $description)
   {
       $layer = R::dispense(CC::LAYERS);
       $layer->title = $title;
       $layer->layertype = $layertype;
       $layer->source = $source;
       $layer->style = $style;
       $layer->legend = $legend;
       $layer->baselayer = $baselayer;
       $layer->description = $description;
       try {
            $layer_id = R::store($layer);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $layer_id;
   }

   public static function InsertProject($name, $enabled, $location, $remarks, $latitude, $longitude, $zoom, $show_scalebar, $show_overview, $show_attribution, $description, $category, $catorder, $map, $overviewmap, $thumbnail)
   {
       $project = R::dispense(CC::PROJECTS);
       $project->name = $name;
       $project->enabled = $enabled;
       $project->location = $location;
       $project->remarks = $remarks;
       $project->latitude = $latitude;
       $project->longitude = $longitude;
       $project->zoom = $zoom;
       $project->show_scalebar = $show_scalebar;
       $project->show_overview = $show_overview;
       $project->show_attribution = $show_attribution;
       $project->description = $description;
       $project->category = $category;
       $project->catorder = $catorder;
       $project->map = $map;
       $project->overviewmap = $overviewmap;
       $project->thumbnail = $thumbnail;
       try {
            $project_id = R::store($project);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $project_id;
   }

   public static function InsertStyle($name, $description, $stylecode)
   {
       $style = R::dispense(CC::STYLES);
       $style->name = $name;
       $style->description = $description;
       $style->style = $stylecode;

       try {
            $style_id = R::store($style);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $style_id;
   }

   public static function InsertLegend($name, $description)
   {
       $legend = R::dispense(CC::LEGENDS);
       $legend->name = $name;
       $legend->description = $description;

       try {
            $legend_id = R::store($legend);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $legend_id;
   }

   public static function InsertMap($name, $description)
   {
       $map = R::dispense(CC::MAPS);
       $map->name = $name;
       $map->description = $description;

       try {
            $map_id = R::store($map);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $map_id;
   }

   public static function InsertSymbol($name, $image)
   {
       $symbol = R::dispense(CC::SYMBOLS);
       $symbol->name = $name;
       $symbol->image = $image;

       try {
            $symbol_id = R::store($symbol);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $symbol_id;
   }
   
   public static function GetBreadCrumbs()
   {
       $result = array();
       if (isset($_SESSION['project']))
       {
           $project = $_SESSION['project'];
           $result[] = (object) array('title' => helper::GetText('PROJECT') . ': ' . $project->name, 'link' => sprintf('?page=edit-project-algemeen&project_id=%d', $project->id));
           
           $map = helper::GetMap($project->map);
           $result[] = (object) array('title' => helper::GetText('MAP') . ': ' .  $map->name, 'link' => sprintf('?page=edit-map&map_id=%d', $map->id));
       }
       return $result;
   }

   public static function InsertSource($name, $sourcetype, $code, $attribution, $url, $maxzoom)
   {
       $source = R::dispense(CC::SOURCES);
       $source->name = $name;
       $source->sourcetype = $sourcetype;
       $source->code = $code;
       $source->attribution = $attribution;
       $source->url = $url;
       $source->maxzoom = $maxzoom;

       try {
            $source_id = R::store($source);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $source_id;
   }


   public static function InsertMapLayer($map, $layer)
   {
       $maplayer = R::dispense(CC::MAPLAYERS);
       $maplayer->map = $map->id;
       $maplayer->layer = $layer->id;
       $maplayer->layerorder = 0;
       $maplayer->opacity = 0.5; // default 50% transparent
       $maplayer->visible = 0;
       $maplayer->show_opacity_slider = 1;
       $maplayer->popup_enabled = 1;
       $maplayer->hidden = 0;
       
       try {
            $maplayer_id = R::store($maplayer);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $maplayer_id;
   }
   
   public static function InsertUserProject($user, $project)
   {
       $userproject = R::dispense(CC::USERPROJECTS);
       $userproject->user_id = $user->id;
       $userproject->project_id = $project->id;
       try {
            $userproject_id = R::store($userproject);
       }
       catch (Exception $e)
       {
           return $e->getMessage();
       }
       return $userproject_id;
   }
   
   public static function UpdateProject($project, $name, $enabled, $location, $remarks, $latitude, $longitude, $zoom, $show_scalebar, $show_overview, $show_attribution, $description, $category, $catorder, $map, $overviewmap, $thumbnail)
   {
       $project->name = $name;
       $project->enabled = $enabled;
       $project->location = $location;
       $project->remarks = $remarks;
       $project->latitude = $latitude;
       $project->longitude = $longitude;
       $project->zoom = $zoom;
       $project->show_scalebar = $show_scalebar;
       $project->show_overview = $show_overview;
       $project->show_attribution = $show_attribution;
       $project->description = $description;
       $project->category = $category;
       $project->catorder = $catorder;
       $project->map = $map;
       $project->overviewmap = $overviewmap;
       $project->thumbnail = $thumbnail;
       
       $result = TRUE;
       try {
            $project_id = R::store($project);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;

   }
   
   public static function UpdateLayer($layer, $title, $layertype, $source, $style, $legend, $baselayer, $description)
   {
       $layer->title = $title;
       $layer->layertype = $layertype;
       $layer->source = $source;
       $layer->style = $style;
       $layer->legend = $legend;
       $layer->baselayer = $baselayer;
       $layer->description = $description;
       
       $result = TRUE;
       try {
            R::store($layer);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;
   }
   
   public static function UpdateStyle($style, $name, $description, $stylecode)
   {
       $style->name = $name;
       $style->description = $description;
       $style->style = $stylecode;
       
       $result = TRUE;
       try {
            R::store($style);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;
   }
   
   public static function UpdateLegend($legend, $name, $description)
   {
       $legend->name = $name;
       $legend->description = $description;
       
       $result = TRUE;
       try {
            R::store($legend);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;
   }
   
   public static function UpdateMap($map, $name, $description)
   {
       $map->name = $name;
       $map->description = $description;
       
       $result = TRUE;
       try {
            R::store($map);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;
   }
   
   public static function UpdateSymbol($symbol, $name, $image)
   {
       $symbol->name = $name;
       $symbol->image = $image;
       
       $result = TRUE;
       try {
            R::store($symbol);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;
   }
   
   public static function UpdateSource($source, $name, $sourcetype, $code, $attribution, $url, $maxzoom)
   {
       $source->name = $name;
       $source->sourcetype = $sourcetype;
       $source->code = $code;
       $source->attribution = $attribution;
       $source->url = $url;
       $source->maxzoom = $maxzoom;
       
       $result = TRUE;
       try {
            R::store($source);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;
   }
   
   public static function UpdateMapLayer($maplayer, $opacity, $visible, $show_opacity_slider, $popup_enabled, $hidden)
   {
       $maplayer ->opacity = $opacity;
       $maplayer ->visible = $visible;
       $maplayer ->show_opacity_slider = $show_opacity_slider;
       $maplayer ->popup_enabled = $popup_enabled;
       $maplayer ->hidden = $hidden;
       $result = TRUE;
       try {
            R::store($maplayer);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;   
   }
   
   public static function UpdateUserProjects($user, $availableProjects)
   {
       // First remove unwanted projects
       $userprojects = helper::GetUserProjectsByUser($user);
       foreach ($userprojects as $up) {
           if (!in_array($up->project_id, $availableProjects))
           {
               // Remove this one
               helper::DeleteUserProject($up);
           }
           else
           {
               // Remove from list... should not be added, it's already there
               $availableProjects = array_diff($availableProjects, array($up->project_id));
           }
       }
       // Finally add the new ones
       foreach($availableProjects as $project_id)
       {
           $project = helper::GetProject($project_id);
           helper::InsertUserProject($user, $project);
       }
   }
   
   public static function UpdateMapLayers($map, $selected_layers)
   {
       // First remove unwanted projects
       $maplayers = helper::GetMapLayersByMap($map);
       foreach ($maplayers as $ml) {
           if (!in_array($ml->layer, $selected_layers))
           {
               // Remove this one
               helper::DeleteMapLayer($ml);
           }
           else
           {
               // Remove from list... should not be added, it's already there
               $selected_layers = array_diff($selected_layers, array($ml->layer));
           }
       }
       // Finally add the new ones
       foreach($selected_layers as $layer_id)
       {
           $layer = helper::GetLayer($layer_id);
           helper::InsertMapLayer($map, $layer);
       }
   }
   
   public static function HasUploadInfo($fileinfo)
   {
       return $fileinfo['size'] > 0;
   }

   public static function UpdateUser($user, $email, $first_name, $last_name, $password, $usertype = 3, $phone_number, $comment, $enabled, $image)
   {
       $user->email = $email;
       $user->first_name = $first_name;
       $user->last_name = $last_name;
       $user->phone_number = $phone_number;
       $user->comment = $comment;
       $user->enabled = $enabled == 1;
       $user->image = $image;
       if ($password != '')
       {
            $hash = helper::EncryptPassword($password);
            $user->password_hash = $hash;
       }
       $user->usertype = $usertype;
       
       $result = TRUE;
       try {
            R::store($user);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;
   }
   
   public static function UpdateGroup($layer, $title)
   {
       $layer->title = $title;
       $layer->layertype = 3; // for safety
       
       $result = TRUE;
       try {
            R::store($layer);
       }
       catch (Exception $e)
       {
           $result = $e->getMessage();
       }
       return $result;
   }
   
   public static function Upload($fileinfo, $uploaddir)
    {
        $uploadfile = $uploaddir . basename($fileinfo['name']);
        if (move_uploaded_file($fileinfo['tmp_name'], $uploadfile)) {
            return;
        }
        else
        {
            return "Error uploading file.\n";
        }
        
    }

   public static function AppTitle()
   {
       $application_settings = helper::GetApplicationSettings();
       $customer = helper::GetCustomer();
       $projectid = helper::FetchParam('id', NULL);
       if ($projectid === NULL)
       {
           return sprintf('%2$s v%3$s // %1$s', $customer->customer_name, $application_settings->application_name, $application_settings->application_version);
       }
       else
       {
           $project = helper::GetProject($projectid);
           return sprintf('%4$s - %2$s v%3$s // %1$s', $customer->customer_name, $application_settings->application_name, $application_settings->application_version, $project->name);
       }
   }

   public static function GetAvailableProjectImagesHTML($user)
   {
       $html = '';
       $image_index = 0;
       $categories = helper::GetAvailableProjects($user);
       $current_category = '!@#$%';
       foreach ($categories as $key => $catproject) {
           if ($current_category != $catproject->category)
           {
               // We have deteced a new category -> insert category item
               $current_category = $catproject->category;
               $projects = helper::GetProjectsInCategory($user, $current_category);

               foreach ($projects as $key => $project) {
                    $image_name = sprintf('img%d', $image_index);                           
                    $html .= sprintf('    <div class="col-md-4 col-sm-6 col-xs-4 %1$s">' . PHP_EOL, $image_name);
                    $html .= sprintf('      <div class="image-container">' . PHP_EOL);
                    $html .= sprintf('        <a href="cartotool.php?id=%3$s" title="%2$s"><img class="img img-responsive" src="%1$s"></a>' . PHP_EOL, $project->thumbnail, $project->description, $project->id);
                    $html .= sprintf('        <div class="caption">' . PHP_EOL);
                    $html .= sprintf('          <p class="title"><a href="cartotool.php?id=%3$s" title="%2$s">%1$s</a></p>' . PHP_EOL, $project->name, $project->description, $project->id);
                    $html .= sprintf('          <p class="desc">%1$s</p>' . PHP_EOL, $project->description);
                    $html .= sprintf('        </div>' . PHP_EOL);
                    $html .= sprintf('      </div>' . PHP_EOL);
                    $html .= sprintf('    </div>' . PHP_EOL);
                    $image_index++;
               }
           }
       }
       
       return $html;
   }
   
   public static function GetAvailableProjectsHTML($user)
   {
       $html = sprintf('<ul class="navigation">' . PHP_EOL);
       $categories = helper::GetAvailableProjects($user);
       $image_index = 0;
       $current_category = '!@#$%';
       
       // Show all if there are more than one categories
       if (count($categories) > 1)
       {
            $html .= sprintf('    <li class="portfolioFilter">' . PHP_EOL);
            $html .= sprintf('      <a data-filter="*" tabindex="-1" href="#" class="filter"><span class="mm-text">%1$s</span></a>' . PHP_EOL, helper::GetText("ALL_PROJECTS"));
            $html .= sprintf('    </li>' . PHP_EOL);
       }
               
       foreach ($categories as $key => $catproject) {
           if ($current_category != $catproject->category)
           {
               // We have deteced a new category -> insert category item
               $current_category = $catproject->category;
               $projects = helper::GetProjectsInCategory($user, $current_category);
               
               // Now list alle projects in this category
               $subhtml = sprintf('    <ul>' . PHP_EOL);
               $imglist = '';
               
               foreach ($projects as $key => $project) {
                   $image_name = sprintf('.img%d', $image_index);
                   $subhtml .= sprintf('      <li>' . PHP_EOL);
                   $subhtml .= sprintf('        <a data-filter="%2$s" tabindex="-1" href="#" class="filter"><span class="mm-text">%1$s</span></a>' . PHP_EOL, $project->name, $image_name);
                   $subhtml .= sprintf('      </li>' . PHP_EOL);
                   $imglist .= sprintf('%s, ', $image_name);
                   $image_index++;
               }
               $subhtml .= sprintf('    </ul>' . PHP_EOL);
               
               // Remove last ,_
               $imglist = substr($imglist, 0, -2);
               $html .= sprintf('  <li class="mm-dropdown portfolioFilter">' . PHP_EOL);
               $html .= sprintf('    <a data-filter="%3$s" tabindex="-1" class="filter" href="#"><span class="mm-text">%1$s</span><span class="label label-success">&nbsp;%2$d&nbsp;</span></a>' . PHP_EOL, $current_category, count($projects), $imglist);
               
               // 
               $html .= $subhtml;
               
               // Close category
               $html .= sprintf('  </li>' . PHP_EOL);
               
           }
       }
       // Don't forget to close the ul
       $html .= sprintf('</ul>' . PHP_EOL);
       
       return $html;
   }
   
   public static function GetDefaultLayerItems()
   {
       $html = sprintf('  <li class="menu-toggle no-arrow">' . PHP_EOL);
       $html .= sprintf('    <a id="main-menu-toggle" href="javascript:void(0)"><i class="menu-icon fa fa-bars icon"></i><span class="mm-text">%1$s<i class="menu-icon fa fa-caret-left close-icon"></i></span></a>' . PHP_EOL, helper::GetText("OPEN_MENU"));
       $html .= sprintf('  </li>' . PHP_EOL);
       //$html .= sprintf('  <li class="no-arrow">' . PHP_EOL);
       //$html .= sprintf('    <a href="javascript:void(0)"><img src="assets/images/pdf.png"><span class="mm-text">%1$s</span></a>' . PHP_EOL, helper::GetText("SAVE_PDF"));
       //$html .= sprintf('  </li>' . PHP_EOL);
       //$html .= sprintf('  <li class="no-arrow">' . PHP_EOL);
       //$html .= sprintf('    <a id="export-png" download="map.png"><img src="assets/images/save_as_png.png"><span class="mm-text">%1$s</span></a>' . PHP_EOL, helper::GetText("SAVE_PNG"));
       //$html .= sprintf('  </li>' . PHP_EOL);
       $html .= sprintf('  <li class="no-arrow">' . PHP_EOL);
       $html .= sprintf('    <a href="javascript: void(0)"><img src="assets/images/stack.png"><span class="mm-text">%1$s</span></a>' . PHP_EOL, helper::GetText("MAPS"));
       $html .= sprintf('  </li>' . PHP_EOL);
       return $html;
   }

   public static function HierarchicalLayerStructure($map, $parent_id, &$layertree, &$layers, &$index = 0, $parent_index = -1)
   {
       $indentation = str_repeat(" ", $index * 2);
       if ($parent_id === NULL)
       {
            $maplayers = R::findAll(CC::MAPLAYERS, 'map = ? AND isnull(parent_id) AND NOT hidden ORDER BY layerorder', array($map->id));
       }
       else
       {
            $maplayers = R::findAll(CC::MAPLAYERS, 'map = ? AND parent_id = ? AND NOT hidden ORDER BY layerorder', array($map->id, $parent_id));
       }
       
       if (count($maplayers) > 0) {
           
            if ($index == 0)
            {
                $layertree .= sprintf('%s<ul class="navigation fixed">' . PHP_EOL, $indentation);
            }
            else
            {
                $layertree .= sprintf('%s<ul>' . PHP_EOL, $indentation);
            }
            $layers .= sprintf('%svisible: false, layers: ['. PHP_EOL, $indentation);

            $isFirst = TRUE;
            foreach($maplayers as $maplayer)
            {           
                // Fetch layer info
                $layer = R::load( CC::LAYERS, $maplayer->layer );
                
                // Insert default items
                if ($index == 0)
                {
                    $layertree .= helper::GetDefaultLayerItems();
                }

                $layertree .= helper::GetLayerHTML($layer, $index, $maplayer, $parent_index);
                                
                if (!$isFirst)
                {
                    $layers .= ', ';
                }
                $layers .= helper::GetLayerScript($layer, $maplayer);
                
                $index++;
                

                // Now recursively one level deeper
                helper::HierarchicalLayerStructure($map, $maplayer->id, $layertree, $layers, $index, $index - 1);

                $layertree .= sprintf('  %s' . PHP_EOL, $indentation);
                
                // Close layer group
                if ($layer->layertype == 3)
                {
                    $layers .= '})' . PHP_EOL;
                }
                
                $isFirst = FALSE;
            }

            $layertree .= sprintf('%s</ul>' . PHP_EOL, $indentation);
            $layers .= sprintf('%s]' . PHP_EOL, $indentation);
       }


       return $maplayers;
   }
   
   public static function GetLayersByTypeAndUser($layertype, $user)
   {
       $sql = sprintf('select id, title from mppng_cartotool.layers where layertype = %d order by title', $layertype);
       $rows = R::getAll($sql);
       $layers = R::convertToBeans(CC::LAYERS, $rows);
       return $layers;
   }
   
   public static function GetLayers()
   {
       $layers = R::findAll(CC::LAYERS, 'ORDER BY title');
       return $layers;
   }

   public static function UpdateLayerOrder($layerorder, $parent_id = null)
   {
       try {
            if (count($layerorder) > 0)
            {
                //var_dump($layerorder);
                foreach($layerorder as $key => $value)
                {
                    if ($value->id != 0)
                    {
                        $p = ($parent_id == 0)?null:$parent_id;
                        //echo "ID: $value->id; PARENT_ID: ($parent_id); => parent_id zetten op: $p\r\n";
                        helper::UpdateMapLayerParent($value->id, $p, $key);
                    }
                    if (isset($value->children))
                    {
                        helper::UpdateLayerOrder($value->children, $value->id);
                    }
                }
            }
            return 1;
       }
       catch (Exception $e)
       {
            return $e->getMessage();
       }
   }
   
   public static function GetSelect($items, $name, $description, $current_id)
   {
       if ($current_id == null) $current_id = 0;
       $html = sprintf('<select class="form-control" id="%1$s" name="%1$s">' . PHP_EOL, $name);
       if (count($items) > 0)
       {
           foreach($items as $item)
           {
               $html .= sprintf('<option value="%1$d" %3$s>%2$s</option>', $item->id, $item->{$description}, ($item->id == $current_id)?'selected':'') . PHP_EOL;
           }
       }
       $html .= sprintf('</select>' . PHP_EOL);
       return $html;
   }

      public static function UpdateMapLayerParent($maplayer_id, $parent_id, $order)
   {
       echo sprintf("Set ml (%s) naar %s #%d\r\n", $maplayer_id, $parent_id, $order);
       $map_layer = helper::GetMapLayer($maplayer_id);
       $map_layer->parent_id = $parent_id;
       $map_layer->layerorder = $order;
       R::store($map_layer);
   }

   public static function GetHierarchicalLayersForCMS($map, $parent_id, &$tree)
   {
       if ($parent_id === NULL)
       {
            $maplayers = R::findAll(CC::MAPLAYERS, 'map = ? AND isnull(parent_id) AND NOT hidden ORDER BY layerorder', array($map->id));
       }
       else
       {
            $maplayers = R::findAll(CC::MAPLAYERS, 'map = ? AND parent_id = ? AND NOT hidden ORDER BY layerorder', array($map->id, $parent_id));
       }
       
       if (count($maplayers) != 0)
       {
           $tree .= '<ul>' . PHP_EOL;
           foreach ($maplayers as $key => $ml) {
               $layer = helper::GetLayer($ml->layer);
               if ($layer->layertype == 3) // Group
               {
                   $tree .= sprintf('<li data-id="%2$d" data-jstree=\'{ "icon" : "fa fa-folder", "opened" : true }\'>%1$s' . PHP_EOL, $layer->title, $ml->id);
               }
               else
               {
                   $tree .= sprintf('<li data-id="%2$d" data-jstree=\'{ "icon" : "fa fa-file-text ", "type":"file" }\'>%1$s</li>' . PHP_EOL, $layer->title, $ml->id);
               }
               helper::GetHierarchicalLayersForCMS($map, $ml->id, $tree);
               
               if ($layer->layertype == 3) // Group, close li
               {
                   $tree .= '</li>' . PHP_EOL;
               }
           }
           $tree .= '</ul>' . PHP_EOL;
       }

   }


   public static function GetHierarchicalLayersForLayerEdit($map, $parent_id, &$tree, $current_layer_id)
   {
       if ($parent_id === NULL)
       {
            $maplayers = R::findAll(CC::MAPLAYERS, 'map = ? AND isnull(parent_id) ORDER BY layerorder', array($map->id));
       }
       else
       {
            $maplayers = R::findAll(CC::MAPLAYERS, 'map = ? AND parent_id = ? ORDER BY layerorder', array($map->id, $parent_id));
       }
       
       if (count($maplayers) != 0)
       {
           $tree .= '<ul>' . PHP_EOL;
           foreach ($maplayers as $key => $ml) {
               $layer = helper::GetLayer($ml->layer);
               
               // Active or not
               //$active = sprintf('aria-selected="%s"', ($layer->id == $current_layer_id)?'true':'false');
               // aria-selected werkt niet...  to do
               
               if ($layer->layertype == 3) // Group
               {
                   $tree .= sprintf('<li data-url="edit-group.php?layer_id=%2$d" data-jstree=\'{ "opened" : true }\'>%1$s' . PHP_EOL, $layer->title, $ml->layer);
               }
               else
               {
                   $tree .= sprintf('<li data-url="edit-laag.php?layer_id=%2$d" data-jstree=\'{ "icon" : "fa fa-file-text icon-state-success " }\'>%1$s</li>' . PHP_EOL, $layer->title, $ml->layer);
               }
               helper::GetHierarchicalLayersForLayerEdit($map, $ml->id, $tree, $current_layer_id);
               
               if ($layer->layertype == 3) // Group, close li
               {
                   $tree .= '</li>' . PHP_EOL;
               }
           }
           $tree .= '</ul>' . PHP_EOL;
       }

   }


   
   public static function KeepInRange($d, $lower, $upper)
   {
       if ($d < $lower) { return $lower; }
       if ($d > $upper) { return $upper; }
       return $d;
   }

   public static function GetLayerScript($layer, $maplayer)
   {
       if ($layer === NULL)
       {
           return NULL;
       }
       else
       {
           switch ($layer->layertype)
           {
               case 1:
                   // Tile
                   $result = sprintf('new ol.layer.Tile({baselayer: %4$d, title: \'%1$s\', source: %2$s, opacity: %3$.2f})' . PHP_EOL, $layer->title, helper::GetSourceScript($layer->source), helper::KeepInRange($maplayer->opacity, 0, 1), $layer->baselayer);
                   break;
               case 2:
                   // Vector
                   $style = helper::GetLayerStyle($layer);
                   if ($style == null)
                   {
                       $style = "";
                   }
                   else
                   {
                       $style = sprintf("style: %s,", $style);
                   }
                   $result = sprintf('new ol.layer.Vector({baselayer: %5$d, title: \'%1$s\', source: %2$s, %3$s opacity: %4$.2f})' . PHP_EOL, $layer->title, helper::GetSourceScript($layer->source), $style, helper::KeepInRange($maplayer->opacity, 0, 1), $layer->baselayer);
                   break;
               case 3:
                   // Group
                   $result = sprintf('new ol.layer.Group({' . PHP_EOL);
                   break;
               case 4:
                   // Heatmap
                   $result = sprintf('new ol.layer.Heatmap({baselayer: %3$d, title: \'%1$s\', radius: 15, source: %2$s})' . PHP_EOL, $layer->title, helper::GetSourceScript($layer->source), $layer->baselayer);
                   break;
               default:
                   $result = sprintf('new ol.layer.Tile({baselayer: %4$d, title: \'%1$s\', source: %2$s, opacity: %3$.2f})' . PHP_EOL, $layer->title, helper::GetSourceScript($layer->source), helper::KeepInRange($maplayer->opacity, 0, 1), $layer->baselayer);
           }
           return $result;
       }
   }
   
   public static function GetOpacityPercentage($opacity)
   {
       $result = (int) ($opacity * 100);
       if ($result < 0) { $result = 0; }
       if ($result > 100) { $result = 100; }
       return $result;       
   }
   
   public static function GetLayerHTML($layer, $id, $maplayer, $parentid)
   {
       if ($layer === NULL)
       {
           return NULL;
       }
       else
       {
           $html = '';
           // Convert opacity 0..1 -> 0..100
           $opacity = helper::GetOpacityPercentage($maplayer->opacity);
           
           switch ($layer->layertype)
           {
               case 1:
               case 2:
               case 4:
                   // Tile of vector of heatmap
                   $for = ($parentid == -1)?"":sprintf('for="opacity-check%1$s"', $parentid);
                   $html .= sprintf('  <li class="mm-dropdown">' . PHP_EOL);
                   $html .= sprintf('    <input type="checkbox" id="opacity-check%1$d" %2$s class="option-checkbox" %3$s/><span class="fake-check"></span>' . PHP_EOL, $id, ($maplayer->visible == 1)?'checked':'', $for);
                   $html .= sprintf('    <a href="javascript:void(0)" class="opacity-check%1$d"><span class="mm-text">%1$s</span></a>' . PHP_EOL, $layer->title, $id);
                   $html .= sprintf('    <ul>' . PHP_EOL);
                   $html .= sprintf('      <li>' . PHP_EOL);
                   $html .= sprintf('        <div class="options-wrapper">' . PHP_EOL);
                   $html .= sprintf('          <div class="slider">' . PHP_EOL);
                   $html .= sprintf('            <input id="slide" class="opacity-slider%1$d" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="%2$d"/>' . PHP_EOL, $id, $opacity);
                   $html .= sprintf('            <span class="slider-value">%1$d%%</span>' . PHP_EOL, $opacity);
                   $html .= sprintf('          </div>' . PHP_EOL);
                   // Add legend items
                   if ($layer->legend !== NULL)
                   {
                       $legend = helper::GetLegend($layer->legend);
                       if ($legend !== NULL)
                       {
                           $html .= helper::GetLegendHTML($legend);
                       }
                   }

                   // End legend items
                   $html .= sprintf('        </div>' . PHP_EOL);
                   $html .= sprintf('      </li>' . PHP_EOL);
                   $html .= sprintf('    </ul>' . PHP_EOL);
                   $html .= sprintf('  </li>' . PHP_EOL);
                   
                   
                   
                   break;
               case 3:
                   // Group
                   $html .= '  <li class="mm-dropdown options has-sub-menu">' . PHP_EOL;
                   $html .= sprintf('    <input type="checkbox" class="option-checkbox parent" %2$s id="opacity-check%1$d"/>' . PHP_EOL, $id, ($maplayer->visible || TRUE)?'checked':'');
                   $html .= sprintf('    <a href="javascript:void(0)"><i class="fa fa-folder-open"></i><span class="mm-text">%1$s</span></a>' . PHP_EOL, $layer->title);
                   break;
           }
           return $html;
       }
   }
   
   public static function GetCMSTablesHTML($user)
   {
       $html = '<ul>' . PHP_EOL;
       $objects = helper::GetCMSTables($user);
       foreach ($objects as $key => $object) {
           $html .= sprintf('<li><a href="admin.php?table_id=%2$s">%1$s</a></li>' . PHP_EOL, $object->table_description, $object->id);
       }
       $html .= sprintf('</ul>' . PHP_EOL);
       return $html;
   }
   
   public static function GetCMSObjectHTMLTable($table)
   {
       $html = '<table border="1" class="tablesorter">' . PHP_EOL;
       $items = R::findAll($table->table_name);
       $fields = helper::GetCMSFields($table, TRUE);
       
       // First row header
       $html .= '  <thead>' . PHP_EOL;
       $html .= sprintf('    <tr>' . PHP_EOL);
       foreach ($fields as $key => $field)
       {
           $html .= sprintf('      <td>%s</td>' . PHP_EOL, $field->field_name);
       }
       $html .= sprintf('    </tr>' . PHP_EOL);
       $html .= '  </thead>' . PHP_EOL;
       
       // Now the data rows
       foreach ($items as $key => $item) {
           $html .= '  <tbody>' . PHP_EOL;
           $html .= sprintf('    <tr>' . PHP_EOL);
           foreach($fields as $keyf => $field)
           {
               $html .= sprintf('      <td>%s</td>' . PHP_EOL, helper::GetCMSFieldContent($item, $field));
           }
       }
       $html .= '  <tbody>' . PHP_EOL;
       $html .= sprintf('    <tr>' . PHP_EOL);
       $html .= sprintf('</table>' . PHP_EOL);
       return $html;
   }
   
   public static function GetCMSFieldContent($item, $field)
   {
       switch ($field->field_type)
       {
           // Text field
           case 1:
               return $item->{$field->field_name};
           // Lookup value
           case 2:
               return helper::GetLookupValue($field->lookup_table, $field->lookup_field, $item->{$field->field_name});
           default:
               return $item->{$field->field_name};
       }
   }
   
   public static function GetLookupValue($table_name, $field_name, $id)
   {
       $item = R::load($table_name, $id);
       return $item->{$field_name};
   }

   public static function GetCMSFields($table, $for_grid = FALSE)
   {
       if ($for_grid)
       {
        $sql = sprintf('SELECT * FROM cms_fields
                         WHERE `table` = %d
                         AND grid_field = 1
                         ORDER BY field_order', $table->id);
       }
       else
       {
        $sql = sprintf('SELECT * FROM cms_fields
                         WHERE table = %d
                         ORDER BY field_order', $table->id);
       }
       $rows = R::getAll($sql);
       $items = R::convertToBeans(CC::LEGENDITEMS, $rows);
       return $items;    
   }

   public static function GetLegendHTML($legend)
   {
       $html = '';
       $legenditems = helper::GetLegendItems($legend);
       foreach ($legenditems as $key => $legenditem) {
           $html .= sprintf('        <div class="description">' . PHP_EOL);
           $symbol = helper::GetSymbol($legenditem->symbol);
           if ($legenditem->symbol == 0)
           {
               $image = '';
           }
           else
           {
               $image = sprintf('<img src="%1$s" height="25px">', $symbol->image);
           }
           $html .= sprintf('          %1$s<p>%2$s</p>' . PHP_EOL, $image, $legenditem->description);
           $html .= sprintf('        </div>' . PHP_EOL);
       }
       return $html;
   }

   public static function GetSourceScript($source_id)
   {
       $source = R::load(CC::SOURCES, $source_id);
       if ($source === NULL)
       {
           return NULL;
       }
       else
       {
           // First try url, if empty use filename
           if (trim($source->url) === '')
           {
               $url = sprintf("'%s'", $source->filename);
           }
           else {
               $url = sprintf("'%s'", $source->url);
           }
           
           $attribution = sprintf("[new ol.Attribution({html: '%s'})]", $source->attribution);
           if ($source->code == '')
           {
               return 'null';
           }
           else
           {
                return sprintf($source->code, $url, $attribution);
           }
       }
   }
   
   public static function GetCMSTable($table_id)
   {
       $table = R::load(CC::CMS_TABLES, $table_id);
       if ($table === NULL)
       {
           return NULL;
       }
       else
       {
           return $table;
       }     
   }
   
   public static function GetCMSField($field_id)
   {
       $field = R::load(CC::CMS_FIELDS, $field_id);
       return $field;
   }
   
   public static function GetProject($project_id)
   {
       $project = R::load(CC::PROJECTS, $project_id);
       return $project;
   }
   
   public static function GetSymbol($symbol_id)
   {
       $symbol = R::load(CC::SYMBOLS, $symbol_id);
       return $symbol;
   }

   public static function GetSource($source_id)
   {
       $source = R::load(CC::SOURCES, $source_id);
       return $source;
   }

   public static function GetLegend($legend_id)
   {
       $legend = R::load(CC::LEGENDS, $legend_id);
       return $legend;
   }
   
   public static function GetMapLayer($maplayer_id)
   {
       $maplayer = R::load(CC::MAPLAYERS, $maplayer_id);
       return $maplayer;
   }
   
   public static function GetMapLayerByMapIdAndLayerId($map_id, $layer_id)
   {
       $maplayer = R::findOne(CC::MAPLAYERS, 'map = ? AND layer = ?', array($map_id, $layer_id));
       return $maplayer;
   }

   public static function GetLegendItem($legenditem_id)
   {
       $legenditem = R::load(CC::LEGENDITEMS, $legenditem_id);
       return $legenditem;
   }

   public static function GetLegendItems($legend)
   {
       $sql = sprintf('SELECT * FROM legenditems
                        WHERE legend = %d
                        ORDER BY legendorder', $legend->id);
       $rows = R::getAll($sql);
       $legenditems = R::convertToBeans(CC::LEGENDITEMS, $rows);
       return $legenditems;    
   }
   
   public static function GetDatapoints($identifier, $varname)
   {
       $sql = sprintf('
            SELECT * FROM mppng_cartotool.datapoints dp
            left join mppng_cartotool.data d on dp.id = d.datapoint
            where dp.identifier = \'%1$s\'
            and d.varname = \'%2$s\'', $identifier, $varname);
       $rows = R::getAll($sql);
       $datapoints = R::convertToBeans(CC::DATAPOINTS, $rows);
       return $datapoints;
   }

   public static function GetDefaultExtent($project)
   {
       if ($project->show_extent == 0)
       {
           // Geen default extent tonen
           return NULL;
       }
       else
       {
           return sprintf('new ol.control.ZoomToExtent({extent: ol.extent.applyTransform([%f, %f, %f, %f], ol.proj.getTransform("EPSG:4326", "EPSG:3857"))})', $project->default_extent_lon_min, $project->default_extent_lat_min, $project->default_extent_lon_max, $project->default_extent_lat_max);
       }
   }
   
   public static function GetScaleLine($project)
   {
       if ($project->show_scaleline == 0)
       {
           return NULL;
       }
       else
       {
           return sprintf('new ol.control.ScaleLine()');
       }
   }
   
   public static function GetLayerStyle($layer)
   {
       if ($layer->layertype != 2 || $layer->style === NULL)
       {
           return NULL;
       }
       else
       {
           return helper::GetStyle($layer->style)->style;
       }
   }
   
   public static function GetStyle($style_id)
   {
       $style = R::load(CC::STYLES, $style_id);
       if ($style === NULL)
       {
           return NULL;
       }
       else
       {
           return $style;
       }       
   }
   
   public static function GetLayerTypeById($layertype_id)
   {
       $layertype = R::load(CC::LAYERTYPES, $layertype_id);
       if ($layertype === NULL)
       {
           return NULL;
       }
       else
       {
           return $layertype;
       }
   }
   
   public static function GetLayerTypes()
   {
       $layertypes = R::findAll(CC::LAYERTYPES);  
       return $layertypes;
   }

   public static function boolVal($boolValue)
   {
       return $boolValue ? 'true' : 'false';
   }
   
}
