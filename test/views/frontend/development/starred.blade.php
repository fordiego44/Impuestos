@extends('frontend.layouts.app')

@section('title','Mieres Mobile | Emprendimientos')

@section('content')

    <div id="page-transitions" class="page-build highlight-red">

        <div class="prop-header header header-light header-static">
            <img class="nav-logo" src="{{asset('images/MieresLogo.png')}}" alt="">
            <a href="{{route('frontend.agent.index')}}"><i class="fas fa-chevron-left"></i>VOLVER</a> | <a href="{{route('frontend.development.list')}}">VER
                TODOS</a>
        </div>


        <div class="page-content header-clear">


            <div class="cover-slider owl-carousel owl-has-dots-over">


                @each('frontend.development.includes.cover-item', $developments, 'development','frontend.development.includes.empty')


            </div>


        </div>


        <a href="#" class="back-to-top-badge back-to-top-small bg-highlight"><i class="fa fa-angle-up"></i>Back to
            Top</a>
    </div>


@endsection

@section('after-scripts')



@endsection
