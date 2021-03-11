<header id="header-container" class="fixed fullwidth dashboard"> 
	<!-- Header -->
	<div id="header" class="not-sticky">
		<div class="container"> 
			<!-- Left Side Content -->
			<div class="left-side"> 
				<!-- Logo -->
				<div id="logo">
					<h1 class="white text-center"><strong> PILLETA</strong></h1>
				</div>

				<!-- Mobile Navigation -->
				<div class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div> 
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
						<div class="user-name"><span><img src="{{asset('images/dashboard-avatar.jpg')}}" alt=""></span><strong>URDAPILLETA</strong></div>
						<ul>
							
							<li><a href="{{ route('backend.logout') }}"><i class="sl sl-icon-power"></i> Logout</a></li>
						</ul>
					</div>

					@yield('header-button')

					</div>
				<!-- Header Widget / End -->
			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
