$(document).ready(function() {
	$('.password-reset').click(function(){
		$('.login-form-container').toggleClass('reset-form');
	});
	$('.close-reset').click(function(){
		$('.login-form-container').removeClass('reset-form');
	});


	/*-------------------------------------------------------------------------------*/
	/*------------------------------ CHECKBOX ---------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	$('.table .custom-checkbox').click(function() {
		$(this).closest('.tr, .th').toggleClass('active');
		var $this = $(this);
		setTimeout(function(){

			if ($this.closest('.table').find('.custom-checkbox:checked').length) {
				$('[data-depend-from='+$this.closest('.table').attr('id')+']').removeClass('disabled');
				console.log('enabled')
			} else {
				$('[data-depend-from='+$this.closest('.table').attr('id')+']').addClass('disabled');
				console.log('disabled')
			}
			console.log($this.closest('.table').find('.custom-checkbox:checked').size())
		},100)
	})

	$('.table .th .custom-checkbox').click(function() {
		if($(this).closest('.th').is('.active')) {
			$(this).closest('.th').siblings('.tr').addClass('active');
			$(this).closest('.th').siblings('.tr').find('.custom-checkbox').prop('checked', true);
		} else {
			$(this).closest('.th').siblings('.tr').removeClass('active');
			$(this).closest('.th').siblings('.tr').find('.custom-checkbox').prop('checked', false);
		}
	})

	$('.table-header .custom-checkbox').click(function() {
		$(this).closest('.table-header').toggleClass('active');
		if($(this).closest('.table-header').is('.active')) {
			$(this).closest('.table-header').next('.table').children('.tr').addClass('active');
			$(this).closest('.table-header').next('.table').children('.tr').find('.custom-checkbox').prop('checked', true);
		} else {
			$(this).closest('.table-header').next('.table').children('.tr').removeClass('active');
			$(this).closest('.table-header').next('.table').children('.tr').find('.custom-checkbox').prop('checked', false);
		}
	})

	/*--- DATA TABLES ---*/

	$('.dataTables_scrollHead .custom-checkbox').click(function() {
		$(this).closest('.dataTables_scrollHead').toggleClass('active');
		if($(this).closest('.dataTables_scrollHead').is('.active')) {
			$(this).closest('.dataTables_scrollHead').next('.dataTables_scrollBody').find('tr').addClass('active');
			$(this).closest('.dataTables_scrollHead').next('.dataTables_scrollBody').find('tr').find('.custom-checkbox').prop('checked', true);
		} else {
			$(this).closest('.dataTables_scrollHead').next('.dataTables_scrollBody').find('tr').removeClass('active');
			$(this).closest('.dataTables_scrollHead').next('.dataTables_scrollBody').find('tr').find('.custom-checkbox').prop('checked', false);
		}
	})

	$('.dataTables_scroll .custom-checkbox').click(function() {
		// $(this).closest('tr').toggleClass('active');
		var $this = $(this);
		setTimeout(function(){

			if ($this.closest('.dataTables_scroll').find('.custom-checkbox:checked').length) {
				$('[data-depend-from='+$this.closest('.dataTables_wrapper').attr('id')+']').removeClass('disabled');
				console.log('enabled')
			} else {
				$('[data-depend-from='+$this.closest('.dataTables_wrapper').attr('id')+']').addClass('disabled');
				console.log('disabled')
			}
			console.log($this.closest('.table').find('.custom-checkbox:checked').size())
		},100)
	})


	/*-------------------------------------------------------------------------------*/
	/*----------------------------- DATEPICKER --------------------------------------*/
	/*-------------------------------------------------------------------------------*/
	
	if($('.date-picker').length) {
		$('.date-picker').datepicker();
	}
	/*-------------------------------------------------------------------------------*/
	/*---------------------------- HTML EDITOR --------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	if($('.wysihtml').length) {
		$('.wysihtml').wysihtml5();
	}




	/*-------------------------------------------------------------------------------*/
	/*---------------------------- ADD NEW FASE -------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	var newFaseTemplate = '<div class="fase-block">'+
							'<div class="block bordered border-orange">'+
						     '<div class="fase"><span class="inline-edit">New Fase</span><div class="pull-right"><span class="inline-edit">20</span> weken</div></div>'+
						  	'</div>'+
						  	'<div class="field-container"></div>'+
						  	'<a class="btn outlined add-new-field">add new field</a>'+
						  '</div>';
	$('#content').on('click', '.add-new-fase', function() {
		$(this).before(newFaseTemplate);
	})

	/*-------------------------------------------------------------------------------*/
	/*---------------------------- ADD NEW FASE -------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	var newGroupTemplate = '<div class="table-wrapper new" style="display:none;">'+
								'<div class="table pool-table" id="table1">'+
									'<div class="th">'+
										'<div><input type="checkbox" class="custom-checkbox" /></div>'+
										'<div>No</div>'+
										'<div>Naam zwembad</div>'+
										'<div>Telefoon</div>'+
										'<div>Locatie</div>'+
										'<div>Opmerkingen</div>'+
									'</div>'+
								'</div>'+
								'<a class="btn" href="#">add from list</a>'+
								'<a class="btn" href="#">add from row</a>'+
								'<div class="space h20"></div>'+
							'</div>';
	$('#content').on('click', '.add-new-group', function() {
		$(this).before(newGroupTemplate);
		checkboxInit();
		$('.table-wrapper.new').css('opacity',0).slideDown(400).animate({opacity:1},300).removeClass('new');
	});

	/*-------------------------------------------------------------------------------*/
	/*---------------------------- ADD NEW field -------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	var newfieldTemplate = '<div class="field"><span class="number"></span><span class="inline-edit" style="display:none;">New field</span>'+
							'<div class="edit-block">'+
								'<form class="edit-form">'+
									'<input type="text" value="New field">'+
									'<button type="submit" class="btn save-edit"><i class="fa fa-check"></i></button>'+
									'<button type="button" class="btn close-edit"><i class="fa fa-close"></i></button>'+
								'</form></div>'+
							'</div>';
	$('#content').on('click', '.add-new-field', function() {
		$('#content').find('.save-edit').click();
		$(this).prev('.field-container').append(newfieldTemplate);
		$('.edit-block').find('input').focus();
		$('.edit-block').siblings('.number').html($(this).prev('.field-container').find('.field').size());
	});



	/*-------------------------------------------------------------------------------*/
	/*---------------------------- FORM VALIDATION ----------------------------------*/
	/*-------------------------------------------------------------------------------*/


	var validator = $(".form-validate").validate();

	jQuery.extend(jQuery.validator.messages, {
    required: "Graag invullen"
});
	/*-------------------------------------------------------------------------------*/
	/*------------------------------- CHARPICKER ------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	$('.charpicker').click(function() {
		var $this = $(this)
		$.getJSON( "js/char.json", function( data ) {
		  var items = [];
		  $.each( data, function( key, val ) {
		    items.push( "<li id='" + key + "'>" + val + "</li>" );
		  });
		 
		  $( "<div/>", {
		    "class": "characters",
		    "data-id": $this.data('id'),
		    html: '<ul>' + items.join( "" ) + '</ul>'
		  }).insertAfter( $this );
		});
	})

	$('#content').on('click', '.characters li', function() {
		copyToClipboard($(this))
		console.log($(this).closest('.characters').data('id'))
	})

	function copyToClipboard(element) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}

	$('#content').on('mouseover', '.characters', function(){
		$(this).removeClass('out')
	})
	$('#content').on('mouseout', '.characters', function(){
		$(this).addClass('out')
	})
	$('body').click(function(){
		$('.characters.out').animate({opacity:0},300, function(){$('.characters').remove()});
	});

	$('#content').on('click', '.characters li', function(){
		var $this = $(this);
		$('body').append('<div class="message">'+$this.html()+' Copied to clipboard</div>')
		setTimeout( function() {$('.message').addClass('active')},100)
		setTimeout(function() {
			$('.message').removeClass('active')
		},3000)
		setTimeout( function() {$('.message').remove()},3100)
	})














// $('#success-text').slideUp(0); 
//    $('#reset-pass').ajaxForm({ 
//         // target identifies the element(s) to update with the server response 
 
//         // success identifies the function to invoke when the server response 
//         // has been received; here we apply a fade-in effect to the new content 
//         success: function() { 
//             $('#success-text').addClass('active'); 
//             $('#success-text').slideDown(300); 
//         } 
//     }); 




	/*---------------------------------------------------------------------------------*/
	/*------------------------------- DATA TABLES -------------------------------------*/
	/*---------------------------------------------------------------------------------*/

	// $('.dataTables_scrollHead td').each(function() {
	// 	var padding = $(this).outerWidth() - $(this).width();
	// 	$(this).width($(this).closest('.dataTables_scrollHead').next('.dataTables_scrollBody').find('table td').eq($(this).index()).outerWidth()-padding)
	// })
	// setTimeout(function(){
	// 	$('div.dataTables_scrollHead table thead tr td:last-child').width($('div.dataTables_scrollHead table thead tr td:last-child').width()-2)
	// },500)
	// $(window).resize(function(){
	// 	var padding = $(this).outerWidth() - $(this).width();
	// 	$(this).width($(this).closest('.dataTables_scrollHead').next('.dataTables_scrollBody').find('table td').eq($(this).index()).outerWidth()-padding)
	// })











	/*-------------------------------------------------------------------------------------------*/
	/*-------------------------------------------------------------------------------------------*/
	/*--------------------------------------- CONTEXT -------------------------------------------*/
	/*-------------------------------------------------------------------------------------------*/
	/*-------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------*/
	/*------------------------------------ RADIO BUTTONS ----------------------------------------*/
	/*-------------------------------------------------------------------------------------------*/

	function initRadio() {
		$('input[type=radio]').each(function() {
			$(this).wrap('<div class="radio-wrapper"></div>');
			$(this).after('<span></span>');
		})
	}
	initRadio();


	var table = $('#example').DataTable( {
        "order": [[ 0, "asc" ]]
    } );

    table.on( 'page.dt', function () {
		setTimeout(function(){
			deleteBtn() 
			console.log('deletee act')
		},500)
	} );
    table.on( 'order', function ( e, details, changes ) {
		setTimeout(function(){
			deleteBtn()
			console.log('deletee act')
		},500)
	} );

    $('.dataTables_filter label').append('<i class="fa fa-close"></i>')
    $('.dataTables_filter label i').click(function(){
    	$(this).siblings('input').val('')
    	setTimeout(function(){
    		table.search('').draw();
    	},100)
    })
	table.on( 'search.dt', function () {
	    if (!table.search() == '') {
	    	$('.dataTables_filter').addClass('active-search')
	    } else {
	    	$('.dataTables_filter').removeClass('active-search')
	    }
	} );
	/*-------------------------------------------------------------------------------------------*/
	/*------------------------------------- PRETTYPHOTO -----------------------------------------*/
	/*-------------------------------------------------------------------------------------------*/

     $("a[rel^='prettyPhoto']").prettyPhoto();

	/*-------------------------------------------------------------------------------------------*/
	/*--------------------------------------- SELECTS -------------------------------------------*/
	/*-------------------------------------------------------------------------------------------*/

	function selectInit() {
		$('select').not('.multi-select').each(function() {
			var select = $(this);
			select.wrap('<div class="select"></div>');
			select.parent('.select').append('<div class="active-option"></div><div class="options"></div>');
			select.siblings('.active-option').append(select.find('option:selected').text());
			select.find('option').each(function() {
				$(this).closest('.select').find('.options').append('<a>'+$(this).text()+'</a>')
			});
			select.siblings('.options').find('a').click(function() {
				$(this).closest('.select').find('.active-option').html($(this).text());
				$(this).closest('.select').find('select option').removeAttr('selected')
				$(this).closest('.select').find('select option').eq($(this).index()).attr('selected','selected')
				$(this).closest('.select').find('select').trigger('change');
				$(this).closest('.select').removeClass('active');
			});
		})
		$('.active-option').click(function() {
			$(this).parent('.select').toggleClass('active');
		})
		if($('.multi-select').length) {
			$('.multi-select').multiSelect()
		}
	}


	setTimeout(selectInit, 100);

	/*-------------------------------------------------------------------------------*/
	/*-------------------------------- TOOLTIPS -------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

	/*-------------------------------------------------------------------------------*/
	/*-------------------------------- File upload -------------------------------------*/
	/*-------------------------------------------------------------------------------*/



	function readImage(file, elem) {

	    var reader = new FileReader();
	    var image  = new Image();

	    reader.readAsDataURL(file);  
	    reader.onload = function(_file) {
	        image.src    = _file.target.result;              // url.createObjectURL(file);
	        image.onload = function() {
	            var w = this.width,
	                h = this.height,
	                t = file.type,                           // ext only: // file.type.split('/')[1],
	                n = file.name,
	                s = ~~(file.size/1024) +'KB';
	            elem.find('.uploadPreview').html('<img style="display:none;" src="'+ this.src +'">  <span class="image-size">'+s+'</span>');
	            elem.addClass('uploaded');
	            elem.find('.uploadPreview img').fadeIn(300)
	        };
	        image.onerror= function() {
	            alert('Invalid file type: '+ file.type);
	        };      
	    };

	}

	function initFileUpload(el) {

		el.each(function(){
			var elem = $(this)
			elem.find(".upload-image").change(function (e) {
				var ext = $(this).val().split('.').pop().toLowerCase();
				if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
					var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
					$(this).siblings('.upload-field').find('.image-title').html(filename);
					elem.addClass('uploaded file-upload');
				    // alert('invalid extension!');
				} else {
				    // alert('valid extension!');
				    if(this.disabled) return alert('File upload not supported!');
				    var F = this.files;
				    if(F && F[0]) for(var i=0; i<F.length; i++) readImage( F[i], elem );
				    console.log(elem.closest('.form-group').index())
				    elem.removeClass('file-upload');
				}
			});
			elem.find('.upload-field .change, .upload-field .add').click(function(){
				elem.find('.upload-image').click();
				console.log(elem.find('.upload-image').length)
			})
			elem.find('.upload-field .delete').click(function(){
				elem.removeClass('uploaded');
				elem.find('.uploadPreview').html('')
			})
			
		})
	}
	initFileUpload($('.upload-image-wrapper'));



	/*-------------------------------------------------------------------------------*/
	/*------------------------------- INPUT FILE ------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	$('.add-files').click(function(){
		$(this).find('input').trigger('click')
	})
	$('.add-files input').click(function(e){
		e.stopImmediatePropagation();
	})
	$('.add-files input').change(function(e){
		var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
		$(this).after('<p>'+filename+'</p>');
	})



	/*-------------------------------------------------------------------------------*/
	/*-------------------------------- HANDLES -------------------------------------*/
	/*-------------------------------------------------------------------------------*/


    // Handles portlet tools & actions
    var handlePortletTools = function() {
        // handle portlet remove
        $('body').on('click', '.portlet > .portlet-title > .tools > a.remove', function(e) {
            e.preventDefault();
            var portlet = $(this).closest(".portlet");

            if ($('body').hasClass('page-portlet-fullscreen')) {
                $('body').removeClass('page-portlet-fullscreen');
            }

            portlet.find('.portlet-title .fullscreen').tooltip('destroy');
            portlet.find('.portlet-title > .tools > .reload').tooltip('destroy');
            portlet.find('.portlet-title > .tools > .remove').tooltip('destroy');
            portlet.find('.portlet-title > .tools > .config').tooltip('destroy');
            portlet.find('.portlet-title > .tools > .collapse, .portlet > .portlet-title > .tools > .expand').tooltip('destroy');

            portlet.remove();
        });

        // handle portlet fullscreen
        $('body').on('click', '.portlet > .portlet-title .fullscreen', function(e) {
            e.preventDefault();
            var portlet = $(this).closest(".portlet");
            if (portlet.hasClass('portlet-fullscreen')) {
                $(this).removeClass('on');
                portlet.removeClass('portlet-fullscreen');
                $('body').removeClass('page-portlet-fullscreen');
                portlet.children('.portlet-body').css('height', 'auto');
            } else {
                var height = App.getViewPort().height -
                    portlet.children('.portlet-title').outerHeight() -
                    parseInt(portlet.children('.portlet-body').css('padding-top')) -
                    parseInt(portlet.children('.portlet-body').css('padding-bottom'));

                $(this).addClass('on');
                portlet.addClass('portlet-fullscreen');
                $('body').addClass('page-portlet-fullscreen');
                portlet.children('.portlet-body').css('height', height);
            }
        });

        $('body').on('click', '.portlet > .portlet-title > .tools > a.reload', function(e) {
            e.preventDefault();
            var el = $(this).closest(".portlet").children(".portlet-body");
            var url = $(this).attr("data-url");
            var error = $(this).attr("data-error-display");
            if (url) {
                App.blockUI({
                    target: el,
                    animate: true,
                    overlayColor: 'none'
                });
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: url,
                    dataType: "html",
                    success: function(res) {
                        App.unblockUI(el);
                        el.html(res);
                        App.initAjax() // reinitialize elements & plugins for newly loaded content
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        App.unblockUI(el);
                        var msg = 'Error on reloading the content. Please check your connection and try again.';
                        if (error == "toastr" && toastr) {
                            toastr.error(msg);
                        } else if (error == "notific8" && $.notific8) {
                            $.notific8('zindex', 11500);
                            $.notific8(msg, {
                                theme: 'ruby',
                                life: 3000
                            });
                        } else {
                            alert(msg);
                        }
                    }
                });
            } else {
                // for demo purpose
                App.blockUI({
                    target: el,
                    animate: true,
                    overlayColor: 'none'
                });
                window.setTimeout(function() {
                    App.unblockUI(el);
                }, 1000);
            }
        });

        // load ajax data on page init
        $('.portlet .portlet-title a.reload[data-load="true"]').click();

        $('body').on('click', '.portlet > .portlet-title > .tools > .collapse, .portlet .portlet-title > .tools > .expand', function(e) {
            e.preventDefault();
            var el = $(this).closest(".portlet").children(".portlet-body");
            if ($(this).hasClass("collapse")) {
                $(this).removeClass("collapse").addClass("expand");
                el.slideUp(200);
            } else {
                $(this).removeClass("expand").addClass("collapse");
                el.slideDown(200);
            }
        });
    };


    handlePortletTools(); 


    /*-----------------------------*/




    var UITree = function () {

    var handleSample1 = function () {

        $('#tree_1').jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }            
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "plugins": ["types"]
        });

        // handle link clicks in tree nodes(support target="_blank" as well)
        $('#tree_1').on('select_node.jstree', function(e,data) { 
            var link = $('#' + data.selected).find('a');
            if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                if (link.attr("target") == "_blank") {
                    link.attr("href").target = "_blank";
                }
                document.location.href = link.attr("href");
                return false;
            }
        });

        $('#tree_1 .fa-folder').parent('.jstree-anchor').append('<i class="fa fa-trash"></i>')
    }

    return {
        //main function to initiate the module
        init: function () {
			if($('#tree_1').length) {
            	handleSample1();
            }

        }

    };

}();
  
       UITree.init();


