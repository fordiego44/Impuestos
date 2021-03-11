@extends('frontend.layouts.app')
@section('content')
 
@include('frontend.layouts.header1')
@include('frontend.urdapilleta.includes.styles')
  
<div class="pxp-cta-1 pxp-cover  pt-300" style="background-image: url(/images/landings/golfca-port.jpg); background-position: 50% 60%;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-5">
                <div class="pxp-cta-1-caption pxp-animate-in pxp-in">
                    <h2 class="pxp-section-h2"> Golf Club Argentino</h2>
                    <p class="pxp-text-light">Vení a conocer el Golf Club Argentino.</p>
                    <a href="../buscar/propiedades-en-urdapilleta-en-26675-g" class="pxp-primary-cta text-uppercase mt-3 mt-md-5 pxp-animate">Todas las propiedades en <strong>Golf Club Argentino</strong></a>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="container-fluid pxp-props-carousel-right mt-100">
        <h2 class="pxp-section-h2">Propiedades en el Golf Club Argentino</h2>
        <p class="pxp-text-light">Ver propiedades en: <a style="color: #729acd; cursor: pointer;"  id='en-venta' >En Venta</a> | <a style="color: #729acd; cursor: pointer;"  id='en-alquiler'>En Alquiler</a> | <a href="../buscar/propiedades-en-urdapilleta-en-26675-g">Ver Todas</a></p>
        <div class="pxp-props-carousel-right-container mt-4 mt-md-5"  style="display: flex">
            <div class="load-wrapp1" id='loadPropertie' style="display: none" >
                <div class="load-32">
                    <!--<h5>Cargando propiedades ...</h5>-->
                    <div class="line1"></div>
                    <div class="line1"></div>
                    <div class="line1"></div> 
                </div>
            </div>
            <div class="owl-carousel pxp-props-carousel-right-stage" id='container-barrio' >
        
                @foreach ($properties as $key => $property)
    
                    <a href="{{ route('frontend.property.detail' , ['sluglify' => $property->id . '-' .$property->title_href]) }}" class="pxp-prop-card-1 rounded-lg">
                        <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url({{$property->photos[0]->image}});"></div>
                        <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                        <div class="pxp-prop-card-1-details">
                            <div class="pxp-prop-card-1-details-title">{{$property->publication_title}}</div> 
                            <div class="pxp-prop-card-1-details-price">
                                @if ($property->operations[0]->prices[0]->price=="1")
                                CONSULTAR PRECIO | 
                                @else
                                {{$property->operations[0]->prices[0]->currency == "USD"? "u\$d" : "$"}}
                                @endif 
                                {{($property->operations[0]->prices[0]->price != "1") ? $property->operations[0]->prices[0]->price : '' }} 
                            </div> 
                            <div class="pxp-prop-card-1-details-features text-uppercase">
    
                            <span>{{$property->suite_amount}} <i class="fa fa-bed"></i>
                                <span>|</span> {{$property->bathroom_amount}} <i class="fa fa-bath"></i> 
                                <span>|</span><i class="fas fa-ruler-combined"></i> @if (in_array($property->type->id, array(2,3,4,5,6,7,8,11,20)) ) {{$property->roofed_surface}} @else {{$property->surface}} @endif m²</span>
    
                            </div>
                        </div>
                        <div class="pxp-prop-card-1-details-cta text-uppercase">Ver la Propiedad</div>
                    </a>
    
                @endforeach  
                
            
            
            </div> 
            <div class="load-wrapp1" id='loadMorePropertie' style="display: none" >
                <div class="load-31">
                    <!--<h5>Cargando propiedades ...</h5>-->
                    <div class="line1"></div>
                    <div class="line1"></div>
                    <div class="line1"></div> 
                </div>
            </div>  
     
        </div>
        <input type="hidden" value="{{$meta->current_page}}" name="meta_current_page">
        <input type="hidden" value="{{$meta->from}}" name="meta_from">
        <input type="hidden" value="{{$meta->last_page}}" name="meta_last_page">
        <input type="hidden" value="{{$meta->total}}" name="meta_total">
        <input type="hidden" value="{{$meta->per_page}}" name="meta_per_page">
        <input type="hidden" value="urdapilleta" name="type">
    </div>

