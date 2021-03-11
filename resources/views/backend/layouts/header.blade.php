<header id="header-container" class="fixed fullwidth dashboard">

	<!-- Header -->
	@php
	$message = Session::get('rol');
	@endphp
	<div id="header" class="not-sticky">
		<div class="container">

			<!-- Left Side Content -->
			<div class="left-side">

				<!-- Logo -->
				<div id="logo" style="background-color:rgb(255, 255, 255)">
					<a href="/"  ><img style=" max-height: 70px; background:rgb(255, 255, 255)" src={{asset('images/heart.png')}} alt="Logo de la página"></a>
					<a href="/" class="dashboard-logo" ><img style=" max-height: 70px; background:rgb(255, 255, 255)" src={{asset('images/heart.png')}} alt="Logo de la página"></a>
				</div>


				<nav id="navigation" class="style-1">
					<ul id="responsive">



					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->

			</div>
			<!-- Left Side Content / End -->

			<!-- Right Side Content / End -->
			<div class="right-side">
				<!-- Header Widget -->
				<div class="header-widget">

					<!-- User Menu -->
					<div class="user-menu">
						@if ($message[0] == "administrador")
							{{-- <div class="user-name"><span><img src={{asset('images/'.Session::get('user')->image)}} alt=""></span>{{Session::get('user')->name}}</div> --}}
						<div class="user-name">{{Session::get('user')->name}}</div>
						@else
							<div class="user-name">{{Session::get('deliverier')->name}}</div>
						@endif
						<ul>
							
							{{-- <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
							<li><a href="dashboard-bookings.html"><i class="fa fa-calendar-check-o"></i> Bookings</a></li> --}}

							<li><a href="{{ route('logout') }}" ><i class="sl sl-icon-power"></i> Cerrar Sesión</a></li>




						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
