<header id="header-container" class="fixed fullwidth dashboard"> 
	<div id="header" class="not-sticky">
		<div class="container"> 
			<div class="left-side"> 
				<div id="logo">
					<a href="/admin"><img src={{asset('images/logo.png')}} alt=""></a>
					<a href="/admin" class="dashboard-logo"><img src={{asset('images/logo2.png')}} alt=""></a>
				</div> 
				<nav id="navigation" class="style-1">
					<ul id="responsive"> 
					</ul>
				</nav>
				<div class="clearfix"></div> 
			</div> 
			<div class="right-side"> 
				<div class="header-widget"> 
					<div class="user-menu">
 						<div class="user-name"><span><img src={{asset('images/avatar-perfil.jpg')}} width= '30px'  height= '30px'  style='width: 30px; height: 30px;' ></span>{{Session::get('admin')->email}}</div> 
						<ul>
							<li><a href=""><i class="sl sl-icon-settings"></i>Inicio</a></li> 
							<li><a href="{{ route('logout') }}" ><i class="sl sl-icon-power"></i> Cerrar Sesión</a></li> 
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
