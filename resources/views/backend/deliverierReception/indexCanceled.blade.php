@extends('backend.app')
@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}


				<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
										<h1>Anulados</h1>
										<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="#">Dashboard</a></li>
							<li><a href="#">Recepción</a></li>
							<li><a href="/admin/recepciones/anulado">Anulados</a></li>
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
				<div class="list-box-listing-content col-md-6">
					<div class="inner float-right" style="display:flex; justify-content:flex-end">
						{{-- <a href="/admin/clasificaciones/nuevaClasificacion" class="button"> Nueva categoría</a> --}}

						@php
							$message = Session::get('valor2')
						@endphp
						<div class="right-side">
								<div class="header-widget">
									<div class="user-menu">
										<div class="user-name">Recepciones</div>
										<ul>
										@foreach ($message as $a)
										<li style="padding: 0px"><a href="/admin/recepciones/proceso">En proceso ({{$a->proceso}})</a></li>
										<li style="padding: 0px"><a href="/admin/recepciones/realizado">Realizados ({{$a->realizado}})</a></li>
										<li style="padding: 0px"><a href="/admin/recepciones/anulado">Anulados ({{$a->anulado}})</a></li>
										@endforeach
										</ul>
									</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<ul id="ul-principal">
	      @foreach ($reception as $receptions)
					<li class="user-booking waiting-booking" style="padding: 0px 30px;" id="booking-list-10046">
								<div class="list-box-listing bookings" style="margin: 1px 0;">
									<div class="list-box-listing-img"><img alt="" src="{{URL::asset('images/lista3.png')}}"  class="avatar avatar-70 photo" height="70" width="70"></div>
									<div class="list-box-listing-content">
										<div class="inner">
											@php
											$pedido= str_pad($receptions[0]->pending, 6, "0", STR_PAD_LEFT);
											@endphp
											<h3 id="title"><a href="#">Pedido Nº: {{$pedido}}, </a> <span class="booking-status pending">Waiting for owner confirmation</span></h3>

											<div class="row">
												<div class="col-sm-8">
													<div class="inner-booking-list">
														<h5>Fecha recepción:</h5>
														<ul class="booking-list">
															<li class="highlighted" id="date">{{$receptions[0]->date_reception}}</li>
														</ul>
													</div>
													<div class="inner-booking-list">
														<h5>Detalle del pedido:</h5>
														<ul class="booking-list">
															@php
																$total=0.0;
															@endphp
															@foreach ($receptions as $receptions2)
															<li class="highlighted" id="details">
																{{$receptions2->quantity}} {{$receptions2->name}}
																@php
																	$total +=   $receptions2->total;
																@endphp
															</li>
															@endforeach
															</ul>
														</div>

														<div class="inner-booking-list">
															<h5>Cliente:</h5>
															<ul class="booking-list" id="client">
																<li id="name">{{$receptions[0]->nombre}}, {{$receptions[0]->last_name}}</li>
																<li id="email"><a >{{$receptions[0]->email}}</a></li>
																<li id="phone"><a >{{$receptions[0]->phone}}</a></li>
															</ul>
														</div>
														<div class="inner-booking-list">
			                              <h5>Repartidor</h5>
			                              <ul class="booking-list">

																				<select data-pending="{{$receptions[1]->pending}}"  style="padding: 2px 18px;height:30px;" class="asignar-repartidor">
																				 @php  $i = 0;  @endphp
																					 @foreach ($delivery as $deliveries)
																						 @if ($deliveries->id == $receptions[1]->deliverier_id )
																							 <option selected class=" " value="{{$deliveries->id}}">{{$deliveries->name}}</option>
																							 @php $i = 1; @endphp
																						 @else
																							 <option  class=" " value="{{$deliveries->id}}">{{$deliveries->name}}</option>
																						 @endif
																					 @endforeach
																						 @if ($i == 0)
																							 <option disable selected class=" " value="0">Sin repartidor</option>
																						 @endif
																				</select>

			                                </ul>
			                            </div>
												</div>
												<div class="col-sm-4">
													<div class="inner-booking-list">
														<h5>Precio total:</h5>
														<ul class="booking-list">
															<li class="highlighted" id="price">
																S/. {{$total}}
															</li>
														</ul>
													</div>
												</div>
											</div>





														{{-- <a href="#small-dialog" data-recipient="5" data-booking_id="booking_10046" class="booking-message rate-review popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a> --}}

										</div>
									</div>
								</div>
								<div class="buttons-to-right">
									<a href="/admin/recepciones/proceso/{{$receptions[0]->pending}}/3" class="button gray  "  ><i class="sl sl-icon-close"></i> Proceso</a>
									<a href="/admin/recepciones/realizado/{{$receptions[0]->pending}}/3" class="button gray  " ><i class="sl sl-icon-close"></i> Realizado</a>
									<a href="/admin/ver-mapa/{{$receptions[0]->pending}}" class="button gray  "  ><i class="sl sl-icon-close"></i> Ver ubicación</a>
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
