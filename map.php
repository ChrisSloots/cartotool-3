<?php
// Include the RedBean framework
require 'redbean/rb.php';

// Setup database connection
R::setup( 'mysql:host=localhost;dbname=cartotool', 'root', '' ); 

// Toggle debug
//R::debug(TRUE);
//
// Freeze the model in production
R::freeze(TRUE);

// Autoload classes
function __autoload($class_name) {
    $filename = sprintf('classes/%s.php', $class_name);
    if (file_exists($filename))
    include $filename;
}

// Set project_id
$project_id = 1;
$project = helper::GetProject($project_id);

?>
<!DOCTYPE html>
<html>
<head>
<title>CartoTool</title>
<script src="js/jquery/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
<script src="js/bootstrap/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/ol3/ol.css" type="text/css">
<script src="js/ol3/ol.js"></script>
<style>
#layertree li > span {
  cursor: pointer;
}
</style>
</head>
<body>
<div class="container-fluid">

<div class="row-fluid">
  <div class="span8">
    <div id="map" class="map"></div>
  </div>
  <div id="layertree" class="span4">
    <?php
        helper::HierarchicalLayerStructure(3, NULL, $layertree, $layers);
        echo $layertree;
    ?>
  </div>
</div>

</div>
<script>

var map = new ol.Map({
  <?php echo $layers; ?>,
  controls: ol.control.defaults({
      attribution: <?php echo helper::boolVal($project->show_attribution == 1); ?>
  }).extend([<?php echo helper::GetDefaultExtent($project) ?>]).extend([<?php echo helper::GetScaleLine($project); ?>]),
  target: 'map',
  view: new ol.View({
    projection: 'EPSG:3857',
    center: ol.proj.fromLonLat([4.872023, 52.379436]),
    zoom: 14,
    rotation: 0 //Math.PI / 2
  })
});

// Bind input function
function bindInputs(layerid, layer) {
  var visibilityInput = $(layerid + ' input.visible:first');
  visibilityInput.on('change', function() {
    layer.setVisible(this.checked);
  });
  visibilityInput.prop('checked', layer.getVisible());

  $.each(['opacity'],
      function(i, v) {
        var input = $(layerid + ' input.' + v + ':first');
        input.on('input change', function() {
          layer.set(v, parseFloat(this.value));
        });
        input.val(String(layer.get(v)));
      }
  );
}

function travers(layers) {
    layers.forEach(function (lyr) {
        bindInputs('#layer' + idx, lyr);
        idx++;
        // If group search deeper
        if (lyr.getLayers) {
            travers(lyr.getLayers());
        }        
});

}

// Global var idx for unique name
var idx = 0;
travers(map.getLayers());

// Hide all fieldsets and toggle them on click
$('#layertree li > span').click(function() {
  $(this).siblings('fieldset').slideToggle();
}).siblings('fieldset').hide();


</script>
</body>
</html>
