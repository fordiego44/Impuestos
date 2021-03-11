<!DOCTYPE html>
 <head>

<title>Listeo</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/main-color.css" id="colors">

</head>

<body class="transparent-header">

<!-- Wrapper -->

@include('frontend.layouts.header')

<div class="main-search-container centered" data-background-image="images/main-search-background-01.jpg">
	<div class="main-search-inner">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>
						Encuentra cerca
 						<span class="typed-words"></span>
					</h2>
					<h4>Explore, restaurantes mejor calificadas</h4>

					<div class="main-search-input">

						<div class="main-search-input-item">
							<input type="text" placeholder="What are you looking for?" value=""/>
						</div>

						<div class="main-search-input-item location">
							<div id="autocomplete-container">
								<input id="autocomplete-input" type="text" placeholder="Location">
							</div>
							<a href="#"><i class="fa fa-map-marker"></i></a>
						</div>

						<div class="main-search-input-item">
							<select data-placeholder="All Categories" class="chosen-select" >
								<option>Restaurantes</option>
							</select>
						</div>

						<button class="button" onclick="window.location.href='listings-half-screen-map-list.html'">Search</button>

					</div>
				</div>
			</div>

			<!-- Features Categories -->
			<div class="row">
				<div class="col-md-12">
					<h5 class="highlighted-categories-headline">Or browse featured categories:</h5>

					<div class="highlighted-categories">
						<!-- Box -->
						<a href="listings-list-with-sidebar.html" class="highlighted-category">
					    	<i class="im im-icon-Home"></i>
					    	<h4>Apartments</h4>
						</a>

						<!-- Box -->
						<a href="listings-list-full-width.html" class="highlighted-category">
					    	<i class="im im-icon-Hamburger"></i>
					    	<h4>Eat &amp; Drink</h4>
						</a>

						<!-- Box -->
						<a href="listings-half-screen-map-list.html" class="highlighted-category">
					    	<i class="im im-icon-Electric-Guitar"></i>
					    	<h4>Events</h4>
						</a>

						<!-- Box -->
						<a href="listings-half-screen-map-list.html" class="highlighted-category">
					    	<i class="im im-icon-Dumbbell"></i>
					    	<h4>Fitness</h4>
						</a>
					</div>

				</div>
			</div>
			<!-- Featured Categories - End -->

		</div>

	</div>
</div>

<!-- Category Boxes / End -->
<!-- Fullwidth Section -->
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Restaurantes Registrados</font></font></h2>
                    <span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Listados</font></font></span>                                    <nav id="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                            <ul>
                                <!-- Breadcrumb NavXT 6.4.0 -->
                            <!--<li class="home"><span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Ve a Listeo." href="https://listeo.pro" class="home"><span property="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Listeo</font></font></span></a><meta property="position" content="1"></span></li> -->
                            <!--<li class="post post-page current-item"><span class="post post-page current-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lista de ancho completo</font></font></span></li> -->
                            </ul>
                        </nav>

                </div>
            </div>
        </div>
    </div>
   <!--
       ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
       ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
       parte 2;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
        ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
       ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
   -->
<div class="container full-width">

		<!-- Listings -->
    <div id="listeo-listings-container" data-counter="11" data-style="compact" data-custom_class="" data-per_page="6" data-grid_columns="3" data-region="" data-category="" data-feature="" data-rental-category="" data-service-category="" data-event-category="" class="row  ajax-search">

				<!-- Listing Item -->
