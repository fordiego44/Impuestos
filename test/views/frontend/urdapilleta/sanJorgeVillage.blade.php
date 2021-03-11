@extends('frontend.layouts.app')
@section('content')
 
@include('frontend.layouts.header1')
@include('frontend.urdapilleta.includes.styles')

<div class="pxp-cta-1 pxp-cover  pt-300" style="background-image: url(/images/landings/sanjorge-port.jpg); background-position: 50% 60%;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-5">
                <div class="pxp-cta-1-caption pxp-animate-in pxp-in">
                    <h2 class="pxp-section-h2">San Jorge Village Country Club</h2>
                    <p class="pxp-text-light">El Lugar para Vivir.</p>
                    <a href="../buscar/propiedades-en-urdapilleta-en-26688-s" class="pxp-primary-cta text-uppercase mt-3 mt-md-5 pxp-animate">Todas las propiedades en <strong>San Jorge Village</strong></a>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="container-fluid pxp-props-carousel-right mt-100">
        <h2 class="pxp-section-h2">Propiedades en San Jorge Village</h2>
        <p class="pxp-text-light">Ver propiedades en: <a style="color: #729acd; cursor: pointer;"  id='en-venta' >En Venta</a> | <a style="color: #729acd; cursor: pointer;"  id='en-alquiler'>En Alquiler</a> | <a href="../buscar/propiedades-en-urdapilleta-en-26688-s">Ver Todas</a></p>
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
                    <h4>Aún no conocés San Jorge Village?</h4>
                    <h1 class="pxp-page-header">Conocé las características del country San Jorge Village </h1>
                </div>
            </div>
        </div>


        <div class="pxp-services pxp-cover mt-60 pt-100 mb-200" style="background-image: url(/images/testim-1-fig.jpg);">
            <h2 class="text-center pxp-section-h2">El Desarrollo</h2>
            <p class="pxp-text-light text-center">Acá podés encontrar el Masterplan, Videos, distribución de barrios y conocer todas las propiedades disponibles.</p>

            <div class="container">
                <div class="pxp-services-container rounded-lg mt-4 mt-md-5">
                    <a href="{{asset('/masterplan/MASTERPLAN-SAN-JORGE-VILLAGE.pdf')}}" target="_blank" class="pxp-services-item">
                        <div class="pxp-services-item-fig">
                            <img src={{asset('images/service-icon-2.svg')}}>
                        </div>
                        <div class="pxp-services-item-text text-center">
                            <div class="pxp-services-item-text-title">Masterplan</div>
                            <div class="pxp-services-item-text-sub">Descargate el masterplan <br>completo en pdf.</div>
                        </div>
                        <div class="pxp-services-item-cta text-uppercase text-center">Descargar PDF</div>
                    </a>
                    <!-- <a href="{{asset('/masterplan/pilara.pdf')}}" target="_blank" class="pxp-services-item">
                        <div class="pxp-services-item-fig">
                            <img src={{asset('images/service-icon-1.svg')}}>
                        </div>
                        <div class="pxp-services-item-text text-center">
                            <div class="pxp-services-item-text-title">Barrios</div>
                            <div class="pxp-services-item-text-sub">Conocé los barrios que<br> integran a San Jorge Village</div>
                        </div>
                        <div class="pxp-services-item-cta text-uppercase text-center">Descargar Mapa</div>
                    </a> -->
                    <a href="https://g.page/PilaraCountry?share" target="_blank" class="pxp-services-item">
                        <div class="pxp-services-item-fig">
                            <img src={{asset('images/plan-business.svg')}}>
                        </div>
                        <div class="pxp-services-item-text text-center">
                            <div class="pxp-services-item-text-title">Como llegar</div>
                            <div class="pxp-services-item-text-sub">Desde Google Maps conocé <br/>como llegar a San Jorge Village.</div>
                        </div>
                        <div class="pxp-services-item-cta text-uppercase text-center">Ver Ubicación</div>
                    </a>
                    <a href="https://wa.me/5491151856532" target="_blank" class="pxp-services-item">
                        <div class="pxp-services-item-fig">
                            <img src={{asset('images/service-icon-4.svg')}}>
                        </div>
                        <div class="pxp-services-item-text text-center">
                            <div class="pxp-services-item-text-title">Te gustaría Visitar San Jorge Village?</div>
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
                        <h2>San Jorge Village Barrio Cerrado</h2>
                        <div class="mt-3 mt-md-4">
                            <p class="pxp-first-letter">San Jorge Village está desarrollado sobre 110 hectáreas que pertenecieron a un Haras de la tradicional Familia Alzaga. Posee una arboleda única, con árboles centenarios y una parquización perfecta realizada por el paisajista Thays.  </p>
                        </div>
                         <div class="mt-3 mt-md-4">
                            <p>Fue uno de los primeros countries pensados para vivir todo el año, con una excelente infraestructura de servicios, seguridad integral y con el colegio St. George’s College North dentro del mismo. El colegio dentro del country San Jorge Village cuenta con kindergarden (desde los 2 años), nivel primario y secundario. Su programa de estudios está basado en el Bachillerato Internacional y cumple también con las exigencias del Bachillerato Argentino. Los alumnos se preparan para rendir los exámenes de IGCSE y el Bachillerato Internacional. Es un colegio laico, con clases de religión optativas. Hay servicios de bus y camionetas al centro y otros countries.    </p>
                        </div>
                    </div>

                    
                    
                    <div class="pxp-blog-post-block pxp-full mt-4 mt-md-5">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <img src={{asset('/images/landings/sanjorge-1.jpg')}} alt="" class="pxp-image-full mb-3">
                            </div>
                            
                            <div class="col-sm-12 col-md-6">
                                <img src={{asset('/images/landings/sanjorge-2.jpg')}} alt="" class="pxp-image-full mb-3">
                            </div>
                            
                        </div>
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Servicios del barrio San Jorge Village: </h2>
                        <div class="mt-3 mt-md-4">
                            <div class="row mt-3 mt-md-4">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Gas Natural</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Ductos subterráneos en los que se canaliza la corriente eléctrica</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Agua Corriente</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Cloaca</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Internet de Banda Ancha</div>
                                </div>
                            </div>
                        </div>


                        
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Infraestructura del barrio San Jorge Village: </h2>
                        <div class="mt-3 mt-md-4">
                            <div class="row mt-3 mt-md-4">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Excelente club hípico, con una gran cantidad de caballerizas, dos pistas de arena para salto, una pista cubierta, corrales y un sendero ecuestre alrededor del predio. </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Servicios de bus y camionetas al centro y otros countries.</div>
                                </div>
                                 <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Canchas de tenis: 10 </div>
                                </div>
                                 <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Canchas de paddle: 4 </div>
                                </div>
                                 <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Canchas de squash: 2 </div>
                                </div>
                                 <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Canchas de fútbol (una iluminada): 2 </div>
                                </div>
                                 <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Gimnasio con equipamiento Johnson de última generación </div>
                                </div>
                                 <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Piletas comunes para mayores y menores: 2 </div>
                                </div>
                                 <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Vestuarios, Sauna & Guardería </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Kindergarten rodante para niños de 1 y 2 años </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Colonia de vacaciones </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Canchas de rugby </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Kindergarten rodante para niños de 1 y 2 años </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Cancha de atletismo </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Cancha de hockey </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Laboratorios </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Salón SUM para representaciones y próximamente pileta cubierta y gimnasio. </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Colegio bilingüe St George's North, con jornada completa y uno de los más importantes y prestigiosos de Zona Norte.</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 mt-md-4">
                        <h2>Ubicación de San Jorge Village </h2>
                            <p>El country está ubicado a 30 kilómetros de la Capital Federal. Se encuentra ubicado sobre la ruta 197, a 2 Km de la Panamericana.</p>
                        </div>



                        
                    </div>

                    


                    
                </div>
            </div>
        </div>

        

        <div class="pxp-blog-post-hero mt-4 mt-md-5">
                <div class="pxp-blog-post-hero-fig pxp-cover" style="background-image: url(/images/landings/sanjorge-port.jpg); background-position: 50% 60%;"></div>
            </div>

    </div>
</div>
@endsection

@section('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script>
        $('#en-venta').on('click', async function() { 
            let page = 1; 
            let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-venta-en-26688-s?page=${page}`)
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
             let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-alquiler-en-26688-s?page=${page}`)
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

                let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-${type}-en-26688-s?page=${page+1}`)
              
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