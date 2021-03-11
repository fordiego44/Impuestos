$(document).ready(function(){

  $('#ul-principal').on('click', '#actualizar-porcentaje', function () {
        var porcentaje = $('#porcentaje-transferir').val();
         $.get('/superadmin/configuration/porcentaje-actualizar', {porcentaje: porcentaje}, function (res) {
              console.log(res);
              setTimeout(function() {
                $("#alerta-comision").show();
              },500);

              setTimeout(function() {
                $("#alerta-comision").hide();
              },4000);
        });
  });

});
