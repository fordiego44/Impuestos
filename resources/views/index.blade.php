@extends('frontend.app'  )
@section('content')

@include('frontend.helpers.search')
<style>
	.slick-prev {
		left: 108px;
		transform: translate3d(-90px, -50%, 0);
	}
	.slick-next {
		right: 108px;
		transform: translate3d(90px, -50%, 0);
	}

</style>
<style>
	.numerical-rating.high {
		background-color: #64bc36;
	}
	.compact .numerical-rating {

		background-color: #64bc36;
	}
	.listing-item-content span {
		margin-top: 10px !important;
		font-size: 15px !important;
		width: 270px !important;
		font-weight: 200;
		display: inline-block;
		color: rgba(255, 255, 255, .7);
	}
	.listing-item-content h3 {
		width: 280px;
		color: #fff;
		font-size: 21px;
		bottom: -1px;
		position: relative;
		font-weight: 500;
		margin: 0;
		line-height: 21px;
	}

	.tp-parallax-wrap {
		position: absolute;
		visibility: visible;
		left: 170px;
		top: 0px !important;
		z-index: 1111;
	}
	/*nuevos cambios*/
	.tp-caption{
		max-width: 1500px !important;

	}
	/*nuevos cambios */
	#rev_slider_4_1_wrapper{
		margin: 0px auto;
		background-color: transparent;
		padding: 0px;
		overflow: visible;
		height: 350px !important;
	}

	#rev_slider_4_1{
		margin-top: 0px;
		margin-bottom: 0px;
		height: 360px !important;
	}

	.ver-mas {
		border-radius: 50px;
		line-height: 20px;
		font-weight: 600;
		font-size: 12px;
		color: #fff;
		font-style: normal;
		padding: 2px 8px;
		margin-left: 3px;
		position: relative;
		top: -2px;
		background-color: #ee3535;
	}
	.listing-small-badges-container {
    position: absolute;
    top: 25px;
    left: 25px;
    z-index: 110;
    padding-right: 50px;
	}
	#caption-text{
		z-index: 6;
		color: rgb(255, 255, 255);
		letter-spacing: 0px;
		font-weight: 600;
		transition: none 0s ease 0s;
		line-height: 70px;
		border-width: 0px;
		margin: 0px 0px 0px;
		padding: 0px;
		font-size: 35px;
	}
	.listing-small-badge {
		display: inline-block;
		padding-left: 31px;
		padding-right: 10px;
		font-size: 20px;
		font-weight: 500;
		background-color: #fff;
		color: #777;
		border: none;
		border-radius: 100px;
		line-height: 26px;
		height: 26px;
		box-shadow: 0 1px 4px rgba(0,0,0,0.08);
		vertical-align: top;
		position: relative;
		margin-bottom: 3px;
	}
	.listing-small-badge.pricing-badge i {
		background-color: #64bc36;
	}
	.listing-small-badge i {
		position: absolute;
		height: 20px;
		width: 20px;
		top: 3px;
		left: 3px;
		border-radius: 100%;
		text-align: center;
		line-height: 20px;
		font-size: 12px;
		background: #222;
		color: #fff;
	}
	.fa {
		display: inline-block;
		font: normal normal normal 14px/1 FontAwesome;
		font-size: inherit;
		text-rendering: auto;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
	}
	.ultimos{
		width: 225px !important;
	}
	#navigator-select .main-search-input-item select#business:hover{

	color: #444645;
	background: #ddd;

	}
	@media only screen and (max-width: 1024px) {
		#rev_slider_4_1_wrapper{
		margin: 0px auto;
		background-color: transparent;
		padding: 0px;
		overflow: visible;
		height: 350px !important;
	}

	#rev_slider_4_1{
		margin-top: 0px;
		margin-bottom: 0px;
		height: 410px !important;
	}
	.tp-caption{
		max-width: 300px !important;
		white-space: normal !important;

	}

	}
</style>

