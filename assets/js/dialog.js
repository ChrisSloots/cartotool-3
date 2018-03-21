function initialize() {
  $('body').on('click', 'a#close', function(e) {
    e.stopPropagation();
    const $dialog = $(e.target).closest('.ui-dialog').find('.dialog');
    const id = $dialog.attr('id');
    $('a[href="#'+id+'"]').remove();
    $('a.'+id).data('dialog', null);
    $dialog.dialog('destroy');
  });
  $('body').on('click', 'a#minimize', function(e) {
    e.stopPropagation();
    $(e.target).closest('.ui-dialog').hide();
  });
  $('body').on('click', 'a.dialog-opener', function(e) {
    e.preventDefault();
    const id = $(this).attr('href');
    $(id).closest('.ui-dialog').show().find('.dialog').dialog('moveToTop');
  });
}

function mppng_open_simple($title, $html)
{
  const id = 'dialog_' + new Date().getTime();


  const $elem = $('<div id="'+id+'" class="dialog iframe-container"><div id="popup"></div></div>');
  $elem.dialog({autoOpen: false});

  const $navbar = $('#main-navbar ul.nav.navbar-nav:first');
  $navbar.append('<li><a href="#' + id + '" class="dialog-opener"><i class="fa fa-folder-o"></i></a></li>');
  
    $elem.find("div#popup").html($html);
    //$elem.find("div").load(function() {
    $elem.dialog("option", {
      title: $title,
      minWidth: '300px',
      width: '20vw',
    }).dialog("open");

    const $widget = $elem.dialog("widget");

    $widget.css({height: 350});
    $elem.dialog("option", "position", { my: "center+"+center+" top+" + topper, at: "center top+70", of: window });
    //alert("center+"+center+" top+" + topper);
    center += offset;
    topper += offset;

    if ($widget.find(".ui-dialog-titlebar-close").length === 0) {
      return;
    }

    $widget.find(".ui-dialog-titlebar-close").remove();
    $widget.find(".ui-dialog-titlebar").append(
      '<a id="close" title="Close">' + 
        '<i class="fa fa-close"></i>' +
      '</a>' +
      '<a id="minimize" title="Minimize">' + 
        '<i class="fa fa-minus"></i>' +
      '</a>'
    );
//})
    }

function mppng_open_streetview(lon, lat)
{
  const id = 'dialog_' + new Date().getTime();
  //$link.data('dialog', id);
  //$link.addClass(id);
  href = 'streetview.php?lon=' + lon.toString() + "&lat=" + lat.toString();
  const $elem = $('<div id="'+id+'" class="dialog iframe-container"><iframe class="dialog-iframe" src="' + href + '"></iframe></div>');
  $elem.dialog({autoOpen: false});

  const $navbar = $('#main-navbar ul.nav.navbar-nav:first');
  $navbar.append('<li><a href="#' + id + '" class="dialog-opener"><i class="fa fa-folder-o"></i></a></li>');
  
    $elem.find("iframe").load(function() {

    $elem.dialog("option", {
      title: "StreetView",
      minWidth: 300,
      width: '50vw'
    }).dialog("open");

    const $widget = $elem.dialog("widget");

    //$widget.css({height: contents.find("body")[0].scrollHeight + 60});
    $widget.css({height: 450});
    $elem.dialog("option", "position", { my: "center", at: "center", of: window });

    if ($widget.find(".ui-dialog-titlebar-close").length === 0) {
      return;
    }

    $widget.find(".ui-dialog-titlebar-close").remove();
    $widget.find(".ui-dialog-titlebar").append(
      '<a id="close" title="Close">' + 
        '<i class="fa fa-close"></i>' +
      '</a>' +
      '<a id="maximize" target="_blank" href="'+href+'" title="Maximize">' + 
        '<i class="fa fa-expand"></i>' +
      '</a>' +
      '<a id="minimize" title="Minimize">' + 
        '<i class="fa fa-minus"></i>' +
      '</a>'
    );
  });
}

