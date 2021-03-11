<div>
    <a href="{{ route('frontend.property.detail' , ['sluglify' => $property->id . '-' .$property->title_href]) }}" class="pxp-prop-card-1 rounded-lg">
        <div class="pxp-prop-card-1-fig pxp-cover" style="background-image: url({{$property->photos[0]->image}});"></div>
        <div class="pxp-prop-card-1-gradient pxp-animate"></div>
        <div class="pxp-prop-card-1-details">
            <div class="pxp-prop-card-1-details-title">{{$property->publication_title}}</div><!-- (tipo de propioedad) en (tipo de operación) en Pilará -->
            <div class="pxp-prop-card-1-details-price">
                @if ($property->operations[0]->prices[0]->price=="1")
                    CONSULTAR PRECIO | 
                @else
                    {{$property->operations[0]->prices[0]->currency == "USD"? "u\$d" : "$"}}
                @endif 
            </div><!-- precio -->
            <div class="pxp-prop-card-1-details-features text-uppercase">
             
                 <span>{{$property->suite_amount}} <i class="fa fa-bed"></i>
                <span>|</span> {{$property->bathroom_amount}} <i class="fa fa-bath"></i> 
                <span>|</span><i class="fas fa-ruler-combined"></i> @if (in_array($property->type->id, array(2,3,4,5,6,7,8,11,20)) ) {{$property->roofed_surface}} @else {{$property->surface}} @endif m²</span>
                
            </div>
        </div>
        <div class="pxp-prop-card-1-details-cta text-uppercase">Ver la Propiedad</div>
    </a>
</div>