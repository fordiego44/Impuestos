@extends('frontend.app')
@section('content')
@include('frontend.helpers.chat')

<style>
	.progress {
    background-image: -webkit-linear-gradient(top,#ebebeb 0,#f5f5f5 100%);
    background-image: -o-linear-gradient(top,#ebebeb 0,#f5f5f5 100%);
    background-image: -webkit-gradient(linear,left top,left bottom,from(#ebebeb),to(#f5f5f5));
    background-image: linear-gradient(to bottom,#ebebeb 0,#f5f5f5 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffebebeb', endColorstr='#fff5f5f5', GradientType=0);
    background-repeat: repeat-x;
	}
	.progress {
		height: 20px;
		margin-bottom: 20px;
		overflow: hidden;
		background-color: #f5f5f5;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
		box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	}
	.progress-bar-striped, .progress-striped .progress-bar {
		background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
		background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
		background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
		-webkit-background-size: 40px 40px;
		background-size: 40px 40px;
	}

	.progress-bar {
		background-image: -webkit-linear-gradient(top,#337ab7 0,#286090 100%);
		background-image: -o-linear-gradient(top,#337ab7 0,#286090 100%);
		background-image: -webkit-gradient(linear,left top,left bottom,from(#337ab7),to(#286090));
		background-image: linear-gradient(to bottom,#337ab7 0,#286090 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff337ab7', endColorstr='#ff286090', GradientType=0);
		background-repeat: repeat-x;
	}
	.progress-bar-success {
		background-color: #5cb85c;
	}
	.progress-bar {
		float: left;
		width: 0;
		height: 100%;
		font-size: 12px;
		line-height: 20px;
		color: #fff;
		text-align: center;
		background-color: #5cb85c;
		-webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
		box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
		-webkit-transition: width .6s ease;
		-o-transition: width .6s ease;
		transition: width .6s ease;
	}
</style>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style>
	@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic);
body {
  font-family:'Open Sans';
  line-height:200%;
  /*background:#d75f70;*/
}

.main {
  width:800px;
  margin:160px auto;
  text-align:center;
}

h1, h2, h3 {
  color:#fff;
}

h1 {
  margin-bottom:30px;
  font-size:44px;
}

h2 {
  margin-bottom:20px;
  font-size:32px;
}

h3 {
  font-size:21px;
}

p {
  font-size:18px;
  color:#ffd5df;
}

.btn {
  margin-top:30px;
  padding:2.2% 5.5%;
  display:inline-block;
  -webkit-transition:all linear 0.15s;
  transition:all linear 0.15s;
  border-radius:3px;
  background:#fff;
  font-size:22px;
  font-weight: bold;
  text-decoration:none;
  text-transform:uppercase;
  color:#333;

  &:hover {
    opacity:0.75;
  }
}

//----- Popoup
.popup-wrap {
  width:100%;
  height:100%;
  display:none;
  position:absolute;
  top:0px;
  left:0px;
  content:'';
  background:rgba(0,0,0,0.85);
}

.popup-box {
  width:400px;
  padding:70px;
  transform:translate(-50%, -50%) scale(0.5);
  position:absolute;
  top:50%;
  left:50%;
  box-shadow:0px 2px 16px rgba(0,0,0,0.5);
  border-radius:3px;
  background:#fff;
  text-align:center;

  h2 {
    color:#1a1a1a;
  }

  h3 {
    color:#888;
  }
  .close-btn {
    width:35px;
    height:35px;
    display:inline-block;
    position:absolute;
    top:10px;
    right:10px;
    -webkit-transition:all ease 0.5s;
    transition:all ease 0.5s;
    border-radius:1000px;
    background:#d75f70;
    font-weight:bold;
    text-decoration:none;
    color:#fff;
    line-height:190%;

    &:hover {
      -webkit-transform:rotate(180deg);
      transform:rotate(180deg);
    }
  }
}

.transform-in, .transform-out {
  display:block;
  -webkit-transition:all ease 0.5s;
  transition:all ease 0.5s;
}

.transform-in {
	-webkit-transform:translate(-50%, -50%) scale(1);
	transform:translate(-50%, -50%) scale(1);
}

.transform-out {
	-webkit-transform:translate(-50%, -50%) scale(0.5);
	transform:translate(-50%, -50%) scale(0.5);
}
#contenedor {
  width: 200px;
  margin: 50px;
}
</style>
<div class="clearfix" id='app'></div>
<div id="titlebar" class="gradient" style="margin-top:0px">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="user-profile-titlebar">
					<div class="user-profile-avatar"><img src="{{URL::asset('images/'.$costumer->image)}}" alt=""></div>
					<div class="user-profile-name">
					<h2 style = "color:#333;" >{{$costumer->name}}</h2>
						<div class="star-rating" data-rating="5">
							<div class="rating-counter"><a href="#listing-reviews"></a></div>
							{{-- <div class="rating-counter"><a href="#listing-reviews">(60 reviews)</a></div> --}}
						</div>
					</div>
				</div>

				<nav id="breadcrumbs">
						<ul>
							<li><a href="/">Inicio</a></li>
							<li><a href="/mi-perfil">Mi perfil</a></li>

						</ul>
				</nav>


			</div>
		</div>
	</div>
</div>
<!-- Content
================================================== -->
<div class="container">
	<div id="contenedor-profile" class="row sticky-wrapper">
		<input type="hidden" id='costumer_chat'   value="{{$costumer->id}}">
		<!-- Sidebar
		================================================== -->
		<div class="col-lg-4 col-md-4 margin-top-0">
			<!-- Verified Badge -->
			<div class="verified-badge with-tip" data-tip-content="La cuenta ha sido verificada y pertenece a la persona u organización representada.">
				<i class="sl sl-icon-user-following"></i> Cuenta verificada
			</div>
			<!-- Contact -->
			<div class="boxed-widget margin-top-10 margin-bottom-10" >
				<h3 style="color:black;">Datos personales</h3>
				<ul class="listing-details-sidebar">
					<li><i class="sl sl-icon-phone"></i> {{$costumer->phone}}</li>
					<li><i class="fa fa-envelope-o"></i> <span class="__cf_email__" data-cfemail=" ">{{$costumer->email}}</span></li>
					{{-- <li><i class="fa fa-shopping-bag"></i> Limite de compras fuera de Tacna</li> --}}
				</ul>
				{{-- <div class="progress progress-striped active margin-top-15">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					</div>
				</div> --}}


				</ul>

				<ul class="listing-details-sidebar" style="margin-top:20px">
					<select id="perfil-opciones" class="chosen-select-no-single">
						<li>
							{{-- <option  value="1">Mis pedidos</option>
							<option value="2">Mis lugares favoritos</option> --}}
							<option selected value="3">Mi perfil</option>
						</li>
					</select>
				</ul>
 			</div>

			<!-- Contact / End-->
		</div>
		<div class="col-lg-8 col-md-8 padding-left-30">
			<div hidden id="mis-pagos">
				<h3 style ="color:#333; " class="margin-top-0 margin-bottom-40" id="list-titulo">Mis pedidos:</h3>

				<div class="row">
					<div class="col-lg-12 col-md-12">

	          <div class="dashboard-list-box margin-top-0">

			  		</div>


					</div>
				</div>
			</div>
			<div  hidden id="mis-negocios">
				<h3 style = "color:#333;" class="margin-top-0 margin-bottom-40" id="list-titulo">Mis lugares favoritos:</h3>
				<div class="row">

				</div>
			</div>
			{{-- hidden --}}
			<div   id="mis-perfil">
				<h3 style = "color:#333;" class="margin-top-0 margin-bottom-40" id="list-titulo">Mi perfil:</h3>
				<div class="row col-md-12">
					<form class="" action="/mi-perfil-actualizar" method="POST" id="perfil-update" idenctype="multipart/form-data">
						@csrf

						<div class="col-lg-6 col-md-6 empresas" >
										<div class="edit-profile-photo"style="margin-bottom: 0px; display: flex; justify-content: center;">
										 		<div class="">
													<img id="imagenPrevisualizacion" src="{{URL::asset('images/'.$costumer->image)}}" alt="">
										 		</div>
												<div class="change-photo-btn" style="left: 80px;">
													<div class="photoUpload">
														<span><i class="fa fa-upload"></i> Subir imagen</span>
														<input type="file" class="upload" id="seleccionArchivos" name="file"/>
													</div>
												</div>

										</div>
						</div>



							<div class="col-md-6">
								<div class="input-with-icon medium-icons">
									<label for="nombre">Nombres:</label>
									<input name="nombre" type="text" style="width: 100% !important;" value="{{$costumer->name}}" id="nombre" placeholder="Ejm: Marco Antonio">
									<i class="im im-icon-Pen-2"></i>
								</div>
							</div>

							<div class="col-md-6">
								<div class="input-with-icon medium-icons">
									<label for="apellido">Apellidos:</label>
									<input name="apellido" type="text" style="width: 100% !important;" value="{{$costumer->last_name}}" id="apellido" placeholder="Ejm: Choque Maquera">
									<i class="im im-icon-Pen-2"></i>
								</div>
							</div>
							<div class="col-md-6">

								<div class="input-with-icon medium-icons">
									<label for="dni">DNI:</label>
									@if($costumer->change_dni < 2)
									<input  name="dni" type="number" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100% !important;" value="{{$costumer->dni}}" id="dni" placeholder="Ejm: marco@gmail.com">
									@else
									<input  name="dni" readonly type="number" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"style="width: 100% !important;" value="{{$costumer->dni}}" id="dni" placeholder="Ejm: marco@gmail.com">
									@endif
									<i class="im im-icon-Mail-3"></i>
								</div>
							</div>
							<div class="col-md-6">

								<div class="input-with-icon medium-icons">
									<label for="correo">Dirección Email:</label>
									<input  name="correo" type="email" style="width: 100% !important;" value="{{$costumer->email}}" id="correo" placeholder="Ejm: marco@gmail.com">
									<i class="im im-icon-Mail"></i>
								</div>
							</div>

							<div class="col-md-6">
								<div class="input-with-icon medium-icons">
									<label for="telefono">Teléfono Fijo:</label>
									<input name="telefono" type="number" style="width: 100% !important;" value="{{$costumer->telephone}}" id="telefono" placeholder="Ejm: 053958754" min="100000000">
									<i class="im im-icon-Phone"></i>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-with-icon medium-icons">
									<label for="celular">Teléfono Celular:</label>
									<input name="celular" type="number" style="width: 100% !important;" value="{{$costumer->phone}}" id="celular" placeholder="Ejm: 958754554" min="100000000">
									<i class="im im-icon-Phone-Wifi"></i>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-with-icon medium-icons">
									<label for="direccion">Dirección:</label>
									<input name="direccion" type="text" style="width: 100% !important;" value="{{$costumer->direction}}" id="direccion" placeholder="Ejm: Av. Ejemplo #132">
									<i class="im im-icon-Home"></i>
								</div>
							</div>

							<div class="col-md-12" style="display:flex;  justify-content: center;">
								<button type="submit"  value="Submit" class="button margin-top-20 margin-bottom-20">Actualizar</button>
								{{-- <div class="" href=“javascript: document.form.submit();” style="cursor: pointer; background: #19B453; padding: 15px; border-radius: 10px;">
									<h1 style="margin: 0px; font-size: x-large;">Actualizar</h1>
								</div> --}}
							</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id='tab-list' style='position:fixed;display:flex; flex-direction: row; align-items: stretch;bottom: 0; right: 0;'> </div>
<input type="hidden" id="answer1" value="0">
<input type="hidden" id="answer2" value="0">

@endsection

@section('after-scripts')
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
	<script src="{{asset('/js/frontend/checkout-final.js')}}"></script>
	<script src="{{ asset('js/frontend/profile.js') }}"></script>
	<script src="{{ asset('js/frontend/calification.js') }}"></script>
	<script src="{{ asset('js/backend/dish.js') }}"></script>



	<script src="{{asset('js/chat.js')}}"></script>

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
		<script src="{{ asset('js/frontend/misPedidos.js') }}"></script>
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
	input, input[type=text], input[type=password], input[type=email], input[type=number], textarea, select {

    width: 72% !important;

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
