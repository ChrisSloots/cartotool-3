<!DOCTYPE html>
<html>
<head>
<title>Simple example</title>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.5.0/ol.css" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.5.0/ol.js"></script>

</head>
<body>
<div class="container-fluid">

<div class="row-fluid">
  <div class="span12">
    <div id="map" class="map"></div>
  </div>
</div>

</div>
<script>
var map = new ol.Map({
  layers: [
    new ol.layer.Tile({
      source: new ol.source.OSM()
    })
    , new ol.layer.Vector({
        source: new ol.source.Vector({
        url: 'http://openlayers.org/en/v3.5.0/examples/data/geojson/countries.geojson',
        format: new ol.format.GeoJSON()
    }),
  style: function(feature, resolution) {
    return new ol.style.Style({
  fill: new ol.style.Fill({
    color: 'rgba(255, 0, 255, 0.6)'
  })});
  }
})
  ],
  controls: ol.control.defaults({
    attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
      collapsible: false
    })
  }),
  target: 'map',
  view: new ol.View({
    center: [0, 0],
    zoom: 2
  })
});

</script>
</body>
</html>