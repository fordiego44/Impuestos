@extends('backend.app')
@section('content')
<style>
figure {
  border-radius: 100%;
  display: block;
  position: relative;
  z-index: 6;
}

figure:after {
  background-color: rgba(0, 0, 0, .5);
  border-radius: 5px;
  color: #fff;
  content: attr(title);
  opacity: 0;
  padding: 6px 12px;
  position: absolute;
  left: 110%;
  top: 30px;
  transition: all .25s ease;
  visibility: hidden;
  white-space: nowrap;
}



figure[tooltip-dir="bottom"]:after,
figure[tooltip-dir="top"]:after {
  left: 50%;
    right: auto;

  transform: translateX(-50%);
}

figure[tooltip-dir="bottom"]:after {
  bottom: auto;
  top: 110%;
}


figure:hover:after {
  opacity: 1;
  visibility: visible;
}

</style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css">

<div class="dashboard-content">

    <!-- Titlebar -->
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Crear nuevo producto</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="/admin/productos">Producto</a></li>
                        <li><a href="/admin/productos/crear">Nuevo producto</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
{{-- --------------------------------------------------- --}}

      <!-- Titlebar -->
<div id ="formulario-product" class="row">

  <div class="col-md-12">


    <div class="style-1">

      <!-- Tabs Navigation -->
      <ul class="tabs-nav">
        <li class="active"><a href="#tab1b"><i class="im im-icon-File-Edit"></i>Detalle del producto</a></li>
        <li class=""  data-generado='0' data-id_producto='0' id="generar-galeria"><a href="#tab2b"><i class="im im-icon-Photos"></i>Galería</a></li>
        <li class=""  data-generado='0' data-id_producto='0' id="generar-atributo"><a href="#tab3b"><i class="im im-icon-File-HorizontalText"></i>Atributos</a></li>
        <li class=""  data-generado='0' data-id_producto='0' id="generar-variacion"><a href="#tab4b"><i class="im im-icon-File-Copy2"></i>Variaciones</a></li>
      </ul>

      <!-- Tabs Content -->
      <div class="tabs-container">
        <div class="tab-content" id="tab1b" style="display: none;">
          <div class="row">
  <!-- Profile -->
              <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0" id="completadoForm">
                  <form   id="subir-producto" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="dashboard-list-box-static">
                      <div hidden id="sin-lista-detalle" >
                        <div class="notification success closeable">
                          <p><span>Producto creado!</span> Las siguientes opciones estan habilitadas, puede registrarlas ahora o más tarde. </p>
                          <a class="close" href="#"></a>
                        </div>
                      </div>
                      <div id="lista-detalle" >
                        <div class="row with-forms">
                          <div class="col-md-3">
                            <div class="row with-forms">
                              <div class="col-md-12">
                                <div class="edit-profile-photo">
                                  <img id="imagenPrevisualizacion" src="{{URL::asset('images/box1.jpg')}}" alt="">
                                  <div class="change-photo-btn">
                                    <div class="photoUpload">
                                      <span><i class="fa fa-upload"></i> Subir imagen</span>
                                      <input type="file" class="upload" id="seleccionArchivos" name="file"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-9">
                            <div class="row with-forms">
                              <div class="col-md-4">
                                <label for="nombre">Nombre</label>
                                <div class="input-with-icon medium-icons">
                                  <input name="id_producto" type="hidden" value="">
                                  <input required class="text-input" name="nombre" type="text" id="nombre" placeholder="Ejm: Rocoto relleno">
                                  <i class="im im-icon-Pen-2"></i>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <label for="precio">Precio S/.</label>
                                <div class="input-with-icon medium-icons">
                                  <figure title="Este producto no debe contener impuestos (IGV)" tooltip-dir="bottom">
                                    <input required class="text-input" step="0.01" name="precio" value="" type="number" min="7" placeholder="Ejm: S/.10" >
                                  </figure>
                                  <i class="im im-icon-Money"></i>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <label for="categoria">Subcategoría</label>
                                <select name="categoria" id="categoria" class="chosen-select-no-single" style="display: none;">
                                  {{-- <option value="0" >Elige una opcion</option> --}}
                                  @foreach ($category as $categorias)

                                    <option class="level-0" value="{{$categorias->id}}">{{$categorias->name}}</option>

                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-4">
                                <label for="tiempo">Tiempo de envío</label>
                                <div class="input-with-icon medium-icons">
                                  <input required class="text-input" name="tiempo" type="text" id="tiempo" placeholder="Ejm: 7 horas ">
                                  <i class="im im-icon-Over-Time2"></i>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="row with-forms">
                                  <div class="col-md-12">
                                    <label for="categoriaPeso">Peso</label>
                                  </div>

                                  <div class="col-md-9">
                                    <div class="input-with-icon medium-icons">
                                      <input required class="text-input" step="0.01" name="peso" value="" type="number" min="0.01" placeholder="Ejm: 4.53" >
                                      <i class="fa fa-balance-scale"></i>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <select name="categoriaPeso" class="chosen-select-no-single" style="display: none;">
                                      @foreach ($categoriaPeso as $data)
                                        <option class="level-0" value="{{$data->id}}">{{$data->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-12">
                                    <label for="categoriaDimension">Dimensiones</label>
                                  </div>
                                  {{-- style="padding-right: 35px;" --}}

                                  <div class="col-md-3">
                                    <div class="input-with-icon medium-icons">
                                      <input class="text-input" step="0.01" name="alto" value="" type="number" min="0.01" placeholder="Alto" >
                                      <i class="im im-icon-View-Height"></i>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="input-with-icon medium-icons">
                                      <input class="text-input" step="0.01" name="ancho" value="" type="number" min="0.01" placeholder="Ancho" >
                                      <i class="im im-icon-View-Width"></i>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="input-with-icon medium-icons">
                                      <input class="text-input" step="0.01" name="largo" value="" type="number" min="0.01" placeholder="Largo" >
                                      <i class="sl sl-icon-size-fullscreen"></i>
                                    </div>
                                  </div>
                                  <div class="col-md-3"  >
                                    <select name="categoriaDimension"   class="chosen-select-no-single" style="display: none;">
                                      @foreach ($categoriaDimension as $data)
                                        <option class="level-0" value="{{$data->id}}">{{$data->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-12">
                                <label for="descripcion">Descripción</label>
                                <div class="input-with-icon medium-icons">
                                  <input required class="text-input" name="descripcion" type="text" id="descripcion" placeholder="Ejm: Es un producto peruano de origen tacneño">
                                  <i class="im im-icon-Pen-2"></i>
                                </div>
                              </div>

                              <div class="col-sm-12">
                                <button style="padding: 12px 50px;" type="submit"  value="Submit" class="button margin-top-20 margin-bottom-20">Guardar</button>
                               </div>




                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
              </div>
                </div>

  <!-- Change Password -->

        </div>
        </div>


        <div class="tab-content" id="tab2b" style="">
          <div class="row">
  <!-- Profile -->
              <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                  {{-- <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;" class="gray">Detalle del producto</h4> --}}

                  <div  class="dashboard-list-box-static">
                    <div hidden id="sin-lista-galeria" >
                      <div class="notification warning closeable">
                				<p><span>Aviso!</span> Registre primero el detalle del producto. </p>
                				<a class="close" href="#"></a>
                			</div>
                    </div>

                    <div hidden id="lista-galeria-validacion" >
                      <div class="notification warning closeable">
                				<p><span>Aviso!</span> Solo podrá registrar imágenes si no tiene variaciones su producto. </p>
                				<a class="close" href="#"></a>
                			</div>
                    </div>

                    <div hidden id="lista-galeria" >
                      <div class="notification notice closeable">
                				<p><span>Producto creado!</span>  Suba las imágenes relacionadas al producto, tiene un máximo de 9 imágenes con dimensiones mayores a 800px. </p>
                				<a class="close" href="#"></a>
                			</div>
                          <form
                            method="POST"
                            class="dropzone"
                            id="my-awesome-dropzone">
                            <input  type="hidden" id="l-g-producto" name="producto" value="">

                          </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="tab-content" id="tab3b" style="">
          <div class="row">
  <!-- Profile -->
              <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                  {{-- <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;" class="gray">Detalle del producto</h4> --}}

                  <div id="list-atributes" class="dashboard-list-box-static">
                    <div hidden id="sin-lista-atributo">
                      <div class="notification warning closeable">
                        <p><span>Aviso!</span> Registre primero el detalle del producto. </p>
                        <a class="close" href="#"></a>
                      </div>
                    </div>

                    <div hidden id="lista-atributo">
                      <div class="notification notice closeable">
                				<p><span>Producto creado!</span> Registre atributos acerca del producto, si tiene imágenes en galería no podra registrar atributos con variaciones. </p>
                				<a class="close" href="#"></a>
                			</div>
                      <div>
                        <form class="subir-atributo" action="" method="POST" enctype="multipart/form-data">
                         <div class="row">
                             <div class="col-md-3">
                               <div class="row">
                                 <div >
                                 <div class="col-md-12"> Nombre </div></div>
                               </div>
                               <div class="row" >
                                 <div class="col-md-12">
                                   <div class="input-with-icon medium-icons">
                                   <input name="_token" value="{{ csrf_token() }}" type="hidden">
                                   <input type="hidden" name="id_product" id="id-producto-atributo" value="">
                                   <div><span class="wpcf7-form-control-wrap name"><input required type="text" id="atributo_nombre" name="atributo_nombre" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"  placeholder="Ejm: Talla "></span></div>
                                   <i class="im im-icon-Pen-2"></i>
                                 </div>
                                 </div>
                               </div>

                             </div>
                             <div class="col-md-3">
                                 <div class="row">
                                   <div >
                                   <div class="col-md-12"> Descripción </div></div>
                                 </div>
                                 <div class="row">
                                   <div class="col-md-12">
                                     <div class="input-with-icon medium-icons">
                                     <div><span class="wpcf7-form-control-wrap name"><input required type="text" id="atributo_valor" name="atributo_valor" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"  placeholder="Ejm: S-M-L-XL  "></span></div>
                                     <i class="im im-icon-File-HorizontalText"></i>
                                   </div>
                                   </div>
                                 </div>
                             </div>
                             <div class="col-md-2">
                                 <div class="row" style="padding-left: 4%;padding-top: 20%;">
                                   <div >
                                   <div class="col-md-12">  </div></div>
                                 </div>
                                 <div class="row">
                                   <div class="col-md-12">
                                     <div><span class="wpcf7-form-control-wrap name">
                                       <div id="atributo_variacion-ocultar" class="checkboxes in-row margin-bottom-20">
                                       <input id="hide" type="checkbox" class="atributo_variacion" name="atributo_variacion" value="1">
                                       <label for="hide">Variación</label>
                                     </div>
                                     </span></div>
                                   </div>
                                 </div>
                             </div>
                             <div class="col-md-4" style=" margin: 0rem;padding: 1rem;">
                                 <div class="row" style="margin: 0rem;padding-left: 4%;padding-top: 6%;">
                                   <div >
                                   <div class="col-md-12">  </div></div>
                                 </div>
                                 <div class="row">
                                   <div class="col-md-12" >
                                     <button type="submit" name="button">Agregar</button>
                                   </div>
                                 </div>
                             </div>
                         </div>
                       </form>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="tab-content" id="tab4b" style="display: none;">

          <div class="row">
              <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                  {{-- <h4 style="background-color: #f7f7f7; border-bottom: 0px solid #eaeaea;" class="gray">Detalle del producto</h4> --}}

                  <div id="list-variations" class="dashboard-list-box-static">
                    <div hidden id="sin-lista-variacion">
                      <div class="notification warning closeable">
                        <p><span>Aviso!</span> Registre primero el detalle del producto. </p>
                        <a class="close" href="#"></a>
                      </div>
                    </div>

                    <div hidden id="lista-variacion-validacion">
                      <div class="notification warning closeable">
                        <p><span>Aviso!</span> Solo podrá registrar variaciones si no tiene imágenes en su galería. </p>
                        <a class="close" href="#"></a>
                      </div>
                    </div>

                    <div hidden id="sin-lista-atributos">
                      <div class="notification warning closeable">
                        <p><span>Aviso!</span> No existen atributos con variaciones. </p>
                        <a class="close" href="#"></a>
                      </div>
                    </div>

                    <div hidden id="lista-variacion">
                      <div class="notification notice closeable">
                				<p><span> </span>  Registre las variaciones acerca del atributo. </p>
                				<a class="close" href="#"></a>
                			</div>
                      <form class="subir-variacion" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div hidden class="">
                          <input type="text" id="producto-id" name="id_product" value="" size="40"   placeholder="Ejm: M ">
                        </div>
                          <div class="row">
                            <div class="col-md-2">
                              <div class="row">
                                <div >
                                <div class="col-md-12"> Variaciones </div></div>
                              </div>
                              <div class="row" >
                                <div class="col-md-12">
                                  <select required id="variacionesAtributos" class="col-md-11" name="atributo_id">

                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-2">
                              <div class="row">
                                <div class="">
                                  <div class="col-md-12"> Nombre</div></div>
                                </div>
                                <div class="row" >
                                  <div class="col-md-12">
                                    <div class="input-with-icon medium-icons">
                                    <div><span class="wpcf7-form-control-wrap name"><input required type="text" id="variacion_nombre" name="variacion_nombre" value="" size="40"   placeholder="Ejm: M "></span></div>
                                    <i class="im im-icon-Pen-2"></i>
                                  </div>
                                  </div>
                                </div>

                              </div>

                            <div class="col-md-2">
                              <div class="row">
                                <div class="">
                                <div class="col-md-12"> Precio S/.</div></div>
                              </div>
                              <div class="row" >
                                <div class="col-md-12">
                                  <div class="input-with-icon medium-icons">
                                  <div><span class="wpcf7-form-control-wrap name">
                                    <figure title="Este producto no debe contener impuestos (IGV)" tooltip-dir="bottom">
                                    <input required type="number" step="0.01" id="variacion_precio" name="variacion_precio" min="7"  value="" size="40"   placeholder="Ejm: 250 ">
                                    </figure>
                                  </span></div>
                                  <i class="im im-icon-Money"></i>
                                </div>
                                </div>
                              </div>

                            </div>

                            <div class="col-md-3">
                              <div class="row">
                                <div class="col-md-12">
                                 <div> Imagen</div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12"><span class="wpcf7-form-control-wrap name"><input required type="file" name="file" value="" id="variacion_imagen" size="40" placeholder="Ejm: Imagen " style="width: 85%;"></span></div>
                              </div>
                            </div>

                            <div class="col-md-2" style=" margin: 0rem;padding: 1rem;padding-top: 4%;">
                                <button type="submit" name="button">Agregar</button>
                            </div>
                          </div>
                        </form>
                    </div>

                  </div>

                </div>
              </div>
            </div>

        </div>
      </div>

        </div>

        </div>

  </div>

{{-- -------------------------------------------------------- --}}
    <div class="row">
        <!-- Copyrights -->
        <div class="col-md-12">
            <div class="copyrights">Derechos reservados. ®Rcom Global LCC.</div>
        </div>
    </div>

</div>
@endsection

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  {{-- //Genera datos aleatorios --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
  {{-- //Dropzone --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
  <script>
  Dropzone.options.myAwesomeDropzone = {
     url: "/admin/productos/subirDropzone",
     headers:{
       'X-CSRF-TOKEN' : "{{csrf_token()}}"
     },
     dictDefaultMessage: "Arrastre una imágen al recuadro para subirlo",
     acceptedFiles: "image/*",
     maxFilesize: 2,
     maxFiles: 9,
     addRemoveLinks: true,
     dictRemoveFile: "Remover imagen",
     dictMaxFilesExceeded: "Solo puedes subir 9 imágenes",
     // dictRemoveFileConfirmation: "Desea eliminar la imagen ?",


    init: function() {

      this.on("thumbnail", function(file) {
          var numero = this.getAcceptedFiles().length;
            if (file.status != 'error') {
              if ( numero >= 9 )
              {
                file.rejectLenght();
              }else {
                if ( file.width < 800 || file.height < 800 ) {
                    file.rejectDimensions();
                } else {
                    file.acceptDimensions();
                }
              }
            }
      });

      this.on('sending', function(file, xhr, formData){
          formData.append("name", file.name);
          formData.append("filesize", file.size);
          var unico = uuid.v4()
          formData.append("uuid", unico);
          file.uuid = unico;
      });

      this.on("removedfile", function(file, xhr, formData) {
        var unico = file.uuid
        $.get('/admin/productos/eliminarFileDropzone', {uuid: unico}, function (res) {
        });
      });

    },
    accept: function(file, done) {
      file.rejectDimensions = function() {
        done("Asegurese que el alto y ancho sean mayores a 800px.");
      };
      file.rejectLenght = function() {
        done("Solo puedes subir 9 imágenes");
      };
      file.acceptDimensions = done;
    }

  };
  </script>

  <script src="{{ asset('js/backend/product.js') }}"></script>
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
  	#swal2-title{
          font-size:2.875em;
  		margin-top: 15px;
      margin-bottom: 15px;
      }
      #swal2-content{
          font-size: 1.6em;
  		text-align: left;
      }
      .swal2-popup{
          width: auto;
      	height: auto;
      }
  	.swal2-styled.swal2-confirm{
  		border: 0;
  		border-radius: .25em;
  		background: initial;
  		background-color: #3085d6;
  		color: #fff;
  		/*font-size: 1.0625em;*/
  		font-size: 1.6em !important;
  	}
  	.swal2-styled.swal2-cancel{
  		font-size: 1.6em !important;
  	}

  	label span, legend span {
      /*font-weight: 400;*/
      font-size: 17px;
      /*color: #444;*/
  	}
  	p {
      	font-size: 18px;
      	color: #707070;
  	}
  </style>
@endsection
