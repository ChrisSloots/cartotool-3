<?php
require_once '../dbconnection.php';

$dashboard_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
$shape_id = filter_input(INPUT_GET, 'shape_id', FILTER_SANITIZE_URL);;
//echo "<pre>";
//echo date("h:i:s") . PHP_EOL;
//echo "Dashboard Test!" . PHP_EOL;
//
//echo dashboard::Version();

//$dashboards = dashboard::GetDashboards(2);

//print_r($dashboards);

//$var = dashboard::GetVar(2);
//print_r($var);
//
//$vars = dashboard::GetVars(1);
//print_r($vars);
//
//$col = dashboard::GetCol(2);
//print_r($col);

//$cols = dashboard::GetCols(1);
//print_r($cols);

//$user = 2; // spring-co

//$data = dashboard::GetData(1, 101);
//print_r($data);

//$res = dashboard::GetVarLevel(1,3);
//print_r($res);
//echo '<hr>';
//$tree = dashboard::GetCompleteTree(1);
//echo $tree;

//$treenew = dashboard::GetCompleteTree2(2, null, 204120);
//print_r($treenew);
//exit;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Bootstrap core CSS -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/jquery.treegrid.js"></script>
        <script type="text/javascript" src="js/jquery.treegrid.bootstrap3.js"></script>
        <link rel="stylesheet" href="css/jquery.treegrid.css">
        
        <link rel="stylesheet" href="css/treeview.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
      <div class="container-fluid">
        <div class="row">
          <div id="left" class="col-sm-3">
              <?php
                $tree = dashboard::GetCompleteTree2($dashboard_id, null, $shape_id);
                echo $tree;
              ?>
          </div>
    <div id="right" class="col-sm-9">
        Rechts
    </div>
  </div>
  </div>

  <!-- Placed at the end of the document so the pages load faster -->
        
  <!-- Bootstrap core JavaScript
  ================================================== -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBA0Ib0EntWXS2jIRWLPCVfPnqZ_9qgW90"></script>
  <script src="https://www.cartotool.nl/v2/dashboard/js/d3.v4.min.js"></script>
  <script src="https://www.cartotool.nl/v2/dashboard/js/dimple.v2.3.0.min.js"></script>
  <!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript">

      $.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed({openedClass:'glyphicon-chevron-down', closedClass:'glyphicon-chevron-right'});

$('#tree1 .branch').each(function(){

var icon = $(this).children('i:first');
icon.toggleClass('glyphicon-chevron-down glyphicon-chevron-right');
//$(this).children().children().toggle();

});
      
      function activateFirstLink()
      {
          var link = $('#left').find('a.mppng_link:first').trigger('click');
          //alert(link[0].href);
      }

//      $(document).ready(function() {
//          //$('.tree').treegrid({initialState: 'collapsed'});
//          $('.tree-2').treegrid();
//      });
      
      $(function() {
        $('.mppng_link').click(function() {
            //$('#right').html('<object data="http://www.nos.nl/">'); // useful for crossdomain data
            $('#right').load(this.href);

            // it's important to return false from the click
            // handler in order to cancel the default action
            // of the link which is to redirect to the url and
            // execute the AJAX request
            return false;
        });
        
        activateFirstLink();
    });
  </script>
  </body>
</html>
