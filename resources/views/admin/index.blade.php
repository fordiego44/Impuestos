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

              </div>

            <div id="listing-reviews" class="listing-section">

              <ul id="booking-requests">
                @foreach ($users as  $user)
                <li class="user-booking waiting-booking" style="padding: 10px 30px;" id="booking-list-10046">
                  <div class="list-box-listing bookings"  style="margin: 1px 0;">
                    <div class="list-box-listing-img" style="margin-top: 0px;"><img alt="" src="{{URL::asset('images/'.$user->image)}}"  class="avatar avatar-70 photo" height="70" width="70" style="padding-right: 0px;"></div>
                    <div class="list-box-listing-content">
                      <div class="inner">
                        <h3 id="title" style="margin-bottom: 10px;"><a href="#">{{$user->company}} | {{$user->name}}</a> <span class="booking-status pending">Waiting for owner confirmation</span></h3>

                            <div class="inner-booking-list">
                              <h5>DNI:</h5>
                              <ul class="booking-list">
                                <li class="" id="date">{{$user->dni}}</li>
                                <li class="" id="date"><h5>Email:</h5> {{$user->email}}</li>
                                <li class="" id="date"><h5>Celular:</h5> {{$user->phone}}</li>
                              </ul>
                            </div>
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
