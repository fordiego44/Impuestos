@extends('frontend.app' , ['bussines'=> $bussines, 'users', $users])


@section('content')
<style>
	.btn-add {
		background: #aaa !important;
		color: #fff !important;
	}
	#header-container.fixed {
		position: relative;
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
    table.basic-table th, table.basic-table td {
        padding: 7px 28px;
    }
	table.basic-table th:first-child {
		border-radius: 0 0 0 0;
	}
	table.basic-table th:last-child {
		border-radius: 0 0 0 0;
	}
	table.basic-table tbody tr {
		border: 1px solid #000;
	/*	background: #f6f6f6;*/
	}
	table.basic-table th {
 /*	background-color: #66676b !important ;*/
	}
	.dashboard-list-box{
		border-bottom: 1px solid #e0e0e0e0;
    }
    .transition {
        -webkit-transform: scale(1.8);
        -moz-transform: scale(1.8);
        -o-transform: scale(1.8);
        transform: scale(1.8);
    }
    #titlebar {
        background: linear-gradient(to bottom, #ffffff 0%, rgb(255 255 255)) !important;
    }
    .blog-post-one {
        /*box-shadow: 0 0 10px 0 rgba(0, 0, 0, .1);
        background-color: #f1f0f0;*/
        display: inline-block;
        width: 100%;
        border-radius: 3px;
        margin: 15px 0
    }
    .priceMain {
        color: #4CAF50;
        font-size: 42px;
        font-weight: 700;
        line-height: 20px;
        margin-top: 15px;
    }
    .panel-wrap {
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        width: 20em;
        z-index: 99999;
        transform: translateX(100%);
        transition: .3s ease-out;
        box-shadow:  0  0 12px rgba(0, 0, 0, .12);

    }
    .panel {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fff;
        overflow: auto;
    }
    .text-price {
        font-weight: 700;
        font-size: 17px;
        line-height: 24px;
        color: #333;
    }
	@media only screen and (max-width: 1024px) {
		 
         .addCart {
            width: 100% !important;
         } 
         .add-count {
            width: 100% !important;
         }
         .shop-cart {
            width: 100% !important;
         }
         a.button { 
            text-align: center !important;
        }
        .post-content .col-sm-12 {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
     }
     .btn-change{
         margin-top: 4px;
     }
     @media screen and (max-width: 1024px) {
        table.basic-table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: 14px;
            text-align: center;
        }
     }

</style>


<div id="titlebar" class="gradient" style="margin-bottom:10px;padding-top:20px;">
	<div class="container" >
		<div class="row">
			<div class="col-md-12">

				<h3>{{ucfirst($data->name)}} - {{$category->name}}</h3><span>{{$user->business}}</span>

				<nav id="breadcrumbs" >
					<ul>
                        <li><a href="/">Inicio</a></li>
                        <li><a href="/mapa">Busqueda</a></li>
                        <li><a href="/resultados/{{$user->slug}}/{{$user->id}}">{{$user->company}}</a></li>
                        <li><a href="#">{{$data->name}}</a></li>

					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>
<!--
@php
    echo $attributs;
