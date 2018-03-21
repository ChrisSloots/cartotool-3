<?php
    require 'dbconnection.php';
    $application_settings = helper::GetApplicationSettings();
    $customer = helper::GetCustomer();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
                <title><?php echo helper::AppTitle();?></title>
		<!-- Description, Keywords and Author -->
		<meta name="description" content="Cartotool 2.0">
		<meta name="keywords" content="cartotool, context, springco, cyber">
		<meta name="author" content="ResponsiveWebInc">
		<meta name="robots" content="noindex, nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Styles -->
		<!-- Bootstrap CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font awesome CSS -->
		<link href="assets/css/pixel-admin.min.css" rel="stylesheet" type="text/css">		
		<!-- Main CSS -->
		<link href="assets/css/style-150.css" rel="stylesheet">
		<link href="assets/css/custom.css" rel="stylesheet">
				
		<!-- Favicon -->
                <link rel="shortcut icon" href="/favicon.ico">
	</head>
	<body class="login theme-default">
		<!-- UI # -->
	<div class="ui-150">
		<div class="overlay"></div>
		<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
		<!-- Main menu toggle -->
			<div class="navbar-inner">
				<!-- Main navbar header -->
				<div class="navbar-header">
					<!-- Logo -->
					<a href="<?php //echo $customer->website; ?>" class="navbar-brand">
						<!--<img src="assets/images/cartotool-logo-klein.png">-->
					</a>
					<ul class="contact-info">
						<li>
							<a href="#"><?php echo (isset($customer))?$customer->phonenumber:"&nbsp;"; ?></a>
							<a href="mailto:<?php echo (isset($customer))?$customer->email:"&nbsp;"; ?>" class="mailto"><?php echo (isset($customer))?$customer->email:"&nbsp;"; ?></a>
						</li>
					</ul>
				</div> <!-- / .navbar-header -->

				<li class="lang-menu pull-right">
                                        <?php echo helper::GetLanguageLinks($language_id); ?>
				</li>
			</div> <!-- / .navbar-inner -->
		</div> <!-- / #main-navbar -->

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
				
					<!-- Login Form -->
					<div class="ui-form">
                             <a class="text-center"><!--<img src="assets/images/cartotool-logo-groot.png">--></a>
						<form class="login-form" action="#">
							<!-- Email -->
							<div class="form-group">
								<input class="form-control" placeholder="<?php echo helper::GetText("ENTER_EMAIL"); ?>" required type="email" id="email">
							</div>
							<!-- Password -->
							<div class="form-group">
								<input class="form-control" required placeholder="Enter Password" type="password" id="password">
							</div>
                                                        <!--
							<div class="checkbox form-group">
								<label>
									<input type="checkbox"> Remember Me
								</label>
							</div>
                                                        -->
							<div class="forgot-link"><a href="#" class="password-reset"><?php echo helper::GetText("FORGOT"); ?></a></div>
							<div class="social form-group">
								<button href="#" type="submit" class="btn-block google-plus"><?php echo helper::GetText("LOGIN"); ?></button>
							</div>
						</form>
						<!-- Password reset form -->
						<div class="password-reset-form" id="password-reset-form">
							<div class="header">
								<div class="signin-text">
									<span>Password reset</span>
									<div class="close">&times;</div>
								</div> <!-- / .signin-text -->
							</div> <!-- / .header -->
							
							<!-- Form -->
							<form action="#">
								<!-- Email -->
								<div class="form-group">
									<input class="form-control" required placeholder="<?php echo helper::GetText("ENTER_EMAIL"); ?>" required type="email">
								</div>
								<div class="social">
									<button href="#" type="submit" class="btn-block facebook"><?php echo helper::GetText("LOGIN"); ?></button>
								</div>
							</form>
							<!-- / Form -->
						</div>
						<!-- / Password reset form -->
					</div>
				</div>
			</div>
		</div>
	</div>
		
		<!-- Javascript files -->
		<!-- jQuery -->
		<script src="assets/js/jquery.js"></script>
		<!-- Bootstrap JS -->
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- Placeholder JS -->
		<script src="assets/js/placeholder.js"></script>
		<!-- Respond JS for IE8 
		<script src="assets/js/respond.min.js"></script>
		 HTML5 Support for IE 
		<script src="assets/js/html5shiv.js"></script>-->

                <!-- Custom scripts from Surya -->
                <script src="assets/js/custom.js"></script>

                <!-- Custom scripts from Chris -->
                <script src="assets/js/custom_mppng.js"></script>
    </body>
</html>