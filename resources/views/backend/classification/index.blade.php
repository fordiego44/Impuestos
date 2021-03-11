@extends('backend.app')
@section('content')

  <link rel="stylesheet" href="{{asset('js/jquery-ui/jquery-ui.min.css')}}">

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}

  				<!-- Titlebar -->
  		<div id="titlebar">
  			<div class="row">
  				<div class="col-md-12">
  										<h1>Subcategorías</h1>
  										<!-- Breadcrumbs -->
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/admin/clasificaciones">Subcategorías</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>


  <div class="dashboard-list-box invoices with-icons margin-top-20">

    <div class="list-box-listing">
      <div>
        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Listado de Subcategorías</h4>
      </div>
      <div class="list-box-listing-content col-md-6">
        <div class="inner float-right" style="display:flex; justify-content:flex-end">
          <a href="/admin/clasificacion/guia" class="button" style="background-color:#657375"> Manual de uso</a>
          <a href="/admin/clasificaciones/nuevaClasificacion" class="button"> Nueva subcategoría</a>
        </div>
      </div>
    </div>
  	<ul>
      <li class="newCategory"><i class="list-box-icon fa fa-search"></i>
        <strong >  </strong>
        <div class="row with-forms" style="padding-top:20px">

          <div class="col-md-4" >
            <input class="search-field" type="text" id="search" placeholder="Encuentra subcategorías creadas" value=""/>
          </div>
          <div class="col-md-6" >
            <div class="" style="padding-top:10px">
              <button type="button" class="button" id="agregar-subcategoria" name="button">Agregar</button>
            </div>
          </div>
        </div>

      </li>


    </ul>
    <ul id="lista-subcategorias">
      @foreach ($classification as $classifications)
        <li class="newCategory"><i class="list-box-icon sl sl-icon-tag"></i>
          <strong>{{$classifications->name}}</strong>
          <ul>
            @if ($classifications->description == null)
              <li class="paid"><span> Ingrese una descripción </span></li>
            @else
              <li class="paid"><span>{{$classifications->description}}</span></li>
            @endif

          </ul>
          <div class="buttons-to-right" >
            <a href="/admin/clasificaciones/editarClasificacion/{{$classifications->id}}" class=" delete button gray"><i class="sl sl-icon-close"></i> Editar</a>
    				<a  data-id_product="{{$classifications->id}}" class="eliminar-subcategoria delete button gray" ><i class="sl sl-icon-close"></i> Eliminar</a>
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
    <div style="height:200px">

    </div>
</div>
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
  <script src="{{asset('js/jquery-min.js')}}"></script>
  <script src="{{asset('js/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{ asset('js/backend/subcategorias.js') }}"></script>
  <script>



  </script>
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
  		text-align: left;
      }
      .swal2-popup{
          width: auto;
      	height: auto;
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

  	label span, legend span {
      /*font-weight: 400;*/
      font-size: 17px;
      /*color: #444;*/
  	}
  	p {
      	font-size: 18px;
      	color: #707070;
  	}
  </style>
@endsection
