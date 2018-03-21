<?php
    include('detail_header.php');
?>
<div id="chartContainer">

  <script type="text/javascript">
    var svg = dimple.newSvg("#chartContainer", 400, 300);
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
            
      myChart.setBounds(0, "10%", "90%", "90%");
      x = myChart.addMeasureAxis("p", "<?php echo $var->var_value_description; ?>");
      x.addOrderRule("<?php echo $var->var_name; ?>");
      var ring = myChart.addSeries("<?php echo $var->var_name; ?>", dimple.plot.pie);
      //ring.innerRadius = "50%";
      ring.outerRadius = "80%";
      myChart.addLegend(320, 20, 100, 300, "left");
      myChart.draw(1000);

  </script>
</div>
    
<?php
    include('detail_footer.php');
?>