<div class="clearfix"></div>
<!--<div class="main-search-container dark-overlay">
    <div class="main-search-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Encuentra los mejores productos.</h2>
					<h4>Explora los diversos puntos estratégicos de distribución de nuestros productos.</h4>


				</div>
			</div>

		</div>



    </div>
	<div class="video-container">
		<video poster="images/main-search-video-poster.jpg" loop autoplay muted>
			<source src="images/main-search-video.mp4" type="video/mp4">
		</video>
	</div>
</div>-->

		<div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container"
			data-alias="classicslider1"
			style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">

			<!-- 5.0.7 auto mode -->
			<div id="rev_slider_4_1" class="rev_slider home fullwidthabanner" style="display:none;"
				data-version="5.0.7">
				<ul>
					<!-- Slide  -->


					<li data-index="rs-2" data-transition="fade" data-slotamount="default"
						data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000"
						data-rotate="0" data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7"
						data-saveperformance="off">

						<!-- Background -->
						<img src="images/slider_impuestos.jpg" alt="" data-bgposition="center center" data-bgfit="cover"
							data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina style="object-fit: cover"
							data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100"
							data-scaleend="112" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0"
							data-offsetend="0 0">

						<!-- Caption-->
						<div class="tp-caption centered custom-caption-2 tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0"
							id="slide-2-layer-2" data-x="['center','center','center','center']" data-hoffset="['0']"
							data-y="['middle','middle','middle','middle']" data-voffset="['0']"
							data-width="['640','640', 640','420','320']" data-height="auto" data-whitespace="nowrap"
							data-transform_idle="o:1;"
							data-transform_in="y:0;opacity:0;s:1000;e:Power2.easeOutExpo;s:400;e:Power2.easeOutExpo"
							data-transform_out="" data-mask_in="x:0px;y:[20%];s:inherit;e:inherit;"
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
							data-responsive_offset="on">

							<!-- Caption Content -->

							<div class="R_title margin-bottom-15" id="slide-2-layer-3"
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
								data-y="['middle','middle','middle','middle']" data-voffset="['-40','-40','-20','-80']"
								data-fontsize="['42','36', '32','36','22']" data-lineheight="['70','60','60','45','35']"
								data-width="['640','640', 640','420','320']" data-height="none" data-whitespace="normal"
								data-transform_idle="o:1;"
								data-transform_in="y:-50px;sX:2;sY:2;opacity:0;s:1000;e:Power4.easeOut;"
								data-transform_out="opacity:0;s:300;" data-start="600" data-splitin="none"
								data-splitout="none" data-basealign="slide" data-responsive_offset="off"
								data-responsive="off"
								style="z-index: 6; color: #fff; letter-spacing: 0px; font-weight: 600; ">Plataforma de gestión de pagos electrónicos </div>

							<div class="R_title margin-bottom-15" style="z-index: 6; color: #fff; letter-spacing: 0px; font-weight: 600; " >de Tributos Municipales</div>
							@if (Session::get('costumer'))
								{{-- <button class="button fullwidth margin-top-20 margin-left-35" id="checkout-final" style="width:74%;"> Comprar</button> --}}
									<a href="/tax" class="button medium">Pagar ahora </a>
								@else
									<a  class="button medium pay-cancel"  >Pagar ahora</a>
									{{-- <button class="button fullwidth margin-top-20 margin-left-35" id="pay-cancel" style="width:74%;"> Pagar ahora </button> --}}

									{{-- <button class="button fullwidth margin-top-20 margin-left-35" id="pay-cancel" style="width:74%;"> Comprar</button> --}}
								@endif

						</div>

					</li>{{--
					<li data-index="rs-4" data-transition="fade" data-slotamount="default"
						data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000"
						data-rotate="0" data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7"
						data-saveperformance="off">

						<!-- Background -->
						<img src="images/Slider_3_Tacna.png" alt="" data-bgposition="center center" data-bgfit="cover"
							data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina style="object-fit: cover"
							data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100"
							data-scaleend="112" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0"
							data-offsetend="0 0">

						<!-- Caption-->
						<div class="tp-caption centered custom-caption-2 tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0"
							id="slide-2-layer-2" data-x="['center','center','center','center']" data-hoffset="['0']"
							data-y="['middle','middle','middle','middle']" data-voffset="['0']"
							data-width="['640','640', 640','420','320']" data-height="auto" data-whitespace="nowrap"
							data-transform_idle="o:1;"
							data-transform_in="y:0;opacity:0;s:1000;e:Power2.easeOutExpo;s:400;e:Power2.easeOutExpo"
							data-transform_out="" data-mask_in="x:0px;y:[20%];s:inherit;e:inherit;"
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
							data-responsive_offset="on">

							<!-- Caption Content -->
							<div class="R_title margin-bottom-15" id="slide-2-layer-3"
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
								data-y="['middle','middle','middle','middle']" data-voffset="['-40','-40','-20','-80']"
								data-fontsize="['42','36', '32','36','22']" data-lineheight="['70','60','60','45','35']"
								data-width="['640','640', 640','420','320']" data-height="none" data-whitespace="normal"
								data-transform_idle="o:1;"
								data-transform_in="y:-50px;sX:2;sY:2;opacity:0;s:1000;e:Power4.easeOut;"
								data-transform_out="opacity:0;s:300;" data-start="600" data-splitin="none"
								data-splitout="none" data-basealign="slide" data-responsive_offset="off"
								data-responsive="off"
								style="z-index: 6; color: #fff; letter-spacing: 0px; font-weight: 600; ">Compra hasta $ 3 000 dólares en productos de Tacna</div>

								<div class="caption-text">¡Libre de Impuestos!</div>
							<a target = "_blank" href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&ved=2ahUKEwjl0eiNjdXsAhXaIrkGHe9HAfwQFjAAegQIBBAC&url=http%3A%2F%2Fwww.sunat.gob.pe%2Flegislacion%2Fprocedim%2Fdespacho%2Fzofratacna%2FprocEspecif%2FctrlCambios%2Fanexos%2FLista-Bienes-An.doc&usg=AOvVaw1JIBv6r-HlVZB4Bnv9Kf5f" class="button medium">Más Informacion</a>
						</div>

					</li>
					<li data-index="rs-3" data-transition="fade" data-slotamount="default"
						data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000"
						data-rotate="0" data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7"
						data-saveperformance="off">

						<!-- Background -->
						<img src="images/market_place_usuario.jpg" alt="" data-bgposition="center center" data-bgfit="cover"
							data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina style="object-fit: cover"
							data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100"
							data-scaleend="112" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0"
							data-offsetend="0 0">

						<!-- Caption-->
						<div class="tp-caption centered custom-caption-2 tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0"
							id="slide-2-layer-2" data-x="['center','center','center','center']" data-hoffset="['0']"
							data-y="['middle','middle','middle','middle']" data-voffset="['0']"
							data-width="['640','640', 640','420','320']" data-height="auto" data-whitespace="nowrap"
							data-transform_idle="o:1;"
							data-transform_in="y:0;opacity:0;s:1000;e:Power2.easeOutExpo;s:400;e:Power2.easeOutExpo"
							data-transform_out="" data-mask_in="x:0px;y:[20%];s:inherit;e:inherit;"
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
							data-responsive_offset="on">

							<!-- Caption Content -->
							<div class="R_title margin-bottom-15" id="slide-2-layer-3"
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
								data-y="['middle','middle','middle','middle']" data-voffset="['-40','-40','-20','-80']"
								data-fontsize="['42','36', '32','36','22']" data-lineheight="['70','60','60','45','35']"
								data-width="['640','640', 640','420','320']" data-height="none" data-whitespace="normal"
								data-transform_idle="o:1;"
								data-transform_in="y:-50px;sX:2;sY:2;opacity:0;s:1000;e:Power4.easeOut;"
								data-transform_out="opacity:0;s:300;" data-start="600" data-splitin="none"
								data-splitout="none" data-basealign="slide" data-responsive_offset="off"
								data-responsive="off"
								style="z-index: 6; color: #fff; letter-spacing: 0px; font-weight: 600; ">Compra y Recibe</div>

								<div class="caption-text">Encuentra los mejores productos y empieza a comprar ¡Ya!.</div>
							<a href="/resultados" class="button medium">Buscar</a>
						</div>

					</li>

					<li data-index="rs-5" data-transition="fade" data-slotamount="default"
						data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000"
						data-rotate="0" data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7"
						data-saveperformance="off">

						<!-- Background -->
						<img src="images/banner_4_800x500-min.png" alt="" data-bgposition="center center" data-bgfit="cover"
							data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina style="object-fit: cover"
							data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100"
							data-scaleend="112" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0"
							data-offsetend="0 0">

						<!-- Caption-->
						<div class="tp-caption centered custom-caption-2 tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0"
							id="slide-2-layer-2" data-x="['center','center','center','center']" data-hoffset="['0']"
							data-y="['middle','middle','middle','middle']" data-voffset="['0']"
							data-width="['640','640', 640','420','320']" data-height="auto" data-whitespace="nowrap"
							data-transform_idle="o:1;"
							data-transform_in="y:0;opacity:0;s:1000;e:Power2.easeOutExpo;s:400;e:Power2.easeOutExpo"
							data-transform_out="" data-mask_in="x:0px;y:[20%];s:inherit;e:inherit;"
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
							data-responsive_offset="on">

							<!-- Caption Content -->
							<div class="R_title margin-bottom-15" id="slide-2-layer-3"
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
								data-y="['middle','middle','middle','middle']" data-voffset="['-40','-40','-20','-80']"
								data-fontsize="['42','36', '32','36','22']" data-lineheight="['70','60','60','45','35']"
								data-width="['640','640', 640','420','320']" data-height="none" data-whitespace="normal"
								data-transform_idle="o:1;"
								data-transform_in="y:-50px;sX:2;sY:2;opacity:0;s:1000;e:Power4.easeOut;"
								data-transform_out="opacity:0;s:300;" data-start="600" data-splitin="none"
								data-splitout="none" data-basealign="slide" data-responsive_offset="off"
								data-responsive="off"
								style="z-index: 6; color: #fff; letter-spacing: 0px; font-weight: 600; ">Distribuye tus productos</div>

								<div class="caption-text">Innovate y empieza a crecer vendiendo online todos tus productos en nuestra plataforma</div>
							<a href="/login" class="button medium">Registrarse</a>
						</div>

					</li>--}}

				</ul>

			</div>
		</div>

		<div class="main-search-inner" style="position:relative;
			z-index: 1;
			/* transform: translate(11%, -100%); */
			justify-content: center;
			align-items: center;
			display: flex;
			bottom:30px;
			/* flex-direction: row; */
		">
			{{-- <div class="container" style=" position:absolute; " >
				<div class="row">
					<div class="col-md-12" >
						<div class="main-search-input" style="	margin-top:0px; ">

							<form style="display: contents;"  action="/search-result" method="get" id='navigator-select'>


								<div class="main-search-input-item" >
 									<input type="text" name='ctg'  class="casaroyal-search-keyword form-control pxp-is-address" id="params-search" placeholder="Buscar" autocomplete="off">
									<input type="hidden" name='type' id='type'>
									 <ul class="casaroyal-search-locations-list" id="search-list"> </ul>
								</div>


								<div  style="display: flex;
									  align-items: center;
									  justify-content: center;" >
									<button  class="button" value="Buscar" style="margin-top:0px">Buscar</button>

								</div>


							</form>
						</div>
					</div>
				</div>
			</div> --}}

		</div>

		{{-- <div class="col-md-14">
			<h3 class="headline centered margin-top-35">
                <strong class="headline-with-separator">Pagar ahora</strong>
            </h3>
        </div> --}}

        {{-- <div class="col-md-12 padding-left-35 padding-right-35">
				<div class="col-md-6">
                	<section class="listings-container margin-top-30">

						<div class="row fs-listings">

							@for($i = 0; $i < 4; $i++)

								<div class="col-lg-6 col-md-6">
									<a href="/resultados/{{$productos_vendidos[$i]->userSlug}}/{{$productos_vendidos[$i]->userId}}/{{$productos_vendidos[$i]->productsSlug}}/{{$productos_vendidos[$i]->productsId}}" target = "_blank" class="listing-item-container compact" data-marker-id="5">
										<div class="listing-item">
											<img src="images/{{$productos_vendidos[$i]->image}}" alt="">
											<div class="listing-small-badges-container">
												<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>S/. {{number_format($productos_vendidos[$i]->price, 2, '.', ' ')}}</div>

											</div>
											<div class="listing-item-content">
												<h3>{{$productos_vendidos[$i]->name}}<i class="verified-icon"></i></h3>
												@if(strlen($productos_vendidos[$i]->description) > 29)
													<span>{{ucfirst(mb_substr($productos_vendidos[$i]->description, 0, 26, 'UTF-8'))}}<p class="ver-mas" style="display:inline;">Ver Más</p></span>

												@else
												<span>{{$productos_vendidos[$i]->description}}</span>

												@endif
 											</div>

										</div>
									</a>
								</div>
							@endfor


						</div>

					</section>
				</div> --}}

				{{-- <div class="col-md-6 margin-top-30 simple-fw-slick-carousel2">


						@for($i = 4; $i < 7; $i++)
						<div class="">
							<a href="/resultados/{{$productos_vendidos[$i]->userSlug}}/{{$productos_vendidos[$i]->userId}}/{{$productos_vendidos[$i]->productsSlug}}/{{$productos_vendidos[$i]->productsId}}" target = "_blank" class="blog-compact-item-container">
								<div class="blog-compact-item" style="height: 559px !important;">
									<img src="images/{{$productos_vendidos[$i]->image}}" alt="">
									<div class="listing-small-badges-container">
												<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>S/. {{number_format($productos_vendidos[$i]->price, 2, '.', ' ')}}</div>

											</div>
									<div class="blog-compact-item-content">

										<h3>{{$productos_vendidos[$i]->name}}<i class="verified-icon"></i></h3>

										<p></p>
										@if(strlen($productos_vendidos[$i]->description) > 170)
											<span>{{ucfirst(mb_substr($productos_vendidos[$i]->description, 0, 170, 'UTF-8'))}}<p class="ver-mas" style="display:inline;">Ver Más</p></span>
										@else
											<span>{{$productos_vendidos[$i]->description}}</span>
										@endif

									</div>
								</div>
							</a>
						</div> --}}
						{{-- @endfor --}}

				{{-- </div>
		</div> --}}



		{{-- <div class="col-md-12 padding-left-35 padding-right-35">
				<div class="col-md-6 margin-top-30 simple-fw-slick-carousel2">


						@for($i = 7; $i < 10; $i++)
						<div class="">
							<a href="/resultados/{{$productos_vendidos[$i]->userSlug}}/{{$productos_vendidos[$i]->userId}}/{{$productos_vendidos[$i]->productsSlug}}/{{$productos_vendidos[$i]->productsId}}" target = "_blank" class="blog-compact-item-container">
								<div class="blog-compact-item" style="height: 559px !important;">
									<img src="images/{{$productos_vendidos[$i]->image}}" alt="">
									<div class="listing-small-badges-container">
												<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>S/. {{number_format($productos_vendidos[$i]->price, 2, '.', ' ')}}</div>

									</div>
									<div class="blog-compact-item-content">

										<h3>{{$productos_vendidos[$i]->name}}<i class="verified-icon"></i></h3>
										<!--<p>{{$productos_aleatorios[$i]->description}}</p>-->
										<p></p>
										@if(strlen($productos_vendidos[$i]->description) > 170)
											<span>{{ucfirst(mb_substr($productos_vendidos[$i]->description, 0, 170, 'UTF-8'))}}<p class="ver-mas" style="display:inline;">Ver Más</p></span>
										@else
											<span>{{$productos_vendidos[$i]->description}}</span>
										@endif

									</div>
								</div>
							</a>
						</div>
						@endfor

				</div> --}}

				{{-- <div class="col-md-6">
                	<section class="listings-container margin-top-30">

						<div class="row fs-listings">

							@for($i = 10; $i < 14; $i++)

								<div class="col-lg-6 col-md-6">
									<a href="/resultados/{{$productos_vendidos[$i]->userSlug}}/{{$productos_vendidos[$i]->userId}}/{{$productos_vendidos[$i]->productsSlug}}/{{$productos_vendidos[$i]->productsId}}" target = "_blank" class="listing-item-container compact" data-marker-id="5">
										<div class="listing-item">

											<img src="images/{{$productos_vendidos[$i]->image}}" alt="">
											<div class="listing-small-badges-container">
												<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>S/. {{number_format($productos_vendidos[$i]->price, 2, '.', ' ')}}</div>

											</div>
											<div class="listing-item-content">
												<h3>{{$productos_vendidos[$i]->name}}<i class="verified-icon"></i></h3>
												@if(strlen($productos_vendidos[$i]->description) > 29)
													<span>{{ucfirst(mb_substr($productos_vendidos[$i]->description, 0, 26, 'UTF-8'))}}<p class="ver-mas" style="display:inline;">Ver Más</p></span>

												@else
												<span>{{$productos_vendidos[$i]->description}}</span>

												@endif

											</div>

										</div>
									</a>
								</div>
							@endfor

						</div>

					</section>
				</div> --}}
		</div>

		{{-- <section class="fullwidth border-top margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#fff">

			<div class="container">
				<div class="row">

					<div class="col-md-12 margin-top-50">
						<h3 class="headline centered margin-bottom-45">
							<strong class="headline-with-separator">Explore Nuestros Productos</strong>
							<span>Descubre el top de los productos mas solicitados</span>
						</h3>
					</div>
				</div>
			</div>

			<!-- Carousel / Start -->
			<div class="simple-fw-slick-carousel dots-nav">

				<!-- Listing Item -->

				<!-- Listing Item / End -->

				<!-- Listing Item -->
				@for($i = 6; $i < 11; $i++)



						<div class="fw-carousel-item">
							<a href="/resultados/{{$productos_aleatorios[$i]->userSlug}}/{{$productos_aleatorios[$i]->userId}}/{{$productos_aleatorios[$i]->productsSlug}}/{{$productos_aleatorios[$i]->productsId}}" target = "_blank" class="listing-item-container compact">
								<div class="listing-item">
									<img src="images/{{$productos_aleatorios[$i]->image}}" alt="">
									<div class="listing-small-badges-container">
												<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>S/. {{number_format($productos_aleatorios[$i]->price, 2, '.', ' ')}}</div>

											</div>
									<div class="listing-item-content">

										<h3 class="ultimos">{{$productos_aleatorios[$i]->name}}<i class="verified-icon"></i></h3>
										@if(strlen($productos_aleatorios[$i]->description) > 29)
											<span style="width:270px !important;" >{{ucfirst(mb_substr($productos_aleatorios[$i]->description, 0, 27, 'UTF-8'))}}<p class="ver-mas" style="display:inline;">Ver Más</p></span>

										@else
											<span style="width:270px !important;" >{{$productos_aleatorios[$i]->description}}</span>

										@endif
										<!--<span>{{$productos_aleatorios[$i]->description}}</span>-->
									</div>

								</div>
							</a>
						</div>

				@endfor


		</section> --}}

		{{-- <div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 class="headline centered margin-top-75">
						<strong class="headline-with-separator">Categorías Populares</strong>
					</h3>
				</div>

				<div class="col-md-12">
					<div class="categories-boxes-container margin-top-5 margin-bottom-30 " id="category6" style="display: flex; justify-content: center;">

					@foreach($category as $item)
					<a href="/resultados?business={{$item->id}}" target = "_blank" class="category-small-box">
						@if($item->business == '1')
							<i class="im im-icon-Hamburger"></i>
						@elseif($item->business == '6')
							<i class="im im-icon-TV"></i>
						@elseif($item->business == '3')
							<i class="im im-icon-WomanMan"></i>
						@elseif($item->business == '4')
							<i class="im im-icon-Shopping-Bag"></i>

						@elseif($item->business == '7')
							<i class="im im-icon-Cloud-Computer"></i>
						@elseif($item->business == '5')
							<i class="sl sl-icon-wrench"></i>
						@else
							<i class="sl sl-icon-layers"></i>
						@endif
						<h4>{{$item->name}}</h4>
						<span class="category-box-counter">{{$item->negocio}}</span>
					</a>
					@endforeach
					</div>
				</div>
			</div>
		</div> --}}

		{{-- <section class="fullwidth margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f8f8f8">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3 class="headline centered margin-bottom-45">
							<strong class="headline-with-separator">Empresas Registradas</strong>
							<span>Descubra las empresas mas solicitadas</span>
						</h3>
					</div>
					<div class="col-md-12">
						<div class="simple-slick-carousel dots-nav ">
								@foreach($restaurantes as $restaurant)
										<div class="carousel-item">
											<a href="/resultados/{{$restaurant->slug}}/{{$restaurant->id}}" target = "_blank" class="listing-item-container">
												<div class="listing-item">
													<img src="images/{{$restaurant->image}}" alt="">
													@if($restaurant->state == 1)
													<div class="listing-badge now-open">Abierto</div>
													@else
													<div class="listing-badge now-closed">Cerrado</div>
													@endif
													<div class="listing-item-content">

														<h3>{{$restaurant->company}}</h3><i class="verified-icon"></i></h3>
														<span style="display:inline;">{{$restaurant->name}}</span>
													</div>
													@if($restaurant->liked == "1")
													<span class="like-icon liked" data-id="{{$restaurant->id}}"></span>
													@else
													<span class="like-icon" data-id="{{$restaurant->id}}"></span>
													@endif

												</div>
												<div class="star-rating" data-rating="{{$restaurant->qualification}}">
													<div class="rating-counter">({{$restaurant->opinions}} críticas)</div>
												</div>
											</a>
										</div>
								@endforeach
						</div>
					</div>
				</div>
			</div>

		</section> --}}


	<script type="text/javascript" src={{asset('js/typed.js')}}></script>

	<script>
		var typed = new Typed('.typed-words', {
		strings: ["Global Market Plaza"],
			typeSpeed: 80,
			backSpeed: 80,
			backDelay: 4000,
			startDelay: 1000,
			loop: true,
			showCursor: true
		});
	</script>
	<style>
		.slick-prev {
			left: 108px;
			transform: translate3d(-90px, -50%, 0);
		}
		.slick-next {
			right: 108px;
			transform: translate3d(90px, -50%, 0);
		}
		.slick-prev:before, .slick-next:before {
			font-family: simple-line-icons;
			font-size: 32px;
			line-height: 1;
			opacity: 1;
			color: #fff !important;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			transition: all .3s;
		}
	</style>

