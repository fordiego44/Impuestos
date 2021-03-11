@extends('frontend.layouts.app')

@section('content')
@include('frontend.layouts.header1')
<style>
    input:not([href]):not([tabindex]):focus, input:not([href]):not([tabindex]):hover {
        color: inherit;
        text-decoration: none;
    }
</style>
<div class="pxp-content">
    <div class="pxp-agents pxp-content-wrapper ">   
        <div class="pxp-agents-hero mb-200">
            <div class="pxp-agents-hero-fig pxp-cover" style="background-image: url(images/properties/prop-1-1-big.jpg); background-position: 50% 50%;"></div>

            <div class="pxp-agents-hero-search-container">
                <div class="container">
                    
                    <div class="pxp-agents-hero-search">
                        <h2 class="pxp-section-h2">Buscá tu propiedad.</h2>
                        <div class="pxp-agents-hero-search-form mt-3 mt-md-4">
                            <form  id="form-first" role="form" action={{route('frontend.property.list')}} method="get">
                        
                                <div class="row">
                                
                                        <div class="col-lg-3 col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label for="pxp-agents-search-location">Tipo de Operación</label>
                                                <select class="custom-select" name="tipo_operacion" id="select-property-type"  >
                                                    <option value="" selected="selected" disabled>Seleccioná...</option>
                                                    @foreach (\App\Models\Property::PROPERTIES_OPERATIONS_INDEX as $key => $operation_types)
                                                        <option value="{{$key}}">{{$operation_types}}</option>
                                                    @endforeach
                                                    <!--<option value="1" selected="selected">Quiero Comprar</option>
                                                    <option value="2">Quiero Alquilar</option>
                                                    <option value="3">Alquiler Temporal</option>-->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label for="pxp-agents-search-name">Tipo de Propiedad</label>
                                                <select class="custom-select" id="tipo_propiedad" name="tipo_propiedad">
                                                    <option value="" disabled selected="selected">Seleccioná...</option>

                                                        @foreach (\App\Models\Property::PROPERTIES_TYPES_INDEX as $key => $property_type)
                                                            <option value="{{$key}}">{{$property_type}}</option>
                                                        @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <!-- SOLO DEBE TRAER TODAS LAS SUBLOCALIDADES Y BARRIOS Y COUNTRIES DE PILAR, QUE TENGAN ASOCIADAS PROPIEDAES, Y HACER LO QUE SE HIZO EN MIERES, DE BAJAR LOS EMPRENDOMIENTOS Y TRAELOS. -->
                                        <div class="col-lg-4 col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label for="pxp-agents-search-service">Barrio o Condominio</label>
                                            <!--  <select class="custom-select" id="pxp-agents-search-service">
                                                    <option value="1" selected="selected">Ayres de Pilar</option>
                                                    <option value="2">Pilará</option>
                                                    <option value="3">Olivos Golf Club</option>
                                                </select> -->
                                                    
                                                <input type="hidden" name="location" value="25127">

                                                <input type="text" name="sublocation" class="casaroyal-search-keyword form-control pxp-is-address" id="location-search" placeholder="Tipea un barrio cerrado o emprendimiento" autocomplete="off">
                                                <ul class="casaroyal-search-locations-list" id="location-search-list">  </ul>
                                                <!--<input type="text" class="form-control pxp-is-address" placeholder="Tipea un barrio cerrado o emprendimiento" id="pxp-p-search-address">-->
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-2">
                                            <span class=" pxp-primary-cta"> 
                                                <input href="javascript:;" id="find-properties"  type="submit" value="Buscar" class=" pxp-primary-cta-a text-uppercase mt-5 pxp-animate"  />

                                            </span>
                                         </div> 
                                
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <!-- <div class="container-fluid pxp-props-carousel-right pxp-has-intro mt-100 pt-100 mb-100">
            <div class="pxp-props-carousel-right-intro">
                <h2 class="pxp-section-h2">Propiedades vistas hace poco.</h2>
                <p class="pxp-text-light">Aquí podrás ver las propiedades que te han interesado.</p>
                
            </div>
        <div class="pxp-props-carousel-right-container mt-4 mt-md-5 mt-lg-0">
            <div class="owl-carousel pxp-props-carousel-right-stage-1">
                <div>
                    <a href="single-property.html" class="pxp-prop-card-1 rounded-lg">
                        <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url(images/post-2.jpg);"></div>
                        <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                        <div class="pxp-prop-card-1-details">
                            <div class="pxp-prop-card-1-details-title">Casa en Venta en Ayres de Pilar</div>
                            <div class="pxp-prop-card-1-details-price">u$d 145,000</div>
                            <div class="pxp-prop-card-1-details-features text-uppercase">2 DOR <span>|</span> 2 BAÑ <span>|</span> 920 m²</div>
                        </div>
                        <div class="pxp-prop-card-1-details-cta text-uppercase">Ver Propiedad</div>
                    </a>
                </div>

               
            </div>
        </div> -->

    </div>



    </div>
</div>
@endsection
@section('after-scripts')
   <script src="{{asset('js/location_search.js')}}"></script> 
   <script src="{{asset('js/app_index.js')}}"></script>

   <script>
       
        jQuery('.casaroyal-search-keyword').focus(function () {
            jQuery('.casaroyal-search-locations-list').fadeIn(50);
        });

        jQuery('.casaroyal-search-keyword').focusout(function () {
            jQuery('.casaroyal-search-locations-list').fadeOut(150);
        });
   </script>
@endsection