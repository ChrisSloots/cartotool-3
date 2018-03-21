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

/*
/* Init sliders and bind slider events to show percentage
 */
function initSlider(){
    $(".slider #slide").slider();
    $(".slider #slide").bind('slide click slideStart slideStop',function(){
        var current=$(this).data('slider').getValue();
        $(this).closest('.slider').find(".slider-value").html(current+'%');
    });
}

/*
 * Bind onclick event 
 */

$(function () {
//	$(".parent").click(function () {
//		var id=$(this);
//		if($(id).is(':checked')){
//			$(id).closest('li').addClass('open');
//			var forAttribute=id.attr('id');
//			var checkedItems=$("input[for="+forAttribute+"]");
//			$(checkedItems).each(function() {
//				$( this ).trigger('click');
//				$( this ).closest('li').addClass('open');
//			});
//		}
//		else{
//			var forAttribute=id.attr('id');
//			var checkedItems=$("input:checked[for="+forAttribute+"]");
//			$(checkedItems).each(function() {
//				console.info($(this));
//				$( this ).trigger('click');
//			});
//			$(this).closest('li').removeClass('open');
//		}
//	});	
	
	$("input[for]").bind('click',function () {
		if($(this).is(':checked')){
			//$(this).closest('li').addClass('open');
		}
		else{
			$(this).closest('li').removeClass('open');
		}
		var forAttribute=$(this).attr('for');
		var checkedItems=$("input:checked[for="+forAttribute+"]").length;
		if(checkedItems>0){
			$("#"+forAttribute).prop('checked', true);
		}
		else{
			$("#"+forAttribute).attr('checked', false);
		}
	});
});
/************************************** Checkbox Initialization ************************/
setTimeout(initiate, 1000);
function initiate(){
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
			//$( this ).closest('li').addClass('open');
		});
	});	
};

$(document).ready(function() {
	setTimeout(function(){
		if($('body.thumbs').hasClass('mmc')){
			$('body.thumbs').removeClass('mmc');
		}
	}, 200);
});