@endphp-->
<div class="container" >

	<!-- Blog Posts -->
	<div class="blog-page">
        <div class="row">
            <div class="col-lg-6 col-md-6 padding-right-30">

                @if($data->status_gallery == "1")
                    <div class="blog-post-one single-post slider-for">

                        <div class="col-md-12" style="margin-bottom: 26px;">
                            <img class="post-img" id="imagen" src="/images/{{$data->image}}" data-zoom-image="/images/{{$data->image}}" alt="" style="width: 80% !important;height:auto !important;margin-left:50px" data-big="/images/{{$data->image}}">

                        </div>
                        @foreach($images as $item)
                            <div class="col-md-12" style="margin-bottom: 26px;">

                                <img class="post-img" id="imagen" src="/images/{{$item->name}}" data-zoom-image="/images/{{$item->name}}" alt="" style="width: 80% !important;height:auto !important;margin-left:50px" data-big="/images/{{$item->name}}">

                            </div>
                        @endforeach
                        <!-- Img -->




                    </div>
                    <div class="slider-nav" id="gallery">
                            <div class="col-md-12" style="margin-bottom: 26px;">
                                <img  src="/images/{{$data->image}}" data-zoom-image="/images/{{$data->image}}" alt="" style="width: 80% !important;height:auto !important;margin-left:50px" data-big="/images/{{$data->image}}">

                            </div>
                        @foreach($images as $item)
                            <div class="col-md-12" style="margin-bottom: 26px;">
                                <img  src="/images/{{$item->name}}" data-zoom-image="/images/{{$item->name}}" alt="" style="width: 80% !important;height:auto !important;margin-left:50px" data-big="/images/{{$item->name}}">

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="blog-post-one single-post">

                        <!-- Img -->
                        <div class="col-md-12" style="margin-bottom: 26px;">
                            <img class="post-img" id="imagen" src="/images/{{$data->image}}" data-zoom-image="/images/{{$data->image}}" alt="" style="width: 80% !important;height:auto !important;margin-left:50px" data-big="/images/{{$data->image}}">

                        </div>
                    </div>
                @endif
                <!-- Blog Post -->

        </div>
        <div class="col-lg-6 col-md-6">
            <div class="sidebar right">
                <div class="blog-post-one single-post">
                    <div class="post-content">
                        <h1 class="margin-top-10" style='font-size:2rem; '>
                            <strong>
                                {{$data->name}}
                            </strong>
                        </h1>
                        <div class="priceMain">
                            <span class="precio" style="font-size: 40px;">S/. {{number_format($data->price, 2, '.', ' ')}}</span>
                        </div>
                        <div class="attributs">
                            <div >
                                @foreach($attributs as $item)
                                        <span > <div class="col-lg-3" style="padding-left: 0px"> <b style="font-weight:700">{{ucfirst($item->name)}}:</b>   </div> <div class="col-lg-9">{{ucfirst($item->value)}}</div>  </span>
                                @endforeach
                            </div>
                            <div>
                                <div   class="col-lg-3"  style="margin:10px 0;padding-left: 0px"><b style="font-weight:700">Cantidad: </b></div>
                                <div   class="col-lg-9"  style="margin:10px 0;  ">
                                    <select name="count" id="count" class='add-count' style=' padding: 0px 0px 0px 20px !important; height: 40px !important;  ' >
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            @foreach($attributs_1 as $atributos)
                                    <p style="margin:10px 0"><b style="font-weight:700">{{ucfirst($atributos->name)}}: </b></p>

                                    @foreach($variations as $variaciones)
                                        @if($atributos->id == $variaciones->id_attribute)
                                        <button class="change btn-change" data-id="{{$variaciones->variation_id}}">{{ucfirst($variaciones->variation_name)}}</button>
                                        @endif
                                    @endforeach
                            @endforeach
                        </div>

                        <div class="btn-actions" style="padding-left:0px">
                        <div class=' col-md-6 col-sm-12' style=' padding-left: 0px; padding-right: 0px;'>

                        <a class="button   margin-top-10 addCart button border with-icon" style="border-radius: 5px;  ">
                                <i class="im im-icon-Add-Cart" style="font-size: 20px"></i>
                                Añadir al carrito
                            </a>
                        </div>
                        <div class=' col-md-6 col-sm-12'>

                        <a href="/checkout" class="button shop-cart  margin-top-10" style="border-radius: 5px;">
                                Comprar
                                <i class="im im-icon-Add-Cart" style="font-size: 20px"></i>

                            </a>
                        </div>

                        </div>
                        <!--<h3>¡Añade a tu carrito!</h3>
                        <select name="count" id="count" style='padding: 0px 0px 0px 20px !important; height: 40px !important;   width:50% !important'>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>-->
                        <input type="hidden" id='company_id' value={{$data->id}} hidden>
                        <input type="hidden" id="variation" value="" >
                        <input type="hidden" id='product_id' value='' hidden>
                      <!--  <ul class="post-meta">
                            <li><h4 class="precio"><strong> Precio:</strong> S/. {{$data->price}}</h4></li>
                        </ul>
                        <a class="button fullwidth margin-top-10 addCart" style="border-radius: 5px;"> Añadir al carrito</a>
                        <a href="/checkout" class="button fullwidth margin-top-10" style="border-radius: 5px;"> Ver Carrito</a>
                    -->
                    </div>
                </div>

                <!-- Widget -->
                <!--<div class="widget margin-top-40">
                    <h3>Mirar carrito</h3>
                    <div class="info-box margin-bottom-10">


                    </div>
                </div>-->
                <!--cambios-->
                {{--<div class="widget margin-top-40">
                    <h3 id="titulo">¡Califica{{$user->company}}!</h3>
                    <div class="info-box margin-bottom-10" id="limpiar">
                        <div class="sub-ratings-container" style="margin-top: 0pxgin-bottom: 0px;padding-top: 0px;">

                            <div class="add-sub-rating" style="width:100%;">

                                <div class="sub-rating-stars">
                                    <!-- Leave Rating -->
                                    <div class="clearfix"></div>
                                    <div class="leave-rating">
                                        <input type="radio" class="qualification" name="rating" id="rating-1" value="5" />
                                        <label for="rating-1" class="fa fa-star" style="font-size:50px;"></label>
                                        <input type="radio" class="qualification" name="rating" id="rating-2" value="4" />
                                        <label for="rating-2" class="fa fa-star" style="font-size:50px;"></label>
                                        <input type="radio" class="qualification" name="rating" id="rating-3" value="3" />
                                        <label for="rating-3" class="fa fa-star" style="font-size:50px;"></label>
                                        <input type="radio" class="qualification" name="rating" id="rating-4" value="2" />
                                        <label for="rating-4" class="fa fa-star" style="font-size:50px;"></label>
                                        <input type="radio" class="qualification" name="rating" id="rating-5" value="1" />
                                        <label for="rating-5" class="fa fa-star" style="font-size:50px;"></label>
                                        <input type="hidden" id="qualification" value="0">
                                        <input type="hidden" id="id_company" value="{{$user->id}}">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button id="qualify" class="button fullwidth margin-top-20"> Enviar</button>
                    </div>
                </div>--}}



            </div>
        </div>
        <div class="col-lg-12">

            <div class="col-lg-8 col-md-7">
                <div class="col-md-12">
                    <p><strong>Descripción:</strong></p>
                    <p>{{$data->description}}</p>
                </div>
                <div class="col-md-12">

                    <div class="style-1">

                        <ul class="tabs-nav">
                            <li class="active"><a href="#tab1b">Detalles del producto</a></li>
                            <li class=""><a href="#tab2b">Detalles de Empresa</a></li>

                        </ul>


                        <div class="tabs-container">
                            <div class="tab-content" id="tab1b" style="">

                                <div class="col-md-6" style="margin-bottom: 26px;">
                                        <h4 class="headline margin-top-10 margin-bottom-30">Detalles</h4>
                                        <h5><strong>Detalles del producto:</strong> </h5>
                                        <table class="basic-table">

                                            <tbody>
                                                @foreach($attributs as $value)
                                                <tr >
                                                    <td style="text-align: left;"><strong>{{ucfirst($value->name)}}: </strong> </td>
                                                    <td style="text-align: left;">{{ucfirst($value->value)}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 26px;">
                                        <h4 class="headline margin-top-10 margin-bottom-30">Variaciones</h4>
                                        <h5><strong>Variaciones del producto:</strong> </h5>
                                        <table class="basic-table">

                                            <tbody>


                                                    @foreach($variations as $variaciones)
                                                    <tr >
                                                        <td style="text-align: left;"><strong>{{ucfirst($variaciones->product_name)}} - {{ucfirst($variaciones->variation_name)}}:</strong> </td>
                                                        <td style="text-align: left;">S/. {{number_format($variaciones->variation_price, 2, '.', ' ')}}</td>
                                                    </tr>
                                                    @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <div class="tab-content" id="tab2b" style="display: none;">


                                <div class="col-md-12" style="">
                                    <h4 class="headline margin-top-10 margin-bottom-30">{{$user->company}}</h4>
                                    <h5><strong>Informacion de la Empresa:</strong> </h5>
                                    <p>{{$user->description}}</p>
                                    <h5><strong>Aspectos destacados de la Empresa:</strong> </h5>
                                    <table class="basic-table">

                                        <tbody>
                                            <tr >
                                                <!--<td > <strong>Logo: </strong>  </td>-->
                                                <td colspan="2" class="center" style='width: 100%; display: flex; justify-content: center;'>
                                                    <img class="post-img" src="/images/{{$user->image}}" alt="" style=" width:50%;height:auto !important;    margin-bottom:45px;"></td>
                                            </tr>
                                            <tr>
                                                <td ><strong>Tipo: </strong> </td>
                                                <td >{{$user->business}}</td>
                                            </tr>
                                            <tr>
                                                <td > <strong>Número: </strong> </td>
                                                <td >{{$user->phone}}</td>
                                            </tr>

                                            <tr>
                                                <td ><strong>Departamento: </strong> </td>
                                                <td >{{$user->departamento}}</td>
                                            </tr>
                                            <tr>
                                                <td ><strong>Provincia: </strong> </td>
                                                <td >{{$user->provincia}}</td>
                                            </tr>
                                            <tr>
                                                <td ><strong>Distrito: </strong> </td>
                                                <td >{{$user->distrito}}</td>
                                            </tr>
                                            <tr>
                                                <td ><strong>Dirección: </strong> </td>
                                                <td >{{$user->address}}</td>
                                            </tr>

                                            <tr>
                                                <td > <strong>Email: </strong> </td>
                                                <td >{{$user->email_susti}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <p style="margin-bottom: 20px;margin-left: 21px;">  Visita este negocio y conoce mas de sus productos. <strong> <a href="/resultados/{{$user->slug}}/{{$user->id}}">Haz click aqui</a> </strong></p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="blog-post-one post-content">
                    <h3>Otros Productos</h3>
                    <ul class="widget-tabs">
                        @foreach($others as $value)
                            <li>
                                <div class="widget-content" style="display: inline-flex">
                                    <div class="widget-thumb">
                                        <a href="/resultados/{{$user->slug}}/{{$user->id}}/{{$value->slug}}/{{$value->id}}"><img src="/images/{{$value->image}}" style="width: 85px;height: auto;" alt=""></a>
                                    </div>

                                    <div class="widget-text">
                                        <h5><a href="/resultados/{{$user->slug}}/{{$user->id}}/{{$value->slug}}/{{$value->id}}">{{strtoupper($value->name)}}</a></h5>

                                        <span>Precio: S/. {{number_format($value->price, 2, '.', ' ')}}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

	</div>
    </div>
</div>
<div class="panel-wrap">
    <div class="panel">

        <div   style="border-bottom: 1px solid #ccc; padding:1em">
            <h4>MI CARRITO</h4>
        </div>
          <div class="list-preview-shop" style="border-bottom: 1px solid #ccc; padding:1em">

                <ul class="widget-tabs" id="previewCar">

                </ul>

          </div>
          <div class="preci-detail" style="margin-top:20px">
               <div>
                    <div class="col-lg-6">
                        <span>Unidades </span>

                    </div>
                    <div class="col-lg-6">
                        <span id="previewCarCount">11</span>
                    </div>
                    <div class="col-lg-6 text-price">
                        <span>TOTAL</span>
                    </div>
                    <div class="col-lg-6 text-price">
                        <span id="previewCarTotalMount"> S/.1000.00 </span>
                    </div>
                </div>

                <div class="col-lg-12" style="margin-top: 20px">
                    <a class="button fullwidth" href='/checkout' style="border-radius: 5px">Realizar Pedido</a>
                </div>

          </div>

     </div>
  </div>



@endsection

@section('after-scripts')
    <!--cambios-->
    <style>
		.slick-prev {
			left: 108px;
			transform: translate3d(-90px, -50%, 0);
		}
		.slick-next {
			right: 108px;
			transform: translate3d(90px, -50%, 0);
		}
		.slick-prev:before, .slick-next:before {
			font-family: simple-line-icons;
			font-size: 32px;
			line-height: 1;
			opacity: 1;
			color: #999 !important;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			transition: all .3s;
		}
	</style>
    <script type="text/javascript">


        $('.slider-for').slick({
            slidesToShow: 1,
            infinite:true,
            slidesToScroll: 1,
            autoplay:true,
			autoplaySpeed: 4000,
            arrows: false,
            fade: true,
            dots:false,
			arrows:true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            infinite:true,
            slidesToShow: 5,
            slidesToScroll: 5,
            asNavFor: '.slider-for',
            dots: true,
            //centerMode: true,
            arrows:false,
            focusOnSelect: true
        });/*
        $('.slider-nav').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            dots:true,
            arrows:false
        });*/


	</script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script src={{asset('/js/frontend/calification.js')}}></script>
       <!--cambios-->
    <!--<script type="text/javascript" src="{{asset('/js/jquery.elevatezoom.min.js')}}"></script>-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/2.2.3/jquery.elevatezoom.min.js"></script>
    @if($data->status_gallery == "0")
        <script src={{asset('/js/frontend/details_product.js')}}></script>
    @endif


    <script>
        $("#imagen").elevateZoom();
        //$('.slider-for .slick-current img').elevateZoom();

        $('.slider-for').on('beforeChange', function(event, slick, currentSlide, nextSlide){
            var img = $(slick.$slides[nextSlide]).find("img");
            $('.zoomWindowContainer,.zoomContainer').remove();
            $(img).elevateZoom();
        });

    </script>
    <script>
        $(document).ready(function() {
            let data = JSON.parse(localStorage.getItem('checkout'));
            let info = carts(data)
            let suma = 0;
            let total = 0;
            data.forEach(element => {
                suma +=  parseInt(element.cant)
                total += element.cant*element.price
            });
            $('#previewCarCount').text(suma)
            $('#previewCarTotalMount').text(total)
            $('#previewCar').empty().append(info);

        })

    </script>
	<script>

        $('.addCart').on('click', async function () {

            let data = await axios.get(`/company?id=${$('#company_id').val()}&variation=${$('#variation').val()}`);
            let info = data.data;
            let mensaje;
            info.product.id_variation == "" ? mensaje = info.product.name : mensaje = `${info.product.name} - ${info.product.attribute_name} - ${info.product.variation_name}`;
            /*notyf.success({
                message: `Exito! (${$('#count').val()}) ${mensaje} agregado`,
                duration: 9000,
                icon: true
            })*/
            let params = {
                company: info.company.company,
                id: info.company.id,
                product_id: info.product.id,
                subtotal: parseFloat(info.product.price)* parseInt($('#count').val()),
                cant: $('#count').val(),
                price: info.product.price,
                nombre: info.product.name,
                id_MP:info.company.id_MP,
                id_variation : info.product.id_variation,
                id_attribute : info.product.id_attribute,
                attribute_name:info.product.attribute_name,
                variation_name:info.product.variation_name,
                time_delay:info.product.time_delay,
                image : info.product.image
            }
            let cart = JSON.parse(localStorage.getItem("checkout") || "[]");
            console.log(cart);
            let cart_new = [];
            let j = 0;
            let band = 0;
            for(i = 0; i < cart.length; i++){

                if(cart[i].product_id == info.product.id){

                    if(cart[i].id_attribute == info.product.id_attribute){

                        if(cart[i].id_variation == info.product.id_variation){

                            cart_new[j] = cart[i];
                            cart_new[j].company =  info.company.company;
                            cart_new[j].id =  info.company.id;
                            //cart[i].product_id: info.product.id;
                            cart_new[j].subtotal =  parseFloat(info.product.price)* (parseInt($('#count').val()) + parseInt(cart[i].cant));
                            cart_new[j].cant =  parseInt(cart[i].cant) + parseInt($('#count').val());
                            cart_new[j].price =  info.product.price;
                            cart_new[j].nombre =  info.product.name;
                            cart_new[j].id_MP = info.company.id_MP;
                            //cart[i].id_variation : info.product.id_variation;
                            //cart[i].id_attribute : info.product.id_attribute;
                            cart_new[j].attribute_name = info.product.attribute_name;
                            cart_new[j].variation_name = info.product.variation_name;
                            cart_new[j].time_delay = info.product.time_delay;
                            cart_new[j].image  =  info.product.image;
                            cart_new[j] = cart[i];
                            //cart_new[j].
                            band = 1;

                        }
                        else{
                            cart_new[j] = cart[i];
                            j++;
                        }
                    }
                    else{
                        cart_new[j] = cart[i];
                        j++;
                    }

                }
                else{

                    cart_new[j] = cart[i];
                    j++;

                }

            }

            if(band == 0){
                console.log(cart_new);
                cart_new[j] = params;
                console.log(cart_new[j]);
                console.log(cart_new);
            }

            localStorage.setItem("checkout", JSON.stringify(cart_new));
            //cart_new.push(params);
            //console.log(cart_new);

            /*localStorage.setItem("checkout", JSON.stringify(cart_new));
            let cart_new_2 = JSON.parse(localStorage.getItem("checkout") || "[]");
            cart_new_2.push(params);
            localStorage.setItem("checkout", JSON.stringify(cart_new_2)); */




            /*let product = cart.filter(i => i.product_id == info.product.id && i.id_variation == info.product.id_variation && i.id_attribute == info.product.id_attribute);

            if (product.length !== 0) {
                if(product[0]["id_attribute"] == ""){
                    console.log(product[0]["id_attribute"]);
                    let cart_new = cart.filter(i => i.id_attribute != "");

                }
                else{
                    console.log("vacion");
                }
                //let cart_new = cart.filter(i => i.product_id != info.product.id && i.id_variation != info.product.id_variation && i.id_attribute != info.product.id_attribute);
                //cart_new.push(params);
                //console.log(cart_new);
                //console.log(product[0]["id_variation"]);
                //localStorage.setItem("checkout", JSON.stringify(cart_new));

            } else {
                //cart.push(params);
                //localStorage.setItem("checkout", JSON.stringify(cart));
                cart.push(params);
                localStorage.setItem("checkout", JSON.stringify(cart));
                console.log(product);
            }*/


            $(".panel-wrap").css("transform", `translateX(0%)`);
            let data_ = JSON.parse(localStorage.getItem('checkout'));
            let info_ = carts(data_)
            let suma = 0;
            let total = 0;
            data_.forEach(element => {
                suma +=  parseInt(element.cant)
                total += element.cant*element.price
            });
            $('.qtyTotal').text(suma);
            $('#previewCarCount').text(suma);
            $('#previewCarTotalMount').text(total.toFixed(2))
            $('#previewCar').empty().append(info_);
            setTimeout(() => {
                $(".panel-wrap").css("transform", `translateX(100%)`);
            }, 3000);
        })


    </script>
    <script>
         function carts(data) {
            let html = []

            for (let i = 0; i < data.length; i++) {


                html[i] =  `
                        <li>
                            <div class="widget-content" style="display: inline-flex">
                                <div class="widget-thumb">
                                    <a href="/resultados/quicksilver/2/Playera-Quicksilver-Otoño/6"><img src="/images/${data[i].image}" style="width: 85px;height: auto;" alt=""></a>
                                </div>
                                <div class="widget-text">
                                    <h5><a href="/resultados/quicksilver/2/Playera-Quicksilver-Otoño/6">${data[i].nombre}</a></h5>

                                    <span>Precio: S/. ${parseFloat(data[i].price).toFixed(2)}</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        `
            }
            return html;
        }
    </script>

@endsection
