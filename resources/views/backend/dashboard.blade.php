@extends('backend.app')
@section('content')

<div class="dashboard-content">
  {{-- -------------------------------------------------- --}}
  				<!-- Titlebar -->
  		<div id="titlebar">
  			<div class="row">
  				<div class="col-md-12">
  										<h1>Protocolo de salubridad</h1>
  										<!-- Breadcrumbs -->
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Protocolo</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>


  <div class="dashboard-list-box margin-top-0">

    <div class="list-box-listing">
      <div >
        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">DE LA ZONA DE DESPACHO.</h4>
      </div>
    </div>
<form class="" action="/admin/subirProtocolo" method="POST" enctype="multipart/form-data">
  @csrf
  	<ul>
  			<li>
  			<div class="list-box-listing">
  				<div class="list-box-listing-content">
  					<div class="inner">

              <div class="row">
                <div class="col-sm-10">
                    <h3>1. El restaurante o servicio a fin cuenta con una zona exclusiva
                       para empaque y despacho de los alimentos. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest1" class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
            </div></div></div></li></ul>

            <div class="list-box-listing">
              <div >
                <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">DEL PERSONAL: despacho/repartidor
                encargado de acondicionar los alimentos en los contenedores o de transportarlos.</h4>
              </div>
            </div>
    	<ul>
        <li>
        <div class="list-box-listing">
        	<div class="list-box-listing-content">
        		<div class="inner">

              <div class="row">
                <div class="col-sm-12">
                    <h3>ESTADO DE SALUD. </h3>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-10">
                    <h3>2. Temperatura igual o menor a 37ºC. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest2" class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>3. No tiene procesos respiratorios, dolor de garganta, tos, dolor de cabeza. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest3"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                    <h3>HIGIENE Y PRESENTACIÓN. </h3>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-10">
                    <h3>4. Tiene manos con o sin guantes limpias y desinfectadas. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest4"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>5. Tiene uñas cortas y limpias. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest5"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>6. No tiene heridas infectadas o abiertas. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest6"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>7. Tiene protector naso bucal. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest7" class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>8. Tiene cabello cubierto. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest8"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-10">
                    <h3>9. Tiene la indumentaria limpia. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest9"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>10. No tienen joyas, alhajas, relojes. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest10"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                    <h3>CAPACITACIÓN. </h3>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-10">
                    <h3>11. El personal (manipuladores, repartidores) han recibido la capacitación por parte
                      del restaurante para aplicación de la Guía Técnica Sanitaria. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest11"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>

            </div></div></div></li></ul>


            <div class="list-box-listing">
              <div >
                <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">DEL REPARTO DE LOS ALIMENTOS.</h4>
              </div>
            </div>
    	<ul>
        <li>
        <div class="list-box-listing">
        	<div class="list-box-listing-content">
        		<div class="inner">

              <div class="row">
                <div class="col-sm-10">
                    <h3>12. Los envases y empaques son de primer uso y protegen los mismos. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest12"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>13. Los empaques se encuentran bien cerrados. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest13"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>14. Los contenedores o cajas para reparto alimentos preparados se encuentran
                      limpios y desinfectados antes de acondicionar los alimentos en ellos. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest14"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>15. El cierre de los contenedores asegura la protección de los alimentos
                    de la contaminación extrema</h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest15"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>16. El reparto de alimentos es menor a 1 hora. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest16"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>17. El contenedor o caja se encuentra acondicionado para mantener a los
                      alimentos preparados en las condiciones de caliente o frío. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest17"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                    <h3>18. El repartidor cuenta con un desinfectante para manos. </h3>
                </div>
                <div class="col-sm-2">
                  <select name="quest18"  class=" asignar-repartidor" >
                    <option  value="1">Si</option>
                    <option  value="0">No</option>
                  </select>
                </div>
              </div>

            </div></div></div></li></ul>

            <div class="list-box-listing">
              <div >
                <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">NOMBRE DEL REPARTIDOR:  {{$name}},{{$last_name}}.</h4>
              </div>
              <div class="list-box-listing-content col-md-6">
                <div class="inner float-right" style="display:flex; justify-content:flex-end">
                    <button type="submit" value="Submit" name="button">Declarar y enviar</button>
                    {{-- <button type="submit"  value="Submit" class="button margin-top-20 margin-bottom-20">Declarar y registrar</button> --}}

                </div>
              </div>
            </div>
  </form>



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
