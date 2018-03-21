<?php
    // Connect to db
    require 'dbconnection.php';
    
    // Session required to get here
    require 'session.php';
    
    // Get project id
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
<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo helper::AppTitle(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=0.7">

	<!-- Open Sans font from Google CDN -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">

	<!-- Pixel Admin's stylesheets -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/pixel-admin.css" rel="stylesheet" type="text/css">
	<link href="assets/css/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/themes.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/ol.css" type="text/css">
        <link href="assets/css/bootstrap-slider.css" rel="stylesheet">
	<link href="assets/css/dialog.css" rel="stylesheet">
	<link href="<?php echo $customer->stylesheet; ?>" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.15/proj4-src.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


	<!--[if lt IE 9]>
		<script src="assets/js/ie.min.js"></script>
	<![endif]-->
</head>
<body class="theme-default main-menu-animated map mmc">
<script>var init = [];</script>

<div id="main-wrapper">
<!-- 2. $MAIN_NAVIGATION ==================================================================== Main navigation -->
<?php
    include 'mainnavigation.php';
?>
<!-- /2. $END_MAIN_NAVIGATION -->
	<div id="main-menu" role="navigation">
		<div id="main-menu-inner">
                    <?php 
                        $maplayers = helper::HierarchicalLayerStructure($map, NULL, $layertree, $layers); 
                        echo $layertree;
                    ?>
		</div> <!-- / #main-menu-inner -->
	</div> <!-- / #main-menu -->
	<div id="main-menu-bg"></div>
	   <div id="map" class="map">
		<div class="project">
                    <h4><?php echo $project->name; ?></h4>
                    <p>Powered by <a target="_blank" href="http://spring-co.nl">SpringCo</a></p>
		</div>
	   </div>
    <div id="popup" class="ol-popup">
      <a href="#" id="popup-closer" class="ol-popup-closer"></a>
	  <h3 id="popover-title" class="popover-title"></h3>
      <div id="popup-content"></div>
    </div>
	<!-- /4. $MAIN_MENU -->
	</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->

<!-- javascripts -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/pixel-admin.js"></script>
<script src="assets/js/ol.js" type="text/javascript"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<!-- Aangepast voor modal -->
<script src="assets/js/dialog.js"></script>

<!-- Custom scripts from Surya -->
<script src="assets/js/custom.js"></script>

<!-- Custom scripts from Chris -->
<script src="assets/js/custom_mppng.js"></script>

<!-- Dynamic scripts from Chris --> 
<script src="<?php printf('custom_mppng.php?id=%d', $project_id); ?>"></script>

<script type="text/javascript">
	init.push(function () {
		// Javascript code here
		$(".map #popup").mCustomScrollbar({theme:"light",alwaysShowScrollbar:false});
		initMap();
		//initCheckbox()
		initSlider();
                
                //alert("Start");
                var idxObj = { index: 0 };
                traverseLayers(map.getLayers(), idxObj);
                //initOpacity();
	});
	window.PixelAdmin.start(init);
</script>

</body>
</html>