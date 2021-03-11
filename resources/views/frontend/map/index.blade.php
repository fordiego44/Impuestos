@extends('frontend.app' , ['bussines'=> $bussines, 'users', $users])

@section('content')
  <style>
    .view-map {
      display: flex;
      flex-direction: row;
      order: 2;
      justify-content: space-between;
    }
    .verified-badge:hover {
      border-radius: 4px;
    }
  </style>
  <input type="hidden" value={{$user->id}} id='user_id'>
	<div class="listing-slider mfp-gallery-container margin-bottom-0 ">
		@foreach ($gallery as $item)
			<a href="{{asset("/images/$item->image")}}" data-background-image="{{asset("/images/$item->image")}}" class="item mfp-gallery" title="Title 1"></a>

		@endforeach
	</div>
	<div class="container">

		<div id="titlebar" class="listing-titlebar">
			<div class="listing-titlebar-title view-map" >
        <div>
          <h2>{{$user->company}}
            <span class="listing-tag">{{$user->bussines}}</span>
          </h2> 
          <div class="style-2">
  
            <div class="toggle-wrap" style="border-bottom: 0px;">
              <span class="trigger"><a href="#">Informacion de la empresa<i class="sl sl-icon-plus"></i></a></span>
              <div class="toggle-container" style="display: none;">
                <span style="display:block;">
                  <a href="#listing-location" class="listing-address" style="cursor:default;">
                    <i class="fa fa-map-marker"></i>
                      {{$user->department}} > {{$user->province}} > {{$user->district}}
                  </a>
                </span>
                <span >
                  <a href="#listing-location" class="listing-address" style="cursor:default;">
                    <i class="fa fa-home"></i>
                      {{$user->address}}
                  </a>
                </span>
                <span style="display:block;">
                  <a href="#listing-location" class="listing-address" style="cursor:default;">
                    <i class="fa fa-phone"></i>
                      {{$user->phone}}
                  </a>
                </span>
              </div>
            </div> 
          </div>  
          <div>
              <div class="leave-rating">
                <input type="radio" class="qualification" name="rating" id="rating-5" value="5" />
                <label for="rating-5" class="fa fa-star"></label>
                <input type="radio" class="qualification" name="rating" id="rating-4" value="4" />
                <label for="rating-4" class="fa fa-star"></label>
                <input type="radio" class="qualification" name="rating" id="rating-3" value="3" />
                <label for="rating-3" class="fa fa-star" ></label>
                <input type="radio" class="qualification" name="rating" id="rating-2" value="2" />
                <label for="rating-2" class="fa fa-star" ></label>
                <input type="radio" class="qualification" name="rating" id="rating-1" value="1" />
                <label for="rating-1" class="fa fa-star" ></label>
                <input type="hidden" id="qualification" value="0">
                <input type="hidden" id="id_company" value="{{$user->id}}">
                <input type="hidden" id="valor" value="{{$user->qualification}}">
              </div>
              <div class="rating-counter"><a href="#listing-reviews">({{$user->opinions}} Críticas)</a></div>
          </div>
        </div>
        <div>
         
        <a href="#show-map" id='sucursal-click' class=" sign-in popup-with-zoom-anim verified-badge" href='/resultados/{{$user->slug}}/{{$user->id}}/sucursales' style="border: 0px;cursor: pointer;" >
            <i class="sl sl-icon-login"></i> Ver otras sucursales 
        </a>
        </div>
        
        <!--cambios-->
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-4 padding-right-30" >
				<div class="sidebar">
					<div class="widget margin-bottom-40">
						<!--<h3 class="margin-top-0 margin-bottom-30">Filtros</h3>
						-->
						<input type="hidden" id='user_id' value="{{$user->id}}">


						<div class="checkboxes one-in-row margin-bottom-15" id="content-category">
							<input id="check-0" type="checkbox" name="check-0" checked  class="all check-category" data-id="0">
							<label for="check-0">Todas las categorías</label>
							@foreach ($categories as $item)
								@if (Request::query('category') == $item->id)
									<input id="check-{{$item->id}}" type="checkbox" name="checked[]" checked class="check-category"  data-id={{$item->id}} data-text="1">
									<label for="check-{{$item->id}}">{{$item->name}}</label>
								@else
									<input id="check-{{$item->id}}" type="checkbox" name="checked[]" class="check-category"  data-id={{$item->id}} data-text="1">
									<label for="check-{{$item->id}}">{{$item->name}}</label>
								@endif

							@endforeach
						</div>

					</div>

				</div>
			</div>

			<div class="col-lg-9 col-md-8">
	 

					<div class="row  " id="content-products">
 

					</div> 
				<div class="clearfix"></div>


				<div class="row fs-listings">
					<div class="col-md-12">


						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-12">

								<div class="pagination-container margin-top-15 margin-bottom-40">
									<nav class="pagination" id="paginationNav">
										<ul>

										</ul>
									</nav>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>


					</div>
				</div>

				<div class="row">
            <div class="col-lg-12 col-md-12">
                {{-- <h3 class="margin-top-60 margin-bottom-20">Comentarios</h3>
                 --}}

              <div id="listing-pricing-list" class="listing-section">

                <h3 class="listing-desc-headline margin-top-70 margin-bottom-10">Comentarios</h3>

                {{-- <div class="show-more" style="height: 200px;"> --}}
                  {{-- <div class="pricing-list-container"> --}}

                    <section class="comments listing-reviews">
                      <ul class="comment-list" id="ul-opinion">
                        <li class="comment byuser comment-author-sante even thread-even depth-1" id="comment-29" style="margin-top: 2%;padding-bottom: 2%;">

                          <div class="list-box-listing bookings">

                            <div class="list-box-listing-content">
                              <div class="inner">
                                <div  id="boton-opinion" class="">
                                  <a data-recipient="5" data-booking_id="booking_11336" class="booking-message rate-review "><i class="sl sl-icon-envelope-open"></i> Escribir opinión</a>
                                </div>
                                <div  hidden id="boton-formulario" class="">
                                  <form id="subir-comentario" action=""   data-booking_id="">
                                  <div class="row">
                                    <div class="col-lg-8 col-md-8">
                                            @csrf
                                          <textarea  required="" cols="40"  name="opinion" rows="3" placeholder="Tu mensaje..."></textarea>
                                          <input type="hidden" name="id_user" value="{{$user->id}}">
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                      <div class="sub-rating-stars">
                                        <!-- Leave Rating -->
                                        <div class="clearfix"> Valoración</div>
                                        <div class="leave-rating">
                                          <input  type="radio" name="rating" id="rating-25" value="5">
                                          <label for="rating-25" class="fa fa-star"></label>
                                          <input  type="radio" name="rating" id="rating-24" value="4">
                                          <label for="rating-24" class="fa fa-star"></label>
                                          <input  type="radio" name="rating" id="rating-23" value="3">
                                          <label for="rating-23" class="fa fa-star"></label>
                                          <input  type="radio" name="rating" id="rating-22" value="2">
                                          <label for="rating-22" class="fa fa-star"></label>
                                          <input  type="radio" name="rating" id="rating-21" value="1">
                                          <label for="rating-21" class="fa fa-star"></label>
                                        </div>
                                      </div>
                                    </div>
                                    <button class="button" style="margin-top: 5%;margin-left: 3%;">
                                      <i class="" aria-hidden="true"></i>Enviar </button>
                                  </div>
                                </form>

                                </div>


                              </div>
                            </div>
                          </div>

                          <div hidden id="boton-registrado">
                            <div class="avatar"><img alt="" src="https://secure.gravatar.com/avatar/29f70d06e311a9e7068d3ede5fcb1c58?s=70&amp;d=mm&amp;r=g"  class="avatar avatar-70 photo" height="70" width="70" style="padding: 0px 0px 0 0;"></div>
                            <div class="comment-content">
                            <div class="comment-by">
                              <div style="display:flex;">
                                <h5  id="subir-nombre" id="subir-apellido">  </h5> <h5>,</h5> <h5  id="subir-apellido">  </h5>
                              </div>
                              <span id="subir-fecha" class="date">
                              </span>
                              <div id="subir-rating" class="star-rating"  >
                                <div id="estrellas">

                                </div>

                              </div>

                            </div>
                            <p id="subir-micomentario">   </p>

                          </div>
                          <div class="comment-content">
                            <button id="boton-editarOpinion" class="button" style="margin-top: 10px;padding-top: 5px;">
                              Editar </button>
                              <button id="boton-eliminarOpinion" data-id_usuario="" class="button" style="margin-top: 10px;padding-top: 5px;">
                                Eliminar </button>
                          </div>
                          </div>
                        </li>
												<div class="show-more" style="height: 10px;">
                        @foreach ($comment as $comments)
                              <li class="comment byuser comment-author-sante even thread-even depth-1" id="comment-29" style="margin-top: 2%;padding-bottom: 2%;">
                                <div class="avatar"><img alt="" src="{{URL::asset('images/'.$comments->image)}}"  class="avatar avatar-70 photo" height="70" width="70" style="padding: 0px 0px 0 0;"></div>
                                <div class="comment-content">
                                <div class="comment-by">

                                  <h5>{{$comments->name}},{{$comments->last_name}}</h5>
																	<span class="date"> {{$comments->mes}} {{$comments->dia}}, {{$comments->anio}} a las {{$comments->hora}}:{{$comments->minutos}} {{$comments->estado}}</span>
                                  {{-- <span class="date"> {{$comments->date}} --}}
                                  </span>
                                  <div class="star-rating" data-rating="{{$comments->qualification}}">

                                  </div>

                                </div>
                                <p>{{$comments->comment}}</p>

                              </div>

                              <!-- .children -->
                            </li><!-- #comment-## -->
                          @endforeach
													</div> 

                    </ul><!-- .comment-list -->
                  </section>


 
                <a href="#" class="show-more-button" data-more-title="Mostrar más" data-less-title="Mostrar menos"><i class="fa fa-angle-down"></i></a>
                @include('frontend.map.sucursales')
              </div>
            </div>
        </div>
			</div>
		</div>
  </div>
  
