@extends('frontend.app' )
{{--<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>

<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
--}}
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />
<script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>

@section('content')
<style>
    .botonRegresar{
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      background: #5EB761;
      padding: 10px;
      border-radius: 5px;
      color: white;
      margin-right: 110px;
    }
    .botonPredial{
      cursor: pointer;
      background: #D59019;
      padding: 10px;
      border-radius: 10px;
      color: white;
      display: flex;
      align-items: center;
    }
    .inputBuscarPredial{
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .card_logo{
        height: 140px;
        display:block;
        margin:auto;
    }
    .add-listing-section {
    border-radius: 4px;
    background-color: #fff;
    box-shadow: 0 0 0 0;
    padding: 0 40px 25px;
	padding-bottom: 0px;
    }
    .add-listing-headline {
        width: calc(100% + 80px);
        left: -40px;
        position: relative;
        padding: 30px 40px;
        margin: 0 0 0;
        border-radius: 4px 4px 0 0;
        background-color: #fff;
        border-bottom: 0px;
    }
    @media only screen and (max-width: 1024px){
        #boton-cancelar{
            width: 100px;
            margin-left: 15px !important;
        }
        .payment-tab.payment-tab-active {
        max-height: 1024px;
        }
        .payment{

        margin-left: 10px;
        margin-right: 10px;

        }
        .botonCardRemeber{
            margin-top: 10px !important;
        }
        .account-type input.account-type-radio:empty ~ label {
            position: relative;
            float: left;
            padding: 10px;
            text-align: center;
            padding-bottom: 11px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border-radius: 4px;
            color: #888;
            transition: 0.4s;
            height: 48px;
            line-height: 28px;
            overflow: hidden;
            margin: none !important;
            width: 100% !important;
            white-space: nowrap !important;
        }
        .account-type-tipo input.account-type-radio-tipo:empty ~ label {
            position: relative;
            /*float: left;*/
            padding: 10px;
            text-align: center;
            padding-bottom: 11px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border-radius: 4px;
            color: #888;
            transition: 0.4s;
            height: 48px;
            line-height: 28px;
            overflow: hidden;
            margin: none !important;
            width: 100% !important;
            white-space: nowrap !important;
        }
    }

</style>
<style>
.account-type {
    display: flex;
    width: calc(100% + 20px);
    margin: 0 0 10px 0;
}
.account-type div {
    flex: 1;
    margin-right: 20px;
}
.account-type input.account-type-radio:empty {
    display: none;
}
.account-type input.account-type-radio:empty ~ label {
    position: relative;
    /*float: left;*/
    padding: 10px;
    text-align: center;
    padding-bottom: 11px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border-radius: 4px;
    color: #888;
    transition: 0.4s;
    height: 48px;
    line-height: 28px;
    overflow: hidden;
    margin: auto;
    width: 50%;
}
.account-type label {
    border-radius: 3px;
    border: none;
    background-color: #f2f2f2;
    width: 100%;
}
.account-type input.account-type-radio:empty ~ label:after, .account-type input.account-type-radio:empty ~ label:before {
    position: absolute;
    display: block;
    top: 0;
    bottom: 0;
    left: 0;
    content: '';
    width: 100%;
    height: 100%;
    text-align: center;
    line-height: 48px;
    border-radius: 4px;
    font-size: 22px;
    background: transparent;
    z-index: 100;
    opacity: 0;
}
.account-type input.account-type-radio:checked ~ label {
    background-color: #4CAF50;
}
.account-type input.account-type-radio:checked ~ label i {
    color: #fff;
}
.account-type input.account-type-radio:checked ~ label {
    color: #fff;
    /*background-color: #66676b;*/
}
</style>
<style>
    .account-type-tipo {
    display: flex;
    width: calc(100% + 20px);
    margin: 0 0 10px 0;
}
.account-type-tipo div {
    flex: 1;
    margin-right: 20px;
}
.account-type-tipo input.account-type-radio-tipo:empty {
    display: none;
}
.account-type-tipo input.account-type-radio-tipo:empty ~ label {
    position: relative;
    /*float: left;*/
    padding: 10px;
    text-align: center;
    padding-bottom: 11px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border-radius: 4px;
    color: #888;
    transition: 0.4s;
    height: 48px;
    line-height: 28px;
    overflow: hidden;
    margin: auto;
    width: 50%;
}
.account-type-tipo label {
    border-radius: 3px;
    border: none;
    background-color: #f2f2f2;
    width: 100%;
}
.account-type-tipo input.account-type-radio-tipo:empty ~ label:after, .account-type-tipo input.account-type-radio-tipo:empty ~ label:before {
    position: absolute;
    display: block;
    top: 0;
    bottom: 0;
    left: 0;
    content: '';
    width: 100%;
    height: 100%;
    text-align: center;
    line-height: 48px;
    border-radius: 4px;
    font-size: 22px;
    background: transparent;
    z-index: 100;
    opacity: 0;
}
.account-type-tipo input.account-type-radio-tipo:checked ~ label {
    background-color: #4CAF50;
}
.account-type-tipo input.account-type-radio-tipo:checked ~ label i {
    color: #fff;
}
.account-type-tipo input.account-type-radio-tipo:checked ~ label {
    color: #fff;
    /*background-color: #66676b;*/
}

