@extends('frontend.layouts.app')

@section('content')
@include('frontend.layouts.header')
    <div class="pxp-content">
        <div class="pxp-hero vh-100">
            <div id="pxp-hero-props-carousel-1" class="carousel slide pxp-hero-props-carousel-1" data-ride="carousel" data-pause="false" data-interval="7000">
            
                <div class="carousel-inner">
                    @foreach ($cover as $key => $item) 
                    @if ($key == 0)
                        <div class="carousel-item  active" data-slide="{{$key}}">
                            <div class="pxp-hero-bg pxp-cover" style='background-image: url({{asset("uploads/covers/".$item->cover_desktop)}});'></div>
                            <div class="pxp-caption">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-8 col-lg-6">
                                            <div class="pxp-caption-prop-title" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.7), -1px 1px 2px rgba(0, 0, 0, 0.4);">{{$item->title}}<br/><small>{{$item->subtitle}}</small></div>
                                            <div class="pxp-caption-prop-features mt-4"><h5 style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.7), -1px 1px 2px rgba(0, 0, 0, 0.4);">{{$item->body}}</h5></div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    @else 
                        <div class="carousel-item" data-slide="{{$key}}">
                            <div class="pxp-hero-bg pxp-cover" style='background-image: url({{asset("uploads/covers/".$item->cover_desktop)}});'></div>
                            <div class="pxp-caption">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-8 col-lg-6">
                                            <div class="pxp-caption-prop-title" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.7), -1px 1px 2px rgba(0, 0, 0, 0.4);">{{$item->title}}<br/><small>{{$item->subtitle}}</small></div>
                                            <div class="pxp-caption-prop-features mt-4"><h5 style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.7), -1px 1px 2px rgba(0, 0, 0, 0.4);">{{$item->body}}</h5></div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    @endif 
                    @endforeach
                  
                </div>

                <div class="pxp-carousel-controls">
                    <a class="pxp-carousel-control-prev" role="button" data-slide="prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828">
                            <g id="Group_30" data-name="Group 30" transform="translate(-1845.086 -1586.086)">
                                <line id="Line_2" data-name="Line 2" x1="30" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"/>
                                <line id="Line_3" data-name="Line 3" x1="9" y2="9" transform="translate(1846.5 1587.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"/>
                                <line id="Line_4" data-name="Line 4" x1="9" y1="9" transform="translate(1846.5 1596.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"/>
                            </g>
                        </svg>
                    </a>
                    <a class="pxp-carousel-control-next" role="button" data-slide="next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32.414" height="20.828" viewBox="0 0 32.414 20.828">
                            <g id="Symbol_1_1" data-name="Symbol 1 – 1" transform="translate(-1847.5 -1589.086)">
                                <line id="Line_5" data-name="Line 2" x2="30" transform="translate(1848.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"/>
                                <line id="Line_6" data-name="Line 3" x2="9" y2="9" transform="translate(1869.5 1590.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"/>
                                <line id="Line_7" data-name="Line 4" y1="9" x2="9" transform="translate(1869.5 1599.5)" fill="none" stroke="#333" stroke-linecap="round" stroke-width="2"/>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="carousel slide pxp-hero-props-carousel-1-prices" data-ride="carousel" data-pause="false" data-interval="false">
                <div class="carousel-inner">
                    @foreach ($cover as $key => $item)
                    @if ($key == 0)
                        <div class="carousel-item  active" data-slide="{{$key}}" style="background-color: #687389;">
                            <div class="pxp-progress"></div> 
                            <a href="{{$item->link}}" class="pxp-cta text-uppercase pxp-animate">Ver Más {{$item->title}}</a>
                        </div>
                    @else 
                        <div class="carousel-item  " data-slide="{{$key}}" style="background-color: #687389;">
                            <div class="pxp-progress"></div> 
                            <a href="{{$item->link}}" class="pxp-cta text-uppercase pxp-animate">Ver Más {{$item->title}}</a>
                        </div>
                    @endif
                       
                    @endforeach
                    
                </div>
                <div class="pxp-carousel-ticker">
                    <div class="pxp-carousel-ticker-counter"></div>
                    <div class="pxp-carousel-ticker-divider">&nbsp;&nbsp;/&nbsp;&nbsp;</div>
                    <div class="pxp-carousel-ticker-total"></div>
                </div>
            </div>
        </div>

     

        <div class="container mt-100 mb-100">
            <h2 class="pxp-section-h2">Barrios destacados</h2>
            <p class="pxp-text-light">Encontrá la propiedad que más se ajuste a vos.</p>

            <div class="row mt-4 mt-md-5">

                <div class="col-sm-12 col-md-6 col-lg-6">
                    <a href="{{url('barrio/ayres-de-pilar')}}" class="pxp-areas-1-item rounded-lg">
                        <div class="pxp-areas-1-item-fig pxp-cover" style="background-image: url(images/area-1.jpg);"></div>
                        <div class="pxp-areas-1-item-details">
                            <div class="pxp-areas-1-item-details-area">Ayres de Pilar</div>
                            <div class="pxp-areas-1-item-details-city">Lotes y Casas</div>
                        </div>
                        <!-- <div class="pxp-areas-1-item-counter"><span>324 Propiedades</span></div> -->
                        <div class="pxp-areas-1-item-cta text-uppercase">Ver más</div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <a href={{url('barrio/ayres-plaza')}} class="pxp-areas-1-item rounded-lg">
                        <div class="pxp-areas-1-item-fig pxp-cover" style="background-image: url(images/home-ayres-plaza.jpg);"></div>
                        <div class="pxp-areas-1-item-details">
                            <div class="pxp-areas-1-item-details-area">Ayres Plaza</div>
                            <div class="pxp-areas-1-item-details-city">Lotes y Casas</div>
                        </div>
                        <!-- <div class="pxp-areas-1-item-counter"><span>158 Propiedades</span></div> -->
                        <div class="pxp-areas-1-item-cta text-uppercase">Ver más</div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-8">
                    <a href={{url('/barrio/pilara')}} class="pxp-areas-1-item rounded-lg">
                        <div class="pxp-areas-1-item-fig pxp-cover" style="background-image: url(images/home-pilara.jpg);"></div>
                        <div class="pxp-areas-1-item-details">
                            <div class="pxp-areas-1-item-details-area">Pilará</div>
                            <div class="pxp-areas-1-item-details-city">Lotes y Casas</div>
                        </div>
                        <!-- <div class="pxp-areas-1-item-counter"><span>324 Propiedades</span></div> -->
                        <div class="pxp-areas-1-item-cta text-uppercase">Ver más</div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    
                    <a href={{url('/barrio/martindale-country-club')}} class="pxp-areas-1-item rounded-lg">
                        <div class="pxp-areas-1-item-fig pxp-cover" style="background-image: url(images/home-martindale.jpg);"></div>
                        <div class="pxp-areas-1-item-details">
                            <div class="pxp-areas-1-item-details-area">Martindale</div>
                            <div class="pxp-areas-1-item-details-city">Lotes y Casas</div>
                        </div>
                        <!-- <div class="pxp-areas-1-item-counter"><span>158 Propiedades</span></div> -->
                        <div class="pxp-areas-1-item-cta text-uppercase">Ver más</div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-5">
                    <a href="/barrio/olivos-golf-club" class="pxp-areas-1-item rounded-lg">
                        <div class="pxp-areas-1-item-fig pxp-cover" style="background-image: url(images/home-olivos.jpg);"></div>
                        <div class="pxp-areas-1-item-details">
                            <div class="pxp-areas-1-item-details-area">Olivos Golf Club</div>
                            <div class="pxp-areas-1-item-details-city">Lotes y Casas</div>
                        </div>
                        <!-- <div class="pxp-areas-1-item-counter"><span>324 Propiedades</span></div> -->
                        <div class="pxp-areas-1-item-cta text-uppercase">Ver más</div>
                    </a>
                </div>
                
                <div class="col-sm-12 col-md-6 col-lg-7">
                    <a href={{url('/barrio/tortugas-country-club')}} class="pxp-areas-1-item rounded-lg">
                        <div class="pxp-areas-1-item-fig pxp-cover" style="background-image: url(images/home-tortugas.jpg);"></div>
                        <div class="pxp-areas-1-item-details">
                            <div class="pxp-areas-1-item-details-area">Tortugas</div>
                            <div class="pxp-areas-1-item-details-city">Lotes y Casas</div>
                        </div>
                       <!--  <div class="pxp-areas-1-item-counter"><span>158 Propiedades</span></div> -->
                        <div class="pxp-areas-1-item-cta text-uppercase">Ver más</div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href={{url('barrio/golf-club-argentino')}} class="pxp-areas-1-item rounded-lg">
                        <div class="pxp-areas-1-item-fig pxp-cover" style="background-image: url(images/home-argentino.jpg);"></div>
                        <div class="pxp-areas-1-item-details">
                            <div class="pxp-areas-1-item-details-area">Golf Club Argentino</div>
                            <div class="pxp-areas-1-item-details-city">Lotes y Casas</div>
                        </div>
                        <!-- <div class="pxp-areas-1-item-counter"><span>158 Propiedades</span></div> -->
                        <div class="pxp-areas-1-item-cta text-uppercase">Ver más</div>
                    </a>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="/barrio/san-jorge-village" class="pxp-areas-1-item rounded-lg">
                        <div class="pxp-areas-1-item-fig pxp-cover" style="background-image: url(images/home-sanjorge.jpg);"></div>
                        <div class="pxp-areas-1-item-details">
                            <div class="pxp-areas-1-item-details-area">San Jorge Village</div>
                            <div class="pxp-areas-1-item-details-city">Lotes y Casas</div>
                        </div>
                        <!-- <div class="pxp-areas-1-item-counter"><span>158 Propiedades</span></div> -->
                        <div class="pxp-areas-1-item-cta text-uppercase">Ver más</div>
                    </a>
                </div>
                
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href={{url('/barrio/las-liebres')}} class="pxp-areas-1-item rounded-lg">
                        <div class="pxp-areas-1-item-fig pxp-cover" style="background-image: url(images/home-lasliebres.jpg);"></div>
                        <div class="pxp-areas-1-item-details">
                            <div class="pxp-areas-1-item-details-area">Las Liebres</div>
                            <div class="pxp-areas-1-item-details-city">Lotes y Casas</div>
                        </div>
                        <!-- <div class="pxp-areas-1-item-counter"><span>158 Propiedades</span></div> -->
                        <div class="pxp-areas-1-item-cta text-uppercase">Ver más</div>
                    </a>
                </div>


            </div>

            <a href="/buscador" class="pxp-primary-cta text-uppercase mt-2 mt-md-4 pxp-animate">Utilizá nuestro buscador de propiedades.</a>
        </div>

        <div class="pt-100 pb-100 mt-100 position-relative">
            <div class="pxp-services-c pxp-cover" style="background-image: url(https://www.ayresdesarrollos.com.ar/wp-content/uploads/2014/04/AY_VH_peatonal_estacionam_FINAL_C-BAJA.jpg); filter: opacity(0.4);"></div>
            <div class="pxp-services-c-content">
                <div class="pxp-services-c-intro">
                    <h2 class="pxp-section-h2" >Ayres Desarrollos</h2>
                    <p class="pxp-text-light">Conocé todos los emprendimientos de Ayres</p>
                    <a href={{url('buscar/propiedades-en-urdapilleta-en-ag-pilar--pc-ayresdepilar')}} class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate">Conocé Mas</a>
                </div>
                <div class="pxp-services-c-container mt-4 mt-md-5 mt-lg-0">
                    <div class="owl-carousel pxp-services-c-stage">
                        <div>
                            <a href="/barrio/ayres-de-pilar" class="pxp-prop-card-1 rounded-lg">
                                <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/ayreshome/ayres-de-pilar.jpg);"></div>
                                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                                <div class="pxp-prop-card-1-details">
                                    <div class="pxp-prop-card-1-details-price">Ayres de Pilar</div>
                                    <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                    <div class="pxp-prop-card-1-details-features text-uppercase">Casas y Lotes en Pilar</div>
                                </div>
                                <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                            </a>
                        </div>
                        <div>
                            <a href="barrio/loft-ayres-vila" class="pxp-prop-card-1 rounded-lg">
                                <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/ayreshome/loft-ayres.jpg);"></div>
                                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                                <div class="pxp-prop-card-1-details">
                                    <div class="pxp-prop-card-1-details-price">Loft Ayres </div>
                                    <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                    <div class="pxp-prop-card-1-details-features text-uppercase">Departamentos en Ayres</div>
                                </div>
                                <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                            </a>
                        </div>
                        <div>
                            <a href="barrio/skyglass" class="pxp-prop-card-1 rounded-lg">
                                <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/ayreshome/skyglass.jpg);"></div>
                                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                                <div class="pxp-prop-card-1-details">
                                    <div class="pxp-prop-card-1-details-price">Skyglass </div>
                                    <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                    <div class="pxp-prop-card-1-details-features text-uppercase">Oficinas en Pilar</div>
                                </div>
                                <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                            </a>
                        </div>
                        <div>
                            <a href="barrio/skyglass2" class="pxp-prop-card-1 rounded-lg">
                                <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/ayreshome/skyglass2.jpg);"></div>
                                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                                <div class="pxp-prop-card-1-details">
                                    <div class="pxp-prop-card-1-details-price">Skyglass 2</div>
                                    <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                    <div class="pxp-prop-card-1-details-features text-uppercase">Oficinas en Pilar</div>
                                </div>
                                <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                            </a>
                        </div>
                        <div>
                            <a href="barrio/skyglass3" class="pxp-prop-card-1 rounded-lg">
                                <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/ayreshome/skyglass3.jpg);"></div>
                                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                                <div class="pxp-prop-card-1-details">
                                    <div class="pxp-prop-card-1-details-price">Skyglass 3</div>
                                    <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                    <div class="pxp-prop-card-1-details-features text-uppercase">Oficinas en Pilar</div>
                                </div>
                                <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                            </a>
                        </div>
                        <div>
                            <a href="barrio/studios" class="pxp-prop-card-1 rounded-lg">
                                <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/ayreshome/studio.jpg);"></div>
                                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                                <div class="pxp-prop-card-1-details">
                                    <div class="pxp-prop-card-1-details-price">Studios</div>
                                    <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                    <div class="pxp-prop-card-1-details-features text-uppercase">Oficinas en Pilar</div>
                                </div>
                                <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                            </a>
                        </div>
                        <div>
                            <a href="barrio/terrazas-de-ayres" class="pxp-prop-card-1 rounded-lg">
                                <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/ayreshome/terrazas-de-ayres.jpg);"></div>
                                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                                <div class="pxp-prop-card-1-details">
                                    <div class="pxp-prop-card-1-details-price">Terrazas de Ayres</div>
                                    <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                    <div class="pxp-prop-card-1-details-features text-uppercase">Departamentos en Pilar</div>
                                </div>
                                <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                            </a>
                        </div>
                        <div>
                            <a href="barrio/vilahaus" class="pxp-prop-card-1 rounded-lg">
                                <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/ayreshome/vilahaus.jpg);"></div>
                                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                                <div class="pxp-prop-card-1-details">
                                    <div class="pxp-prop-card-1-details-price">Vilahaus</div>
                                    <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                    <div class="pxp-prop-card-1-details-features text-uppercase">Departamentos en Pilar</div>
                                </div>
                                <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid pxp-props-carousel-right pxp-has-intro mt-100 mb-100">
            <div class="pxp-props-carousel-right-intro" >
                <h2 class="pxp-section-h2">Pilará</h2> 
                <p class="pxp-text-light">Te acercamos los mejores desarrollo para invertir.</p>
                <a href={{url('/buscar/propiedades-en-urdapilleta-en-ag-pilar--gp-pilara')}} class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate">Conocé todos acá</a>
            </div>
            <div class="pxp-props-carousel-right-container mt-4 mt-md-5 mt-lg-0">
                <div class="owl-carousel pxp-props-carousel-right-stage-1">
                    <div>
                        <a href="barrio/carruajes" class="pxp-prop-card-1 rounded-lg">
                            <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/home-carruajes.jpg);"></div>
                            <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                            <div class="pxp-prop-card-1-details">
                                <div class="pxp-prop-card-1-details-price">Carruajes</div>
                                <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                <div class="pxp-prop-card-1-details-features text-uppercase"></div>
                            </div>
                            <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                        </a>
                    </div>

                    <div>
                        <a href="barrio/pilara" class="pxp-prop-card-1 rounded-lg">
                            <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/home-pilara.jpg);"></div>
                            <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                            <div class="pxp-prop-card-1-details">
                                <div class="pxp-prop-card-1-details-price">Pilará</div>
                                <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                <div class="pxp-prop-card-1-details-features text-uppercase"></div>
                            </div>
                            <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                        </a>
                    </div>

                    <div>
                        <a href="barrio/terrazas-al-golf" class="pxp-prop-card-1 rounded-lg">
                            <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/home-terrazas-golf.jpg);"></div>
                            <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                            <div class="pxp-prop-card-1-details">
                                <div class="pxp-prop-card-1-details-price">Terrazas al Golf</div>
                                <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                <div class="pxp-prop-card-1-details-features text-uppercase"></div>
                            </div>
                            <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                        </a>
                    </div>

                    <div>
                        <a href="barrio/residence" class="pxp-prop-card-1 rounded-lg">
                            <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/home-residence.jpg);"></div>
                            <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                            <div class="pxp-prop-card-1-details">
                                <div class="pxp-prop-card-1-details-price">Residence</div>
                                <!-- <div class="pxp-prop-card-1-details-price">Desde u$d 10,000</div> -->
                                <div class="pxp-prop-card-1-details-features text-uppercase"></div>
                            </div>
                            <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Más</div>
                        </a>
                    </div>

                    

                    
                </div>
            </div>
        </div>


        

        
    </div>
    
@endsection