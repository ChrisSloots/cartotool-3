<?php
include('detail_header.php');
//echo '<pre>';
reset($data);
$address = current($data)->value;

?>
<div id="map"></div>
<style>
    #map {
        min-height: 350px;
    }
</style>
<script>


function initialize() {
    
var geocoder = new google.maps.Geocoder();
var address = <?php printf('"%s"', $address); ?>;
var myLatLng;
var panorama;  

    geocoder.geocode({
        'address': address
      }, function(results, status) {
        if (status === 'OK') {
          myLatLng = results[0].geometry.location;
//    alert(myLatLng);
    panorama = new google.maps.StreetViewPanorama(
        document.getElementById('map'),
        {

          position: myLatLng,
          pov: {heading: 0, pitch: 0},
          streetViewControl: false,
          motionTracking: false,
          motionTrackingControl: false,
          addressControl: false
        });

//          // find a Streetview location on the road
//          var request = {
//            origin: address,
//            destination: address,
//            travelMode: google.maps.DirectionsTravelMode.DRIVING
//          };
//          directionsService.route(request, directionsCallback);
        } else {
          alert("Geocode was not successful for the following reason: " + status);
        }
      });
}

initialize();
</script>
<?php
    include('detail_footer.php');
?>
