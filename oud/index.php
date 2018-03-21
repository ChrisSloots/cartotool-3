<!DOCTYPE html>
<html>
<head>
<title>CartoTool</title>
<script src="js/jquery/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
<script src="js/bootstrap/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/ol3/ol.css" type="text/css">
<script src="js/ol3/ol.js"></script>

</head>
<body>
<div class="container-fluid">

<div class="row-fluid">
  <div class="span8">
    <div id="map" class="map"></div>
  </div>
  <div id="layertree" class="span4">
    
  </div>
</div>

</div>
<script>
var attribution = new ol.control.Attribution({
    collapsible: true,
    label: 'A',
    collapsed: true,
    tipLabel: 'yooo'
});

var map = new ol.Map({
  layers: [
    new ol.layer.Tile({
      source: new ol.source.OSM()
    })
  ],
  controls: ol.control.defaults({
      attribution: false
  }).extend([
    new ol.control.ZoomToExtent({
      extent: [
        813079.7791264898, 5929220.284081122,
        848966.9639063801, 5936863.986909639
      ]
    })
  ], [attribution]),
  target: 'map',
  view: new ol.View({
    projection: 'EPSG:3857',
    center: ol.proj.fromLonLat([4.872023, 52.379436]),
    zoom: 14,
    rotation: 0 //Math.PI / 2
  })
});

</script>
</body>
</html>