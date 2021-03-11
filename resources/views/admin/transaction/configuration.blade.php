@extends('admin.app')
@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}

		{{-- @php
		$message2 = Session::get('rol');
		@endphp --}}
				<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
										<h1>Configuraciones</h1>
										<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							{{-- @if ($message2[0] == "administrador") --}}
								<li><a href="#">Dashboard</a></li>
								<li><a href="/superadmin/transacciones">Transacciones</a></li>
				 	</ul>
					</nav>
				</div>
			</div>
		</div>

<div class="row">


<div class="col-lg-12 col-md-12">


		<div class="dashboard-list-box margin-top-0">
			<div class="list-box-listing">
	      <div>
	        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Listado de opciones.</h4>
	      </div>


	    </div>

		<ul id="ul-principal">
      <li class="newAtributo user-booking waiting-booking" style="padding: 10px 30px;" id="booking-list-10046">
            <div class="list-box-listing bookings" style="margin: 1px 0;">
              {{-- <div class="list-box-listing-img" style="margin-top: 10px;"><img src="{{URL::asset('images/'.$value['imagen'])}}" alt="Imagen de las empresas"  class="avatar avatar-70 photo" height="70" width="70" style="padding: 0 0px 0 0;"></div> --}}
              <div class="list-box-listing-content">
                <div class="inner">
                  <div class="row">
                    <div class="col-sm-12">

                      <div class="inner-booking-list">
                        <h5>Comisión:</h5>
                        <ul class="booking-list" id="client"> 
                          <li id="name">    <input  style="width : 80px; height: 30px;" type="text" name="porcentaje" id="porcentaje-transferir" value="0.5"></li>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="buttons-to-right">
                <a data-monto=" " class="button gray  eliminar-transferencia">Guardar</a>
             </div>
          </li>

		 </ul>
	</div>



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
@section('after-scripts')
  <script src="{{ asset('js/backend/transferencia.js') }}"></script>
@endsection
