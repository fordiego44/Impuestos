@extends('backend.app')
@section('content')
  <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
  <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
  <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />

<div class="dashboard-content">

    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Crear nuevo producto</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="/admin/platos">Platos</a></li>
                        <li><a href="/admin/platos/nuevoPlato">Nuevo producto</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
{{-- --------------------------------------------------- --}}

      <!-- Titlebar -->
<div id ="" class="row">
  <div class="col-md-12">
    <div class="style-1">

      <div class="row">
<!-- Profile -->
        <div class="col-lg-12 col-md-12">
          <div class="dashboard-list-box margin-top-0" id="completadoForm">
            <form   id="subir-producto" action="" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="dashboard-list-box-static">

                <div class="row">
                  <div class="col-sm-4">

                  </div>
                  <div class="col-sm-4">
                    <div class="edit-profile-photo">
                      <img id="imagenPrevisualizacion" src="{{URL::asset('images/box1.jpg')}}" alt="">
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
                <div class="my-profile">

                  <input name="id_producto" type="hidden" value="">
                  <label style="margin-top: 11px;" for="nombre">Nombre</label>
                  <input required class="text-input" name="nombre" type="text" id="nombre" placeholder="Ejm: Rocoto relleno">

                  <label for="descripcion">Descripción</label>
                  <input required class="text-input" name="descripcion" type="text" id="descripcion" placeholder="Ejm: Es un producto peruano de origen arequipeño">


                  <label for="precio">Precio</label>
                  <input required class="text-input" step="any" name="precio" value="10" type="number" placeholder="Ejm: S/.10">


                  <button type="submit"  value="Submit" class="button margin-top-20 margin-bottom-20">Guardar</button>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


{{-- -------------------------------------------------------- --}}
    <div class="row">
        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">Derechos reservados. ®Rcom Global LCC.</div>
        </div>
    </div>

</div>
@endsection

@section('js')
  {{-- <script src="{{ asset('js/backend/dish.js') }}"></script>
    <script src="{{ asset('js/backend/product.js') }}"></script> --}}
@endsection
