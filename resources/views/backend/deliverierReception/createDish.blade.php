@extends('backend.app')
@section('content')

<div class="dashboard-content">

    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Crear nuevo plato</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="/admin/platos">Platos</a></li>
                        <li><a href="/admin/platos/nuevoPlato">Nuevo plato</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
{{-- --------------------------------------------------- --}}

      <!-- Titlebar -->
<div class="row">

  <!-- Profile -->
  <div class="col-lg-12 col-md-12">
    <div class="dashboard-list-box margin-top-0">
      <h4 class="gray">Detalle del plato</h4>
      <form class="" action="/admin/platos/subirPlato" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="dashboard-list-box-static">

        <input type="file" class="form-control-file border" name="file">

        <!-- Details -->
        <div class="my-profile">


              <label for="nombre">Plato</label>
                    <input class="text-input" name="nombre" type="text" id="nombre" placeholder="Ingrese el nombre del plato">

              <label for="descripcion">Descripción</label>
                    <input class="text-input" name="descripcion" type="text" id="descripcion" placeholder="Ingrese una breve descripción">

              <label for="precio">Precio</label>
                    <input class="text-input" step="any" name="precio"  type="number" id="precio" >


            <button type="submit"  value="Submit" class="button margin-top-20 margin-bottom-20">Guardar</button>




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
@endsection
