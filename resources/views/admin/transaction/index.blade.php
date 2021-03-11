@extends('admin.app')
@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}
 
				<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
										<h1>Empresas con ventas</h1>
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

		<div hidden id="alerta-transaccion" class="notification notice closeable">
			<p><span>Realizado!</span> Transacción completada.</p>
			{{-- <a class="close"></a> --}}
		</div>

		<div hidden id="alerta-error" class="notification notice closeable">
			<p><span>Error!</span> Transacción cancelada.</p>
			{{-- <a class="close"></a> --}}
		</div>

		<div class="dashboard-list-box margin-top-0">
			<div class="list-box-listing">
	      <div>
	        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Listado de Empresas con ventas registradas.</h4>
	      </div>

				<div class="list-box-listing-content col-md-6">
	        <div class="inner float-right" style="display:flex; justify-content:flex-end">
	            <a href="/superadmin/transferir-todo"  class="button">Procesar transferencias</a>
	          </div>
	      </div>
	    </div>

		<ul id="ul-principal">

			@if ($montoTotalNegocio != null)
				@foreach ($montoTotalNegocio as $key => $value)
					<li class="newAtributo user-booking waiting-booking" style="padding: 10px 30px;" id="booking-list-10046">
								<div class="list-box-listing bookings" style="margin: 1px 0;">
									<div class="list-box-listing-img" style="margin-top: 10px;"><img src="{{URL::asset('images/'.$value['imagen'])}}" alt="Imagen de las empresas"  class="avatar avatar-70 photo" height="70" width="70" style="padding: 0 0px 0 0;"></div>
									<div class="list-box-listing-content">
										<div class="inner">

											<h3 id="title" style="margin-bottom: 10px;"><a href="#">Tienda: {{$key}} </a>
												{{-- <span class="booking-status pending">Waiting for owner confirmation</span> --}}
											</h3>

											<div class="row">
												<div class="col-sm-12">

													<div class="inner-booking-list">
														<h5>DNI:</h5>
														<ul class="booking-list" id="client">
															<li id="name"> {{$value['dni']}} </li>
															<li id="name"> <h5>Monto total:</h5> S/.{{$value['montoTotal']}} </li>
														</ul>
													</div>


													<div class="inner-booking-list">
														<h5>Email:</h5>
														<ul class="booking-list" id="client">
															<li id="email">{{$value['email']}} </li>
															<li id="phone"><h5>Celular:</h5> {{$value['phone']}} </li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="buttons-to-right">
										<a data-id_dueno="{{$value['id']}}" data-monto="{{$value['montoTotal']}}" class="button gray  eliminar-transferencia">Transferir</a>
										<a href="/superadmin/transacciones/{{$value['id']}}" class="button gray">Ver detalle</a>
								</div>
							</li>
	          @endforeach
			@else
				<div class="notification notice closeable">
					<p><span>Listado vacío!</span> No hay empresas por pagar.</p>
					<a class="close"></a>
				</div>

			@endif

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
