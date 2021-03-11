@extends('backend.app')
@section('content')
<div class="dashboard-content" id="post-45">
				<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
										<h1>Galería de Fotos</h1>	
										<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="#">Galeria</a></li>
							<li><a href="/admin">Dashboard</a></li>
						</ul>
					</nav>
				</div>
			</div>
        </div>

        @php
        $id = auth()->user()->id;
        @endphp

        <div class="col-lg-12 col-md-12"><!--col-lg-12 col-md-12-->

			<div class="dashboard-list-box margin-top-0">
				<h4 class="gray">Galería de Fotos</h4>
				<form method="post" action="/admin/profile/edit/gallery/{{$id}}" id="edit-gallery" method="POST" enctype="multipart/form-data">
				@csrf
					<div class="dashboard-list-box-static" style="padding-top: 0;">

					
						<div class="my-profile">
						    <div class="row">
                                    @foreach($gallery as $gallerys)
														<div class="col-lg-3 col-md-6">
															<div class="dashboard-stat">
																<img src="{{URL::asset('images/'.$gallerys->image)}}" alt="">
															
																<div class="dashboard-stat-content"><a type="button" href="/admin/profile/gallery/delete/{{$gallerys->image}}" class = "a-gallery">Eliminar</a></div>
																
															</div>
														</div>
									@endforeach
                            </div>
                            <label for="">Seleccionar archivos</label>
							<input type="file" multiple class="form-control-file border"  id="archivosmultiple" name="gallery[]" style="margin-top: 11px;" multiple>

							<input type="submit" id="edit" form="edit-gallery" value="Guardar" class="button margin-top-20 margin-bottom-20"></input>

						</div>	
					</div>
				</form>
			</div>
		</div>
</div>




@endsection


