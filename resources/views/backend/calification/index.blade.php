@extends('backend.app')
@section('content')

       <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
       {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}

       <style>
       /* .dashboard-list-box ul ul li {
        padding: 8px;
        border: none;
        transition: .3s;
        background-color: transparent;
        display: inline-block; */
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .dashboard-list-box ul ul li {
            padding: 0;
            border: none;
            transition: .3s;
            background-color: transparent;
            display: inline-block;
        }

        div.dataTables_paginate ul.pagination {
            margin: 2px 0;
            white-space: nowrap;
            justify-content: flex-end;
        }


        </style>

<div class="dashboard-content">
  		<div id="titlebar">
  			<div class="row">
  				<div class="col-md-12">
  										<h1>Reporte de calificativo</h1>
  										<!-- Breadcrumbs -->
  					<nav id="breadcrumbs">
  						<ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="/admin/calificador">Calificaciones</a></li>
  						</ul>
  					</nav>
  				</div>
  			</div>
  		</div>


      <div class="dashboard-list-box margin-top-0">
              <div class="list-box-listing">
                <div >
                  <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;">Calificación del cliente a los repartidores</h4>
                </div>
                <div class="list-box-listing-content col-md-6">
                  <div class="inner float-right" style="">

                  </div>
                </div>
              </div>

            <div id="listing-reviews" class="listing-section">

              {{-- <div class="container" style="margin-top: 25px;padding: 10px"> --}}


              <ul id="booking-requests">

                <li class="user-booking waiting-booking" style="padding: 10px 30px;" id="booking-list-10046">
                  <div class="list-box-listing bookings"  style="margin: 1px 0;">
                    {{-- <div class="list-box-listing-img" style="margin-top: 0px;"><img alt="" src=""  class="avatar avatar-70 photo" height="70" width="70" style="padding-right: 0px;"></div> --}}
                    <div class="list-box-listing-content">
                      <div class="inner paginador-tabla">


                        <table id="tablax" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <th>Pedido N°</th>
                                <th>Repartidor</th>
                                <th>Cumple con normas de salubridad</th>
                                <th>Producto en condiciones</th>
                            </thead>
                            <tbody>
                              @foreach ($califications as  $calification)
                                <tr>
                                    <td>{{str_pad($calification->pending, 6, "0", STR_PAD_LEFT)}}</td>
                                    <td>{{$calification->name}}, {{$calification->last_name}}</td>
                                    @if ($calification->answer1 == 1)
                                      <td>Sí</td>
                                    @else
                                      <td>No</td>
                                    @endif
                                    @if ($calification->answer2 == 1)
                                      <td>Sí</td>
                                    @else
                                      <td>No</td>
                                    @endif


                                </tr>
                              @endforeach
                            </tbody>
                          </table>

                      </div>
                    </div>
                  </div>

                </li>

		           </ul>
          	</div>
      </div>

  {{-- --------------------------------------------------------- --}}

    <div class="row">
        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">Derechos reservados. ®Rcom Global LCC.</div>
        </div>
    </div>
    <div style="height:150px"> 

    </div>

</div>
@endsection

@section('js')
  <script src="{{ asset('js/backend/reception.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous">
        </script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
    </script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">
    </script>
  <script>
        $(document).ready(function () {
            $('#tablax').DataTable({
                language: {
                    processing: "Tratamiento en curso...",
                    search: "Buscar Repartidor&nbsp;:",
                    lengthMenu: "Agrupar en _MENU_ repartidores",
                    info: " _START_ al _END_ de _TOTAL_ pedidos.",
                    infoEmpty: "No existen datos.",
                    infoFiltered: "(En total _MAX_ pedidos)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos con tu busqueda",
                    emptyTable: "No hay datos disponibles en la tabla.",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Ultimo"
                    },
                    aria: {
                        sortAscending: ": active para ordenar la columna en orden ascendente",
                        sortDescending: ": active para ordenar la columna en orden descendente"
                    }
                },
                paging: true,
                searching: true,
                // select: true,
                scrollY: 400,
                lengthMenu: [ [10, 20, -1], [10, 20, "Todo"] ],
            });
        });
    </script>
@endsection
