@extends('backend.app')
@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}

  				<!-- Titlebar -->
  		<div id="titlebar">
  			<div class="row">
  				<div class="col-md-12">
  										<h1>Mercado Pago</h1>
  										<!-- Breadcrumbs -->
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/admin/validacion-mercado-pago">Autorizaciones</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>


  <div class="dashboard-list-box margin-top-0">

    <div class="list-box-listing">
      <div >
        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Conexión autorizada</h4>
      </div>
      <div class="list-box-listing-content col-md-6">
        {{-- <div class="inner float-right" style="display:flex; justify-content:flex-end">
          <a href="/admin/productos/guia" class="button" style="background-color:#657375"> Manual de uso</a>
          <a href="/admin/productos/crear" style="margin-left:5px" class="button"> Nuevo producto</a>
          <a href="/admin/productos/subirExcel" style="margin-left:5px" class="button" >Subir excel</a>
        </div> --}}
      </div>
    </div>
  	<ul>

  			<li>
  			<div class="list-box-listing">
  				<div class="list-box-listing-img">
  						<a style="height: 92%;" href="#"><img style=" height:100px;" width="200" height="200" src="{{URL::asset('images/mc.jpg' )}}" class="attachment-listeo_core-preview size-listeo_core-preview wp-post-image" alt="Imagen" ></a>
  				</div>
  				<div class="list-box-listing-content">
  					<div class="inner">
  						<h3><a href="">Credenciales generadas</a></h3>
  						<span>En hora buena! Usted ya puede vender sus productos y recibir los pagos en su cuenta de Mercado Pago.</span>

            </div>
  				</div>
  			</div>
  			{{-- <div class="buttons-to-right">
          <a href="/admin/validacion-mercado-pago/generar-credenciales" class=" delete button gray"><i class="sl sl-icon-close"></i> Generar credenciales</a>

  			</div> --}}
  		</li>

  	</ul>
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
  <script src="{{ asset('js/backend/mercado-pago.js') }}"></script>
@endsection
