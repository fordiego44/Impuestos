$(document).ready(function(){

  let infoTax = {};
  let infoClient = {};
  let total = 0;
  let foundCod = false;

  // Render the PayPal button into #paypal-button-container
       paypal.Buttons({

           // Set up the transaction
           createOrder: function(data, actions) {
               return actions.order.create({
                   purchase_units: [{
                       amount: {
                           value: total
                       }
                   }]
               });
           },

           // Finalize the transaction
           onApprove: function(data, actions) {
               return actions.order.capture().then(function(details) {
                   // Show a success message to the buyer
                   // alert('Transaction completed by ' + details.payer.name.given_name + '!');
                   // Swal.fire('Pago realizado con éxito.');
                   Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Pago realizado con éxito',
                      showConfirmButton: false,
                      timer: 2500
                    })

                    $('#tabFactura').click();

                    $.get('/payment/pay', {codigo: infoTax.pedrial_cod, total:total, fecha:new Date($.now())}, function (res) {

                         console.log(res.resp);
                         let infoPay = res.resp;
                         $(".idpago").html(`  ${pad(infoPay.id, 5)} `);
                         $(".datepago").html(` ${infoPay.date} `);
                         $(".cel").html(` ${infoClient.phone} `);
                         $(".tel").html(` ${infoClient.telephone} `);
                         $("#email").html(` ${infoClient.email} `);

                    });

               });
           }


       }).render('#paypal-button-container');

  $('#tabsTax').on('click', '#buscarCodigoPredial', async function () { //Boton busca codigo predial y muestra informacion

      let codigo = $('#codigoPago').val();
      let precio;
      if (codigo != '') {

         await buscarCodigoPredial(codigo);

      }else{
        Swal.fire('Vuelva a intertarlo, el código predial no existe');
      }

  });

  $('#tabsTax').on('click', '#continuar2', async function () { //Continua al tab2 a partir del boton pagar

      let codigo = $('#codigoPago').val();
      let precio;
      if (codigo != '') {
         $('#tabPagar').click();
         //Buscar el precio del codigo
         if (true) {

         }
         await buscarCodigoPredial(codigo);

         $('#pasosPago1').hide();
         $('#pasosPago2').show();
      }else{
        Swal.fire('Vuelva a intertarlo, el código predial no existe');
      }

  });

  $('#tabsTax').on('click', '#tabPagar', function () { //Vamos al tab 2
      // console.log('regresa');
      let codigo = $('#codigoPago').val();
      let precio;

      if (codigo == '') {
         $('#tabCodigo').click();
         //Buscar el precio del codigo
         precio = buscarCodigo(codigo);
      }else{
        $('#pasosPago1').hide();
        $('#pasosPago2').show();
        $('#pasosPago3').hide();
      }
  });

  $('#tabsTax').on('click', '#tabBuscar', function () { //Vamos al tab 1

         $('#pasosPago1').show();
         $('#pasosPago2').hide();
         $('#pasosPago3').hide();
  });

  $('#tabsTax').on('click', '#tabFactura', function () { //Vamos al tab 3

         $('#pasosPago1').hide();
         $('#pasosPago2').hide();
         $('#pasosPago3').show();
  });

  $('#tabsTax').on('click', '.nuevaConsulta', function () { //Regresamos nueva consulta

         $('#detallePredial').hide();
         $('#tabCodigo').click();
         $('#codigoPago').val('');
         $('#pasosPago1').show();
         $('#pasosPago2').hide();
         $('#pasosPago3').hide();
  });

  function pad (str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
  }

  function buscarCodigo(codigo) {
      //BUSCAR EN LA DB LOS CODIGOS REGISTRADOS
      let cantidad;
      switch (codigo) {
        case '300':
            cantidad = 600;
           break;
        case '400':
            cantidad = 800;
             break;
        case '500':
            cantidad = 1000;
           break;
        default:
            cantidad = 100;
           break;
      }

      return cantidad;
   }

   async function buscarCodigoPredial( codigo) { //Busca el codigo, coloca un loading y pinta los datos encontrados
     // $('#buscarCodigoPredial').hide(); //Se oculta el boton de buscar
       Swal.fire({
         title: '¡Buscando código predial!',
         // html: 'Espere un momento',// add html attribute if you want or remove
         allowOutsideClick: false,
         allowEscapeKey : false,
         onBeforeOpen: () => {
               Swal.showLoading()
          },
       });
       //Buscar el precio del codigo y sus datos
            await $.get('/tax/search', {codigo: codigo}, function (res) {

                infoTax = res.respPredio;
                infoClient = res.respCliente;
               SweetAlert.close();
            });

            if (infoTax == null) {
                foundCod = false;
                Swal.fire('Vuelva a intertarlo, el código predial no existe');
                $('#detallePredial').hide();
            } else {
              foundCod = true;
              $('#detallePredial').show(); //Nos muestra el detalle
            // $('#boton-registrado').show();
              $(".nombres").html(` ${infoClient.name.toUpperCase()} ${infoClient.last_name.toUpperCase()} `);
              $(".dni").html(` ${infoClient.dni} `);

              $("#ub").html(` ${infoTax.direction} `);
              $("#ct").html(` ${infoTax.catastral_cod} `);
              $("#cp").html(` ${infoTax.pedrial_cod} `);
              $("#es").html(` ${infoTax.state} `);
              $("#au").html(` ${infoTax.autovaluo} `);
              $("#part").html(` ${infoTax.part} `);

              $(".aa").html(` ${infoTax.autovaluo_afecto.toFixed(2)} `);
              $("#ty").html(` ${infoTax.tax_year.toFixed(2)} `);
                total = infoTax.autovaluo_afecto + infoTax.tax_year;
              $(".total").html(` ${total.toFixed(2)} `);
            }
   }
});
