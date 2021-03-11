@extends('frontend.layouts.app')
@section('content')
<style>
    .pagination a {
        color: #212529 !important;
        font-family: Rubik,sans-serif;
        padding: 15px 13px;
        border-radius: 3px; 
        display: inline-block;
        text-align: center;
        margin-right: 10px;
        font-weight: 500;
        min-width: 60px;
        font-size: 20px;
    }
    #casaroyal_ajax_load_more a span {
        display: inline-block;
    }
    #casaroyal_ajax_load_more.pagination a {
        padding: 15px 30px; 
    }
    #casaroyal_ajax_load_more.pagination a .fa {
        font-size: 16px;
        margin-right: 10px;
        display: none;
    }
    .pxp-results-card-1-details-title {
        font-size: 20px;
        white-space: normal;
        text-overflow: ellipsis;
        width: 100%;
        text-shadow: 1px 1px 1px rgba(0,0,0,.7), -1px 1px 2px rgba(0,0,0,.4);
    }
</style>
@include('frontend.layouts.header1')
<div class="pxp-content">
    <div class="container">
        <div class="pxp-blog-posts-side-section mt-md-5 mt-200">
            <h3>Filtros Activos</h3>
            <div id="filters-active"  class="pxp-blog-posts-side-tags mt-3 mt-md-5">  
            </div> 
        </div>
    </div>
    @if (app('request')->input('dev_id')!=null)
        <input id="dev_id_value" type="hidden" value=" {{$properties[0]->development->publication_title ?? ''}}">
    @endif
    <div class="pxp-blog-posts pxp-content-wrapper ">
        <div class="container">
            
            <div class="d-flex">
                <div class="pxp-content-side-search-form">
                    <div class="row pxp-content-side-search-form-row"> 
                        <h1 class="pxp-page-header">Propiedades para vos.</h1> 
                    </div>
                </div>
                <div class="d-flex">
                    <a role="button" class="pxp-adv-toggle"><span class="fa fa-sliders"></span>
                        <small>Filtros</small>
                    </a>
                </div>
            </div>
            @include('frontend.property.includes.sidebar')

            <div class="row pb-4 hide">
                <div class="col-sm-6 hidden-xs ">
                    <h2 class="pxp-content-side-h2" id="property-list-title"> </h2>
                </div>
                <div class="col-sm-6">
                    <div class="pxp-sort-form form-inline float-right">
                        <div class="form-group">
                            <select class="custom-select" id="pxp-sort-results">
                                <option value="" selected="selected">Mostrar</option>
                                <option value="">Mayor Precio</option>
                                <option value="">Menor Precio</option>
                                <option value="">Recientes</option>

                                <option value="">Cerca mio</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="row" id="properties-list">
                @each('frontend.property.includes.item', $properties, 'property', 'frontend.property.includes.empty') 
            </div>
            
            <div id="casaroyal_ajax_load_more" class="col-sm-12 col-md-12 pb-100 pagination"> </div> 
            
            <div style="visibility: hidden">
                <input type="hidden" value="{{$meta->current_page}}" name="meta_current_page">
                <input type="hidden" value="{{$meta->from}}" name="meta_from">
                <input type="hidden" value="{{$meta->last_page}}" name="meta_last_page">
                <input type="hidden" value="{{$meta->total}}" name="meta_total">
                <input type="hidden" value="{{$meta->per_page}}" name="meta_per_page">
                <input type="hidden" value="{{$name}}" name="title_name">

            </div>
        </div>

    </div>
</div>
@endsection

@section('after-scripts')
    <script src="{{asset('js/filter_slugify.js')}}"></script>
    <script src="{{asset('js/location_search.js')}}"></script>
    <script>
        jQuery('.casaroyal-search-keyword').focus(function () {
            jQuery('.casaroyal-search-locations-list').fadeIn(50);
        });

        jQuery('.casaroyal-search-keyword').focusout(function () {
            jQuery('.casaroyal-search-locations-list').fadeOut(150);
        });
   </script>
@endsection