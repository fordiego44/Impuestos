@extends('backend.app')
@section('content')

<div class="dashboard-content">

    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Crear nueva subcategoría</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                      <li><a href="#">Dashboard</a></li>
                      <li><a href="/admin/clasificaciones">Subcategorías</a></li>
                      <li><a href="/admin/clasificaciones/nuevaClasificacion">Nueva subcategoría</a></li>
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
      <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;" class="gray">Detalle de la subcategoría</h4>
      <form  action="/admin/clasificaciones/subirClasificacion" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="dashboard-list-box-static">

         @if (session('status'))
           <div class="notification error closeable">
     				<p><span>Aviso!</span> {{session('status')}}</p>
     				<a class="close" href="#"></a>
     			</div>
         @endif
        <div class="my-profile">
              <label for="nombre">Nombre</label>
                    <input required class="text-input" name="nombre" type="text" id="nombre" placeholder="Ejm: Desayunos">
              <label for="descripcion">Descripción</label>
                    <input required class="text-input" name="descripcion" type="text" id="descripcion" placeholder="Ejm: Es la primera comida que se consume en el día.">

            <button type="submit" value="Submit" class="button margin-top-20 margin-bottom-20">Guardar</button>
          </div>
        </div>
      </form>
    </div>
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

    <div style="height:450px">

    </div>

</div>
@endsection
