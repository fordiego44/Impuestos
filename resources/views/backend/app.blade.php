<!DOCTYPE html>

<!-- Mirrored from www.vasterad.com/themes/listeo_082019/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 May 2020 16:37:43 GMT -->
<head>
<!-- Basic Page Needs
================================================== -->
<title>Smarth Health</title>
<meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
<meta name="AUTHOR" content="Tacna Market Place">
<meta name="DESCRIPTION" content="Plataforma e-commerce para realizar compras online">
<meta name="KEYWORDS" content="Restaurantes,Belleza y Estética,Vestimenta y Textileria,Ferreteria,Electrodomesticos,Contenido Digital">
<meta name="Resource-type" content="Document">
<meta name="DateCreated" content="Thu, 18 June 2020 00:00:00 GMT+1">
<meta name="Revisit-after" content="5 days">
<meta name="robots" content="ALL">
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="icon" href="{{asset('images/health-icon.png')}}">
<!-- CSS
================================================== -->
<link rel="stylesheet" href={{asset('css/style.css')}}>
<link rel="stylesheet" href={{asset('css/main-color.css')}} id="colors">
<script src='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css' rel='stylesheet' />

</head>

<body>

<div id="wrapper">

@include('backend.layouts.header')
<div class="clearfix"></div>
<div id="dashboard">
	<a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>

	@include('backend.layouts.sidebar')
	<!-- Navigation / End -->
	<!-- Content ================================================== -->
	@yield('content')
	<!-- Content / End -->


</div>
<!-- Dashboard / End -->


</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script type="text/javascript" src={{asset('js/jquery-3.4.1.min.js') }}></script>
<script type="text/javascript" src={{asset('js/jquery-migrate-3.1.0.min.js') }}></script>
<script type="text/javascript" src={{asset('js/mmenu.min.js') }}></script>
<script type="text/javascript" src={{asset('js/chosen.min.js') }}></script>
<script type="text/javascript" src={{asset('js/slick.min.js') }}></script>
<script type="text/javascript" src={{asset('js/rangeslider.min.js') }}></script>
<script type="text/javascript" src={{asset('js/magnific-popup.min.js') }}></script>
<script type="text/javascript" src={{asset('js/waypoints.min.js') }}></script>
<script type="text/javascript" src={{asset('js/counterup.min.js') }}></script>
<script type="text/javascript" src={{asset('js/jquery-ui.min.js') }}></script>
<script type="text/javascript" src={{asset('js/tooltips.min.js') }}></script>
<script type="text/javascript" src={{asset('js/custom.js') }}></script>


@yield('js')
</body>


<!-- Mirrored from www.vasterad.com/themes/listeo_082019/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 May 2020 16:37:43 GMT -->
</html>
