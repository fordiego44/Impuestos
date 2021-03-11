@extends('admin.app')
@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}

				<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
										<h1>Listado de las ventas registradas.</h1>
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
	        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;"> Monto Total de Ventas: {{$montoTotal}}</h4>
	      </div>
				<div class="list-box-listing-content col-md-6">
	        <div class="inner float-right" style="display:flex; justify-content:flex-end">
	            <a href="/superadmin/transferir-detalle/{{$montoTotal}}/{{$id}}"  class="button">Procesar transferencia</a>
	          </div>
	      </div>

	    </div>


		<ul id="ul-principal">
			@foreach ($reception as $receptions)

				<li class="user-booking waiting-booking" style="padding: 10px 30px;" id="booking-list-10046">
							<div class="list-box-listing bookings" style="margin: 1px 0;">
								<div class="list-box-listing-img"><img alt="" src="{{URL::asset('images/lista4.png')}}"  class="avatar avatar-70 photo" height="70" width="70" style="padding: 0 0px 0 0;"></div>
								<div class="list-box-listing-content">
									<div class="inner">
										@php
										$i = 1 ;
										$pedido= str_pad($receptions[0]->pending, 6, "0", STR_PAD_LEFT);
										@endphp

										@php
										$total=0.0;
										@endphp
										@foreach ($receptions as $receptions2)
												@php
												$total +=   $receptions2->total;
												@endphp
										@endforeach
										<h3 id="title" style="margin-bottom: 10px;"> Venta Nº{{$pedido}}  -  Total: {{$total}}
											{{-- <span class="booking-status pending">Waiting for owner confirmation</span> --}}
										</h3>

										@php 	$total=0.0; 	@endphp

										<div class="row">
											<div class="col-sm-12">
														@foreach ($receptions as $receptions2)
															{{-- highlighted --}}
															<div class="inner-booking-list">
																<ul class="booking-list">
																	<li class="" id="name">
																		<h5>Producto {{$i}}:</h5> {{$receptions2->name}} {{$receptions2->at_name}} {{$receptions2->va_name}}
																		@php
																		$total +=   $receptions2->total;
																		$i = $i + 1;
																		@endphp
																	</li>
																	<li id="name"><h5>Precio:</h5>  {{$receptions2->price}}</li>
																	<li id="name"><h5>Cantidad:</h5>  {{$receptions2->quantity}}</li>
																	<li id="name"><h5>Total:</h5>  {{$receptions2->total}}</li>
																	<li id="name"><h5>Tiempo de entrega:</h5> {{$receptions[0]->time_delay}} </li>
																</ul>
															</div>
														@endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
					@endforeach


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
