<div class="pxp-content-side-search-form-adv mb-3" style="display: none;">
    <form class="advance-search-form clearfix ajax_load" method="get" id="filters-form"> 
        <div class="row pxp-content-side-search-form-row"> 
            <div class=" col-sm-6 col-md-4 col-lg-3 pxp-content-side-search-form-col">
                <div class="form-group">
                    <label for="pxp-p-filter-price-min">Tipo de Operación</label>
                    <select class="custom-select" name="operationType" id="operationType" data-action="tipo_operacion">
                        <option value="" selected="selected" disabled>Seleccioná...</option>
                        @foreach (\App\Models\Property::PROPERTIES_OPERATIONS as $key => $operation_types)
                            <option value="{{$key}}">{{$operation_types}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 pxp-content-side-search-form-col">
                <div class="form-group">
                    <label for="pxp-p-filter-price-min">Tipo de Propiedad</label>
                    <select class="custom-select propertyType" name="propertyType" id="propertyType" data-action="tipo_propiedad">
                        <option value="" disabled selected="selected">Seleccioná...</option>

                        @foreach (\App\Models\Property::PROPERTIES_TYPES_ORDER as $key => $property_type)
                                                    <option value="{{$key}}">{{$property_type}}</option>
                                                @endforeach
                    </select>
                </div>
            </div> 
            <div class="col-sm-6 col-md-4 col-lg-6 pxp-content-side-search-form-col">
                <div class="form-group">
                    <label for="pxp-p-filter-price-min" name='sublocation' id>Barrio o Emprendimiento</label> 
                    <input type="hidden" name="location" value="25127">

                    <input type="text"   data-action="sublocation" class="form-control pxp-is-address casaroyal-search-keyword" autocomplete="off" placeholder="Tipea un barrio cerrado o emprendimiento" id="data-location-search">
                        <ul class="casaroyal-search-locations-list" id="locations_data"></ul> 
                    </div>
            </div> 
            <div class="col-sm-6 col-md-4 col-lg-3 pxp-content-side-search-form-col">
                <div class="form-group">
                    <label for="pxp-p-filter-price-min">Rango de Precio</label>
                    <!-- // MOSTRAR ESTA OPCION CUANDO LA OPERRACION ES VENTA EN OFICINAS Y LOCALES, CASAS Y DEPARTAMENTOS Y LOTES -->
                    <!-- tipo de operacion en venta -->
                    <select class="custom-select propertyPriceArs" data-action='price' name="propertyPriceArs" id="propertyPriceArs">
                        <option value="" selected="selected">Da igual</option>

                        <option value="0">0 a 100.000 u$d</option>
                        <option value="10000">100.00 a 250.000 u$d</option>
                        <option value="250000">250.000 a 450.000 u$d</option>
                        <option value="450000">+ de 450.000 u$d</option>
                    </select>
                </div>
                 

            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 pxp-content-side-search-form-col">
                <!--//MOSTRAR SI ES CASA  // OCULTAR SI ES LOTE, OFICINA O LOCAL -->
                <div class="form-group">
                    <label for="pxp-p-filter-beds">Dormitorios</label>
                    <select data-action='suite' class="custom-select propertySuite" name="propertySuite" id="propertySuite">
                        <option value="" selected="selected">Da igual</option>

                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5+</option>
                    </select>
                </div>
            </div>
            <div class=" col-xs-6 col-sm-6 col-md-3 pxp-content-side-search-form-col">
                <!--//MOSTRAR SI ES DEPARTAMENTO /CULTAR SI ES LOTE, OFICINA O LOCAL -->
                <div class="form-group">
                    <label for="pxp-p-filter-beds">Ambientes</label>
                    <select data-action='room' class="custom-select propertyRoom" name="propertyRoom" id="propertyRoom">
                        <option value="" selected="selected">Da igual</option> 
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5+</option>
                    </select>
                </div>
            </div> 
            <!--//MOSTRAR SI ES DEPARTAMENTO  // OCULTA SI ES LOTE-->
            <div class="col-sm-6 col-md-3 pxp-content-side-search-form-col">

                <div class="form-group">
                    <label for="pxp-p-filter-beds">Baños</label>
                    <select data-action='bathroom' class="custom-select propertyBathroom" name="propertyBathroom" id="propertyBathroom">
                        <option value="" selected="selected">Da igual</option>

                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5+</option>
                    </select>
                </div>
            </div> 
            <!--//MOSTRAR SI ES LOTE CASA Y DEPARTAMENTO > tags de propiedad: al rio, al lago, con amarra, con pileta, -->
            <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">

                <div class="form-group">
                    <label for="pxp-p-filter-type">Preferencias</label>
                    <select class="custom-select" >
                        <option value="" selected="selected">Da igual</option>

                        <option value="">Al Lago</option>
                        <option value="">Al Rio</option>
                        <option value="">Con Pileta</option>
                        <option value="">Con Amarra</option>
                        <option value="">Al Golf</option>
                    </select>
                </div>
            </div> 
            <!--//MOSTRAR SOLO PARA LOTES  // OCULTAR SI ES DEPARTAMENTO/CASA/OFICINA // usar rangos de tokko -->
            <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                <div class="form-group">
                    <label for="pxp-p-filter-size-min">Superficie de lote (m²)</label>
                    <select data-action='surface' class="custom-select propertySurface" name="propertySurface" id="propertySurface">
                        <option value="" selected="selected">Da igual</option> 
                        <option value="0-500">Hasta 500 m²</option>
                        <option value="501-1000">de 500 a 1000 m²</option> 
                        <option value="1001-100000">+1000 m²</option>

                    </select>
                    <!-- <input type="text" class="form-control" id="pxp-p-filter-size-min" placeholder="Min"> -->
                </div>
            </div> 
            <!--//MOSTRAR SOLO PARA OFICINAS Y LOCALES  // OCULTAR SI ES LOTE CASAS Y DPTOS //  usar rangos de tokko -->
            <div class="col-sm-6 col-md-4 pxp-content-side-search-form-col">
                <div class="form-group">
                    <label for="pxp-p-filter-size-min">Superficie Cubierta (m²)</label>
                    <select data-action='roofed_surface' class="custom-select propertyRoofedSurface" mame='propertyRoofedSurface' id="propertyRoofedSurface">
                        <option value="" selected="selected">Da igual</option>

                        <option value="0-500">Hasta 500 m²</option>
                        <option value="501-1000">de 500 a 1000 m²</option>
                        <option value="1001-2000">1000 a 2000 m²</option>
                        <option value="2001-100000">+2000 m²</option>

                    </select>
                    <!-- <input type="text" class="form-control" id="pxp-p-filter-size-min" placeholder="Min"> -->
                </div>
            </div> 
        </div> 
        <a type="submit" class="pxp-filter-btn" id='filter-sidebar' data-action="filter_properties" style="color: white" > Aplicar </a>
    </form>     
</div>