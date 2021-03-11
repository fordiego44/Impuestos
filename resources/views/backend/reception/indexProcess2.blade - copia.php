@extends('backend.app')
@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}

		@php
		$message2 = Session::get('rol');
		@endphp
				<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
										<h1>En proceso</h1>
										<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							@if ($message2[0] == "administrador")
								<li><a href="#">Dashboard</a></li>
								<li><a href="#">Recepción</a></li>
								<li><a href="/admin/recepciones/proceso">Recepciones</a></li>
							@else
								<li><a href="#">Dashboard</a></li>
								<li><a href="#">Recepción</a></li>
								<li><a href="/admin/repartidor/recepciones/proceso">Realizados</a></li>
							@endif
							{{-- <li><a href="/admin/recepciones/proceso">En proceso</a></li> --}}
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
	        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Lista pendiente	</h4>
	      </div>

	      <div class="list-box-listing-content ">
	        <div class="inner float-right" style="display:flex; justify-content:flex-end">
	         	<div style="height:10%;">
							<a href="/admin/recepcion/guia" class="button" style="background-color:#657375"> Manual de uso</a>
						</div>
						@php
							$message = Session::get('valor2')
						@endphp
						<div class="right-side">
								<div class="header-widget">
									<div class="user-menu" style="flex-direction: row-reverse;display: inline-flex;">
										<div class="user-name" >Recepciones</div>
										<ul style="float: right; margin: 0px 0px 0px 60%; ">

											@if ($message2[0] == "administrador")
												@foreach ($message as $a)
												<li style="padding: 0px"><a href="/admin/recepciones/proceso">En proceso ({{$a->proceso}})</a></li>
												<li style="padding: 0px"><a href="/admin/recepciones/realizado">Realizados ({{$a->realizado}})</a></li>
												<li style="padding: 0px"><a href="/admin/recepciones/anulado">Anulados ({{$a->anulado}})</a></li>
												@endforeach
											@else
												@foreach ($message as $a)
												<li style="padding: 0px"><a href="/admin/repartidor/recepciones/proceso">En proceso ({{$a->proceso}})</a></li>
												<li style="padding: 0px"><a href="/admin/repartidor/recepciones/realizado">Realizados ({{$a->realizado}})</a></li>
												<li style="padding: 0px"><a href="/admin/repartidor/recepciones/anulado">Anulados ({{$a->anulado}})</a></li>
												@endforeach
											@endif
										</ul>
									</div>
							</div>
						</div>

	        </div>
	      </div>
	    </div>

		<ul id="ul-principal">
      @foreach ($reception as $receptions)
				<li class="user-booking waiting-booking" style="padding: 10px 30px;" id="booking-list-10046">
							<div class="list-box-listing bookings" style="margin: 1px 0;">
								<div class="list-box-listing-img" style="margin-top: 30px;"><img alt="" src="{{URL::asset('images/lista4.png')}}"  class="avatar avatar-70 photo" height="70" width="70" style="padding: 0 0px 0 0;"></div>
								<div class="list-box-listing-content">
									<div class="inner">
										@php
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
										<h3 id="title" style="margin-bottom: 10px;"><a href="#">Pedido Nº: {{$pedido}} </a>
											{{-- <span class="booking-status pending">Waiting for owner confirmation</span> --}}
										</h3>

										<div class="row">
											<div class="col-sm-12">
												<div class="inner-booking-list">
													<h5>Fecha recepción:</h5>
													<ul class="booking-list">
														<li class="" id="date">{{$receptions[0]->date_reception}}</li>
														<li class="" id=""> <h5>Precio total:</h5> S/. {{$total}} </li>
															@if ($message2[0] == "administrador")
																<li class="" id=""> <h5>Repartidor:</h5></li>
																<li class="" id="">

																						<select data-pending="{{$receptions[0]->pending}}"  style="padding: 2px 18px;height:30px;margin-bottom: 0" class="asignar-repartidor" >
																						 @php  $i = 0;  @endphp
																							 @foreach ($delivery as $deliveries)
																								 @if ($deliveries->id == $receptions[0]->deliverier_id )
																									 <option selected class=" " value="{{$deliveries->id}}">{{$deliveries->name}}</option>
																									 @php $i = 1; @endphp
																								 @else
																									 <option  class=" " value="{{$deliveries->id}}">{{$deliveries->name}}</option>
																								 @endif
																							 @endforeach
																								 @if ($i == 0)
																									 <option disable selected class=" " value="0">Sin repartidor</option>
																								@else
																										<option  class=" " value="0">Sin repartidor</option>
																								 @endif
																						</select>
																					</li>
																	@endif
													</ul>
												</div>
												{{-- <div class="inner-booking-list">
													<h5>Precio total:</h5>
													<ul class="booking-list">
														<li class="highlighted" id="price">
															S/. {{$total}}
														</li>
													</ul>
												</div> --}}
												<div class="inner-booking-list">
													<h5>Cliente:</h5>
													<ul class="booking-list" id="client">
														<li id="name">{{$receptions[0]->nombre}}, {{$receptions[0]->last_name}}</li>
														<li id="email">{{$receptions[0]->email}}</li>
														<li id="phone">{{$receptions[0]->phone}}</li>
													</ul>
												</div>

												<div class="inner-booking-list">
													<h5>Detalle del pedido:</h5>
													<ul class="booking-list">
														@php
														$total=0.0;
														@endphp
														@foreach ($receptions as $receptions2) 
															{{-- highlighted --}}
															<li class="" id="details">
																{{$receptions2->quantity}} {{$receptions2->name}} {{$receptions2->at_name}} {{$receptions2->va_name}}
																@php
																$total +=   $receptions2->total;
																@endphp
															</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="buttons-to-right" style="top: 20%;">
								@if ($message2[0] == "administrador")
									<a href="/admin/recepciones/realizado/{{$receptions[0]->pending}}/1" class="button gray  " >Realizado</a>
									<a href="/admin/recepciones/anulado/{{$receptions[0]->pending}}/1" class="button gray  "  >Anulado</a>
									<a href="/admin/recepciones/ver-mapa/{{$receptions[0]->pending}}" class="button gray  "  ><i class="sl sl-icon-close"></i>Ver ubicación y voucher</a>
								@else
									<a href="/admin/repartidor/recepciones/realizado/{{$receptions[0]->pending}}/1" class="button gray  " > Realizado</a>
									<a href="/admin/repartidor/recepciones/anulado/{{$receptions[0]->pending}}/1" class="button gray  "  > Anulado</a>
									<a href="/admin/repartidor/ver-mapa/{{$receptions[0]->pending}}" class="button gray  "  ><i class="sl sl-icon-close"></i>Ver ubicación</a>
								@endif
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
@section('js')
  <script src="{{ asset('js/backend/reception.js') }}"></script>
@endsection
