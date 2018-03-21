<?php
    include('detail_header.php');
?>
<?php
    $chartContainerName = str_replace(" ", "_", sprintf("chartContainer-%s", $var->var_name));
?>
<div id="<?php echo $chartContainerName; ?>" style="height: 100%; min-height: 300px; border: 0px solid red;">

  <script type="text/javascript">
    var svg = dimple.newSvg("#<?php echo $chartContainerName; ?>", "100%" , "350");
    mydata = [<?php echo dashboard::GetDataForChart($data) ?>];
	

      var myChart = new dimple.chart(svg, mydata);
      
      // Color scheme (colorbrewer - qualitative 10 , leftmost
      myChart.defaultColors = [
	new dimple.color("#a6cee3"),
	new dimple.color("#1f78b4"),
	new dimple.color("#b2df8a"),
	new dimple.color("#33a02c"),
	new dimple.color("#fb9a99"),
	new dimple.color("#e31a1c"),
	new dimple.color("#fdbf6f"),
	new dimple.color("#ff7f00"),
	new dimple.color("#cab2d6"),
	new dimple.color("#6a3d9a")
      ]; 
            
      myChart.setBounds("50px", "30px", "80%,-20px", "80%,-70px");
      var x = myChart.addCategoryAxis("x", "<?php echo $var->var_name; ?>");
      x.title = "";
//      x.addOrderRule("<?php echo $var->var_name; ?>");
      x.addOrderRule("order");
      
      myChart.addMeasureAxis("y", "<?php echo $var->var_value_description; ?>");
      var ring = myChart.addSeries(null, dimple.plot.bar);
      //myChart.addLegend(320, 20, 100, 300, "left");
      myChart.staggerDraw = true;
      //myChart.ease = "bounce";
      myChart.draw(1000);
      
      // Add a method to draw the chart on resize of the window
      window.onresize = function () {
        // As of 1.1.0 the second parameter here allows you to draw
        // without reprocessing data.  This saves a lot on performance
        // when you know the data won't have changed.
        myChart.draw(0, true);
        //alert(0);
      };

  </script>
</div>
    
<?php
    include('detail_footer.php');
?>