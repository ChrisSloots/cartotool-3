/*Login and Password Reset Form*/
$('.password-reset').click(function () {
	$('.login-form').hide();
	$('#password-reset-form').fadeIn(400);
	return false;
});


$('#password-reset-form .close-btn').click(function () {
	$('#password-reset-form').hide();
	$('.login-form').fadeIn(400);
	return false;
});


function initMap(){
/**
 * Elements that make up the popup.
 */
	var container = document.getElementById('popup');
	var content = document.getElementById('popup-content');
	var closer = document.getElementById('popup-closer');

	/**
	 * Create an overlay to anchor the popup to the map.
	 */
	var overlay = new ol.Overlay(/** @type {olx.OverlayOptions} */ ({
	  element: container,
	  autoPan: true,
	  animation:false
	}));


	/**
	 * Create the map.
	 */
	var map = new ol.Map({
		  layers: [
			new ol.layer.Tile({
			  source: new ol.source.MapQuest({layer: 'sat'})
			}), new ol.layer.Group({
			  layers: [
				new ol.layer.Tile({
				  source: new ol.source.TileJSON({
					url: 'http://api.tiles.mapbox.com/v3/' +
						'mapbox.20110804-hoa-foodinsecurity-3month.jsonp',
					crossOrigin: 'anonymous'
				  })
				}),
				new ol.layer.Tile({
				  source: new ol.source.TileJSON({
					url: 'http://api.tiles.mapbox.com/v3/' +
						'mapbox.world-borders-light.jsonp',
					crossOrigin: 'anonymous'
				  })
				})
			  ]
			})
		  ],
		  overlays: [overlay],
		  controls: ol.control.defaults().extend([ new ol.control.OverviewMap({collapsible:false})]),
		  target: 'map',
		  view: new ol.View({
			center: ol.proj.fromLonLat([37.40570, 8.81566]),
			zoom: 4
		  })
		});
		
		
		var pos = ol.proj.fromLonLat([15.3723,16.5230]);
		var m = new ol.Overlay({
		  position: pos,
		  element: document.getElementById('overlay')
		});
		map.addOverlay(m);

		var pos2 = ol.proj.fromLonLat([17.3723,18.5230]);
		var m2 = new ol.Overlay({
		  position: pos2,
		  element: document.getElementById('overlay-link')
		});
		map.addOverlay(m2);


	/**
	 * Add a click handler to the map to render the popup.
	 */
	//  var x=1;
	// $('#overlay').on('click', function() {
	// 	x=0;
	// 	getData();
	// });
	// $('#overlay').on('mouseover', function() {
	// 	getData();
	// });
	// $('#overlay').on('mouseout', function() {
	// 	if(x==1){
	// 		overlay.setPosition(undefined);
	// 		closer.blur();
	// 		return false;
	// 	}
	// });
	/**
	 * Add a click handler to hide the popup.
	 * @return {boolean} Don't follow the href.
	 */
	closer.onclick = function() {
		x=1;
	  overlay.setPosition(undefined);
	  closer.blur();
	  return false;
	};
		var cnt=1;
	function bindInputs(layerid, layer) {
	  var visibilityInput = $(layerid);
	  visibilityInput.on('change', function() {	layer.setVisible(this.checked);	  });
	  layer.setVisible(false);//Initial Opacity
	  visibilityInput.prop('checked', layer.getVisible());

		$.each(['opacity'], //['opacity', 'hue', 'saturation', 'contrast', 'brightness']
		  function(i, v) {
			var input = $('.opacity-slider'+cnt);
			
			input.on('slide', function() {
				slide=$(this).data('slider').getValue();
			  layer.set(v, parseFloat(slide/100));
			});
			input.val(String(layer.get(v)));
			cnt++;
		  }
		);
	}
	map.getLayers().forEach(function(layer, i) {
		if (layer instanceof ol.layer.Group) {
		layer.getLayers().forEach(function(sublayer, j) {
		  bindInputs('#opacity-check'+(j+1), sublayer);
		});
		}
	});
	function getData(){
		var title = "Hello World";
		$("#popup #popover-title").html(title);
	  content.innerHTML = '<p>Tooltip information with HTML text and pictures</p><img src="http://placehold.it/200x125"><p>Information with HTML text and pictures some text and more text</p>';
	  overlay.setPosition(pos);
	}
	
	/*Marker Opacity*/
	function markerOpacity(){
		var visibilityInput = $("#opacity-check3");
		var layer=$("#overlay, #overlay-link");
		var isChecked=(visibilityInput.is(":checked"))?1:0;
		 
		if(isChecked==0){$(layer).css('display','none');}//Initial Display None, if Opacity 0
		else{$(layer).css('display','block');}
		$(layer).css('opacity',isChecked);//Initial Opacity
		
		$(visibilityInput).on('change', function() {
			var isChecked=(visibilityInput.is(":checked"));
			if(isChecked){
				slide=$('.opacity-slider3').data('slider').getValue();
				$(layer).css('opacity',slide/100);
				$(layer).css('display','block');
			}
			else{
				$(layer).css('display','none');
			}
		});
		
		var input = $('.opacity-slider3');
		input.on('slide', function() {
			slide=$(this).data('slider').getValue();
			$(layer).css('opacity',slide/100);
		});
	}
	markerOpacity();
}

