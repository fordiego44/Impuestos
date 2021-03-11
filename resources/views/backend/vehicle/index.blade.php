@extends('backend.app')

@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}

  				<!-- Titlebar -->
  		<div id="titlebar">
  			<div class="row">
  				<div class="col-md-12">
  										<h1>Vehículos</h1>
  										<!-- Breadcrumbs -->
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/admin/vehicle">Vehículos</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>


  <div class="dashboard-list-box margin-top-0">

    <div class="list-box-listing">
      <div >
        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Listado de vehículos</h4>
      </div>
      <div class="list-box-listing-content col-md-6">
        <div class="inner float-right" style="display:flex; justify-content:flex-end">
          <a href="/admin/vehicle/guia" class="button" style="background-color:#657375"> Manual de uso</a>
          <a href="/admin/vehicle/new" class="button"> Nuevo vehículo</a>
        </div>
      </div>
    </div>
  	<ul>
      @foreach ($vehicles as $vehicle)
  			<li>
  			<div class="list-box-listing">
  				<div class="list-box-listing-img">
						  <a style="height: 92%;" href="#">
						  @php
							  	$img = $vehicle->vehiclephoto;
							  	if($img){
								}
								else{
									$img = 'default.jpg';
								}
						  @endphp

						  <img style="width:170px; height:100px;" width="200" height="200" src="{{URL::asset('images/'.$img)}}" class="attachment-listeo_core-preview size-listeo_core-preview wp-post-image" alt="Imagen" ></a>
  				</div>
  				<div class="list-box-listing-content">
  					<div class="inner">
  						<h3><a href="">{{$vehicle->plaque}}</a></h3>
  						<span>{{$vehicle->type}}</span>

              <div class="listing-list-small-badges-container">
                                        <div class="listing-small-badge pricing-badge">{{$vehicle->license}}</div>
                                                                </div>
            </div>
  				</div>
  			</div>
  			<div class="buttons-to-right">
			  <a href="/admin/vehicle/edit/{{$vehicle->id}}" class=" delete button gray"><i class="sl sl-icon-close"></i> Editar</a>

  				<a href="/admin/vehicle/delete/{{$vehicle->id}}" class=" delete button gray" ><i class="sl sl-icon-close"></i> Eliminar</a>
  			</div>
  		</li>
      @endforeach
  	</ul>
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
@endsection
