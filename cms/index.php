<?php
    require '../dbconnection.php';
    require '../session.php';
    $application_settings = helper::GetApplicationSettings();
    $customer = helper::GetCustomer();
    $page = helper::FetchParam('page', 'project-overview');
    $project_id = helper::FetchParam('project_id', -1);
    if ($project_id != -1)
    {
        $project = helper::GetProject($project_id);
        $_SESSION['project'] = $project;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title><?php echo $application_settings->application_name . ' // CMS' . ($project_id == -1)?'':sprintf(' - %s', $project->name); ?></title>
        <!-- Description, Keywords and Author -->
        <meta name="description" content="Cartotool CMS">
        <meta name="keywords" content="Cartotool, CMS">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Styles -->
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- jquery.nestable.css -->
        <link href="css/jquery.nestable.css" rel="stylesheet" type="text/css">
        <!-- Font Awesome CSS -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- prettyPhoto CSS -->
        <link href="css/prettyPhoto.css" rel="stylesheet" type="text/css">
        <!-- jstree CSS -->
        <link href="css/jstree.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//static.jstree.com/3.2.1/assets/dist/themes/default/style.min.css">
        <!-- Multi select -->
        <link href="css/multi-select.css" rel="stylesheet" type="text/css">
        <!-- Main CSS -->
        <link href="css/global.css" rel="stylesheet">
        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,600,400italic,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <!-- mppng CSS -->
        <link href="css/mppng.css" rel="stylesheet" type="text/css">
        
        <!-- ol3 -->
        <link rel="stylesheet" href="https://openlayers.org/en/v3.13.1/css/ol.css" type="text/css">
        <style>
            .ol3map {
                height: 600px;
                width: 100%;
            }
        </style>
        <script src="https://openlayers.org/en/v3.13.1/build/ol.js" type="text/javascript"></script>
        
   </head>

    <body>
        <div id="page-wrapper">
            <header>
                <?php include 'mainnavigation.php'; ?>


                <nav class="nav-sidebar">
                    <ul class="menu-sidebar">
                        <li <?php
                            $class = '';
                            if ($page == 'project-overview')
                            {
                                $class = 'active';
                            }
                            if ($project_id != -1)
                            {
                                $class .= ' open';
                            }
                            printf('class="%s"', $class); 
                        ?>>
                            <a href="?page=project-overview">
                                <i class="menu-icon-project"></i>
                                <span><?php echo helper::GetText("PROJECT"); ?></span>
                            </a>
                            <ul>
                                <li <?php echo ($page=='edit-project-algemeen')?'class="active"':''; ?>><a href="?page=edit-project-algemeen&project_id=<?php echo $project_id; ?>"><?php echo helper::GetText("GENERAL"); ?></a></li>
                                <li <?php echo ($page=='edit-project-lagen')?'class="active"':''; ?>><a href="?page=edit-project-lagen&project_id=<?php echo $project_id; ?>"><?php echo helper::GetText("LAYERS"); ?></a></li>
                                <li <?php echo ($page=='edit-project-lagenvolgorde')?'class="active"':''; ?>><a href="?page=edit-project-lagenvolgorde&project_id=<?php echo $project_id; ?>"><?php echo helper::GetText("LAYER_ORDER"); ?> </a></li>
                            </ul>
                        </li>
                        <li <?php echo ($page == 'gebruikers' || $page == 'edit-user')?'class="active"':''; ?>>
                            <a href="?page=gebruikers">
                                <i class="menu-icon-gebruikers"></i>
                                <span><?php echo helper::GetText("USERS"); ?></span>
                            </a>
                        </li>
                        <li <?php echo (helper::isLibraryElement($page))?'class="active open"':''; ?>>
                            <a href="?page=maps">
                                <i class="menu-icon-bibliotheek"></i>
                                <span><?php echo helper::GetText("LIBRARY"); ?></span>
                            </a>
                            <ul>
                                <li <?php echo ($page=='maps' || $page=='edit-map')?'class="active"':''; ?>><a href="?page=maps"><?php echo helper::GetText('MAPS'); ?></a></li>
                                <li <?php echo ($page=='layers' || $page=='edit-layer')?'class="active"':''; ?>><a href="?page=layers"><?php echo helper::GetText('LAYERS'); ?></a></li>
                                <li <?php echo ($page=='sources' || $page=='edit-source')?'class="active"':''; ?>><a href="?page=sources"><?php echo helper::GetText('SOURCES'); ?></a></li>
                                <li <?php echo ($page=='styles' || $page=='edit-style')?'class="active"':''; ?>><a href="?page=styles"><?php echo helper::GetText('STYLES'); ?></a></li>
                                <li <?php echo ($page=='legends' || $page=='edit-legend')?'class="active"':''; ?>><a href="?page=legends"><?php echo helper::GetText('LEGENDS'); ?></a></li>
                                <li <?php echo ($page=='symbols' || $page=='edit-symbol')?'class="active"':''; ?>><a href="?page=symbols"><?php echo helper::GetText('SYMBOLS'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>

            <?php
                $msg = Helper::FetchParam('msg', NULL);
                if ($msg != NULL)
                {
                    
            ?>    
                <section id="content" class="msg" style="height: 100px;">
                    <div class="container">
                        <div class="alert alert-info" role="alert">
                            <?php echo $msg; ?>
                        </div>
                    </div>
                </section>
                <script>setTimeout(function(){ $('.msg').hide(); }, 3000);</script>
            <?php
                }
            
                $filename = sprintf('%s.inc', $page);
                if (file_exists($filename))
                {
                    include $filename;
                    echo $filename;
                }
                else 
                {
                    echo '<section id="content"><div class="container">Page not found.</div></section>';
                }
                //echo '<section id="content"><div class="container">'. print_r($_SESSION['project'], true).'</div></section>';
            ?>

        </div>
        <!-- Javascript files -->
        <!-- jQuery -->
        <script src="js/jquery-1.11.3.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/jstree.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/iscroll.js"></script>
        <script src="js/jquery.multi-select.js"></script>
        <script src="js/main.js"></script>
        <script src="js/jquery.nestable.js"></script>
        <script src="js/ui-nestable.min.js"></script>

        <!-- Custom scripts from Chris -->
        <script src="../assets/js/custom_mppng.js"></script>

    </body>
</html>