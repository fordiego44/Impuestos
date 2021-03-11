@extends('frontend.app' , ['bussines'=> $business, 'users' => $users]) 
@section('content')
@include('frontend.helpers.search')

<style>
	.listing-item:before { 
		background: linear-gradient(to top, rgba(35, 35, 37, 0.9) 0%, rgba(35, 35, 37, 0.45) 15%, rgba(22, 22, 23, 0) 30%, rgba(0, 0, 0, 0) 100%)
 	}
	.star-rating {
		background: #fff;
	}
	.listing-item-container {
		box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);

	}
	.listing-item-container.compact .listing-item {
		border-radius: 0px !important;  
	}
	.listing-item {
		 
		background-color: #fff;
		display: block;
		width: 100%;
		border-radius: 3px; 
		background: #ccc;
		border-radius: 0 0 0 0;
		height: 100%; 
		position: relative;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: 50%;
		height: 300px;
		z-index: 100;
		cursor: pointer;
		box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
	}
	.listing-small-badges-container {
		position: absolute;
		top: 25px;
		left: 25px;
		z-index: 110;
		padding-right: 50px;
	}
	.listing-small-badge.pricing-badge i {
		background-color: #64bc36;
	}
	.listing-small-badge i {
		position: absolute;
		height: 20px;
		width: 20px;
		top: 3px;
		left: 3px;
		border-radius: 100%;
		text-align: center;
		line-height: 20px;
		font-size: 12px;
		background: #222;
		color: #fff;
	}
	.listing-small-badge {
		display: inline-block;
		padding-left: 31px;
		padding-right: 10px;
		font-size: 13px;
		font-weight: 500;
		background-color: #fff;
		color: #777;
		border: none;
		border-radius: 100px;
		line-height: 26px;
		height: 26px;
		box-shadow: 0 1px 4px rgba(0,0,0,0.08);
		vertical-align: top;
		position: relative;
		margin-bottom: 3px;
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
	.casaroyal-search-locations-list li a .fa {
		opacity: .2;
		font-size: 20px;
		position: absolute;
		top: 16px;
		left: 8px;
	}
</style>
 
<div class=" " style="margin:40px">
	<div class="row">
		<div class="col-lg-3 col-md-4">
			<div class="sidebar">

				<!-- Widget -->
				<div class="widget margin-bottom-40">
					<h3 class="margin-top-0 margin-bottom-30">Filtros</h3>
					<form style="display: contents;"  action="/search-result">

				 
					<div class="row with-forms">
						<!-- Cities -->
						<div class="col-md-12">
								
								<div class="input-with-icon location ">
									<div class=" ">
										<!--<input type="text" name='ctg' id="ctg" class="casaroyal-search-keyword form-control pxp-is-address" id="location-search" placeholder="Buscar" autocomplete="off">-->
										<input type="text" name='ctg'  class="casaroyal-search-keyword form-control pxp-is-address" id="params-search" placeholder="Buscar" autocomplete="off">
										<input type="hidden" name='type' id='type'>
										<ul class="casaroyal-search-locations-list" id="search-list"> </ul>
									</div> 
								</div>
							
						</div>
					</div> 
					<button class="button fullwidth margin-top-25">Buscar</button>
					
					</form>
				</div>
				<!-- Widget / End -->

			</div>
		</div>
		
		<div class="col-blog col-lg-9 col-md-8 padding-right-30 page-container-col post-30 page type-page status-publish hentry">

			<!-- Sorting / Layout Switcher -->
			<div class="row margin-bottom-25">

				<div class="col-md-6 col-xs-6">
				 
				</div>

				<div class="col-md-6 col-xs-6">
				 
				</div>
			</div>
			<!-- Sorting / Layout Switcher / End --> 
			<div class="row" id="content-products">
 
			 
			 
			 
			</div> 
			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12"> 
					<div class="pagination-container margin-top-20 margin-bottom-40">
						<nav class="pagination" id="paginationNav">
							<ul > 
							</ul>
						</nav>
					</div>
				</div>
			</div> 
			<!-- Pagination / End --> 
		</div>
 
	</div>
</div> 
@endsection
@section('after-scripts')
<!--
<script src={{asset('js/frontend/search_product.js')}}></script>-->
<script src={{asset('/js/frontend/calification.js')}}></script>
<script src="{{ asset('js/frontend/comentario.js') }}"></script>
<script src="{{ asset('js/frontend/sucursales.js') }}"></script>
<script src={{asset('js/filter_parameter.js')}}></script>
<script> 
	jQuery('.casaroyal-search-keyword').focus(function () {
		jQuery('.casaroyal-search-locations-list').fadeIn(50);
	}); 
	jQuery('.casaroyal-search-keyword').focusout(function () {
		jQuery('.casaroyal-search-locations-list').fadeOut(150);
	});
</script>
 
<script>
	 
	let paginator = {
			pagesNumber(pagination) {
				let offset = 8;

				if (!pagination.to) {
					return [];
				}

				var from = pagination.current_page - offset;
				if (from < 1) {
					from = 1;
				}

				var to = from + (offset * 2);
				if (to >= pagination.last_page) {
					to = pagination.last_page;
				}

				var pagesArray = [];
				while (from <= to) {
					pagesArray.push(from);
					from++;
				}
				return pagesArray;
			},
			setPaginatorHTML(data) {
				let numberPager = this.pagesNumber(data);

				let html = [], preview, next;
				for (let i = 0; i < numberPager.length; i++) {
					let active = numberPager[i] == data.current_page ? 'active' : '';
					if (data.current_page > 1) {
						preview = `<li class="page-item" >
									<a class="page-link"  onclick="paginator.cambiarPagina('${data.current_page - 1}')">Ant</a>
								</li>`
					}

					if (data.current_page < data.last_page) {
						next = `<li class="page-item "  >
									<a class="page-link "  onclick="paginator.cambiarPagina('${data.current_page + 1}')">Sig</a>
								</li>`
					}

					html[i] = `<li class="page-item  ${active}">
								<a class="page-link" onclick="paginator.cambiarPagina(${numberPager[i]})">${numberPager[i]}</a>
							   </li>`
				}
				if (data.current_page > 1) {
					html.unshift(preview); 

				}
				 
				html.push(next);

				return html;
			}, async cambiarPagina(page) {
				var ctg = getParameterByName('ctg'); // "lorem"
 				paginator.getProducts(page);

			},
			productHTML(data) {
					let html = []
					for (let i = 0; i < data.length; i++) {
						
							
								html[i] = `<div class="col-lg-4 col-md-12">
								<a href="/resultados/${data[i].slug}/${data[i].id}/${data[i].product_slug}/${data[i].product_id}" class="listing-item-container listing-geo-data compact"> 
									<div class="listing-item  featured-listing">
										<div class="listing-small-badges-container"> 
											<div class="listing-small-badge pricing-badge" style='font-size:14px'>
												<i class="fa fa-tag"></i> S/ ${data[i].price}.00
											</div> 	
										</div> 
										<img src="/images/${data[i].image}" alt="" class="attachment-listeo-listing-grid size-listeo-listing-grid wp-post-image"> 
										<div class="listing-item-content">
											<!--<div class="numerical-rating" data-rating="3.5"></div>-->
											<h3>${data[i].category}<i class="verified-icon"></i></h3>
											<span>${data[i].name}</span>
										</div>
										<!--<span class="like-icon"></span>-->
									</div>
									<div class="star-rating" >
										<div class="rating-counter" style='color:#444;margin: 10px;'>${data[i].description.substr(0, 55)} . . .</div> 
									</div>
								</a>
							</div>`;
					}
					return html;
			}, async getProducts(page) {
				var ctg = getParameterByName('ctg'); // "lorem"
				var business = getParameterByName('business'); // "lorem"
				var type = getParameterByName('type'); // "lorem"
 
				const data = await axios.get(`/search-product-all?business=${business}&type=${type}&ctg=${ctg}&page=${page}`)
				if(data.data.products.data.length == 0) {
					let html  = `<div class="notification notice closeable" style='margin-top:20px'>
								 
									<h4 style='margin:0px;text-align:center'> No se encontraron resultados.</h4>
								</div>`;
					$('#content-products').empty().append(html); 
					$('#paginationNav ul').empty();
				} else {
					let html  = paginator.productHTML(data.data.products.data)
					$('#content-products').empty().append(html); 
					let paginateHTML = paginator.setPaginatorHTML(data.data.pagination) 
					$('#paginationNav ul').empty().append(paginateHTML);
				}
				
			}
		}  
		function getParameterByName(name, url) {
			if (!url) url = window.location.href;
			name = name.replace(/[\[\]]/g, '\\$&');
			var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
				results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, ' '));
		}
		paginator.getProducts(page = 1);
	</script>
@endsection