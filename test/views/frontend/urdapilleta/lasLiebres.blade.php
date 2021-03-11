@extends('frontend.layouts.app')
@section('content')

@include('frontend.layouts.header1')
@include('frontend.urdapilleta.includes.styles')

<div class="pxp-cta-1 pxp-cover  pt-300" style="background-image: url(/images/landings/lasliebres-port.jpg); background-position: 50% 60%;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-5">
                <div class="pxp-cta-1-caption pxp-animate-in pxp-in">
                    <h2 class="pxp-section-h2">Barrio Cerrado Las Liebres</h2>
                    <p class="pxp-text-light">El Lugar para Vivir.</p>
                    <a href="../buscar/propiedades-en-urdapilleta-en-26678-l" class="pxp-primary-cta text-uppercase mt-3 mt-md-5 pxp-animate">Todas las propiedades en <strong>Las Liebres</strong></a>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="container-fluid pxp-props-carousel-right mt-100">
        <h2 class="pxp-section-h2">Propiedades en el Las Liebres</h2>
        <p class="pxp-text-light">Ver propiedades en: <a style="color: #729acd; cursor: pointer;"  id='en-venta' >En Venta</a> | <a style="color: #729acd; cursor: pointer;"  id='en-alquiler'>En Alquiler</a> | <a href="../buscar/propiedades-en-urdapilleta-en-26678-l">Ver todas</a></p>
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
                    <h4>Aún no conocés Las Liebres</h4>
                    <h1 class="pxp-page-header">Conocé las características del barrio Las Liebres, ubicado en Pilar </h1>
                </div>
            </div>
        </div>


        <div class="pxp-services pxp-cover mt-60 pt-100 mb-200" style="background-image: url(/images/testim-1-fig.jpg);">
                <h2 class="text-center pxp-section-h2">Las Liebres</h2>
                <p class="pxp-text-light text-center">Acá podés encontrar el Masterplan, Videos, distribución de barrios y conocer todas las propiedades disponibles.</p>
    
                <div class="container">
                    <div class="pxp-services-container rounded-lg mt-4 mt-md-5">
                        <a href="{{asset('/masterplan/MASTERPLAN-LAS-LIEBRES.pdf')}}" target="_blank" class="pxp-services-item">
                            <div class="pxp-services-item-fig">
                                <img src={{asset('images/service-icon-2.svg')}}>
                            </div>
                            <div class="pxp-services-item-text text-center">
                                <div class="pxp-services-item-text-title">Masterplan</div>
                                <div class="pxp-services-item-text-sub">Descargate el masterplan <br>completo en pdf.</div>
                            </div>
                            <div class="pxp-services-item-cta text-uppercase text-center">Descargar PDF</div>
                        </a>
                        
                        <a href="https://goo.gl/maps/ZYq5nUJcNbzAdB6x9" target="_blank" class="pxp-services-item">
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
                                <div class="pxp-services-item-text-title">Te gustaría Visitar Las Liebres?</div>
                                <div class="pxp-services-item-text-sub">Hablemos Vía <Strong>Whatsapp</strong> <br>Te esperamos en Las Liebres.</div>
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
                        <h2>Las Liebres</h2>
                        <div class="mt-3 mt-md-4">
                            <p class="pxp-first-letter">Las Liebres es uno de los barrios más buscados del Km 38,5. Está formado por 335 lotes que van de los 650m2 a los 1000m2.  Su diseño urbanístico presenta un parque central, el cual es únicamente peatonal, arbolado y muy bien parquizado.  </p>
                        </div>
                    </div>

                   

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Lotes entre 650m2 a los 1000m2</h2>
                        <div class="mt-3 mt-md-4">
                            <p>Las Liebres posee una interesante infraestructura deportiva, con canchas de tenis, fútbol, hockey, básquet, squash, pileta. Además, cuenta con colonia de vacaciones y jardín maternal en el sector de los Condominios. Por último, en su Club House principal, hay restaurante, kiosco y plaza para niños.  </p>
                           
                        </div>
                    </div>

                    

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Servicios del Las Liebres </h2>
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
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Seguridad 24 hs y control permanente en los dos accesos</div>
                                </div>
                                
                            </div>
                           
                        </div>
                        
                        
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Infraestructura dentro del country </h2>
                        <div class="mt-3 mt-md-4">
                            <div class="row mt-3 mt-md-4">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Lotes entre 650m2 a los 1000m2</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Club House con dos salas, una para mayores y otra para menores</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Pileta común</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Cancha de squash</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> 4 Canchas de Tenis</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Cancha de básquet</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Pileta</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> 3 Canchas de Futbol </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Parque central, el cual es únicamente peatonal, arbolado y muy bien parquizado</div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check"></span> Club House principal con restaurante, kiosco y plaza para niños</div>
                                </div>
                                
                            </div>

                            <h2>Ubicación del Las Liebres</h2>
                            <div class="mt-3 mt-md-4">
                                <p >Las Liebres está ubicado a 3 minutos de la Panamericana Ramal Pilar en el km 37,5.</p>
                            </div>
                           
                        </div>
                        
                        
                    </div>

                    <div class="pxp-blog-post-block mt-4 mt-md-5">
                        <h2>Alrededores y comodidades de Las Liebres: </h2>
                        <div class="mt-3 mt-md-4">
                            <div class="row mt-3 mt-md-4">
                                <p>Las Liebres se encuentra ubicado a la altura del Km 38,5 de la Panamericana Ramal Pilar. Es la zona conocida como “Tortugas Norte”, rodeada de colegios, centros médicos, centros comerciales, restaurantes y supermercados. </p>
                            </div>

                            <div class="row mt-3 mt-md-4">
                                <p>Tortugas Norte es una zona totalmente establecida donde se encuentran los conocidos barrios cerrados: Tortugas CC, Los Tacos, Senderos, Los Laureles, La Legua, Boulevares y Bosque Chico. Además, importantes colegios de la zona de Pilar tienen sus sedes allí: St Catherines Moorlands, Oak Hill, Bedes, entre otros. Para completar, en las galerías comerciales ubicadas en esta zona se pueden encontrar todos los servicios como farmacia, supermercado, librería, peluquería, heladería, bares, cafés, gimnasios, centros médicos, entre otros. </p>
                            </div>

                            <h2>Ubicación del Las Liebres</h2>
                            <div class="mt-3 mt-md-4">
                                <p >Las Liebres está ubicado a 3 minutos de la Panamericana Ramal Pilar en el km 37,5.</p>
                            </div>
                           
                        </div>
                        
                        
                    </div>

                    
                    
                </div>
            </div>
        </div>

        

        <div class="pxp-blog-post-hero mt-4 mt-md-5">
            <div class="pxp-blog-post-hero-fig pxp-cover" style="background-image: url(/images/landings/lasliebres-port.jpg); background-position: 50% 60%;"></div>
        </div>

    </div>
</div>
    @endsection

    @section('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script>
    $('#en-venta').on('click', async function() { 
        let page = 1; 
        let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-venta-en-26678-l?page=${page}`)
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
        let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-alquiler-en-26678-l?page=${page}`)
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

        let {  data: data } = await axios.get(`/api/development/buscar/propiedades-en-${type}-en-26678-l?page=${page+1}`)

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