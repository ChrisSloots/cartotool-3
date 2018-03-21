<?php
require_once '../../redbean/rb.php';
require_once '../../classes/cc.php';

class import {

    const VERSION = '1';
    
    
   /**
    * Return versdion number ofthis class
    */
   public static function Version()
   {
       return self::VERSION;
   }
   
   public static function ConnectDB($dsn, $user, $pwd)
   {
       R::setup($dsn, $user, $pwd);
   }
   
   public static function IsConnected()
   {
       return R::testConnection();
   }
   
   private static function isValidElement($value)
   {
       $aItems = array('project', 'map', 'layer', 'source', 'style', 'group', 'legend');
       return in_array(strtolower($value), $aItems, TRUE);
   }
   
   private static function InsertElement($elem)
   {
       switch (strtolower($elem->nodeName))
       {
           case 'project':
               echo 'Maak project'. '<br>';
               $item = R::dispense( CC::PROJECTS );
               $item->name = 'Import naam';
               $id = R::store( $item );
               break;
           case 'map':
               echo 'Maak map'. '<br>';
               break;
       }
   }

   private static function Search($elem)
   {
       foreach ($elem->childNodes AS $item) {
            if ($item->hasChildNodes())
            {
                //echo "Kids";
                self::Search($item);
            }
            if ($item->nodeType == XML_ELEMENT_NODE && self::isValidElement($item->nodeName))
            {
                self::InsertElement($item);
            }
       }
   }

      public static function ImportXML($filename)
   {
       try {
           if (!file_exists($filename))
           {
               throw new Exception('File not found.');
           }
           // Load the file
           $xmlDoc = new DOMDocument();
           $xmlDoc->load($filename);
           
           // Depth first search
           $elem = $xmlDoc->documentElement;
           //print_r($elem->hasChildNodes());
           //$elem->nodeType == 
           self::Search($elem);
           //print_r($xmlDoc);
           
           // Everything went fine
           return TRUE;
       } catch (Exception $exc) {
           //echo $exc->getMessage();
           return FALSE;
       }
   }
}