
var el = document.getElementById('no-property-form')
if (el) {
  el.addEventListener('click', function (e) {
    e.stopPropagation();
    e.preventDefault();
    const form = document.getElementById('property-not-form')

    if (typeof dataForm === 'object') {
      /*const valProperty = document.getElementById('property_id').value;
      const data = {
        name: `${dataForm['name']}`,
        email: dataForm['email'],
        text: dataForm['message'],
        cellphone: dataForm['phone'],
        properties: [valProperty],
        tags: ['urdapilleta.com.ar']
      }
      swal({
        type: 'info',
        title: 'Enviando Consulta ...',
        showCancelButton: false,
        showConfirmButton: false
      });
      swal.showLoading();
 
      jQuery.ajax({
        method: "POST",
        url: "/contacto",
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function (e) {
          swal.hideLoading();
          console.log(e);
          swal({
            type: 'success',
            title: 'Consulta Enviada',
          });
          form.innerHTML = '<div class="alert alert-success" role="alert">\n' +
          '  <h4 class="alert-heading">Genial!</h4>\n' +
          '  <p>Tu consulta ha sido enviada te responderemos a la brevedad.</p>\n' +
          '  <hr>\n' +
          '</div>';
        },
        error: function (e) {
          console.log(e)
          swal.hideLoading();
          swal({
            type: 'error',
            title: 'Un error ha ocurrido tu consulta no ha sido enviada',
          });
        }
      })*/
    }
  })
}
