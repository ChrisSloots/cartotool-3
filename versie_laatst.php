<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Kaart 1 - Context 2.0</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.7">

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/pixel-admin.css" rel="stylesheet" type="text/css">
	<link href="assets/css/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/themes.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/ol.css" type="text/css">
	<link href="assets/css/bootstrap-slider.css" rel="stylesheet">
	<link href="assets/css/custom.css" rel="stylesheet">
	
	<!--[if lt IE 9]>
		<script src="assets/js/ie.min.js"></script>
	<![endif]-->
</head>
<body class="theme-default main-menu-animated map">
<script>var init = [];</script>

<div id="main-wrapper">
<!-- 2. $MAIN_NAVIGATION ===========================================================================
	Main navigation -->
	<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
		<!-- Main menu toggle -->
		<div class="navbar-inner">
			<!-- Main navbar header -->
			<div class="navbar-header">
				<!-- Logo -->
				<a href="index.html" class="navbar-brand">
					<img src="assets/images/logo2.png">
				</a>
				<ul class="contact-info">
					<li>
						<a href="#">+31 (0)172 63 17 20</a>
						<a href="#" class="mailto">info@context-adviseurs.nl</a>
					</li>
				</ul>
				<!-- Main navbar toggle -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

			</div> <!-- / .navbar-header -->

			<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
				<div>
					<ul class="nav navbar-nav">	
						<li><a href="login.html">Home</a></li>
						<li><a href="thumbs.html">Alle projecten</a></li>
					</ul> <!-- / .navbar-nav -->

					<div class="right clearfix">
						<ul class="nav navbar-nav pull-right right-navbar-nav">
							<li>
								<a href="#" class="user-menu" >
									<img src="assets/demo/avatars/1.jpg" alt="">
									<span>Gemeente Den Haag</span>
								</a>
							</li>
							<li class="nav-icon-btn nav-icon-btn-success">
								<a href="javascript:void(0)">
									<i class="dropdown-icon fa fa-power-off"></i>
									<span class="small-screen-text">Logout</span>
								</a>
							</li>
							
						</ul> <!-- / .navbar-nav -->
						
					</div> <!-- / .right -->
					
				</div>
			</div> <!-- / #main-navbar-collapse -->
			<li class="lang-menu pull-right">
						<a href="#" class="active">NL</a> <span>/</span>
						<a href="#">EN</a>
					</li>
		</div> <!-- / .navbar-inner -->
	</div> <!-- / #main-navbar -->
<!-- /2. $END_MAIN_NAVIGATION -->
	<div id="main-menu" role="navigation">
		<div id="main-menu-inner">
			<ul class="navigation fixed">
				<li class="menu-toggle">
					<a id="main-menu-toggle" href="javascript:void(0)"><i class="menu-icon fa fa-bars icon"></i><span class="mm-text">Sluit menu<i class="menu-icon fa fa-caret-left close-icon"></i></span></a>
				</li>
				<li>
					<a href="javascript:void(0)"><img src="assets/images/pdf.png"><span class="mm-text">Opslaan als PDF</span></a>
				</li>
				<li>
					<a href="stat-panels.html"><img src="assets/images/stack.png"><span class="mm-text">Kaarten</span></a>
				</li>
				<li class="mm-dropdown options open">
						<input type="checkbox" class="option-checkbox parent" id="check1"/>
						<a href="javascript:void(0)"><span class="mm-text">Voorzieningen</span></a>
					<ul>
						<li class="mm-dropdown open">
								<input type="checkbox" id="opacity-check1" for="check1" class="option-checkbox"/>
								<a href="javascript:void(0)" class="opacity-check1"><span class="mm-text">Ontmoetingsplekken</span></a>
							<ul>
								<li>
									<div class="options-wrapper">
										<div class="slider">
											<input id="slide" class="opacity-slider1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="100"/>
											<span class="slider-value">100%</span>
										</div>
										<div class="description">
											<img src="assets/images/triangle.png"><p>Rijndijk West, thv 53-97 (6 ongevallen & 4 slachtoffers) en & 4 slachtor something</p>
										</div>
										<div class="description">
											<img src="assets/images/triangle2.png"><p>Nog andere beschrijvingen Rijndijk West</p>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<li class="mm-dropdown">
								<input type="checkbox" for="check1" id="ex1" class="option-checkbox" />
								<a href="javascript:void(0)" class="ex1"><span class="mm-text">Vuilnisbakken</span></a>
							<ul>
								<li>
									<div class="options-wrapper">
										<div class="slider">
											<div class="ui-slider-success ui-slider-colors-demo"></div>
										</div>
										<div class="description">
											<img src="assets/images/triangle.png"><p>Rijndijk West, thv 53-97 (6 ongevallen & 4 slachtoffers) en & 4 slachtor something</p>
										</div>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="mm-dropdown options">
						<input type="checkbox" class="parent option-checkbox" id="check3"/>
						<a href="javascript:void(0)"><span class="mm-text">Vegetatie</span></a>
					<ul>
						<li class="mm-dropdown open">
								<input type="checkbox" for="check3" id="opacity-check2" class="option-checkbox"/>
								<a href="javascript:void(0)" class="opacity-check2"><span class="mm-text">Grenzen</span></a>
							<ul>
								<li>
									<div class="options-wrapper">
										<div class="slider">
											<input id="slide" class="opacity-slider2" data-slider-id='ex2Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="100"/>
											<span class="slider-value">100%</span>
										</div>
										<div class="description">
											<img src="assets/images/triangle.png"><p>Rijndijk West, thv 53-97 (6 ongevallen & 4 slachtoffers) en & 4 slachtor something</p>
										</div>
									</div>
								</li>
								
							</ul>
						</li>
					</ul>
				</li>
				<li class="mm-dropdown options">
						<input type="checkbox" class="parent option-checkbox" id="check4" name="check4"/>
						<a href="javascript:void(0)"><span class="mm-text">Gebouwen</span></a>
					<ul>
						<li class="mm-dropdown open">
								<input type="checkbox" id="opacity-check3" class="option-checkbox" for="check4"/>
											<a href="javascript:void(0)" class="ex4"><span class="mm-text">Ontmoetingsplekken</span></a>
							<ul>
								<li>
									<div class="options-wrapper">
										<div class="slider">
											<input id="slide" class="opacity-slider3" data-slider-id='ex2Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="100"/>
											<span class="slider-value">100%</span>
										</div>
										<div class="description">
											<img src="assets/images/triangle2.png"><p>Rijndijk West, thv 53-97 (6 ongevallen & 4 slachtoffers) en & 4 slachtor something</p>
										</div>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul> <!-- / .navigation -->
		</div> <!-- / #main-menu-inner -->
	</div> <!-- / #main-menu -->
	<div id="main-menu-bg"></div>
	   <div id="map" class="map">
			<div class="project">
				<h4>Den Haag,</h4>
				<p>Kerk aan de zand Bloemenwijk</p>
		   </div>
	   </div>
	   <div id="overlay"></div>
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

<script src="assets/js/custom.js"></script>
<script type="text/javascript">
	init.push(function () {
		// Javascript code here
		$(".map #popup").mCustomScrollbar({theme:"light",alwaysShowScrollbar:false});
		initMap();
		//initCheckbox()
		initSlider();
	})
	window.PixelAdmin.start(init);
</script>

</body>
</html>