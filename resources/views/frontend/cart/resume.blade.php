@extends('frontend.app' , ['bussines'=> $bussines, 'users', $users])
<script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>

@section('content')
<style>

    .btn-add {
		background: #aaa !important;
		color: #fff !important;
	}
	#header-container.fixed {
		position: relative;
	}
	#checkout-paypal {
		background: #fff;
    padding: 40px;
    padding-top: 0;
    text-align: left;
    max-width: 610px;
    margin: 40px auto;
    position: relative;
    box-sizing: border-box;
    border-radius: 4px;
	height: 80% !important;
	}
	.dashboard-list-box {
		margin: 0px 0 0;
		box-shadow: none;
		border-radius: 0px;
	}
	.dashboard-list-box ul {
		list-style: none;
		padding: 0;
		margin: 0;
		background-color: #fff;
		  border-radius: 0 0 0 0 !important;
	}
	.column-1 {
		padding: 1px !important;
	}
	.column-2 {
		padding: 1px !important;
		text-align: center;
		background: white;
		border: 1px solid #f6f6f6;
	}
	table.basic-table th:first-child {
		border-radius: 0 0 0 0;
	}
	table.basic-table th:last-child {
		border-radius: 0 0 0 0;
	}
	table.basic-table tbody tr {
		border: 1px solid #000;
		background: #f6f6f6;
	}
	table.basic-table th {
		background-color: #66676b !important;
	}
	.dashboard-list-box{
		border-bottom: 1px solid #e0e0e0e0;
	}
	.message-error{
		color:red;
	}
	.mfp-container{
		position:fixed;
	}
	.center{
		text-align:center;
		display:block;
	}
    @media only screen and (max-width: 1024px){
        .row{
            margin-right: 0px !important;
            margin-left: 0px !important;
        }
        /*TABLA DE RESUMEN */
        table.basic-table td {
		border-bottom: 1px solid #ddd;
		display: block;
		font-size: 14px;
		text-align: center;
        }
        .text-checkout{
            text-align:left;

        }
        .seccion-borrar{
            display:none !important;
        }
        .plusminus{
            margin-top: 5px !important;
            margin-bottom: 5px !important;
        }
        .seccion-total{
            margin-top:7px !important;
            margin-bottom: 7px !important;
        }
        table.basic-table td.deleteMobile{
            display: block !important;
        }
        .column-3{
            text-align: center !important;
        }
        .column-3 div{
            margin-right: 0 !important;
        }
        .comision{
            padding: 15px 28px !important;
        }
        #not-found h2{
                height: 45% !important;
            }
        #not-found i{
                height: 20% !important;
            }
        /*TABLA DE RESUMEN */
    }
	</style>
    @if (Session::get('costumer')) 
    
        <div id="titlebar" style="padding: 39px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <h2>Facturación: Sigue los 3 pasos.</h2>

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
                                <li id="pasos" style="font-size:20px;">Paso 3 de 3: Información del pedido</li>

                            </ul>

                </div>
                        <div class="style-1">
                            <!-- Tabs Navigation -->
                            <ul class="tabs-nav">
                                <li style="width:100%;pointer-events:none;"><a href="#tab3a" style="text-align:center; display:block;font-size: 17px;"><i class="im im-icon-Shopping-Bag"></i>Información de Pedido</a></li>
                            </ul>

                            <!-- Tabs Content -->
                            <div class="tabs-container">
                                
                                <div class="tab-content" id="tab3a">
                                
                                
                                    @php
                                        $status = Session::get('status');
                                        
                                    @endphp
                                    @if(isset($status))
                                        @php
                                            $message = Session::get('message');
                                        @endphp
                                        @switch($status)
                                            @case(500)
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-warning margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">  Sistema en mantenimiento</h2>
                                                        <p>Disculpe las molestias, inténtelo mas tarde.</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break;
                                            @case(200)
                                                @php
                                                    $orden = Session::get('orden');
                                                    $fecha = Session::get('fecha');
                                                    $detail = Session::get('detail'); 
                                                    $nombre = Session::get('nombre'); 
                                                    $apellido = Session::get('apellido'); 
                                                    $direccion = Session::get('direccion'); 
                                                    $email = Session::get('email'); 
                                                    $telefono = Session::get('telefono'); 
                                                    $celular = Session::get('celular');
                                                    $departamento = Session::get('departamento');
                                                    $provincia = Session::get('provincia');
                                                    $distrito = Session::get('distrito');
                                                    $limiteRestante = Session::get('limiteRestante');
                                                    $limiteTotal = Session::get('limiteTotal');
                                                    $fleg = Session::get('fleg');
                                                    $dni = Session::get('dni');
                                                    $total = 0;
                                                @endphp

                                                <div class="row">
                                                    <div class="col-md-12" id="header-paso-3">
                                                        <h3 class="headline margin-bottom-0" style="font-size:40px;">¡GRACIAS POR TU COMPRA!</h3>
                                                        <h5 class="margin-bottom-30" style="font-weight: 600;font-size:15px;"> Recibiras una confirmacion a traves de un correo electronico con el resumen de tu pedido</h5>
                                                        <p class="margin-bottom-0"><strong style="font-weight:600;color:black;">Numero de Orden: </strong> #{{$orden}}</p>
                                                        <p><strong style="font-weight:600;color:black;">Fecha de Orden: </strong> {{$fecha}}</p>
                                                        <div class="col-md-8 padding-left-0">
                                                            <h3 class="margin-bottom-20"><i class="im im-icon-Arrow-Forward2"></i> Información del Pedido</h3>
                                                            <p class="margin-bottom-0"><strong style="font-weight:600;color:black;">Dirección de Destino: </strong></p>
                                                            
                                                            
                                                            <p class="margin-bottom-0">{{$nombre}} {{$apellido}}</p>
                                                            <p class="margin-bottom-0">{{$dni}}</p>
                                                            @if($departamento)
                                                                <p class="margin-bottom-0">{{$departamento}} - {{$provincia}} - {{$distrito}}</p>
                                                                <p class="margin-bottom-0">{{$direccion}}</p>
                                                            @endif
                                                            <p class="margin-bottom-0">{{$telefono}}</p>
                                                            <p class="margin-bottom-0">{{$celular}}</p>
                                                            <p class="margin-bottom-0">{{$email}}</p>
                                                        </div>
                                                        <div class="col-md-4" style="margin-top:71px;">
                                                            <p class="margin-bottom-0"><strong style="font-weight:600;color:black;">Plazo de Entrega: </strong></p>
                                                            <p class="margin-bottom-0">Detallado en la tabla.</p>
                                                            <p class="margin-bottom-0">El rango de fecha de entrega es referencial y se encuentra sujeto a la información dada por la tienda.</p>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-12 margin-top-50">
                                                            <table class="basic-table">
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
                                                            </table>

                                                    </div>
                                                    @if($fleg)
                                                        <div class="col-md-12 margin-top-50">
                                                            <div class="notification error closeable margin-top-15">
                                                                <p style="font-size: 18px"> <i class="fa fa-warning"></i><strong>   ¡Advertencia!</strong> Por ser una compra fuera del departamento de Tacna, le queda <strong>S/. {{number_format($limiteRestante, 2, '.', '')}}</strong> de <strong>S/. {{number_format($limiteTotal, 2, '.', '')}}</strong> para poder seguir efectuando compras.</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    
                                                </div>
                                                <script>
                                                    //localStorage.clear();
                                                </script>
                                                @break
                                            @case(201)
                                                @php
                                                    $detail = Session::get('detail');
                                                @endphp
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-warning margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">{{$message}}</h2>
                                                        <p>{{$detail}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(202)
                                                @php
                                                    $detail = Session::get('detail');
                                                @endphp
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-warning margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">{{$message}}</h2>
                                                        <p>{{$detail}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(203)
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-credit-card-alt margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;"> Numero de tarjeta errónea</h2>
                                                        <p>{{$message}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(204)
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-calendar-times-o margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;"> Datos Erróneos</h2>
                                                        <p>{{$message}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(205)
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-user-times margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">{{$message}}</h2>
                                                        <p>Los datos de la tarjeta son incorrectos</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(206)
                                                @php
                                                    $detail = Session::get('detail');
                                                @endphp
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-lock margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">{{$message}}</h2>
                                                        <p>{{$detail}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(207)
                                                @php
                                                    $detail = Session::get('detail');
                                                @endphp
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-close margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">{{$message}}</h2>
                                                        <p>{{$detail}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(208)
                                                @php
                                                    $detail = Session::get('detail');
                                                @endphp
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="im im-icon-Bank margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">{{$message}}</h2>
                                                        <p>{{$detail}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(209)
                                                @php
                                                    $detail = Session::get('detail');
                                                @endphp
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-bank margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">{{$message}}</h2>
                                                        <p>{{$detail}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(210)
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-close margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">{{$message}}</h2>
                                                        <p>Use otra tarjeta u otro medio de pago.</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(211)
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-credit-card margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">  Use otra tarjeta</h2>
                                                        <p>{{$message}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(212)
                                                @php
                                                    $detail = Session::get('detail');
                                                @endphp
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-close margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">  ¡{{$message}}!</h2>
                                                        <p>{{$detail}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(213)
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-credit-card-alt margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">  ¡No pudimos procesar tu pago!</h2>
                                                        <p>{{$message}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(214)
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-credit-card-alt margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">  ¡No pudimos procesar tu pago!</h2>
                                                        <p>{{$message}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(215)
                                                @php
                                                    $detail = Session::get('detail');
                                                @endphp
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-credit-card-alt margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">  ¡{{$message}}!</h2>
                                                        <p>{{$detail}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(216)
                                                @php
                                                    $detail = Session::get('detail');
                                                @endphp
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-credit-card-alt margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">  ¡{{$message}}!</h2>
                                                        <p>{{$detail}}</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" readonly placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(300)
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-warning margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;letter-spacing: -3px;">  ¡Ha sobrepasado el límite de compras!</h2>
                                                        <p>Por ser una compra fuera del departamento de Tacna, ah sobrepasado el limite de <br> $ 3 000.00. Podra seguir efectuando compras teniendo la direccion de destino como Tacna.</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                @break
                                            @case(301)
                                                @php
                                                    $companys = Session::get('companys');
                                                @endphp
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h3 class="headline margin-bottom-0" style="font-size:40px;">¡NO SE PUDO EFECTUAR SU COMPRA!</h3>
                                                        <div class="col-md-12">
                                                            <h3 class="margin-bottom-20"><i class="im im-icon-Arrow-Forward2"></i> Información del Problema</h3>
                                                            <p class="margin-bottom-0"><strong style="font-weight:600;color:black;">Estas empresas no estan vinculadas para poder efectuar pagos en línea</strong></p>
                                                            
                                                            
                                                            <p class="margin-bottom-0">Porfavor intentelo de nuevo o elimine los productos de estas empresas para seguir comprando</p>
                                                            
                                                            
                                                        </div>
                                                       

                                                    </div>
                                                    <div class="col-md-12 margin-top-50">
                                                        

                                                            @foreach($companys as $item)
                                                            <div class="col-lg-12 col-md-12" style="height: 220px;">
                                                                <div class="listing-item-container list-layout">
                                                                    <a href="/resultados/{{$item->slug}}/{{$item->id}}" class="listing-item">
                                                                        
                                                                        <!-- Image -->
                                                                        <div class="listing-item-image">
                                                                            <img src="images/{{$item->image}}" alt="">
                                                                            <span class="tag">Empresa</span>
                                                                        </div>
                                                                        
                                                                        <!-- Content -->
                                                                        <div class="listing-item-content">
                                                                            @if($item->state == 1)
                                                                            <div class="listing-badge now-open">Now Open</div>
                                                                            @else
                                                                            <div class="listing-badge now-closed">Now Closed</div>
                                                                            @endif
                                                                            <div class="listing-item-inner">
                                                                                <h3>{{$item->company}} <i class="verified-icon"></i></h3>
                                                                                <span>{{$item->address}}</span>
                                                                                <div class="star-rating" data-rating="{{$item->qualification}}">
                                                                                    <div class="rating-counter">({{$item->opinions}} pedidos)</div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            
                                                         @endforeach
                                                            
                                                        
                                                    </div>
                                                    
                                                </div>
                                                @break
                                            @default
                                                <div class="col-md-12">
                                                    <section id="not-found" class="center margin-top-0">
                                                        <i class="fa fa-warning margin-right-10" style="font-size:160px;height: 13%;"></i> 
                                                        <h2 style="font-size:70px;height: 18%;">  Ha ocurrido un error con tu tarjeta</h2>
                                                        <p>Revisa los datos de tu tarjeta o llama a tu proveedor.</p>

                                                        <div class="row">
                                                            <div class="col-lg-8 col-lg-offset-2">
                                                                <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                                                                    <div class="main-search-input-item">
                                                                        <input type="text" placeholder="Vuelve a ingresar los datos de tu tarjeta" value="">
                                                                    </div>

                                                                    <button class="button" onClick="window.location='/facturation'">Volver</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                        @endswitch
                                        
                                            
                                    @else
                                                
                                        <script>
                                            //window.location='/checkout';
                                        </script>
                                        
                                    @endif
                            
                                
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

 @endsection
