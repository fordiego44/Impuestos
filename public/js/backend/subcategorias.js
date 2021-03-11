$(document).ready(function(){

  $('#search').autocomplete({
    source: function(request,response){
      request= $.get('/admin/clasificacion/searchClasificacion', {term: request.term}, function (res) {
         response(res.datos); 
      });

      request.done(function( msg ) {
      $( "#log" ).html( msg );
        console.log(msg);
      });

      request.fail(function( jqXHR, textStatus ) {
        console.log(jqXHR.responseText,textStatus);
        alert( "Request failed: " + textStatus + jqXHR.responseText);
      });
    }
  });

  $('.with-forms').on('click','#agregar-subcategoria',function(){
      var subcategoria = $('#search').val();
      var unico = uuid.v4()

      if (subcategoria) {
        $.get('/admin/clasificacion/upSearchClasificacion', {nombre: subcategoria, uuid:unico}, function (res) {
            if (res.datos == 1) {
              Swal.fire('La subcategoría ya existe, ingrese otra.');
            } else {

              $('#lista-subcategorias').append(`
                <li class="newCategory"><i class="list-box-icon sl sl-icon-tag"></i>
                  <strong>${res.datos.name}</strong>
                  <ul>
                    <li class="paid"><span>Ingrese una descripción</span></li>

                  </ul>
                  <div class="buttons-to-right" >
                    <a href="/admin/clasificaciones/editarClasificacion/${res.datos.id}" class=" delete button gray"><i class="sl sl-icon-close"></i> Editar</a>
            				<a  data-id_product="${res.datos.id}" class="eliminar-subcategoria delete button gray" ><i class="sl sl-icon-close"></i> Eliminar</a>
                   </div>
                </li>
                `);
            }

        });
      }
  });

  $('#lista-subcategorias').on('click', '.eliminar-subcategoria', function () {
    var id_producto = $(this).attr('data-id_product');
    var rowe = $(this).parents("li.newCategory");

    Swal.fire({
      title: '¿Estás seguro?',
      text: "Se eliminará de tu lista de subcategorías",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar!'
    }).then((result) => {
      if (result.isConfirmed) {

        Swal.fire(
          'Eliminado!',
          'La subcategoría fue removida de tu lista.',
          'success'
        )

        $.get('/admin/clasificaciones/eliminar', {id_producto: id_producto}, function (res) {
              rowe.remove();
        });

      }
    })

  });


 });
