<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Bibliotheek Styling</title>
        <!-- Description, Keywords and Author -->
        <meta name="description" content="Your description">
        <meta name="keywords" content="Your,Keywords">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Styles -->
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome CSS -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- prettyPhoto CSS -->
        <link href="css/prettyPhoto.css" rel="stylesheet" type="text/css">
        <!-- Main CSS -->
        <link href="css/global.css" rel="stylesheet">
        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,600,400italic,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
   </head>

    <body>
        <div id="page-wrapper">
            <header>
                <nav class="nav-bar">
                    <div class="logo">
                        <img src="img/logo.png" alt="">
                    </div>
                    <div class="header-contact">
                        <span>+31 (0)172 63 17 20 </span>
                        <span>info@context-adviseurs.nl</span>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="home.html">Home</a></li>
                            <li><a class="fa fa-angle-right"></a></li>
                            <li><a href="bibliotheek.html">Styling</a></li>
                            <li><a class="fa fa-angle-right"></a></li>
                            <li><a href="bibliotheek-styling.php">Nieuw styling</a></li>
                        </ul>
                    </div>
                    <div class="account-nav">
                        <ul>
                            <li><img src="img/avatar.png" alt=""/><a href="users#">Gemeente Den Haag</a></li>
                            <li><a href="users#" class="fa fa-power-off" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip on bottom"></a></li>
                            <li><a href="#">NL</a><a>/</a><a href="#">EN</a></li>
                        </ul>
                    </div>
                </nav>


                <nav class="nav-sidebar">
                    <ul class="menu-sidebar">
                        <li>
                            <a href="home.html">
                                <i class="menu-icon-home"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="gebruikers.html">
                                <i class="menu-icon-gebruikers"></i>
                                <span>Gebruikers</span>
                            </a>
                        </li>
                        <li class="active open">
                            <a href="bibliotheek.html">
                                <i class="menu-icon-bibliotheek"></i>
                                <span>Bibliotheek</span>
                            </a>
                            <ul>
                                <li class="active"><a href="bibliotheek-styling.php">Styling</a></li>
                                <li><a href="bibliotheek.html">Legenda image</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="project-algemeen.php">
                                <i class="menu-icon-project"></i>
                                <span>Project</span>
                            </a>
                            <ul>
                                <li><a href="project-algemeen.php">Algemeen</a></li>
                                <li><a href="project-lagen.html">Lagen</a></li>
                                <li><a href="project-lagen-volgorde.html">Lagen volgorde</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>

            <section id="content">
                <div class="container">
                    <a href="bibliotheek.html" class="btn outlined btn-small btn-dark-blue rounded uppercase">TERUG nAAR STYLING</a>

	                <form id="form" class="form-horizontal form-validate">
						<div class="table-header blue-border">
							<h3>Styling</h3>
						</div>
						<div class="block">
							<div class="form-group">
							    <label for="inputName" class="control-label">Naam:</label>
							    <div class="input-fields">
							    	<input type="text" class="form-control required name" id="inputName" name="inputName"  placeholder="Naam">
							    </div>
							</div>
							<div class="form-group">
							    <label for="inputName" class="control-label">Thumbnail:</label>
							    <div class="input-fields">
                                    <div class="upload-image-wrapper">
                                        <input class="upload-image valid" type="file" aria-invalid="false">
                                        <div class="uploadPreview">  </div>
                                        <div class="upload-field">
                                            <i class="fa fa-file"></i>
                                            <span class="image-title">Upload file</span>
                                            <button type="button" class="add btn btn-small btn-light-blue">Add</button>
                                            <button type="button" class="delete btn btn-small btn-red">Delete</button>
                                            <button type="button" class="change btn btn-small btn-light-grey">Change</button>
                                        </div>
                                    </div>                             
							    </div>
							</div>
							<div class="form-group">
							    <label for="inputName" class="control-label">Code:</label>
							    <div class="input-fields">
							    	<textarea class="form-control input-code" id="inputText"></textarea>
							    </div>
							</div>
							<div class="form-group">
							    <label for="inputName" class="control-label">Opmerking:</label>
							    <div class="input-fields">
							    	<textarea class="form-control" id="inputText"></textarea>
							    	<button type="submit" class="btn" href="#">Opslaan</button>
							    </div>
							</div>
						</div>


						
					</form>
                </div>
            </section>
        </div>
        <!-- Javascript files -->
        <!-- jQuery -->
        <script src="js/jquery-1.11.3.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/jstree.min.js"></script>
        <script src="js/iscroll.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>