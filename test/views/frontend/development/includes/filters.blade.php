<form method="get" action="{{route('frontend.development.list')}}">
    <div id="menu-1" class="menu-sidebar menu-light menu-sidebar-left menu-sidebar-reveal">
        <div class="menu-scroll">
            <div class="sidebar-icons-custom left-20 top-10 right-10 bottom-20">
                <a class="remove-filters"><i class="fas fa-trash"></i>Remover Filtros</a>
                <a href="#" class="close-menu"><img height="40px" src="{{asset('fonts/ios-close.svg')}}"></a>
            </div>

            <div class="menu-items-custom left-20">
                <div>
                    <p>Localidad o Zona</p>
                    <div class="select-box select-box-1 menu-select">
                        <select name="location">
                            <option selected disabled value="">Eligí una opción</option>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" class="development-location">{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="top-30">
                    <p>Estado del proyecto</p>
                    <div class="select-box select-box-1 menu-select">
                        <select name="status">
                            <option selected disabled value="">Eligí un tipo de operación</option>
                            <option value="1" class="development-status" >Desconocido</option>
                            <option value="2" class="development-status" >Reuniendo inversores</option>
                            <option value="3" class="development-status" >En pozo</option>
                            <option value="4" class="development-status" >En construccion</option>
                            <option value="5" class="development-status" >Detenido</option>
                            <option value="6" class="development-status" >Finalizado</option>
                        </select>
                    </div>
                </div>

                <div class="top-30">
                    <p>Sucursal</p>
                    <!-- traer las sucursales del admin -->
                    <div class="select-box select-box-1 menu-select">
                        <select name="branch">
                            <option selected disabled value="">Eligí un tipo de propiedad</option>
                            @foreach($branches as $branch)
                                <option value="{{$branch->code}}" class="development-branch">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="sidebar-divider"></div>

            </div>

        </div>
        <div class="filter-apply">
            <button type="submit" class="button filter-search uppercase ultrabold">Buscar</button>
        </div>
    </div>


</form>
