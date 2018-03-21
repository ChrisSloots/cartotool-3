<?php
class CategoryIsFilter {
        private $num;

        function __construct($num) {
                $this->num = $num;
        }

        function isCategory($i) {
                return $i->CategoryId == $this->num;
        }
}

class impacthelper {
    const KEY = 'fdb778c0-fd58-49d2-87c5-54327006a59f';
    //const URL_BASE = 'https://cyber.apsdotnet.nl/impactclient.test.applicatie/api/cartotool/';
    const URL_BASE = 'https://cyber.apsdotnet.nl/impact.cyber/api/cartotool/';
    const COMMAND_PROJECTS = 'selectprojects';
    const COMMAND_SCENARIOS = 'selectscenarios';
    const COMMAND_SCENARIO = 'scenario';
    
    public static function Test()
    {
        return "Dit werkt";
    }

    public static function GetProjects()
    {
        $url = self::URL_BASE . self::COMMAND_PROJECTS . '?key=' . self::KEY;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        return $obj;
    }

    public static function GetScenarios($projectid)
    {
        $url = self::URL_BASE . self::COMMAND_SCENARIOS . '?key=' . self::KEY . '&projectid=' . $projectid;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        return $obj;
    }

    public static function GetScenario($scenarioid)
    {
        $url = self::URL_BASE . self::COMMAND_SCENARIO . '?key=' . self::KEY . '&id=' . $scenarioid;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        return $obj;
    }
    
    
    
    public static function GetScenarioQualities($scenarioid, $categoryid)
    {
        $scenario = impacthelper::GetScenario($scenarioid);
        $scenarioQualities = $scenario->ScenarioQualities;
        $filtered = array_filter($scenarioQualities, array(new CategoryIsFilter($categoryid), 'isCategory'));
        return $filtered;
    }

    public static function SetAttribute($geojson, $keyname, $keyvalue, $attributename, $attributevalue)
    {
        foreach($geojson->features as $value)
        {
            $properties = $value->properties;
            if ($properties->$keyname == $keyvalue)
            {
                $properties->$attributename = $attributevalue;
                return TRUE;
            }
        }
        return FALSE;
    }
    
    public static function GetPhotos($categoryId, $baseUrl)
    {
        $result = array();
        switch ($categoryId)
        {
            case 90433:
                $cat = "groen";
                break;
            case 90488:
                $cat = "verharding";
                break;
            case 90379:
                $cat = "meubilair";
                break;
            case 90369:
                $cat = "vuil";
                break;
            default:
                $cat = "onbekend";
        }
        $result["A"] = sprintf("%s/%s-a.png", $baseUrl, $cat);
        $result["B"] = sprintf("%s/%s-b.png", $baseUrl, $cat);
        $result["C"] = sprintf("%s/%s-c.png", $baseUrl, $cat);
        $result["D"] = sprintf("%s/%s-d.png", $baseUrl, $cat);
        
        return $result;
    }

    public static function MergeScenarioQualities($jsonobj, $scenarioqualities, $photos)
    {
        foreach($scenarioqualities as $quality)
        {
            //print_r($quality->Name);
            impacthelper::SetAttribute($jsonobj, "areaid", $quality->AreaId, "kwaliteit", $quality->Name);
            $photo = $photos[$quality->Name];
//            if (!file_exists($photo))
//            {
//                $photo = './impact/photos/missing.png';
//            }
            impacthelper::SetAttribute($jsonobj, "areaid", $quality->AreaId, "content", sprintf('Kwaliteit: %s<br><img height="150px" src="%s">', $quality->Name, $photo));
        }
        return json_encode($jsonobj);
    }
}
