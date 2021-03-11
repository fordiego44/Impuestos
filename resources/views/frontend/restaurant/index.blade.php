@extends('frontend.app' , ['bussines'=> $bussines, 'users', $users])
@section('content')
<style>
	.dashboard-list-box ul li {
		padding: 10px 17px !important;
		border-bottom: 1px solid #eaeaea;
		transition: .3s;
		position: relative;
	}
	.container1 {
		margin: 0 100px;
	}


	.list-li {
		padding-right:5px !important;
		padding-left:5px !important;
	}
	.icon-row-down {
		position: absolute !important;
		right: 0 !important;
		top: 50% !important;
		transform: translate3d(0, -50%, 0) rotate(0) !important;
		transition: .2s !important;
	}
	.buttons-to-right-delivery {
		position: absolute;
		right: 30px;
		top: 50%;
		transform: translate3d(0, -49%, 0);
		-moz-transform: translate3d(0, -50%, 0);
		opacity: 1;
		transition: .4s;
		display: flex;
		flex-direction: column;
		align-items: center;
	}
	.padding-0 {
		padding:0px !important;
	}
	.dashboard-list-box {
		box-shadow:none !important;
		border-bottom: 0px solid #e0e0e0 !important;
		border-left: 0px solid #e0e0e0 !important;
		border-top: 1px solid #e0e0e0 !important;

	}
	.toggle-container {

	}
	.trigger a {
		font-size: 17px !important;
	}
</style>{{--
<div class="listing-slider mfp-gallery-container margin-bottom-0 margin-top-80">
	@foreach ($gallery as $item)
		<a href="{{asset("/images/$item->image")}}" data-background-image="{{asset("/images/$item->image")}}" class="item mfp-gallery" title="Title 1"></a>

	@endforeach
</div>

<div class="container1 margin-bottom-45">
	<div class="row sticky-wrapper">
		<div class="col-lg-9 col-md-9 " >

			<div id="titlebar" class="listing-titlebar" style="padding: 70px 0 0 0 !important;">
				<div class="listing-titlebar-title">
					<h2>{{$user->name}} <span class="listing-tag">Restaurante</span></h2>
					<span>
						<a href="#listing-location" class="listing-address">
							<i class="fa fa-map-marker"></i>
							{{$user->email}}
						</a>
					</span>
				</div>
			</div>

			@foreach ($clasifications as $value)

					<div class="toggle-wrap active margin-top-15 col-lg-6 list-li"  >
						<span class="trigger opened active" >
							<a href="#" >{{$value->name}}<i class="sl sl-icon-arrow-down icon-row-down" style="margin: 0 12px 0 0 !important;"></i></a>
						</span>

							<div class="toggle-container" style="padding: 1px 1px;display:block" >
								@foreach ($value->dishs as $item)

										<div class="dashboard-list-box toggle-container1" style="margin:0px;">
											<ul >
												<li>
													<div class="list-box-listing">
														<div class="list-box-listing-img" style="max-width: 100px !important; max-height:100px !important">
															<a href="/restaurant/{{$user->slug}}/{{$item->id}}">
																<img src='/images/{{$item->image}}' alt="" style="width: auto !important;max-width: 100px !important; max-height:100px !important">
															</a>
														</div>
														<div class="list-box-listing-content">
															<div class="inner">
																<h3>{{$item->name}}</h3>
																<ul style="padding:0px !important">
																<li class="paid" style="padding:0px !important">Precio: S/. {{$item->price }}.00</li>
															</ul>
															</div>
														</div>
													</div>
													<div class="buttons-to-right-delivery">
														<div class=" " style="width: 60px !important">
															<select class="" id='count-{{$item->id}}' name="cant" style="height: 40px;    padding: 0 12px !important;">
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
															</select>
														</div>
														<div class=" ">
														<button  data-price={{$item->price }} data-url={{$item->image}} data-name={{$item->name}} data-category_id={{$value->id}} data-id={{$item->id}} data-price={{$item->price}} class='addCart'>Añadir</button>
														</div>
													</div>
												</li>
											</ul>
										</div>

								@endforeach
							</div>

					</div>
			@endforeach
		</div>

		<div class="col-lg-3 col-md-3 sticky">
			<div class="boxed-widget opening-hours margin-top-35">
				<div class="listing-badge now-open">Ahora Abierto</div>
				<h3><i class="sl sl-icon-clock"></i> Horario </h3>
				<ul>
					<li>Lunes <span>{{$days->monday1}} AM - {{$days->monday2}} PM</span></li>
					<li>Martes <span>{{$days->tuesday1}} AM - {{$days->tuesday2}} PM</span></li>
					<li>Miercoles <span>{{$days->wednesday1}} AM - {{$days->wednesday2}} PM</span></li>
					<li>Jueves <span>{{$days->thursday1}} AM - {{$days->thursday2}} PM</span></li>
					<li>Viernes <span>{{$days->friday1}} AM - {{$days->friday2}} PM</span></li>
					<li>Sabado <span>
					@if ($days->saturday1 == 'cerrado')
						Cerrado
					@else
						{{$days->saturday1}} AM - {{$days->saturday2}} PM
					@endif
					</span></li>
					<li>Domingo <span>
						@if ($days->sunday1 == 'cerrado' )
							Cerrado
						@else
							{{$days->sunday1}} AM - {{$days->saturday2}} PM
						@endif
					</span></li>
				</ul>
			</div>
			<div id="booking-widget-anchor" class="boxed-widget booking-widget " style="margin-top: 10px">
				<h3><i class="fa fa-calendar-check-o "></i> Sub total</h3>
				<div class="row with-forms  margin-top-0">
					<div class="col-lg-12" style="display: flex">
						<h3> S/. </h3>
						<h3 style="text-align: center;" id='priceTotal'>0</h3>

						<h3> .00 </h3>
					</div>
				</div>
				<a href="/checkout" class="button book-now fullwidth margin-top-5">ver carrito</a>
			</div>





		</div>
	</div>
</div>--}}
 
