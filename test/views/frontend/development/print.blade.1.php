<!DOCTYPE html>
<html>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{asset('css/print.css')}}">

<title>Ficha de Propiedad Mieres Realty</title>

<style>
    .main {
        margin: 20px 0 10px 0;
        padding: 0 0 0 0;
    }

    .overview ul li {
        padding-top: 0px;
        padding-bottom: 4px;
    }

    hr {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .widgettitle {
        margin: 0 0 0px;
    }

    .widget {
        margin: 0 0 15px;
    }
    .branch-ul {
        width: 100%;
        float: left;
        list-style: none;
        margin: 0 !important;
        padding: 0 !important;
        margin-bottom: 0px !important;
        font-family: 'Rubik', sans-serif;
        font-size: 0.900em;
    }
    .property-meta-item {
        display: inline-block;
        width: 40px;
        max-width: 10.50em;
        float: left;
        font-family: 'Rubik', sans-serif;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .property-meta svg {
        width: 40%;
        height: auto;
        max-height: 50px;
        padding-right: 20px;
        float: left;
    }
    .property-meta-number {
        font-size: 24px;
        line-height: 1em;
        font-weight: 500;
        width: 60%;
        float: left;
    }
    .property-meta-name {
        width: 60%;
        float: right;
        line-height: 1em;
        font-size: 0.7em;
    }
</style>
</head>

<body class="">
<div class="page-wrapper">

    <div class="main-wrapper">
        <div class="main">
            <div class="main-inner">

                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8" style="width: 70%; float:left;margin-bottom: -5px">

                            {{--<div class="col-md-12">--}}
                                <div class="widget">


                                    <h2 class="widgettitle">
                                        <img src="/images/logo.png" style="height: 60px;width: 150px; position: static; right: 0px; top: 0px;">
                                    </h2>


                                </div><!-- /.widget -->
                            </div>
                            <div class="col-md-4" style="width: 30%; float:left;margin-left: -10px">

                                <div>
                                    <div style="float:left;width:25%">
                                        <figure>
                                            <img style="width:50px;height:50px;" src="/images/agent-avatar.jpg" alt="">
                                        </figure>
                                    </div>
                                    <div style="float:right; width: 75%;line-height: 15px">
                                        <h3 style="margin-top:0 !important; font-size:1em">
                                            {{$property->branch->name}}
                                        </h3>
                                        <ul class="branch-ul" style="margin-top:0 !important;">
                                            <li style="font-size:0.8em">
                                                <span>Teléfono:</span> {{$property->branch->phone ?? ''}}
                                            </li>
                                            <li style="font-size:0.8em">
                                                <span>Whatsapp:</span> {{$property->branch->phone ?? ''}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="listing-detail col-md-12">



                                <div class="col-md-6">
                                    <div class="gallery" style="float: left;padding: 0px 9px 9px 9px; margin-left: -8px">
                                        @if (sizeof($property->photos)>0)
                                            <div>
                                                <img style="width: 472px;height: 330px" src="{{$property->photos[0]->image}}">
                                            </div>
                                        @else
                                            <div>
                                                <img style="width: 472px;height: 330px" src="/images/logo.png" alt="Mieres Realty Propiedades">
                                            </div>
                                        @endif

                                    </div><!-- /.gallery -->
                                </div>

                                <div class="col-md-6">
                                    <div class="gallery" style="margin: 5px 0 5px 5px;padding: 2px">
                                        @if (isset($property->photos[1]))
                                            <div>
                                                <img style="width: 230px;height: 160px;padding-left: 2px;" src="{{$property->photos[1]->image}}">
                                            </div>
                                        @else
                                            <div>
                                                <img style="width: 100%" src="/images/logo.png" alt="Mieres Realty Propiedades">
                                            </div>
                                        @endif

                                    </div><!-- /.gallery -->
                                    <div class="gallery" style="margin: 5px 0 5px 5px;padding: 2px;">
                                        @if (isset($property->photos[2]))
                                            <div>
                                                <img style="width: 230px;height: 160px;padding: 2px;" src="{{$property->photos[2]->image}}">
                                            </div>
                                        @else
                                            <div>
                                                <img style="width: 100%" src="/images/logo.png" alt="Mieres Realty Propiedades">
                                            </div>
                                        @endif

                                    </div><!-- /.gallery -->
                                </div>

                            </div><!-- /.col-* -->


                        </div><!-- /.row -->

                        <div class="row" style="margin-bottom: 1px">
                            <div class="col-md-12" style="width: 100%; float:left;margin-bottom: -5px">
                                <h2>
                                    {{$property->publication_title}}
                                </h2>
                                <div style="line-height: 10px;margin-top: -6px">
                                    <h4>{{$property->location->name}}</h4>
                                    <h4>{{$property->operations[0]->prices[0]->currency}} {{$property->operations[0]->prices[0]->price }}</h4>
                                    <h4>{{$property->operations[0]->operation_type}}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: -10px">
                            {{-- <div class="col-md-5" style="width: 40%; float:left"> --}}

                            <div class="col-md-8" style="width: 65%; float:left;margin-bottom: -5px">

                                <div> 

                                    @include('frontend.property.includes.partials.icons_detail')
                                
                                </div>



                                <div class="overview">
                                    <p style="line-height: 1.2em; font-size: 90%;text-align: justify">
                                        {!! $property->description !!}
                                    </p>



                                    {{--<hr class="mt-0 mb-30">--}}
                                </div><!-- /.overview -->
                            </div>


                            <div class="col-md-4" style="width: 35%; float:left;margin-left: -10px">
                                <h4 style="margin-left: 40px"><b>INFORMACION BASICA</b></h4>

                                <div class="section-text mb-30">
                                    <ul class="service" style="list-style: none;text-align: left; font-size: 90%;">
                                        <!-- DORMITORIOS -->
                                        @if ((int)$property->suite_amount > 0)
                                            <li>
                                                <strong>Dormitorios:</strong>
                                                <span> {{$property->suite_amount}}</span>
                                            </li>
                                        @endif
                                        @if ((int)$property->room_amount > 0)
                                            <li>
                                                <strong>Ambientes:</strong>
                                                <span> {{$property->room_amount}}</span>
                                            </li>
                                        @endif
                                    <!-- BAÑOS -->
                                        @if ((int)$property->bathroom_amount > 0)
                                            <li><strong>Baños:</strong><span> {{$property->bathroom_amount}}</span></li>
                                        @endif
                                    <!-- DISPOSICIÓN -->
                                        @if ($property->disposition)
                                            <li><strong>Disposición:</strong><span>  {{$property->disposition}}</span></li>
                                        @endif
                                    <!-- ANTIGUEDAD -->
                                        @if ($property->age)
                                            @if ($property->age > 1)
                                                <li><strong>Antiguedad:</strong><span> {{$property->age}} años</span></li>
                                            @elseif ($property->age > 0)
                                                <li><strong>Antiguedad:</strong><span> {{$property->age}} año</span></li>
                                            @else
                                                <li><strong>Antiguedad:</strong><span> A estrenar</span></li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                                <h4 style="margin-left: 40px"><b>SUPERFICIES</b></h4>

                                <div class="section-text mb-30">
                                    <ul class="service" style="list-style: none;text-align: left; font-size: 90%;">

                                            @if ((int)$property->total_surface > 0)
                                                <li>
                                                    <strong>Superficie Total:</strong>
                                                    <span> {{$property->total_surface}} M<sup>2</sup>
                                                    </span>
                                                </li>
                                            @endif
                                        <!-- SUPERFICIE CUBIERTA -->
                                            @if ((int)$property->roofed_surface > 0)
                                                <li>
                                                    <strong>Superficie Cubierta:</strong>
                                                    <span>  {{$property->roofed_surface}} M<sup>2</sup>
                                                    </span>
                                                </li>
                                            @endif
                                    </ul>
                                </div>
                                <h4 style="margin-left: 40px"><b>SERVICIOS</b></h4>

                                <div class="section-text mb-30">
                                    <ul class="service" style="list-style: none;text-align: left; font-size: 90%;">
                                        @if (sizeof($property->tags_filter['servicios'])>0)

                                            @foreach ($property->tags_filter['servicios'] as  $tag)
                                                <li style="float: left;">
                                                    <span>{{$tag->name}} -</span>
                                                </li>
                                            @endforeach
                                        @else
                                            <h4>No hay servicios disponibles</h4>
                                        @endif
                                    </ul>
                                </div>

                            </div>
                        </div><!-- /.col-* -->


                        {{--<div class="row" style="display: inline-block; margin-top: -5px; font-size: 95%;text-align: justify">--}}
                            {{--<p>Martilleros responsables: Eduardo Berraz (C.S.I. 5157), Martin Mieres (C.S.I. 2702) y Cristián Mieres (C.S.I. 5151)</p>--}}
                        {{--</div>--}}
                    </div>


                </div><!-- /.container -->

            </div><!-- /.content -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->

</div>
</body>

</html>
