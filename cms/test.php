<html>
    <head>
        
    </head>
    <body>
        Tekst
         <!-- Javascript files -->
        <!-- jQuery -->
        <script src="js/jquery-1.11.3.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/ui-nestable.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/jstree.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/iscroll.js"></script>
        <script src="js/jquery.multi-select.js"></script>
        <script src="js/main.js"></script>
        <script src="js/jquery.nestable.js"></script>
    </body>
</html>
<?php
require '../dbconnection.php';

echo '<pre>';



$map_id = 7;
$map = helper::GetMap($map_id);

$tree = '';
helper::GetHierarchicalLayersForCMS($map, null, $tree);

echo "Tree\r\n" ;
echo $tree;


echo "Wie<br>";
 echo exec('whoami');
?>