<!-- Listing Item / End --><!-- Listing Item -->
        @foreach($restaurant as $restaurants)
                <div class="col-lg-12 col-md-12">
                    <div class="listing-item-container listing-geo-data  list-layout listing-type-service" data-title="Tom’s Restaurant" data-friendly-address="Wakefield, NY" data-address="Wakefield, NY" data-image="https://listeo.pro/wp-content/uploads/2018/11/photo-1488992783499-418eb1f62d08-2-520x397.jpg" data-longitude="40.89655" data-latitude="-73.85072789999998" data-rating="" data-reviews="0" data-icon="<i class=&quot;im im-icon-Hamburger&quot;></i>">
                        <a href="https://listeo.pro/listing/toms-restaurant/" class="listing-item ">

                            <!-- Image -->
                            <div class="listing-item-image">
                                <img width="520" height="397" src="https://listeo.pro/wp-content/uploads/2018/11/photo-1488992783499-418eb1f62d08-2-520x397.jpg" class="attachment-listeo-listing-grid size-listeo-listing-grid wp-post-image" alt="">
                                    <span class="tag">
                                    {{$restaurants->phone}}				   
                                    </span>
                            </div>

                            <!-- Content -->
                            <div class="listing-item-content">
                                <div class="listing-badge now-open">Nuevo</div>
                                <div class="listing-item-inner">
                                    <h3>
                                    {{$restaurants->company}}
                                    <i class="verified-icon"></i>
                                    </h3>
                                    <span>Restaurante</span>
                                    <div class="listing-list-small-badges-container">
                                        <div class="listing-small-badge pricing-badge">
                                            <i class="fa fa-tag"></i>$12 - $80
                                        </div>
                                    </div>

                                </div>
                                <span class="save like-icon tooltip left" title="Login To Bookmark Items"></span>
                            </div>
                        </a>
                    </div>
                </div>
        @endforeach




<!-- Listing Item / End -->



</div>
<br>
<br><br>


<!-- Scripts
================================================== -->
<script data-cfasync="false" src="../../cdn-cgi/js/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src={{asset('js/jquery-migrate-3.1.0.min.js')}}></script>
<script type="text/javascript" src={{asset('js/mmenu.min.js')}}></script>
<script type="text/javascript" src={{asset('js/chosen.min.js')}}></script>
<script type="text/javascript" src={{asset('js/slick.min.js')}}></script>
<script type="text/javascript" src={{asset('js/rangeslider.min.js')}}></script>
<script type="text/javascript" src={{asset('js/magnific-popup.min.js')}}></script>
<script type="text/javascript" src={{asset('js/waypoints.min.js')}}></script>
<script type="text/javascript" src={{asset('js/counterup.min.js')}}></script>
<script type="text/javascript" src={{asset('js/jquery-ui.min.js')}}></script>
<script type="text/javascript" src={{asset('js/tooltips.min.js')}}></script>
<script type="text/javascript" src={{asset('js/custom.js')}}></script>

<script src={{asset('js/leaflet.min.js')}}></script>

<!-- Leaflet Maps Scripts -->
<script src={{asset('js/leaflet-markercluster.min.js')}}></script>
<script src={{asset('js/leaflet-gesture-handling.min.js')}}></script>
<script src={{asset('js/leaflet-listeo.js')}}></script>
<script src={{asset('js/leaflet-autocomplete.js')}}></script>
<script src={{asset('js/leaflet-control-geocoder.js')}}></script>


<!-- Typed Script -->
<script type="text/javascript" src={{asset('js/typed.js')}}></script>
<script>
var typed = new Typed('.typed-words', {
strings: [" Restaurantes"],
	typeSpeed: 80,
	backSpeed: 80,
	backDelay: 4000,
	startDelay: 1000,
	loop: true,
	showCursor: true
});
</script>

<script src={{asset('js/switcher.js')}}></script>

<div id="style-switcher">
	<h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>

	<div>
		<ul class="colors" id="color1">
			<li><a href="#" class="main" title="Main"></a></li>
			<li><a href="#" class="blue" title="Blue"></a></li>
			<li><a href="#" class="green" title="Green"></a></li>
			<li><a href="#" class="orange" title="Orange"></a></li>
			<li><a href="#" class="navy" title="Navy"></a></li>
			<li><a href="#" class="yellow" title="Yellow"></a></li>
			<li><a href="#" class="peach" title="Peach"></a></li>
			<li><a href="#" class="beige" title="Beige"></a></li>
			<li><a href="#" class="purple" title="Purple"></a></li>
			<li><a href="#" class="celadon" title="Celadon"></a></li>
			<li><a href="#" class="red" title="Red"></a></li>
			<li><a href="#" class="brown" title="Brown"></a></li>
			<li><a href="#" class="cherry" title="Cherry"></a></li>
			<li><a href="#" class="cyan" title="Cyan"></a></li>
			<li><a href="#" class="gray" title="Gray"></a></li>
			<li><a href="#" class="olive" title="Olive"></a></li>
		</ul>
	</div>

</div>
</body>

 </html>
