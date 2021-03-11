
<div class="col-sm-12 col-md-6 col-xl-6 property-list-item property-item-data">
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
               
            </div>
        </div>
        <div class="pxp-results-card-1-features">
            <span> <strong>En Venta</strong> 
            @include('frontend.property.includes.partials.icons') 
        </div> 
        <div class="pxp-results-card-1-save"><span class="fa fa-play"></span></div>
    </a>
</div>
