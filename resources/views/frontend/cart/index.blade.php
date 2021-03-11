@extends('frontend.app' , ['bussines'=> $bussines, 'users', $users])
<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>

<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />

@section('content')
<style>
	.btn-add {
		background: #aaa !important;
		color: #fff !important;
	}
	#header-container.fixed {
		position: relative;
	}
	#checkout-paypal {
		background: #fff;
		padding: 40px;
		padding-top: 0;
		text-align: left;
		max-width: 610px;
		margin: 40px auto;
		position: relative;
		box-sizing: border-box;
		border-radius: 4px;
		height: 80% !important;
	}
	.dashboard-list-box {
		margin: 0px 0 0;
		box-shadow: none;
		border-radius: 0px;
	}
	.dashboard-list-box ul {
		list-style: none;
		padding: 0;
		margin: 0;
		background-color: #fff;
		  border-radius: 0 0 0 0 !important;
	}
	.column-1 {
		padding: 1px !important;
	}
	.column-2 {
		padding: 1px !important;
		text-align: center;
		background: white;
		border: 1px solid #f6f6f6;
	}
	table.basic-table th:first-child {
		border-radius: 0 0 0 0;
	}
	table.basic-table th:last-child {
		border-radius: 0 0 0 0;
	}
	table.basic-table tbody tr {
		border: 1px solid #000;
		background: #f6f6f6;
	}
	table.basic-table th {
		background-color: #66676b !important;
	}
	.dashboard-list-box{
		border-bottom: 1px solid #e0e0e0e0;
	}
	.message-error{
		color:red;
	}
	.mfp-container{
		position:fixed;
	}
	.center{
		text-align:center;
		display:block;
	}
	.dashboard-list-box ul li:hover {
    background-color: #fff;
	}
	
	</style>
	<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}
.list-box-listing-content .inner {
    position: relative;
    top: 0px !important;
    vertical-align: top;
}

tr:nth-child(even){background-color: #f2f2f2}
@media only screen and (max-width: 1024px){
	table.basic-table td {
		border-bottom: 1px solid #ddd;
		display: block;
		font-size: 14px;
		text-align: center;
	}
	.text-checkout{
		text-align:left;

	}
	.seccion-borrar{
		display:none !important;
	}
	.plusminus{
		margin-top: 5px !important;
		margin-bottom: 5px !important;
	}
	.seccion-total{
		margin-top:7px !important;
		margin-bottom: 7px !important;
	}
	table.basic-table td.deleteMobile{
		display: block !important;
	}
}
.deleteMobile{
	display: none !important;
}
.list-box-listing-img a img {
    object-fit: cover;
    height: auto !important;
    max-height: 150px !important;
    width: 100%;
    border-radius: 4px;
}
.list-box-listing-content{
	margin: auto;
}
</style>
<style>


/*
  .responsive-table li {
    border-radius: 3px !important;
    padding: 11px 30px !important;
    display: flex !important;
    justify-content: space-between !important;
    margin-bottom: 25px !important;
	font-weight: 500 !important;
  }
  .table-header {
    background-color: #66676b !important;
	color: #fff !important;
    font-size: 14px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.03em !important;
  }
  .col-1 {
    flex-basis: 10% !important;
  }
  .col-2 {
    flex-basis: 50% !important;
  }
  .col-3 {
    flex-basis: 20% !important;
  }
  .col-4 {
    flex-basis: 20% !important;
  }

  @media only screen and (max-width: 1024px) {
    .responsive-table .table-header{
      display: none !important;
    }
	.responsive-table .col-1{
      display: none !important;
    }
  }
  
*/
</style>
<script src="{{ asset('js/dropzone.js') }}"></script>
<div id="titlebar" style="padding: 39px 0;margin-bottom: 0;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Carrito de Compras</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="/">Principal</a></li>
						<li>Carrito de Compras</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>

<div class="container margin-bottom-45">
	<div class="row">

		<div class="row with-forms margin-left-0 margin-right-0">
			<div class="tab-content" id="tab1a" style="">
						
							<div class="col-md-9" style="">
								<h4 class="headline margin-top-0 margin-bottom-30">Todos tus Productos escogidos</h4>
								
								<table class="basic-table" id="table-products"> 
										<thead>
											<tr>
												<th style="text-align: center;width:10%;">Eliminar</th>
												<th style="width:50%;">Producto</th>
												<th style="text-align: center;width:20%;">Cantidad</th>
												<th style="text-align: center;width:20%;">Total</th>
												<th class="deleteMobile"style="text-align: center;width:20%;">Opciones</th>
											</tr>
										</thead>
										<tbody id="tBodyCheckout"> 
										</tbody>
								</table>
							</div> 
							<div class="col-md-3">
								<h4 class="headline margin-top-0 margin-bottom-30">Resumen</h4>
								<table class="basic-table"> 
										<thead>
											<tr>
												<th style="text-align: center;width:10%;">TOTAL</th>
												
											</tr>
										</thead>
										<tbody id="tBodyTotal"> 
											
										</tbody>
								</table>
								@if (Session::get('costumer'))
								<button class="button fullwidth margin-top-20 margin-left-35" id="checkout-final" style="width:74%;"> Comprar</button>
								@else
								<button class="button fullwidth margin-top-20 margin-left-35" id="pay-cancel" style="width:74%;"> Comprar</button>
								@endif
								<div class="margin-top-10 message-data">

								</div>
								
							</div>
						</div>
					

					<div class="col-md-5 margin-top-20" >
						
						<div class="margin-top-10 message"> 
					
						</div>
				
					</div>

			</div> 
		</div> 
	</div> 
</div>

<script>
	
</script>
@endsection

@section('after-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src={{asset('/js/frontend/checkout.js')}}></script>
<script>
	$('#pay-cancel').on('click',function(){ 
		$('.sign-in').click();
	})

     $('#table-products').stacktable();
	
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
@endsection