<div class="pxp-content">



    <div class="pxp-blog-posts pxp-content-wrapper mt-60">
        <div class="container mt-100">
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <h4>Aún no conocés el Golf Club Argentino</h4>
                    <h1 class="pxp-page-header">Conocé las características del country Golf Club Argentino. </h1>
                </div>
            </div>
        </div>


        <div class="pxp-services pxp-cover mt-60 pt-100 mb-200" style="background-image: url(/images/testim-1-fig.jpg);">
                <h2 class="text-center pxp-section-h2">Golf Club Argentino</h2>
                <p class="pxp-text-light text-center">Acá podés encontrar el Masterplan, Videos, distribución de barrios y conocer todas las propiedades disponibles.</p>
    
                <div class="container">
                    <div class="pxp-services-container rounded-lg mt-4 mt-md-5">
                        <a href="{{asset('/masterplan/MASTERPLAN-GOLF-CLUB-ARGENTINO.pdf')}}" target="_blank" class="pxp-services-item">
                            <div class="pxp-services-item-fig">
                                <img src={{asset('images/service-icon-2.svg')}}>
                            </div>
                            <div class="pxp-services-item-text text-center">
                                <div class="pxp-services-item-text-title">Masterplan</div>
                                <div class="pxp-services-item-text-sub">Descargate el masterplan <br>completo en pdf.</div>
                            </div>
                            <div class="pxp-services-item-cta text-uppercase text-center">Descargar PDF</div>
                        </a>
                        
                        <a href="https://goo.gl/maps/tSUaGteM6MtkkN9V6" target="_blank" class="pxp-services-item">
                            <div class="pxp-services-item-fig">
                                <img src={{asset('images/plan-business.svg')}}>
                            </div>
                            <div class="pxp-services-item-text text-center">
                                <div class="pxp-services-item-text-title">Como llegar</div>
                                <div class="pxp-services-item-text-sub">Desde Google Maps conocé <br/>como llegar a Studios.</div>
                            </div>
                            <div class="pxp-services-item-cta text-uppercase text-center">Ver Ubicación</div>
                        </a>
                        <a href="https://wa.me/5491151856532" target="_blank" class="pxp-services-item">
                            <div class="pxp-services-item-fig">
                                <img src={{asset('images/service-icon-4.svg')}}>
                            </div>
                            <div class="pxp-services-item-text text-center">
                                <div class="pxp-services-item-text-title">Te gustaría Visitar el Golf Club Argentino?</div>
                                <div class="pxp-services-item-text-sub">Hablemos Vía <Strong>Whatsapp</strong> <br>Te Esperamos.</div>
                            </div>
                            <div class="pxp-services-item-cta text-uppercase text-center">Chat Whatsapp</div>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        

        

        

        <div class="container mt-100">
            <div class="row">
                <div class="col-sm-12 col-lg-1">
                    <div class="pxp-blog-post-share">
                        <div class="pxp-blog-post-share-label">Compartí</div>
                        <ul class="list-unstyled mt-3">
                            <li><a href="#"><span class="fa fa-whatsapp"></span></a></li>
                            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                            
                            <li><a href="#"><span class="fa fa-pinterest"></span></a></li>
                            
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-10">
                    <div class="pxp-blog-post-block mt-4 mt-md-5 mt-lg-0">
                        <h2>Golf Club Argentino</h2>
                        <div class="mt-3 mt-md-4">
                            <p class="pxp-first-letter">El Golf Club Argentino es uno de los countries más antiguos y tradicionales de la zona. Está formado por 186 hectáreas divididas, en 428 lotes con grandes arboladas y amplios espacios verdes. </p>
                        </div>
                    </div>

                   

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Formado por 186 hectáreas divididas en 428 lotes</h2>
                        <div class="mt-3 mt-md-4">
                            <p>Cuenta con una cancha de golf de 18 hoyos, otra cancha de práctica de 9 hoyos, canchas de tenis, fútbol, espacio para haces equitación, pileta, restaurant, y actividades recreativas para niños y adultos. </p>
                           
                        </div>
                    </div>

                    <div class="pxp-blog-post-block pxp-full mt-4 mt-md-5">
                            <div class="row">
                                 <div class="col-sm-12 col-md-6">
                                    <img src={{asset('/images/landings/golfca-1.jpg')}} alt="" class="pxp-image-full mb-3">
                                </div>
                                
                                <div class="col-sm-12 col-md-6">
                                    <img src={{asset('/images/landings/golfca-2.jpg')}} alt="" class="pxp-image-full mb-3">
                                </div>
    
                               <!--  <div class="col-sm-12 col-md-12">
                                    <img src={{asset('/images/landings/masterplan-studios.jpg')}} alt="" class="pxp-image-full mb-3">
                                </div> -->
                                
                            </div>
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Servicios del Golf Club Argentino </h2>
                        <div class="mt-3 mt-md-4">
                            <div class="row mt-3 mt-md-4">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Corriente Eléctrica</div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Gas Natural</div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Teléfono</div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Internet</div>
                                </div>
                                <div class="col-sm-6 col-lg-8">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Seguridad las 24 horas y control de acceso</div>
                                </div>
                                
                            </div>
                           
                        </div>
                        
                        
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Infraestructura dentro del country </h2>
                        <div class="mt-3 mt-md-4">
                            <div class="row mt-3 mt-md-4">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Formado por 186 hectáreas divididas en 428 lotes</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> La cancha de golf es de 18 hoyos, par 72 (37 de ida y 35 de vuelta)</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Lancha de práctica de 9 hoyos, casilla de palos, caddies, driving, putting green, pro shop, bar y restaurant.</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> 8 Canchas de Tenis</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> 4 Canchas de Paddle</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Pilera</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> 4 Canchas de Futbol 11</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Cancha de Futbol 5 ilmuninada</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> 4 Canchas de Futbol 11</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Espacio para hacer equitación</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Restaurant de menores donde se desarrollan diferentes actividades</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Plaza de niños y colonia de vacaciones y fines de semana para todas las edades</div>
                                </div>

                                
                            </div>

                            <h2>Ubicación del Golf Club Argentino</h2>
                            <div class="mt-3 mt-md-4">
                                <p >El tradicional country de Zona Norte está ubicado en el Km 41,500 de la Ruta Provincial 8.</p>
                            </div>
                           
                        </div>
                        
                        
                    </div>

                    
                    
                </div>
            </div>
        </div>

        

        <div class="pxp-blog-post-hero mt-4 mt-md-5">
            <div class="pxp-blog-post-hero-fig pxp-cover" style="background-image: url(/images/landings/golfca-port.jpg); background-position: 50% 60%;"></div>
        </div>

    </div>