@endsection
@section('after-scripts')
	<script type="text/javascript">
		$('.pay-cancel').on('click',function(){
			$('.sign-in').click();
		})


		$('.simple-fw-slick-carousel2').slick({
			infinite:true,
			autoplay:true,
			autoplaySpeed: 2000,
			slidesToShow:1,
			slidesToScroll:1,
			dots:false,
			arrows:true,
			responsive:[
				{
					breakpoint:1610,
					settings:
					{
						slidesToShow:1
					}
				},
				{
					breakpoint:1365,
					settings:
					{
						slidesToShow:1
					}
				},
				{
					breakpoint:1024,
					settings:
					{
						slidesToShow:1
					}
				},
				{
					breakpoint:767,
					settings:
					{
						slidesToShow:1
					}
				}
			]
		});
	</script>
	<script type="text/javascript" src={{asset('/js/frontend/profile.js')}}></script>
	<script type="text/javascript" src={{asset('js/frontend/calification.js')}}></script>
	<script type="text/javascript" src={{asset('js/frontend/map.js')}}></script>


    <script type="text/javascript">
		var tpj = jQuery;
		var revapi4;
		tpj(document).ready(function () {
			if (tpj("#rev_slider_4_1").revolution == undefined) {
				revslider_showDoubleJqueryError("#rev_slider_4_1");
			} else {
				revapi4 = tpj("#rev_slider_4_1").show().revolution({
					sliderType: "standard",
					jsFileLocation: "scripts/",
					sliderLayout: "auto",
					dottedOverlay: "none",
					delay: 3500,
					navigation: {
						keyboardNavigation: "off",
						keyboard_direction: "horizontal",
						mouseScrollNavigation: "off",
						onHoverStop: "on",
						touch: {
							touchenabled: "on",
							swipe_threshold: 75,
							swipe_min_touches: 1,
							swipe_direction: "horizontal",
							drag_block_vertical: false
						}
						,
						arrows: {
							style: "zeus",
							enable: true,
							hide_onmobile: true,
							hide_under: 600,
							hide_onleave: true,
							hide_delay: 200,
							hide_delay_mobile: 1200,
							tmp: '<div class="tp-title-wrap"></div>',
							left: {
								h_align: "left",
								v_align: "center",
								h_offset: 40,
								v_offset: 0
							},
							right: {
								h_align: "right",
								v_align: "center",
								h_offset: 40,
								v_offset: 0
							}
						}
						,
						bullets: {
							enable: false,
							hide_onmobile: true,
							hide_under: 600,
							style: "hermes",
							hide_onleave: true,
							hide_delay: 200,
							hide_delay_mobile: 1200,
							direction: "horizontal",
							h_align: "center",
							v_align: "bottom",
							h_offset: 0,
							v_offset: 32,
							space: 5,
							tmp: ''
						}
					},
					viewPort: {
						enable: true,
						outof: "pause",
						visible_area: "80%"
					},
					responsiveLevels: [1200, 992, 768, 480],
					visibilityLevels: [1200, 992, 768, 480],
					gridwidth: [1180, 1024, 778, 480],
					gridheight: [640, 500, 400, 300],
					lazyType: "none",
					parallax: {
						type: "mouse",
						origo: "slidercenter",
						speed: 2000,
						levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 25, 47, 48, 49, 50, 51, 55],
						type: "mouse",
					},
					shadow: 0,
					spinner: "off",
					stopLoop: "off",
					stopAfterLoops: -1,
					stopAtSlide: -1,
					shuffle: "off",
					autoHeight: "off",
					hideThumbsOnMobile: "off",
					hideSliderAtLimit: 0,
					hideCaptionAtLimit: 0,
					hideAllCaptionAtLilmit: 0,
					debugMode: false,
					fallbacks: {
						simplifyAll: "off",
						nextSlideOnWindowFocus: "off",
						disableFocusListener: false,
					}
				});
			}
		});
	</script>

	<script type="text/javascript">
		/*$('.simple-fw-slick-carousel').slick({infinite:true,slidesToShow:5,slidesToScroll:1,dots:true,arrows:false,responsive:[{breakpoint:1610,settings:{slidesToShow:5,}},{breakpoint:1365,settings:{slidesToShow:3,}},{breakpoint:1024,settings:{slidesToShow:2,}},{breakpoint:767,settings:{slidesToShow:1,}}]});*/
		$('.simple-fw-slick-carousel2').slick({infinite:true,autoplay: true,autoplaySpeed: 2000,slidesToShow:1,slidesToScroll:1,dots:false,arrows:true,responsive:[{breakpoint:1610,settings:{slidesToShow:1,}},{breakpoint:1365,settings:{slidesToShow:1,}},{breakpoint:1024,settings:{slidesToShow:1,}},{breakpoint:767,settings:{slidesToShow:1,}}]});

	</script>

		<script src={{asset('js/switcher.js')}}></script>


		<script src={{asset('js/filter_parameter.js')}}></script>
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

@endsection
