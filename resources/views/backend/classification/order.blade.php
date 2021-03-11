@extends('backend.app')
@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}

  				<!-- Titlebar -->
  		<div id="titlebar">
  			<div class="row">
  				<div class="col-md-12">
  										<h1>Carta</h1>
  										<!-- Breadcrumbs -->
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                {{-- <li><a href="/admin/clasificaciones">Categorías</a></li> --}}
                <li><a href="/admin/clasificaciones/ordenarClasificacion">Ordenar categoría</a></li>
              </ul>
  					</nav>
  				</div>
  			</div>
  		</div>


  <div class="dashboard-list-box margin-top-0">

    <div class="list-box-listing">
      <div>
        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Ordenar carta</h4>
      </div>
      <div class="list-box-listing-content col-md-6">
        {{-- <div class="inner float-right" style="display:flex; justify-content:flex-end">
          <a href="/admin/clasificaciones/nuevaClasificacion" class="button"> Nueva categoría</a>
        </div> --}}
      </div>
    </div>

    <ul>

        <li>

          <form class="" action="/admin/clasificaciones/subirOrden" method="POST" enctype="multipart/form-data">
            @csrf
      		<table id="pricing-list-container">
      			<tbody class="ui-sortable">
              @php
        				$i = 0;
        			@endphp
            @foreach ($cartita as $cartitas)
              @php
        				$i = $i + 1;
        			@endphp

                  <tr class="pricing-list-item pricing-submenu" data-number="0" style="opacity: 1;">
                    <td>
                      <div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>
                      <div class="fm-input">
                        <input name="orden[]" type="text"  placeholder="Category Title" value="{{$cart_name[$i][0]->name}}" readonly>
                      </div>

                        <div class="fm-input pricing-bookable-options">
                          <select class="chosen-select"    style="display: none;">
                              @if ( $cartitas== null)
                                  <option value="onetime" >Sin platos</option>
                              @endif
                            @foreach ($cartitas as $cartitas2)
                              <option value="onetime" >{{$cartitas2->d_name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </td>
                  </tr>
  @endforeach
      			<tr class="pricing-list-item pattern" data-iterator="0" style="opacity: 1;">

      			</tr>
      		</tbody>
      	</table>
        <button type="submit"  value="Submit" class="button margin-top-20 margin-bottom-20">Guardar orden</button>
      		{{-- <a href="#" class="button add-pricing-submenu">Add Category</a> --}}
        </form>
      </li>
    </ul>
  </div>


  {{-- --------------------------------------------------------- --}}

    <div class="row">
        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">Derechos reservados. ®Rcom Global LCC.</div>
        </div>
    </div>

</div>
@endsection