$('#content').on('click','.jstree-anchor',function(){
	var url = $(this).parent('li').data('url');
	$('.container').load(url, function(){
		console.log('loaded')
		selectInit();
		initRadio();
		initFileUpload($('.upload-image-wrapper'));
		countRows()
		checkboxInit();
		deleteBtn();
		// disableDependedEl();
		setTimeout(function(){
			$('[data-depends]:checked').each(function(){
				$($(this).data('depends')).attr('readonly','')
			})
		},0)
	})
})



	/*-------------------------------------------------------------------------------*/
	/*-------------------------- ADD NEW IMAGE FIELD --------------------------------*/
	/*-------------------------------------------------------------------------------*/

	var newImageFieldTemplate = '<tr>'+
				                    '<td>1</td>'+
				                    '<td>'+
				                        '<img src="images/cow.jpg" alt=""/> '+
				                        '<span href="#" class="open-thumbs-library popup">Title</span>'+
				                    '</td>'+
				                    '<td><span class="inline-edit">Beschrijving</span></td>'+
				                    '<td><span class="inline-edit">Opmerking</span></td>'+
				                    '<td><a class="remove-image-row fa fa-minus"></a></td>'+
				               ' </tr>';

	$('#content').on('click', '.add-image-row', function() {
		// $('#content').find('.save-edit').click();
		$(this).prev('table').find('tbody').append(newImageFieldTemplate);
		countRows()
		// $('.edit-block').find('input').focus();
		// $('.edit-block').siblings('.number').html($(this).prev('.field-container').find('.field').size());
	});

	$('#content').on('click', '.remove-image-row', function() {
		// $('#content').find('.save-edit').click();
		$(this).closest('tr').remove();
		// $('.edit-block').find('input').focus();
		// $('.edit-block').siblings('.number').html($(this).prev('.field-container').find('.field').size());
	});


	/*-------------------------------------------------------------------------------*/
	/*------------------------------ EDITABLE ---------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	function getEditTemplate(el) {
		var template = '<div class="edit-block">'+
							'<form class="edit-form">'+
								'<input type="text" value="'+el+'">'+
								'<button type="submit" class="btn save-edit"><i class="fa fa-check"></i></button>'+
							'</form>'+
						'</div>';
		return template;
	}
	$('#content').on('click', '.inline-edit', function() {
		var el = $(this),
			editTemplate = getEditTemplate(el.html());
		el.hide().after(editTemplate);
	})
	$('#content').on('click', '.close-edit', function() {
		$(this).closest('.edit-block').prev().show();
			$(this).closest('.field').remove();
	});
	$('#content').on('click', '.save-edit', function() {
		$(this).closest('.edit-block').prev().show().html($(this).siblings('input').val());
		$(this).closest('.edit-block').remove();
		console.log('save')
		return false;
	});

	/*-------------------------------------------------------------------------------*/
	/*---------------------------- THUMBS LIBRARY ------------------------------------*/
	/*-------------------------------------------------------------------------------*/
	$('body').append('<div class="media-library-overlay"><div class="media-library-container"></div></div>')
	var el;
	$('#content').on('click', '.open-thumbs-library', function(){
		el = $(this);
		console.log(el)

		$('.media-library-container').load('media-thumbs.html', function(){
			loaded();
		});
		if($(this).is('.popup')) {
			$('.media-library-overlay').addClass('popup');
		} else {
			$('.media-library-overlay').removeClass('popup');
		}
		setTimeout(function(){
			$('.media-library-overlay').addClass('active');
		},100)
		return el;
	})

	$('#content').on('click', '.open-media-thumbs-btn', function(){
		$(this).siblings('.open-thumbs-library').trigger('click');
	})

	$('.media-library-container').on('click', 'a', function(){
		el.html($(this).find('h4').html())
		el.siblings('img').attr('src', $(this).find('img').attr('src'))
		el.next('input').val($(this).find('h4').html())
		$('.media-library-overlay').removeClass('active');
		console.log(el)
		return false;
	})

	function countRows() {
		$('.count-rows').find('tr').each(function(){
			$(this).children('td').eq(0).html($(this).index()+1)
		})
	}


	/*-------------------------------------------------------------------------------*/
	/*---------------------------- MEDIA LIBRARY ------------------------------------*/
	/*-------------------------------------------------------------------------------*/
	$('body').append('<div class="media-library-overlay"><div class="media-library-container"></div></div>')
	var el;
	$('#content').on('click', '.open-media-library', function(){
		el = $(this);
		console.log(el)

		$('.media-library-container').load('media-library.html', function(){
			loaded();
		});
		if($(this).is('.popup')) {
			$('.media-library-overlay').addClass('popup');
		} else {
			$('.media-library-overlay').removeClass('popup');
		}
		setTimeout(function(){
			$('.media-library-overlay').addClass('active');
		},100)
		return el;
	})

	$('#content').on('click', '.open-media-library-btn', function(){
		$(this).siblings('.open-media-library').trigger('click');
	})

	$('.media-library-container').on('click', 'a', function(){
		el.html($(this).find('h4').html())
		el.siblings('img').attr('src', $(this).find('img').attr('src'))
		el.next('input').val($(this).find('h4').html())
		$('.media-library-overlay').removeClass('active');
		console.log(el)
		return false;
	})

	function countRows() {
		$('.count-rows').find('tr').each(function(){
			$(this).children('td').eq(0).html($(this).index()+1)
		})
	}

	
	/*-------------------------------------------------------------------------------*/
	/*------------------------------ DEPENDS ---------------------------------------*/
	/*-------------------------------------------------------------------------------*/


	function disableDependedEl(el) {

		el.closest('.input-fields').find('[data-depends]').each(function(){
			$($(this).data('depends')).removeAttr('readonly')
		})

		if(el.length && el.is(':checked')) {
			$(el.data('depends')).attr('readonly','')
			console.log('checked - ' + $(el.data('depends')))
		} else {
			$(el.data('depends')).removeAttr('readonly')
			console.log('unchecked - ' + $(el.data('depends')))
		}
	}

	$('#content').on('change', '[data-depends]', function(e) {
		disableDependedEl($(this))
		e.stopPropagation();
	})



	/*-------------------------------------------------------------------------------*/
	/*---------------------------------- MENU ---------------------------------------*/
	/*-------------------------------------------------------------------------------*/

