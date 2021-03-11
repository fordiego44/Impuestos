@extends('backend.app')
@section('content')
  <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
  <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
  <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />

<div class="dashboard-content">
  @php
  $message2 = Session::get('rol');
  @endphp
    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Ubicación del cliente</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        @if ($message2[0] == "administrador")
                          <li><a href="/admin/recepciones/proceso">Recepción</a></li>
                         @else
                          <li><a href="/admin/repartidor/recepciones/proceso">Recepción</a></li>
          							@endif
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
          <div class="dashboard-list-box margin-top-0" >
              <div class="dashboard-list-box-static">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="col-lg-12 col-md-12">
      								<div class="dashboard-list-box margin-top-0">
      									<div class="add-listing-section margin-top-0">

                        @foreach ($recepcion as  $value)
                          <div class="add-listing-headline" style="    margin-bottom: 0px; background-color: #f7f7f7;">
                              <h3 style="font-weight: 600;font-size: 16px;line-height: 20px;">Dirección: {{$value->address}}</h3>

                          </div>
      										<div class="submit-section">
                            @if ($value->latitude == "0" and $value->longitude == "0")
                              <div class="container" style="height:25px">

                              </div>
                              <div class="row"  >
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-4">
                                  <label for="respuesta">Sin ubicación geográfica</label>
                                </div>
                                <div class="col-lg-4">
                                </div>
                              </div>
                            @else
                              <div id='map' style="padding-top: 15px;width: 100%;height: 500px;">

      												</div>
                              <div class="row" style="margin-top: 15px;">
                                <div class="col-lg-6">
                                  <label for="longitud">Longitud</label>
                                  <input disabled class="text-input" name="longitud" id="longitud" type="text" value="{{$value->longitude}}">
                                </div>
                                <div class="col-lg-6">
                                  <label for="latitud">Latitud</label>
                                  <input disabled class="text-input" name="latitud" id="latitud" type="text" value="{{$value->latitude}}">
                                </div>
                              </div>

                            @endif
      										</div>
                        @endforeach
      									</div>

      								</div>
      							</div>
                  </div>
                </div>
              </div>
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
  <script src="{{ asset('js/map-reception.js') }}"></script>
  {{-- <script src="{{ asset('js/backend/dish.js') }}"></script>
    <script src="{{ asset('js/backend/product.js') }}"></script> --}}
@endsection
