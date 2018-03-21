<style>
    #map {
        height: 95%;
        min-height: 200px;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBA0Ib0EntWXS2jIRWLPCVfPnqZ_9qgW90">
</script>
    <div id="map"></div>
<script>

<?php
    $lat = filter_input(INPUT_GET, 'lat', FILTER_SANITIZE_URL);
    $lon = filter_input(INPUT_GET, 'lon', FILTER_SANITIZE_URL);
    printf('var clickedLocation = new google.maps.LatLng(%.18f, %.18f)', $lat, $lon);
?>
    

function initialize() {
    
var panorama;  

    
    panorama = new google.maps.StreetViewPanorama(
        document.getElementById('map'),
        {

          position: clickedLocation,
          pov: {heading: 0, pitch: 0},
          streetViewControl: false,
          motionTracking: false,
          motionTrackingControl: false,
          addressControl: false
        });
}

initialize();
</script>
