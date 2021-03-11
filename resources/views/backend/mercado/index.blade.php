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
                <li><a href="/admin/validacion-mercado-pago">Autorización</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>


  <div class="dashboard-list-box margin-top-0">

    <div class="list-box-listing">
      <div>
        @if ($idMP == 1)
          <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Conexión autorizada</h4>
        @else
          @if ($idMP == 3)
            <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Conexión renovada</h4>
          @else
            <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Autorizar conexión</h4>
          @endif

        @endif

      </div>

    </div>
  	<ul>

  			<li>
  			<div class="list-box-listing">
  				<div class="list-box-listing-img">
  						<a style="height: 92%;" href="#"><img style=" height:100px;" width="200" height="200" src="{{URL::asset('images/mc.jpg')}}" class="attachment-listeo_core-preview size-listeo_core-preview wp-post-image" alt="Imagen" ></a>
  				</div>
  				<div class="list-box-listing-content">
  					<div class="inner">
              @if ($idMP == 1)
                <h3>Credenciales generadas</h3>
    						<span>En hora buena! Usted ya puede vender sus productos y recibir los pagos en su cuenta de Mercado Pago.</span>
              @else
                @if ($idMP == 3)
                  <h3>Credenciales renovadas</h3>
      						<span>En hora buena! Usted ya puede vender sus productos y recibir los pagos en su cuenta de Mercado Pago.</span>
                @else
                  <h3>Autoriza a que Global Marquet Plaza se conecte con Mercado Pago</h3>
                  <span>Accederá a tu información básica. Permitirá que puedas realizar pagos.</span>
                @endif

              @endif


            </div>
  				</div>
  			</div>
  			<div class="buttons-to-right">
          @if ($idMP == 1  || $idMP == 3)
              <a href="/admin/validacion-mercado-pago/actualizar-credenciales" class=" delete button gray">Renovar</a>
          @else
            <a href="https://auth.mercadopago.com.pe/authorization?client_id=6444359659263359&response_type=code&platform_id=mp&state=id=1=&redirect_uri=https://tacnamarketplaza.com/admin/validacion-mercado-pago/permitido" class=" delete button gray">Autorizar</a>
          @endif

  			 </div>
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
    <div style="height:670px">

    </div>
</div>

@endsection

@section('js')
  <script src="{{ asset('js/backend/mercado-pago.js') }}"></script>
@endsection
