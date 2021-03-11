$(document).ready(function () {
  var notyf = new Notyf({
      duration: 1000,
      position: {
          x: 'right',
          y: 'bottom',
      },
      types: [
          {
              type: 'warning',
              background: 'orange',
              icon: {
                  className: 'material-icons',
                  tagName: 'i',
                  text: 'warning'
              }
          },
          {
              type: 'error',
              background: 'indianred',
              duration: 2000,
              dismissible: true
          }
      ]
      });


      $('#ul-principal').on('click', '.exportar-salubridad', function () {

            var id = $(this).attr('data-id_deliverier');
            var date= $(this).attr('data-date_declaration');

            // console.log(id_deliverier+' --- '+ date_declaration);
                window.open( '/acta/'+id+'/'+date+'',"_blank").focus();

      });

      $('#ul-principal').on('click', '.exportar-compra', function () {

            var pedido = $(this).attr('data-npedido');
            var empresa = $(this).attr('data-empresa');

            // console.log(pedido+' --- '+ empresa);
                window.open( '/compra/'+pedido+'/'+empresa+'',"_blank").focus();

      });

      $('#ul-principal').on('click', '.cancelar-compra', function () {



            var pedido = $(this).attr('data-npedido');
            var empresa = $(this).attr('data-empresa');

            // console.log(pedido+' --- '+ empresa);

            request = $.get('/mi-perfil-cancelar', {pedido: pedido,empresa: empresa}, function (res) {
                 console.log(res.resultado);

                 switch (res.resultado) {
                    case '1':
                       notificarDevolucion('Se encontro detalle del pago con exito.');
                      break;
                    case '2':
                      notificarDevolucion('Error, no existe el pago.');
                      break;
                    case '3':
                       notificarDevolucion('El pago ya fue devuelto, espere a que termine la transacción.');
                      break;
                    case '4':
                      notificarDevolucion('Tenemos localizado al vendedor.');
                      break;
                    case '0-1':
                      notificarDevolucion('Solicitud en mantenimiento, Comuniquese directamente con la tienda.');
                      break;
                    case '0-2':
                      notificarDevolucion('La compra ya fue aprobada, comuniquese con la tienda.');
                      break;
                    case '1-1':
                      notificarDevolucion('Se encontro detalle de la devolucion.');
                      break;
                    case '1-2':
                      notificarDevolucion('Solicitud exitosa, transferencia del pago realizándose.');
                      break;
                    case '2-1':
                      notificarDevolucion('Solicitud ya realizada, el pago ya fue  devuelto.');
                      break;
                    case '2-2':
                      notificarDevolucion('Solicitud ya realizada, el pago ya fue  devuelto.');
                      break;
                    default:
                      notificarDevolucion('En mantenimiento, intentelo más tarde.');
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

      function notificarDevolucion(mensaje)
      {
        notyf.success({
            message: `${mensaje}`,
            duration: 8000,
            icon: true
        })
      }

      $('.evaluar').on('click', async function(){
        let pending = $(this).attr('data-npedido');
        let id_user = $(this).attr('data-empresa');

        const { value: formValues } = await Swal.fire({
          title: 'Evalua la entrega de tu producto',
          html:
            `
            <div class="col-md-12 margin-top-10">

                <label style="display: flex;">
                  <div class="col-md-2">
                    <input type="checkbox" value="" id="checkbox1">
                  </div>
                  <div class="col-md-10 margin-top-15">
                    <span>Cumplió con las normas de salubridad. </span>
                  </div>
                </label>

                <label style="display: flex;">
                  <div class="col-md-2">
                    <input type="checkbox" value="" id="checkbox2">
                  </div>
                  <div class="col-md-10 margin-top-14">
                    <span >Entrego el producto en óptimas condiciones. </span>
                  </div>
                </label>
          	</div>`,

          focusConfirm: false,
          preConfirm: () => {
            let answer1 = document.getElementById('checkbox1').checked;
            let answer2 = document.getElementById('checkbox2').checked;
            Swal.fire({
              title: '¿Deseas enviar estas respuestas?',
              text: "¡Tu opinion sera compartida con los vendedores del pedido!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Cancelar',
              confirmButtonText: 'Si, enviar'
            }).then((result) => {
              if (result.value) {
                console.log(pending,id_user);

                console.log(answer1, answer2);
                $.get('/evaluation',{id_user:id_user,pending:pending,answer1:answer1,answer2:answer2},function(res){
                  console.log(res);
                  $('#evaluar-'+id_user+'-'+pending).hide();
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Respuestas enviadas',
                    showConfirmButton: false,
                    timer: 1500
                  })

                });

              }
            })




          }
        })


      })


});
