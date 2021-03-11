<!DOCTYPE html>

<head>

    <!-- Basic Page Needs============ -->
    <title>Teresa Urdapilleta Admin Panel </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS=============== -->
    <link href="{{ asset('css/backend/backend-app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/backend-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/backend-bootstrap-grid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/backend-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/colors/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/toastr.min.css') }}" rel="stylesheet"/>

</head>

<body>

<!-- Wrapper -->
<div id="wrapper">


    <!-- Content====================== -->

    <!-- Coming Soon Page -->
    <div class="coming-soon-page" style="background-image: url(images/main-search-background-01.jpg)">
        <div class="container">
            <!-- Search -->
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h1 class="white">
                        <strong>Teresa Urdapilleta Propiedades</strong>
                        <p style="color:white">Creador de Usuarios</p>
                    </h1>
                    <form method="post" class="login" action="/user-register">
                        {{ csrf_field() }}

                        @if (count($errors) > 0)
                            <h3>Ha ocurrido un error en el ingreso:</h3>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="main-search-input gray-style margin-top-30 margin-bottom-10">

                            <div class="main-search-input-item">
                                <input type="text" name="name" placeholder="Nombre del usuario" value="" />
                            </div>

                        </div>

                        <div class="main-search-input gray-style margin-top-30 margin-bottom-10">

                            <div class="main-search-input-item">
                                <input type="email" name="email" placeholder="Email del usuario" value="" />
                            </div>

                        </div>

                        <div class="main-search-input gray-style margin-top-30 margin-bottom-10">

                            <div class="main-search-input-item">
                                <input type="password" name="password" placeholder="Password del usuario" value="" />
                            </div>


                        </div>


                        <div class="main-search-input gray-style margin-top-30 margin-bottom-10">

                            <div class="main-search-input-item">
                                <input type="password" name="password_confirmation" placeholder="Confirmacion del password" value="" />
                            </div>


                        </div>

                        <button  type="submit" class="button">Registrar</button>

                    </form>
                </div>
            </div>
            <!-- Search Section / End -->
        </div>
    </div>
    <!-- Coming Soon Page / End -->

</div>
<!-- Wrapper / End -->
<script src="{{ asset('js/backend/chosen.min.js') }}"></script>
<script src="{{ asset('js/backend/slick.min.js') }}"></script>
<script src="{{ asset('js/backend/rangeslider.min.js') }}"></script>
<script src="{{ asset('js/backend/magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/backend/waypoints.min.js') }}"></script>
<script src="{{ asset('js/backend/counterup.min.js') }}"></script>
<script src="{{ asset('js/backend/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/backend/tooltips.min.js') }}"></script>
<script src="{{ asset('js/backend/dropzone.js') }}"></script>
<script src="{{ asset('js/backend/custom1.js') }}"></script>
<script src="{{ asset('js/backend/toastr.min.js') }}"></script>




</body>

</html>
