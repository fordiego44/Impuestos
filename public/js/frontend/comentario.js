$(document).ready(function () {


    $('#ul-opinion').on('click', '#boton-opinion', function () {

        console.log("Bienvenido");
        var esto = $(this) ;
        request= $.get('/cliente/validarOpinion',{id_user: 'dato'} ,function (res) {
              console.log(res.resultado);
          if (res.resultado == 'existe') {
              esto.hide();
              $('#boton-formulario').show();
          } else {
            console.log('Debe logearse');
            $('.sign-in').click();
          }
        });


        request.done(function( msg ) {
        $( "#log" ).html( msg );
          console.log(msg);
        });

        request.fail(function( jqXHR, textStatus ) {
          console.log(jqXHR.responseText,textStatus);
          alert( "Request failed: " + textStatus + jqXHR.responseText);
        });
    });

    $('#ul-opinion').on('submit','#subir-comentario',function(){
        event.preventDefault();
        console.log("Hola");

        var row = $("#estrellas").children(".star");

        row.remove();

        request=  $.ajax({
           url: '/cliente/subirComentario',
           method:"POST",
           data:new FormData(this),
           dataType:"json",
           processData: false,
           contentType: false,
           success:function(res)
           {
              // console.log(res.resultado);
                console.log(res.fecha['date']);
                var date = new Date(res.fecha['date']);
                var month = (date.getMonth() + 1);
                var year = date.getFullYear();
                var day = date.getDate();
                var horas = (date.getHours() + 1);
                var minutos = date.getMinutes();
                console.log(month);
                if (month == 1) {
                  month="Enero";
                } else {
                  if (month == 2) {
                    month="Febrero";
                  } else {
                    if (month== 3) {
                      month = "Marzo";
                    } else {
                      if (month == 4) {
                        month="Abril";
                      } else {
                        if (month == 5) {
                          month = "Mayo";
                        } else {
                          if (month == 6) {
                            month = "Junio";
                          } else {
                            if (month == 7) {
                              month = "Julio";
                            } else {
                              if (month == 8) {
                                month = "Agosto";
                              } else {
                                if (month == 9) {
                                  month = "Setiembre";
                                } else {
                                  if (month == 10) {
                                    month = "Octubre";
                                  } else {
                                    if (month == 11) {
                                      month = "Noviembre";
                                    } else {
                                      if (month == 12) {
                                        month = "Diciembre";
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }

                        }

                      }

                    }

                  }

                }

             $('#boton-formulario').hide();
             $('#boton-registrado').show();
             $("#subir-nombre").text(res.nombre);
             $("#subir-apellido").text(res.apellido);
             if (horas > 11) {
               $("#subir-fecha").text(month+" "+day+", "+year+" a las "+horas+":"+minutos+" pm");
             } else {
               $("#subir-fecha").text(month+" "+day+", "+year+" a las "+horas+":"+minutos+" am");
             }
             $("#subir-micomentario").text(res.comentario);
             $('#boton-eliminarOpinion').attr('data-id_usuario',res.id_usuario );
             // $('#subir-rating').attr('data-rating',res.raiting );
             let vacio= 5 - res.raiting ;
             for (var i = 1; i <= res.raiting; i++) {
                  $('#estrellas').append(`
                          <span class="star"></span>
                     `);
             }
             for (var i = 1; i <= vacio; i++) {
               $('#estrellas').append(`
                       <span class="star empty"></span>
                  `);

             }
          }
         });
    });

    $('#ul-opinion').on('click', '#boton-editarOpinion', function () {
        console.log("Editando");
        $('#boton-formulario').show();
        $('#boton-registrado').hide();
    });

    $('#ul-opinion').on('click', '#boton-eliminarOpinion', function () {
        console.log("Eliminar");


        var id_user = $(this).attr('data-id_usuario');
        $.get('/cliente/eliminarComentario', {id_user: id_user}, function (res) {
              console.log(res.resultado);
              $('#boton-formulario').hide();
              $('#boton-registrado').hide();
              $('#boton-opinion').show();
        });

    });
});