</div>
@endsection

@section('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
<script>
    $('#en-venta').on('click', async function() { 
        let page = 1; 
        let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-venta-en-26675-g?page=${page}`)
        htmlPropertiesNew(data.objects);

        $("input[name=meta_current_page]").val(data.meta.current_page)
        $("input[name=meta_from]").val(data.meta.from)
        $("input[name=meta_last_page]").val(data.meta.last_page)
        $("input[name=meta_per_page]").val(data.meta.per_page)
       
        $("#loadPropertie").css("display", "flex"); 
        $("#container-barrio").css("display", "none"); 

        setTimeout(function(){
            $("#loadPropertie").css("display", "none"); 
            $("#container-barrio").css("display", "block"); 

            htmlPropertiesNew(data.objects);
            htmlProperties(data.objects);
            $("input[name=type]").val('venta')
        }, 1000); 

    })
    
    $('#en-alquiler').on('click',async function() {
         
        let page = 1; 
         let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-alquiler-en-26675-g?page=${page}`)
         htmlPropertiesNew(data.objects);

        $("input[name=meta_current_page]").val(data.meta.current_page)
        $("input[name=meta_from]").val(data.meta.from)
        $("input[name=meta_last_page]").val(data.meta.last_page)
        $("input[name=meta_per_page]").val(data.meta.per_page)
        $("#loadPropertie").css("display", "flex"); 
            $("#container-barrio").css("display", "none"); 

            setTimeout(function(){
                $("#loadPropertie").css("display", "none"); 
                $("#container-barrio").css("display", "block"); 

                htmlPropertiesNew(data.objects);
                htmlProperties(data.objects);
                $("input[name=type]").val('alquiler')
            }, 1000);

    })
</script>
<script>

    $('#container-barrio').on('click', '.owl-nav .owl-next',async function() {

         if(this.className.split(' ')[1]){ 
            let page = parseInt($("input[name=meta_current_page]").val()); 
            let type = $("input[name=type]").val(); 

            let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-${type}-en-26675-g?page=${page+1}`)
          
            $("#loadMorePropertie").css("display", "flex");  
                setTimeout(function(){
                    $("#loadMorePropertie").css("display", "none");  
                    $("input[name=meta_current_page]").val(data.meta.current_page)
                    $("input[name=meta_from]").val(data.meta.from)
                    $("input[name=meta_last_page]").val(data.meta.last_page)
                    $("input[name=meta_per_page]").val(data.meta.per_page)
                    htmlProperties(data.objects);
                }, 1000);
        }
    })
    function htmlProperties(data) {
        let html  = []
      

        for (let i = 0; i < data.length; i++) {
                let price = data[i].operations[0].prices[0].price == 1 ? 'CONSULTAR PRECIO' + data[i].operations[0].prices[0].price   : data[i].operations[0].prices[0].currency == "USD"? "u\$d" : "$"  

                let price_ =  data[i].operations[0].prices[0].price != "1"  ? data[i].operations[0].prices[0].price : '';
                html[i] = `  
                        <a href="/${data[i].id}-${data[i].title_href}" class="pxp-prop-card-1 rounded-lg">
                            <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(${data[i].photos[0].image});"></div>
                            <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                            <div class="pxp-prop-card-1-details">
                                <div class="pxp-prop-card-1-details-title">${data[i].publication_title}</div>
                                <div class="pxp-prop-card-1-details-price">
                                    ${price} ${price_}
                                 </div> 
                                <div class="pxp-prop-card-1-details-features text-uppercase">
                                 
                                    <span>${data[i].suite_amount} <i class="fa fa-bed"></i>
                                        <span>|</span>  ${data[i].bathroom_amount}  <i class="fa fa-bath"></i> 
                                        <span>|</span><i class="fas fa-ruler-combined"></i> ${data[i].surface} m²</span> 
                                </div>
                            </div>
                            <div class="pxp-prop-card-1-details-cta text-uppercase">Ver la Propiedad</div>
                        </a>           
                        `;      
            $('.owl-carousel')
                .trigger('add.owl.carousel', [html[i]])
                .trigger('refresh.owl.carousel');             
        }
        return html;
    }
 
    function htmlPropertiesNew(data) {
            let html  = [] 
            for (let i = 0; i < 100; i++) { 
                $(".owl-carousel")
                .trigger('remove.owl.carousel', [i])
                .trigger('refresh.owl.carousel');     
             }
            return html;
        }
 
</script>
@endsection