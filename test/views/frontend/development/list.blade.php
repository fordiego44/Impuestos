@extends('frontend.layouts.app')

@section('content')
@include('frontend.layouts.header1')

<div class="pxp-content">
    <div class="pxp-blog-posts pxp-content-wrapper">
        <div class="container">
           
            

            <div class="pxp-blog-posts-carousel-1 mt-4 mt-md-5">
                <div id="pxp-blog-posts-carousel-1-img" class="carousel slide pxp-blog-posts-carousel-1-img" data-ride="carousel" data-pause="false" data-interval="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-slide="0">
                            <div class="pxp-hero-bg pxp-cover" style="background-image: url(images/properties/prop-1-1-big.jpg); background-position: 50% 50%;"></div>
                        </div>
                        
                    </div>
                </div>

                

                <div class="pxp-blog-posts-carousel-1-caption-container">
                    <div id="pxp-blog-posts-carousel-1-caption" class="carousel slide pxp-blog-posts-carousel-1-caption" data-ride="carousel" data-pause="false" data-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-slide="0">
                                <div class="pxp-blog-posts-carousel-1-caption-category">Barrios Cerrados</div>
                                <div class="pxp-blog-posts-carousel-1-caption-title">Pilará | El Lugar para vivir.</div>
                                <!-- <div class="pxp-blog-posts-carousel-1-caption-summary">Un horizonte natural lo espera a minutos del centro de Pilar.</div> -->
                                <a href="development-detail.html" class="pxp-primary-cta text-uppercase mt-md-4 pxp-animate">Ver más de Pilará.</a>
                            </div>
                            
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="row mt-60">

                <div class="col-sm-12 col-lg-9">
                    <h1 class="pxp-page-header mb-60 mt-60">Condominios.</h1>
                         <div class="row" id="properties-list"> 
                            @each('frontend.development.includes.item', $developments, 'property', 'frontend.property.includes.empty') 
                        </div> 
                        <div id="casaroyal_ajax_load_more" class="pagination">
                            {{--<a href="#" class="casaroyal-btn"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span>Ver más proyectos</span></a>--}}
                        </div>
                </div> 
                <div class="col-sm-12 col-lg-2 mt-4 mt-md-5 hide mt-60 "> 
                    <div class="pxp-blog-posts-side-section mt-4 mt-md-5 "> 
                        @include('frontend.development.includes.sidebar') 
                    </div> 
                </div>
            </div>
            
        </div>
    </div> 
</div> 



    <div style="visibility: hidden">
        <input type="hidden" value="{{$meta->current_page}}" name="meta_current_page">
        <input type="hidden" value="{{$meta->from}}" name="meta_from">
        <input type="hidden" value="{{$meta->last_page}}" name="meta_last_page">
        <input type="hidden" value="{{$meta->total}}" name="meta_total">
        <input type="hidden" value="{{$meta->per_page}}" name="meta_per_page">

    </div>
@endsection

@section('after-scripts')
    <script type="text/javascript" src="{{asset('js/developmentFilter_5.js')}}"></script>
@endsection
