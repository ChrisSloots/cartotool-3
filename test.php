<pre> 
<textarea style="width: 100%; height: 900px;">
<?php
  require 'dbconnection.php';



//// Set project_id
//$project_id = 1;
//$project = helper::GetProject($project_id);
//
//echo $project;

  $user = $_SESSION["user"];
echo $user;
$custID = helper::GetCustomer();
echo $custID;

  
//$map = helper::GetMap($project->map);

//$maplayers = helper::HierarchicalLayerStructure($map, NULL, $layertree, $layers); 
//echo $layertree;




//$hash = helper::EncryptPassword("test");
//echo $hash;
?>
</textarea>
</pre>