@extends('frontend.layouts.app')
@section('content')
 
@include('frontend.layouts.header1')
@include('frontend.urdapilleta.includes.styles')

<div class="pxp-cta-1 pxp-cover  pt-300" style="background-image: url(https://pilara.com.ar/images/golf/caratula.jpg); background-position: 50% 60%;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-5">
                <div class="pxp-cta-1-caption pxp-animate-in pxp-in">
                    <h2 class="pxp-section-h2">Barrio Cerrado Pilará</h2>
                    <p class="pxp-text-light">El Lugar para Vivir.</p>
                    <a href="/buscar/propiedades-en-alquiler-en-26737-m" class="pxp-primary-cta text-uppercase mt-3 mt-md-5 pxp-animate">Todas las propiedades en <strong>Pilará</strong></a>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="container-fluid pxp-props-carousel-right mt-100">
        <h2 class="pxp-section-h2">Propiedades en Pilará</h2>
        <p class="pxp-text-light">Ver propiedades en: <a style="color: #729acd; cursor: pointer;"  id='en-venta' ><strong>En Venta</strong></a> | <a style="color: #729acd; cursor: pointer;"  id='en-alquiler'><strong>En Alquiler</strong></a></p>
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
  
<div class="pxp-content">



    <div class="pxp-blog-posts pxp-content-wrapper mt-60">
        <div class="container mt-100">
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <h4>Aún no conocés Pilará?</h4>
                    <h1 class="pxp-page-header">Conocé Pilará. Bienvenido. </h1>
                </div>
            </div>
        </div>


        <div class="pxp-services pxp-cover mt-60 pt-100 mb-200" style="background-image: url(/images/testim-1-fig.jpg);">
            <h2 class="text-center pxp-section-h2">El Desarrollo</h2>
            <p class="pxp-text-light text-center">Acá podés encontrar el Masterplan, Videos, distribución de barrios y conocer todas las propiedades disponibles.</p>

            <div class="container">
                <div class="pxp-services-container rounded-lg mt-4 mt-md-5">
                    <a href="{{asset('/masterplan/pilara.pdf')}}" target="_blank" class="pxp-services-item">
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
                            <div class="pxp-services-item-text-sub">Conocé los barrios que<br> integran a Pilará</div>
                        </div>
                        <div class="pxp-services-item-cta text-uppercase text-center">Descargar Mapa</div>
                    </a> -->
                    <a href="https://g.page/PilaraCountry?share" target="_blank" class="pxp-services-item">
                        <div class="pxp-services-item-fig">
                            <img src={{asset('images/plan-business.svg')}}>
                        </div>
                        <div class="pxp-services-item-text text-center">
                            <div class="pxp-services-item-text-title">Como llegar</div>
                            <div class="pxp-services-item-text-sub">Desde Google Maps conocé <br/>como llegar a Pilará.</div>
                        </div>
                        <div class="pxp-services-item-cta text-uppercase text-center">Ver Ubicación</div>
                    </a>
                    <a href="https:/wa.me/5491161124558" target="_blank" class="pxp-services-item">
                        <div class="pxp-services-item-fig">
                            <img src={{asset('images/service-icon-4.svg')}}>
                        </div>
                        <div class="pxp-services-item-text text-center">
                            <div class="pxp-services-item-text-title">Te gustaría Visitar Pilará?</div>
                            <div class="pxp-services-item-text-sub">Hablemos Vía <Strong>Whatsapp</strong> <br>para que vengas a conocer Pilará.</div>
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
                        <h2>DEPORTE, VIDA FAMILIAR Y CONFORT EN UN SOLO LUGAR</h2>
                        <div class="mt-3 mt-md-4">
                            <p class="pxp-first-letter">Pilará es uno de los nuevos countries de Pilar, un emprendimiento de alta gama que se destaca por tener excelentes instalaciones deportivas, atracciones de esparcimiento para toda la familia y vida en la naturaleza. </p>
                        </div>
                         <div class="mt-3 mt-md-4">
                            <p>Está dividido en 5 comunidades: La Berlina, La Volanta, El Tonó, La Diligencia, La Calesa. Ahí encontrarás lotes que van de los 900m en adelante, algunos con vistas a las canchas de golf, o de polo, otros que dan a la laguna… Nuestros asesores podrán guiarte para encontrar exactamente el lugar que estás buscando.   </p>
                        </div>
                    </div>

                    <div class="pxp-blog-post-block pxp-full mt-4 mt-md-5">
                        <a href="javascript:void(0);" class="pxp-blog-post-video pxp-cover" style="background-image: url(https://pilara.com.ar/images/home/02.jpg); background-position: 50% 50%;"></a>
                        <iframe width="889" height="500" src="https://www.youtube.com/embed/9uteoHGhdvY?start=23" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; border: 0 none;"></iframe>
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>GOLF, POLO, TENIS </h2>
                        <div class="mt-3 mt-md-4">
                            <p>Practicar deportes al aire libre es la propuesta de muchos countries y barrios cerrados de la zona, pero hacerlo en instalaciones profesionales y de vanguardia es patrimonio de unos pocos emprendimientos. Pilará es uno de ellos. interior, proyectando los distintos colores de la luz en cada rincón de sus amplios espacios. El delicado balance natural entre el cielo y el golf se percibe desde sus grandes ventanales, balcones y terrazas.</p>
                            <div class="pxp-blog-post-blockquote pxp-left">"Concebido para reflejar la esencia de una vida en equilibrio."</div>
                            
                            <p>Golf: Pilará tiene una espectacular cancha de golf -la primera Nicklaus Signature de Sudamérica-, construida sobre 76 hectáreas.  </p>
                            <p>Polo: hay cuatro canchas de Polo en donde se organizan torneos con participación de patrones internacionales y torneos para socios con finales en Palermo. </p>
                            <p>Tenis: 14 canchas de tenis (10 de polvo de ladrillo y 4 de superficie rápida -dos de ellas cubiertas-). </p>
                        </div>

                         <div class="mt-3 mt-md-4">
                            <p>Asimismo, en Pilará, se encuentran los Condominios Residence, departamentos de 2, 3 y 4 ambientes con amenities de calidad premium, y la posibilidad de vivir en un entorno verde, así como los dormies: Carruajes y Terrazas al Golf.  </p>
                        </div>
                    </div>
                    <div class="pxp-blog-post-block pxp-full mt-4 mt-md-5">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <img src={{asset('/images/landings/pilara-4.jpg')}} alt="" class="pxp-image-full mb-3">
                            </div>
                            
                            <div class="col-sm-12 col-md-6">
                                <img src={{asset('/images/landings/pilara-5.jpg')}} alt="" class="pxp-image-full mb-3">
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <img src={{asset('/images/landings/pilara-6.jpg')}} alt="" class="pxp-image-full mb-3">
                            </div>
                        
                            <div class="col-sm-12 col-md-6">
                                <img src={{asset('/images/landings/pilara-2.jpg')}} alt="" class="pxp-image-full mb-3">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <img src={{asset('/images/landings/pilara-3.jpg')}} alt="" class="pxp-image-full mb-3">
                            </div>
                        </div>
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Servicios del barrio Pilará: </h2>
                        <div class="mt-3 mt-md-4">
                            <div class="row mt-3 mt-md-4">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Gas Natural</div>
                                </div>
                                 <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Corriente Electrica</div>
                                </div>
                                 <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Agua Corriente</div>
                                </div>
                                 <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Cloaca</div>
                                </div>
                                 <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Internet</div>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Infraestructura del barrio Pilará: </h2>
                        <div class="mt-3 mt-md-4">
                            <div class="row mt-3 mt-md-4">
                                <div class="col-sm-6 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Cancha de Golf de 18 hoyos "Nicklaus Signature"</div>
                                </div>
                                 <div class="col-sm-6 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Canchas de Tenis de distintas superficies</div>
                                </div>
                                 <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Mini Estadio de Tenis, para 400 personas</div>
                                </div>
                                 <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> 2 Canchas de Tenis cubiertas</div>
                                </div>
                                 <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> 4 Canchas<br> de polo </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Fitness </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Senda Aeróbica </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span>  Bicisenda </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span>  Gimnasio </div>
                                </div>

                            </div>
                        </div>

                        <div class="mt-3 mt-md-4">
                        <h2>Alrededores de Pilará </h2>
                            <p>Está ubicado en una zona estratégica en donde se podrán desarrollar colegios, centros comerciales y otros servicios de manera ordenada y planeada. Las posibilidades de inversión son diversas. </p>
                        </div>


                        
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Masterplan </h2>
                        
                        <div class="col-sm-12 col-md-12">
                                <img src={{asset('/images/landings/masterplan-pilara.jpg')}} alt="" class="pxp-image-full mb-3">
                            </div>

                        
                    </div>



                    
                </div>
            </div>
        </div>

        

        <div class="pxp-blog-post-hero mt-4 mt-md-5">
            <div class="pxp-blog-post-hero-fig pxp-cover" style="background-image: url(https://pilara.com.ar/images/golf/caratula.jpg); background-position: 50% 50%;"></div>
        </div>

    </div>
</div>
@endsection

@section('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script>
        $('#en-venta').on('click', async function() { 
            let page = 1; 
            let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-venta-en-26737-m?page=${page}`)
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
             let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-alquiler-en-26737-m?page=${page}`)
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

                let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-${type}-en-26737-m?page=${page+1}`)
              
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