<div class="clearfix"></div>
<!-- Header Container / End -->

<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="    padding-top: 70px;">

				<h2>{{$user->company}}</h2><span>{{$user->business}}</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="#">{{$user->business}}</a></li>
						<li>{{$user->company}}</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row">

		<div class="col-lg-9 col-md-8 padding-right-30">

			<!-- Sorting / Layout Switcher -->
			<div class="row margin-bottom-25">

				<div class="col-md-6 col-xs-6">
					<!-- Layout Switcher -->
					<div class="layout-switcher">
						{{--<a href="listings-grid-with-sidebar-1.html" class="grid"><i class="fa fa-th"></i></a>
						<a href="#" class="list active"><i class="fa fa-align-justify"></i></a>--}}
					</div>
				</div>

				<div class="col-md-6 col-xs-6">
					<!-- Sort by -->
					<div class="sort-by">
						<div class="sort-by-select">
							<select data-placeholder="All Categories" class="chosen-select" id="category">
								<option value="01">Todas las categorias</option>
								@foreach($clasifications as $value)
									<option value="{{$value->id_category}}">{{$value->category_name}}</option>	
								@endforeach
								
								
							</select>
						</div>
					</div>
				</div>
			</div>
			<!-- Sorting / Layout Switcher / End -->

			
			<div class="row" id="content">

				
				

			</div>
			{{--<nav style="box-shadow: none; background:white;margin-left: 14px;" id="ocultar">
				<ul id="paginationNav">

				</ul>

			</nav>--}}

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<!-- Pagination -->
					<div class="pagination-container margin-top-20 margin-bottom-40">
						<nav class="pagination" id="ocultar">
							<ul id="paginationNav">
								{{--<li><a href="#" class="current-page">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>--}}
							</ul>
						</nav>
					</div>
					</div>
			</div>
			<!-- Pagination / End -->

		</div>


		<!-- Sidebar
		================================================== -->
		<div class="col-lg-3 col-md-4">
			<div class="sidebar">

				<!-- Widget -->
				<div class="widget margin-bottom-40">
					<h3 class="margin-top-0 margin-bottom-30">Filtros</h3>

					<!-- Row -->
					<div class="row with-forms">
						<!-- Cities -->
						<div class="col-md-12">
							<input type="text" placeholder="¿Qué estás buscando?" value=""  id="word"/>
							<input type="text" style="display:none" value="{{$user->id}}" id="usuario"/>
						</div>
					</div>
					<!-- Row / End -->
					<button class="button fullwidth margin-top-25" id="search">Buscar</button>

					<!-- Row -->
					{{--<div class="row with-forms">
						<!-- Type -->
						<div class="col-md-12">
							<select data-placeholder="All Categories" class="chosen-select" >
								<option>Todas las categorias</option>	
								<option>Shops</option>
								<option>Hotels</option>
								<option>Restaurants</option>
								<option>Fitness</option>
								<option>Events</option>
							</select>
						</div>
					</div>--}}
					<!-- Row / End -->


					<!-- Row -->
					{{--<div class="row with-forms">
						<!-- Cities -->
						<div class="col-md-12">

							<div class="input-with-icon location">
								<div id="autocomplete-container">
									<input id="autocomplete-input" type="text" placeholder="Location">
								</div>
								<a href="#"><i class="fa fa-map-marker"></i></a>
							</div>

						</div>
					</div>--}}
					<!-- Row / End -->
					<br>

					<!-- Area Range -->
					{{--<div class="range-slider">
						<input class="distance-radius" type="range" min="1" max="100" step="1" value="50" data-title="Radius around selected destination">
					</div>--}}


					<!-- More Search Options -->
					{{--<a href="#" class="more-search-options-trigger margin-bottom-5 margin-top-20" data-open-title="More Filters" data-close-title="More Filters"></a>

					<div class="more-search-options relative">

						<!-- Checkboxes -->
						<div class="checkboxes one-in-row margin-bottom-15">
					
							<input id="check-a" type="checkbox" name="check">
							<label for="check-a">Elevator in building</label>

							<input id="check-b" type="checkbox" name="check">
							<label for="check-b">Friendly workspace</label>

							<input id="check-c" type="checkbox" name="check">
							<label for="check-c">Instant Book</label>

							<input id="check-d" type="checkbox" name="check">
							<label for="check-d">Wireless Internet</label>

							<input id="check-e" type="checkbox" name="check" >
							<label for="check-e">Free parking on premises</label>

							<input id="check-f" type="checkbox" name="check" >
							<label for="check-f">Free parking on street</label>

							<input id="check-g" type="checkbox" name="check">
							<label for="check-g">Smoking allowed</label>	

							<input id="check-h" type="checkbox" name="check">
							<label for="check-h">Events</label>
					
						</div>
						<!-- Checkboxes / End -->

					</div>--}}
					<!-- More Search Options / End -->

					

					<div class="col-lg-18 col-md-18 sticky">
						<div class="boxed-widget opening-hours margin-top-35">
							<div class="listing-badge now-open">Ahora Abierto</div>
							<h3><i class="sl sl-icon-clock"></i> Horario </h3>
							<ul>
								<li>Lunes <span>{{$days->monday1}}  - {{$days->monday2}} </span></li>
								<li>Martes <span>{{$days->tuesday1}}  - {{$days->tuesday2}} </span></li>
								<li>Miercoles <span>{{$days->wednesday1}}  - {{$days->wednesday2}} </span></li>
								<li>Jueves <span>{{$days->thursday1}}  - {{$days->thursday2}} </span></li>
								<li>Viernes <span>{{$days->friday1}}  - {{$days->friday2}} </span></li>
								<li>Sabado <span>
								@if ($days->saturday1 == 'cerrado')
									Cerrado
								@else
									{{$days->saturday1}}  - {{$days->saturday2}} 
								@endif
								</span></li>
								<li>Domingo <span>
									@if ($days->sunday1 == 'cerrado' )
										Cerrado
									@else
										{{$days->sunday1}}  - {{$days->saturday2}} 
									@endif
								</span></li>
							</ul>
						</div>

					</div>
				<!-- Widget / End -->

			</div>
		</div>
		
		<!-- Sidebar / End -->
	</div>
