<!doctype html>
<html lang="es">
    <head>
        <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-54BWSVL');</script>
<!-- End Google Tag Manager -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/photoswipe.css')}}"> 
        <link rel="stylesheet" href={{asset('css/default-skin/default-skin.css')}}> 
         <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}"> 
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

       
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <script src="https://kit.fontawesome.com/c487d23631.js" crossorigin="anonymous"></script>
 
        <title>{{$info['title']}}</title>
        <meta name="description" content="{{$info['description']}}"/>
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-54BWSVL"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        @yield('content') 
        @include('frontend.layouts.footer') 
        <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        @yield('after-scripts')
        <script src="{{asset('js/main.js')}}"></script>

    </body>
</html>