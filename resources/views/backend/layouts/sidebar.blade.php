<div class="dashboard-nav">
    <div class="dashboard-nav-inner">

      @php
      $message = Session::get('rol');
      @endphp
        <ul data-submenu-title="Principal">
          <li><a href="/admin/vaccine"><i class="sl sl-icon-user"></i> Reporte vacunas </a></li>
          {{-- @if ($message[0] == "administrador")
            <li><a href="/admin/profile"><i class="sl sl-icon-user"></i> Mi Perfil </a></li>
            <li><a href="/admin/validacion-mercado-pago"><i class="sl sl-icon-social-dropbox"></i> Mercado Pago </a></li>
            <li><a href="/admin/sucursales"><i class="sl sl-icon-pin"></i> Sucursales </a></li>
            {{-- <li><a href="/admin/vehicle "><i class="sl sl-icon-support"></i> Vehiculos</a></li> --}}
            {{-- @if (Session::get('user')->business == 1 ||  Session::get('user')->business == 3)
              <li><a href="/admin/repartidores"><i class="sl sl-icon-people"></i>Repartidores</a></li>
              <li><a href="/admin/calificador"><i class="sl sl-icon-badge"></i> Calificaciones</a></li>
            @endif
            <li><a href="/admin/clasificaciones"><i class="sl sl-icon-star"></i> Subcategorías</a></li>
            <li><a href="/admin/productos"><i class="sl sl-icon-bag"></i> Productos</a></li> --}}
            {{-- <li><a href="/admin/clasificaciones/ordenarClasificacion"><i class="fa fa-calendar-check-o"></i> Carta</a></li> --}}
            {{-- <li><a href="/admin/recepciones/proceso"><i class="sl sl-icon-layers"></i> Recepciones</a></li>
            @else
            <li><a href="/admin/repartidor/recepciones/proceso"><i class="sl sl-icon-layers"></i> Recepciones</a></li>
          @endif --}}  

          </ul>

        <ul data-submenu-title="Account">

            <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="sl sl-icon-power"></i> Salir</a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                      @csrf
                            </form>


        </ul>

    </div>
</div>
