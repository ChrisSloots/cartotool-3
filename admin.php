<?php
    // Connect to db
    require 'dbconnection.php';
    
    // Session required to get here
    require 'session.php';
    
    // Get action
    $action = helper::FetchParam('action', CC::ACTION_LIST);
    
    // Get action
    $table_id = helper::FetchParam('table_id', NULL);
    
    // Check if user may see this project manager and admins only
    if (!helper::IsManager($user))
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
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/pixel-admin.css" rel="stylesheet" type="text/css">
	<link href="assets/css/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/themes.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/ol.css" type="text/css">
        <link href="assets/css/bootstrap-slider.css" rel="stylesheet">
	<link href="<?php echo $customer->stylesheet; ?>" rel="stylesheet">
	
	<!-- Tablesorter stylesheets -->
        <link href="assets/tablesorter/theme.blue.css" rel="stylesheet" type="text/css">
        <link href="assets/tablesorter/theme.dropbox.css" rel="stylesheet" type="text/css">
        <link href="assets/tablesorter/theme.dark.css" rel="stylesheet" type="text/css">
        
	<!--[if lt IE 9]>
		<script src="assets/js/ie.min.js"></script>
	<![endif]-->
</head>
<body class="theme-default main-menu-animated map">
<script>var init = [];</script>
    
    <?php
    
        $html = helper::GetCMSTablesHTML($user);
        echo $html;
        
        echo "Actie: " . $action . PHP_EOL;
        echo "Table_id: " . $table_id;
        
        
        $table = helper::GetCMSTable($table_id);
        if ($table->id != NULL)
        {
            echo helper::GetCMSObjectHTMLTable($table);
        } 


    ?>
    
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
<script src="assets/tablesorter/jquery.tablesorter.js"></script>
<script src="assets/tablesorter/jquery.tablesorter.widgets.js"></script>

<!-- Custom scripts from Surya -->
<script src="assets/js/custom.js"></script>

<script type="text/javascript">
	init.push(function () {
            $('table')
    .bind('filterInit', function() {
        // check that storage ulility is loaded
        if ($.tablesorter.storage) {
            // get saved filters
            var f = $.tablesorter.storage(this, 'tablesorter-filters') || [];
            $(this).trigger('search', [f]);
        }
    })
    .bind('filterEnd', function(){
        if ($.tablesorter.storage) {
            // save current filters
            var f = $(this).find('.tablesorter-filter').map(function(){
                return $(this).val() || '';
            }).get();
            $.tablesorter.storage(this, 'tablesorter-filters', f);
        }
    });


$('table').tablesorter({

    // *** APPEARANCE ***
    // Add a theme - try 'blackice', 'blue', 'dark', 'default'
    theme: 'blue',

    // fix the column widths
    widthFixed: false,

    // include zebra and any other widgets, options:
    // 'columns', 'filter', 'stickyHeaders' & 'resizable'
    // 'uitheme' is another widget, but requires loading
    // a different skin and a jQuery UI theme.
    widgets: ['zebra', 'filter'],

    widgetOptions: {

        // zebra widget: adding zebra striping, using content and
        // default styles - the ui css removes the background
        // from default even and odd class names included for this
        // demo to allow switching themes
        // [ "even", "odd" ]
        zebra: [
            "ui-widget-content even",
            "ui-state-default odd"
            ],

        // uitheme widget: * Updated! in tablesorter v2.4 **
        // Instead of the array of icon class names, this option now
        // contains the name of the theme. Currently jQuery UI ("jui")
        // and Bootstrap ("bootstrap") themes are supported. To modify
        // the class names used, extend from the themes variable
        // look for the "$.extend($.tablesorter.themes.jui" code below
        uitheme: 'jui',

        // columns widget: change the default column class names
        // primary is the 1st column sorted, secondary is the 2nd, etc
        columns: [
            "primary",
            "secondary",
            "tertiary"
            ],

        // columns widget: If true, the class names from the columns
        // option will also be added to the table tfoot.
        columns_tfoot: true,

        // columns widget: If true, the class names from the columns
        // option will also be added to the table thead.
        columns_thead: true,

        // filter widget: If there are child rows in the table (rows with
        // class name from "cssChildRow" option) and this option is true
        // and a match is found anywhere in the child row, then it will make
        // that row visible; default is false
        filter_childRows: false,

        // filter widget: If true, a filter will be added to the top of
        // each table column.
        filter_columnFilters: true,

        // filter widget: css class applied to the table row containing the
        // filters & the inputs within that row
        filter_cssFilter: "tablesorter-filter",

        // filter widget: Customize the filter widget by adding a select
        // dropdown with content, custom options or custom filter functions
        // see http://goo.gl/HQQLW for more details
        filter_functions: null,

        // filter widget: Set this option to true to hide the filter row
        // initially. The rows is revealed by hovering over the filter
        // row or giving any filter input/select focus.
        filter_hideFilters: false,

        // filter widget: Set this option to false to keep the searches
        // case sensitive
        filter_ignoreCase: true,

        // filter widget: jQuery selector string of an element used to
        // reset the filters. 
        filter_reset: null,

        // Delay in milliseconds before the filter widget starts searching;
        // This option prevents searching for every character while typing
        // and should make searching large tables faster.
        filter_searchDelay: 300,

        // filter widget: Set this option to true to use the filter to find
        // text from the start of the column. So typing in "a" will find
        // "albert" but not "frank", both have a's; default is false
        filter_startsWith: false,

        // filter widget: If true, ALL filter searches will only use parsed
        // data. To only use parsed data in specific columns, set this option
        // to false and add class name "filter-parsed" to the header
        filter_useParsedData: false,

        // Resizable widget: If this option is set to false, resized column
        // widths will not be saved. Previous saved values will be restored
        // on page reload
        resizable: true,

        // saveSort widget: If this option is set to false, new sorts will
        // not be saved. Any previous saved sort will be restored on page
        // reload.
        saveSort: true,

        // stickyHeaders widget: css class name applied to the sticky header
        stickyHeaders: "tablesorter-stickyHeader"

    }

});
	});
	window.PixelAdmin.start(init);
</script>

    
</body>
</html>