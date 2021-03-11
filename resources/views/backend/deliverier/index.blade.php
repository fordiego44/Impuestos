@extends('backend.app')
@section('content')

<div class="dashboard-content">
  		<div id="titlebar">
  			<div class="row">
  				<div class="col-md-12">
  										<h1>Repartidores</h1>
  										<!-- Breadcrumbs -->
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/admin/repartidores">Repartidores</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>


      <div class="dashboard-list-box margin-top-0">
              <div class="list-box-listing">
                <div >
                  <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Listado de repartidores</h4>
                </div>
                <div class="list-box-listing-content col-md-6">
                  <div class="inner float-right" style="display:flex; justify-content:flex-end">
                    <a href="/admin/repartidores/guia" class="button" style="background-color:#657375"> Manual de uso</a>
                    <a href="/admin/repartidores/nuevo-repartidor" class="button"> Nuevo repartidor</a>
                  </div>
                </div>
              </div>

            <div id="listing-reviews" class="listing-section">

              <ul id="booking-requests">
                @foreach ($deliverier as  $deliveriers)
                <li class="user-booking waiting-booking" style="padding: 10px 30px;" id="booking-list-10046">
                  <div class="list-box-listing bookings"  style="margin: 1px 0;">
                    <div class="list-box-listing-img" style="margin-top: 0px;"><img alt="" src="{{URL::asset('images/'.$deliveriers->image)}}"  class="avatar avatar-70 photo" height="70" width="70" style="padding-right: 0px;"></div>
                    <div class="list-box-listing-content">
                      <div class="inner">
                        <h3 id="title" style="margin-bottom: 10px;"><a href="#">{{$deliveriers->name}} , {{$deliveriers->last_name}}</a> <span class="booking-status pending">Waiting for owner confirmation</span></h3>

                            <div class="inner-booking-list">
                              <h5>DNI:</h5>
                              <ul class="booking-list">
                                {{-- highlighted --}}
                                <li class="" id="date">{{$deliveriers->dni}}</li>
                                <li class="" id="date"><h5>Email:</h5> {{$deliveriers->email}}</li>
                                <li class="" id="date"><h5>Celular:</h5> {{$deliveriers->phone}}</li>
                                {{-- <li class="" id="date"><h5>Dirección:</h5>{{$deliveriers->direction}}</li> --}}
                              </ul>
                            </div>
                      </div>
                    </div>
                  </div>
                  <div class="buttons-to-right"  >
                    <a href="/admin/repartidores/editarDeliverier/{{$deliveriers->id}}" class="button gray  " data-booking_id="10046"><i class="sl sl-icon-close"></i> Editar</a>
                    <a href="/admin/repartidores/eliminarDeliverier/{{$deliveriers->id}}" class="button gray  " data-booking_id="10046"><i class="sl sl-icon-close"></i> Eliminar</a>
                  </div>
                </li>
              @endforeach
		           </ul>
          	</div>
      </div>

  {{-- --------------------------------------------------------- --}}

    <div class="row">
        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">Derechos reservados. ®Rcom Global LCC.</div>
        </div>
    </div>
    <div style="height:200px">

    </div>
</div>
@endsection
