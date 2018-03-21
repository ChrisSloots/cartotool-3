<?php
    include('detail_header.php');
?>

<div id="chartContainer">

  <script type="text/javascript">
    var svg = dimple.newSvg("#chartContainer", "100%" , "350");
    mydata = [<?php echo dashboard::GetDataForGroupedBarChart($data) ?>];
	

      var myChart = new dimple.chart(svg, mydata);
      
      // Color scheme (colorbrewer - qualitative 10 , leftmost
      myChart.defaultColors = [
	new dimple.color("#e1000a"),  // rood
	new dimple.color("#FF7800"), // oranje
	new dimple.color("#FFE600"), // geel
	new dimple.color("#9BFF32"), // lime
	new dimple.color("#009B3C"), // groen
	new dimple.color("#05C8B4"), // aqua
	new dimple.color("#0A4196"), // blauw
	new dimple.color("#B432B4") // paars
      ]; 
      
      
      //myChart.setBounds(60, 30, 320, 205);
      myChart.setBounds("50px", "30px", "80%,-20px", "80%,-10px");
      var x = myChart.addCategoryAxis("x", ["cat"]);
      x.addOrderRule("order");
      myChart.addMeasureAxis("y", "<?php echo $var->var_name; ?>");
      var ring = myChart.addSeries("cat", dimple.plot.bar);
      
      myChart.assignColor("Rood", "#e1000a", "", 1);
      myChart.assignColor("Oranje", "#FF7800", "", 1);
      myChart.assignColor("Geel", "#FFE600", "", 1);
      myChart.assignColor("Lime", "#9BFF32", "", 1);
      myChart.assignColor("Groen", "#009B3C", "", 1);
      myChart.assignColor("Aqua", "#05C8B4", "", 1);
      myChart.assignColor("Blauw", "#0A4196", "", 1);
      myChart.assignColor("Paars", "#B432B4", "", 1);
      
      //myChart.ease = "bounce";
      myChart.staggerDraw = true;
      x.title = "";
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
