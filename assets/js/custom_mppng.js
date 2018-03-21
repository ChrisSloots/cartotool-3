/**
 * Bind eventhandler to submit form
 */
$( '.login-form' ).submit(function( event ) {
  check_username_password();
  event.preventDefault();
});

/**
 * Check username / password
 */
function check_username_password(){  
  
        //get the username  
        var email = $('#email').val();  
        var password = $('#password').val();  
  
        //use ajax to run the check  
        $.post("check_username_password.php", { username: email, password: password },  
            function(result){  
                //if the result is 1  
                if(result == 1){  
                    // valid user -> show project page
                    window.location.replace("projects_overview.php");
                }else{  
                    // invalid user -> refuse
                    window.alert("Gebruikersnaam/wachtwoord onbekend!");  
                }  
        });  
}

/**
 * Perform a logout
 * @param {type} url
 * @returns {undefined}
 */
function logout(url)
{
    document.location = url;
}

function confirm_alert(text) {
    return confirm(text);
}



var exportPNGElement = document.getElementById('export-png');
// Tijdelijk uitgezet => gaf error waardoor zindex niet meer werd gezet
//if ('download' in exportPNGElement) {
//  exportPNGElement.addEventListener('click', function(e) {
//    map.once('postcompose', function(event) {
//      var canvas = event.context.canvas;
//      exportPNGElement.href = canvas.toDataURL('image/png');
//    });
//    map.renderSync();
//  }, false);
//} else {
//  var info = document.getElementById('no-download');
//  /**
//   * display error message
//   */
//  info.style.display = '';
//}


/*
 * 
 */
var zindex = 9999;
function mppngBindInputs(id, layer) {
    layerid = "#opacity-check" + id.toString();
    //alert(id);
    var visibilityInput = $(layerid);
    
    // Bind onchange event to make the checkbox work
    visibilityInput.on('change', function() { 
        layer.setVisible(this.checked);	  
        // Set z-index to make the clicked layer always visible
        if (this.checked && layer.get('baselayer') === 0)
        {
            layer.setZIndex(zindex);
            zindex++;
        }
    });
    
    // Show/hide layer in synch with the checkbox
    layer.setVisible(visibilityInput.prop('checked'));
    
    // Bind the slider
    $.each(['opacity'], //['opacity', 'hue', 'saturation', 'contrast', 'brightness']
      function(i, v) {
            var input = $('.opacity-slider' + id);
            //alert(input);
            
            // Bind slider event
            input.on('change', function() {
                slide=$(this).data('slider').getValue();
                layer.set(v, parseFloat(slide/100));
            });
            
            // Set initial value
            //input.val(String(layer.get(v)));
      }
    );
}


function traverseLayers(layers, idxObj)
{
    layers.forEach(function(layer, i) {
        if (layer instanceof ol.layer.Group) {
            // Traverse children
            //alert("Group: " + idxObj.index);
            mppngBindInputs(idxObj.index, layer);
            idxObj.index++;
            traverseLayers(layer.getLayers(), idxObj);
        }
        else
        {
            // Bind
            //alert(layer.get('title') + ": " + idxObj.index);
            mppngBindInputs(idxObj.index, layer);
            idxObj.index++;
        }
    });
}
        
//function initOpacity()
//{
//    map.getLayers().forEach(function(layer, i) {
//        if (layer instanceof ol.layer.Group) {
//        layer.getLayers().forEach(function(sublayer, j) {
//          bindInputs('#opacity-check'+(j+1), sublayer);
//        });
//        }
//    });
//}
//
//function FindLayerByName(layers, layername)
//{
//    layers.forEach(function(layer, i) {
//        if (layer instanceof ol.layer.Group) {
//            return FindLayerByName(layer.getLayers(), layername);
//        }
//        else
//        {
//            if (layer.get('title') === layername)
//            {
//                result = layer;
//                return;
//            }    
//        }
//    });
//    return result;
//}
    


function sendForm(url, form_id, message) {
    //alert(jQuery(form_id).serialize());
    $.ajax({
    type: "POST",
    url: url,
    data: jQuery(form_id).serialize(),
    cache: false,
    success:  function(data){
       //alert(data); 
       //alert(JSON.stringify(data));
       alert(message);
    }
  });

}


 $(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});
    


$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
    

    


});
