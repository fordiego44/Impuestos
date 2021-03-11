<style>
		.tab a {
	display: block;
	background-color: inherit;
	color: black;

	border: none;
	outline: none;
	text-align: left;
	cursor: pointer;
	transition: 0.3s;
	font-size: 15px;
	}
	#logo-actual{
    margin-top: 15px !important;
    max-height: 44px !important;
	}
	.user-menu {
		position: relative;
		display: inline-block;
		cursor: pointer;
		margin-right: 25px;
		top: 9px;
		vertical-align: top;
		padding-left: 0px;
		margin-left: 25px;
	}
	/* Change background color of buttons on hover */
	.tab a:hover {
	background-color: #ddd;
	}

	/* Create an active/current "tab button" class */
	.tab a.active {
	background-color: #ccc;
	}

	/* Style the tab content */
	.tabcontent {
	float: left;
	padding: 0px 12px;
	border-left: 1px solid #ccc;
	width: 70%;
	font-size: 15px;
	margin-right: 12px;
	border-left: none;
	height: 300px;
	}
	/*
	#navigation ul li:hover .mega-menu {
		opacity: 1;
		visibility: visible;
		transform: translate3d(0%, 12px, 0) !important;
	}*/
	@media (max-width: 500px) {
		.user-menu .user-name-sign {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			max-width: initial;
		}
	}

	@media only screen and (max-width: 1024px) {

		.header-widget a {
			margin-right: 15px;
			margin-top: -26px;
		}
	}

	#sub-category {

	}
	@media (max-width: 480px) {
		.user-menu {
			margin: 10px 0 -10px 25px;
			top: 0;
 		}
	}

	@media only screen and (max-width: 1024px) {
	.mi-carro {
		display: none;
	}

	#navigation {
		display: none;
	}
	.user-name span {
	    width: 35px;
	    height: 35px;
	    left: -28px;
	    top: -25px;
	}

}

	</style>
	<header id="header-container" >
		<div id="header" >
			<div class="container">
				<div class="left-side" >
					<div id="logo" >
					{{-- <div id="logo" style="margin-top: -18px;"> --}}
					<a href="/"><img id="logo-actual" src={{asset('images/tax.png')}} data-sticky-logo={{asset('images/tax.png')}} alt="" style=" max-height: 70px ; margin-top: 0px !important;"  ></a>
					{{-- <a href="/"> <p>IMPUESTOS</p> </a> --}}
				</div>

					<div class="mmenu-trigger">
						<button class="hamburger hamburger--collapse" type="button">
							<span class="hamburger-box">
								<span class="hamburger-inner"></span>
							</span>
						</button>
					</div>

					<nav id="navigation" class="style-1 ">
						<ul id="responsive ">
								{{-- <li><a   href="#">Categorias</a>
									<ul>
										@foreach ($bussines as $key => $item)
											<li><a href="#">{{$item->name}}</a>
												<ul>
													@foreach ($users as $user)
														@if ($item->id == $user->business)
															@foreach ($subcategory as $t)
															@if ($t->id_user == $user->id)
																<li>
																	<a href="search-result?&type=categories&ctg={{strtolower($t->name)}}">{{$t->name}}</a>
																</li>
															@endif
															@endforeach
														@endif
													@endforeach
												</ul>
											</li>
										@endforeach
									</ul>
								</li> --}}
								<!-- <li id="autocomplete-container">
									<div class="fm-input pricing-price">
										<input type="text" placeholder="Buscar" data-unit=" " style="height: 42px">
									</div>
								</li> -->

								@if (Session::get('costumer'))
									<li><a  href="/tax">Pagar impuestos</a>  </li>
								@else
									<li><a class="pay-cancel" >Pagar impuestos!</a>  </li>
								@endif
						</ul>
					</nav>
					<div class="clearfix"></div>
				</div>
				<div class="right-side">
				<div class="header-widget">
					<div class="user-menu">
						@if (Session::get('costumer'))
							<div class="primero user-name"><span><img src={{asset('images/'.Session::get('costumer')->image)}} alt=""></span>{{Session::get('costumer')->name}}</div>
							<ul>
								<li><a href="/mi-perfil"><i class="sl sl-icon-user"></i>Perfil</a></li>
								<li><a href="/logout-costumer"><i class="sl sl-icon-power"></i> Cerrar sesion</a></li>
							</ul>
						@else
							{{-- <div class="primero user-name"> Inicie sesion</div> --}}
							<div class="primero user-name"><span><img src={{asset('images/sesion4.jpg')}}></span> Inicie sesion</div>
							<ul>
								<li style="margin-bottom: 7px;"><a href="#sign-in-dialog"  class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-user"></i> Usuario</a> </li>
 								{{-- <li><a href="/login"><i class="sl sl-icon-home"></i>Tienda</a></li>
								<li><a href="/login-repartidor"><i class="sl sl-icon-user"></i>Repartidor</a></li> --}}
							</ul>
						@endif
					</div>
					{{-- <a href="/checkout" class="header-car header-carro">
						<img src={{asset('images/carrito1.png')}} data-sticky-logo={{asset('images/carrito1.png')}} alt="" style="max-height: 35px;max-width: 35px; 	"  >
							<span class="mi-carro">Mi Carrito</span>
						<span class="qtyTotal photo" id="qtyTotal"   style="margin-top: 15px; ">0</span>
					</a> --}}
				</div>
			</div>

					<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

						<div class="small-dialog-header">
							<h3>Usuario</h3>
						</div>

						<div class="sign-in-form style-1">

							<ul class="tabs-nav">
								<li id='administrator' ><a href="#tab1">Iniciar Session</a></li>
								<li id='register'><a href="#tab2">Registrar</a></li>
							</ul>
							<div class="tabs-container alt">
								<div class="tab-content" id="tab1" style="display: none;">

									<form  class="login">
										<div id="login-result"> </div>
										<p class="form-row form-row-wide">
											<label class="userEmail">Email:
												<i class="im im-icon-Male"></i>
												<input type="email" class="input-text" name="userEmail" id="userEmail" value="" />
											</label>
											<span class="invalid-feedback" role="alert">
												<strong id="error-userEmail" style="color: #ec2a2a;"> </strong>
											</span>
										</p>
										<p class="form-row form-row-wide">
											<label class="userPassword">Contraseña:
												<i class="im im-icon-Lock-2"></i>
												<input class="input-text" type="password" name="userPassword" id="userPassword"/>
											</label>
											<span class="invalid-feedback" role="alert">
												<strong id="error-userPassword" style="color: #ec2a2a;"> </strong>
											</span>
										</p>
										<div class="form-row">
											<input type="button" id="signInCostumer" class="button border margin-top-5" name="login" value="Iniciar Sesion" />
										</div>
									</form>
								</div>


								<div class="tab-content" id="tab2" style="display: none;">

									<form  class="register">
										<div id="register-result"> </div>

									<p class="form-row form-row-wide">
										<label class="userNames2">Nombres:
											<i class="im im-icon-Male"></i>
											<input type="text" class="input-text" name="names" id="userNames2" value="" />
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-userNames2" style="color: #ec2a2a;"> </strong>
										</span>
									</p>
									<p class="form-row form-row-wide">
										<label class="userLastNames2">Apellidos:
											<i class="im im-icon-Male"></i>
											<input type="text" class="input-text" name="userLastNames2" id="userLastNames2" value="" />
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-userLastNames2" style="color: #ec2a2a;"> </strong>
										</span>
									</p>
									<p class="form-row form-row-wide">
										<label class="userDni2">Dni:
											<i class="im im-icon-Mail-3"></i>
											<input type="number" max="8" class="input-text" name="userDni2" id="userDni2" value="" />
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-userDni2" style="color: #ec2a2a;"> </strong>
										</span>
									</p>
									<p class="form-row form-row-wide">
										<label class="userEmail2">Email:
											<i class="im im-icon-Mail"></i>
											<input type="email" class="input-text" name="userEmail2" id="userEmail2" value="" />
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-userEmail2" style="color: #ec2a2a;"> </strong>
										</span>
									</p>

									<p class="form-row form-row-wide">
										<label class="userPhone2">Telefono Fijo:
											<i class="im im-icon-Old-Telephone"></i>
											<input type="number" class="input-text" name="userPhone2" id="userPhone2" value="" />
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-userPhone2" style="color: #ec2a2a;"> </strong>
										</span>
									</p>
									<p class="form-row form-row-wide">
										<label class="userCellPhone2">Celular:
											<i class="im im-icon-Cloud-Smartphone "></i>
											<input type="number" class="input-text" name="userCellPhone2" id="userCellPhone2" value="" />
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-userCellPhone2" style="color: #ec2a2a;"> </strong>
										</span>
									</p>


									<p class="form-row form-row-wide">
										<label class="userPassword2">Contraseña:
											<i class="im im-icon-Lock-2"></i>
											<input class="input-text" type="password" name="userPassword2" id="userPassword2"/>
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-userPassword2" style="color: #ec2a2a;"> </strong>
										</span>
									</p>

									<p class="form-row form-row-wide">
										<label class="userPassword_confirmation2">Confirmar contraseña:
											<i class="im im-icon-Lock-2"></i>
											<input class="input-text" type="password" name="userPassword_confirmation2" id="userPassword_confirmation2"/>
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-userPassword_confirmation2" style="color: #ec2a2a;"> </strong>
										</span>
									</p>
									<div>
									</div>
									<input type="button" id='signUpCostumer' class="button border fw margin-top-10" name="register" value="Registrar" />
									</form>
								</div>

							</div>
						</div>
					</div>

			</div>

		</div>

	</header>