$('.menu-sidebar li:not(.open) > ul').slideUp(0)
		$('.menu-sidebar li').each(function(){
			var accordion = $(this);
			if (accordion.children('ul').length) {
				accordion.append('<span class="fa fa-angle-right"></span>')
			}
			accordion.on('click', '> .fa', function(){
				var checkbox = $(this);
				checkbox.closest('li').toggleClass('open');
				( checkbox.closest('li').is('.open') ) ? checkbox.siblings('ul').attr('style', 'display:none;').slideDown(300, function(){checkbox.siblings('ul').removeAttr('style')}) : checkbox.siblings('ul').attr('style', 'display:block;').slideUp(300, function(){checkbox.siblings('ul').removeAttr('style')});
			});
		});



	/*-------------------------------------------------------------------------------*/
	/*------------------------------- ISCROLL ---------------------------------------*/
	/*-------------------------------------------------------------------------------*/

var myScroll;

function loaded() {
	myScroll = new IScroll('.media-library-container', {
		scrollbars: true,
		mouseWheel: true,
		interactiveScrollbars: true,
		shrinkScrollbars: 'scale',
		fadeScrollbars: true
	});
	console.log('iscroll')
}


	/*-------------------------------------------------------------------------------*/
	/*------------------------------ CHECKBOX ---------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	function checkboxInit() {
		$('.custom-checkbox').each(function() {
			if(!$(this).parent().is('.checkbox-wrapper')) {
				$(this).wrap('<div class="checkbox-wrapper"></div>');
				$(this).after('<span></span>');
			}
		})
	}
	checkboxInit();



	/*-------------------------------------------------------------------------------*/
	/*------------------------------ DELETE ROW -------------------------------------*/
	/*-------------------------------------------------------------------------------*/

	function deleteBtn() {
		$('.fa-trash, .delete-validation').click(function(e){
			e.stopImmediatePropagation();
            e.preventDefault();
			deleteRow(table.row( $(this).closest('tr') ))
			return false;
		})

	}
	deleteBtn();
	

	function deleteRow(roww) {
		$('body').append('<div class="popup-overlay"><div class="popup-container"><span class="close">X</span><h3>wilt u deze verwijderen?</h3><div class="clear"></div><a class="btn btn-red outlined delete-row">Delete</a></div></div>')
		setTimeout(function(){
			$('.popup-overlay').addClass('active');
		},100)
		$('.delete-row').click(function(){
			roww.remove().draw();
			
			$('.popup-overlay').removeClass('active');
			setTimeout(function(){
				$('.popup-overlay').remove()
			},300)
		})
		$('.popup-container .close').click(function(e){
			$('.popup-overlay').removeClass('active');
			setTimeout(function(){
				$('.popup-overlay').remove()
			},300)
			return false;
		})
		console.log('deletee')
	}


});