@extends('frontend.app' , ['bussines'=> $bussines, 'users', $users])
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
						<li id="pasos" style="font-size:20px;">Paso 1 de 3: Datos de Envío</li>

					</ul>

		</div>
				<div class="style-1">
					<!-- Tabs Navigation -->
					<ul class="tabs-nav">
						<li style="width:48%;" class="active"><a href="#tab1a" style="text-align:center; display:block;font-size: 17px;"><i class="sl sl-icon-user"></i> Datos de Envío</a></li>
						<li style="width:48%;"><a href="#tab2a" style="text-align:center; display:block;font-size: 17px;"><i class="sl sl-icon-credit-card"></i>Métodos de Pago</a></li>
					</ul>

					<!-- Tabs Content -->
					<div class="tabs-container">
						<div class="tab-content" id="tab1a" style="">
                            <div class="row margin-left-0 margin-right-0">
                                <div class="col-md-12">
                                    <ul class="list-1 color">
                                        <li style="font-size:20px;">Seleccione un tipo de entrega:</li>
                                    </ul>

                                </div>
                                <div class="col-md-12">
                                    <div class="account-type">
                                        <div>
                                            <input type="radio" name="user_role" id="freelancer-radio" class="account-type-radio" checked="" value="1">
                                            <label for="freelancer-radio"><i class="sl sl-icon-home"></i> Despacho a Domicilio</label>
                                        </div>

                                        <div>
                                            <input type="radio" name="user_role" id="employer-radio" class="account-type-radio" value="0">
                                            <label for="employer-radio"><i class="im im-icon-Shop-4"></i> Recogo en Tienda</label>
                                        </div>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-6">
                                    <div class="checkboxes in-row margin-bottom-20">
                        
                                        <input class="state-delivery" id="check-a" checked type="checkbox" name="check" value="1">
                                        <label for="check-a">Despacho a Domicilio</label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkboxes in-row margin-bottom-20">
                        
                                        <input class="state-delivery" id="check-b" type="checkbox" name="check" value="0">
                                        <label for="check-b">Recogo en tienda</label>

                                    </div>
                                </div>--}}
                                <div class="col-md-12 margin-top-15 delivery-dates">
                                    <ul class="list-1 color">
                                        <li style="font-size:20px;">Seleccione un tipo de envio:</li>
                                    </ul>

                                </div>
                                {{--<div class="col-md-6  delivery-dates">
                                    <div class="checkboxes in-row margin-bottom-20">
                                    <figure title="Comisión de 15% x producto para el envio" tooltip-dir="top">
                                        <input class="state-delivery-tipo" id="check-a-tipo" checked type="checkbox" name="check" value="1">
                                        <label for="check-a-tipo">Terrestre</label>
                                    </figure>
                                    </div>
                                </div>
                                <div class="col-md-6 delivery-dates">
                                    <div class="checkboxes in-row margin-bottom-20">
                        
                                        
                                        <figure title="Comisión de 20% x producto para el envio" tooltip-dir="top">
                                        <input class="state-delivery-tipo" id="check-b-tipo" type="checkbox" name="check" value="2">
                                        <label for="check-b-tipo">Aéreo</label>
                                        </figure>
                                    </div>
                                </div>--}}
                                <div class="col-md-12">
                                    <div class="account-type-tipo delivery-dates">
                                        <div>
                                            <figure title="Comisión de 15% x producto para el envio" tooltip-dir="top">
                                            <input type="radio" name="user_role-tipo" id="freelancer-radio-tipo" class="account-type-radio-tipo" checked="" value="1">
                                            <label for="freelancer-radio-tipo"><i class="fa fa-truck"></i> Terrestre</label>
                                            </figure>
                                        </div>

                                        <div>
                                            <figure title="Comisión de 20% x producto para el envio" tooltip-dir="top">
                                            <input type="radio" name="user_role-tipo" id="employer-radio-tipo" class="account-type-radio-tipo" value="2">
                                            <label for="employer-radio-tipo"><i class="sl sl-icon-plane"></i> Aéreo</label>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="1" id="state-delivery">
                                <div class="col-md-12">
                                    <ul class="list-1 color">
                                        <li style="font-size:20px;" id="text-delivery">Ingrese sus datos para el envio de sus productos:</li>
                                    </ul>

                                </div>
                                <div class="col-md-6">
                                    <div class="input-with-icon medium-icons">
                                        <label>Nombres:</label>
                                        <input type="text" value="{{$usuario->name}}" id="nombre">
                                        <i class="im im-icon-Pen-2"></i>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-with-icon medium-icons">
                                        <label>Apellidos:</label>
                                        <input type="text" value="{{$usuario->last_name}}" id="apellido">
                                        <i class="im im-icon-Pen-2"></i>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="input-with-icon medium-icons">
                                        <label>Dirección Email:</label>
                                        <input type="email" value="{{$usuario->email}}" id="email_address">
                                        <i class="im im-icon-Mail"></i>
                                    </div>
                                </div>

                                <!--<div class="col-md-6">

                                    <div class="input-with-icon medium-icons">
                                        <label>País:</label>
                                        <input type="text" value="" id="country">
                                        <i class="im im-icon-Flag-2"></i>
                                    </div>
                                </div>-->
                                
                                <div class="col-md-3">
                                    <div class="input-with-icon medium-icons">
                                        <label>Teléfono Fijo:</label>
                                        <input type="number" value="{{$usuario->telephone}}" maxlength="12" id="telefono" oninput="this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value < 1) ? (''/'') : this.value;">
                                        <i class="im im-icon-Phone"></i>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-with-icon medium-icons">
                                        <label>Teléfono Celular:</label>
                                        <input type="number" value="{{$usuario->phone}}" id="celular" maxlength="12" oninput="this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value < 1) ? (''/'') : this.value;">
                                        <i class="im im-icon-Phone-Wifi"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 delivery-dates">
                                    <div class="input-with-icon medium-icons">
                                        <label>Departamento:</label>
                                        <select name="departamento" id="departamento">
                                            @if($departamento)
                                                <option value="">Seleccione departamento</option>

                                                @foreach ($departamentos as $item)
                                                    @if ($item->id == $usuario->departament)
                                                        <option value={{$item->id}} selected>{{$item->name}}</option>
                                                    @else
                                                        <option value={{$item->id}}>{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="" selected>Seleccione departamento</option>
                                                @foreach ($departamentos as $item)
                                                    <option value={{$item->id}}>{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 delivery-dates">
                                    <div class="input-with-icon medium-icons">
                                        <label>Provincia:</label>
                                        <select name="provincia" id="provincia">
                                            @if($provincias)
                                                <option value="" >Seleccione provincia</option>
                                                @foreach ($provincias as $item)
                                                    
                                                    @if ($item->_id == $usuario->province)
                                                        <option value={{$item->_id}} selected>{{$item->name}}</option>
                                                    @else
                                                        <option value={{$item->_id}}>{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="" >Seleccione provincia</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 delivery-dates">
                                    <div class="input-with-icon medium-icons">
                                        <label>Distrito:</label>
                                        <select name="distrito" id="distrito">
                                            @if($distritos)
                                                <option value="">Seleccione distrito</option>
                                                @foreach ($distritos as $item)

                                                    @if ($item->_id == $usuario->district)
                                                        <option value={{$item->_id}} selected>{{$item->name}}</option>
                                                    @else
                                                        <option value={{$item->_id}}>{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="" >Seleccione distrito</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 margin-top-0 delivery-dates">
                                    
                                    <label class="margin-bottom-0">Dirección:</label>
                                    <input type="email" value="{{$usuario->direction}}" id="direccion" style="width: 100%;display: inline-block;">

                                </div>
                                
                                
                                <input type="hidden" value="1" id="state-delivery-tipo">
                                <div class="col-md-12 margin-top-0 delivery-dates" id="mapa" >
                                    <div class="notification notice closeable margin-top-15">
                                        <p> ¡Mueve el marcador a tu ubicación! Esto servira como referencia a tu dirección.</p>
                                    </div>

                                    <div id='map' class="col-md-8 mapa" style="padding-top: 15px;width: 100%;height: 500px;">
                                    </div>

                                    
                                    <div id="notificacion">
                                        
                                    </div>
                                </div>
                                                        
                                <input class="hidden" name="longitud" id="longitud" type="text" value="0">
                                <input class="hidden" name="latitud" id="latitud" type="text" value="0">
                                <input class="hidden" name="longitud" id="longitud_auxiliar" type="text" value="0">
                                <input class="hidden" name="latitud" id="latitud_auxiliar" type="text" value="0">
                                <input class="hidden" name="region" id="region" type="text" value="0">

                                

                            </div>

                                <button class="button fullwidth margin-top-20 margin-left-0" id="boton-cancelar" onClick="window.location='/checkout'" style="width:100px;"> Cancelar</button>
                                <button class="button fullwidth margin-top-20 margin-left-35 guardar" style="width:100px;"> Continuar</button>


						</div>

                        <div class="tab-content" id="tab2a" style="display: none; padding: 0px 0 0;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <ul class="list-1 color">
                                            <li style="font-size:20px;margin-bottom:0;margin-top: 70px;">Métodos de Pago aceptados:</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-8">
                                        
                                            <div class="col-md-4 center">
                                                <img class="card_logo" style="margin-top:15px;" src="/images/visa_logo.png" alt="Visa">
                                                {{--<section id="not-found" class="center margin-top-0">
                                                    <i class="fa fa-cc-visa margin-right-10" ></i>        
                                                </section>--}}
                                            </div>
                                            <div class="col-md-4 margin-top-15 center">
                                                <img class="card_logo" src="/images/mastercard_logo.png" alt="MasterCard">
                                                {{--<section id="not-found" class="center margin-top-0">
                                                    <i class="fa fa-cc-mastercard margin-right-10" ></i>        
                                                </section>--}}
                                            </div> 
                                            <div class="col-md-4 margin-top-15 center">
                                                <img class="card_logo" src="/images/american_logo.png" alt="American Express">
                                                {{--<section id="not-found" class="center margin-top-0">
                                                    <i class="fa fa-cc-amex margin-right-10" ></i>        
                                                </section>--}}
                                            </div> 
                                        
                                    </div>
                                    	
                                    @if($cards == "[]")
                                        
                                        <div class="col-md-12">

                                            <form action="/checkouts" method="post" id="pay" name="pay" >
                                                @csrf
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <ul class="list-1 color">
                                                                <li style="font-size:20px;">Ingrese los datos de la tarjeta:</li>
                                                            </ul>

                                                        </div>
                                                        
                                                        <input type="hidden" name="description" id="description" value="Ítem seleccionado"/>
                                                        <div class="col-md-4">
                                                            <label for="cardNumber">Número de la tarjeta:</label>
                                                            <input type="text" id="cardNumber" data-checkout="cardNumber" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off value="" required/>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="cardExpirationMonth">Mes:</label>
                                                            <input type="number" id="cardExpirationMonth" maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" data-checkout="cardExpirationMonth" min="1" max="12" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off required/>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="cardExpirationYear">Año:</label>
                                                            <input type="number" id="cardExpirationYear" maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" data-checkout="cardExpirationYear" min="20" max ="25" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off required/>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="securityCode">CVV:</label>
                                                            <input type="password" id="securityCode" min="100" max="9999" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" data-checkout="securityCode" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off required/>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="transaction_amount">Monto a pagar:</label>
                                                            <input name="transaction_amount" id="transaction_amount" required readonly/>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="cardholderName">Nombre y apellido:</label>
                                                            <input type="text" id="cardholderName" data-checkout="cardholderName" required/>
                                                        </div>
                                                        <!--<div class="col-md-6">
                                                            <label for="email">E-mail:</label>-->
                                                            <input type="hidden" id="email" name="email" value="" required/>
                                                        <!--</div>-->

                                                        <div class="col-md-3">
                                                            <label for="docType">Tipo de documento:</label>
                                                            <select id="docType" data-checkout="docType"></select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="docNumber">Número de documento:</label>
                                                            <input type="text" id="docNumber" data-checkout="docNumber" value="{{$usuario->dni}}" required/>
                                                        </div>
                                                        <div class="col-md-2">
                                                                        <label for="type_card">Tipo de tarjeta:</label>
                                                                        <select name="type_card" id="type_card" required>
                                                                            <option value="">Seleccione</option>
                                                                            <option value="debito">Débito</option>
                                                                            <option value="credito">Crédito</option>
                                                                        </select>
                                                                    </div>
                                                        <!--<div class="col-md-4">
                                                            <label for="installments">Cuotas:</label>-->
                                                            <select id="installments" class="form-control" style="display:none;" name="installments"></select>
                                                        <!--</div>-->
                                                            <input type="hidden" name="payment_method_id" id="payment_method_id"/>
                                                        <div class="col-md-12">
                                                            <div class="checkboxes in-row margin-bottom-20">
                                                                <input id="check-h" type="checkbox" name="check">
                                                                <label for="check-h">Recordar tarjeta</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#" class="button fullwidth margin-top-20 margin-left-0 cancelar" style="width:100px;"> Cancelar</a>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button class="button fullwidth margin-top-20 margin-left-35" style="width:100px;"> Continuar</button>
                                                        </div>
                                                        
                                                        
                                                        
                                                    
                                                    
                                                    </div>

                                                </fieldset>
                                            </form>

                                        </div>
                                    
                                    
                                    @else
                                     
                                        <div class="payment">
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($cards as $item)
                                                <div class="payment-tab">
                                                    <div class="payment-tab-trigger">
                                                        <input class="cards_customer" id="pago-{{$i}}" name="cardType" type="radio" value="{{$item->id}}">
                                                        <label for="pago-{{$i}}">{{ucwords($item->type_card)}} ****{{substr($item->number,-4)}} </label>
                                                    </div>
                                                    <div class="payment-tab-content">
                                                        <div class="row">
                                                            <div class="row col-md-12">
                                                                <div class="col-md-6">
                                                                    <ul class="list-1">
                                                                        <li style="font-size:15px;">Ingrese el CVV de la tarjeta: <input class="securityCode_prueba" type="password" id="securityCode_prueba-{{$item->id}}" min="100" max="9999" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                                                                </li>
                                                                    </ul>

                                                                </div>
                                                                
                                                                    
                                                                
                                                                    <button class="button fullwidth margin-top-35 margin-left-35 cancelar botonCardRemeber" style="width:100px;"> Cancelar</button>
                                                               
                                                                
                                                                    <button class="button fullwidth margin-top-35 margin-left-35 pagar boton_secundario botonCardRemeber" data-id="{{$item->id}}" style="width:100px;">Pagar</button>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                            
                                            
                                            <div class="payment-tab payment-tab-active">
                                                <div class="payment-tab-trigger">
                                                    <input class="newCart" checked="" type="radio" name="cardType" id="newCart" value="newCart">
                                                    <label for="newCart">Nueva tarjeta</label>
                                                </div>

                                                <div class="payment-tab-content">
                                                    <div class="row">

                                                        <form action="/checkouts" method="post" id="pay" name="pay" >
                                                            @csrf
                                                            <fieldset>
                                                                <div class="row col-md-12">
                                                                    
                                                                    
                                                                    <input type="hidden" name="description" id="description" value="Ítem seleccionado"/>
                                                                    <div class="col-md-4">
                                                                        <label for="cardNumber">Número de la tarjeta:</label>
                                                                        <input type="text" id="cardNumber" data-checkout="cardNumber" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off value="" required/>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="cardExpirationMonth">Mes:</label>
                                                                        <input type="number" id="cardExpirationMonth" maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" data-checkout="cardExpirationMonth" min="1" max="12" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off required/>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="cardExpirationYear">Año:</label>
                                                                        <input type="number" id="cardExpirationYear" maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" data-checkout="cardExpirationYear" min="20" max ="25" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off required/>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="securityCode">CVV:</label>
                                                                        <input type="password" id="securityCode" min="100" max="9999" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" data-checkout="securityCode" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off required/>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="transaction_amount">Monto a pagar:</label>
                                                                        <input name="transaction_amount" id="transaction_amount" required readonly/>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <label for="cardholderName">Nombre y apellido:</label>
                                                                        <input type="text" id="cardholderName" data-checkout="cardholderName" required/>
                                                                    </div>
                                                                    <!--<div class="col-md-6">
                                                                        <label for="email">E-mail:</label>-->
                                                                        <input type="hidden" id="email" name="email" value="" required/>
                                                                    <!--</div>-->

                                                                    <div class="col-md-3">
                                                                        <label for="docType">Tipo de documento:</label>
                                                                        <select id="docType" data-checkout="docType"></select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label for="docNumber">Número de documento:</label>
                                                                        <input type="text" id="docNumber" data-checkout="docNumber" value="{{$usuario->dni}}" required/>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="type_card">Tipo de tarjeta:</label>
                                                                        <select name="type_card" id="type_card" required>
                                                                            <option value="">Seleccione</option>
                                                                            <option value="debito">Débito</option>
                                                                            <option value="credito">Crédito</option>
                                                                        </select>
                                                                    </div>
                                                                    <!--<div class="col-md-4">
                                                                        <label for="installments">Cuotas:</label>-->
                                                                        <select id="installments" class="form-control" style="display:none;" name="installments"></select>
                                                                    <!--</div>-->
                                                                        <input type="hidden" name="payment_method_id" id="payment_method_id"/>
                                                                    <div class="col-md-12" id="checkboxes-mercado">
                                                                        <div class="checkboxes in-row margin-bottom-20">
                                                                            <input id="check-h" type="checkbox" name="check">
                                                                            <label for="check-h">Recordar tarjeta</label>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                        <button class="button fullwidth margin-top-20 margin-left-20 cancelar" style="width:100px;"> Cancelar</button>
                                                                    
                                                                        <button class="button fullwidth margin-top-20 margin-left-35" id="pagar" style="width:100px;">Pagar</button>
                                                                    
                                                                    
                                                                </div>

                                                            </fieldset>
                                                        </form>

                                                    </div>
                                                </div>
                                                
                                            </div>

                                        </div>
										<!--
										<div class="row margin-top-30">
                                            <div class="col-md-1">
                                                <a href="#" class="button fullwidth margin-top-20 margin-left-0 cancelar boton_secundario" style="width:100px;"> Cancelar</a>
                                            </div>
                                            <div class="col-md-1">
                                                <button class="button fullwidth margin-top-20 margin-left-35 boton_secundario" id="card_save" style="width:100px;">Pagar</button>
                                            </div>
                                        </div>-->
										
                                        
                                        
                                    @endif

                                </div>
                                <div class="col-md-6">
                                
                                </div>
                            </div>
                            <div class="margin-top-10 message-error">

						    </div>
                            <div class="margin-top-10 message">

						    </div>
						</div>

						<div class="tab-content" id="tab3a" style="display: none;">
                            
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
<script>
    $('#departamento').on('change',function(){

        let id=$(this).val();
        $.get('/provincia',{department_id:id},function(res){
            //console.log(res);
            $('#provincia').empty();
            $('#distrito').empty();
            $('#provincia').append('<option value="">Seleccione provincia</option>');
            $('#distrito').append('<option value="">Seleccione distrito</option>');
            $.each(res.provincias, function(index,value){
                $('#provincia').append('<option value="'+value._id+'">'+value.name+'</option>');
            });
        })
    })

    $('#provincia').on('change',function(){
        let id=$(this).val();
        let id_departamento = $('#departamento').val();
        $.get('/distrito',{province_id:id,department_id:id_departamento},function(res){
           // console.log(res);
            $('#distrito').empty();
            $('#distrito').append('<option value="">Seleccione distrito</option>');
            $.each(res.distritos, function(index,value){
                $('#distrito').append('<option value="'+value._id+'">'+value.name+'</option>');

            });
        })
    })
    $('.cancelar').on('click',function(){
        $('.tabs-nav > .active').prev('li').find('a').trigger('click');
    $('#pasos').empty().append("Paso 1 de 3: Datos de Envío")
    });
    let formData = new FormData();
      window.Mercadopago.setPublishableKey("TEST-cf487c35-1a0f-49e1-84cd-08f06a4c2cf0");

      window.Mercadopago.getIdentificationTypes();

      document.getElementById('cardNumber').addEventListener('keyup', guessPaymentMethod);
      document.getElementById('cardNumber').addEventListener('change', guessPaymentMethod);

      function guessPaymentMethod(event) {
          let cardnumber = document.getElementById("cardNumber").value;

          if (cardnumber.length >= 6) {
              let bin = cardnumber.substring(0,6);
              window.Mercadopago.getPaymentMethod({
                  "bin": bin
              }, setPaymentMethod);
          }
      };

      function setPaymentMethod(status, response) {
          if (status == 200) {
              let paymentMethodId = response[0].id;
              let element = document.getElementById('payment_method_id');
              element.value = paymentMethodId;
              getInstallments();
          } else {
              alert(`payment method info error: ${response}`);
          }
      }

      function getInstallments(){
          window.Mercadopago.getInstallments({
              "payment_method_id": document.getElementById('payment_method_id').value,
              "amount": parseFloat(document.getElementById('transaction_amount').value)

          }, function (status, response) {
              if (status == 200) {
                  document.getElementById('installments').options.length = 0;
                  response[0].payer_costs.forEach( installment => {
                      let opt = document.createElement('option');
                      opt.text = installment.recommended_message;
                      opt.value = installment.installments;
                      document.getElementById('installments').appendChild(opt);
                  });
              } else {
                  alert(`installments method info error: ${response}`);
              }
          });
      }

      doSubmit = false;
      document.querySelector('#pay').addEventListener('submit', doPay);

      function doPay(event){
          event.preventDefault();
          if(!doSubmit){
              var $form = document.querySelector('#pay');
             Swal.fire({
                title: '¡Procesando datos de tu compra!',
                html: 'Espere un momento',// add html attribute if you want or remove
                allowOutsideClick: false,
                allowEscapeKey : false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                });
              window.Mercadopago.createToken($form, sdkResponseHandler);
              //swal.close();
              return false;
          }
      };

        function sdkResponseHandler(status, response) {
            if (status != 200 && status != 201) {
                alert("verify filled data");
            }else{ 
                var form = document.querySelector('#pay');
                var card = document.createElement('input');
                card.setAttribute('name', 'token');
                card.setAttribute('type', 'hidden');
                card.setAttribute('value', response.id);
                form.appendChild(card);
                var nombre = document.getElementById('nombre').value;
                agregarItem(name = 'nombre',nombre);
                var apellido = document.getElementById('apellido').value;
                
                var email = document.getElementById('email_address').value;
                var telefono = document.getElementById('telefono').value;
                var celular = document.getElementById('celular').value;
                var longitud = document.getElementById('longitud').value;
                var latitud = document.getElementById('latitud').value;

                var cardNumber = document.getElementById('cardNumber').value;
                var cardExpirationMonth = document.getElementById('cardExpirationMonth').value;
                var cardExpirationYear = document.getElementById('cardExpirationYear').value;
                var securityCode = document.getElementById('securityCode').value;
                var cardholderName = document.getElementById('cardholderName').value;
                var docNumber = document.getElementById('docNumber').value;
                var docType = document.getElementById('docType').value;
                var type_card = document.getElementById('type_card').value;
                agregarItem(name = 'type_card', type_card);
                if($('#state-delivery').val() == 1){
                    var departamento = document.getElementById('departamento').value;
                    var provincia = document.getElementById('provincia').value;
                    var distrito = document.getElementById('distrito').value;
                    agregarItem(name = 'departamento', departamento);
                    agregarItem(name = 'provincia', provincia);
                    agregarItem(name = 'distrito', distrito);
                    var departamentoNombre= $('#departamento option:selected').text();
                    var provinciaNombre= $('#provincia option:selected').text();
                    var distritoNombre= $('#distrito option:selected').text();
                    agregarItem(name = 'departamentoNombre', departamentoNombre);
                    agregarItem(name = 'provinciaNombre', provinciaNombre);
                    agregarItem(name = 'distritoNombre', distritoNombre);
                    var direccion = document.getElementById('direccion').value;
                    agregarItem(name = 'direccion',direccion);
                    var state_delivery_tipo = document.getElementById('state-delivery-tipo').value;
                    agregarItem(name = 'state_delivery_tipo',state_delivery_tipo);
                }
                var state_delivery = document.getElementById('state-delivery').value;
                agregarItem(name = 'apellido',apellido);
                
                agregarItem(name = 'email',email);
                agregarItem(name = 'telefono',telefono);
                agregarItem(name = 'celular',celular);
                agregarItem(name = 'longitud',longitud);
                agregarItem(name = 'latitud',latitud);
                agregarItem(name = 'state_delivery', state_delivery);

                agregarItem(name = 'cardNumber', cardNumber);
                agregarItem(name = 'cardExpirationMonth', cardExpirationMonth);
                agregarItem(name = 'cardExpirationYear', cardExpirationYear);
                agregarItem(name = 'securityCode', securityCode);
                agregarItem(name = 'cardholderName', cardholderName);
                agregarItem(name = 'docNumber', docNumber);
                agregarItem(name = 'docType', docType);

                let first = JSON.parse(localStorage.getItem("checkout"));
                let filter = [];
                let unique = [];
                let j=0;
                for (var i = 0; i < first.length; i++) {
                        filter[j] = first[i];
                        let param = {
                            id : first[i].id,
                            id_MP: first[i].id_MP
                        }
                        unique.push(param);
                        j++;
                }
                let company_unique = Array.from(new Set(unique));
                let company_filter= [];
                for (var i = 0; i < company_unique.length; i++) {
                    let param = {
                        id : company_unique[i].id,
                        id_MP: company_unique[i].id_MP
                    }
                    company_filter.push(param); 
                }
                localStorage.setItem("detail", JSON.stringify(filter));
                localStorage.setItem("unique", JSON.stringify(company_filter));
                let detail = localStorage.getItem("detail");
                let companys = localStorage.getItem("unique");
                agregarItem(name = 'detail',detail);
                agregarItem(name = 'companys',companys);
                doSubmit=true;
                form.submit();
            }
        };
        function agregarItem(name,value){
            var form = document.querySelector('#pay');
            var item = document.createElement('input');
            item.setAttribute('name', name);
            item.setAttribute('type', 'hidden');
            item.setAttribute('value', value);
            form.appendChild(item);
            return false;
        }

  </script>
<script src={{asset('/js/frontend/checkout_final_mapa.js')}}></script>
<script src="{{ asset('js/map-checkout.js') }}"></script>
<script src={{asset('/js/frontend/checkout-final.js')}}></script>

 @endsection
