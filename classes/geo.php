<?php
require_once '../redbean/rb.php';

class geo {

    const VERSION = '1.0';
    
    
   /**
    * Return versdion number ofthis class
    */
   public static function Version()
   {
       return self::VERSION;
   }
   
   /**
    * 
    * @return type
    */
   public static function ConnectDB($dsn, $user, $pwd)
   {
       R::setup($dsn, $user, $pwd);
   }
   
   public static function IsConnected()
   {
       return R::testConnection();
   }
   
   public static function GetObject($type, $id)
   {
       $obj = R::load($type, $id ); //reloads our object
       return $obj;
   }
   
   /**
    * 
    * @param type $type
    * @param type $id
    * @return type
    */
   public static function GetGeoJSON($type, $id)
   {
       $sql = 'SELECT row_to_json(fc)
                 FROM ( SELECT \'FeatureCollection\' As type, array_to_json(array_agg(f)) As features
                 FROM (SELECT \'Feature\' As type
                , ST_AsGeoJSON(lg.geometry)::json As geometry
                , row_to_json((id, naam, title, content)) As properties
                FROM "Vlakken-wgs" As lg   ) As f )  As fc;';
       
       //echo $sql;
       //echo '<hr>';
       $geojson = R::getRow($sql);
       return $geojson['row_to_json'];
   }
   

}