/************ Opacity Slider *************/
function initSlider(){
	$(".slider #slide").slider();
	$('.slider #slide').bind('slide click slideStart slideStop',function(){
		var current=$(this).data('slider').getValue();
		$(this).closest('.slider').find(".slider-value").html(current+'%');
	});
}

/***************** Checkbox ***************************/

$(function () {
	$(".parent").click(function () {
		var id=$(this);
		if($(id).is(':checked')){
			$(id).closest('li').addClass('open');
			var forAttribute=id.attr('id');
			var checkedItems=$("input[for="+forAttribute+"]");
			$(checkedItems).each(function() {
				$( this ).trigger('click');
				$( this ).closest('li').addClass('open');
			});
			console.log('parent:checked')
		}
		else{
			var forAttribute=id.attr('id');
			var checkedItems=$("input:checked[for="+forAttribute+"]");
			$(checkedItems).each(function() {
				console.info($(this));
				$( this ).trigger('click');
			});
			$(this).closest('li').removeClass('open');
			console.log('parent:not checked')
		}
	});	
	
	$("input[for]").bind('click',function () {
		if($(this).is(':checked')){
			$(this).closest('li').addClass('open');
		}
		else{
			$(this).closest('li').removeClass('open');
		}
		var forAttribute=$(this).attr('for');
		var checkedItems=$("input:checked[for="+forAttribute+"]").length;

		$('input.parent').each(function(){
			if ($(this).siblings('ul').find('input:not(.parent):checked').length) {
				$(this).prop('checked', true);
			} else {
				$(this).prop('checked', false);
			}
		})
		// if(checkedItems>0){
		// 	$("#"+forAttribute).prop('checked', true);
		// 	$(this).parents('li.options').children('.parent').prop('checked', true);
		// 	console.log('input:check')

		// }
		// else{
		// 	$("#"+forAttribute).attr('checked', false);
		// 	$(this).parent('li.options').children('.parent').prop('checked', false);
		// 	console.log('input:uncheck')
		// }
	});
});
/************************************** Checkbox Initialization ************************/
setTimeout(initiate, 1000);
function initiate(id){
		var id=".parent";
	$(id).each(function() {
		var current=$(this);
		if($(current).is(':checked')){
			current.closest('li').addClass('open');
		}else{
			if(current.closest('li').hasClass('open'))
				current.closest('li').removeClass('open');
		}
		var forAttribute=current.attr('id');
		var checkedItems=$("input:checked[for="+forAttribute+"]");
		$(checkedItems).each(function() {
			$( this ).closest('li').addClass('open');
		});
	});	
};
$(document).ready(function(){
/*	var width=$( window ).width();
	if(width>767){
		if($('.map').hasClass('mmc')){ $('.map').addClass('mmc'); }
	}else{
		if($('.map').hasClass('mme')){ $('.map').addClass('mme'); }
	}*/
	$('#main-menu-toggle').click(function(){
		if(($('body.map').hasClass('mmc')) || ($('body.map').hasClass('mme'))){
			$('#main-menu-toggle .mm-text').hide().html('Sluit menu<i class="menu-icon fa fa-caret-left close-icon"></i>').fadeIn('slow');
			
		}else{
			$('#main-menu-toggle .mm-text').hide().html('Open menu<i class="menu-icon fa fa-caret-left close-icon"></i>').fadeIn('slow');
		}
	});
});

$(document).ready(function() {
	setTimeout(function(){
		if($('body.thumbs').hasClass('mmc')){
			$('body.thumbs').removeClass('mmc');
		}
	}, 200);



	var accordionsMenu = $('.map .mm-dropdown');

	if( accordionsMenu.length > 0 ) {
		
		accordionsMenu.each(function(){
			var accordion = $(this);
			//detect change in the input[type="checkbox"] value
			accordion.on('click', '> a', function(){
				var checkbox = $(this);
				checkbox.parent('.mm-dropdown').toggleClass('open');
				( checkbox.parent('.mm-dropdown').is('.open') ) ? checkbox.siblings('ul').attr('style', 'display:none;').slideDown(300, function(){checkbox.siblings('ul').removeAttr('style')}) : checkbox.siblings('ul').attr('style', 'display:block;').slideUp(300, function(){checkbox.siblings('ul').removeAttr('style')});
			});
		});
	}

	$('#main-menu-toggle').click(function(){
		$('body').toggleClass('mmc')
	})



	
});
