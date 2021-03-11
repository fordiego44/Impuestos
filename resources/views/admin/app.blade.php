<!DOCTYPE html> 
	<head> 
		<title>Global Market Place - plataforma de negocio electronico y delivery</title> 
<meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
<meta name="AUTHOR" content="Global Market Place">
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
		<link rel="stylesheet" href={{asset('css/style.css')}}>
		<link rel="stylesheet" href={{asset('css/main-color.css')}} id="colors"> 
	</head> 
	<body> 
		<div id="wrapper"> 
		@include('admin.layouts.header')
		<div class="clearfix"></div>
		<div id="dashboard">
			<a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a> 
			@include('admin.layouts.sidebar') 
			@yield('content')  
		</div> 
		</div> 
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
		@yield('after-scripts')
	</body>  
</html>
