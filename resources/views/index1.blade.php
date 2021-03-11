<!DOCTYPE html> 
 <head>
 
<title>Delivery</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/main-color.css" id="colors"> 
</head> 
<body class="transparent-header"> 
	<style>
		.transparent-header .main-search-container:before {
			background: rgba(0, 0, 0, 0.12) !important;
		}
	</style>
<div id="wrapper">
	<header id="header-container">
 
		<div id="header">
			<div class="container"> 
				<div class="left-side"> 
					<div id="logo">
						<a href="/"><a href="/"><img src={{asset('images/delivery1.png')}} data-sticky-logo={{asset('images/delivery.png')}} alt=""></a>
					</div>  
					<div class="mmenu-trigger">
						<button class="hamburger hamburger--collapse" type="button">
							<span class="hamburger-box">
								<span class="hamburger-inner"></span>
							</span>
						</button>
					</div>
	
					<!-- Main Navigation -->
					<nav id="navigation" class="style-1">
						<ul id="responsive">
							<li><a href="/mapa">Restaurantes</a> 
							</li>
							<li>
								<a href="/login">Iniciar Sesion</a>
							</li> 
						</ul>
					</nav>  
				</div>  
				<div class="right-side">
					<div class="header-widget">
						<!-- User Menu -->
						<div class="user-menu">
							@if (Session::get('costumer'))
								<div class="user-name"><span><img src={{asset('images/dashboard-avatar.jpg')}} alt=""></span>{{Session::get('costumer')->name}}</div>
								<ul> 
									<li><a href="/mi-perfil"><i class="sl sl-icon-user"></i>Perfil</a></li> 
									<li><a href="{{route('logout-costumer')}}"><i class="sl sl-icon-power"></i> Logout</a></li> 
								</ul>	 
							@endif 
						</div> 
						@if (Session::get('costumer'))
	
						@else
						<div class="right-side">
							<div class="header-widget">
								<a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Registrar</a>
							 </div>
						</div>
						@endif
	
					</div>
				</div>
				<!-- Right Side Content / End -->
	
				<!-- Sign In Popup -->
				<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
	
					<div class="small-dialog-header">
						<h3>Iniciar Sesión</h3>
					</div>
	
					<!--Tabs -->
					<div class="sign-in-form style-1">
	
						<ul class="tabs-nav">
							<li class=""><a href="#tab1">Administrador</a></li>
							<li><a href="#tab2">Admin-Registro</a></li>
							<li><a href="#tab3">Repartidor</a></li>
						</ul>
	
						<div class="tabs-container alt">
	 
						 
							<div class="tab-content" id="tab1" style="display: none;">
								<form method="POST" class="login"  action="/login">
									@csrf
                        			{{ method_field('POST') }}
	
									<p class="form-row form-row-wide">
										<label for="username">Usuario:
											<i class="im im-icon-Male"></i>
											{{--<input type="email" class="" name="email" id="email" value="" />--}}
											<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
											
										</label>
										@error('email')
												<span class="invalid-feedback" role="alert" style="color:red;">
													Estas credenciales no coinciden con nuestros registros.
												</span>
										@enderror
									</p>
	
									<p class="form-row form-row-wide">
										<label for="password">Contraseña:
											<i class="im im-icon-Lock-2"></i>
											<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

											{{--<input class="input-text" type="password" name="password" id="password"/>--}}
											
										</label>
										@error('password')
												<span class="invalid-feedback" role="alert" style="color:red;">
													{{ $message }}
												</span>
										@enderror


									 
									</p>
	
									<div class="form-row">
										<input type="submit" class="button border margin-top-5" name="login" value="Login" />
										 
									</div>
									
								</form>
							</div>
	
						 
							<div class="tab-content" id="tab2" style="display: none;">
	
								<form method="post" class="register" action="">
									{{ method_field('POST') }} 
									@csrf 
									<p class="form-row form-row-wide">
										<label for="username2">Nombre:
											<i class="im im-icon-Pen"></i>
											{{--<input type="text" class="input-text" name="name2" id="username2" value="" />--}}
											<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

											
										</label>
										@error('name')
												<span class="invalid-feedback" role="alert" style="color:red;">
													{{ $message }}
												</span>
										@enderror
									</p>
										
									<p class="form-row form-row-wide">
										<label for="email2">Usuario:
											{{--<i class="im im-icon-Mail"></i>--}}
											
											<i class="im im-icon-Male"></i>
											{{--<input type="text" class="input-text" name="email" id="email2" value="" />--}}
											<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

											
										</label>
										@error('email')
												<span class="invalid-feedback" role="alert" style="color:red;">
													El usuario ya esta en uso.
												</span>
										@enderror
									</p>
		
									<p class="form-row form-row-wide">
										<label for="password1">Contraseña:
											<i class="im im-icon-Lock-2"></i>
											{{--<input class="input-text" type="password" name="password1" id="password1"/>--}}
											<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

											
										</label>
										@error('password')
												<span class="invalid-feedback" role="alert" style="color:red;">
													{{ $message }}
												</span>
										@enderror
									</p>
		
									<p class="form-row form-row-wide">
										<label for="password2">Repetir Contraseña:
											<i class="im im-icon-Lock-2"></i>
											{{--<input class="input-text" type="password" name="password2" id="password2"/>--}}
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

										</label>
									</p>
		
									<input type="submit" class="button border fw margin-top-10" name="register" value="Registrar" />
			
								</form>
							</div>

							<div class="tab-content" id="tab3" style="display: none;">
								<form method="POST" class="login"  action="/admin/login">
									@csrf
                        			{{ method_field('POST') }}
	
									<p class="form-row form-row-wide">
										<label for="username">Usuario:
											<i class="im im-icon-Male"></i>
											{{--<input type="email" class="" name="email" id="email" value="" />--}}
											<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
											@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</label>
									</p>
	
									<p class="form-row form-row-wide">
										<label for="password">Contraseña:
											<i class="im im-icon-Lock-2"></i>
											<input id="password" type="password" class="form-control   name="password" required autocomplete="current-password">

											{{--<input class="input-text" type="password" name="password" id="password"/>--}}
											@error('password')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</label>

 
									</p>
	
									<div class="form-row">
										<input type="submit" class="button border margin-top-5"  value="Login" />
										 
									</div>
									
								</form>
							</div> 
	
						</div>
					</div>
				</div> 
			</div>
		</div> 
	</header>

	<div class="main-search-container centered" data-background-image="images/portada-img.jpg"><!--cambiaaaaar-->
		<div class="main-search-inner">

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>
							Encuentra cerca 
							<span class="typed-words"></span>
						</h2>
						<h4>Explore, restaurantes mejor calificadas</h4>

						<!--<div class="main-search-input">

							<div class="main-search-input-item">
								<input type="text" placeholder="What are you looking for?" value=""/>
							</div>

							<div class="main-search-input-item location">
								<div id="autocomplete-container">
									<input id="autocomplete-input" type="text" placeholder="Location">
								</div>
								<a href="#"><i class="fa fa-map-marker"></i></a>
							</div>

							<div class="main-search-input-item">
								<select data-placeholder="All Categories" class="chosen-select" > 
									<option>Restaurantes</option> 
								</select>
							</div>	

							<button class="button" onclick="window.location.href='listings-half-screen-map-list.html'">Buscar</button>

						</div>-->
					</div>
				</div>
				
				<!-- Features Categories -->
				<div class="row">
					<div class="col-md-12">
						<h5 class="highlighted-categories-headline">Explore nuestras categorias destacadas:</h5>
						
						<div class="highlighted-categories" id= "category4">
							<!--
							<a href="listings-list-with-sidebar.html" class="highlighted-category">
								<i class="im im-icon-Home"></i>
								<h4>Desayunos</h4>
							</a>	

							
							<a href="listings-list-full-width.html" class="highlighted-category">
								<i class="im im-icon-Hamburger"></i>
								<h4>Almuerzos</h4>
							</a>	

							
							<a href="listings-half-screen-map-list.html" class="highlighted-category">
								<i class="im im-icon-Electric-Guitar"></i>
								<h4>Cena</h4>
							</a>	

							
							<a href="listings-half-screen-map-list.html" class="highlighted-category">
								<i class="im im-icon-Dumbbell"></i>
								<h4>Postres</h4>
							</a>	-->	
						</div>
						
					</div>
				</div>
				<!-- Featured Categories - End -->

			</div>

		</div>
	</div>    
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<h3 class="headline centered margin-top-75">
					<strong class="headline-with-separator">Categorías Populares</strong>
				</h3>
			</div>

			<div class="col-md-12">
				<div class="categories-boxes-container margin-top-5 margin-bottom-30 " id="category6" style="display: flex; justify-content: center;">
					
					<!-- Box -->
							<!--							
					<a href="listings-list-with-sidebar.html" class="category-small-box">
						<i class="im im-icon-Hamburger"></i>
						<h4>Restaurante</h4>
						<span class="category-box-counter">12</span>
					</a>
										-->							
					<!-- Bo-->
							<!--							
					<a href="listings-list-with-sidebar.html" class="category-small-box">
						<i class="im  im-icon-Sleeping"></i>
						<h4>Hotels</h4>
						<span class="category-box-counter">32</span>
					</a>
										-->							
					<!-- Box-->
					<!--							
					<a href="listings-list-with-sidebar.html" class="category-small-box">
						<i class="im im-icon-Shopping-Bag"></i>
						<h4>Shops</h4>
						<span class="category-box-counter">11</span>
					</a>
										-->							
					<!-- Box-->
					<!--							
					<a href="listings-list-with-sidebar.html" class="category-small-box">
						<i class="im im-icon-Cocktail"></i>
						<h4>Nightlife</h4>
						<span class="category-box-counter">15</span>
					</a>
										-->							
					<!-- Box-->
					<!--							
					<a href="listings-list-with-sidebar.html" class="category-small-box">
						<i class="im im-icon-Electric-Guitar"></i>
						<h4>Events</h4>
						<span class="category-box-counter">21</span>
					</a>
										-->							
					<!-- Box-->
					<!--							
					<a href="listings-list-with-sidebar.html" class="category-small-box">
						<i class="im im-icon-Dumbbell"></i>
						<h4>Fitness</h4>
						<span class="category-box-counter">28</span>
					</a>
										-->							
				</div>
			</div>


		</div>
	</div>

	<!-- Category Boxes / End --> 
	<!-- Fullwidth Section -->
	<section class="fullwidth margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f8f8f8">
		<div class="container">
			<div class="row"> 
				<div class="col-md-12">
					<h3 class="headline centered margin-bottom-45"> 
						<strong class="headline-with-separator">Restaurantes Registrados</strong>
						<span>Descubra los restaurantes locales de su zona</span>
					</h3>
				</div> 
				<div class="col-md-12">
					
					<div class="simple-slick-carousel dots-nav ">
						@foreach($restaurantes as $restaurant)
							
							<div class="carousel-item">
								<a href="/restaurant/{{$restaurant->slug}}" class="listing-item-container compact">
									<div class="listing-item">
										<img src="images/{{$restaurant->image}}" alt="">
		
										<div class="listing-badge now-open">Now Open</div>
		
										<div class="listing-item-content">
											<div class="numerical-rating" data-rating="3.5"></div>
											<h3>{{$restaurant->company}} <i class="verified-icon"></i></h3>
											<span>{{$restaurant->email}}</span>
										</div>
										<span class="like-icon"></span>
									</div>
								</a>
							</div>
						@endforeach
			
					</div>
					
				</div>
			
										
				
			</div>
		</div>

	</section>
	 
	@include('frontend.layouts.footer')

	<div id="backtotop"><a href="#"></a></div>

