$(document).ready(function(){

  function getParameterByName(name, url) {
     if (!url) url = window.location.href;
     name = name.replace(/[\[\]]/g, '\\$&');
     var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
         results = regex.exec(url);
     if (!results) return null;
     if (!results[2]) return '';
     return decodeURIComponent(results[2].replace(/\+/g, ' '));
 }

  var code = getParameterByName('code');
  var id = getParameterByName('id');
  // console.log(code+' - '+id); // mostrar code

  $("#codigo").val(code);

    if (code) { //verificar si code esta definido
         request = $.get('/admin/validacion-mercado-pago/generar-credenciales', {code: code}, function (res) {
              console.log(res.resultado);
          });

          request.done(function( msg ) {
          $( "#log" ).html( msg );
            console.log(msg);
          });

          request.fail(function( jqXHR, textStatus ) {
            console.log(jqXHR.responseText,textStatus);
            alert( "Request failed: " + textStatus + jqXHR.responseText);
          });

    } else {
        console.log('No hay contenido');
    }

  });