var center = 0;
var topper = 0;
var offset = 25;

function mppng_open($title, $url) {
  const id = 'dialog_' + new Date().getTime();
  //$link.data('dialog', id);
  //$link.addClass(id);
  href = $url;
  const $elem = $('<div id="'+id+'" class="dialog iframe-container"><iframe class="dialog-iframe" src="' + href + '"></iframe></div>');
  $elem.dialog({autoOpen: false});

  const $navbar = $('#main-navbar ul.nav.navbar-nav:first');
  $navbar.append('<li><a href="#' + id + '" class="dialog-opener"><i class="fa fa-folder-o"></i></a></li>');
  
    $elem.find("iframe").load(function() {
    //const contents = $elem.find('iframe').contents();

    $elem.dialog("option", {
      title: $title,
      minWidth: '300px',
      width: '60vw'
    }).dialog("open");

    const $widget = $elem.dialog("widget");

    //$widget.css({height: contents.find("body")[0].scrollHeight + 60});
    $widget.css({height: 550});
    $elem.dialog("option", "position", { my: "center+"+center+" top+" + topper, at: "center top+70", of: window });
    //alert("center+"+center+" top+" + topper);
    center += offset;
    topper += offset;

    if ($widget.find(".ui-dialog-titlebar-close").length === 0) {
      return;
    }

    $widget.find(".ui-dialog-titlebar-close").remove();
    $widget.find(".ui-dialog-titlebar").append(
      '<a id="close" title="Close">' + 
        '<i class="fa fa-close"></i>' +
      '</a>' +
      '<a id="maximize" target="_blank" href="'+href+'" title="Maximize">' + 
        '<i class="fa fa-expand"></i>' +
      '</a>' +
      '<a id="minimize" title="Minimize">' + 
        '<i class="fa fa-minus"></i>' +
      '</a>'
    );
  });

}

function open($link) {
  if (i = $link.data('dialog')) return $('#'+i).closest('.ui-dialog').show().find('.dialog').dialog('moveToTop');

  const id = 'dialog_' + new Date().getTime();
  $link.data('dialog', id);
  $link.addClass(id);
  href = $link.attr('href');
  const $elem = $('<div id="'+id+'" class="dialog iframe-container"><iframe class="dialog-iframe" src="' + href + '"></iframe></div>');
  $elem.dialog({autoOpen: false});

  const $navbar = $('#main-navbar ul.nav.navbar-nav:first');
  $navbar.append('<li><a href="#' + id + '" class="dialog-opener"><i class="fa fa-folder-o"></i></a></li>');

  $elem.find("iframe").load(function() {
    const contents = $elem.find('iframe').contents();

    $elem.dialog("option", {
      // title: contents.find("title").html(),
      minWidth: 300,
      width: '70vw'
    }).dialog("open");

    const $widget = $elem.dialog("widget");

    $widget.css({height: contents.find("body")[0].scrollHeight + 60});
    $elem.dialog("option", "position", { my: "center", at: "center", of: window });

    if ($widget.find(".ui-dialog-titlebar-close").length === 0) {
      return;
    }

    $widget.find(".ui-dialog-titlebar-close").remove();
    $widget.find(".ui-dialog-titlebar").append(
      '<a id="close" title="Close">' + 
        '<i class="fa fa-close"></i>' +
      '</a>' +
      '<a id="maximize" target="_blank" href="'+href+'" title="Maximize">' + 
        '<i class="fa fa-expand"></i>' +
      '</a>' +
      '<a id="minimize" title="Minimize">' + 
        '<i class="fa fa-minus"></i>' +
      '</a>'
    );
  });
}

function minimize(widget) {

}

$(function() {
  initialize();
  $('a.dialog').click(function(e) {
    e.preventDefault();
    open($(this));
  });
});
