@extends('backend.app')
@section('content')

<div class="dashboard-content" id="post-45">
				<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
					<div style="display:inline-block;width: 100%;max-width: 550px;">
						<h1>Importar productos por archivo Excel</h1>
						<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/admin/productos">Productos</a></li>
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


					<!-- Tabs Content -->
					<div class="tabs-container">
						@if (isset($error))
							<div class="col-md-12">
								<div class="notification error closeable">
									<p><span>Error!</span> Utilize la plantilla para cumplir con los requisitos</p>
									<a class="close"></a>
								</div>
							</div>
						@endif

							<div class="col-lg-12 col-md-12" >

								<div class="dashboard-list-box margin-top-0">

									<div class="add-listing-section margin-top-0" style="padding-top: 25px;">


										<div class="submit-section">
											<form  action="/admin/productos/registrarExcel" method="POST"  enctype="multipart/form-data">
								        @csrf
												<div class="form-group">
													<input required type="file"  name="file"  accept=".xlsx">
													<p>Descargue una plantilla de <a href="/admin/productos/bajarExcel" style=" color: #4caf50;font-weight: bold;">archivo Excel</a> para ver un ejemplo del formato requerido.</p>
													<div style=" display: flex;">
														<button type="submit" class="button" style="" name="subir">Subir archivo</button>  <a href="/admin/productos" style="margin-left:10px; background-color:#657375" class="button">Cancelar</a>
													</div>
												</div>
											</form>

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
