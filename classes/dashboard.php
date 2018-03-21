<?php

require_once '../redbean/rb.php';
/**
 * Description of dashboard
 *
 * @author Chris
 */
class dashboard {
    const VERSION = '1.0';
    // Table names
    const DASHBOARDS = 'dashboards';
    const VARS = 'dashboard_vars';
    const COLS = 'dashboard_cols';
    const DATA = 'dashboard_data';
    const VARTYPE = 'dashboard_var_types';
    
    const MSG_NO_DATA = 'Geen gegevens beschikbaar.';
    
   /**
    * Return versdion number ofthis class
    */
   public static function Version()
   {
       return self::VERSION;
   }

   public static function GetDashboard($id)
   {
       $obj = R::load(self::DASHBOARDS, $id);
       return $obj;
   }
   
   public static function GetDashboards($id)
   {
       $objs = R::findAll(self::DASHBOARDS, 'dashboard_customer = ?', array($id));
       return $objs;
   }

   public static function GetVar($id)
   {
       $obj = R::load(self::VARS, $id);
       return $obj;
   }
   
   public static function GetVars($id)
   {
       $objs = R::findAll(self::VARS, 'dashboard = ?', array($id));
       return $objs;
   }

   public static function GetCol($id)
   {
       $obj = R::load(self::COLS, $id);
       return $obj;
   }
   
   public static function GetCols($id)
   {
       $objs = R::findAll(self::COLS, 'var = ? order by col_order', array($id));
       return $objs;
   }
   
   public static function GetVarType($id)
   {
       $obj = R::load(self::VARTYPE, $id);
       return $obj;
   }
   
   public static function GetVarTypes($id)
   {
       $objs = R::findAll(self::VARTYPE);
       return $objs;
   }
   
