@extends('frontend.app' , ['bussines'=> $business, 'users', $users]) 
@section('content')
<style>
	.casaroyal-search-locations-list {
		width: 100%;
		display: inline-block;
		margin: 0!important;
		color: #232628;
		list-style: none;
		box-shadow: 0 10px 15px 0 rgba(0,0,0,.1);
		border-radius: 4px;
		-webkit-border-top-left-radius: 0;
		-webkit-border-top-right-radius: 0;
		-moz-border-radius-topleft: 0;
		-moz-border-radius-topright: 0;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		position: absolute;
		left: 15px; 
		background-color: #fff; 
		z-index: 1010; 
		display: none;
	}
	.casaroyal-search-locations-list li {
		list-style: none!important; 
		margin: 0 15px!important;
	}
	.casaroyal-search-locations-list li a {
		color: #797979; 
		letter-spacing: 0;
		font-size: 16px;
		line-height: 15px;
		border-radius: 4px;
		width: 100%;
		display: inline-block;
		padding-left: 40px !important;
		position: relative;
	}
	.casaroyal-search-locations-list li a:hover, .casaroyal-search-locations-list li:first-child a {
		background-color: rgba(42,65,232,.07);
		color: #a71b20;
	}
	.advance-search .af-estate-search-field input, .advance-search .af-estate-search-field select {
		float: left;
		width: 100%;
		margin: 0;
		margin-bottom: 19px!important;
		font-size: 14px;
		position: relative;
		display: block;
		line-height: 1;
		padding: 13px 15px 14px 15px;
		color: #232628;
		border: 1px solid #ececec;
		background-color: #ececec;
		border-radius: 4px;
		font-family: Rubik,sans-serif;
		font-weight: 500;
		outline: 0;
	}
	#autocomplete-input:hover {
		display: block;

	}
</style>
<div id="titlebar"  class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12"> 
				<h2>Negocios</h2><span>Encuentra tu negocio favorito </span> 
				<nav id="breadcrumbs">
					<ul>
						<li><a href="/">Inicio</a></li>
						<li>Busquedas</li>
					</ul>
				</nav> 
			</div>
		</div>
	</div>
</div> 
<div class="container">
	<div class="row"> 
		<div class="col-md-12">
			
			<div class="main-search-input gray-style margin-top-0 margin-bottom-10">
				<div class="main-search-input-item">
					<select data-placeholder="Todos los departamentos" id="department" name="department" class="chosen-select" >
						<option value="">Todos los departamentos</option>	 
						@foreach ($departaments as $item)
							<option value={{$item->id}}>{{$item->name}}</option>
						@endforeach 
					</select>
				</div> 
				<div class="main-search-input-item">
					<select data-placeholder="All Categories" name="business" id='business' class="chosen-select" >
						<option value="">Todas las Categorias</option>	 
						@foreach ($business as $item)
							<option value={{$item->id}}>{{$item->name}}</option>
						@endforeach 
					</select>
				</div> 
				<div class="main-search-input-item  ">
					<select name="name"   class="chosen-select"  id='name'>
						<option value="">buscar ... </option>
						@foreach ($companies as $item)
							<option value={{$item->id}}>{{$item->company}}</option> 
						@endforeach	
					</select> 
				</div> 
				<button class="button" id='btnSearch' type="button">Buscar</button>
			</div>
		</div> 
		<div class="col-md-12"> 
			<div class="row margin-bottom-25 margin-top-30"> 
				<!--<div class="col-md-6"> 
					<div class="layout-switcher"> 
						<a href="#" class="list active"><i class="fa fa-align-justify"></i></a>
						<a href="#" class="grid "><i class="fa fa-th"></i></a>
					</div>
				</div>-->

				<!--<div class="col-md-6">
					<div class="fullwidth-filters"> 
					 
					 
						<div class="sort-by">
							<div class="sort-by-select">
								<select data-placeholder="Default order" class="chosen-select-no-single">
									<option>Default Order</option>	
									<option>Highest Rated</option>
									<option>Most Reviewed</option>
									<option>Newest Listings</option>
									<option>Oldest Listings</option>
								</select>
							</div>
						</div> 
					</div>
				</div> -->
			</div> 
			<div class="row" id='content-companies'>  
			</div>  
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12"> 
					<div class="pagination-container margin-top-20 margin-bottom-40">
						<nav class="pagination">
							<ul id="paginationNav">
								 
							</ul>
						</nav>
					</div>
				</div>
			</div> 
		</div>

	</div>
</div> 
@endsection
@section('after-scripts')
	 
	<script src={{asset('js/frontend/search.js')}}></script>
	<script >
		$('#content-companies').on('click', ' div.col-lg-4 a.listing-item-container .listing-item span.like-icon', function () { 
		 
			let self= $(this)
			let user = $(this).attr('data-id');
			if (user) {
				$.get('/like', { user: user }, function (res) {
					console.log(res);
					if (res.status == "200") {
						$(this).click();
						$('.sign-in').click();
					} else {
						self.toggleClass('liked');
						self.children('.like-icon').toggleClass('liked');
					}
				})
			}
		})
	</script>
@endsection