@extends('backend.app')
@section('content')

  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
type="text/css"
/>
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<style>
    #geocoder-container > div {
      min-width: 50% !important;
      margin-left: 25% !important;
    }

    input,
    input[type=text],
    input[type=password],
    input[type=email],
    input[type=number],
    textarea,
    select {
      height: 39px;

      padding: 0 30px;

      margin: 0 0 0px;

    }

    #info {
      display: block;
      position: relative;
      margin: 0px auto;
      width: 50%;
      padding: 10px;
      border: none;
      border-radius: 3px;
      font-size: 12px;
      text-align: center;
      color: #222;
      background: #fff;
      }

    .coordinates {
      background: rgba(0, 0, 0, 0.5);
      color: #fff;
      position: absolute;
      bottom: 0px;
      left: 50px;

      margin-bottom: 140px;
      padding: 5px 10px;
      /* margin: 0; */
      font-size: 11px;
      line-height: 18px;
      border-radius: 3px;
      display: none;
      z-index: 990;
      }
</style>

<div class="dashboard-content" style="width: 100%;
    height: 100%;
    ">
  {{-- -------------------------------------------------- --}}

  				<!-- Titlebar -->
  		<div id="titlebar">
  			<div class="row">
  				<div class="col-md-12">
  										<h1 id="sucursal">Sucursales</h1>
  										<!-- Breadcrumbs -->
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/admin/sucursales">Sucursales</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>


  <div class="dashboard-list-box margin-top-0">

    <div class="list-box-listing">
      <div>
        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Ubicación de sucursales de su negocio.</h4>
      </div>
      <div class="list-box-listing-content col-md-6">
        <div class="inner float-right" style="display:flex; justify-content:flex-end">
          {{-- <a href="/admin/clasificacion/guia" class="button" style="background-color:#657375"> Manual de uso</a> --}}
          <a  id="agregar-sucursal" class="button"> Agregar puntero</a>
        </div>
      </div>
    </div>

        <div id='map' class="cuadrado" style='width: 100%; height: 500px;'></div>

        <div hidden class="">
          <pre id="coordinates" class="coordinates"></pre>
          <pre  id="info"></pre>
        </div>

        <div class="row">

          <!-- Profile -->
          <div class="col-lg-12 col-md-12">
            <div id="panel-sucursal" class="dashboard-list-box margin-top-0">

              <div id="list-direction" class="dashboard-list-box-static">
                <input disabled type="hidden" id="region" name="" value="">
                <form id="guardar-sucursal" action="" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="row">

                      <div class="col-md-7">
                        <div class="row">
                          <div class="">
                          <div class="col-md-12" for="direccion"> Dirección</div></div>
                        </div>
                        <div class="row">
                          <div class="col-md-12" ><span class="wpcf7-form-control-wrap name"><input required type="text" id="direccion" name="direccion" value="" size="40"   placeholder="Ejm: Av. Universal Mz.A Lt. 11 " readonly></span></div>
                          <input  type="hidden" id="latitud" name="latitud" value="">
                          <input  type="hidden" id="longitud" name="longitud" value="">
                          <input  type="hidden" id="latitudMapa" name="latitud" value="">
                          <input  type="hidden" id="longitudMapa" name="longitud" value="">
                        </div>
                      </div>


                      <div class="col-md-3" style=" margin: 0rem;padding: 1rem;padding-top: 3%;">
                          <button type="submit" class="button" name="button">Guardar</button>
                      </div>
                    </div>
                  </form>
              </div>


            </div>
          </div>

          <!-- Change Password -->

          </div>



  </div>


  {{-- --------------------------------------------------------- --}}

    <div class="row">
        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">Derechos reservados. ®Rcom Global LCC.</div>
        </div>
    </div>

</div>
@endsection

@section('js')
  <style>

#swal2-title{
	font-size:2.875em;
}
#swal2-content{
	font-size: 1.6em;
}
.swal2-popup{
	width: auto;
height: auto;
}
#swal2-title{
	font-size:2.875em;
	margin-top: 15px;
	margin-bottom: 15px;
}
#swal2-content{
	font-size: 1.6em;
}
.swal2-popup{
	width: 50%;
	height: 40%;
}
.swal2-styled.swal2-confirm{
	border: 0;
	border-radius: .25em;
	background: initial;
	background-color: #3085d6;
	color: #fff;
	/*font-size: 1.0625em;*/
	font-size: 1.6em !important;
}
.swal2-styled.swal2-cancel{
	font-size: 1.6em !important;
}
</style>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="{{ asset('js/backend/mapa-sucursales.js') }}"></script>

@endsection