</style>

<script src="{{ asset('js/dropzone.js') }}"></script>
@if (Session::get('costumer'))

<div id="titlebar" style="padding: 39px 0;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Pago de impuestos: Sigue los 3 pasos.</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="/">Principal</a></li>
						<li>Facturación</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<div class="container margin-bottom-45">


	<div class="row">

		<div class="col-md-12">
          <ul class="list-3 color">
		        <li id="pasosPago1" style="font-size:20px;">Paso 1 de 3: Inserción del código de pago </li>
            <li hidden id="pasosPago2" style="font-size:20px;">Paso 2 de 3: Pago del predio total </li>
            <li hidden id="pasosPago3" style="font-size:20px;">Paso 3 de 3: Facturación del pago </li>
					</ul>

		</div>
				<div class="style-1" id="tabsTax">
					<!-- Tabs Navigation -->
					<ul class="tabs-nav">
						<li style="width:32%;pointer-events: none;" class="active" id="tabCodigo"><a href="#tab1a" style="text-align:center; display:block;font-size: 17px;" id="tabBuscar"><i class="sl sl-icon-user"></i> Código predial</a></li>
						<li style="width:32%;pointer-events: none;" class ="disactive" ><a href="#tab2a" style="text-align:center; display:block;font-size: 17px;" id="tabPagar"><i class="sl sl-icon-credit-card"></i>Medios de pago</a></li>
            <li style="width:32%;pointer-events: none;" ><a href="#tab3a" style="text-align:center; display:block;font-size: 17px;" id="tabFactura"><i class="sl sl-icon-credit-card"></i>Facturación</a></li>
					</ul>

					<!-- Tabs Content -->
					<div class="tabs-container">
						<div class="tab-content" id="tab1a"  >
              <div class="inputBuscarPredial">
                <div class="" style="margin-bottom: 30px;width: 230px ">
                    <input style="  text-align: center;" id="codigoPago" type="text" name="" value="" placeholder="Ingrese su código predial">
                </div>

                {{-- <div class="botonPredial" id="buscarCodigoPredial">
                    <p style="font-size: large; font-weight: 600;">Buscar código predial</p>
                </div> --}}

                <div  class="botonPredial" id="buscarCodigoPredial">
                   <div ><i class="sl sl-icon-magnifier"></i></div>
                   <div style="margin-left: 10px; "><h4 style="font-weight: 500; color: white;margin: 5px;">Buscar código predial</h4></div>
                </div>

              </div>


              <div class="" id="detallePredial" hidden>
                <div class="table-responsive">
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" colspan="8">DATOS DEL CONTRIBUYENTE</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row" >NOMBRE O RAZON SOCIAL</th>
                          <td colspan="4"  class="nombres">ESPINOZA GALLANGOS AUGUSTO JAVIER</td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td style="font-weight: 700;" >N° DOCUMENTO</td>
                          <td id="dni">75528754</td>
                        </tr>
                        <tr>
                          <th scope="row" >TIPO DE CONTRIBUYENTE</th>
                          <td colspan="4">PERSONA NATURAL</td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td style="font-weight: 700;">CONDICIÓN DEL CONTRIBUYENTE</td>
                          <td>PAGANTE</td>
                        </tr>


                      </tbody>
                    </table>
                </div>

                <div class="table-responsive"   >
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" colspan="8">RELACIÓN DE PREDIOS DECLARADOS</th>
                        </tr>
                        <tr>
                          <th scope="col">ANEXO</th>
                          <th scope="col">UBICACIÓN DEL PREDIO</th>
                          <th scope="col">CÓDIGO CATASTRAL</th>
                          <th scope="col">CODIGO PREDIAL</th>
                          <th scope="col">ESTADO</th>
                          <th scope="col">AUTOAVALÚO</th>
                          <th scope="col">% part.</th>
                          <th scope="col">AUTOAVALÚO AFECTO</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">0001</th>
                          <td id="ub">CALLE UGARTE MANUEL 1045</td>
                          <td id="ct">69142464A56545</td>
                          <td id="cp">56545</td>
                          <td id="es">INS</td>
                          <td id="au">6085120</td>
                          <td id="part">50%</td>
                          <td class="aa">3012564</td>
                        </tr>
                        {{-- <tr>
                          <th scope="row">0002</th>
                          <td>CALLE UGARTE MANUEL 1045</td>
                          <td>69142464A56545</td>
                          <td>56545</td>
                          <td>INS</td>
                          <td>6085120</td>
                          <td>50%</td>
                          <td>3012564</td>
                        </tr>
                        <tr>
                          <th scope="row">0003</th>
                          <td>CALLE UGARTE MANUEL 1045</td>
                          <td>69142464A56545</td>
                          <td>56545</td>
                          <td>INS</td>
                          <td>6085120</td>
                          <td>50%</td>
                          <td>3012564</td>
                        </tr> --}}

                      </tbody>
                    </table>

                    <table class="table">
                        <tbody>
                          <tr>
                            <th scope="row" colspan="6"> Número de predios:</th>
                            <td> 1</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td style="font-weight: 700;">AUTOAVALÚO AFECTO</td>
                            <td class="aa">3000.00</td>
                          </tr>
                          <tr>
                            <th scope="row" colspan="6"> </th>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td style="font-weight: 700;">IMPUESTO ANUAL</td>
                            <td id="ty">50.00</td>
                          </tr>
                          <tr>
                            <th scope="row" colspan="6"> </th>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td style="font-weight: 700;">TOTAL</td>
                            <td class="total">3050.00</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
              </div>
                              <div style="    display: flex; justify-content: center;">
                                <div class="">
                                  <button class="button fullwidth margin-top-20 margin-left-0" id="boton-cancelar" onClick="window.location='/'" style="width:100px;"> Inicio</button>
                                </div>
                                <div class="">
                                  <button class="button fullwidth margin-top-20 margin-left-35 guardar" style="width:100px;" id="continuar2"> Pagar</button>
                                </div>
                              </div>




						</div>

          <div class="tab-content" id="tab2a" style="display: none; padding: 0px 0 0;">
            <div class="" style="margin-top: 20px;">
              <div class="" style="display: flex;justify-content: space-between;margin: 10px;">
                <div  class="botonRegresar nuevaConsulta" >
                   <div ><i class="sl sl-icon-magnifier"></i></div>
                   <div style="margin-left: 10px; "><h4 style="font-weight: 500; color: white;margin: 5px;">Realizar nueva consulta</h4></div>
                </div>

                {{-- <div  style="    display: flex; align-items: center;">
                   <div ><i class="sl sl-icon-cursor"></i></div>
                   <div style="margin-left: 10px; "><h4 style="font-weight: 500; color: black;">Pagar con:</h4></div>
                </div> --}}

                <div  style="    display: flex; justify-content: center; align-items: center;">
                   <div ><i class="sl sl-icon-tag"></i></div>
                   <div  style="margin-left: 10px; "><h4 style="font-weight: 500;color: #50a253;margin: 5px;">Total pago de impuestos: S/.<span class="total">3050.00</span></h4></div>
                </div>
              </div>

            </div>
          <div class="" style="    display: flex; align-items: center; justify-content: space-around;">

            <div class="" style="width: -webkit-fill-available; text-align: center;">
                {{-- Otro medio de pago --}}
            </div>

            <div class="" style="width: -webkit-fill-available;margin: 20px;">
                <div id="paypal-button-container"></div>
            </div>

            <div class="" style="width: -webkit-fill-available; text-align: center;">
                {{-- Otro medio de pago --}}
            </div>

          </div>



						</div>

						<div class="tab-content" id="tab3a" style="display: none;">
              <div class="row" style="padding: 20px;">
                  <div class="col-md-12" id="header-paso-3">
                      <h3 class="headline margin-bottom-0" style="font-size:40px;">¡IMPUESTO PREDIAL SALDADO!</h3>
                      <h5 class="margin-bottom-30" style="font-weight: 600;font-size:15px;"> Recibiras una confirmacion a traves de un correo electronico con el resumen de tu pago</h5>
                      <p class="margin-bottom-0"><strong style="font-weight:600;color:black;">Número de Pago: </strong> # <span class='idpago'>000528</span></p>
                      <p><strong style="font-weight:600;color:black;">Fecha de Pago: </strong> <span class="datepago">08/03/2021</span></p>
                      <div class="col-md-8 padding-left-0">
                          <h3 class="margin-bottom-20"><i class="im im-icon-Arrow-Forward2"></i> Información del Pago</h3>

                          <p class="margin-bottom-0 nombres">ESPINOZA GALLANGOS AUGUSTO JAVIER</p>
                          <p class="margin-bottom-0 dni">75520945</p>

                          <p class="margin-bottom-0 cel">001878041</p>
                          <p class="margin-bottom-0 tel">987653258</p>
                          <p class="margin-bottom-0" id="email">espinoza_g45@hotmail.com</p>
                      </div>
                      <div class="col-md-4" style="margin-top:71px;">
                          <p class="margin-bottom-0">El pago del código predial detallado en la tabla.</p>
                          {{-- <p class="margin-bottom-0">El rango de fecha de entrega es referencial y se encuentra sujeto a la información dada por la tienda.</p> --}}

                      </div>

                  </div>
                  <div class="col-md-12 margin-top-50">
                    <div class="table-responsive">
                      <table class="table">
                          <thead>
                            <tr>
                              <th scope="col" colspan="8">FACTURACIÓN DEL PAGO</th>

                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row" >FECHA DE EMISIÓN</th>
                              <td colspan="4" class="datepago"> 08/03/2021</td>
                              <td> </td>
                              <td> </td>
                              <td> </td>
                              <td> </td>
                              <td style="font-weight: 700;">N° DE PAGO</td>
                              <td class='idpago'>000528</td>
                            </tr>
                            <tr>
                              <th scope="row" >SEÑOR(ES)</th>
                              <td colspan="4" class="nombres">ESPINOZA GALLANGOS AUGUSTO JAVIER</td>
                              <td> </td>
                              <td> </td>
                              <td> </td>
                              <td> </td>
                              <td style="font-weight: 700;">IMPORTE TOTAL DEL PAGO</td>
                              <td class="total">3050.00</td>
                            </tr>


                          </tbody>
                        </table>
                    </div>
                          {{-- <table class="basic-table">
                                  <thead>
                                      <tr>

                                          <th style="width:50%;">Producto</th>
                                          <th style="text-align: center;width:25%;">Cantidad</th>
                                          <th style="text-align: center;width:25%;">Total</th>

                                      </tr>
                                  </thead>
                                  <tbody id="tBodyCheckout">
                                  @foreach($detail as $item)
                                      @php
                                          $total = $total + $item->subtotal + $item->comision;
                                      @endphp
                                      <tr>

                                          <td  class="column-1">
                                              <div class="dashboard-list-box invoices with-icons ">
                                                  <ul>

                                                      <li>
                                                          <i class="list-box-icon sl sl-icon-basket"> </i>
                                                          <div class="text-checkout">


                                      @if($item->attribute_name == "" && $item->variation_name == "")

                                          <strong style="font-weight:600;">{{$item->nombre}}</strong>
                                      @else
                                          <strong style="font-weight:600;">{{$item->nombre}} - {{$item->attribute_name}} - {{$item->variation_name}}</strong>
                                      @endif
                                                              <ul>
                                                              <li class="paid">Precio: S/.{{number_format($item->price, 2, '.', '')}}</li>
                                                              <li class="paid">Tiempo de entrega: {{$item->time_delay}}</li>
                                                              <li class="paid">Tienda: {{$item->company}}</li>


                                                              </ul>
                                                          </div>
                                                  </li>
                                              </ul>
                                          </div>
                                      </td>
                                      <td  class="column-2" style="text-align: center">

                                              <div class="plusminus horiz">

                                                  <input style="font-weight:600;" class="input-cant"  type="number" name="slot-qty" readonly value="{{$item->cant}}" min="1" max="99">

                                              </div>

                                      </td>
                                          <td class="column-3" style="text-align: end;background-color:white;">
                                              <div style="margin-right: 90px;">S/.{{number_format($item->subtotal, 2, '.', '')}}</div>
                                          </td>

                                      </tr>
                                      @if($item->comision != 0)
                                          <tr>

                                              <td  class="column-1 comision" colspan="2" align="center" style="text-align: center;background-color:white;">
                                                  <strong style="font-weight:600;">Comisión de Envío: </strong>
                                              </td>

                                              <td class="column-3" style="text-align: end;background-color:white;">
                                                  <div style="margin-right: 90px;">S/.{{number_format($item->comision, 2, '.', '')}}</div>
                                              </td>

                                          </tr>
                                      @endif
                                  @endforeach
                                  <tr>

                                      <td  class="column-1 comision" colspan="2" align="center" style="text-align: center;background-color:white;">
                                          <strong style="font-weight:600;">TOTAL: </strong>
                                      </td>

                                      <td class="column-3" style="text-align: end;background-color:white;">
                                          <div style="margin-right: 90px;">S/.{{number_format($total, 2, '.', '')}}</div>
                                      </td>

                                  </tr>
                                  </tbody>
                          </table> --}}

                  </div>

                  <div  class="botonRegresar nuevaConsulta" style="margin-right: 0px;">
                     <div ><i class="sl sl-icon-magnifier"></i></div>
                     <div style="margin-left: 10px; "><h4 style="font-weight: 500; color: white;margin: 5px;">Realizar nueva consulta</h4></div>
                  </div>



              </div>

						</div>
					</div>
				</div>

		</div>
	</div>


</div>
@else
<script>
    window.location='/checkout';
</script>
@endif


@endsection

@section('after-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src={{asset('/js/frontend/card.js')}}></script>
<style>
    #swal2-title{
        font-size:2.875em;
    }
    #swal2-content{
        font-size: 1.6em;
    }
    .swal2-popup{
        width: auto;
        height: auto;
    }
    .payment-tab-trigger>input:checked~label::before {
    border-color: #4CAF50;
    }
    .payment-tab-trigger>input:checked~label::after {
    background-color: #4CAF50;
}
</style>
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>
<script src={{asset('/js/frontend/tax.js')}}></script>
{{-- <script src={{asset('/js/frontend/checkout_final_mapa.js')}}></script>  --}}
{{-- <script src="{{ asset('js/map-checkout.js') }}"></script> --}}
{{-- <script src={{asset('/js/frontend/checkout-final.js')}}></script> --}}

 @endsection
