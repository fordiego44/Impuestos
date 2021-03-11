@extends('admin.app')
@section('content')  
    <div class="dashboard-content"> 
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Crear Categoria</h2> 
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="/superadmin/categoria">Categoria</a></li>
                        <li><a href="/superadmin/categoria/nuevo">Crear Categoria</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> 
    <div class="row"> 
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
        <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;" class="gray">Detalle del Categoria</h4>
        <form action="/superadmin/business/create" method="POST" enctype="multipart/form-data" id="business">
            @csrf
            <div class="dashboard-list-box-static">
                <div class="row">
                    <div style="margin-top: 15px;"> 
                        <!--<div class="col-lg-6" >
                            <label for="description">Icono</label>
                            <input class="text-input" name="name" id="description" type="text"  placeholder="ejm. " >
                        </div> -->
                        <div class="col-lg-6" >
                            <label for="description">Nombre</label>
                            <input class="text-input" name="name" id="description" type="text"  placeholder="ejm. " >
                        </div> 
                        <div class="col-lg-12">
                            <input type="submit" style="height: 44px;text-align: center;margin-left: 9px;" form="business" value="Crear" class="button margin-top-20 margin-bottom-20"> 
                        </div> 
                    </div>
                    
                </div>
                


            </div>
        </form>
        </div>
        </div>
 

  </div>
 
    <div class="row">
        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">Derechos reservados. ®Rcom Global LCC.</div>
        </div>
    </div>

</div>
<script>
  
</script>
@endsection
