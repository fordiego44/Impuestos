<!DOCTYPE html> 
 <head> 
 <title>Tacna Market Plaza | Plataforma de Negocio Electrónico y Delivery</title>
	<meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
	<meta name="AUTHOR" content="Global Market Place">
	<meta name="DESCRIPTION" content="Plataforma e-commerce para realizar compras online">
	<meta name="KEYWORDS" content="Restaurantes,Belleza y Estética,Vestimenta y Textileria,Ferreteria,Electrodomesticos,Contenido Digital">
	<meta name="Resource-type" content="Document">
	<meta name="DateCreated" content="Thu, 18 June 2020 00:00:00 GMT+1">
	<meta name="Revisit-after" content="5 days">
	<meta name="robots" content="ALL">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
	<link rel="stylesheet" href={{asset('css/style.css')}}>
	<link rel="stylesheet" href={{asset('css/main-color.css')}} id="colors"> 
	<link rel="icon" href="{{asset('images/Tacna_MPfinal.ico')}}">
	<style>
		input, input[type=text], input[type=password], input[type=email], input[type=number], textarea, select { 
			margin: 0 0 0;
		}
	</style>
</head> 
	<body> 
			 
	<div id="wrapper">  
			@include('frontend.layouts.header', ['users' => $users])
		   <div class="container full-width" style="margin-top:60px">

            <div class=" ">

                <article id="post-38" class="col-md-12 post-38 page type-page status-publish hentry">
					
                    <div  class="col-lg-5 col-md-4 col-md-offset-3 sign-in-form style-1 margin-bottom-45">
                                                            
                        <ul id="myTab" class="tabs-nav">
                            <li id='administrator1'><a href="#tab1_v">Tienda</a></li>
                            <li id='register1'><a href="#tab2_v">Registrarse</a></li>
                         </ul>

						 <div class="tabs-container alt"> 
							<div class="tab-content" id="tab1_v"  >
								<form  class="login"> 
									<div id="login-user-result"> </div>

									<p class="form-row form-row-wide">
										<label class="email">Email:
											<i class="im im-icon-Male"></i>
											<input type="email" class="input-text" name="email" id="email" value="" />
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-email" style="color: #e90808;"> </strong>
										</span>
									</p> 
									<p class="form-row form-row-wide">
										<label class="password">Contraseña:
											<i class="im im-icon-Lock-2"></i>
											<input class="input-text" type="password" name="password" id="password"/>
										</label>
										<span class="invalid-feedback" role="alert">
											<strong id="error-password" style="color: #e90808;"> </strong>
										</span>
									</p> 
									<div class="form-row">
										<input type="button" id="signIn" class="button border margin-top-5" name="login" value="Iniciar Sesion" /> 
									</div> 
								</form>
							</div>
	
							<!-- Register -->
							<div class="tab-content" id="tab2_v" style="display: none;">
	
								<form  class="register">
								<div id="register-user-result"> </div>

								<p class="form-row form-row-wide">
									<label class="names2">Nombres:
										<i class="im im-icon-Male"></i>
										
										<input type="text" class="input-text" name="names" id="names2" value="" /> 
									</label>
									<span class="invalid-feedback" role="alert">
										<strong id="error-names2" style="color: #e90808;"> </strong>
									</span>
								</p>
								<p class="form-row form-row-wide">
									<label class="lastnames2">Apellidos:
										<i class="im im-icon-Male"></i>
										
										<input type="text" class="input-text" name="lastnames" id="lastnames2" value="" /> 
									</label>
									<span class="invalid-feedback" role="alert">
										<strong id="error-lastnames2" style="color: #e90808;"> </strong>
									</span>
								</p>	
								<p class="form-row form-row-wide">
									<label class="email2">Email:
										<i class="im im-icon-Mail"></i>
										<input type="text" class="input-text" name="email" id="email2" value="" /> 
									</label>
									<span class="invalid-feedback" role="alert">
										<strong id="error-email2" style="color: #e90808;"> </strong>
									</span>
								</p>

								<p class="form-row form-row-wide">
									<label class="business">Negocio:
										<select data-placeholder="Todos los negocios" id="bussines" name='bussines' class="chosen-select" >
											@foreach ($bussines as $item) 
												 
													<option value={{$item->id}}>{{$item->name}}</option>    
											 
											@endforeach
										</select>
									</label>
									<span class="invalid-feedback" role="alert">
										<strong id="error-business" style="color: #e90808;"> </strong>
									</span>
								</p>
								<p class="form-row form-row-wide">
									<label class="phone2">Telefono Fijo:
										<i class="im im-icon-Old-Telephone"></i>
										<input type="number" class="input-text" name="phone2" id="phone2" value="" />
									</label>
									<span class="invalid-feedback" role="alert">
										<strong id="error-phone2" style="color: #ec2a2a;"> </strong>
									</span>
								</p> 
								<p class="form-row form-row-wide">
									<label class="cellPhone2">Celular:
										<i class="im im-icon-Cloud-Smartphone "></i>
										<input type="number" class="input-text" name="cellPhone2" id="cellPhone2" value="" />
									</label>
									<span class="invalid-feedback" role="alert">
										<strong id="error-cellPhone2" style="color: #ec2a2a;"> </strong>
									</span>
								</p> 
								
								<p class="form-row form-row-wide">
									<label class="password2">Contraseña:
										<i class="im im-icon-Lock-2"></i>
										<input class="input-text" type="password" name="password2" id="password2"/> 
									</label>
									<span class="invalid-feedback" role="alert">
										<strong id="error-password2" style="color: #e90808;"> </strong>
									</span>
								</p> 
								<p class="form-row form-row-wide">
									<label class="password_confirmation2">Confirmar contraseña:
										<i class="im im-icon-Lock-2"></i>
										<input class="input-text" type="password" name="password_confirmation2" id="password_confirmation2"/> 
									</label>
									<span class="invalid-feedback" role="alert">
										<strong id="error-password_confirmation2" style="color: #e90808;"> </strong>
									</span>
								</p>
	
								<div>
								 
								</div>
								<input type="button" id='signUp' class="button border fw margin-top-10" name="register" value="Registrar" />
		
								</form>
							</div>
	
						</div>
                        

                    
                    </div>
                </article>
            </div>
                                            
		

	</div> 
	 
 
 

<div class="clearfix"></div> 
 		@include('frontend.layouts.footer') 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script> 
		<script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script type="text/javascript" src={{asset('js/mmenu.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/chosen.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/slick.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/rangeslider.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/magnific-popup.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/waypoints.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/counterup.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/jquery-ui.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/tooltips.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/custom.js')}}></script> 
	 
		<script type="text/javascript" src={{asset('js/frontend/auth_user.js')}}></script>   
		<script type="text/javascript" src={{asset('js/frontend/auth.js')}}></script>

		<script>
			function openCity(evt, cityName) { 
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(cityName).style.display = "block";
				evt.currentTarget.className += " active";
			} 
			
		 	document.getElementById("defaultOpen").click();
 			$( "#defaultOpen" ).mouseover();

		</script>
	 
	</body>

 </html>