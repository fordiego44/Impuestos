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
	<link rel="icon" href="{{asset('images/Tacna_MPfinal.ico')}}">
	<link rel="stylesheet" href={{asset('css/style.css')}}>
	<link rel="stylesheet" href={{asset('css/main-color.css')}} id="colors"> 
	<style>
		input, input[type=text], input[type=password], input[type=email], input[type=number], textarea, select { 
			margin: 0 0 0;
		}
	</style>
</head> 
	<body> 
	<div id="wrapper"> 
		@include('frontend.layouts.header')

		<div class="container full-width" style="margin-top:60px">

			<div  >

				<article id="post-38" class="col-md-12 post-38 page type-page status-publish hentry">
					<div class="col-lg-5 col-md-4 col-md-offset-3 sign-in-form style-1 margin-bottom-45">
																
						
						<ul class="tabs-nav"> 
							<li  class="active"><a href="#tab4">Administrador</a></li>
 						</ul>

						<div class="tabs-container alt"> 
							<div class="tab-content" id="tab4"  style="display: none">
								<form  class="login"> 
									<div id="login-admin-result"> </div>

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
										<input type="button" id="signIn2" class="button border margin-top-5" name="login" value="Iniciar Sesion" /> 
									</div>
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
	 
		 
		<script type="text/javascript" src={{asset('js/frontend/auth_admin.js')}}></script>  
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