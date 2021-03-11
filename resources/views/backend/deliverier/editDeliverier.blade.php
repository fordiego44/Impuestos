@extends('backend.app')
@section('content')

<div class="dashboard-content">

    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Editar repartidor</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                      <li><a href="#">Dashboard</a></li>
                      <li><a href="/admin/repartidores">Repartidores</a></li>
                        <li><a href="/admin/repartidores/nuevo-repartidor">Nuevo repartidor</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
{{-- --------------------------------------------------- --}}

      <!-- Titlebar -->
      @if (session('status'))
        <div class="row">
          <div class="col-md-12">
            <div class="notification error closeable">
              <p><span>Error!</span> La constancia de prueba rápida debe estar en formato .pdf</p>
              <a class="close" href="#"></a>
            </div>
          </div>
        </div>
      @endif
<div class="row">
@foreach ($deliverier as $deliveriers)


  <!-- Profile -->
  <div class="col-lg-12 col-md-12">
    <div class="dashboard-list-box margin-top-0">
      <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;" class="gray">Detalle del repartidor</h4>
      <form class="" action="/admin/repartidores/actualizarDeliverier/{{$deliveriers->id}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="dashboard-list-box-static">

                    {{-- <input required type="file" class="form-control-file border" name="file"> --}}
        <!-- Details -->
        <div class="my-profile">
              <div class="row">
                <div class="col-sm-3">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="edit-profile-photo">
                        <img id="imagenPrevisualizacion" src="{{URL::asset('images/'.$deliveriers->image)}}" alt="">
                        <div class="change-photo-btn">
                          <div class="photoUpload">
                            <span><i class="fa fa-upload"></i> Subir imagen</span>
                            <input type="file" class="upload" id="seleccionArchivos" name="file" >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="input-with-icon medium-icons">
                      <label style="margin-top: 11px;" for="dni">DNI</label>
                      <input required class="text-input"  type="number" name="dni" type="text" id="dni" placeholder="Ejm: 98467854" value="{{$deliveriers->dni}}">
                      <i class="im im-icon-Credit-Card3"></i>
                    </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-with-icon medium-icons">
                      <label style="margin-top: 11px;" for="nombre">Nombre</label>
                      <input required class="text-input" name="nombre" type="text" id="nombre" placeholder="Ejm: Alex" value="{{$deliveriers->name}}">
                      <i class="im im-icon-Pen"></i>
                    </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-with-icon medium-icons">
                      <label style="margin-top: 11px;" for="apellidos">Apellidos</label>
                      <input required class="text-input" name="apellidos" type="text" id="apellidos" placeholder="Ejm: Perez" value="{{$deliveriers->last_name}}">
                      <i class="im im-icon-Pen"></i>
                    </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="input-with-icon medium-icons">
                      <label style="margin-top: 11px;" for="email">Correo</label>
                      <input required class="text-input" name="email" type="email" id="email" placeholder="Ejm: alex@gmail.com" value="{{$deliveriers->email}}">
                      <i class="im im-icon-Email"></i>
                    </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="input-with-icon medium-icons">
                      <label style="margin-top: 11px;" for="password">Password</label>
                      <input  class="text-input" name="password" type="password" id="password" placeholder=" " value="">
                      <i class="im im-icon-Password-Field"></i>
                    </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="input-with-icon medium-icons">
                      <label style="margin-top: 11px;" for="phone">Celular</label>
                      <input required class="text-input" name="phone" type="number" id="phone" placeholder="Ejm: 931857565" value="{{$deliveriers->phone}}">
                      <i class="im im-icon-Smartphone-4"></i>
                    </div>
                    </div>

                        <div class="col-sm-6">
                          <div class="input-with-icon medium-icons">
                          <label style="margin-top: 11px;" for="direction">Dirección</label>
                          <input required class="text-input" name="direction" type="text" id="direction" placeholder="Ejm: Asoc. Basadre Mz. A Lt.1" value="{{$deliveriers->direction}}">
                          <i class="im im-icon-Map2"></i>
                        </div>
                        </div>



                        <div class="col-sm-6">

                          <div class="profile-showmit-ubit" style="">
                            <label  style="margin-top: 11px;"  for="pdf">Constancia de prueba rapida (*.pdf)</label>
                                <input  style="line-height: 25px;padding:13px 20px" type="file" name="file2" accept="application/pdf" value="{{$deliveriers->pdf_constancia}}">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          </div>
                          <div class="col-sm-4">
                            <button style="margin-left: 11px;padding: 12px 50px;" type="submit"  value="Submit" class="button margin-top-20 margin-bottom-20">Guardar</button>
                            </div>
                            <div class="col-sm-4">
                              </div>
                  </div>
                </div>


          </div>
             @if ($deliveriers->pdf_constancia != null)
                <embed src="{{URL::asset('images/'.$deliveriers->pdf_constancia)}}" type="application/pdf" width="100%" height="1200px" />
             @endif

      </div>


        </div>
      </form></div>
    </div>
@endforeach
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

@section('js')
  <script src="{{ asset('js/backend/dish.js') }}"></script>
@endsection
