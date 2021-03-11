<!DOCTYPE html>
 <head>
	<title>Plataforma de gestión de pagos electrónicos de Tributos Municipales</title>
	<meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
 	<meta name="AUTHOR" content="Plataforma de gestión de pagos electrónicos de Tributos Municipales">
	<meta name="DESCRIPTION" content="Plataforma de gestión de pagos electrónicos">
	<meta name="KEYWORDS" content="Plataforma,gestión ,pagos, electrónicos,Tributos,Municipales">
	<meta name="Resource-type" content="Document">
	<META name="DateCreated" content="Thu, 18 June 2020 00:00:00 GMT+1">
	<meta name="Revisit-after" content="5 days">
	<meta name="robots" content="ALL">
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href={{asset('css/style.css')}}>
	<link rel="stylesheet" href={{asset('css/main-color.css')}} id="colors">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

	<style>
		input, input[type=text], input[type=password], input[type=email], input[type=number], textarea, select {
			margin: 0 0 0;
		}
		@media (max-width: 1024px) {
			#navigation.style-1 {
				margin: 25px 0 5px -5px;
				width: 100%;
				padding-top: 15px;
				padding-bottom: 0;
				position: relative;
				display: none;
			}
		}
		@media (max-width: 1024px) {
			.fixed-wapp {
				top: 25% !important;
			}
		}

		/*
		.header-car {
			padding: 10px;
		}
		.header-car:hover {
			background: rgb(82 87 88 / 8%);
    		border-radius: 25px;
		}

		.mega-menu-section {
			width: 250px !important;
		}
		#navigation .mega-menu ul li {
			padding: 0 0 0 30px;
		}*/
	</style>
</head>
	<body >
	<div id="wrapper">

	@include('frontend.layouts.header'  )


	<div class="clearfix"></div>
		@yield('content')

		@include('frontend.layouts.footer')

	</div>

	<script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>
 		<script type="text/javascript" src={{asset('js/jquery-3.4.1.min.js')}}></script>
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

		<script type="text/javascript" src={{asset('js/leaflet.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/leaflet-markercluster.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/leaflet-gesture-handling.min.js')}}></script>
 		 <script type="text/javascript" src={{asset('js/leaflet-control-geocoder.js')}}></script>
		<script type="text/javascript" src={{asset('js/switcher.js')}}></script>
		<script type="text/javascript" src={{asset('js/frontend/auth.js')}}></script>

		<script type="text/javascript" src={{asset('js/themepunch.tools.min.js')}}></script>
		<script type="text/javascript" src={{asset('js/themepunch.revolution.min.js')}}></script>
		<!-- REVOLUTION SLIDER SCRIPT -->
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
		@yield('after-scripts')
		<script>

			let data_ = JSON.parse(localStorage.getItem('checkout'));
			let suma =0;
            data_.forEach(element => {
                suma +=  parseInt(element.cant)
            });
            $('.qtyTotal').text(suma);
		</script>

	</body>

 </html>
