@extends('backend.app')
@section('content')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
<script src="{{ asset('js/dropzone.js') }}"></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />


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
		@php
			$id = $user->id;
			$img = $user->image;


			if($img){
			}
			else{
				$img = 'default.jpg';
			}
			$url = asset('images/'.$img);

			foreach($day as $days){
				$monday1 = $days->monday1;
				$monday2 = $days->monday2;
				$tuesday1 = $days->tuesday1;
				$tuesday2 = $days->tuesday2;
				$wednesday1 = $days->wednesday1;
				$wednesday2 = $days->wednesday2;
				$thursday1 = $days->thursday1;
				$thursday2 = $days->thursday2;
				$friday1 = $days->friday1;
				$friday2 = $days->friday2;
				$saturday1 = $days->saturday1;
				$saturday2 = $days->saturday2;
				$sunday1 = $days->sunday1;
				$sunday2 = $days->sunday2;
			}


		@endphp
		<!-- Profile -->
		<div class="col-lg-12 col-md-12">

				<div class="style-1">
					<!-- Tabs Navigation -->
					<ul class="tabs-nav">
						<li class="active"><a href="#tab1a"><i class="im im-icon-File-Edit"></i>Datos Generales</a></li>
						<li class=""><a href="#tab2a"><i class="im im-icon-Geo2-Star"></i>Ubicación</a></li>
						<li class=""><a href="#tab3a"><i class="im im-icon-Photos"></i>Galería</a></li>
						<li class=""><a href="#tab4a"><i class="im im-icon-Hour"></i>Horarios de Atención</a></li>
						<li class=""><a href="#tab5a"><i class="im im-icon-Newspaper"></i>Manual de uso</a></li>
					</ul>

					<!-- Tabs Content -->
					<div class="tabs-container">
						<div class="tab-content" id="tab1a" style="display: none;">

							<div class="col-lg-12 col-md-12" >

								<div class="dashboard-list-box margin-top-0">

									<div class="add-listing-section margin-top-0">


										<div class="add-listing-headline" style="    margin-bottom: 0px;background-color: #f7f7f7;">
											<h3 style="font-weight: 600;font-size: 16px;line-height: 10px;">Datos del Perfil</h3>

											@if($user->state == 1)
												<label class="switch"><input type="checkbox" id="open" checked><span class="slider round"></span></label>

											@else
												<label class="switch"><input type="checkbox" id="open" unchecked><span class="slider round" ></span></label>

											@endif

										</div>

										<div class="submit-section">
											<form method="post" action="/admin/profile/edit" id="edit-profile" method="POST" enctype="multipart/form-data">

												@csrf
												<div class="row" style="margin-top:30px">

														<div class="col-sm-4">

														</div>
														<div class="col-sm-4">
															<div class="edit-profile-photo">
																<img id="imagenPrevisualizacion" src="{{URL::asset('images/'.$img)}}" alt="">
																<div class="change-photo-btn">
																	<div class="photoUpload">
																		<span><i class="fa fa-upload"></i> Subir imagen</span>
																		<input type="file" class="upload" id="seleccionArchivos" name="file"/>
																	</div>
																</div>
															</div>
															<div class="col-sm-4">

															</div>
														</div>
												</div>

													<div class="row">
														<div class=" col-lg-4">
															<label for="company">Nombre de la Empresa</label>
															<div class="input-with-icon medium-icons">
																<input class="text-input" name="company" id="company" type="text" id="company" value="{{$user->company}}" placeholder="ejm. Pollo Pechugón">
																<i class="im im-icon-Green-House"></i>
															</div>
														</div>

														<div class=" col-lg-4">
																<label for="ruc">RUC</label>
																<div class="input-with-icon medium-icons">
																	<input class="text-input" name="ruc" id="ruc" type="text" id="ruc" value="{{$user->ruc}}" placeholder="Ingrese su RUC">
																	<i class="im im-icon-Search-People"></i>
																</div>
														</div>
														<div class=" col-lg-4">
																<label for="phone">Teléfono</label>
																<div class="input-with-icon medium-icons">
																	<input class="text-input" name="phone" id="phone" type="number" id="phone" value="{{$user->phone}}" placeholder="ejm. 952######"  min="100000000">
																	<i class="im im-icon-Telephone"></i>
																</div>
														</div>
														<div class=" col-lg-4">
															<label for="dni">DNI</label>
															<div class="input-with-icon medium-icons">
															<input class="text-input" name="dni" id="dni" type="text" id="dni" value="{{$user->dni}}" placeholder="Ingrese su DNI">
															<i class="im im-icon-Credit-Card3"></i>
														</div>
														</div>
														<div class=" col-lg-4">
																<label for="first-name">Nombres</label>
																<div class="input-with-icon medium-icons">
																	<input class="text-input" name="name" type="text" id="first-name" value="{{$user->name}}">
																	<i class="im im-icon-Pen"></i>
																</div>
														</div>
														<div class=" col-lg-4">
															<label for="last-name">Apellidos</label>
															<div class="input-with-icon medium-icons">
																<input class="text-input" name="lastname" type="text" id="last-name" value="{{$user->last_name}}" placeholder="ejm. Pérez Chambilla">
																<i class="im im-icon-Pen"></i>
															</div>
														</div>

														<div class="col-lg-4">
															<label for="">Provincia</label>
															<select name="province" id="province_id">
																@foreach ($provincias as $item)
																	@if ($item->_id == $user->province)
																		<option value={{$item->_id}} selected>{{$item->name}}</option>
																	@else
																		<option value={{$item->_id}}>{{$item->name}}</option>
																	@endif
																@endforeach
															</select>
														</div>
														<div class="col-lg-4">
															<label for="">Distrito</label>
															<select name="district" id="district_id">
																@foreach ($distritos as $item)
																	@if ($item->_id == $user->district)
																		<option value={{$item->_id}} selected>{{$item->name}}</option>
																	@else
																		<option value={{$item->_id}}>{{$item->name}}</option>
																	@endif
																@endforeach
															</select>
														</div>

														<div class=" col-lg-4">
																<label for="cellphone">Celular</label>
																<div class="input-with-icon medium-icons">
																	<input class="text-input" name="cellphone" id="cellphone" type="number" id="cellphone" value="{{$user->cellphone}}" placeholder="ejm. 952######"  min="100000000">
																	<i class="im im-icon-Smartphone-4"></i>
																</div>
														</div>

														<div class="col-lg-12">
																<label for="email">Descripcion</label>
																<textarea class="text-input" name="description" id="description" type="text" placeholder="ejm. Nuestra empresa cuenta...">{{$user->description}}</textarea>
														</div>
														<div class="col-lg-6">
														<input class="text-input" name="" id="id" type="text"  value="{{$user->id}}" style="display:none;">
														<input class="text-input" name="" id="imagen" type="text"  value="{{$url}}" style="display:none;">

														<input type="submit"
														style="height: 44px;text-align: center;margin-left: 9px;" form="edit-profile" value="Guardar"
													 	class="button margin-top-20 margin-bottom-20"/>
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
											<input disabled type="hidden" id="region" name="" value="">
											<form method="post" action="" id="edit-ubication" method="POST" enctype="multipart/form-data">
													@csrf
												<div class="notification notice closeable margin-top-15">
													<p> ¡Mueve el marcador a tu ubicación! Esto servira como referente a tu dirección. </p>

												</div>
												<div id='map' style="padding-top: 15px;width: 100%;height: 500px;">
												</div>
													<div style="margin-top: 15px;">
														<div class="col-lg-6">
															<label for="direccion">Dirección</label>
															<input class="text-input" name="direccion" id="direccion" type="text" value="{{$user->address}}" readonly>
														</div>
														<div class="col-lg-3">
															<label for="longitud">Longitud</label>
															<input class="text-input" name="longitud" id="longitud" type="text" value="{{$user->longitude}}" readonly>
														</div>
														<div class="col-lg-3">
															<label for="latitud">Latitud</label>
															<input class="text-input" name="latitud" id="latitud" type="text" value="{{$user->latitude}}" readonly>
														</div>
													</div>
												<input type="submit"   style="height: 44px;text-align: center;margin-left: 10px;" form="edit-ubication" value="Guardar" class="button margin-top-20 margin-bottom-20"></input>

											</form>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-content" id="tab3a" style="">
							<div class="col-lg-12 col-md-12"><!--col-lg-12 col-md-12-->

								<div class="dashboard-list-box margin-top-0">

									<div class="add-listing-section margin-top-0">


										<div class="add-listing-headline" style="margin-bottom: 0px;background-color: #f7f7f7;">
											<h3 style="font-weight: 600;font-size: 16px;line-height: 10px;">Galería de Fotos</h3>
										</div>
										<div class="submit-section">
											<form  method="POST" class="dropzone" id="gallery" enctype="multipart/form-data" >
												@csrf
												<input  type="hidden" id="l-g-producto" name="producto" value="">

											</form>
										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="tab-content" id="tab4a" style="display: none;">
							<div class="col-lg-12 col-md-12" >

								<div class="dashboard-list-box margin-top-0" >
									<div class="add-listing-section margin-top-0">


										<div class="add-listing-headline" style="    margin-bottom: 21px;background-color: #f7f7f7;">
											<h3 style="font-weight: 600;font-size: 16px;line-height: 10px;">Dias de Atención</h3>
											<label class="switch">
												<input style="display:none;" type="checkbox" checked>
											</label>
										</div>

										<div class="switcher-content">

											<div class="row opening-day js-demo-hours">
												<div class="col-md-2"><h5>Lunes</h5></div>
												<div class="col-md-5">
													<select class="chosen-select" id="monday1" data-placeholder="Hora de Apertura" data-val="{{$monday1}}">

													</select>
												</div>
												<div class="col-md-5">
													<select class="chosen-select" id="monday2" data-placeholder="Hora de Cierre" data-val="{{$monday2}}">

													</select>
												</div>
											</div>



											<div class="row opening-day js-demo-hours">
												<div class="col-md-2"><h5>Martes</h5></div>
												<div class="col-md-5">
													<select class="chosen-select" id="tuesday1" data-placeholder="Hora de Apertura" data-val="{{$tuesday1}}">

													</select>
												</div>
												<div class="col-md-5">
													<select class="chosen-select" id="tuesday2" data-placeholder="Hora de Cierre" data-val="{{$tuesday2}}">

													</select>
												</div>
											</div>



											<div class="row opening-day js-demo-hours">
												<div class="col-md-2"><h5>Miercoles</h5></div>
												<div class="col-md-5">
													<select class="chosen-select" id="wednesday1" data-placeholder="Hora de Apertura" data-val="{{$wednesday1}}">

													</select>
												</div>
												<div class="col-md-5">
													<select class="chosen-select" id="wednesday2" data-placeholder="Hora de Cierre" data-val="{{$wednesday2}}">

													</select>
												</div>
											</div>



											<div class="row opening-day js-demo-hours">
												<div class="col-md-2"><h5>Jueves</h5></div>
												<div class="col-md-5">
													<select class="chosen-select" id="thursday1" data-placeholder="Hora de Apertura" data-val="{{$thursday1}}">

													</select>
												</div>
												<div class="col-md-5">
													<select class="chosen-select" id="thursday2" data-placeholder="Hora de Cierre" data-val="{{$thursday2}}">

													</select>
												</div>
											</div>



											<div class="row opening-day js-demo-hours">
												<div class="col-md-2"><h5>Viernes</h5></div>
												<div class="col-md-5">
													<select class="chosen-select" id="friday1" data-placeholder="Hora de Apertura" data-val="{{$friday1}}">

													</select>
												</div>
												<div class="col-md-5">
													<select class="chosen-select" id="friday2" data-placeholder="Hora de Cierre" data-val="{{$friday2}}">

													</select>
												</div>
											</div>



											<div class="row opening-day js-demo-hours">
												<div class="col-md-2"><h5>Sábado</h5></div>
												<div class="col-md-5">
													<select class="chosen-select" id="saturday1" data-placeholder="Hora de Apertura" data-val="{{$saturday1}}">

													</select>
												</div>
												<div class="col-md-5">
													<select class="chosen-select" id="saturday2" data-placeholder="Hora de Cierre" data-val="{{$saturday2}}">

													</select>
												</div>
											</div>



											<div class="row opening-day js-demo-hours">
												<div class="col-md-2"><h5>Domingo</h5></div>
												<div class="col-md-5">
													<select class="chosen-select" id="sunday1" data-placeholder="Hora de Apertura" data-val="{{$sunday1}}">


													</select>
												</div>
												<div class="col-md-5">
													<select class="chosen-select" id="sunday2" data-placeholder="Hora de Cierre" data-val="{{$sunday2}}">

													</select>
												</div>
											</div>

											<input type="submit" style="height: 44px;text-align: center;" id="days-edit" form="edit-days" value="Guardar" class="button margin-top-20 margin-bottom-20"></input>


										</div>


									</div>

								</div>
							</div>

						</div>

						<div class="tab-content" id="tab5a" style="display: none;">

							<div class="col-lg-12 col-md-12" >

								<div class="dashboard-list-box margin-top-0">

									<div class="add-listing-section margin-top-0" style="padding-top: 25px;">


										<div class="submit-section">
												 	<video width="100%" height="480px" controls preload>
													    <source src="{{URL::asset('video/profile.mp4')}}" type="video/mp4">
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
<script>

	Dropzone.options.gallery = {
	 paramName: "file",
     url: "/galery",
     headers:{
       'X-CSRF-TOKEN' : "{{csrf_token()}}"
     },
     dictDefaultMessage: "Arrastre una imágen al recuadro para subirlo",
     acceptedFiles: "image/*",
     maxFilesize: 2,
     //maxFiles: 9,
     addRemoveLinks: true,
     dictRemoveFile: "Remover imagen",
     //dictMaxFilesExceeded: "Solo puedes subir 9 imágenes",
     // dictRemoveFileConfirmation: "Desea eliminar la imagen ?",


    init: function() {

        var myDropzone = this;
        //Populate any existing thumbnails
        $.get('/photos', function (res) {
          	$.each(res.photos,function(index,value){
                /*var mockFile = {
                  name: value.name,
                  size: value.filesize,
                  uuid: value.uuid,
                  type: 'image/*',
                  status: Dropzone.ADDED,
                  accepted: true,
                  url: '/images/'+value.route_name
				};*/
				let size=Math.random()*(10000);
				let mockFile = { name: value.image, size: size };
                // Call the default addedfile event handler
                myDropzone.emit("addedfile", mockFile);
                // And optionally show the thumbnail of the file:
                myDropzone.emit("thumbnail", mockFile, '/images/'+value.image);
                myDropzone.emit("complete", mockFile);
                myDropzone.files.push(mockFile);
            });
		});

		this.on('sending', function(file, xhr, formData){
			formData.append("name", file.name);
			formData.append("filesize", file.size);
		});

		this.on("removedfile", function(file, xhr, formData) {
			let image = file.name;
			$.get('/gallery/delete', {image:image}, function (res) {
			});
		});
	},

  };