   public static function GetData($var_id = 0, $record_id = 0)
   {
       $sql = sprintf('
select
	v.*, c.*, d.*
from
	dashboard_vars v
join
	dashboard_cols c
on
	c.var = v.id
join
	dashboard_data d
on
	d.col = c.id and d.record_id = %2$d
where
	v.id = %1$d
order by
	col_order asc', $var_id, $record_id);
       //echo $sql;
       $rows = R::getAll($sql);
       $data = R::convertToBeans(self::DATA, $rows);
       return $data;
   }
   
   public static function GetVarLevel($dashboard_id, $parent_var = null, $show_hidden = false)
   {
       if ($parent_var == null)
       {
           $vars = R::findAll(self::VARS, 'dashboard = ? and parent_var is null and hide = ? order by var_order', array($dashboard_id, $show_hidden));
       }
       else
       {
           $vars = R::findAll(self::VARS, 'dashboard = ? and parent_var = ? and hide = ? order by var_order', array($dashboard_id, $parent_var, $show_hidden));
       }
       return $vars;
   }


   public static function GetVarTreeHTML($dashboard_id, $shape_id, $parent_var = null, $level = 0)
   {
       $html = '';
       $items = dashboard::GetVarLevel($dashboard_id, $parent_var, $level);
       foreach ($items as $value) {
           if ($value->parent_var == null)
           {
               $parent_class = '';
           }
           else
           {
               $parent_class = sprintf(' treegrid-parent-%d', $value->parent_var);
           }
           $html .= sprintf('       <tr class="treegrid-%d%s">' . PHP_EOL, $value->id, $parent_class);
           if ($value->var_type == 1) // Group
           {
               $html .= sprintf('           <td>%s</td>' . PHP_EOL, $value->var_name);
           }
           else
           {
               $html .= sprintf('           <td><a href="detail.php?id=%2$d&shape_id=%3$d" class="mppng_link">%1$s</a></td>' . PHP_EOL, $value->var_name, $value->id, $shape_id);
           }
           $html .= '       </tr>' . PHP_EOL;
           $html .= dashboard::GetVarTreeHTML($dashboard_id, $shape_id, $value->id, $level+1);
       }
       
       return $html;
   }
   
   public static function GetCompleteTree($dashboard_id, $shape_id)
   {
       $html = '<table class="table tree-2">' . PHP_EOL;
       $html .= '    <tbody>' . PHP_EOL;
       $html .= dashboard::GetVarTreeHTML($dashboard_id, $shape_id);
       $html .= '   </tbody>' . PHP_EOL;
       $html .= '</table>' . PHP_EOL;
       return $html;
   }
   
   public static function GetVarTreeHTML2($dashboard_id, $shape_id, $parent_var = null, $level = 0)
   {
       $html = '';
       $items = dashboard::GetVarLevel($dashboard_id, $parent_var, $level);
       foreach ($items as $value) {
           $html .= sprintf('       <li>' . PHP_EOL, $value->id);
           if ($value->var_type == 1) // Group
           {
               $html .= sprintf('           <p>%s</p>' . PHP_EOL, $value->var_name);
           }
           else
           {
               $html .= sprintf('           <li><a href="detail.php?id=%2$d&shape_id=%3$d" class="mppng_link">%1$s</a></li>' . PHP_EOL, $value->var_name, $value->id, $shape_id);
           }
           $html .= '       </li>' . PHP_EOL;
           $html .= dashboard::GetVarTreeHTML($dashboard_id, $shape_id, $value->id, $level+1);
       }
       
       return $html;
   }
   
   public static function GetCompleteTree2($dashboard_id, $parent_var = null, $shape_id, $level = 0)
   {
       if ($level == 0)
       {
           $html = '<ul id="tree1">' . PHP_EOL;
       }
       else
       {
           $html = '<ul>' . PHP_EOL;
       }
       $items = dashboard::GetVarLevel($dashboard_id, $parent_var);
       foreach ($items as $value) {
           if ($value->var_type == 1) // Group
           {
               // New group
               $html .= sprintf("  <li><p>%s</p>" . PHP_EOL, $value->var_name);
               // Recurse               
               $level++;
               $html .= dashboard::GetCompleteTree2($dashboard_id, $value->id, $shape_id, $level);
               // End of group
               $html .= sprintf("  </li>" . PHP_EOL);
           }
           else
           {
               $html .= sprintf('  <li><a href="detail.php?dashboard_id=%4$d&id=%2$d&shape_id=%3$d" class="mppng_link">%1$s</a></li>' . PHP_EOL, $value->var_name, $value->id, $shape_id, $dashboard_id);
           }
       }
       $html .= '</ul>' . PHP_EOL;
       return $html;
   }
   
   public static function GetDataForChart($data)
   {
       //echo '<pre>';print_r($data);
       $result = '';
       // Keep track of last key
       end($data);
       $last = key($data);
       
       // Now loop
       foreach($data as $key => $value)
       {
           $label_for_column = ($value->col_label != "")?$value->col_label:$value->col_name;
           $result .= sprintf('{"%1$s":"%2$s", "%3$s":%4$s, "order":%5$s}', $value->var_name, $label_for_column, $value->var_value_description, $value->value, $value->col_order);
           
           // Add comma for all except the last
           if ($key !== $last)
           {
               $result .= ",";
           }
       }
       return $result;
   }
   
   public static function GetDataForGroupedBarChart($data)
   {
       //echo '<pre>';
       //print_r($data);
       
       $result = '';
       // Keep track of last key
       end($data);
       $last = key($data);
       
       reset($data);
       foreach ($data as $key => $value) {
           $result .= sprintf('{"%s":%s, "%s":"%s", "order": %s, "group":"%s", "grp-order":"%s"}', $value->var_name, $value->value, "cat", $value->col_label, $value->col_order, $value->group, $value->grp_order);

           // Add comma for all except the last
           if ($key !== $last)
           {
               $result .= ",";
           }
       }
       //$result = '{"Gebruik app":"97", "groep":"complex"},';
       //$result .= '{"Gebruik app":"74", "groep":"nl"},';
//       $result = '{"geslacht":"man","Gemiddelde leeftijd":"97", "groep":"complex"},';
//       $result .= '{"geslacht":"man","Gemiddelde leeftijd":"74", "groep":"nl"},';
       //$result .= '{"geslacht":"vrouw","Gemiddelde leeftijd":"79", "groep":"complex"},';
       //$result .= '{"geslacht":"vrouw","Gemiddelde leeftijd":"89", "groep":"nl"}';
       return $result;
   }
   
   public static function AllValuesZero($data)
   {
       $counter = 0;
       $result = false;
       //echo "<prE>";
       //print_r($data);
       foreach ($data as $value) {
           //print_r($value->value);
           if ($value->value == "0")
           {
               $counter++;
           }
       }
       if ($counter == count($data) && $counter > 1)
       {
           $result = true;
       }
       return $result;
   }
}

