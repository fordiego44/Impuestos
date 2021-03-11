$(document).ready(function(){

  const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
  $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");


  $seleccionArchivos.addEventListener("change", () => {
    file = $imagenPrevisualizacion.files;
    const archivos = $seleccionArchivos.files;
    let direcciondire = $('#imagen').val();
    // console.log('ancho: '+$imagenPrevisualizacion.width+ ' largo: '+ $imagenPrevisualizacion.height);

    if (!archivos || !archivos.length) {
      $imagenPrevisualizacion.src = direcciondire;
      return;
    }
    const primerArchivo = archivos[0];
        const objectURL = URL.createObjectURL(primerArchivo);

    $imagenPrevisualizacion.src = objectURL;
    });


       $('#formulario-product').on('submit','#subir-producto',function(){
            event.preventDefault();
            // var row = $(this);
            var url;
            var a = $(this).serializeArray();
            if (a[1].value == '') {
              url = '/admin/productos/subirPlato';
              Swal.fire({
                title: '¡Creando nuevo producto!',
                // html: 'Espere un momento',// add html attribute if you want or remove
                allowOutsideClick: false,
                allowEscapeKey : false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                });
            } else {
              url= '/admin/productos/actualizar';
              Swal.fire({
                title: '¡Actualizando producto!',
                // html: 'Espere un momento',// add html attribute if you want or remove
                allowOutsideClick: false,
                allowEscapeKey : false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                });
            }

                  $.ajax({
                   url: url,
                   method:"POST",
                   data:new FormData(this),
                   dataType:"json",
                   processData: false,
                   contentType: false,
                   success:function(res)
                   {
                        if (res.resultado == 'up') {
                          $('#generar-galeria').attr('data-generado', 1);
                          $('#generar-atributo').attr('data-generado', 1);
                          $('#generar-variacion').attr('data-generado', 1);
                          $('#generar-galeria').attr('data-id_producto', res.recenGenerateId);
                          $('#generar-atributo').attr('data-id_producto', res.recenGenerateId);
                          $('#generar-variacion').attr('data-id_producto', res.recenGenerateId);
                          //colocar el id del producto al input de galeria:
                          $('#l-g-producto').val(res.recenGenerateId);
                          //colocar el id del producto al input de variation
                          $('#producto-id').val(res.recenGenerateId);

                          // row.remove();
                          $('#sin-lista-detalle').show();
                          $('#lista-detalle').hide();
                          SweetAlert.close();
                        } else {
                          if ( res.resultado == 'precioMenor' ) {
                            Swal.fire('El precio es menor de 7 soles, inténtelo de nuevo.');
                          } else {
                            if ( res.resultado == 'imagenMenor' ) {
                                Swal.fire('La imagen debe tener dimensiones mayores a 800px.');
                            } else {
                              Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: '¡Datos actualizados exitosamente!',
                                showConfirmButton: false,
                                timer: 1500
                              })
                              $('#generar-galeria').attr('data-id_producto', res.recenGenerateId);
                              $('#generar-atributo').attr('data-id_producto', res.recenGenerateId);
                              $('#generar-variacion').attr('data-id_producto', res.recenGenerateId);
                            }
                          }
                        }
                  }
                 });


       });

       $('#formulario-product').on('click','#generar-galeria',function(){
         Swal.fire({
           title: 'Cargando galería...',
           // html: 'Espere un momento',// add html attribute if you want or remove
           allowOutsideClick: false,
           allowEscapeKey : false,
           onBeforeOpen: () => {
               Swal.showLoading()
           },
           });
         $('#generar-galeria').attr('data-dropz', 1);
         var product = $(this).attr('data-generado');
         var id_product = $(this).attr('data-id_producto');

            if (product == 1 || product == 2) {
              $.get('/admin/productos/validarGaleria', {id_producto: id_product}, function (res) {

                  if (res.resultado == 'mostrar') {
                    $('#sin-lista-galeria').hide();
                    $('#lista-galeria').show();
                    $('#lista-galeria-validacion').hide();
                  } else {
                    $('#sin-lista-galeria').hide();
                    $('#lista-galeria').hide();
                    $('#lista-galeria-validacion').show();
                  }
                  SweetAlert.close();
              });
              // $('#generar-galeria').attr('data-generado', 0); //Para no volver a crear lo mismo, solo una vez
            } else {
                $('#sin-lista-galeria').show();
                $('#lista-galeria').hide();
                $('#lista-galeria-validacion').hide();
                SweetAlert.close();
            }

       });

       $('#formulario-product').on('click','#generar-atributo',function(){
         Swal.fire({
           title: 'Cargando atributos...',
           // html: 'Espere un momento',// add html attribute if you want or remove
           allowOutsideClick: false,
           allowEscapeKey : false,
           onBeforeOpen: () => {
               Swal.showLoading()
           },
           });
         var product = $(this).attr('data-generado');
         var id_product = $(this).attr('data-id_producto');

         if (product == 1) {
           $('#generar-atributo').attr('data-generado', 3); //Pone en desuso todo
           $('#sin-lista-atributo').hide(); //El mensaje de aviso
           $('#lista-atributo').show(); //El formulario
           $('#id-producto-atributo').val(id_product); //Le entrega el id

           $.get('/admin/productos/validarAtributo', {id_producto: id_product}, function (res) {
               if (res.resultado == 'mostrar') {
                 $('#atributo_variacion-ocultar').show(); //Muestra el check box de variacion
               } else {
                 $('#atributo_variacion-ocultar').hide(); //No muestra el check box de variacion
                 $('.atributo_variacion').prop('checked', false);
               }
               SweetAlert.close();
           });

         } else {
           if (product == 0) {
             $('#sin-lista-atributo').show();
             SweetAlert.close();
           }else{
             if (product == 2) {

               $('#generar-atributo').attr('data-generado', 3); //Pone en desuso todo
               $('#lista-atributo').show();

               $.get('/admin/productos/validarAtributo', {id_producto: id_product}, function (res) {
                   if (res.resultado == 'mostrar') {
                     $('#atributo_variacion-ocultar').show(); //Muestra el check box de variacion
                   } else {
                     $('#atributo_variacion-ocultar').hide(); //No muestra el check box de variacion
                      $('.atributo_variacion').prop('checked', false);
                   }
               });

               var variacion;
               $.get('/admin/productos/buscarAtributo', {id_producto: id_product}, function (res) {
                 $.each(res.resultado,function(index,value){
                   if (value.variation == '0') {
                     $('#list-atributes').append(`
                       <div class="newAtributo">
                       <div class="row">
                       <div class="col-md-3">
                       <div><span class="wpcf7-form-control-wrap name"><input disabled type="text" value="${value.name}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"  ></span></div></div>
                       <div class="col-md-3">
                       <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${value.value}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"   ></span></div></div>
                       <div class="col-md-2">
                       <div><span class="wpcf7-form-control-wrap name">
                       <div hidden class="checkboxes in-row margin-bottom-20">
                       <input disabled id="hide" type="checkbox"  value="" >
                       <label  >Variación</label>
                       </div>
                       </span></div></div>

                       <div class="col-md-3" style=" margin: 0rem;padding: 1rem;">
                       <button data-id_attribute="${value.id}" data-id_product="${id_product}" class="eliminar-atributo" name="button">Eliminar</button>
                       </div>
                       </div>
                       </div>
                       `);
                   } else {
                     variacion = 'checked' ;

                     $('#list-atributes').append(`
                       <div class="newAtributo">
                       <div class="row">
                       <div class="col-md-3">
                       <div><span class="wpcf7-form-control-wrap name"><input disabled type="text" value="${value.name}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"  ></span></div></div>
                       <div class="col-md-3">
                       <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${value.value}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"   ></span></div></div>
                       <div class="col-md-2">
                       <div><span class="wpcf7-form-control-wrap name">
                       <div class="checkboxes in-row margin-bottom-20">
                       <input disabled  type="checkbox"  value="" ${variacion}>
                       <label  ">Variación</label>
                       </div>
                       </span></div></div>

                       <div class="col-md-3" style=" margin: 0rem;padding: 1rem;">
                       <button data-id_attribute="${value.id}" data-id_product="${id_product}" class="eliminar-atributo" name="button">Eliminar</button>
                       </div>
                       </div>
                       </div>
                       `);
                   }
                   });
                   SweetAlert.close();
                 });

               }else {
                 $.get('/admin/productos/validarAtributo', {id_producto: id_product}, function (res) {
                     if (res.resultado == 'mostrar') {
                       $('#atributo_variacion-ocultar').show(); //Muestra el check box de variacion
                     } else {
                       $('#atributo_variacion-ocultar').hide(); //No muestra el check box de variacion
                        $('.atributo_variacion').prop('checked', false);
                     }
                     SweetAlert.close();
                 });

               }
             }
           }

       });

       $('#list-atributes').on('submit','.subir-atributo',function(){
           event.preventDefault();
           Swal.fire({
             title: 'Registrando nuevo atributo...',
             // html: 'Espere un momento',// add html attribute if you want or remove
             allowOutsideClick: false,
             allowEscapeKey : false,
             onBeforeOpen: () => {
                 Swal.showLoading()
             },
             });
           var a = $(this).serializeArray();
           var id_producto =  a[1].value;
           var nombre = a[2].value;
           var valor = a[3].value;
           if (a[4] == null ) {
             var variacion = 0;
           }
           else {
             var variacion = a[4].value;
           }

           let data = {id_producto:id_producto,
                       nombre:nombre,
                       valor:valor,
                       variacion:variacion,
                       _token:$("meta[name='csrf-token']").attr("content")};

            $.ajax({
              type:'POST',
              url:'/admin/productos/subirAtributo',
              data:data ,
              headers:{_token:$("meta[name='csrf-token']").attr("content")},
              success:function(res)
              {
                $('#atributo_nombre').val('');
                $('#atributo_valor').val('');
                if (res.variacion == '0') {

                  $('#list-atributes').append(`
                    <div class="newAtributo">
                    <div class="row">

                    <input type="hidden"   value="${id_producto}">
                    <div class="col-md-3">
                    <div><span class="wpcf7-form-control-wrap name"><input disabled type="text" value="${res.nombre}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"  ></span></div></div>
                    <div class="col-md-3">
                    <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${res.valor}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"   ></span></div></div>
                    <div class="col-md-2">
                    <div><span class="wpcf7-form-control-wrap name">
                    <div hidden class="checkboxes in-row margin-bottom-20">
                    <input disabled   type="checkbox"  value="" >
                    <label  >Variación</label>
                    </div>
                    </span></div></div>

                    <div class="col-md-3" style=" margin: 0rem;padding: 1rem;">
                    <button data-id_attribute="${res.id_attribute}" data-id_product="${id_producto}" class="eliminar-atributo" name="button">Eliminar</button>
                    </div>
                    </div>
                    </div>
                    `);
                } else {
                  variacion = 'checked' ;

                  $('#list-atributes').append(`
                    <div class="newAtributo">
                    <div class="row">

                    <input type="hidden"   value="${id_producto}">
                    <div class="col-md-3">
                    <div><span class="wpcf7-form-control-wrap name"><input disabled type="text" value="${res.nombre}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"  ></span></div></div>
                    <div class="col-md-3">
                    <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${res.valor}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"   ></span></div></div>
                    <div class="col-md-2">
                    <div><span class="wpcf7-form-control-wrap name">
                    <div   class="checkboxes in-row margin-bottom-20">
                    <input disabled   type="checkbox"  value="" ${variacion}>
                    <label  >Variación</label>
                    </div>
                    </span></div></div>

                    <div class="col-md-3" style=" margin: 0rem;padding: 1rem;">
                    <button data-id_attribute="${res.id_attribute}" data-id_product="${id_producto}" class="eliminar-atributo" name="button">Eliminar</button>
                    </div>
                    </div>
                    </div>
                    `);
                }

                SweetAlert.close();
                }
              });

      });

      $('#list-atributes').on('click', '.eliminar-atributo', function () {
        Swal.fire({
          title: 'Eliminando atributo...',
          // html: 'Espere un momento',// add html attribute if you want or remove
          allowOutsideClick: false,
          allowEscapeKey : false,
          onBeforeOpen: () => {
              Swal.showLoading()
          },
          });
            var id_attribute = $(this).attr('data-id_attribute');
            var id_producto = $(this).attr('data-id_product');
            var row = $(this).parents("div.newAtributo");
            $.get('/admin/productos/eliminarAtributo', {id_producto: id_producto,id_attribute: id_attribute }, function (res) {
                  row.remove();
                  SweetAlert.close();
            });


      });

      $('#formulario-product').on('click','#generar-variacion',function(){
        Swal.fire({
          title: 'Cargando variaciones...',
          // html: 'Espere un momento',// add html attribute if you want or remove
          allowOutsideClick: false,
          allowEscapeKey : false,
          onBeforeOpen: () => {
              Swal.showLoading()
          },
          });
        var product = $(this).attr('data-generado');
        var id_product = $(this).attr('data-id_producto');

        var row = $('.variacion');
        row.remove();

           if (product == 1) {
             $.get('/admin/productos/subirVariacion', {id_producto: id_product}, function (res) {
               if (res.resultado.length == 0) {
                 $('#sin-lista-atributos').show(); //aviso no hay atributos con variaciones
                $('#lista-variacion').hide(); //el form y aviso
                $('#sin-lista-variacion').hide();
                var row2 = $('.newVariacion');
                row2.remove();
                SweetAlert.close();
               } else {
                 $('#sin-lista-atributos').hide(); //aviso hay atributos convariaciones
                 $('#lista-variacion').show(); //el form y aviso
                 $.each(res.resultado,function(index,value){
                   $('#variacionesAtributos').append(`
                     <option class="variacion" value="${value.id}">${value.name}</option>
                     `);
                   });

                   $.get('/admin/productos/validarVariacion', {id_producto: id_product}, function (res) {

                       if (res.resultado == 'mostrar') {
                         $('#sin-lista-variacion').hide(); //EL aviso
                         $('#lista-variacion').show(); //El formulario con el aviso
                         $('#lista-variacion-validacion').hide();
                       } else {
                         $('#sin-lista-variacion').hide(); //aviso registre el producto
                         $('#lista-variacion').hide(); //El formulario
                         $('#lista-variacion-validacion').show(); //si hay galeria
                       }
                   });
                   SweetAlert.close();
               }

               });
             $('#generar-variacion').attr('data-generado', 3);
           } else {
             if (product == 0) {
               $('#sin-lista-variacion').show();
               $('#lista-variacion').hide();
               SweetAlert.close();
             }else{
               if (product == 2) {
                 $.get('/admin/productos/subirVariacion', {id_producto: id_product}, function (res) {
                   if (res.resultado.length == 0) {
                     $('#sin-lista-atributos').show(); //aviso no hay atributos con variaciones
                    $('#lista-variacion').hide(); //el form y aviso
                    var row2 = $('.newVariacion');
                    row2.remove();
                    SweetAlert.close();
                   } else {
                     $('#sin-lista-atributos').hide(); //aviso hay atributos convariaciones
                     $('#lista-variacion').show(); //el form y aviso
                     row.remove();
                     $.each(res.resultado,function(index,value){
                       $('#variacionesAtributos').append(`
                         <option class="variacion" value="${value.id}">${value.name}</option>
                         `);
                       });

                       $.get('/admin/productos/validarVariacion', {id_producto: id_product}, function (res) {

                           if (res.resultado == 'mostrar') {
                             $('#sin-lista-variacion').hide();
                             $('#lista-variacion').show(); //El formulario
                             $('#lista-variacion-validacion').hide();
                           } else {
                             $('#sin-lista-variacion').hide();
                             $('#lista-variacion').hide(); //El formulario
                             $('#lista-variacion-validacion').show();
                           }
                       });

                       $('#generar-variacion').attr('data-generado', 3);
                       $.get('/admin/productos/buscarVariacion', {id_producto: id_product}, function (res) {

                         $.each(res.resultado,function(index,value){ //list-variations
                             $('#list-variations').append(`
                               <div class="newVariacion">
                               <div class="row">

                               <div class="col-md-2">
                               <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${value.nombreAtributo}" size="40"   placeholder="Ejm: M "></span></div></div>

                               <div class="col-md-2">
                               <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${value.name}" size="40"   placeholder="Ejm: M "></span></div></div>

                               <div class="col-md-2">
                               <div><span class="wpcf7-form-control-wrap name"><input disabled type="number"   value="${financial(value.price)}" size="40"   placeholder="Ejm: 250 "></span></div></div>

                               <div class="col-md-3">
                               <div><span class="wpcf7-form-control-wrap name"><input disabled type="file"   value="" size="40" placeholder="Ejm: Imagen " style="width: 85%;"></span></div></div>

                               <div class="col-md-2" style=" margin: 0rem;padding: 1rem;">
                               <button  data-nombre="${value.name}" data-id_atributo="${value.idAtributo}" class="eliminar-variacion" name="button">Eliminar</button>
                               </div>
                               </div>
                               </div>
                               `);
                           });
                           SweetAlert.close();
                        });
                   }

                   });


                 }else {

                   $.get('/admin/productos/subirVariacion', {id_producto: id_product}, function (res) {
                     if (res.resultado.length == 0) {
                       $('#sin-lista-atributos').show(); //aviso no hay atributos con variaciones
                      $('#lista-variacion').hide(); //el form y aviso

                      var row2 = $('.newVariacion');
                      row2.remove();
                      SweetAlert.close();
                     } else {
                       $('#sin-lista-atributos').hide(); //aviso hay atributos convariaciones
                       $('#lista-variacion').show(); //el form y aviso
                       $.each(res.resultado,function(index,value){
                         $('#variacionesAtributos').append(`
                           <option class="variacion" value="${value.id}">${value.name}</option>
                           `);
                         });

                         $.get('/admin/productos/validarVariacion', {id_producto: id_product}, function (res) {

                             if (res.resultado == 'mostrar') {
                               $('#sin-lista-variacion').hide();
                               $('#lista-variacion').show(); //El formulario
                               $('#lista-variacion-validacion').hide();
                             } else {
                               $('#sin-lista-variacion').hide();
                               $('#lista-variacion').hide(); //El formulario
                               $('#lista-variacion-validacion').show();
                             }
                         });

                          var row2 = $('.newVariacion');
                          row2.remove();
                         $.get('/admin/productos/buscarVariacion', {id_producto: id_product}, function (res) {

                           $.each(res.resultado,function(index,value){ //list-variations
                               $('#list-variations').append(`
                                 <div class="newVariacion">
                                 <div class="row">

                                 <div class="col-md-2">
                                 <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${value.nombreAtributo}" size="40"   placeholder="Ejm: M "></span></div></div>

                                 <div class="col-md-2">
                                 <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${value.name}" size="40"   placeholder="Ejm: M "></span></div></div>

                                 <div class="col-md-2">
                                 <div><span class="wpcf7-form-control-wrap name"><input disabled type="number"   value="${financial(value.price)}" size="40"   placeholder="Ejm: 250 "></span></div></div>

                                 <div class="col-md-3">
                                 <div><span class="wpcf7-form-control-wrap name"><input disabled type="file"   value="" size="40" placeholder="Ejm: Imagen " style="width: 85%;"></span></div></div>

                                 <div class="col-md-2" style=" margin: 0rem;padding: 1rem;">
                                 <button  data-nombre="${value.name}" data-id_atributo="${value.idAtributo}" class="eliminar-variacion" name="button">Eliminar</button>
                                 </div>
                                 </div>
                                 </div>
                                 `);
                             });
                             SweetAlert.close();
                          });
                     }

                     });
                 }
               }

           }
      });


      var _URL = window.URL || window.webkitURL;
      $("#variacion_imagen").change(function(e) {
        var file, img;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function() {
                if (this.width <= 800 || this.height <= 800) {
                  document.getElementById("variacion_imagen").setCustomValidity("Las dimensiones tienen que ser mayores a 800px.");
                } else {
                  document.getElementById("variacion_imagen").setCustomValidity("");
                }
            };
            img.onerror = function() {
                alert( "not a valid file: " + file.type);
            };
            img.src = _URL.createObjectURL(file);


        }

    });


      $('#list-variations').on('submit','.subir-variacion',function(){
          event.preventDefault();
          Swal.fire({
            title: 'Registrando nueva variación...',
            // html: 'Espere un momento',// add html attribute if you want or remove
            allowOutsideClick: false,
            allowEscapeKey : false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
            });
          $.ajax({
            url: '/admin/productos/guardarVariacion',
            method:"POST",
            data:new FormData(this),
            dataType:"json",
            processData: false,
            contentType: false,
            success:function(res)
            {
              $('#variacion_nombre').val('');
              $('#variacion_precio').val('');
              $('#variacion_imagen').val('');

              if (res.resultado == 'lleno') {
                SweetAlert.close();
                Swal.fire('Solo puede ingresar 9 variaciones.');
              } else {
                if (res.resultado == 'repetido') {
                    SweetAlert.close();
                    Swal.fire('Esta variación ya existe, registre otra.');
                } else {
                  if ( res.resultado == 'precioMenor' ) {
                    SweetAlert.close();
                    Swal.fire('El precio es menor de 7 soles, inténtelo de nuevo.');
                  } else {

                  }
                  $('#list-variations').append(`
                    <div class="newVariacion">
                    <div class="row">

                    <div class="col-md-2">
                    <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${res.atributo[0].name}" size="40"   placeholder="Ejm: M "></span></div></div>

                    <div class="col-md-2">
                    <div><span class="wpcf7-form-control-wrap name"><input disabled type="text"   value="${res.nombre}" size="40"   placeholder="Ejm: M "></span></div></div>

                    <div class="col-md-2">
                    <div><span class="wpcf7-form-control-wrap name"><input disabled type="number"   value="${financial(res.precio)}" size="40"   placeholder="Ejm: 250 "></span></div></div>

                    <div class="col-md-3">
                    <div><span class="wpcf7-form-control-wrap name"><input disabled type="file"   value="" size="40" placeholder="Ejm: Imagen " style="width: 85%;"></span></div></div>

                    <div class="col-md-2" style=" margin: 0rem;padding: 1rem;">
                    <button  data-nombre="${res.nombre}" data-id_atributo="${res.id_atributo}" class="eliminar-variacion" name="button">Eliminar</button>
                    </div>
                    </div>
                    </div>
                    `);
                    SweetAlert.close();
                }

              }

              }
            });

     });

     $('#list-variations').on('click', '.eliminar-variacion', function () {
       Swal.fire({
         title: 'Eliminando variación...',
         // html: 'Espere un momento',// add html attribute if you want or remove
         allowOutsideClick: false,
         allowEscapeKey : false,
         onBeforeOpen: () => {
             Swal.showLoading()
         },
         });
           var nombre = $(this).attr('data-nombre');
           var id_atributo = $(this).attr('data-id_atributo');
           var row = $(this).parents("div.newVariacion");

           $.get('/admin/productos/eliminarVariacion', {id_atributo: id_atributo,nombre: nombre }, function (res) {
                 row.remove();
                 SweetAlert.close();
           });

     });

     function financial(x) {
        return Number.parseFloat(x).toFixed(2);
      }
});