<!-- Scripts
	
================================================== -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
	<script type="text/javascript" src={{asset('js/jquery-migrate-3.1.0.min.js')}}></script>
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
	
	<script src={{asset('js/leaflet.min.js')}}></script>

	<script type="text/javascript" src={{asset('js/themepunch.tools.min.js')}}></script>
	<script type="text/javascript" src={{asset('js/themepunch.revolution.min.js')}}></script>

	<script type="text/javascript">
		var tpj=jQuery;			
		var revapi4;
		tpj(document).ready(function() {
			if(tpj("#rev_slider_4_1").revolution == undefined){
				revslider_showDoubleJqueryError("#rev_slider_4_1");
			}else{
				revapi4 = tpj("#rev_slider_4_1").show().revolution({
					sliderType:"standard",
					jsFileLocation:"scripts/",
					sliderLayout:"auto",
					dottedOverlay:"none",
					delay:9000,
					navigation: {
						keyboardNavigation:"off",
						keyboard_direction: "horizontal",
						mouseScrollNavigation:"off",
						onHoverStop:"on",
						touch:{
							touchenabled:"on",
							swipe_threshold: 75,
							swipe_min_touches: 1,
							swipe_direction: "horizontal",
							drag_block_vertical: false
						}
						,
						arrows: {
							style:"zeus",
							enable:true,
							hide_onmobile:true,
							hide_under:600,
							hide_onleave:true,
							hide_delay:200,
							hide_delay_mobile:1200,
							tmp:'<div class="tp-title-wrap"></div>',
							left: {
								h_align:"left",
								v_align:"center",
								h_offset:40,
								v_offset:0
							},
							right: {
								h_align:"right",
								v_align:"center",
								h_offset:40,
								v_offset:0
							}
						}
						,
						bullets: {
					enable:false,
					hide_onmobile:true,
					hide_under:600,
					style:"hermes",
					hide_onleave:true,
					hide_delay:200,
					hide_delay_mobile:1200,
					direction:"horizontal",
					h_align:"center",
					v_align:"bottom",
					h_offset:0,
					v_offset:32,
					space:5,
					tmp:''
						}
					},
					viewPort: {
						enable:true,
						outof:"pause",
						visible_area:"80%"
				},
				responsiveLevels:[1200,992,768,480],
				visibilityLevels:[1200,992,768,480],
				gridwidth:[1180,1024,778,480],
				gridheight:[640,500,400,300],
				lazyType:"none",
				parallax: {
					type:"mouse",
					origo:"slidercenter",
					speed:2000,
					levels:[2,3,4,5,6,7,12,16,10,25,47,48,49,50,51,55],
					type:"mouse",
				},
				shadow:0,
				spinner:"off",
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
				shuffle:"off",
				autoHeight:"off",
				hideThumbsOnMobile:"off",
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				debugMode:false,
				fallbacks: {
					simplifyAll:"off",
					nextSlideOnWindowFocus:"off",
					disableFocusListener:false,
				}
			});
			}
		});	/*ready*/
	</script>	

	<!-- Typed Script -->
	<script type="text/javascript" src={{asset('js/typed.js')}}></script>
	<script>
	var typed = new Typed('.typed-words', {
	strings: [" Restaurantes"],
		typeSpeed: 80,
		backSpeed: 80,
		backDelay: 4000,
		startDelay: 1000,
		loop: true,
		showCursor: true
	});
	</script>

	<!-- REVOLUTION SLIDER SCRIPT -->

	<script src="{{asset('js/inicio.js')}}"></script>

	<script type="text/javascript" src={{asset('js/extensions/revolution.extension.actions.min.js')}}></script>
	<script type="text/javascript" src={{asset('js/extensions/revolution.extension.carousel.min.js')}}></script>
	<script type="text/javascript" src={{asset('js/extensions/revolution.extension.kenburn.min.js')}}></script>
	<script type="text/javascript" src={{asset('js/extensions/revolution.extension.layeranimation.min.js')}}></script>
	<script type="text/javascript" src={{asset('js/extensions/revolution.extension.migration.min.js')}}></script>
	<script type="text/javascript" src={{asset('js/extensions/revolution.extension.navigation.min.js')}}></script>
	<script type="text/javascript" src={{asset('js/extensions/revolution.extension.parallax.min.js')}}></script>
	<script type="text/javascript" src={{asset('js/extensions/revolution.extension.slideanims.min.js')}}></script>
	<script type="text/javascript" src={{asset('js/extensions/revolution.extension.video.min.js')}}></script>



	
	<script src={{asset('js/switcher.js')}}></script>

	<div id="style-switcher">
	<h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>
	
	<div>
		<ul class="colors" id="color1">
			<li><a href="#" class="main" title="Main"></a></li>
			<li><a href="#" class="blue" title="Blue"></a></li>
			<li><a href="#" class="green" title="Green"></a></li>
			<li><a href="#" class="orange" title="Orange"></a></li>
			<li><a href="#" class="navy" title="Navy"></a></li>
			<li><a href="#" class="yellow" title="Yellow"></a></li>
			<li><a href="#" class="peach" title="Peach"></a></li>
			<li><a href="#" class="beige" title="Beige"></a></li>
			<li><a href="#" class="purple" title="Purple"></a></li>
			<li><a href="#" class="celadon" title="Celadon"></a></li>
			<li><a href="#" class="red" title="Red"></a></li>
			<li><a href="#" class="brown" title="Brown"></a></li>
			<li><a href="#" class="cherry" title="Cherry"></a></li>
			<li><a href="#" class="cyan" title="Cyan"></a></li>
			<li><a href="#" class="gray" title="Gray"></a></li>
			<li><a href="#" class="olive" title="Olive"></a></li>
		</ul>
	</div>
			
	</div> 
</body>

 </html>
 


