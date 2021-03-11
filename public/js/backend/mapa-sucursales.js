$(document).ready(function(){

    mapboxgl.accessToken = 'pk.eyJ1IjoiZm9yZGllZ280NCIsImEiOiJja2FyaG16MTIwNzE3MndreTgxcnE4c2c4In0.YoTODSTbzNX_b3KgXPSgUg';
    var bounds = [
[-71.15037206517002, -18.35882708416956], // Southwest coordinates
[-69.47882051578074, -16.781660471111678] // Northeast coordinates
];

var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [-73.9978, 40.7209],
  zoom: 13,
  maxBounds: bounds // Sets bounds as max
});

      var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        marker: {
          color: 'blue'
        },
        mapboxgl: mapboxgl
      });

      map.addControl(geocoder);

    map.addControl(
      new mapboxgl.GeolocateControl({
        positionOptions: {
          enableHighAccuracy: true
        },
        trackUserLocation: true
      })
    );

    $(document).ready(function(){
      $('.mapboxgl-ctrl-icon').click();
      setTimeout(
         function()
         {
           $('.mapboxgl-ctrl-icon').click();
         }, 1000);
    });

    $(document).ready(function(){
      var entrar='entrar'
      $.get('/admin/sucursales/mostrar-sucursal', {id: entrar}, function (res) {
            // console.log(res);
            $.each(res.atributo,function(index,value){
                //Añade un marcador
              var marker = new mapboxgl.Marker()
              .setLngLat([value.longitude, value.latitude ])
              .addTo(map);
            });

            $.each(res.atributo,function(index,value){
              $('#list-direction').append(`
                    <div class="row newSucursal">

                      <div class="col-md-7">
                        <div class="row">
                          <div class="">
                          <div class="col-md-12" for="direccion"> Dirección</div></div>
                        </div>
                        <div class="row">
                          <div class="col-md-12" ><span class="wpcf7-form-control-wrap name"><input disabled type="text"    value="${value.address}" size="40"   placeholder="Ejm: Av. Universal Mz.A Lt. 11 "></span></div>
                          <input  disabled type="hidden"   value="${value.latitude}">
                          <input  disabled type="hidden"    value="${value.longitude}">
                        </div>
                      </div>
                      <div class="col-md-3" style=" margin: 0rem;padding: 1rem;padding-top: 3%;">
                          <button class="eliminar-sucursal" type="submit" data-id_sucursal="${value.id}" name="button">Eliminar</button>
                      </div>
                    </div>
                `);
            });
      });
    });
    // ----------------------------------------

    map.on('click', function(e) {
      // console.log('El click que no entiendo');
        document.getElementById('info').innerHTML =
        // e.point is the x, y coordinates of the mousemove event relative
        // to the top-left corner of the map
        JSON.stringify(e.point) +
        '<br />' +
        // e.lngLat is the longitude, latitude geographical position of the event
        JSON.stringify(e.lngLat.wrap());

        // console.log(e.lngLat.lng +' - '+e.lngLat.lat);
          // let longitudMarcador = e.lngLat.lng ;
          // let latitudMarcador = e.lngLat.lat ;
          $("#latitudMapa").val(e.lngLat.lat);
          $("#longitudMapa").val(e.lngLat.lng);
        });



    $('.dashboard-list-box').on('click', '#agregar-sucursal', function () {

           var rect = document.getElementById("map").getBoundingClientRect();
           console.log(rect);
           var event = $.Event('click');
           // 900 500
            event.clientX = rect.x + 2200;
            event.clientY = rect.y + 2500;
            $('div').trigger(event);
            // var p = $( "#mapa" ).first();
            // var position = p.position();
            // console.log('izquierda: '+position.left+'arriba: '+position.top);

            // console.log(longitudMarcador+' La longitud del click');

          var marker = new mapboxgl.Marker({
            draggable: true
          })
          .setLngLat([$('#longitudMapa').val(), $('#latitudMapa').val()])
          .addTo(map);

          function onDragEnd() {
            var lngLat = marker.getLngLat();

            console.log(lngLat);
            $("#latitud").val(lngLat.lat);
            $("#longitud").val(lngLat.lng);

            $.ajax({
                url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+lngLat.lng+","+lngLat.lat+".json?access_token=pk.eyJ1IjoiZm9yZGllZ280NCIsImEiOiJja2FyaG16MTIwNzE3MndreTgxcnE4c2c4In0.YoTODSTbzNX_b3KgXPSgUg",
                dataType: "json",
                type: "GET"
              }).done(function(data) {

                  $('#region').val(data.features[1].text);
                  $('#direccion').val(data.features[0].place_name);
              });
          }

          marker.on('dragend', onDragEnd);
    });

    $('#list-direction').on('click', '.eliminar-sucursal', function () {
      console.log("Eliminar");
          var id_sucursal = $(this).attr('data-id_sucursal');
          var row = $(this).parents("div.newSucursal");
          // row.remove();
          console.log(id_sucursal);
          $.get('/admin/productos/eliminarSucursal', {id_sucursal: id_sucursal }, function (res) {
                console.log(res);
                row.remove();
          });
    });

    $('#panel-sucursal').on('submit','#guardar-sucursal',function(){
        event.preventDefault();

        Swal.fire({
          title: '¡Actualizando datos!',
          // html: 'Espere un momento',// add html attribute if you want or remove
          allowOutsideClick: false,
          allowEscapeKey : false,
          onBeforeOpen: () => {
              Swal.showLoading()
          },
          });

          var region = $('#region').val();
					if (region == 'Tacna' || region=='') {
            var a = $(this).serializeArray();
            var direccion = a[1].value;


            if (direccion == '') {
              Swal.fire('Ingrese una ubicación de la sucursal');
            } else {
              var latitud = a[2].value;
              var longitud =  a[3].value;

              let data = {direccion:direccion,
                          latitud:latitud,
                          longitud:longitud,
                          _token:$("meta[name='csrf-token']").attr("content")};

               $.ajax({
                 type:'POST',
                 url:'/admin/sucursales/subir-sucursal',
                 data:data ,
                 headers:{_token:$("meta[name='csrf-token']").attr("content")},
                 success:function(res)
                 {

                    $('#direccion').val('');
                    $('#list-direction').append(`
                          <div class="row newSucursal">

                            <div class="col-md-7">
                              <div class="row">
                                <div class="">
                                <div class="col-md-12" for="direccion"> Dirección</div></div>
                              </div>
                              <div class="row">
                                <div class="col-md-12" ><span class="wpcf7-form-control-wrap name"><input disabled type="text" id="direccion" name="direccion" value="${res.atributo.address}" size="40"   placeholder="Ejm: Av. Universal Mz.A Lt. 11 "></span></div>
                                <input  disabled type="hidden" id="latitud" name="latitud" value="${res.atributo.latitude}">
                                <input  disabled type="hidden" id="longitud" name="longitud" value="${res.atributo.longitude}">
                              </div>
                            </div>
                            <div class="col-md-3" style=" margin: 0rem;padding: 1rem;padding-top: 3%;">
                                <button class="eliminar-sucursal" type="submit" data-id_sucursal="${res.atributo.id}" name="button">Eliminar</button>
                            </div>
                          </div>
                      `);

                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: '¡Sucursal agregado exitosamente!',
                        showConfirmButton: false,
                        timer: 1500
                      })

                   }
                 });
            }

          } else {
              Swal.fire('Solo se permite ubicaciones dentro de Tacna');
          }

   });
});
