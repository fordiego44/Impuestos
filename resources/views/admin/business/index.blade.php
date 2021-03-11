@extends('admin.app')
@section('content')

<div class="dashboard-content">
  		<div id="titlebar">
  			<div class="row">
  				<div class="col-md-12">
            <h1>Empresas</h1>
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/superadmin">Empresas</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>


      <div class="dashboard-list-box margin-top-0">
              <div class="list-box-listing">
                <div >
                  <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Listado de empresas</h4>
                </div>
                <div class="list-box-listing-content col-md-6">
                    <div class="inner float-right" style="display:flex; justify-content:flex-end">
                       <a href="/superadmin/categoria/nuevo" class="button"> Nueva Categoria</a>
                    </div>
                  </div>
              </div>

            <div id="listing-reviews" class="listing-section">

              <ul id="booking-requests">
                @foreach ($business as  $busines)
                <li class="user-booking waiting-booking" style="padding: 5px 10px;" id="booking-list-10046">
                    <i class="list-box-icon sl sl-icon-layers"></i>
                  <div class="list-box-listing bookings"  >
                    <div class="list-box-listing-img">
                        {{-- <img alt="" src="{{URL::asset('images/'.$busines->image)}}" class="avatar avatar-70 photo" height="70" width="70" style="padding-right: 0px;"> --}}
                    </div>
                    <div class="list-box-listing-content">
                      <div class="inner">
                        <h3 id="title" style="margin-bottom: 10px;"><a href="#">{{$busines->name}} </a> <span class="booking-status pending">Waiting for owner confirmation</span></h3>
                      </div>
                      <div class="buttons-to-right">
                        <a href="/superadmin/categoria/editar/{{$busines->id}}" class=" edit button gray"><i class="sl sl-icon-close"></i> Editar</a>
                        <a href="/superadmin/categoria/activar/{{$busines->id}}" class="button gray"> @if($busines->isShow) Ocultar @else Mostrar @endif</a>
                      </div>
                    </div>
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

</div>
@endsection
