$(document).ready(async function () {

  const { data: info } = await axios.get(`https://ipinfo.io?token=06e6161325a723`)
  const { data: city } = await axios.get(`/search-department?info=${info.city}`)

  $("#departments option[value='" + city + "']").prop("selected", "selected")
  $('select[name=department]').trigger("chosen:updated");

  $('#contenedor-profile').on('change', '#perfil-opciones', function () {
 
    var opcion = $(this).val();
    switch (opcion) {
      case '1':
        $('#mis-negocios').hide();
        $('#mis-perfil').hide();
        $('#mis-pagos').show();
        break;
      case '2':
        $('#mis-pagos').hide();
        $('#mis-perfil').hide();
        $('#mis-negocios').show();
        break;
      case '3':

        $('#mis-pagos').hide();
        $('#mis-negocios').hide();
        $('#mis-perfil').show();
        break;
      default:
        console.log('No hay opcion disponible');
    }


  });

  $('#departments').on('change', function () {

    let id_departamento = $(this).val();
    let categoria_id = $('#business').val();


    $.get('/categorias', { id_departamento: id_departamento }, function (res) {
      // console.log(res);
      $('#business').empty();

      $('select[name=business]').append('<option value="">Todas las categorías</option>')
      $.each(res.bussines, function (index, value) {

        // $('#business').append('<option value="'+value.id+'">'+value.name+'</option>');
        $('select[name=business]').append('<option value="' + value.id + '">' + value.name + '</option>')
      });
      $('select[name=business]').trigger("chosen:updated");
    })

    console.log('Los negocios ' + id_departamento + ' - ' + categoria_id);

    $.get('/negocios', { id_departamento: id_departamento, categoria_id: categoria_id }, function (res) {

      console.log(res.negocios);

      if (res.negocios != '') {
        $('#negocios').empty();
        $('select[name=name]').append('<option value="">Buscar</option>')
        $.each(res.negocios, function (index, value) {
          $('select[name=name]').append('<option value="' + value.id + '">' + value.company + '</option>')
        });
        $('select[name=name]').trigger("chosen:updated");
      } else {
        $('#negocios').empty();
        $('select[name=name]').append('<option value="0">Sin negocios</option>')
        $('select[name=name]').trigger("chosen:updated");
      }

    })

  });

  $('#business').on('change', function () {
    console.log("resultado");
    let categoria_id = $(this).val();
    let id_departamento = $('#departments').val();
    console.log(id_departamento);


    $.get('/negocios', { id_departamento: id_departamento, categoria_id: categoria_id }, function (res) {

      console.log(res.negocios);

      if (res.negocios != '') {
        $('#negocios').empty();
        $('select[name=name]').append('<option value="">Buscar</option>')
        $.each(res.negocios, function (index, value) {
          $('select[name=name]').append('<option value="' + value.id + '">' + value.company + '</option>')
        });
        $('select[name=name]').trigger("chosen:updated");
      } else {
        $('#negocios').empty();
        // $('#negocios').append('<option value="0"> Sin negocios</option>');
        $('select[name=name]').append('<option value="0">Sin negocios</option>')
        $('select[name=name]').trigger("chosen:updated");
      }

    })

  });

  $('#departamento').on('change',function(){

      let id=$(this).val();
      $.get('/provincia',{department_id:id},function(res){
          console.log(res);
          $('#provincia').empty();
          $('#provincia').append('<option value="">Seleccione</option>');
          $.each(res.provincias, function(index,value){
              $('#provincia').append('<option value="'+value._id+'">'+value.name+'</option>');
          });
      })
  })

  $('#provincia').on('change',function(){
      let id=$(this).val();
      let id_departamento = $('#departamento').val();
      $.get('/distrito',{province_id:id,department_id:id_departamento},function(res){
          console.log(res);
          $('#distrito').empty();
          $('#distrito').append('<option value="">Seleccione</option>');
          $.each(res.distritos, function(index,value){
              $('#distrito').append('<option value="'+value._id+'">'+value.name+'</option>');

          });
      })
  })
  $('#perfil-update').on('submit', function(event){
    Swal.fire({
      title: '¡Procesando datos insertados',
      allowOutsideClick: false,
      allowEscapeKey : false,
      onBeforeOpen: () => {
          Swal.showLoading()
      },
      });
    event.preventDefault();
    var form_url= $(this).attr('action'),
    form_data=new FormData(this);


    if($('#telefono').val() != "" || $('#celular').val() != ""){
      let file=$('#seleccionArchivos').val();
      form_data.append('file', file);
      let nombre=$('#nombre').val();
      form_data.append('nombre', nombre);
      let apellido=$('#apellido').val();
      form_data.append('apellido', apellido);
      let email=$('#correo').val();
      form_data.append('email', email);
      let departamento=$('#departamento').val();
      form_data.append('departamento', departamento);
      let provincia=$('#provincia').val();
      form_data.append('provincia', provincia);
      let distrito=$('#distrito').val();
      form_data.append('distrito', distrito);
      let telefono=$('#telefono').val();
      form_data.append('telefono', telefono);
      let celular=$('#celular').val();
      form_data.append('celular', celular);
      let direccion=$('#direccion').val();
      form_data.append('direccion', direccion);
      let dni=$('#dni').val();
      form_data.append('dni', dni);

      $.ajax({
        url: form_url,
        method:"POST",
        data:form_data,
        dataType:"json",
        processData: false,
        contentType: false,
        success:function(res)
        {
            // console.log(res.recenGenerate[0].id);
            if(res.status == 200){
              if(res.costumer.change_dni >= 2){
                $("#dni").attr("readonly", true);
              }
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: '¡Datos guardados exitosamente!',
                showConfirmButton: false,
                timer: 1500
              })
            }
            else{
              if(res.status == 300){
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: '¡Hay un email existente!',
                  showConfirmButton: false,
                  timer: 1500
                })
              }
              else{
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: '¡El DNI solo puede ser modificado dos veces!',
                  showConfirmButton: false,
                  timer: 1500
                })
              }

            }

            /*Swal.fire({
              position: 'center',
              icon: 'success',
              title: '¡Datos guardados exitosamente!',
              showConfirmButton: false,
              timer: 1500
            })*/
            //location.reload();
      }
      });
    }
    else{
      $('#telefono').css("border-color", "#F9B314");
      $('#celular').css("border-color", "#F9B314");
      Swal.fire({
        icon: 'warning',
        title: 'Oops...',
        text: '¡Debe completar el campo telefónico o número de celular!'
      })
    }




  })
  function porcentaje(){
    $.get('/porcentaje', function(res){

      $('.total').text("S/. "+ addCommas(parseFloat(res.limiteCompraTacna_porcentaje).toFixed(2)));
      $('.realizadas').text("S/. "+ addCommas(parseFloat(res.totalVentasCliente_porcentaje).toFixed(2)));
      $('.restantes').text("S/. "+ addCommas(parseFloat(res.restoPorcentaje).toFixed(2)));
      $('.progress-bar').css('width', parseFloat(res.porcentaje).toFixed(2) + '%');
      console.log(res);
    });

  }
  function addCommas(nStr)
  {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + ' ' + '$2');
    }
    return x1 + x2;
  }
  porcentaje();
  setInterval(porcentaje,10000);
});
