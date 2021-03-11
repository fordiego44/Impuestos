$(document).ready(function(){

  $('#ul-principal').on('click', '.eliminar-transferencia', function () {


        var monto = $(this).attr('data-monto');
        var id_dueno = $(this).attr('data-id_dueno');

        var row = $(this).parents("li.newAtributo");
        // console.log(monto+' - '+id_dueno);

        $.get('/superadmin/transferir', {monto: monto,id_dueno:id_dueno}, function (res) {
              console.log(res);
              if (res.resultadoPull == 'Pull ejecutado') {
                  if (res.resultadoPush == 'Push ejecutado') {
                      setTimeout(function() {
                        $("#alerta-transaccion").show();
                      },100);

                      setTimeout(function() {
                        $("#alerta-transaccion").hide();
                      },4000);
                      row.remove();
                  } else {
                    setTimeout(function() {
                      $("#alerta-error").show();
                    },100);

                    setTimeout(function() {
                      $("#alerta-error").hide();
                    },4000);
                  }

              } else {
                setTimeout(function() {
                  $("#alerta-error").show();
                },100);

                setTimeout(function() {
                  $("#alerta-error").hide();
                },4000);
              }

        });

        // request.done(function( msg ) {
        // $( "#log" ).html( msg );
        //   console.log(msg);
        // });
        //
        // request.fail(function( jqXHR, textStatus ) {
        //   console.log(jqXHR.responseText,textStatus);
        //   alert( "Request failed: " + textStatus + jqXHR.responseText);
        // });



  });

});
