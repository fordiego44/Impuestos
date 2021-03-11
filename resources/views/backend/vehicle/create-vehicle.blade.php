@extends('backend.app')
@section('content')

<div class="dashboard-content">

    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Crear nuevo vehículo</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="/admin/vehicle">Vehículos</a></li>
                        <li><a href="/admin/vehicle/new">Nuevo vehículo</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
{{-- --------------------------------------------------- --}}
        @php
            $url = asset('images/default.jpg');
        @endphp
      <!-- Titlebar -->
<div class="row">

  <!-- Profile -->
  <div class="col-lg-12 col-md-12">
    <div class="dashboard-list-box margin-top-0">
      <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;" class="gray">Detalle del vehículo</h4>
      <form action="/admin/vehicle/new/save" method="POST" enctype="multipart/form-data" id="vehicle">
        @csrf

              <div class="dashboard-list-box-static">


                <div class="row">

                <div class="col-sm-4">

                </div>
                <div class="col-sm-4">
                  <div class="edit-profile-photo">
                    <img id="imagenPrevisualizacion" src="{{URL::asset('images/default.jpg')}}" alt="">
                    <div class="change-photo-btn">
                      <div class="photoUpload">
                          <span><i class="fa fa-upload"></i> Subir imagen</span>
                          <input type="file" class="upload" id="seleccionArchivos" name="file"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">

                </div>
              </div>


        <!-- Details -->
              <div style="margin-top: 15px;">
                <div class="row">
                  <div class="col-lg-6">
                    <label for="plaque">Placa</label>
                    <input class="text-input" name="plaque" id="plaque" type="text" placeholder="ejm. 888-AAA " required>
                  </div>
                  <div class="col-lg-6">
                    <label for="type">Tipo</label>
                    <input class="text-input" name="type" id="type" type="text" placeholder="ejm. Carro" required>

                  </div>
                  <div class="col-lg-6">
                    <label for="license">Licencia</label>
                    <input class="text-input" name="license" type="text" id="license" placeholder="ejm. 12345678" required>

                  </div>
                  <div class="col-lg-6">
                    <label for="category">Categoría</label>
                    <input class="text-input" name="category" id="category" type="text" placeholder="ejm. M1" required>

                  </div>
                  <div class="col-lg-6">
                    <label for="mark">Marca</label>
                    <input class="text-input" name="mark" id="mark" type="text" placeholder="ejm. Chevrolet" required>

                  </div>
                  <div class="col-lg-6">
                    <label for="model">Modelo</label>
                    <input class="text-input" name="model" id="model" type="text" placeholder="ejm. Onix" required>

                  </div>
                  <div class="col-lg-6">
                    <label for="soat">SOAT</label>
                    <input class="text-input" name="soat" id="soat" type="text"  placeholder="ejm. 15423687" required>

                  </div>
                  <div class="col-lg-6">
                    <label for="serie">Serie del vehiculo</label>
                    <input class="text-input" name="serie" id="serie" type="text" placeholder="ejm. ABCDEFGH123456789" required>
                  </div>
                  <div class="col-lg-6">
                    <label for="description">Descripcion</label>
                    <input class="text-input" name="description" id="description" type="text"  placeholder="ejm. Auto rojo..." required>
                  </div>
                  <div class="col-lg-6">
                    <label for="delivery">Repartidor</label>
                    <select class="chosen-select" id="delivery" data-placeholder="Seleccione un repartidor" >

                      <option class="level-0" value="">Ninguno</option>
                    @foreach ($deliverys as $delivery)

                      <option class="level-0" value="{{$delivery->id}}">{{$delivery->name}} {{$delivery->last_name}}</option>

                    @endforeach
                    </select>
                  </div>
                  <input class="text-input"  id="imagen" style="display:none;" value="{{$url}}">
                  <input class="text-input"  id="deliverys" style="display:none;" name="deliverys" value="">
                  <div class="col-lg-12">
                    <input type="submit" style="height: 44px;text-align: center;margin-left: 9px;" form="vehicle" value="Guardar" class="button margin-top-20 margin-bottom-20" required ></input>

                  </div>
                </div>
						  </div>


        </div>
      </form></div>
    </div>

  <!-- Change Password -->

  </div>

{{-- -------------------------------------------------------- --}}
    <div class="row">
        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">Derechos reservados. ®Rcom Global LCC.</div>
        </div>
    </div>

</div>

<script>

  const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
  $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");


  $seleccionArchivos.addEventListener("change", () => {
    const archivos = $seleccionArchivos.files;
    let direcciondire = $('#imagen').val();
    console.log(direcciondire);

    if (!archivos || !archivos.length) {
      $imagenPrevisualizacion.src = direcciondire;
      return;
    }
    const primerArchivo = archivos[0];
        const objectURL = URL.createObjectURL(primerArchivo);
    console.log(objectURL);
    $imagenPrevisualizacion.src = objectURL;
    });



</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script>
$(document).ready(function(){
  $('#delivery').on('change', function(){

    delivery = $(this).val();

    $('#deliverys').val(delivery);
    let prueba = $('#deliverys').val();
    console.log(prueba);

    });
})

</script>

@endsection
