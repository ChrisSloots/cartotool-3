<?php
    // Connect to db
    require 'dbconnection.php';
    
    require 'session.php';
?>
<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo helper::AppTitle();?></title>
	<meta name="viewport" content="width=device-width, initial-scale=0.75">

	<!-- Open Sans font from Google CDN -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/pixel-admin.css" rel="stylesheet" type="text/css">
	<link href="assets/css/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/themes.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://openlayers.org/en/v3.6.0/css/ol.css" type="text/css">
	<link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/isotope.css">
	<link href="<?php echo $customer->stylesheet; ?>" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="assets/js/ie.min.js"></script>
	<![endif]-->
</head>
<body class="theme-default main-menu-animated thumbs">
<script>var init = [];</script>
<div id="main-wrapper">


<!-- 2. $MAIN_NAVIGATION ================================================================= Main navigation -->
<?php 
    include 'mainnavigation.php';
?>
<!-- /2. $END_MAIN_NAVIGATION -->
	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-4 aside">
					<div class="row">
						<div id="main-menu" role="navigation">
							<div id="main-menu-inner">
								<div class="menu-content top" id="menu-content-demo">
									<div>
                                                                            <div class="text-bg"><span class="text-slim"><?php echo helper::GetText("WELCOME");?>,</span><br/><span class="text-semibold"><?php echo $user->name; ?></span></div>
										<img src="<?php echo $user->image; ?>" alt="" class="">
									</div>
								</div>
                                                                <?php echo helper::GetAvailableProjectsHTML($user); ?>
								<div class="menu-content footer-links">
                                                                    <!--
									<a href="disclaimer.php" class="dark">Disclaimer</a>
									<a href="privacy.php" class="dark">Privacy</a>
                                                                    -->
								</div>
							</div> <!-- / #main-menu-inner -->
						</div> <!-- / #main-menu -->

					</div>
				</div>
				<div class="col-md-9 col-sm-8 portfolioContainer">
					<div class="row">
						<div class="image-gallery">
                                                    <?php echo helper::GetAvailableProjectImagesHTML($user); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->

<!-- Pixel Admin's javascripts -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/pixel-admin.min.js"></script>
<script src="https://openlayers.org/en/v3.6.0/build/ol.js" type="text/javascript"></script>
<script src="assets/js/jquery.isotope.js" type="text/javascript"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- Custom scripts from Surya -->
<script src="assets/js/custom.js"></script>

<!-- Custom scripts from Chris -->
<script src="assets/js/custom_mppng.js"></script>

<script type="text/javascript">
	init.push(function () {
		// Javascript code here
		$(".mm-dropdown ul").mCustomScrollbar({theme:"light",alwaysShowScrollbar:false});
	})
	window.PixelAdmin.start(init);
</script>
<script>
$(window).load(function(){
    var $container = $('.image-gallery');
    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 700,
            easing: 'linear',
            queue: true
        }
    });
 
//    $('.portfolioFilter li a').click(function(){
//        $('.portfolioFilter .current').removeClass('current');
//        $(this).addClass('current');
// 
//        var selector = $(this).attr('data-filter');
//        $container.isotope({
//            filter: selector,
//            animationOptions: {
//                duration: 700,
//                easing: 'linear',
//                queue: true
//            }
//         });
//         return false;
//    }); 

    $('.portfolioFilter a.filter').click(function(){
        $('.portfolioFilter .current').removeClass('current');
        $(this).addClass('current');
 
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 700,
                easing: 'linear',
                queue: true
            }
         });
         return !false;
    }); 
});
</script>

</body>
</html>