</div>


@endsection
@section('after-scripts')
	<script src={{asset('/js/frontend/detail.js')}}></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
	<script>

			
			let paginator = { 
				pagesNumber(pagination) {
					let offset = 8;
					
							if(!pagination.to) {
								return [];
							}

							var from = pagination.current_page - offset;
							if(from < 1) {
								from = 1;
							}

							var to = from + (offset * 2);
							if(to >= pagination.last_page){
								to = pagination.last_page;
							}

							var pagesArray = [];
							while(from <= to) {
								pagesArray.push(from);
								from++;
							}
							return pagesArray;
				},
				setPaginatorHTML(data) {
					let numberPager = this.pagesNumber(data);
					
					let html = [], preview, next;
					for (let i = 0; i < numberPager.length; i++) {
					let active = numberPager[i]  == data.current_page  ? 'active' : '';
					if (data.current_page> 1) {
						preview =  `<li class="page-item" >
										<a class="page-link"  onclick="paginator.cambiarPagina('${data.current_page - 1}')">Ant</a>
									</li>`
					} 
					if (data.current_page < data.last_page) {
						next = `<li class="page-item "  >
									<a class="page-link "  onclick="paginator.cambiarPagina('${data.current_page + 1}')">Sig</a>
								</li>`
					}  
					html[i] =  `<li class="page-item  ${active}">
								<a class="page-link" onclick="paginator.cambiarPagina(${numberPager[i]})">${numberPager[i]}</a>
								</li>`  
					}
					html.unshift(preview);
					html.push(next);

					return html;  
				},
				setPagosHtml(data) {
					let html = [];
					//let check = [];
					for (let i = 0; i < data.length; i++) {

					html[i] = `

											<div class="col-lg-12 col-md-12">
												<div class="listing-item-container list-layout">
													<a href="/restaurant/${data[i].slug}/${data[i].id}/${data[i].product_slug}/${data[i].product_id}" class="listing-item">
														
														<!-- Image -->
														<div class="listing-item-image">
															<img src="/images/${data[i].image}" alt="">
															<span class="tag">${data[i].category_name}</span>
														</div>
														
														<!-- Content -->
														<div class="listing-item-content">
			
															<div class="listing-item-inner">
															<h3>${data[i].product_name}</h3>
															<span>Precio: S/. ${data[i].price}</span>
																<div >
																	<div class="rating-counter">${data[i].description}</div>
																</div>
															</div>
			
															<span class="like-icon"></span>
			
															<div class="listing-item-details">¡Dale clic si quieres ver los detalles!</div>
														</div>
													</a>
												</div>
											</div>
								`;
					}
					return html; 
				},
				cambiarPagina(page){ 
					localStorage.setItem('page', page)
					this.listarPagos(page);
				},
				async listarPagos(page = 0){
					/*$('#ocultar').toggleClass(function(){
					if($(this).is('.oculto')){
						$('#ocultar').removeClass('oculto');
					} 
					})*/
					let me=this;
					let id = $('#usuario').val();
					var url= '/listado/'+id+'?page=' + page; 
					let { data: data, status } = await axios.get(url); 
					let pagination = this.setPaginatorHTML(data.pagination)
					let pagos = this.setPagosHtml(data.pagos.data); 
					$('#content').empty().append(pagos);
					$('#paginationNav').empty().append(pagination); 
					return page;
				},
				async category(page=0){
					let me=this;
					let id = $('#category').val();
					var url= '/searchs/'+id+'?page=' + page; 
					let { data: data, status } = await axios.get(url); 
					let pagination = this.setPaginatorHTML(data.pagination)
					let pagos = this.setPagosHtml(data.pagos.data); 
					$('#content').empty().append(pagos);
					$('#paginationNav').empty().append(pagination); 
					return page;
				},
				async word(page=0){
					let me=this;
					let word = $('#word').val();
					let id = $('#usuario').val();
					//let id = $('#category').val();
					var url= '/words/'+id+'/'+word+'?page=' + page; 
					let { data: data, status } = await axios.get(url); 
					let pagination = this.setPaginatorHTML(data.pagination)
					let pagos = this.setPagosHtml(data.pagos.data); 
					$('#content').empty().append(pagos);
					$('#paginationNav').empty().append(pagination); 
					return page;
				}
			}
			paginator.listarPagos();
			$('#category').on('change',function(){

				let data = $('#category').val();
				console.log(data);
				//$('#content').empty();
				if(data == '01'){
					$('#content').empty();
					paginator.listarPagos();
				}
				else{
					paginator.category();
				}
			})
			$('#search').on('click',function(){
				
				let word = $('#word').val();
				let user = $('#usuario').val();
				
				if($.trim(word) != ''){

					console.log('admitido');
					paginator.word();
				}
				else{
					console.log('inadmitido')
				}
					

			})
	
	</script>
@endsection
