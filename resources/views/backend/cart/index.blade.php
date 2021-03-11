@extends('backend.app')
@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}

  				<!-- Titlebar -->
  		<div id="titlebar" style="margin-bottom: 15px;  ">
  			<div class="row">
  				<div class="col-md-12">
  										<h1>La carta</h1>
  										<!-- Breadcrumbs -->
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/admin/carta">Carta</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>

      <div class="dashboard-list-box margin-top-0">

        <div class="list-box-listing">
          <div>
            <h4 style="background-color: #f7f7f7">Listado de cartas</h4>
          </div>
        </div>
      	<ul>

          {{-- <ul>
    				<li class="wallet-empty-list"><i class="list-box-icon sl sl-icon-basket">
    			</ul> --}}

      			<li>

              @php
        				$i = 0;
        			@endphp
            @foreach ($cartita as $cartitas)
              @php
        				$i = $i + 1;
        			@endphp
              <div class="toggle-wrap style-2 div-principal">
                <span class="trigger opened">
                  <a href="#" style="padding-bottom: 0cm;padding-top: 0cm;"> {{$cart_name[$i][0]->name}}
                    {{-- <select name="_menu[0][menu_elements][0][bookable_options]"  data-id_classification="{{$cart_name[$i][0]->id}}" class="adicionar-item" >
                      <option disabled selected value="byguest">Agrega un plato a la categoría</option>
                      @foreach ($dish as $dishes)
                        <option value="{{$dishes->id}}">{{$dishes->name}}</option>
                      @endforeach
        						</select> --}}
                    <i class="sl sl-icon-plus"> </i>
                  </a>
                </span>
                <div class="toggle-container" style="display: none;">
                  <div class="wpb_text_column wpb_content_element row">
                        <div class="wpb_wrapper col-sm-6">
                    			<table class="basic-table table-detalle" >
                            <tbody>
                              <tr>
                                <th style="background-color: #334033;">Nº</th>
                                <th style="background-color: #334033;">Platos</th>
                                <th style="background-color: #334033;">Acción</th>
                              </tr>
                              @foreach ($cartitas as $cartitas2)
                                <tr >
                                <td class="administrar-detalle">{{$cartitas2->d_id}}</td>
                                <td class="administrar-detalle">{{$cartitas2->d_name}}</td>
                                <td class="administrar-detalle">
                                  <a class="button eliminar-item" data-id_dish="{{$cartitas2->d_id}}" data-id_clasification="{{$cartitas2->cl_id}}" style="background-color: #334033;">Eliminar</a>
                                </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                    		</div>
  	                </div>
                </div>
              </div>
            @endforeach

      		</li>

      	</ul>
      </div>

  {{-- --------------------------------------------------------- --}}

    <div class="row">
        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">© 2020 Rivercon. All Rights Reserved.</div>
        </div>
    </div>

</div>
@endsection

@section('js')
  <script src="{{ asset('js/backend/cart.js') }}"></script>
@endsection