@endsection

@section('after-scripts')
<script src="https://api.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js"></script>

<script src={{asset('/js/frontend/calification.js')}}></script>
<script src="{{ asset('js/frontend/comentario.js') }}"></script>
<script src="{{ asset('js/frontend/sucursales.js') }}"></script>
 
 
<script>
	$(document).ready( async function(){
		const selected = [0];
		const data = await axios.post('/search-product', { user_id: $('#user_id').val() , bussines: selected })

    let html  = paginator.productHTML(data.data.products.data)
    $('#content-products').empty().append(html);
    let paginateHTML = paginator.setPaginatorHTML(data.data.pagination)
    $('#paginationNav ul').empty().append(paginateHTML);
	}) 
	$('.check-category').change(async function() {
        const id = $(this).data("id");

        let selected = [];
		$('.checkboxes input:checked').each(function() {
            selected.push($(this).data('id'));
        });

         const bussines = JSON.stringify(selected);
		 const data = await axios.post('/search-product', { user_id: $('#user_id').val() , bussines: selected })
		 let html  = paginator.productHTML(data.data.products.data)
		 $('#content-products').empty().append(html);
		 let paginateHTML = paginator.setPaginatorHTML(data.data.pagination)
		 $('#paginationNav ul').empty().append(paginateHTML);

     })


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
            html.unshift(preview);
            html.push(next);

            return html;
        }, async cambiarPagina(page) {
			let selected = [];
			$('.checkboxes input:checked').each(function() {
				selected.push($(this).data('id'));
			});
		 	const data = await axios.post(`/search-product?page=${page}`, { user_id: $('#user_id').val() , bussines: selected })
			const html2 = this.productHTML(data.data.products.data)
			$('#content-products').empty().append(html2)
		},
		productHTML(data) {
        let html = []
        for (let i = 0; i < data.length; i++) {
                html[i] = `
                            <div class="col-lg-4 col-md-6">
                                <a href="/resultados/${data[i].slug}/${data[i].id}/${data[i].product_slug}/${data[i].product_id}" class="listing-item-container compact">
                                    <div class="listing-item">
                                        <img src="/images/${data[i].image}" alt="">

                                        <div class="listing-item-content">
                                            <span class="tag">${data[i].category}</span>
                                            <h3>${data[i].name} <i class="verified-icon"></i></h3>
                                           <!-- <span>${data[i].company}</span>-->
                                        </div>

                                    </div>
                                </a>
                            </div>
                        `;
            }
            return html;
     },
      categoryHTML(data) {
        let html = []
        for (let i = 0; i < data.length; i++) {
                html[i] = `
                            <input id="check-${data[i].id}" type="checkbox" name="checked[]" class="check-category"  data-id=${data[i].id} data-text="1">
                            <label for="check-${data[i].id}">${data[i].name}</label>
                        `;
            }
            return html;
   },

  } 
</script>
@endsection
