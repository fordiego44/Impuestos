@extends('frontend.app', ['bussines'=> $bussines, 'users' => $users])
@section('content')
<div class="clearfix"></div>
<div id="titlebar" class="gradient" style="margin-top:0px">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="user-profile-titlebar">
					<div class="user-profile-avatar"><img src="{{URL::asset('images/user-profile-avatar.jpg')}}"  alt="Imagen" ></div>
					<div class="user-profile-name">
					<h2>{{$costumer->name}},{{$costumer->last_name}}</h2>
						<div class="star-rating" data-rating="5">
							<div class="rating-counter"><a href="#listing-reviews"></a></div>
							{{-- <div class="rating-counter"><a href="#listing-reviews">(60 reviews)</a></div> --}}
						</div>
					</div>
				</div>

				<nav id="breadcrumbs">
						<ul>
							<li><a href="/">Inicio</a></li>
							<li><a href="/mi-perfil">Mi perfil</a></li>
							<li><a href="/mi-perfil/{{$id}}">Mis pedidos</a></li>
						</ul>
					</nav>

			</div>
		</div>
	</div>
</div>



<!-- Content
================================================== -->
<div class="container">
	<div class="row sticky-wrapper">


		<!-- Sidebar
		================================================== -->
		<div class="col-lg-4 col-md-4 margin-top-0">

			<!-- Verified Badge -->
			<div class="verified-badge with-tip" data-tip-content="Account has been verified and belongs to the person or organization represented.">
				<i class="sl sl-icon-user-following"></i> Cuenta verificada
			</div>

			<!-- Contact -->

			<div class="boxed-widget margin-top-30 margin-bottom-50">
				<h3>Datos personales</h3>
				<ul class="listing-details-sidebar">
					<li><i class="sl sl-icon-phone"></i> {{$costumer->phone}}</li>
					<li><i class="fa fa-envelope-o"></i> <a href="#"><span class="__cf_email__" data-cfemail=" ">{{$costumer->email}}</span></a></li>
				</ul>
 			</div>
			<!-- Contact / End-->

		</div>
		<div class="col-lg-8 col-md-8 padding-left-30">
			<h3 class="margin-top-0 margin-bottom-40">Mis pedidos en: {{$negocio[0]->company}}</h3>
			<div class="row">
				<div class="col-lg-12 col-md-12">

          <div class="dashboard-list-box margin-top-0">
						<ul id="ul-principal">
							@foreach ($reception as $receptions)
							 <li class="user-booking waiting-booking" style="padding: 10px 30px;" id="booking-list-10046">
										 <div class="list-box-listing bookings" style="margin: 1px 0;">
											 <div class="list-box-listing-img" style="margin-top: 30px;"><img alt="" src="{{URL::asset('images/factura1.jpg')}}"  class="avatar avatar-70 photo" height="70" width="70" style="padding: 0 0px 0 0;"></div>
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
																		 <ul class="booking-list">
																			 <li class="" id="date"><h5>Fecha del pedido:</h5> {{$receptions[0]->date_reception}}</li>
																			 <li class="" id=""> <h5>Precio total:</h5> S/. {{$total}} </li>
																			 	@php  $i = 0;  @endphp
																				 @foreach ($delivery as $deliveries)
																					 @if ($deliveries->id == $receptions[0]->deliverier_id )
																						 <li class="" id=""> <h5>Repartidor:</h5>{{$deliveries->name}},{{$deliveries->last_name}}</li>
																						 @php $i = 1; @endphp
																					 @endif
																				 @endforeach
																					 @if ($i == 0)
																						 <li class="" id=""> <h5>Repartidor:</h5>Sin repartidor</li>
																					 @endif
																			 {{-- <li class="" id=""> <h5>Repartidor:</h5>{{$receptions[0]->nombre}},{{$receptions[0]->last_name}}</li> --}}
																		 </ul>
																	 </div>

																	 <div class="inner-booking-list">
																		<h5>Declaración de salubridad y detalle de compra:</h5>
																		<ul class="booking-list">
																			@if ($receptions[0]->deliverier_id == 0)
																				<li class="" id=""><button type="button" data-id_deliverier="{{$receptions[0]->deliverier_id}}" data-date_declaration="{{$receptions[0]->date_reception}}"  class="" name="button">Salubridad</button></li>
																			@else

																				<li class="" id=""><button type="button" data-id_deliverier="{{$receptions[0]->deliverier_id}}" data-date_declaration="{{$receptions[0]->date_reception}}"  class="exportar-salubridad" name="button">Salubridad</button></li>
																			@endif
																			<li class="" id=""><button type="button" data-npedido="{{$receptions[0]->pending}}" data-empresa="{{$receptions[0]->id_user}}"  class="exportar-compra" name="button">Compra</button></li>
																		</ul>
																	</div>

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
		</div>
	</div>
</div>
@endsection

@section('after-scripts')
  <script src="{{ asset('js/frontend/misPedidos.js') }}"></script>
@endsection
