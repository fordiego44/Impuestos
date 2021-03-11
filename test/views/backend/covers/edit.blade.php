@extends('backend.layouts.app')
<!-- Content
	================================================== -->
@section('header-button')
	<a href="{{ route('backend.cover.index') }}" class="button border with-icon">New Cover<i class="sl sl-icon-plus"></i></a>
@endsection


@section('content')

<!-- Content============================= -->

<!-- Titlebar -->
<div id="titlebar">
	<div class="row">
		<div class="col-md-12">
			<h2>Editando el cover con Título {{$cover->title}}</h2>
			<!-- Breadcrumbs -->
			<nav id="breadcrumbs">
				<ul>
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a href="{{ route('backend.dashboard') }}">Dashboard</a>
					</li>
					<li>Home Covers</li>
				</ul>
			</nav>
		</div>
	</div>
</div>

<!-- ////////LEEEEERRRR: Los covers son imagenes que van en el home detras del buscador. No es slide, cambian cuando el usuario navega el sitio.. como sucede en zona prop -->

<div class="row">
	<div class="col-lg-12 col-md-12margin-top-20">

	<form id="coverForm" action="/admin/cover/update/{{ $cover->id }}" method="POST" enctype="multipart/form-data">
			<div id="add-listing">

				{{ csrf_field() }}
				
				<!-- Section -->
				<div class="add-listing-section">

					<!-- Headline -->
					<div class="add-listing-headline">
						<h3>
							<i class="sl sl-icon-doc"></i> New Home Cover</h3>
					</div>

					<!-- Title -->
					<div class="row with-forms">
                        <input class="search-field" name="id" type="hidden" value="{{$cover->id}}" />

						<!-- Status -->
                        <div class="col-md-6">
							<h5>Título</h5>
							<input class="search-field" name="title" type="text" value="{{$cover->title}}" />
							<!-- ejemplo imagen -->
						</div>
						<!-- Status -->
						<div class="col-md-6">
							<h5>Sub-Título</h5>
							<input class="search-field" name="subtitle" type="text" value="{{$cover->subtitle}}" />
							<!-- ejemplo imagen -->
						</div>
						<!-- Status -->
                        <div class="col-md-12">
							<h5>Descripción</h5>
							<input class="search-field" name="body" type="text" value="{{$cover->body}}" />
						</div>

                        <div class="col-md-12">
                            <h5>Link o destino</h5>
                            <input class="search-field" name="link" type="text" value="{{$cover->link}}" placeholder="http://mieres.com.ar/..." />

                            <!-- ejemplo imagen -->
                        </div>
                        <div id="submit-image" class="col-md-12">
                            <div class="row col-lg-12 col-md-12 col-sm-12">
    
                                <div class="submit-section">
    
    
                                    <!-- Row -->
                                    <div class="row with-forms">
                                        <!-- Headline -->
    
    
                                        <div class="col-md-12">
                                            <h5>Cover Desktop</h5>
                                            <!-- Avatar -->
                                            <div class="edit-profile-photo">
                                                <img src="{{ asset('/uploads/covers') }}/{{$cover->cover_desktop}}" id="img_cover_desktop" alt="">
                                                <div class="change-photo-btn">
                                                    <div class="photoUpload">
                                                        <span><i class="fa fa-upload"></i> Subir Foto</span>
                                                        <input type="file" name="cover_desktop" class="upload"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-md-12">
                                            <h4>Especificaciones de la fotos a subir:</h4>
                                            <ul>
                                                <li>No debe superar los 2mb.</li>
                                                <li>Tamaño recomendado: 1920px x 680px</li>
                                                <li>Resolucion: Exportar a no mas de 72%</li>
                                            </ul>
                                        </div>
    
    
                                    </div>
                                    <!-- Row / End -->
    
                                </div>
                            </div>
    
                            
                        </div>
					</div>



				</div>
				<!-- Section / End -->



                    

				<!-- Section / End

				<a href="" id="edit_cover" class="button preview">Crear Cover
					<i class="fa fa-arrow-circle-right"></i>
				</a> -->
				<button class="button preview">Guardar Cover<i class="fa fa-arrow-circle-right"></i></button>

			</div>
		</form>
	</div>

</div>

<!-- Content / End -->

@endsection 

@section('after-scripts')
<script src="{{ asset('js/backend/admin/cover6.js')}}"></script>


@endsection
