<div class="col-lg-4 col-md-4 property-grid-item property-item-data clearfix"
     data-lat="{{$property->geo_lat}}"
     data-long="{{$property->geo_long}}"
     data-title="{{$property->publication_title}}"
     @if ($property->photos!=null)
    data-thumb="{{$property->photos[0]->image}}"
    @else
    data-thumb="{{asset('images/properties/property-2.jpg')}}"
    @endif
    data-pin="{{asset('images/svg/house-1.svg')}}"
    data-price="{{$property->operations[0]->prices[0]->currency == "USD"? "$" : "u\$d" }}{{$property->operations[0]->prices[0]->price}}"
    data-type="{{$property->operations[0]->operation_type}}"
    data-desc="{{ str_limit($property->description, 50, '...') }}"
    data-link="{{ route('frontend.property.detail' , ['sluglify' => $property->id . '-' .  $property->title_href]) }}"
    data-id="{{$property->id}}">

    <div class="property-grid-card">

        <div class="property-grid-card-a">

            <div class="property-grid-image">

                <a href="{{ route('frontend.property.detail' , ['sluglify' => $property->id . '-' . $property->title_href ]) }}" class="property-link-over-image"
                   @if ($property->photos!=null)
                    style="background-image: url({{$property->photos[0]->image}});"
                    @else
                    style="background-image: url({{asset('images/properties/property-2.jpg')}});"
                    @endif
                    ></a>

                <span class="property-status-label">
							<span class="property-type">{{$property->type->name}}</span>
							<span class="property-status">{{$property->property_condition}}</span>
						</span>

                <span class="property-featured">
							<i class="fa fa-bolt" aria-hidden="true"></i>
						</span>

                <span class="property-action-unit add-to-favorites">
							<span class="add-to-favorites-list" data-toggle="tooltip" data-placement="top"
                                  data-original-title="Add to favorites">
								<i class="fa fa-heart-o" aria-hidden="true"></i>
								<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
							</span>
							<span class="remove-to-favorites-list" data-toggle="tooltip" data-placement="top"
                                  data-original-title="Remove from favorites">
								<i class="fa fa-heart" aria-hidden="true"></i>
								<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
							</span>
						</span>

                <span class="property-action-unit add-to-compare " data-id="49" data-action="add">
							<span class="add-to-compare-list" data-toggle="tooltip" data-placement="top"
                                  data-original-title="Add to compare">
								<i class="fa fa-exchange" aria-hidden="true"></i>
								<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
							</span>
							<span class="remove-to-compare-list" data-toggle="tooltip" data-placement="top"
                                  data-original-title="Remove from compare">
								<i class="fa fa-exchange" aria-hidden="true"></i>
								<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
							</span>
						</span>

            </div>

            <div class="property-grid-content">

                <div class="property-grid-item-holder">
							<span class="property-grid-price">
								<span class="price-prefix"></span>
								<span class="property-price-holder">{{$property->operations[0]->prices[0]->currency == "USD"? "$" : "u\$d" }}<span
                                        class="property-price-number">{{$property->operations[0]->prices[0]->price}}</span></span>
								{{--<span class="price-prefix">Per Month</span>--}}
							</span>
                    <div class="casaroyal-property-title-holder">
								<span class="property-location-label">
									<i class="fa fa-map-marker" aria-hidden="true"></i>
									{{ implode(', ',array_reverse(explode(" | ",$property->location->short_location))) }}
								</span>
                        <h4 class="property-grid-title-v2">
                            <a href="{{ route('frontend.property.detail' , ['sluglify' => $property->id . '-' . $property->title_href ]) }}" class="property-link">
                                {{$property->publication_title}}
                            </a>
                        </h4>
                    </div>
                    <div class="casaroyal-property-agent-name">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <a href="/sucursales">{{$property->producer->name ?? ''}}</a>
                    </div>
                    <div class="casaroyal-property-listing-time">
                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Antiguedad {{$property->age}}
                    </div>

                </div>

                <div class="property-meta">

                    @include('frontend.property.includes.partials.icons')

                </div>
            </div>
        </div>
    </div>
</div>
