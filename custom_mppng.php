<?php
    require 'dbconnection.php';
    require 'session.php';
    
    $project_id = helper::FetchParam('id', NULL);
    
    // Check if user may see this project
    if (helper::IsAuthorized($user, $project_id))
    {
        $project = helper::GetProject($project_id);
        $map = helper::GetMap($project->map);
    }
    else
    {
        include 'logout.php';
        header('Location: index.php');
    }
    
?>

var map;

function initMap(){
/**
 * Elements that make up the popup.
 */
	var container = document.getElementById('popup');
	var content = document.getElementById('popup-content');
	var closer = document.getElementById('popup-closer');

	/**
	 * Create an overlay to anchor the popup to the map.
	 */
	var overlay = new ol.Overlay(/** @type {olx.OverlayOptions} */ ({
	  element: container,
	  autoPan: true,
	  animation: false
	}));


	/**
	 * Create the map.
	 */
	map = new ol.Map({
                  <?php
                    $overviewmap = helper::GetMap($project->overviewmap);
                    if ($overviewmap === NULL)
                    {
                        $overviewmapLayers = '';
                    }
                    else
                    {
                        helper::HierarchicalLayerStructure($overviewmap, NULL, $overviewmapLayertree, $overviewmapLayers);
                        $overviewmapLayers = ', ' . $overviewmapLayers;
                    }
                    helper::HierarchicalLayerStructure($map, NULL, $layertree, $layers);
                    echo $layers;
                  ?>,
		  overlays: [overlay],
		  controls: ol.control.defaults().extend([ 
                    new ol.control.OverviewMap({collapsible:false <?php echo $overviewmapLayers; ?>})
                    <?php if ($project->show_scalebar == 1) { ?>
                    , new ol.control.ScaleLine({units: 'metric'})
                    <?php } ?>
                  ]),
		  target: 'map',
		  view: new ol.View({
			center: ol.proj.fromLonLat([<?php echo $project->longitude; ?>, <?php echo $project->latitude; ?>]),
			zoom: <?php echo $project->zoom; ?>,
                        rotation: <?php echo deg2rad($project->rotation); ?>
                        <?php if ($project->use_maxextent == 1) { ?>
                        , extent: ol.proj.transformExtent([<?php printf('%f,%f,%f,%f', $project->maxextent_min_x, $project->maxextent_min_y, $project->maxextent_max_x, $project->maxextent_max_y); ?>], 'EPSG:4326', 'EPSG:3857')
                        <?php } ?>
                        <?php if ($project->use_zoom_restriction == 1) { ?>
                        , minZoom: <?php printf('%d', $project->min_zoom); ?>
                        , maxZoom: <?php printf('%d', $project->max_zoom); ?>
                        <?php } ?>
		  })
		});
                
                
        map.getView().on('propertychange', function(e) {
           switch (e.key) {
              case 'resolution':
                console.log(map.getView().getZoom());
                break;
           }
        });
        
        // change mouse cursor when over marker
        map.on('pointermove', function(e) {
            if (e.dragging) {
                $(container).popover('destroy');
                return;
            }
            var pixel = map.getEventPixel(e.originalEvent);
            var hit = map.hasFeatureAtPixel(pixel);
            $('#map').css('cursor', hit ? 'pointer' : '');
        });
        
        // display popup on click
        map.on('singleclick', function(evt) {
          if (evt.originalEvent.ctrlKey) 
          {
            // Open
            coordinates = evt.coordinate;
            var coord3857 = ol.proj.transform(coordinates, 'EPSG:3857', 'EPSG:4326');
            mppng_open_streetview(coord3857[0], coord3857[1]);
            //addMarker(coordinates);
          }
          else
          {
            var feature = map.forEachFeatureAtPixel(evt.pixel,
                function(feature, layer) {
                  return feature;
                });
            if (feature) {
              var geometry = feature.getGeometry();
              // Fetch coordinate. It depends on the geometry type
              var coord = getCentroid(geometry);
              var title = feature.get('title');
              var html = feature.get('content');
              var url = feature.get('url');
              var shape_id = feature.get('shape_id');
              if (shape_id != null)
              {
                url = url + '&shape_id=' + shape_id;
              }
              //var url = 'http://monkey-lab.net/context-new/content/1.html';
              // Do nothing in case of no data
              if (title != null && url != null)
              {
                  mppng_open(title, url);
                  //setContent(title, html);
                  //overlay.setPosition(coord);
                  //$(container).popover({
                  //  'placement': 'center',
                  //  'html': true //,
                  //});
                  //$(container).popover('show');
              }
              else if (title != null)
              {
                mppng_open_simple(title, html);
              }
            } else {
              //$(container).popover('destroy');
            }
          }
        });
        
//        function setContent(title, html){
//            $("#popup #popover-title").html(title);
//            content.innerHTML = html;
//        }
        
        function getCentroid(geometry)
        {
            var coord;
            var type = geometry.getType();
            switch (type)
            {
                case 'Polygon':
                    coord = geometry.getInteriorPoint().getFirstCoordinate();
                    break;
                default:
                    coord = geometry.getFirstCoordinate();
                    break;
            }
            return coord;
        }

        function addMarker(coord)
        {
            var pointFeature = new ol.Feature({ });
            var point_geom = new ol.geom.Point(coord);
            pointFeature.setGeometry(point_geom);
            
            var image = new ol.style.Circle({
                radius: 10,
                fill: new ol.style.Fill({
                    color: 'rgba(0, 0, 255, 0.5)'
                }),
                stroke: new ol.style.Stroke({color: 'rgba(0, 0, 255, 0.8)', width: 1})
              });
            
            var pointStyle = new ol.style.Style({
                image: image
            });

          pointFeature.setStyle(pointStyle);
          
          // TODO Als source al bestaat, gebruik die, anders toevoegen

          var vectorSource = new ol.source.Vector({
            features: [pointFeature]
          });
          
          var pointLayer = new ol.layer.Vector({
            source: vectorSource
          });

          map.addLayer(pointLayer);
          var layers = map.getLayers();
           // alert(layers);
        }



}
