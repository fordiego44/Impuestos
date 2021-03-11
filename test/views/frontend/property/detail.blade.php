@extends('frontend.layouts.app') 

 @section('content')
 @include('frontend.layouts.header1') 
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
    <div class="pxp-content">
        <div class="pxp-single-property-top pxp-content-wrapper mt-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        <h2 class="pxp-sp-top-title">{{$property->publication_title}}</h2>
                      
                        <p class="pxp-sp-top-address pxp-text-light">{{ implode(', ',array_reverse(explode(" | ",$property->location->short_location))) }}</p>
                        <div class="pxp-sp-top-price mt-3 mt-md-0">
                            @if($property->operations[0]->prices[0]->price == 1)
                            <span class="property-price-holder">CONSULTAR</span>
                            @else

                                <span class="property-price-holder">{{$property->operations[0]->prices[0]->currency == "USD"? "U\$D ": "$" }} <span
                                        class="property-price-number"> {{$property->operations[0]->prices[0]->price}}</span></span>
                                <span class="price-prefix"></span>

                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <div class="pxp-sp-top-btns mt-2 mt-md-0 hide">
                            <a 
                                href="https://wa.me/5491151856532?text=Me interesa saber más de esta propiedad: {{$property->publication_title}}  "
                                target="_blank"  class="pxp-sp-top-btn"><span class="fa fa-whatsapp"></span> </a>
                            <div class="dropdown">
                                <a class="pxp-sp-top-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fa fa-share-alt"></span> Compartir esta propiedad
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#"><span class="fa fa-whatsapp"></span> Whatsapp</a>
                                    <a class="dropdown-item" href="#"><span class="fa fa-facebook"></span> Facebook</a> 
                                    <a class="dropdown-item" href="#"><span class="fa fa-pinterest"></span> Pinterest</a> 
                                </div>
                            </div>
                        </div>  
                        <div class="clearfix d-block d-xl-none"></div>
                        <div class="pxp-sp-top-feat mt-3 mt-md-0 ">

                            <!-- baños -->
                            
                            
                            @if ($property->type->name == 'Terreno' || $property->type->name == 'Lote')
                                <div><i class="fas fa-ruler-combined"></i> {{$property->surface}}<span> m² de Lote</span></div> 
                            @elseif($property->type->name == 'Local')
                                <div>{{$property->parking_lot_amount}} <span>  <i class="fas fa-shower"> </i> Cochera </span> </div> 
                                <div>{{$property->bathroom_amount}} <span>  <i class="fas fa-shower"> </i> Baños </span> </div>
                                <div>Sup. Cubierta <span>{{$property->roofed_surface}} m²<span></div>
                                <div>Sup. Total<span>{{$property->total_surface}} m²<span></div> 
                             @else 
                                <div>{{$property->bathroom_amount}} <span>  <i class="fas fa-shower"> </i> Baños </span> </div>
                                <div>{{$property->room_amount}} <span><i class="fas fa-bed"></i> Dormitorios</span> </div>
                                <div>{{$property->suite_amount}} <span><i class="fas fa-vector-square"></i> Ambientes</span> </div>
                                <div>Sup. Cubierta <span>{{$property->roofed_surface}} m²<span></div>
                            @endif
                            
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
 
        <div class="pxp-single-property-gallery-container mt-4 mt-md-5">
            <div class="pxp-single-property-gallery" itemscope itemtype="http://schema.org/ImageGallery"> 
                @if(isset($property->provider_youtube)) 
                    @foreach ($property->provider_youtube as $video) 
                        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"; class="pxp-sp-gallery-main-img">
                            <a href="javascript:void(0);" itemprop="contentUrl" data-size="1920x1280" class="pxp-cover" style="background-image: url({{$property->photos[0]->image}});" data-video="https://www.youtube.com/embed/{{explode("&",$video->video_id)[0]}}"></a>;
                        </figure>        
                    @endforeach
                @else 
                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"; class="pxp-sp-gallery-main-img">
                        <a href={{$property->photos[0]->image}} itemprop="contentUrl" data-size="1920x1280" class="pxp-cover" style="background-image: url({{$property->photos[0]->image}});" ></a>;
                        <figcaption itemprop="caption description">Image caption</figcaption>

                    </figure>
                @endif
                @foreach ($property->photos as $key => $photo) 
                    @if ($key < 4)
                        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href={{$photo->image}} itemprop="contentUrl" data-size="1920x1459" class="pxp-cover" style="background-image: url({{$photo->image}});"></a>
                            <figcaption itemprop="caption description">Image caption</figcaption>
                        </figure>
                    @else
                        <figure itemprop="associatedMedia" style="display: none" itemscope itemtype="http://schema.org/ImageObject">
                            <a href={{$photo->image}} itemprop="contentUrl" data-size="1920x1459" class="pxp-cover" style="background-image: url({{$photo->image}});"></a>
                            <figcaption itemprop="caption description">Image caption</figcaption>
                        </figure>
                    @endif
                    
                @endforeach 
            </div>
            <a href="#" class="pxp-sp-gallery-btn">Ver todas las fotos</a>
            <div class="clearfix"></div>
        </div>
        
        
        <div class="container mt-100">
            <div class="row">
                <div class="col-lg-8">
                    <div class="pxp-single-property-section">

                        <h3>Detalles e Información técnica </h3>
                        <div class="row mt-3 mt-md-4">
                            <div class="col-sm-6 col-lg-4">
                                <div class="pxp-sp-key-details-item">
                                    <div class="pxp-sp-kd-item-label text-uppercase">Antiguedad</div>
                                    <div class="pxp-sp-kd-item-value">{{$property->age_name}} años</div>
                                    <!-- si es 0 en tokko -> A estrenar -->
                                </div>
                            </div>
                            <!-- sin es casa -> mostrar dormitorios -->
                            <div class="col-sm-6 col-lg-4">
                                <div class="pxp-sp-key-details-item">
                                    <div class="pxp-sp-kd-item-label text-uppercase">Dormitorios</div>
                                    <div class="pxp-sp-kd-item-value">{{$property->suite_amount}} </div>
                                </div>
                            </div>
                            <!-- sin es departamento -> mostrar ambientes -->
                            <div class="col-sm-6 col-lg-4">
                                <div class="pxp-sp-key-details-item">
                                    <div class="pxp-sp-kd-item-label text-uppercase">Ambientes</div>
                                    <div class="pxp-sp-kd-item-value">{{$property->room_amount}}</div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-4">
                                <div class="pxp-sp-key-details-item">
                                    <div class="pxp-sp-kd-item-label text-uppercase">Baños </div>
                                    <div class="pxp-sp-kd-item-value">{{$property->bathroom_amount}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="pxp-sp-key-details-item">
                                    <div class="pxp-sp-kd-item-label text-uppercase">Cochera</div>
                                    <div class="pxp-sp-kd-item-value">{{$property->parking_lot_amount}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="pxp-sp-key-details-item">
                                    <div class="pxp-sp-kd-item-label text-uppercase">Pileta</div>
                                    <div class="pxp-sp-kd-item-value">Sí</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pxp-single-property-section mt-60">
                        <h3>Superficies de la propiedad </h3>
                        <div class="row mt-3 mt-md-4">
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="pxp-sp-key-details-item">
                                    <div class="pxp-sp-kd-item-label text-uppercase">Sup. de Lote</div>
                                    <div class="pxp-sp-kd-item-value">{{$property->surface}} m²</div>
                                    
                                </div>
                            </div>
                        
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="pxp-sp-key-details-item">
                                    <div class="pxp-sp-kd-item-label text-uppercase">Sup. Cubierta</div>
                                    <div class="pxp-sp-kd-item-value">{{$property->roofed_surface}} m² </div>
                                </div>
                            </div>
                            
                        <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="pxp-sp-key-details-item">
                                    <div class="pxp-sp-kd-item-label text-uppercase">Sup. Semi-Cubierta</div>
                                    <div class="pxp-sp-kd-item-value">{{$property->roofed_surface}} m²</div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    

                    <div class="pxp-single-property-section mt-4 mt-md-5 ">
                        <h3>Descripción de la Propiedad</h3>
                        <div class="mt-3 mt-md-4">
                            <!--count(explode(" ",$property->description)) el campo de descripcion debe respetar los saltos de linea -->
                            
                            <p>{!! nl2br(e(substr($property->description, 0,  1000))) !!}
                                <span class="pxp-dots">...</span>
                                <span class="pxp-dots-more">
                                    {!! nl2br(e(substr($property->description,  1000))) !!}
                                </span>
                            </p>
                            <a href="#" class="pxp-sp-more text-uppercase">
                                <span class="pxp-sp-more-1">Ver más 
                                    <span class="fa fa-angle-down"></span>
                                </span>
                                <span class="pxp-sp-more-2">Ver menos
                                    <span class="fa fa-angle-up"></span>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="pxp-single-property-section mt-4 mt-md-5">
                        <h3>Amenities y Servicios</h3>
                        <div class="row mt-3 mt-md-4">
                             
                            @foreach ($property->tags_filter['servicios'] as  $tag)
                                <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check" style="color:green"></span> {{$tag->name}}</div>
                                </div>
                            @endforeach    
                            @foreach ($property->tags_filter['ambientes'] as  $tag)
                                <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check" style="color:green"></span> {{$tag->name}}</div>
                                </div>
                            @endforeach 
                            @foreach ($property->tags_filter['adicionales'] as  $tag)
                                <div class="col-sm-6 col-lg-4">
                                    <div class="pxp-sp-amenities-item"><span class="fa fa-check" style="color:green"></span> {{$tag->name}}</div>
                                </div>
                            @endforeach
                             
                        </div>
                    </div>

                    <div class="pxp-single-property-section mt-4 mt-md-5 mb-60">
                        <h3>Google Maps</h3>
                        
                        <div id="pxp-sp-map" class="mt-3"></div>
                    </div>

                    

                    
                </div>
                <div class="col-lg-4">
                    
                        

                        <div class="pxp-single-property-section pxp-sp-agent-section mt-4 mt-md-5 mt-lg-0">
                            <h2 class="pxp-section-h2">Te gusto esta propiedad?</h2>

                            <div class="pxp-sp-agent mt-3 mt-md-4">
                                
                                <div class="pxp-sp-agent-info">
                                    <div class="pxp-sp-agent-info-name">Completá el formulario para que nuestros asesores comerciales tomen contacto con vos.</div>
                                </div> 
                                <form id="property-contact-agent-form"> 
                                    <div class="pxp-contact-form mt-3 mt-md-4">
                                    <div class="row">
                                    <form id="property-contact-agent-form"> 
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control name required" name="name" id="pxp-contact-form-name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control email required" name="email" id="pxp-contact-form-email" placeholder="Email">
                                            </div>
                                        </div> 
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control phone required" name="phone" placeholder="Teléfono o Whatsapp" id="pxp-contact-form-phone">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12"> 
                                            <div class="form-group">
                                                <textarea class="form-control required" name="message" id="pxp-contact-form-message" rows="6" placeholder="Message"></textarea>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 col-md-12">  
                                            <a style="color:white" type="button" id="contact-agent-button" class="pxp-contact-form-btn">Enviar mi Consulta</a>
                                        </div>
                                    </form>
                                    </div>
                                    
                                
                                      
                                    </div>
                                   
                                <div class="pxp-sp-agent-btns mt-3 mt-md-4">
                                    <a href="https://wa.me/5491151856532" target="_blank" class="pxp-sp-agent-btn-main" ><span class="fa fa-whatsapp"></span> Whatsapp</a>
                                    <a href="#pxp-contact-agent" class="pxp-sp-agent-btn" data-toggle="modal" data-target="#pxp-contact-agent"><span class="fa fa-calendar-check-o"></span> Agendar Visita</a>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 mt-150m mt-100">
                                <a href="/barrio/studios" class="pxp-agents-1-item">
                                    <div class="pxp-agents-1-item-fig-container rounded-lg">
                                        <div class="pxp-agents-1-item-fig pxp-cover" style="background-image: url('/images/ayreshome/studio.jpg'); background-position: top 80%"></div>
                                    </div>
                                    <div class="pxp-agents-1-item-details rounded-lg">
                                        <div class="pxp-agents-1-item-details-name">Studios</div>
                                        <div class="pxp-agents-1-item-details-email"> Nuevos espacios a estrenar con excelente financiación.</div>
                                        <div class="pxp-agents-1-item-details-spacer"></div>
                                        <div class="pxp-agents-1-item-cta text-uppercase">Ver más de esto</div>
                                    </div>
                                    
                                </a>
                            </div>
                            </div>

                            
                        </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div> 
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pxp-contact-agent" tabindex="-1" role="dialog" aria-labelledby="pxpContactAgentModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="pxpContactAgentModal">Agendar tu Visita a esta propiedad.</h5>
                    <form class="mt-4" id="property-contact-agent-form-visita">
                        <div class="form-group">
                            <label for="pxp-contact-agent-name">Nombre Completo</label>
                            <input type="text" class="form-control" name='name-visita' id="pxp-contact-agent-name">
                        </div>
                        <div class="form-group">
                            <label for="pxp-contact-agent-email">Email</label>
                            <input type="text" class="form-control" name='email-visita' id="pxp-contact-agent-email">
                        </div>
                        <div class="form-group">
                            <label for="pxp-contact-agent-phone">Whatsapp</label>
                            <input type="text" class="form-control" name='phone-visita' id="pxp-contact-agent-phone">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label for="pxp-contact-agent-phone">Prefencia de Día</label>
                                    <select name='dia-visita' class="form-control">
                                        <option>Dia de semana </option>
                                        <option>Fin de Semana </option>
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label for="pxp-contact-agent-phone">Prefencia de Turno</label>
                                    <select name='turno-visita' class="form-control">
                                        <option>Por la mañana </option>
                                        <option>Por la tarde </option>
                                    </select>
                                </div>

                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="pxp-contact-agent-message">Mensaje</label>
                            <textarea class="form-control" name='message-visita' id="pxp-contact-agent-message" placeholder="De acuerdo a la pandemia, las visitas pueden estar sujetas a modificaciones sin previo aviso." rows="4"></textarea>
                        </div>
                        <div class="form-group mt-4">
                            <a  style="color:white" type="button" class="pxp-agent-contact-modal-btn" id="contact-agent-button-visita" >Solicitar una visita</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="pxp-signup-modal" tabindex="-1" role="dialog" aria-labelledby="pxpSignupModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="pxpSignupModal">Create an account</h5>
                    <form class="mt-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pxp-signup-firstname">First Name</label>
                                    <input type="text" class="form-control" id="pxp-signup-firstname" placeholder="Enter first name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pxp-signup-lastname">Last Name</label>
                                    <input type="text" class="form-control" id="pxp-signup-lastname" placeholder="Enter last name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pxp-signup-email">Email</label>
                            <input type="text" class="form-control" id="pxp-signup-email" placeholder="Enter your email address">
                        </div>
                        <div class="form-group">
                            <label for="pxp-signup-pass">Password</label>
                            <input type="password" class="form-control" id="pxp-signup-pass" placeholder="Create a password">
                        </div>
                        <div class="form-group">
                            <a href="#" class="pxp-agent-contact-modal-btn">Sign Up</a>
                        </div>
                        <div class="text-center mt-4 pxp-modal-small">
                            Already have an account? <a href="javascript:void(0);" class="pxp-modal-link pxp-signin-trigger">Sign in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 @endsection
 @section('after-scripts')
 
    <script src="https://unpkg.com/sweetalert2@7.20.3/dist/sweetalert2.all.js"></script> 
   
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiOnhhC5pWeHu9tdyO1A63v5vxkvlV8l0&amp;libraries=geometry&amp;libraries=places"></script>

    <script src="{{asset('js/photoswipe.min.js')}}"></script> 
    <script src="{{asset('js/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('js/jquery.sticky.js')}}"></script>
    <script src="{{asset('js/gallery.js')}}"></script>
    <script src="{{asset('js/infobox.js')}}"></script> 
    <script src="{{asset('js/single-map.js')}}"></script> 
    
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script src="{{asset('js/form_contact.js')}}" type="text/javascript"></script> 
    <script src="{{asset('js/form_contact_visita.js')}}" type="text/javascript"></script> 

 @endsection