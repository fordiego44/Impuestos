@extends('backend.layouts.app')
<!-- Content
	================================================== -->
@section('header-button')
    <a href="{{ route('backend.cover.index') }}" class="button border with-icon">New Cover<i
            class="sl sl-icon-plus"></i></a>
@endsection

@section('content')

    <!-- Content============================= -->

    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Home Covers urdapilleta </h2>
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
        <div class="col-lg-12 col-md-12 margin-top-20">

            <form id="coverForm" method="POST" enctype="multipart/form-data">
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

                            <div class="col-md-6">
                                <h5>Titulo</h5>
                                <input class="search-field" name="title" type="text" value=""/>
                                <!-- ejemplo imagen -->
                            </div>
                            <div class="col-md-6">
                                <h5>Sub-Titulo</h5>
                                <input class="search-field" name="subtitle" type="text" value=""/>
                                <!-- ejemplo imagen -->
                            </div>
                            <div class="col-md-12">
                                <h5>Descripción</h5>
                                <input class="search-field" name="body" type="text" value=""/>
                            </div>

                            <!-- Status -->
                            <div class="col-md-12">
                                <h5>Link o destino</h5>
                                <input class="search-field" name="link" type="text" value=""
                                       placeholder="http://urdapilleta.com.ar/..."/>
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
                                                    <img src="{{asset('images/user-avatar.jpg')}}" id="img_cover_desktop" alt="">
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

                    <a href="" id="create_cover" class="button preview">Crear Cover
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </form>

        </div>

        <div class="col-lg-12 col-md-12 ">
            <div class="dashboard-list-box invoices with-icons">
                <h4>Home Covers Creados</h4>
                <ul>

                    @foreach ($covers as $key => $cover)
                        <li>
                            <i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>{{$cover->title}}</strong>

                            <div class="buttons-to-right">
                                <a href="{{route('backend.cover.active',['id' => $cover->id])}}"
                                   class="button gray"> @if($cover->isShow) Ocultar @else Mostrar @endif</a>

                                <a href="{{route('backend.cover.edit',['id' => $cover->id])}}"
                                   class="button gray">Editar</a>

                                <a class="button gray delete-env" data-id="{{$cover->id}}">
                                    Eliminar
                                </a>

                            </div>
                        </li>
                    @endforeach


                </ul>
            </div>
        </div>


    </div>

    <!-- Content / End -->

@endsection

@section('after-scripts')
    <script src="{{ asset('js/backend/admin/cover6.js')}}"></script>


    <script src="https://unpkg.com/sweetalert2@7.20.3/dist/sweetalert2.all.js"></script>

    <script>

        Array.from(document.querySelectorAll('.delete-env')).map(elem => {
            elem.addEventListener('click',(e) =>{
                e.preventDefault();
                e.stopPropagation();

                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No Podrás revertir esto!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, estoy seguro'
                }).then((result) => {
                    if (result.value) {
                        const {dataset: {id} } = e.target;
                        if(id){
                            location.href = `/admin/cover/${id}/delete`
                        }
                    }
                })

            })
        })



    </script>
@endsection
