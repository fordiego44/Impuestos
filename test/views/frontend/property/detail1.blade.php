@extends('frontend.layouts.app')

@section('open-graph')

    <meta property="og:url" content="{{Request::fullUrl()}}"/>
    <meta property="og:type" content="product.item"/>
    <meta property="og:title" content="{{$property->publication_title}}"/>
 
    @if(isset($property->photos[0]->image))
        <meta property="og:image" content="{{$property->photos[0]->image}}"/>
    @else
        <meta property="og:image" content=""/>
    @endif

    <meta property="product:retailer_item_id" content="{{$property->id}}"/>
    <meta property="product:price:amount" content="{{$property->operations[0]->prices[0]->price}}"/>
    <meta property="product:price:currency" content="{{$property->operations[0]->prices[0]->currency}}"/>
    <meta property="product:availability" content="in stock"/>
    <meta property="product:condition" content="new"/>
    <meta property="fb:app_id" content="494490990968831"/>

@endsection

@section('content')

    <input type="hidden" value="{{$property->id}}" id="property_id">
    @if (Session::has('ref'))
        <input type="hidden" name="property_ref" value="{{Session::get('ref')}}">
    @else
        <input type="hidden" name="property_ref" value="">
    @endif

    <input type="hidden" name="publication_title" value="{{$property->publication_title}}">
    <input type="hidden" name="property_price" value="{{$property->operations[0]->prices[0]->price}}">
    <input type="hidden" name="property_currency" value="{{$property->operations[0]->prices[0]->currency}}">
    <input type="hidden" name="operation_type" value="{{$property->operations[0]->operation_type}}">
    <input type="hidden" name="property_type" value="{{$property->type->name}}">
    <input type="hidden" name="property_branch" value="{{$property->branch->name ?? ''}}">

    <style>
        .carousel-slider img {
            object-fit: cover;
            height: 667px;
            /*min-height: 600px;*/
        }

        .property-list-item .property-list-image img {
            object-fit: cover;
            height: 260px;
        }
    </style>

    <!-- Single Property Section -->
    <div class="casaroyal-single-property-section">

        <div class="bph casaroyal-single-property-shortcode">

            <div class="row row-eq-height">

                <div class="col-md-5 bph-meta" style="display: flex; flex-direction: column; justify-content: center">

						<span class="bph-type muted" style="margin:0">
							<span class="property-type">{{$property->type->name}}</span> en {{$property->operations[0]->operation_type}} en {{$property->location->name}}
						</span>

                    <div class="bph-info-wrapper">

                        <h2 class="bph-title">
                            <a href=""><!-- {{$property->type->name}} en {{$property->operations[0]->operation_type}} --> {{$property->publication_title}}
                                <!-- en {{$property->location->name}} --></a>
                        </h2>

                        <p><i class="fa fa-dot-circle-o"
                              aria-hidden="true"></i> {{ implode(', ',array_reverse(explode(" | ",$property->location->short_location))) }}
                        </p>

                        <div class="bph-price property-has-video">

                            <div class="property-price-wrapper">
                                <span class="price-prefix"></span>
                                <span class="property-price-holder"><span
                                        class="property-price-number">{{$property->operations[0]->operation_type}}</span></span>
                                <span class="price-prefix"></span>
                            </div>

                            <div class="property-price-wrapper">
                                <span class="price-prefix"></span>


                                @if($property->operations[0]->prices[0]->price == 1)
                                    <span class="property-price-holder">CONSULTAR</span>
                                @else

                                    <span class="property-price-holder">{{$property->operations[0]->prices[0]->currency == "USD"? "U\$D ": "$" }} <span
                                            class="property-price-number"> {{$property->operations[0]->prices[0]->price}}</span></span>
                                    <span class="price-prefix"></span>

                                @endif
                            </div>

                        </div>

                        <a onclick="ga('send', 'event', 'Whatsapp', 'Click', 'Whatsapp_Iniciado');"
                           href="https://api.whatsapp.com/send?text={{$branch->messageWpp}}&phone={{($branch->whatsapp == '') ? $branch->branch->whatsapp : $branch->whatsapp}}"
                           target="_blank" class="bph-whatsapp ">
                            <!-- Generator: Adobe Illustrator 23.0.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 1366 768" style="enable-background:new 0 0 1366 768;"
                                 xml:space="preserve">
									<style type="text/css">
                                        .st1 {
                                            fill: #ffffff;
                                        }
                                    </style>
                                <g>
                                    <path id="WhatsApp" class="st1" d="M939,378.41c0,137.75-112.52,249.41-251.35,249.41c-44.07,0-85.48-11.26-121.5-31.03L427,641
										l45.37-133.81c-22.89-37.58-36.07-81.66-36.07-128.78C436.3,240.66,548.83,129,687.65,129C826.49,129,939,240.66,939,378.41z
										M687.65,168.72c-116.53,0-211.32,94.07-211.32,209.69c0,45.88,14.96,88.37,40.25,122.94l-26.4,77.88l81.21-25.81
										c33.37,21.91,73.34,34.69,116.26,34.69c116.51,0,211.32-94.05,211.32-209.68S804.18,168.72,687.65,168.72z M814.58,435.85
										c-1.55-2.54-5.65-4.08-11.81-7.13c-6.17-3.05-36.47-17.85-42.1-19.88c-5.65-2.04-9.77-3.06-13.87,3.05
										c-4.1,6.12-15.91,19.88-19.51,23.96c-3.6,4.09-7.19,4.6-13.35,1.54c-6.16-3.05-26-9.52-49.54-30.34
										c-18.31-16.2-30.68-36.2-34.28-42.33c-3.59-6.12-0.38-9.42,2.7-12.46c2.78-2.74,6.17-7.14,9.24-10.71
										c3.09-3.57,4.11-6.12,6.16-10.2c2.07-4.08,1.04-7.65-0.51-10.71c-1.54-3.05-13.87-33.14-19-45.38
										c-5.13-12.23-10.26-10.19-13.86-10.19c-3.59,0-7.7-0.51-11.81-0.51c-4.11,0-10.79,1.53-16.44,7.65
										c-5.64,6.12-21.56,20.91-21.56,50.99c0,30.08,22.07,59.15,25.16,63.22c3.08,4.07,42.61,67.81,105.24,92.29
										c62.64,24.47,62.64,16.3,73.94,15.28c11.29-1.02,36.44-14.79,41.6-29.05C816.11,450.63,816.11,438.4,814.58,435.85z"/>
                                </g>
								</svg>

                            <!-- <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve">
                                <style type="text/css">.st0{fill:#FFFFFF;}</style>
                                <path class="st0" d="M80.9,488.3L448.7,276c20-11.5,20-40.4,0-52L80.9,11.7c-20-11.5-45,2.9-45,26v424.7
                                C35.9,485.5,60.9,499.9,80.9,488.3z"></path>
                            </svg> -->
                        </a>


                        <a href="#contacto" class="bph-lead ">
                            <!-- Generator: Adobe Illustrator 23.0.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <!-- <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve">
                                <style type="text/css">.st0{fill:#FFFFFF;}</style>
                                <path class="st0" d="M80.9,488.3L448.7,276c20-11.5,20-40.4,0-52L80.9,11.7c-20-11.5-45,2.9-45,26v424.7
                                C35.9,485.5,60.9,499.9,80.9,488.3z"></path>
                            </svg> -->
                            <!-- Generator: Adobe Illustrator 23.0.1, SVG Export Plug-In  -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 485.2 485.2" style="enable-background:new 0 0 485.2 485.2;"
                                 xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: #D0CFCE;
                                }
                            </style>
                                <g>
                                    <path class="st0" d="M485.2,363.9c0,10.6-3,20.5-7.8,29.2L324.2,221.7L475.8,89.1c5.9,9.4,9.4,20.3,9.4,32.2L485.2,363.9
                                    L485.2,363.9z M242.6,252.8L453.5,68.3c-8.7-4.7-18.4-7.6-28.9-7.6H60.7c-10.5,0-20.3,2.9-28.9,7.6L242.6,252.8z M301.4,241.6
                                    l-48.8,42.7c-2.9,2.5-6.4,3.7-10,3.7c-3.6,0-7.1-1.2-10-3.7l-48.8-42.7L28.7,415.2c9.3,5.8,20.2,9.3,32,9.3h363.9
                                    c11.8,0,22.7-3.5,32-9.3L301.4,241.6z M9.4,89.1C3.6,98.4,0,109.4,0,121.3v242.6c0,10.6,3,20.5,7.8,29.2L161,221.6L9.4,89.1z"/>
                                </g>
                            </svg>


                        </a>

                    </div>


                </div>

                <div class="col-md-7" style="padding: 0">
                    <div class="property-gallery-wrapper" style="margin-bottom: 0px !important; padding: 0">

                        <div class="property-gallery">
                            <div class="property-gallery-count">
                                <div class="property-gallery-count-current">1</div>
                                /<span><b>{{count($property->photos)}}</b></span>
                            </div>
                            <div class="carousel-slider">
                                @if(isset($property->provider_youtube))

                                    @foreach ($property->provider_youtube as $video)

                                        <iframe id='ref' data-lightbox="property-gallery" width="100%"
                                                src="https://www.youtube.com/embed/{{explode("&",$video->video_id)[0]}}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>

                                    @endforeach

                                @endif

                                @foreach ($property->photos as $key => $photo)
                                    <div>
                                        <a href="{{$photo->image}}" data-lightbox="property-gallery">
                                            <img id='ref-img' src="{{$photo->image}}" alt=""/>
                                        </a>
                                    </div>

                                @endforeach

                            </div>

                            <div class="carousel-thumbnail" style="display: none">

                                @foreach ($property->photos as $key => $photo)
                                    <div>
                                        <span style="background-image: url({{$photo->thumb}});"></span>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
        <!-- Single Property Section -->

        <!-- Single Property Navigation Section -->
        <div class="casaroyal-property-nav">
            <ul>
                <li>
                    <a class="active" href="#" data-id="property-description">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" width="611.997px" height="611.998px" viewBox="0 0 611.997 611.998"
                             style="enable-background:new 0 0 611.997 611.998;" xml:space="preserve">
                            <path
                                d="M511.114,300.251c-9.94,0-17.638,7.663-17.638,17.651v241.105H368.401v-98.453c0-9.236-7.697-17.31-17.002-17.31h-90.435 c-9.948,0-17.96,8.073-17.96,17.31v98.453h-124.76v-233.1c0-9.306-7.69-17.036-17.638-17.036c-9.298,0-16.995,7.73-16.995,17.036 v250.752c0,9.305,7.697,17.036,16.995,17.036h160.358c9.298,0,16.995-7.731,16.995-17.036v-98.454h55.801v98.454 c0,9.305,7.697,17.036,17.639,17.036h159.715c9.299,0,16.995-7.731,16.995-17.036V317.903 C528.109,307.915,520.413,300.251,511.114,300.251z"></path>
                            <path
                                d="M607.003,314.003L467.819,174.225V78.919c0-9.921-8.019-17.583-17.96-17.583c-9.305,0-17.001,7.663-17.001,17.583v60.345 L318.046,23.774c-3.518-3.558-7.697-5.474-11.864-5.474c-4.81,0-8.983,1.984-12.507,5.474L5.361,312.087 c-6.917,6.91-7.375,17.994,0,24.357c6.411,7.389,17.454,6.91,24.371,0l276.45-275.793l275.807,278.393 c2.873,2.874,7.054,4.516,12.507,4.516c4.81,0,8.976-1.642,12.507-4.516C613.42,332.613,613.899,320.982,607.003,314.003z"></path>
                        </svg>
                        <span>Ficha de Propiedad</span>
                    </a>
                </li>
                @if(isset($property->photo_normal))

                    <li>
                        <a href="#" data-id="property-photos">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                <circle cx="76" cy="42.4" r="6.6"></circle>
                                <path
                                    d="m6.4,119.5c0,0 0,0.1 0,0 0,0.1 0,0.1 0.1,0.1 0.1,0.2 0.2,0.5 0.3,0.7 0,0.1 0.1,0.1 0.1,0.2 0,0.1 0.1,0.1 0.1,0.2 0,0 0.1,0.1 0.1,0.1 0.1,0.2 0.3,0.3 0.4,0.5 0,0 0.1,0.1 0.1,0.1 0.1,0.1 0.1,0.1 0.2,0.2 0.1,0 0.1,0.1 0.1,0.1 0.1,0.1 0.2,0.1 0.3,0.2 0,0 0.1,0.1 0.1,0.1 0,0 0.1,0 0.1,0.1 0.1,0.1 0.3,0.1 0.4,0.2 0.1,0 0.1,0 0.2,0.1 0.1,0 0.2,0.1 0.2,0.1 0.3,0.1 0.6,0.1 0.9,0.1h108.2c2.3,0 4.1-1.8 4.1-4.1v-27-80.9c0-2.3-1.8-4.1-4.1-4.1h-107.9c-2.3,0-4.1,1.8-4.1,4.1v80.7 27c0,0.3 0.1,0.7 0.1,1 0,0.1 0,0.2 0,0.2zm108.1-5.2h-90.4l66.8-43.7 23.6,22.5v21.2zm-100-99.6h100v67.1l-20.3-19.4c-1.4-1.3-3.5-1.5-5.1-0.5l-19.1,12.6-13.3-13.4c-1.4-1.4-3.5-1.6-5.1-0.6l-37.1,23.4v-69.2zm0,78.9l38.7-24.4 9.8,9.9-48.5,31.7v-17.2z"></path>
                            </svg>
                            <span>Fotos y Video</span>
                        </a>
                    </li>
                @endif

                @if(isset($property->photo_plano))

                    <li>
                        <a href="#" data-id="property-floor-plans">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 x="0px" y="0px" viewBox="0 0 151.91 151.91" xml:space="preserve">
                                <path
                                    d="M143.972,150.268c-0.64,0-1.28-0.244-1.768-0.732c-0.977-0.977-0.977-2.559,0-3.535l1.107-1.107 H29.133L30.24,146c0.977,0.977,0.977,2.559,0,3.535c-0.976,0.977-2.56,0.977-3.535,0l-5.313-5.313 c-0.496-0.496-0.74-1.148-0.732-1.799c0-0.01,0-0.021,0-0.031c0-0.86,0.434-1.618,1.095-2.068l5.075-5.074 c0.976-0.977,2.56-0.977,3.535,0c0.977,0.977,0.977,2.559,0,3.535l-1.107,1.107h114.179l-1.107-1.107 c-0.977-0.977-0.977-2.559,0-3.535c0.976-0.977,2.56-0.977,3.535,0l5.313,5.313c0.497,0.496,0.74,1.148,0.732,1.799 c0,0.011,0,0.021,0,0.031c0,0.86-0.434,1.618-1.095,2.068l-5.075,5.074C145.252,150.024,144.612,150.268,143.972,150.268z M7.875,132.893c-0.86,0-1.619-0.435-2.068-1.096l-5.074-5.074c-0.977-0.977-0.977-2.559,0-3.535c0.976-0.977,2.56-0.977,3.535,0 l1.107,1.107V10.115l-1.107,1.107c-0.976,0.977-2.56,0.977-3.535,0c-0.977-0.977-0.977-2.559,0-3.535l5.313-5.313 c0.496-0.496,1.144-0.749,1.798-0.732c0.886,0.021,1.645,0.426,2.1,1.096l5.074,5.074c0.977,0.977,0.977,2.559,0,3.535 c-0.976,0.977-2.56,0.977-3.535,0l-1.107-1.107v114.18l1.107-1.107c0.976-0.977,2.56-0.977,3.535,0c0.977,0.977,0.977,2.559,0,3.535 l-5.313,5.313c-0.496,0.496-1.154,0.746-1.798,0.732C7.896,132.893,7.886,132.893,7.875,132.893z M149.41,125.82H28.597 c-1.381,0-2.5-1.119-2.5-2.5V4.143c0-1.381,1.119-2.5,2.5-2.5h72.194c1.381,0,2.5,1.119,2.5,2.5v48.523h46.118 c1.381,0,2.5,1.119,2.5,2.5v68.153C151.91,124.7,150.791,125.82,149.41,125.82z M103.184,120.82h43.726V57.666h-43.726V120.82z M55.292,120.82h42.893V87.332H55.292V120.82z M31.097,120.82h19.194V87.332H31.097V120.82z M52.792,82.332h45.393V55.166 c0-0.253,0.038-0.497,0.107-0.728V28.332H31.097v54H52.792z M67.141,23.332h31.151V6.643H67.141V23.332z M31.097,23.332h31.043 V6.643H31.097V23.332z"></path>
                            </svg>
                            <span>Planos</span>
                        </a>
                    </li>

                @endif
                <li>
                    <a href="#" data-id="property-child">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" viewBox="0 0 480 480" style="enable-background:new 0 0 480 480;"
                             xml:space="preserve">
                            <g>
                                <g>
                                    <path
                                        d="M472,76h-88V12c0-4.418-3.582-8-8-8H104c-4.418,0-8,3.582-8,8v112H8c-4.418,0-8,3.582-8,8v328c0,4.418,3.582,8,8,8 s8-3.582,8-8V140h80v328c0,4.418,3.582,8,8,8h272c4.418,0,8-3.582,8-8V92h80v368c0,4.418,3.582,8,8,8s8-3.582,8-8V84 C480,79.582,476.418,76,472,76z M232,460h-32v-72h32V460z M280,460h-32v-72h32V460z M368,460h-72v-80c0-4.418-3.582-8-8-8h-96 c-4.418,0-8,3.582-8,8v80h-72V20h256V460z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M184,36h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8V44C192,39.582,188.418,36,184,36z M176,84h-32V52h32V84z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M264,36h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8V44C272,39.582,268.418,36,264,36z M256,84h-32V52h32V84z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M344,36h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8V44C352,39.582,348.418,36,344,36z M336,84h-32V52h32V84z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M184,116h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8v-48C192,119.582,188.418,116,184,116z M176,164h-32v-32h32V164z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M264,116h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8v-48C272,119.582,268.418,116,264,116z M256,164h-32v-32h32V164z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M344,116h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8v-48C352,119.582,348.418,116,344,116z M336,164h-32v-32h32V164z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M184,196h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8v-48C192,199.582,188.418,196,184,196z M176,244h-32v-32h32V244z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M264,196h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8v-48C272,199.582,268.418,196,264,196z M256,244h-32v-32h32V244z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M344,196h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8v-48C352,199.582,348.418,196,344,196z M336,244h-32v-32h32V244z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M184,276h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8v-48C192,279.582,188.418,276,184,276z M176,324h-32v-32h32V324z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M264,276h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8v-48C272,279.582,268.418,276,264,276z M256,324h-32v-32h32V324z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M344,276h-48c-4.418,0-8,3.582-8,8v48c0,4.418,3.582,8,8,8h48c4.418,0,8-3.582,8-8v-48C352,279.582,348.418,276,344,276z M336,324h-32v-32h32V324z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M48,156h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C56,159.582,52.418,156,48,156z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M80,156h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C88,159.582,84.418,156,80,156z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M48,188h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C56,191.582,52.418,188,48,188z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M80,188h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C88,191.582,84.418,188,80,188z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M48,220h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C56,223.582,52.418,220,48,220z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M80,220h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C88,223.582,84.418,220,80,220z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M48,252h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C56,255.582,52.418,252,48,252z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M80,252h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C88,255.582,84.418,252,80,252z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M48,284h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C56,287.582,52.418,284,48,284z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M80,284h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C88,287.582,84.418,284,80,284z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M48,316h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C56,319.582,52.418,316,48,316z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M80,316h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C88,319.582,84.418,316,80,316z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M48,348h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C56,351.582,52.418,348,48,348z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M80,348h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C88,351.582,84.418,348,80,348z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M48,380h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C56,383.582,52.418,380,48,380z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M80,380h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C88,383.582,84.418,380,80,380z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M48,412h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C56,415.582,52.418,412,48,412z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M80,412h-8c-4.418,0-8,3.582-8,8v8c0,4.418,3.582,8,8,8h8c4.418,0,8-3.582,8-8v-8C88,415.582,84.418,412,80,412z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M440,108h-32c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h32c4.418,0,8-3.582,8-8v-32C448,111.582,444.418,108,440,108z M432,140h-16v-16h16V140z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M440,172h-32c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h32c4.418,0,8-3.582,8-8v-32C448,175.582,444.418,172,440,172z M432,204h-16v-16h16V204z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M440,236h-32c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h32c4.418,0,8-3.582,8-8v-32C448,239.582,444.418,236,440,236z M432,268h-16v-16h16V268z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M440,300h-32c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h32c4.418,0,8-3.582,8-8v-32C448,303.582,444.418,300,440,300z M432,332h-16v-16h16V332z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M440,364h-32c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h32c4.418,0,8-3.582,8-8v-32C448,367.582,444.418,364,440,364z M432,396h-16v-16h16V396z"></path>
                                </g>
                            </g> 
                        </svg>
                        <span>Propiedades Similares</span>
                    </a>
                </li>


                @if(isset($property->provider_matterport))

                    <li>
                        @foreach($property->provider_matterport as $matterport)
                            <a href="https://my.matterport.com/show/?m={{$matterport->video_id}}&amp;play=1&amp;qs=1"
                               class="fancybox btn-virtual-tour fancybox.iframe">
                                <svg height="512.00001pt" viewBox="0 0 512.00001 512.00001" width="512.00001pt"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m512 256c0-51-56.804688-94.171875-141.164062-114.832031-20.664063-84.363281-63.835938-141.167969-114.835938-141.167969s-94.171875 56.878906-114.871094 141.332031c-11.941406 2.960938-23.46875 6.398438-34.46875 10.300781-4.738281 1.742188-7.167968 7-5.425781 11.738282 1.714844 4.660156 6.835937 7.101562 11.535156 5.496094 7.707031-2.742188 15.761719-5.144532 23.972657-7.394532-11.632813 62.421875-11.632813 126.453125 0 188.871094-70.238282-19.316406-118.457032-54.773438-118.457032-94.34375 0-20.855469 13.769532-41.671875 39.066406-59.519531l-2.914062 15.039062c-.960938 4.957031 2.277344 9.753907 7.234375 10.714844h.003906c.578125.109375 1.164063.164063 1.746094.164063 4.375 0 8.136719-3.101563 8.972656-7.394532l7.375-38.082031c.960938-4.957031-2.277343-9.753906-7.234375-10.710937-.003906-.003907-.003906-.003907-.003906-.003907l-38.082031-7.378906c-4.933594-1.074219-9.804688 2.050781-10.878907 6.984375-1.078124 4.933594 2.046876 9.804688 6.980469 10.882812.140625.03125.285157.058594.425781.082032l17.902344 3.472656c-31.507812 21.660156-48.878906 48.203125-48.878906 75.75 0 51 56.804688 94.171875 141.164062 114.835938 20.710938 84.359374 63.835938 141.164062 114.835938 141.164062 28.34375 0 55.617188-18.421875 77.613281-51.730469l2.203125 18.195313c.605469 5.011718 5.164063 8.585937 10.175782 7.980468 5.015624-.605468 8.589843-5.160156 7.980468-10.175781l-4.671875-38.507812c-.601562-5.015625-5.15625-8.589844-10.167969-7.984375-.003906 0-.011718 0-.015624 0l-38.507813 4.683594c-5.015625.609374-8.585937 5.167968-7.972656 10.183593.609375 5.015625 5.167969 8.582031 10.183593 7.972657l15.214844-1.828126c-18.40625 27.65625-40.183594 42.925782-62.035156 42.925782-39.570312 0-75.027344-48.21875-94.34375-118.417969 31.101562 5.878906 62.691406 8.792969 94.34375 8.703125 31.714844.089844 63.367188-2.835938 94.527344-8.742188-2.25 8.230469-4.664063 16.265626-7.394532 23.972657-1.632812 4.78125.921876 9.976562 5.699219 11.605469 4.699219 1.605468 9.820313-.835938 11.535157-5.496094 3.902343-10.972656 7.3125-22.527344 10.292968-34.46875 84.460938-20.699219 141.339844-63.835938 141.339844-114.871094zm-256-237.714844c39.570312 0 75.027344 48.210938 94.34375 118.417969-31.101562-5.878906-62.691406-8.792969-94.34375-8.703125-31.671875-.078125-63.277344 2.886719-94.382812 8.851562 19.300781-70.28125 54.785156-118.566406 94.382812-118.566406zm0 347.429688c-33.371094.082031-66.65625-3.414063-99.28125-10.433594-13.933594-65.507812-13.933594-133.21875 0-198.726562 65.46875-13.746094 133.082031-13.691407 198.527344.164062 7.027344 32.625 10.539062 65.90625 10.46875 99.28125.105468 33.351562-3.335938 66.621094-10.265625 99.246094-32.679688 7.039062-66.019531 10.546875-99.449219 10.46875zm119.140625-15.324219c5.972656-31.105469 8.9375-62.714844 8.859375-94.390625.089844-31.652344-2.824219-63.242188-8.703125-94.34375 70.199219 19.316406 118.417969 54.773438 118.417969 94.34375s-48.285156 75.082031-118.574219 94.390625zm0 0"></path>
                                    <path
                                        d="m337.582031 197.652344c-1.414062-3.417969-4.742187-5.648438-8.4375-5.652344h-118.859375c-2.878906 0-5.585937 1.355469-7.3125 3.65625l-27.429687 36.570312c-.164063.296876-.308594.605469-.4375.914063-.339844.539063-.609375 1.113281-.816407 1.710937-.1875.59375-.308593 1.207032-.363281 1.828126-.09375.339843-.164062.683593-.210937 1.035156v54.855468c0 5.050782 4.09375 9.144532 9.140625 9.144532h36.574219c2.421874 0 4.75-.964844 6.460937-2.679688l11.824219-11.820312 11.820312 11.820312c1.714844 1.714844 4.039063 2.679688 6.464844 2.679688h36.570312c2.425782-.011719 4.753907-.980469 6.472657-2.6875l36.574219-36.574219c1.707031-1.710937 2.667968-4.035156 2.667968-6.453125v-54.855469c-.003906-1.199219-.246094-2.386719-.703125-3.492187zm-122.726562 12.632812h92.21875l-18.289063 18.285156h-87.640625zm29.324219 57.535156c-3.570313-3.566406-9.359376-3.566406-12.929688 0l-15.605469 15.609376h-23.644531v-36.574219h91.429688v36.574219h-23.644532zm57.535156 2.679688v-29l18.285156-18.285156v29zm0 0"></path>
                                </svg>
                                <span>Matterport</span>
                            </a>
                        @endforeach


                    </li>
                @endif

            </ul>
        </div>
        <!-- Single Property Navigation Section -->


        <!-- Single Property Content Section -->
        <div class="casaroyal-section">

            <div class="container">

                <!-- Description -->
                <div id="property-description" class="row active">
                    <div class="col-md-12">
                        <div class="casaroyal-property-types">
                            <!-- <span class="property-type">Casa en Venta </span> en Nordelta -->
                            <h2 class="casaroyal-property-title"><!-- {{$property->type->name}} -->{{$property->publication_title}}
                               <!-- en  {{$property->operations[0]->operation_type}}  , {{$property->location->name}}--></h2>
                        </div>
                        <!-- // ICONOS -->
                        <div class="property-meta" style="margin-bottom:3em">

                            @include('frontend.property.includes.partials.icons_detail')

                        </div>
                        <!-- ICONOS  -->
                    </div>
                    <div class="col-md-7">


                        <div class="property-price single-page-property-price">
                            <span class="price-prefix"></span>



                            @if($property->operations[0]->prices[0]->price == 1)
                                <span class="property-price-holder">CONSULTAR</span>
                            @else

                                <span class="property-price-holder">{{$property->operations[0]->prices[0]->currency == "USD"? "U\$D ": "$" }} <span
                                        class="property-price-number">{{$property->operations[0]->prices[0]->price}}</span>
                                {{--<span class="property-price-number">Apto Crédito</span>--}}
                            </span>
                            @endif
                            <span class="price-prefix"></span>
                            <div class="property-id" style="font-size: 0.5em"> ID-Prop :
                                <b>{{$property->reference_code}}</b>
                                {{--shared-page--}}
                                <span class="property-creation-date-holder pull-right "
                                      style="color: #a71b20">
                                    <a href="https://api.whatsapp.com/send?text=Mirá%20te%20comparto%20esta%20propiedad%20{{Request::fullUrl()}}"
                                       target="_blank"> Compartir <i class="fa fa-share" style="margin-right: 5px"></i>

                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="property-creation-date">
                            <span
                                class="property-creation-date-holder">  Antigüedad: <b>{{$property->age_name}} </b>
                            </span>
                            <span class="property-creation-date-holder pull-right print-page" style="color: #a71b20">
                                     Imprimir <i class="fa fa-print"></i>
                                </span>
                        </div>

                        <div class="property-creation-date">


                        </div>

                        <div class="property-address-content" style="text-align: justify;">
                            {!! nl2br(e($property->description)) !!}
                        </div>
                        <!-- DESCRIPCION -->
                    </div>
                    <div class="col-md-5">
                        <div id="casaroyal-property-agent" class="property-agent">

                            <div class="property-agent-holder">
                                <div class="property-agent-image">
                                    <figure>
                                        <!-- logo-mieres-ficha.jpg -->
                                        <a href="{{asset('images/agent-avatar.jpg')}}">
                                            <img src="{{asset('images/agent-avatar.jpg')}}" alt="">
                                        </a>
                                    </figure>
                                </div>
                                <div class="property-agent-details">

                                    <h3 style="margin-bottom: 0px; font-size: 1.5em">{{$property->branch->name}}</h3>
                                    <ul class="property-agent-contacts-list">
                                        <li class="office"><span>Teléfono:</span> {{$property->branch->phone ?? ''}}
                                        </li>
                                        <li class="mobile">
                                            <span>Whatsapp:</span> {{($branch->whatsapp == '') ? $branch->branch->whatsapp : $branch->whatsapp}}
                                        </li>

                                    </ul>


                                </div>
                            </div>
                        </div>


                        <h3 class="entry-title" id="contacto">Consultá por esta propiedad.</h3>
                        <div class="property-contact-agent">
                            <form id="property-contact-agent-form">
                                <input type="text" name="name" placeholder="Nombre Completo" class="name required" title="* Por favor complete el campo con su nombre">
                                <input type="text" name="phone" placeholder="Celular" class="phone required" title="* Por favor complete su telefono de contacto">
                                <input type="text" name="email" placeholder="Email" class="email required" title="* Por favor complete el campo con su email de contacto">
                                <textarea rows="9" name="message" class="required" placeholder="Escribe tu mensaje" title="* Por favor complete con algun mensaje"></textarea>
                                <div class="submit-require-showing-property-form">
                                    <a onclick="ga('send', 'event', '​​Contacto', 'Click', '​​Formulario_Enviado');" id="contact-agent-button" class="submit-showing-request-button">Enviar
                                        mi consulta</a>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="property-address-content">
                            <p>Lindísima casa en venta en barrio La Escondida de Manzanares.</p>
                            <p>
                                Comodidades: hall de recepción, living con barra, toilette, family, playroom y comedor principal, gran cocina con comedor de diario, lavadero, dependencias de servicio con baño. 2 dormitorios con placards y un baño. Suite junior con vestidor y baño, suite principal con vestidor y baño.</p>
                            <p>Afuera: galería doble con parrilla. Gran jardín con riego. Pileta. Cochera cubierta para 2 autos.</p>
                            <p>Aberturas de madera. Termo tanque. Pisos de cerámicos. Aire acondicionado (3 equipos) en living, cocina, suite principal. Resto dormitorios ventiladores de techo. Caldera y radiadores.</p>
                               <p>Año 2003, refacción en 2015.<br>
                               Contacto: pilar54@mieres.com.ar / 0230-4374111 <br>
                               Cristián Mieres. C.M.C.P.S.I. Nº 5151<Br>
                               </p>
                               <p>Se deja aclarado que las informaciones contenidas en esta publicación podrían haber sufrido alguna modificación o corrección entre su lanzamiento y el tiempo de su visualización por el consumidor.</p>
                        </div> -->
                    </div>

                    <!-- Amenities -->
                    <div id="amenities" class="row active">
                        <div id="casaroyal-property-amenities" class="additional-title">Información Básica</div>
                        <div class="features">
                            <ul>
                                <li>
                                    <strong>Dormitorios: </strong>
                                    <span>{{$property->suite_amount}}</span>
                                </li>
                                <li>
                                    <strong>Ambientes: </strong>
                                    <span>{{$property->room_amount}}</span>
                                </li>
                                <li>
                                    <strong>Baños: </strong>
                                    <span>{{$property->bathroom_amount}}</span>
                                </li>
                                <li>
                                    <strong>Toilletes: </strong>
                                    <span>{{$property->toilet_amount}}</span>
                                </li>
                                @if(($property->operations[0]->operation_type == 'Alquiler' || $property->operations[0]->operation_type == 'Alquiler temporario') && $property->expenses > 0)

                                    <li>
                                        <strong>Expensas: </strong>
                                        <span>$ {{$property->expenses}}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div id="casaroyal-property-amenities" class="additional-title">Superficies:</div>
                        <div class="features">
                            <ul>
                                <li>
                                    <strong>Superficie Cubierta: </strong>
                                    <span>{{$property->roofed_surface}} M²</span>

                                </li>
                                <li>
                                    <strong>Superficie semi-cubierta: </strong>
                                    <span>{{$property->semiroofed_surface}} M²</span>
                                </li>
                                <li>
                                    <strong>Superficie de Lote: </strong>
                                    <span>{{$property->surface}} M²</span>
                                </li>

                            </ul>
                        </div>
                        <div id="casaroyal-property-features" class="additional-title">Servicios</div>
                        <div class="features">
                            <ul>
                                @forelse ($property->tags_filter['servicios'] as  $tag)
                                    <li><a>{{$tag->name}}</a></li>
                                @empty
                                    <li>No hay servicios disponibles</li>
                                @endforelse
                            </ul>
                        </div>

                        <div id="casaroyal-property-features" class="additional-title">Ambientes</div>
                        <div class="features">
                            <ul>
                                @forelse ($property->tags_filter['ambientes'] as  $tag)
                                    <li><a>{{$tag->name}}</a></li>
                                @empty
                                    <li><a>No hay ambientes disponibles</a></li>
                                @endforelse

                            </ul>
                        </div>

                        <div id="casaroyal-property-features" class="additional-title">Adicionales</div>
                        <div class="features">
                            <ul>
                                @forelse ($property->tags_filter['adicionales'] as  $tag)
                                    <li><a>{{$tag->name}}</a></li>
                                @empty
                                    <li><a>No hay adicionales disponibles</a></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!-- Amenities -->
                </div>
                <!-- Description -->

                <!-- Subproperties -->
                <div id="property-child">

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="property-subtitle">Propiedades Similares</div>
                            <div class="row">

                                @if(count($starred_properties) > 0)

                                    @each('frontend.property.includes.item', $starred_properties, 'property', 'frontend.property.includes.empty')

                                @else

                                    <div class="col-md-12 property-list-item property-item-data clearfix">
                                        "Actualmente, no disponemos de propiedades similares.
                                        Lo invitamos a relizar otra búsqueda o bien, tomar contacto con la
                                        <a href="{{route('frontend.agent.branch')}}" style="color: red;">Sucursal</a>
                                        más cercana."
                                    </div>


                                @endif


                            </div>
                        </div>
                    </div>
                </div>
                <!-- Subproperties -->

                <!-- Gallery -->
                @if(isset($property->photo_normal))

                    <div id="property-photos">
                        <div id="casaroyal-property-gallery" class="property-subtitle">Fotos y Video de esta propiedad
                        </div>
                        <div class="property-gallery-wrapper">
                            <div class="property-gallery">
                                <div class="property-gallery-count">
                                    <div class="property-gallery-count-current">1</div>
                                    /<span><b>{{count($property->photo_normal)}}</b></span>
                                </div>
                                <div class="carousel-slider">


                                    @foreach ($property->photo_normal as $key => $photo)
                                        <div>
                                            <a href="{{$photo->image}}"
                                               data-lightbox="proeprty-gallery">
                                                <img src="{{$photo->image}}" alt=""/>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                @if(isset($property->provider_youtube))
                                    <div>

                                        @foreach ($property->provider_youtube as $video)

                                            <iframe width="100%" height="615"
                                                    src="https://www.youtube.com/embed/{{explode("&",$video->video_id)[0]}}?controls=0"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>

                                        @endforeach

                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

            @endif
            <!-- Gallery -->

            @if(isset($property->photo_plano))

                <!-- Floor Plans -->
                    <div id="property-floor-plans" class="floor-plans">
                        <div class="additional-title">Planos</div>
                        <div class="floor-plans-accordions">
                            <ul class="casaroyal-accordion">
                                @foreach ($property->photo_plano as $key => $photo)
                                    <li>
                                        <h4>
                                            Plano {{$key+1}}
                                        </h4>
                                        <div class="casaroyal-accordion-content">
                                            <div class="casaroyal-accordion-content-inside">
                                                <div class="floor-plan-content">
                                                    <div class="floor-plan-desc">
                                                        <p>{{ $photo->description }}</p>
                                                    </div>
                                                    <div class="floor-plan-map">
                                                        <a data-lightbox="gallery-1" href="{{$photo->original}}">
                                                            <img src="{{$photo->original}}" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Floor Plans -->
            @endif


            <!-- Location -->
                <div id="location" class="row active">


                    <div id="casaroyal-property-address" class="property-address">

                        <div class="property-address-title">Ubicación de esta propiedad</div>

                        <div class="map-wrap clearfix">

                            <div class="google_map_poi_marker">
                                {{--<div class="google_poi" id="transport" data-toggle="tooltip" data-placement="top"--}}
                                {{--data-original-title="Transport">--}}
                                {{--<i class="fa fa-car" aria-hidden="true"></i>--}}
                                {{--</div>--}}
                                {{--<div class="google_poi" id="supermarkets" data-toggle="tooltip" data-placement="top"--}}
                                {{--data-original-title="Supermarkets">--}}
                                {{--<i class="fa fa-shopping-cart" aria-hidden="true"></i>--}}
                                {{--</div>--}}
                                {{--<div class="google_poi" id="schools" data-toggle="tooltip" data-placement="top"--}}
                                {{--data-original-title="Schools">--}}
                                {{--<i class="fa fa-university" aria-hidden="true"></i>--}}
                                {{--</div>--}}
                                {{--<div class="google_poi" id="restaurant" data-toggle="tooltip" data-placement="top"--}}
                                {{--data-original-title="Restaurants">--}}
                                {{--<i class="fa fa-cutlery" aria-hidden="true"></i>--}}
                                {{--</div>--}}
                                {{--<div class="google_poi" id="pharma" data-toggle="tooltip" data-placement="top"--}}
                                {{--data-original-title="Pharmacies">--}}
                                {{--<i class="fa fa-medkit" aria-hidden="true"></i>--}}
                                {{--</div>--}}
                                {{--<div class="google_poi" id="hospitals" data-toggle="tooltip" data-placement="top"--}}
                                {{--data-original-title="Hospitals">--}}
                                {{--<i class="fa fa-hospital-o" aria-hidden="true"></i>--}}
                                {{--</div>--}}
                            </div>

                            <div id="property_map"></div>

                            <input type="hidden" id="property_map_lat" value="{{$property->geo_lat}}">
                            <input type="hidden" id="property_map_lang" value="{{$property->geo_long}}">
                            <input type="hidden" id="map_pin" value="{{asset('images/map-pin.svg')}}">
                            <input type="hidden" id="template_directory_url" value="/">

                        </div>

                    </div>

                    @include('frontend.property.includes.partials.environment')
                </div>
                <!-- Location -->


                <div id="casaroyal-property-features" class="additional-title">Aviso Legal</div>
                <small>Se deja aclarado que las informaciones contenidas en estas publicación podrían haber sufrido
                    alguna modificación o corrección entre su lanzamiento y el tiempo de su visualización por el
                    consumidor, por lo que nos ponemos a su disposición por cualquier confirmación de información que
                    fuera de su interés, no implicando las fotos, renders, descripciones, menciones, valores, fechas de
                    entrega, etc. del presente anuncio ningún compromiso u oferta en firme, reservándose la empresa y/o
                    los propietarios de los inmuebles el derecho de ampliar, corregir y/o modificar los datos vertidos
                    en este publicación. Por cualquier consulta, por favor comunicarse al teléfono que figura en los
                    datos de contacto.
                </small>


            </div>

        </div>
        <!-- Single Property Content Section -->


        <!-- Relates Properties Section -->
    {{--<div class="casaroyal-section">--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<h2>Propiedades Similares</h2>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--@each('frontend.property.includes.partials.similarly', $starred_properties, 'property', 'frontend.property.includes.empty')--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- Relates Properties Section -->
    </div>
@endsection

@section('after-scripts')
    {{--<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>--}}
    <script src="https://unpkg.com/sweetalert2@7.20.3/dist/sweetalert2.all.js"></script>

    <script src="{{asset('js/printPage.js')}}"></script>

    <script defer>
        if (document.getElementById('ref-img')) {
            var alturaImagen = document.getElementById('ref-img').height;
        }
        if (document.getElementById('ref')) {
            document.getElementById('ref').style.height = alturaImagen + 'px';
        }
        if (document.getElementById('description')) {
            function description() {
                document.getElementById('description').scrollIntoView({block: 'start', behavior: 'smooth'})
            }
        }

        jQuery(".shared-page").click(function () {

            FB.ui(
                {
                    method: 'share_open_graph',
                    action_type: 'og.shares',
                    action_properties: JSON.stringify({
                        object: {
                            'og:url': location.href,
                            'og:title': document.querySelector('.casaroyal-property-title').textContent.trim() || '',
                            'og:description': document.querySelector('.property-address-content').textContent.trim().substr(0, 150) || '',
                            'og:image': document.querySelector('#ref-img').src || '',
                        }
                    }),
                },
            );
            return false;
        })

    </script>
    <script src="{{asset('js/form_contact_4.js')}}" type="text/javascript"></script>
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '494490990968831',
                autoLogAppEvents: true,
                xfbml: true,
                version: 'v2.7',
            });
            FB.AppEvents.logPageView();
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection
