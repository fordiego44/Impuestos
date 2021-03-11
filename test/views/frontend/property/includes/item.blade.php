
<div class="col-sm-12 col-md-6 col-xl-4 property-list-item property-item-data">
    <a href="{{ route('frontend.property.detail' , ['sluglify' => $property->id . '-' .$property->title_href]) }}" class="pxp-results-card-1 rounded-lg" data-prop="1">
        <div id="card-carousel-1" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active overlay"
                    @if ($property->photos!=null)
                        style="background-image: url({{$property->photos[0]->image}});"
                    @else
                        style="background-image: url({{asset('images/properties/property-2.jpg')}});"
                    @endif >
                </div> 
            </div> 
        </div>
        <div class="pxp-results-card-1-gradient"></div>
        <div class="pxp-results-card-1-details">
            <div class="pxp-results-card-1-details-title" style="white-space: none;">{{$property->publication_title}}
                <!-- (tipo de propiedad) en (tipo de operacion) en (sublocation)-->
            </div>
            <div class="pxp-results-card-1-details-price">
              <!--u$d 890,000--> 
                @if ($property->operations[0]->prices[0]->price=="1")
                    CONSULTAR PRECIO | 
                @else
                    {{$property->operations[0]->prices[0]->currency == "USD"? "u\$d" : "$"}}
                @endif
                <span class="property-price-number">{{($property->operations[0]->prices[0]->price != "1") ? $property->operations[0]->prices[0]->price : '' }}  </span> </span>

            </div>
        </div>
        <div class="pxp-results-card-1-features">
            <span> <strong>En {{$property->operations[0]->operation_type}}</strong>  </span> 
            @if ($property->type->name == 'Terreno' || $property->type->name == 'Lote')
            <span><i class="fas fa-ruler-combined"></i> {{$property->surface}}<span> m² de Lote</span></span>

                @else 
                | <span>{{$property->suite_amount}} <i class="fa fa-bed"></i>
                    <span>|</span> {{$property->bathroom_amount}} <i class="fa fa-bath"></i> 
                    <span>|</span> @if (in_array($property->type->id, array(2,3,4,5,6,7,8,11,20)) ) {{$property->roofed_surface}} @else {{$property->surface}} @endif m²</span>
                    
                @endif

           
        </div> 
        <div class="pxp-results-card-1-save"><span class="fa fa-play"></span></div>
    </a>
</div>
