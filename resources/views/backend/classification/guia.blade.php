@extends('backend.app')
@section('content')

<div class="dashboard-content" id="post-45">
				<!-- Titlebar -->
		<div id="titlebar">
			<div class="row"> 
				<div class="col-md-12">
					<div style="display:inline-block;width: 100%;max-width: 550px;">
						<h1>Manual de uso de categorías</h1>
						<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/admin/clasificaciones">Categorías</a></li>
  						</ul>
  					</nav>
					</div>
				</div>
			</div>
		</div>



		<div class="row">

		<!-- Profile -->
		<div class="col-lg-12 col-md-12">

				<div class="style-1">
					<!-- Tabs Navigation -->
					<ul class="tabs-nav">
						<li class="active"><a href="#tab1a">Generar nueva categoría</a></li>
						<li class=""><a href="#tab2a">Editar categoría</a></li>
						<li class=""><a href="#tab3a">Eliminar categoría</a></li>
					</ul>

					<!-- Tabs Content -->
					<div class="tabs-container">
						<div class="tab-content" id="tab1a" style="display: none;">

							<div class="col-lg-12 col-md-12" >

								<div class="dashboard-list-box margin-top-0">

									<div class="add-listing-section margin-top-0" style="padding-top: 25px;">


										<div class="submit-section">
												 	<video width="100%" height="480px" controls preload>
													    <source src="{{URL::asset('video/clasificacion1.mp4')}}" type="video/mp4">
													</video>
										</div>
									</div>

								</div>
							</div>

						</div>

						<div class="tab-content" id="tab2a" style="">
							<div class="col-lg-12 col-md-12" >

								<div class="dashboard-list-box margin-top-0">

									<div class="add-listing-section margin-top-0" style="padding-top: 25px;">


										<div class="submit-section">
												 	<video width="100%" height="480px" controls preload>
													    <source src="{{URL::asset('video/clasificacion2.mp4')}}" type="video/mp4">
													</video>
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="tab-content" id="tab3a" style="">
							<div class="col-lg-12 col-md-12" >

								<div class="dashboard-list-box margin-top-0">

									<div class="add-listing-section margin-top-0" style="padding-top: 25px;">


										<div class="submit-section">
												 	<video width="100%" height="480px" controls preload>
													    <source src="{{URL::asset('video/clasificacion3.mp4')}}" type="video/mp4">
													</video>
										</div>
									</div>

								</div>
							</div>
						</div>



					</div>
				</div>

		</div>




	</div>
		<!-- Copyrights -->
	<div class="row">
		<div class="col-md-12">
			<div class="copyrights">Derechos reservados. ®Rcom Global LCC.</div>
		</div>
	</div>

</div>
@endsection


@section('js')


@endsection