</script>
@endsection


@section('js')
<script>
	$('#department_id').change(function() {
		province(this.value);
	})
	$('#province_id').change(function() {
		distrito(this.value, 23); //provincia - departamento
	})
	async function province(department_id) {
		const provinces = await axios.post(`filter-province`, { department_id: department_id });
		const data = provinces.data.provincias;
		console.log(data)
		let html = [];
		for (let i = 0; i < data.length; i++) {
			html[i] = `<option value=${data[i]._id}>${data[i].name}</option>`;
		}
		$('#province_id').empty().append(html);
		distrito($('#province_id').val(), $('#department_id').val())
	}
	async function distrito(province_id, department_id) {
		const districts = await axios.post(`filter-district`, { province_id: province_id, department_id: department_id });
		const data = districts.data.distritos;
		let html = [];
		for (let i = 0; i < data.length; i++) {
			html[i] = `<option value=${data[i]._id}>${data[i].name}</option>`;
		}
		$('#district_id').empty().append(html);
	}


</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="{{ asset('js/profile.js') }}"></script>
	<style>

#swal2-title{
	font-size:2.875em;
}
#swal2-content{
	font-size: 1.6em;
}
.swal2-popup{
	width: auto;
height: auto;
}
#swal2-title{
	font-size:2.875em;
	margin-top: 15px;
	margin-bottom: 15px;
}
#swal2-content{
	font-size: 1.6em;
}
.swal2-popup{
	width: 50%;
	height: 40%;
}
.swal2-styled.swal2-confirm{
	border: 0;
	border-radius: .25em;
	background: initial;
	background-color: #3085d6;
	color: #fff;
	/*font-size: 1.0625em;*/
	font-size: 1.6em !important;
}
.swal2-styled.swal2-cancel{
	font-size: 1.6em !important;
}
</style>
	<script src="{{ asset('js/map.js') }}"></script>

  	<script>

		$(".opening-day.js-demo-hours .chosen-select").each(function() {
			let html;
			let dia;
			html = '';
			html += '<option></option>';
			//html += '<option>Cerrado</option>';
			$(this).attr('data-val')=='Cerrado'? html += '<option selected>Cerrado</option>':html += '<option>Cerrado</option>';
			//html += '<option>1 AM</option>';
			$(this).attr('data-val')=='1 AM'? html += '<option selected>1 AM</option>':html += '<option>1 AM</option>';
			$(this).attr('data-val')=='2 AM'? html += '<option selected>2 AM</option>':html += '<option>2 AM</option>';
			$(this).attr('data-val')=='3 AM'? html += '<option selected>3 AM</option>':html += '<option>3 AM</option>';
			$(this).attr('data-val')=='4 AM'? html += '<option selected>4 AM</option>':html += '<option>4 AM</option>';
			$(this).attr('data-val')=='5 AM'? html += '<option selected>5 AM</option>':html += '<option>5 AM</option>';
			$(this).attr('data-val')=='6 AM'? html += '<option selected>6 AM</option>':html += '<option>6 AM</option>';
			$(this).attr('data-val')=='7 AM'? html += '<option selected>7 AM</option>':html += '<option>7 AM</option>';
			$(this).attr('data-val')=='8 AM'? html += '<option selected>8 AM</option>':html += '<option>8 AM</option>';
			$(this).attr('data-val')=='9 AM'? html += '<option selected>9 AM</option>':html += '<option>9 AM</option>';
			$(this).attr('data-val')=='10 AM'? html += '<option selected>10 AM</option>':html += '<option>10 AM</option>';
			$(this).attr('data-val')=='11 AM'? html += '<option selected>11 AM</option>':html += '<option>11 AM</option>';
			$(this).attr('data-val')=='12 AM'? html += '<option selected>12 AM</option>':html += '<option>12 AM</option>';
			$(this).attr('data-val')=='1 PM'? html += '<option selected>1 PM</option>':html += '<option>1 PM</option>';
			$(this).attr('data-val')=='2 PM'? html += '<option selected>2 PM</option>':html += '<option>2 PM</option>';
			$(this).attr('data-val')=='3 PM'? html += '<option selected>3 PM</option>':html += '<option>3 PM</option>';
			$(this).attr('data-val')=='4 PM'? html += '<option selected>4 PM</option>':html += '<option>4 PM</option>';
			$(this).attr('data-val')=='5 PM'? html += '<option selected>5 PM</option>':html += '<option>5 PM</option>';
			$(this).attr('data-val')=='6 PM'? html += '<option selected>6 PM</option>':html += '<option>6 PM</option>';
			$(this).attr('data-val')=='7 PM'? html += '<option selected>7 PM</option>':html += '<option>7 PM</option>';
			$(this).attr('data-val')=='8 PM'? html += '<option selected>8 PM</option>':html += '<option>8 PM</option>';
			$(this).attr('data-val')=='9 PM'? html += '<option selected>9 PM</option>':html += '<option>9 PM</option>';
			$(this).attr('data-val')=='10 PM'? html += '<option selected>10 PM</option>':html += '<option>10 PM</option>';
			$(this).attr('data-val')=='11 PM'? html += '<option selected>11 PM</option>':html += '<option>11 PM</option>';
			$(this).attr('data-val')=='12 PM'? html += '<option selected>12 PM</option>':html += '<option>12 PM</option>';
			$(this).append(html);
		});
	</script>

@endsection
