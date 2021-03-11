<!DOCTYPE html>
<html>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{asset('css/print.css')}}">

<title>Ficha de Emprendimiento Mieres Realty</title>

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
                            <div class="col-md-12">
                                <div class="widget">


                                    <h2 class="widgettitle">
                                        <img src="/images/logo.png" style="height: 60px;width: 150px; position: static; right: 0px; top: 0px;">
                                    </h2>

                                    <!--<h2 style="font-size: 130%; margin-bottom: 20px"><b>Sucursal Nordelta</b></h2>
                                    <table class="contact" width="100%" style="max-width: 100%">
                                        <tbody>
                                            <tr style="display: none">
                                                <th width="15%"></th>
                                                <td width="85%"></td>
                                            </tr>
                                            <tr>
                                                <th>Dirección</th>
                                                <td>Edificio Puerta Norte
                                            </tr>

                                            <tr>
                                                <th>Teléfonos</th>
                                                <td>4871-2901 </td>
                                            </tr>

                                            <tr>
                                                <th>E-mail:</th>
                                                <td><a href="#">info@mieres.com.ar</a></td>
                                            </tr>

                                        </tbody>
                                    </table>-->
                                </div><!-- /.widget -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="listing-detail col-md-12">

                                <h4>
                                    {{$property->publication_title}}
                                </h4>

                                <div class="col-md-6">
                                    <div class="gallery" style="float: left;padding: 0px 9px 9px 9px">
                                        @if (sizeof($property->photos)>0)
                                            <div>
                                                <img style="width: 450px;height: 330px" src="{{$property->photos[0]->image}}">
                                            </div>
                                        @else
                                            <div>
                                                <img style="width: 480px;height: 330px" src="/images/logo.png" alt="Mieres Realty Propiedades">
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

                        <div class="row" style="margin-bottom: -10px">
                            {{-- <div class="col-md-5" style="width: 40%; float:left"> --}}
                            <div class="col-md-5" style="width: 40%; float:left;margin-bottom: -5px">
                                <div class="overview">
                                    <h2 style="font-size: 130%;"><b>Datos del emprendimiento</b></h2>
                                    <p><b>

                                        </b></p>
                                    <ul style="line-height: 1.3em">
                                        <!-- TIPO DE OPERACION  -->
                                        <li>
                                            <strong>Estado de construcción </strong><span>  {{$property->construction_status_name}}</span>
                                        </li>
                                        <!-- Barrio / Ciudad  -->
                                        <li>
                                            <strong>Barrio</strong><span> {{$property->location->name}}</span>
                                        </li>

                                    </ul>
                                    {{--<hr class="mt-0 mb-30">--}}
                                </div><!-- /.overview -->
                            </div>


                            <div class="col-md-7" style="width: 60%; float:left;margin-left: -10px">
                                <h2 style="font-size: 130%; margin-left: 40px"><b>Amenities</b></h2>

                                <div class="section-text mb-30">
                                    <ul class="service" style="list-style: none;text-align: left; font-size: 90%;">
                                        @if (sizeof($property->tags)>0)

                                            @foreach ($property->tags as $key => $service)
                                                <li style="width: 33%; float: left;">
                                                    <i aria-hidden="true"></i>
                                                    <b style="color: #015E08">&#x2713</b> {{$service->name}}
                                                </li>
                                            @endforeach
                                        @else
                                            <h4>No hay servicios disponibles</h4>
                                        @endif
                                    </ul>
                                </div>

                            </div>
                        </div><!-- /.col-* -->

                        <div class="row" style="display: inline-block;">

                            <div class="col-md-12">
                                <h2 style="padding: 5px 0 5px;font-size: 130%;">Descripción</h2>

                                <p style="line-height: 1.2em; font-size: 90%;text-align: justify">
                                    {!! $property->description !!}
                                </p>

                            </div><!-- /.col-* -->

                        </div><!-- /.row -->
                        <div class="row" style="display: inline-block; margin-top: -5px; font-size: 95%;text-align: justify">
                            <p>Martilleros responsables: Eduardo Berraz (C.S.I. 5157), Martin Mieres (C.S.I. 2702) y Cristián Mieres (C.S.I. 5151)</p>
                        </div>
                    </div>


                </div><!-- /.container -->

            </div><!-- /.content -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->

</div>
</body>

</html>
