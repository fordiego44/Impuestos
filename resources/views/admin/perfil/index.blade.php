@extends('admin.app')
@section('content')
<div class="dashboard-content" id="post-45">
				<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
					<div style="display:inline-block;width: 100%;max-width: 550px;">
						<h1>Mi Perfil</h1>
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
						<li class="active"><a href="#tab1a">Datos Generales</a></li>
						<li class=""><a href="#tab2a"> Contraseña</a></li>
					
					</ul>

					<!-- Tabs Content -->
					<div class="tabs-container">
						<div class="tab-content" id="tab1a" style="display: none;">

							<div class="col-lg-12 col-md-12" >

								<div class="dashboard-list-box margin-top-0">

									<div class="add-listing-section margin-top-0">


										<div class="add-listing-headline" style="    margin-bottom: 0px;background-color: #f7f7f7;">
											<h3 style="font-weight: 600;font-size: 16px;line-height: 10px;">Datos del Perfil</h3>


										</div>

										<div class="submit-section">
											<form method="post" action="/superadmin/edit-profile" id="edit-profile" method="POST" enctype="multipart/form-data">

												@csrf
												
												<div style="margin-top: 15px;">


													<div class="row">
														
														<div class=" col-lg-6">
																<label for="ruc">RUC</label>
																<input class="text-input" name="ruc" id="ruc" type="text" id="ruc" value="{{$admin->ruc}}" placeholder="Ingrese su RUC">
														</div>
														<div class=" col-lg-6">
															<label for="company">Nombre de la Empresa</label>
															<input class="text-input" name="company" id="company" type="text" id="company" value="{{$admin->name_business}}" placeholder="ejm. Pollo Pechugón">
														</div>
														<div class=" col-lg-6">
																<label for="first-name">Nombre</label>
																<input class="text-input" name="name" id="name" type="text" id="first-name" value="{{$admin->name}}" placeholder="ejm. Pérez Chambilla">
														</div>
														<div class=" col-lg-6">
																<label for="last-name">Apellido</label>
																<input class="text-input" name="lastname" id="lastname" type="text" id="last-name" value="{{$admin->last_name}}" placeholder="ejm. Pérez Chambilla">
														</div>
														<div class=" col-lg-6">
																<label for="phone">Teléfono</label>
																<input class="text-input" name="phone" id="phone" type="text" id="phone" value="{{$admin->telefono}}" placeholder="ejm. 952######">
														</div>
														<div class="col-lg-6">
																<label for="email">E-mail</label>
																<input class="text-input" name="email" id="email" type="email" value="{{$admin->email}}" placeholder="ejm. usuario@example.com">

														</div>
														<div class="col-lg-12">
																<label for="email">Descripcion</label>
																<textarea class="text-input" name="description" type="text" placeholder="ejm. Nuestra empresa cuenta...">{{$admin->description}}</textarea>
														</div>
														<div class="col-lg-12">
														
														<input type="submit"
														style="height: 44px;text-align: center;margin-left: 9px;" form="edit-profile" value="Guardar"
													 	class="button margin-top-20 margin-bottom-20"/>
													</div>

													</div>


												</div>


											</form>
										</div>
									</div>

								</div>
							</div>

						</div>

						<div class="tab-content" id="tab2a" style="">
							<div class="col-lg-12 col-md-12">
								<div class="dashboard-list-box margin-top-0">
									<div class="add-listing-section margin-top-0">
										<div class="add-listing-headline" style="    margin-bottom: 0px; background-color: #f7f7f7;">
											<h3 style="font-weight: 600;font-size: 16px;line-height: 10px;">Ubicación</h3>
                                        </div>
                                        <div class="submit-section">
                                            
                                            <div class="margin-top-10 message-file"> 
                                    
                                            </div>
                                        </div>
										<div class="submit-section">
											
													<div style="margin-top: 15px;">
														<div class="col-lg-4">
															<label for="direccion">Contraseña actual:</label>
															<input class="text-input" name="password" id="password" type="password" value="">
														</div>
														<div class="col-lg-4">
															<label for="longitud">Contraseña nueva:</label>
															<input class="text-input" name="password_old" id="password_old" type="password" value="">
														</div>
														<div class="col-lg-4">
															<label for="latitud">Confirmar contraseña nueva:</label>
															<input class="text-input" name="password_old_two" id="password_old_two" type="password" value="">
														</div>
                                                        
                                                        

                                                    </div>
                                                    
												    <button id="guardar" style="height: 44px;text-align: center;margin-left: 10px;" class="button margin-top-20 margin-bottom-20">Guardar</button>
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
@section('after-scripts')
<script src={{asset('/js/superadmin.js')}}></script>

@endsection
