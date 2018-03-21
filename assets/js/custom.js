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



/************ Opacity Slider *************/
function initSlider(){
	$(".slider #slide").slider();
	$('.slider #slide').bind('slide click slideStart slideStop',function(){
		var current=$(this).data('slider').getValue();
		$(this).closest('.slider').find(".slider-value").html(current+'%');
	});
}

function initEyes(){
    $('input.parent').each(function(){
        if ($(this).siblings('ul').find('input:not(.parent):checked').length) {
            // Invoke the click event to synch the layergroup
            $(this).prop('checked', false);
            $(this).trigger('click');
            //$(this).prop('checked', true);
        } else {
            $(this).prop('checked', false);
        }
    });
}

/***************** Checkbox ***************************/

$(function () {
	$(".parent").click(function () {
		var id=$(this);
		if($(id).is(':checked')){
			//$(id).closest('li').addClass('open');
			var forAttribute=id.attr('id');
			var checkedItems=$("input[for="+forAttribute+"]");
			$(checkedItems).each(function() {
				//$( this ).trigger('click');
				//$( this ).closest('li').addClass('open');
			});
			console.log('parent:checked');
		}
		else{
			var forAttribute=id.attr('id');
			var checkedItems=$("input:checked[for="+forAttribute+"]");
			$(checkedItems).each(function() {
				console.info($(this));
				//$( this ).trigger('click');
			});
			//$(this).closest('li').removeClass('open');
			console.log('parent:not checked');
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

		initEyes();
//		if(checkedItems>0){
//			$("#"+forAttribute).prop('checked', true);
//			$(this).parents('li.options').children('.parent').prop('checked', true);
//			console.log('input:check')
//
//		}
//		else{
//			$("#"+forAttribute).attr('checked', false);
//			$(this).parent('li.options').children('.parent').prop('checked', false);
//			console.log('input:uncheck')
//		}
	});
});
/************************************** Checkbox Initialization ************************/
setTimeout(initiate, 1000);
function initiate(id){
		var id=".parent";
	$(id).each(function() {
		var current=$(this);
		if($(current).is(':checked')){
			//current.closest('li').addClass('open');
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
    initEyes();
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
				( checkbox.parent('.mm-dropdown').is('.open') ) ? checkbox.siblings('ul').attr('style', 'display:none;').slideDown(300, function(){checkbox.siblings('ul').removeAttr('style');}) : checkbox.siblings('ul').attr('style', 'display:block;').slideUp(300, function(){checkbox.siblings('ul').removeAttr('style');});
			});
		});
	}

	$('#main-menu-toggle').click(function(){
		$('body').toggleClass('mmc');
	});



	
});
