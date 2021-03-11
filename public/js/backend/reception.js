$(document).ready(function () {


      $('.table-detalle').on('click', '.eliminar-item', function () {
            var id_dish = $(this).attr('data-id_dish');
            var id_clasification = $(this).attr('data-id_clasification');

            var row = $(this).parents("tr");


            $.get('/admin/eliminar-carta', { id_dish: id_dish, id_clasification: id_clasification }, function (res) {
                  row.remove();
            });

      });

      $('#ul-principal').on('change', '.asignar-repartidor', function () {
            var id_repartidor = $(this).val(); // id del repartidor
            var id_pending = $(this).attr('data-pending');

            //
            $.get('/admin/asignar-repartidor', { id_repartidor: id_repartidor, id_pending: id_pending }, function (res) {

                  console.log('asignado');

            });

      });


      // $('#ul-principal').on('change','.asignar-repartidor',function(){
      //
      //
      //         var id_repartidor = $(this).val(); // id del repartidor
      //         var id_pending = $(this).attr('data-pending');
      //         // console.log(id_repartidor+' - '+id_pending);
      //         //
      //         // var id_classification = $(this).attr('data-id_classification');
      //         // var padre = $(this).parents('div.div-principal');
      //         // var tabla = padre.find('.table-detalle');
      //         //
      //         // $.get('/admin/subir-carta',{id_dish:id_dish,id_classification:id_classification},function(res){
      //         //
      //         //     tabla.append(`
      //         //       <tr >
      //         //       <td class="administrar-detalle">${res.plato.id}</td>
      //         //       <td class="administrar-detalle">${res.plato.name}</td>
      //         //       <td class="administrar-detalle">
      //         //         <a class="button eliminar-item" data-id_dish="${res.plato.id}" data-id_clasification="${id_classification}" style="background-color: #334033;">Eliminar</a>
      //         //       </td>
      //         //       </tr>
      //         //       `);
      //         //
      //         //   });
      //   });

});
