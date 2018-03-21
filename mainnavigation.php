	<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
		<!-- Main menu toggle -->
		<div class="navbar-inner">
			<!-- Main navbar header -->
			<div class="navbar-header">
				<!-- Logo -->
				<a href="<?php echo trim($customer->website); ?>" class="navbar-brand">
                                        <img src="assets/images/<?php echo $customer->logo; ?>" height="27px">
                                    <!--<img src="assets/images/logo-spring-co.png" height="27px">-->
				</a>
				<ul class="contact-info">
					<li>
						<a href="#"><?php echo $customer->phonenumber; ?></a>
						<a href="mailto:<?php echo $customer->email; ?>" class="mailto"><?php echo $customer->email; ?></a>
					</li>
				</ul>
				<!-- Main navbar toggle -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

			</div> <!-- / .navbar-header -->

			<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
				<div>
					<ul class="nav navbar-nav">	
						<li><a href="index.php"><?php echo helper::GetText("HOME"); ?></a></li>
                                                <li><a href="projects_overview.php"><?php echo helper::GetText("ALL_PROJECTS"); ?></a></li>
					</ul> <!-- / .navbar-nav -->

					<div class="right clearfix">
						<ul class="nav navbar-nav pull-right right-navbar-nav">
							<li>
								<a href="<?php echo ($user->usertype==3)?"cms":"#";?>" class="user-menu" title="<?php echo helper::GetUserTooltip($user); ?>">
									<img src="<?php echo $user->image; ?>" alt="">
									<span><?php printf('%s %s', $user->first_name, $user->last_name); ?></span>
								</a>
							</li>
							<li class="nav-icon-btn nav-icon-btn-success">
                                                            <a href="javascript:logout('logout.php')" title="<?php echo helper::GetText("LOGOUT"); ?>">
									<i class="dropdown-icon fa fa-power-off"></i>
									<span class="small-screen-text"><?php echo helper::GetText("LOGOUT"); ?></span>
								</a>
							</li>
							
						</ul> <!-- / .navbar-nav -->
						
					</div> <!-- / .right -->
					
				</div>
			</div> <!-- / #main-navbar-collapse -->
			<li class="lang-menu pull-right">
						<?php echo helper::GetLanguageLinks($language_id); ?>
					</li>
		</div> <!-- / .navbar-inner -->
	</div> <!-- / #main-navbar -->


